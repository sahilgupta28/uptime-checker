<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\TestLog\TestLogInterface;

class SaveTestLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test_log:create {data} --queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a test log.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TestLogInterface $test_log)
    {
        $this->test_log = $test_log;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = $this->argument('data');
        $data['website_id'] = $data['id'];
        unset($data['id']);
        $this->test_log->create($data);
    }
}
