<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Website\WebsiteInterface;
use App\Mail\WeeklyReportMail;
use Illuminate\Support\Facades\Mail;

class DailyStatus extends Command
{
    protected $signature = 'report:daily';

    protected $description = "It'll generate daily status reports";

    public function __construct(WebsiteInterface $website)
    {
        parent::__construct();
        $this->website = $website;
    }

    public function handle()
    {
        $websites = $this->website->all();
        $bar = $this->output->createProgressBar(count($websites));
        $bar->start();
        foreach ($websites as $website) {
            if (!$website->is_active) {
                continue;
            }
            $this->website->dailyReport($website->id);
            $bar->advance();
        }
        $bar->finish();
    }
}
