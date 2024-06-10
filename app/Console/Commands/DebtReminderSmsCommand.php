<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Services\Kavenegar;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

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
        if ( 1 ) {
            $tenants = Tenant::query()
                             ->whereNotNull('phone_number')
                             ->where(function ( Builder $query ) {
                                 $query->orWhereHas('warnings')
                                       ->orWhereHas('monthlyCharges' , function ( $q ) {
                                           $q->notPaid()
                                             ->dueDatePassed();
                                       })
                                       ->orWhereHas('debts' , function ( $query ) {
                                           $query->whereNull('paid_at');
                                       });
                             })
                             ->get();
            foreach ( $tenants as $tenant ) {
                $not_paid_debts = $tenant->debts()->notPaid()->sum('amount');
                $total = number_format($not_paid_debts + $tenant->passed_due_date_amount);
                $warnings = $tenant->warnings()
                                   ->count();
                Kavenegar::send($tenant->phone_number , 'debtreminder' , $tenant->plaque , $total , $warnings);
            }
        }
    }
}
