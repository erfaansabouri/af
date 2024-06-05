<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model {
    public function tenant (): BelongsTo {
        return $this->belongsTo(Tenant::class);
    }

    public function monthlyCharge (): BelongsTo {
        return $this->belongsTo(MonthlyCharge::class);
    }

    public function scopePaid ( Builder $query ): Builder {
        return $query->whereNotNull('paid_at');
    }

    public function scopeNotPaid ( Builder $query ): Builder {
        return $query->whereNull('paid_at');
    }

    public function getStatusAttribute () {
        if ( $this->paid_at ) {
            return "پرداخت موفق";
        }
        if ( $this->failed_at ) {
            return "پرداخت ناموفق";
        }
        else {
            return "در حال پرداخت";
        }
    }

    public function hasPenalty () {
        return $this->amount > $this->original_amount;
    }

    public function hasDiscount () {
        return $this->amount < $this->original_amount;
    }

    public function penaltyAmount () {
        if ( $this->hasPenalty() ) {
            return $this->amount - $this->original_amount;
        }

        return 0;
    }

    public function discountAmount () {
        if ( $this->hasDiscount() ) {
            return $this->original_amount - $this->amount;
        }

        return 0;
    }

    public function penaltyPercent () {
        if ( $this->hasPenalty() ) {
            return ( $this->penaltyAmount() / $this->original_amount ) * 100;
        }

        return 0;
    }

    public function discountPercent () {
        if ( $this->hasDiscount() ) {
            return ( $this->discountAmount() / $this->original_amount ) * 100;
        }

        return 0;
    }

    public function getFakeTextAttribute () {
        if ( $this->is_fake ) {
            return "مجازی توسط مدیریت";
        }
        else {
            return "به پرداخت";
        }
    }
}
