<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model {
    const COUPONS = [
        'FIRST_DAY' => 'FIRST_DAY' ,
        'SECOND_DAY_TO_FIFTH_DAY' => 'SECOND_DAY_TO_FIFTH_DAY' ,
    ];
}
