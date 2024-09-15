<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Other extends Authenticatable {
    public function getDefaultPasswordAttribute () {
        return $this->plaque . "@1403";
    }

    public function otherMonthlyCharges (): HasMany {
        return $this->hasMany(OtherMonthlyCharge::class , 'other_id');
    }

    public function transactions (): HasMany {
        return $this->hasMany(Transaction::class , 'other_id');
    }

    public function getFirstUnpaidMonthlyCharge () {
        return $first_unpaid_monthly_charge = OtherMonthlyCharge::query()
                                                                ->where('other_id' , $this->id)
                                                                ->notPaid()
                                                                ->first();
    }

    public function submitBestankari ( $amount ) {
        $first_unpaid_monthly_charge = $this->getFirstUnpaidMonthlyCharge();
        if ( !$first_unpaid_monthly_charge ) {
            return false;
        }
        if ( $amount > $first_unpaid_monthly_charge->amount ) {
            return false;
        }
        elseif ( $amount == $first_unpaid_monthly_charge->amount ) {
            $transaction = Transaction::query()
                                      ->create([
                                                   'other_name' => $this->plaque ,
                                                   'other_id' => $this->id ,
                                                   'other_monthly_charge_id' => $first_unpaid_monthly_charge->id ,
                                                   'original_amount' => $amount ,
                                                   'amount' => $amount ,
                                                   'subject' => $first_unpaid_monthly_charge->subject_and_month ,
                                                   'paid_at' => now() ,
                                                   'ref_id' => 'AD' . rand() ,
                                                   'tx_id' => 'AD' . rand() ,
                                                   'paid_via' => Transaction::PAID_VIA[ 'ADMIN' ] ,
                                               ]);
            $first_unpaid_monthly_charge->paid_via = OtherMonthlyCharge::PAID_VIA[ 'ADMIN' ];
            $first_unpaid_monthly_charge->paid_at = now();
            $first_unpaid_monthly_charge->save();

            return true;
        }
        else {
            $transaction = Transaction::query()
                                      ->create([
                                                   'other_name' => $this->plaque ,
                                                   'other_id' => $this->id ,
                                                   'other_monthly_charge_id' => $first_unpaid_monthly_charge->id ,
                                                   'original_amount' => $amount ,
                                                   'amount' => $amount ,
                                                   'subject' => $first_unpaid_monthly_charge->subject_and_month ,
                                                   'paid_at' => now() ,
                                                   'ref_id' => 'AD' . rand() ,
                                                   'tx_id' => 'AD' . rand() ,
                                                   'paid_via' => Transaction::PAID_VIA[ 'ADMIN' ] ,
                                               ]);
            $first_unpaid_monthly_charge->paid_via = OtherMonthlyCharge::PAID_VIA[ 'ADMIN' ];
            $first_unpaid_monthly_charge->amount = $first_unpaid_monthly_charge->amount - $amount;
            $first_unpaid_monthly_charge->save();

            return true;
        }
    }

    public function addDebt ( $amount , $reason , $type ) {
        OtherDebt::query()
                 ->create([
                              'other_id' => $this->id ,
                              'amount' => $amount ,
                              'reason' => $reason ,
                              'type' => $type ,
                          ]);
    }

    public function removeDebt ( $debt_id ) {
        $other_debt = OtherDebt::query()
                               ->find($debt_id);
        if ( !$other_debt ) {
            throw new Exception('بدهی یافت نشد');
        }
        if ( $other_debt->other_id != $this->id ) {
            throw new Exception('بدهی مربوط به این کاربر نیست');
        }
        if ( $other_debt->paid_at ) {
            throw new Exception('بدهی پرداخت شده قابل حذف نیست');
        }
        $other_debt->delete();
    }

    public function otherDebts (): HasMany {
        return $this->hasMany(OtherDebt::class);
    }

    public function getFullNameAttribute () {
        return $this->plaque;
    }

    public function getCanPayMonthlyChargesAttribute () {
        return $this->otherDebts()
                    ->notPaid()
                    ->sum('amount') < 1;
    }
}
