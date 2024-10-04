<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

//


class task4 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:task4 {days} {filename}';
    protected $signature = 'app:task4 {days}';

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
        $days = $this->argument('days');

        $date = Carbon::now();
        $date->addDays($days);

        file_put_contents(storage_path('app/logsDate.txt'), $date . PHP_EOL, FILE_APPEND | LOCK_EX);

        $this->comment("{$date} was printed in logs.txt");
    }
}
