<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HazineOmrani extends Model {
    public function getFinalAmountAttribute () {
        if ( now() <= Carbon::parse($this->started_at)
                            ->addDays(10) ) {
            // 10 percent discount
            return $this->original_amount - ( $this->original_amount * 0.1 );
        }
        elseif ( now() >= Carbon::parse($this->ended_at)
                                ->subDays(10) ) {
            // 5 percent jarime
            return $this->original_amount + ( $this->original_amount * 0.05 );
        }
        else {
            return $this->original_amount;
        }
    }

    public function scopeNotPaid ( Builder $query ): Builder {
        return $query->whereNull('paid_at');
    }

    public function getSubjectAndMonthAttribute () {
        return "هزینه عمرانی " . verta($this->started_at)->format('Q Y');
    }

    public function tenant (): BelongsTo {
        return $this->belongsTo(Tenant::class);
    }

}
