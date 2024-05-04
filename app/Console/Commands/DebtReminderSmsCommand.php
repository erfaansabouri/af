<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;

class DebtReminderSmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:debt-reminder-sms-command';

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
        $today = verta();
        if ($today->day == 6){
            $tenants = Tenant::query()
                             ->where('debt_amount' , '>' , 0)
                             ->orWhereHas('warnings')
                             ->orWhereHas('monthlyCharges' , function ( $q ) {
                                 $q->notPaid()
                                   ->dueDatePassed();
                             })->get();

            foreach ($tenants as $tenant){
                // send sms
            }
        }
    }
}
