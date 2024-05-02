<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public static function getPenaltyPercent(){
        return Setting::query()->firstOrCreate([])->penalty_percent;
    }

    public static function getMaxWarningThreshold(){
        return Setting::query()->firstOrCreate([])->max_warning_threshold;
    }

    public static function getMinDebtAmount(){
        return Setting::query()->firstOrCreate([])->min_debt_amount;
    }
}
