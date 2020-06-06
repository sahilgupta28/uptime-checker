<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\User\UserInterface;
use App\Mail\WeeklyReportMail;
use Illuminate\Support\Facades\Mail;

class WeeklyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "It'll generate weekly reports";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserInterface $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = $this->user->all();
        $bar = $this->output->createProgressBar(count($users));
        $bar->start();
        foreach ($users as $user) {
            $weekly_report = $this->user->getWeeklyReport($user->id);
            if (count($weekly_report) > 0) {
                Mail::to($user->email)->send(new WeeklyReportMail($weekly_report));
            }
            $bar->advance();
        }
        $bar->finish();
    }
}
