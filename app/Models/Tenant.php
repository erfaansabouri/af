<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Tenant extends Authenticatable implements HasMedia {
    use Notifiable , InteractsWithMedia;

    protected $guard   = 'tenant';
    protected $guarded = [];
    protected $hidden  = [
        'password' ,
        'remember_token' ,
    ];

    public function registerMediaCollections (): void {
        $this->addMediaCollection('image')
             ->singleFile();
    }

    protected function serializeDate ( DateTimeInterface $date ) {
        return $date->format('Y-m-d H:i:s');
    }

    public function getFullNameAttribute () {
        return $this->owner_first_name . " " . $this->owner_last_name;
    }

    public function tenantType (): BelongsTo {
        return $this->belongsTo(TenantType::class);
    }

    public function floor (): BelongsTo {
        return $this->belongsTo(Floor::class);
    }

    public function messages (): HasMany {
        return $this->hasMany(Message::class , 'tenant_id');
    }

    public function monthlyCharges (): HasMany {
        return $this->hasMany(MonthlyCharge::class , 'tenant_id');
    }
}
