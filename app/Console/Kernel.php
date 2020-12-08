<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('test:run')
            ->everyMinute();
        // $schedule->command('report:generate')
        //     ->weeklyOn(7, config('constants.NIGHT_SCHEDULER_TIME'));
        $schedule->command('report:daily')
            ->dailyAt(config('constants.NIGHT_SCHEDULER_TIME'));
        $schedule->command('delete:logs')
            ->dailyAt(config('constants.NIGHT_SCHEDULER_TIME'));
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
