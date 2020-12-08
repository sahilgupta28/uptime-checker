<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\User\UserInterface;
use App\Mail\WeeklyReportMail;
use Illuminate\Support\Facades\Mail;

class WeeklyReport extends Command
{
    protected $signature = 'report:generate';

    protected $description = "It'll generate weekly reports";

    public function __construct(UserInterface $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    public function handle()
    {
        $users = $this->user->all();
        $bar = $this->output->createProgressBar(count($users));
        $bar->start();
        foreach ($users as $user) {
        }
        $bar->finish();
    }
}
