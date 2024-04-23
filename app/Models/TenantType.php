<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantType extends Model {
    const TYPES = [
        'VAHED_TEJARI' => 'VAHED_TEJARI' ,
        'VAHED_EDARI' => 'VAHED_EDARI' ,
        'VITRIN' => 'VITRIN' ,
        'GHORFEH' => 'GHORFEH' ,
        'TABLIGHAT' => 'TABLIGHAT' ,
        'MOSHAAT' => 'MOSHAAT' ,
        'ANBAR' => 'ANBAR' ,
    ];
}
