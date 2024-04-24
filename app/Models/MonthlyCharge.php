<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getPersianMonthAttribute () {
        switch ( $this->month ) {
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

    public function getFinalAmountAttribute () {
        if ( $this->tenant->warnings()
                          ->count() >= 5 ) {
            return ( 110 / 100 ) * $this->original_amount;
        }
        if ( $this->tenant->debt_amount > 0 ) {
            return $this->original_amount;
        }
        $coupon_first_day = Coupon::query()
                                  ->where('coupon' , Coupon::COUPONS[ 'FIRST_DAY' ])
                                  ->where('active' , true)
                                  ->first();
        $is_due_date_today = Carbon::parse($this->due_date)
                                   ->isToday();
        if ( $coupon_first_day && Carbon::parse($this->due_date)
                                        ->isFuture() ) {
            return ( ( 100 - $coupon_first_day->discount_percent ) / 100 ) * $this->original_amount;
        }
        if ( $coupon_first_day && $is_due_date_today ) {
            return ( ( 100 - $coupon_first_day->discount_percent ) / 100 ) * $this->original_amount;
        }
        ###
        $coupon_second_day_to_fifth_day = Coupon::query()
                                                ->where('coupon' , Coupon::COUPONS[ 'SECOND_DAY_TO_FIFTH_DAY' ])
                                                ->where('active' , true)
                                                ->first();
        $due_date = Carbon::parse($this->due_date);
        $now = Carbon::now();
        $days_since_due = $due_date->diffInDays($now);
        // Check if 1 to 5 days passed from due date then apply discount
        if ( $due_date->isPast() && $coupon_second_day_to_fifth_day && $days_since_due >= 1 && $days_since_due <= 5 ) {
            return ( ( 100 - $coupon_second_day_to_fifth_day->discount_percent ) / 100 ) * $this->original_amount;
        }

        // Return original amount if no discounts apply
        return $this->original_amount;
    }
}
