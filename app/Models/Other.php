<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Other extends Model
{
    use HasFactory;

    public function getDefaultPasswordAttribute () {
        return $this->plaque . "@1403";
    }

    public function otherMonthlyCharges (): HasMany {
        return $this->hasMany(OtherMonthlyCharge::class , 'other_id');
    }
}
