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

    public function getPersianMonthAttribute() {
        switch ($this->month) {
            case 1:
                return "فروردین";
            case 2:
                return "اردیبهشت";
            case 3:
                return "خرداد";
            case 4:
                return "تیر";
            case 5:
                return "مرداد";
            case 6:
                return "شهریور";
            case 7:
                return "مهر";
            case 8:
                return "آبان";
            case 9:
                return "آذر";
            case 10:
                return "دی";
            case 11:
                return "بهمن";
            case 12:
                return "اسفند";
            default:
                return "ماه نامعتبر"; // For invalid month numbers
        }
    }

}
