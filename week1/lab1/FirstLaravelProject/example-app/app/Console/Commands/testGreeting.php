<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class testGreeting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-greeting {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command hi hi';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $this -> comment("Hello, {$name}!");
    }
}
