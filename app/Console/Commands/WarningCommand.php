<?php

namespace App\Console\Commands;

use App\Models\MonthlyCharge;
use App\Models\Tenant;
use App\Models\Warning;
use Illuminate\Console\Command;

class WarningCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'warning-cmd';
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
        $monthly_charges = MonthlyCharge::query()
                                        ->where('due_date' , '<' , now()->subDays(30))
                                        ->get();
        foreach ( $monthly_charges as $monthly_charge ) {
            Warning::query()
                   ->firstOrCreate([
                                       'tenant_id' => $monthly_charge->tenant_id ,
                                       'monthly_charge_id' => $monthly_charge->id ,
                                   ] , [
                                       'reason' => 'شارژ پرداخت نشده' ,
                                   ]);
        }
        $tenants = Tenant::query()
                         ->where('debt_amount' , '>' , 0)
                         ->get();
        foreach ( $tenants as $tenant ) {
            Warning::query()
                   ->firstOrCreate([
                                       'tenant_id' => $tenant->id ,
                                       'reason' => 'بدهی' ,
                                   ]);
        }
    }
}
