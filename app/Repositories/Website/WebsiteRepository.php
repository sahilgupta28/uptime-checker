<?php

namespace App\Repositories\Website;

use App\Models\Website;
use Illuminate\Pipeline\Pipeline;
use App\Notifications\TestFailNotification;
use App\Notifications\DailyStatus;
use DB;

class WebsiteRepository implements WebsiteInterface
{
    private $model;

    public function __construct(Website $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes)
    {
        return $this->model->whereId($id)->update($attributes);
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function list()
    {
        return app(Pipeline::class)
        ->send($this->model)
        ->through([
            \App\QueryFilters\Sort::class,
            \App\QueryFilters\Website\LoginUser::class
        ])
        ->thenReturn()
        ->get()
        ->map(function ($website) {
            $website->setRelation(
                'testLogs',
                $website->testLogs->take(10)
            );
            return $website;
        });
    }

    public function all()
    {
        return $this->model->all();
    }

    public function allFail()
    {
        return $this->model->where('status', false)->get();
    }

    public function notify($id)
    {
        return $this->model->whereId($id)->first()->notify(new TestFailNotification());
    }

    public function dailyReport($id)
    {
        return $this->model->whereId($id)->first()->notify(new DailyStatus($this->getDailyReport($id)));
    }

    public function getDailyReport($id)
    {
        $start_time = date('Y-m-d 00:00:00');
        $end_time = date('Y-m-d 23:59:59');
        return DB::table('users as u')
            ->select(
                'u.name',
                'u.email',
                'w.title',
                'w.domain',
                'w.slack_hook',
                'w.id as website_id',
                'u.id as user_id',
                DB::raw('(SELECT count(test_logs.id) FROM test_logs
                    WHERE test_logs.status = false
                    AND test_logs.website_id = W.id
                    AND test_logs.test_at BETWEEN' . "'" . $start_time . "' AND '" . $end_time . "')
                    as website_downtime")
            )
            ->leftJoin('websites as w', 'w.user_id', '=', 'u.id')
            ->whereNotNull('w.slack_hook')
            ->where('w.id', $id)
            ->first();
    }
}
