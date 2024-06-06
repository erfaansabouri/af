<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Services\Kavenegar;
use Illuminate\Console\Command;

class DebtReminderSmsCommand extends Command {
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
    public function handle () {
        $today = verta();
        if ( $today->day == 6 ) {
            $tenants = Tenant::query()
                             ->whereNotNull('phone_number')
                             ->where('debt_amount' , '>' , 0)
                             ->orWhereHas('warnings')
                             ->orWhereHas('monthlyCharges' , function ( $q ) {
                                 $q->notPaid()
                                   ->dueDatePassed();
                             })
                             ->get();
            foreach ( $tenants as $tenant ) {
                $total = number_format($tenant->debt_amount + $tenant->passed_due_date_amount);
                $warnings = $tenant->warnings()->count();
                Kavenegar::send($tenant->phone_number, 'debtreminder', $tenant->plaque, $total, $warnings);
            }
        }
    }
}
