<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

use App\Console\Commands\TestSchedulerOutput;

//Schedule::command(TestSchedulerOutput::class)
//    ->everyMinute()
//    ->runInBackground();


//Artisan::command('log', function () {
//    info('Logged in successfully on "log" command.');
//
//    $this->info('THIS SHOULD APPEAR ON LOGS, BECAUSE FOREGROUND');
//})->everyMinute();
//
//Artisan::command('log-in-background', function () {
//    info('Logged in successfully on "log-in-background" command.');
//
//    $this->info('THIS SHOULD NOT APPEAR ON LOGS, BECAUSE BACKGROUND');
//})->runInBackground()->everyMinute();
