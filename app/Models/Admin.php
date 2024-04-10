<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable {
    use Notifiable;

    protected $guard = 'admin';
    protected $guarded = [];
    protected $hidden = [
        'password' ,
        'remember_token' ,
    ];

    protected function serializeDate ( DateTimeInterface $date ) {
        return $date->format('Y-m-d H:i:s');
    }

    public function getFullNameAttribute () {
        return $this->first_name . " " . $this->last_name;
    }
}
