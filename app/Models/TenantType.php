<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantType extends Model {
    const TYPES = [
        'GHORFEH_TEJARI' => 'GHORFEH_TEJARI' ,
        'GHORFEH_EDARI' => 'GHORFEH_EDARI' ,
        'VITRIN' => 'VITRIN' ,
        'TABLIGHAT' => 'TABLIGHAT' ,
        'MOSHAAT' => 'MOSHAAT' ,
        'ANBAR' => 'ANBAR' ,
    ];
}
