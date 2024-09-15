<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtherDebt extends Model
{
    const TYPES = [
        'NORMAL' => 'NORMAL',
        'MONTHLY_CHARGE' => 'MONTHLY_CHARGE'
    ];

    public function other (): BelongsTo {
        return $this->belongsTo(Other::class);
    }

    public function scopePaid ( Builder $query ): Builder {
        return $query->whereNotNull('paid_at');
    }

    public function scopeNotPaid ( Builder $query ): Builder {
        return $query->whereNull('paid_at');
    }}
