<?php

namespace App\Http\Controllers;

use Artisan;

class SchedulerController extends Controller
{
    public function run()
    {
        Artisan::call('schedule:run');
    }
}
