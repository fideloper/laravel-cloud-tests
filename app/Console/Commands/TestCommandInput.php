<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommandInput extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'input:test {--user_id= : The user ID the client should be assigned to }';

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
        $userId = $this->option('user_id') ?: $this->ask(
            'Which user ID should the client be assigned to? (Optional)'
        );

        $this->info('user id: '.$userId);
    }
}
