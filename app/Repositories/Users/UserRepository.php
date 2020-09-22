<?php

namespace App\Repositories\User;

use App\Models\User;
use DB;

class UserRepository implements UserInterface
{
    private $model;
    protected const WEEK_DAYS = [
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday'
    ];

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes)
    {
        return $this->model->find($id)->fill($attributes)->save();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getWeeklyReport(int $id)
    {
        $week_days = $this->weekDayQuery();
        $start_time = date('Y-m-d 00:00:00', strtotime('monday this week'));
        $end_time = date('Y-m-d 23:59:59', strtotime('sunday this week'));
        return DB::table('users as u')
            ->select(
                'u.name',
                'u.email',
                'w.title',
                'w.domain',
                'w.id as website_id',
                'u.id as user_id',
                DB::raw('(SELECT count(test_logs.id) FROM test_logs
                    WHERE test_logs.status = false
                    AND test_logs.website_id = W.id
                    AND test_logs.test_at BETWEEN' . "'" . $start_time . "' AND '" . $end_time . "')
                    as website_downtime"),
                DB::raw('(SELECT count(test_logs.id) FROM test_logs
                    WHERE test_logs.status = false
                    AND test_logs.test_at BETWEEN' . "'" . $start_time . "' AND '" . $end_time . "')
                    as user_downtime"),
                DB::raw($week_days)
            )
            ->leftJoin('websites as w', 'w.user_id', '=', 'u.id')
            ->where('u.id', $id)
            ->get()
            ->filter(function ($user) {
                $user->website_uptime = $this->calculateWeekPercentage($user->website_downtime);
                $user->user_uptime = $this->calculateWeekPercentage($user->user_downtime);
                foreach (self::WEEK_DAYS as $key => $day) {
                    $user->week_report[$day] = $user->$day;
                    unset($user->$day);
                }
                return $user;
            });
    }

    private function calculateWeekPercentage($time)
    {
        return  round(
            (
                (config('constants.WEEK_MINUTES') - $time) / (config('constants.WEEK_MINUTES'))
            ) * 100,
            config('constants.ROUND')
        );
    }

    private function weekDayQuery()
    {
        $query = '';
        foreach (self::WEEK_DAYS as $key => $day) {
            $start_time = date('Y-m-d 00:00:00', strtotime("$day this week"));
            $end_time = date('Y-m-d 23:59:59', strtotime("$day this week"));
            $query .= '(SELECT count(test_logs.id) FROM test_logs 
                    WHERE test_logs.status = false 
                    AND test_logs.website_id = W.id
                    AND test_logs.test_at BETWEEN' . "'" . $start_time . "' AND '" . $end_time . "')
                    as $day";
            if ($key != (count(self::WEEK_DAYS) - 1)) {
                $query .= ', ';
            }
        }
        return $query;
    }
}
