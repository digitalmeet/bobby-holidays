<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Scheduled tasks
Schedule::command('quotations:expire')->dailyAt('00:30');
Schedule::command('enquiries:follow-up-reminders')->dailyAt('09:00');
Schedule::command('sitemap:generate')->dailyAt('03:00');
