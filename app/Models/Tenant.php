<?php

namespace App\Models;

use Carbon\Carbon;
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
        return $this->owner_first_name . " " . $this->owner_last_name . " " . $this->plaque;
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

    public function warnings (): HasMany {
        return $this->hasMany(Warning::class , 'tenant_id');
    }

    public function transactions (): HasMany {
        return $this->hasMany(Transaction::class , 'tenant_id');
    }

    public function monthlyCharges (): HasMany {
        return $this->hasMany(MonthlyCharge::class , 'tenant_id');
    }

    public function scopeWithUnpaidChargesCount ( $query ) {
        return $query->withCount([
                                     'monthlyCharges as unpaid_charges_count' => function ( $q ) {
                                         $q->notPaid()
                                           ->dueDatePassed();
                                     },
                                 ]);
    }

    public function generateMonthlyCharge ( FiscalYear $fiscal_year ) {
        for ( $i = 1 ; $i <= 12 ; $i++ ) {
            $due_date = verta(Carbon::parse($fiscal_year->started_at))
                ->addMonths($i - 1)
                ->startMonth()
                ->toCarbon();
            MonthlyCharge::query()
                         ->firstOrCreate([
                                             'fiscal_year_id' => $fiscal_year->id ,
                                             'tenant_id' => $this->id ,
                                             'month' => $i ,
                                         ] , [
                                             'original_amount' => $this->monthly_charge_amount ,
                                             'due_date' => $due_date ,
                                         ]);
        }
    }

    public function getDefaultPasswordAttribute () {
        return $this->plaque . "@1403";
    }

    public function getPassedDueDateAmountAttribute () {
        $monthly_charges = $this->monthlyCharges()
                                ->dueDatePassed()
                                ->get();
        $total = 0;
        foreach ( $monthly_charges as $monthly_charge ) {
            $total += $monthly_charge->final_amount;
        }

        return $total;
    }
}
