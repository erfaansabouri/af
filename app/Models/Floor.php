<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    const FLOORS = [
        'UNDERGROUND' => 'UNDERGROUND' ,
        'GROUND' => 'GROUND' ,
        'FIRST' => 'FIRST' ,
        'SECOND' => 'SECOND' ,
        'THIRD' => 'THIRD' ,
    ];
}
