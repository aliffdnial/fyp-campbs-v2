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
        // $schedule->command('inspire')->hourly();
        
        // To schedule this task to run daily, you can add it to the Kernel class
        // This will ensure that the lot statuses are updated daily and that lots are made available for booking once the end date of a previous booking has passed.
        // $schedule->command('update:lot-status-after-end-date')->daily();
        // $schedule->command('update:lot-status-after-end-date')->dailyAt('3:00');
        // $schedule->command('update:lot-status-after-end-date')->everyMinute();
        // $schedule->command('check:expiredBookings')->hourly();
        $schedule->command('check:expiredBookings')->dailyAt('00:00')->timezone('Asia/Singapore');
        $schedule->command('check:futureBookings')->dailyAt('10:00')->timezone('Asia/Singapore');
        // $schedule->command('check:expiredBookings')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
        
        Commands\CheckExpiredBookings::class;
        Commands\CheckFutureBookings::class;
    }
}
