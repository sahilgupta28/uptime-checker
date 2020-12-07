<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\TestLog\TestLogInterface;

class DeleteLogs extends Command
{
    protected $signature = 'delete:logs';

    protected $description = "It'll delete the old log entries from DB.";

    public function __construct(TestLogInterface $log)
    {
        parent::__construct();
        $this->log = $log;
    }

    public function handle()
    {
        $this->log->deleteOldLogs();
    }
}
