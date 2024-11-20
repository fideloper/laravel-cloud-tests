<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestEnv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-env';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('$_ENV: '.($_ENV['LARAVEL_CLOUD'] ?? "not-set"));
        $this->info('$_SERVER: '.($_SERVER['LARAVEL_CLOUD'] ?? "not-set"));
    }
}
