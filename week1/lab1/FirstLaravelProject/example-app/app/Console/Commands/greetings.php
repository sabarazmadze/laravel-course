<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class greetings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gau:send {rame}';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a marketing email to a user';
 
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $rame = $this->argument('rame');
        $this->comment("hello {$rame}");
    }
}
