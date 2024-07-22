<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Models\Warning;
use Illuminate\Console\Command;

class RemoveWarningCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-warning-command';

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
        //$warnings = Warning::whereNotNull('monthly_charge_id')->get();
        //foreach ($warnings as $warning){
        //    $tenant_warnings_count = $warning->tenant->warnings()->count();
        //
        //    if ($warning->monthlyCharge->paid_at && $tenant_warnings_count < Setting::getMaxWarningThreshold()){
        //        $warning->delete();
        //    }
        //}
    }
}
