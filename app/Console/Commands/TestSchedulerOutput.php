<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestSchedulerOutput extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-scheduler-output';

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
        sleep(1);
        Log::info("Log::info(): testing scheduler output");
        $this->info('$this->info(): testing scheduler output');
        $this->error('$this->error(): testing scheduler output');
        $this->output->getErrorStyle()->writeln('to stderr');
    }
}
