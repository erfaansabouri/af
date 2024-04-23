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
                $tenant->generateMonthlyCharge($fiscal_year);
            }
        });
    }

    public function monthlyCharges (): HasMany {
        return $this->hasMany(MonthlyCharge::class , 'fiscal_year_id');
    }
}
