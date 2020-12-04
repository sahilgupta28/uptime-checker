<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Website\WebsiteRepository;
use App\Components\UptimeChecker;
use App\Models\Website;
use Artisan;

class RunTest extends Command
{
    protected $signature = 'test:run {--fail} {--queue}';
    protected $description = 'Run all Test.';

    public function handle()
    {
        $website_repo = new WebsiteRepository(new Website());
        $websites = $this->getWebsites();
        $bar = $this->output->createProgressBar(count($websites));
        $bar->start();

        foreach ($websites as $website) {
            if (!$website->is_active) {
                continue;
            }
            $new_status = (new UptimeChecker())->run($website->domain);
            $website_repo->updateStatus($website->id, $new_status);
            if (!$new_status) {
                $website_repo->notify($website->id);
                Artisan::queue('test_log:create', ['data' => $website->only('id', 'status', 'test_at')]);
            }

            $bar->advance();
        }
        $bar->finish();
    }

    private function getWebsites()
    {
        $website_repo = new WebsiteRepository(new Website());
        if ($this->option('fail')) {
            return $website_repo->allFail();
        }
        return $website_repo->all();
    }
}
