<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtherMonthlyCharge extends Model
{
    use HasFactory;

    const PAID_VIA = [
        'ADMIN' => 'ADMIN' ,
        'BEHPARDAKHT' => 'BEHPARDAKHT' ,
    ];

    public function scopeNotPaid ( Builder $query ): Builder {
        return $query->whereNull('paid_at');
    }

    public function getSubjectAndMonthAttribute () {
        $date = verta($this->due_date)->formatJalaliDate();

        return "شارژ ماهیانه به تاریخ $date";
    }

    public function other (): BelongsTo {
        return $this->belongsTo(Other::class);
    }
}
