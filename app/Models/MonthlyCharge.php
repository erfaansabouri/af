<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyCharge extends Model {
    public function tenant (): BelongsTo {
        return $this->belongsTo(Tenant::class);
    }

    public function fiscalYear (): BelongsTo {
        return $this->belongsTo(FiscalYear::class);
    }
}
