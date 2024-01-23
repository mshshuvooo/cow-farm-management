<?php

namespace App\Console;

use App\Http\Resources\CowResource;
use App\Models\Cow;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->call(function () {

        // })->daily()->timeZone('Asia/Dhaka')->at('8:00');

        // $schedule->call(function () {
        //     $cows = array('id'=> 1, 'id'=> 2);
        //     var_dump($cows);
        // })->everyMinute();

        $schedule->command('vaccine-notification:fmd')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
