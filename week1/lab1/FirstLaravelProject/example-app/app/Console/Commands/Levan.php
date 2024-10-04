<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Levan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:levan {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description hello';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $this->comment("gamarjoba rogor xar me kargad {$name}");
    }
}
