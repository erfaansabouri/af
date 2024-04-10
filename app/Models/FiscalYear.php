<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FiscalYear extends Model {
    protected static function booted () {
        self::created(function ( FiscalYear $fiscal_year ): void {
            foreach ( Tenant::all() as $tenant ) {
                for ( $i = 1 ; $i <= 12 ; $i++ ) {
                    $due_date = verta(Carbon::parse($fiscal_year->started_at)
                                            ->addMonths($i - 1))->startMonth()->toCarbon();
                    MonthlyCharge::query()
                                 ->firstOrCreate([
                                                     'fiscal_year_id' => $fiscal_year->id ,
                                                     'tenant_id' => $tenant->id ,
                                                     'month' => $i ,
                                                     'original_amount' => $tenant->monthly_charge_amount
                                                 ] , [
                                                     'due_date' => $due_date ,
                                                 ]);
                }
            }
        });
    }

    public function monthlyCharges (): HasMany {
        return $this->hasMany(MonthlyCharge::class , 'fiscal_year_id');
    }
}
