<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BedehiOmrani extends Model
{
    use HasFactory;

    public function tenant (): BelongsTo {
        return $this->belongsTo(Tenant::class);
    }

    public function scopePaid ( Builder $query ): Builder {
        return $query->whereNotNull('paid_at');
    }

    public function scopeNotPaid ( Builder $query ): Builder {
        return $query->whereNull('paid_at');
    }
}
