<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\TestLog\TestLogInterface;

class SaveTestLog extends Command
{
    protected $signature = 'test_log:create {data} --queue';

    protected $description = 'Create a test log.';

    public function __construct(TestLogInterface $test_log)
    {
        $this->test_log = $test_log;
        parent::__construct();
    }

    public function handle()
    {
        $data = $this->argument('data');
        $data['website_id'] = $data['id'];
        unset($data['id']);
        $this->test_log->create($data);
    }
}
