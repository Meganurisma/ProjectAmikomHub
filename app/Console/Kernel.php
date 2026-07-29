<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Abandoned cart reminders every 10 minutes
        $schedule->command('cart:send-reminders')->everyTenMinutes();

        // Send review requests daily at 09:00
        $schedule->command('reviews:send-requests')->dailyAt('09:00');
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
    }
}
