<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Schedule::command('reminder:class')->dailyAt('05:00'); // H-1
// Schedule::command('reminder:class')->dailyAt('05:00'); // H

Schedule::command('reminder:class')->everyMinute();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
