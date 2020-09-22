<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Website\WebsiteInterface;
use App\Components\UptimeChecker;
use Artisan;

class RunTest extends Command
{
    protected $signature = 'test:run {--fail} {--queue}';
    protected $description = 'Run all Test.';

    public function __construct(WebsiteInterface $website)
    {
        parent::__construct();
        $this->website = $website;
    }

    public function handle()
    {
        $websites = $this->getWebsites();
        $bar = $this->output->createProgressBar(count($websites));
        $bar->start();

        foreach ($websites as $website) {
            $website->test_at = date(config('constants.DATE_TIME_FORMAT'));
            $website->status = (new UptimeChecker())->run($website->domain);
            $this->website->update($website->id, $website->toArray());
            Artisan::queue('test_log:create', ['data' => $website->only('id', 'status', 'test_at')]);
            if (!$website->status) {
                $this->website->notify($website->id);
            }

            $bar->advance();
        }
        $bar->finish();
    }

    private function getWebsites()
    {
        if ($this->option('fail')) {
            return $this->website->allFail();
        }
        return $this->website->all();
    }
}
