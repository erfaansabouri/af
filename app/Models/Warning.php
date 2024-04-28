<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Warning extends Model
{
    public function tenant (): BelongsTo {
        return $this->belongsTo(Tenant::class);
    }

    public function monthlyCharge (): BelongsTo {
        return $this->belongsTo(MonthlyCharge::class);
    }
}
