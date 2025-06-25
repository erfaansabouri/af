<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtherFinancialPeriodLog extends Model
{
    use HasFactory;

    public function other (): BelongsTo {
        return $this->belongsTo(Other::class);
    }
}
