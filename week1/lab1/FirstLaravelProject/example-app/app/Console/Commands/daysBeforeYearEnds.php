<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class daysBeforeYearEnds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:days-before-year-ends';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle() : void
    {
//        $date = Carbon::parse('2024-12-31 23:59:59');
        $now = Carbon::now();
        $endOfTheYear = $now->endOfYear();

        $diff = $now->diffInDays($endOfTheYear);
        $this->comment("{$diff} days before year ends");
    }
}
