<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
    /**
     * Define the application's command schedule.
     */
    protected function schedule ( Schedule $schedule ): void {
        /*$schedule->command('warning-cmd')
                 ->everyMinute()
                 ->withoutOverlapping();
        $schedule->command('app:remove-warning-command')
                 ->everyMinute()
                 ->withoutOverlapping();*/
        $schedule->command('app:debt-reminder-sms-command')
                 ->daily()
                 ->withoutOverlapping();
        $schedule->command('expire-transactions')
                 ->everyMinute()
                 ->withoutOverlapping();
        $schedule->command('fix-phone')
                 ->everyMinute()
                 ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands (): void {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
