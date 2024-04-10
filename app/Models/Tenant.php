<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Tenant extends Authenticatable {
    use Notifiable;

    protected $guard = 'tenant';
    protected $guarded = [];
    protected $hidden = [
        'password' ,
        'remember_token' ,
    ];

    protected function serializeDate ( DateTimeInterface $date ) {
        return $date->format('Y-m-d H:i:s');
    }

    public function getFullNameAttribute () {
        return $this->owner_first_name . " " . $this->owner_last_name;
    }
}
