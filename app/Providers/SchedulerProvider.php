<?php

namespace App\Providers;

use Yuga\Scheduler\Scheduler;
use Yuga\Scheduler\SchedulerServiceProvider;

class SchedulerProvider extends SchedulerServiceProvider
{
    public function schedule(Scheduler $scheduler = null)
    {
        if ($scheduler) {
            //
        }
    }
}