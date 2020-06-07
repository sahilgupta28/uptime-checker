<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Website\WebsiteInterface;
use App\Components\UptimeChecker;
use Artisan;

class RunTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:run {--fail} {--queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all Test.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(WebsiteInterface $website)
    {
        parent::__construct();
        $this->website = $website;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
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
