<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class writeInFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bechde:failshi';

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
        $todayDate = Carbon::now();
        $last = $todayDate->endOfMillennium();
        $diff = $last -> diffInDays($todayDate);
        file_put_contents(storage_path('logs/dateNow.log'), $diff . PHP_EOL, FILE_APPEND | LOCK_EX);
        $this->comment("{$diff} written to file");
    }
}
