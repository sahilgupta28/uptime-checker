<?php

namespace App\Repositories\Website;

use App\Models\Website;
use Illuminate\Pipeline\Pipeline;
use App\Notifications\TestFailNotification;
use App\Notifications\DailyStatus;
use App\Helpers\Helper;
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
            \App\QueryFilters\Website\LoginUser::class,
            \App\QueryFilters\Website\TestLogs::class
        ])
        ->thenReturn()
        ->paginate(config('constants.DEFAULT.LIMIT'));
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

    public function delete($id)
    {
        return $this->model->whereId($id)->delete();
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

    public function updateNotificationKey($id, $key, $started_at)
    {
        $data = [];
        if (!$started_at || !$key) {
            $data = [
                'notification_started_at' => date(config('constants.DATE_TIME_FORMAT')),
                'notification_key' => 1
            ];
            return $this->update($id, $data);
        }

        $max_date_time = date(
            config('constants.DATE_TIME_FORMAT'),
            strtotime('+' . config('constants.DAY_MINUTES') . ' minutes', strtotime($started_at))
        );
        if ($max_date_time <= date(config('constants.DATE_TIME_FORMAT'))) {
            $data = [
                'notification_started_at' => null,
                'notification_key' => Helper::nextFibonacciNumber($key)
            ];
            return $this->update($id, $data);
        }
        $data = [
            'notification_key' => Helper::nextFibonacciNumber($key)
        ];
        return $this->update($id, $data);
    }
}
