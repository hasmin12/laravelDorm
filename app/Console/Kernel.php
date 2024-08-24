<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('logs:update-status')->everyMinute();
        // $schedule->command('app:update-pending-payments')->everyMinute();

        $schedule->command('logs:update-status')->daily();
        // $schedule->command('app:update-pending-payments')->everyMinute();

        $schedule->command('app:update-pending-payments')->monthlyOn(5, '00:00');;

        $schedule->command('app:update-laundry-schedule')->daily();

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
