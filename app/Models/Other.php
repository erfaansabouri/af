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

    public function getFirstUnpaidMonthlyCharge () {
        return $first_unpaid_monthly_charge = OtherMonthlyCharge::query()
                                                           ->where('other_id' , $this->id)
                                                           ->notPaid()
                                                           ->first();
    }


    public function submitBestankari ( $amount ) {
        $first_unpaid_monthly_charge = $this->getFirstUnpaidMonthlyCharge();
        if (!$first_unpaid_monthly_charge){
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
            $first_unpaid_monthly_charge->amount = $first_unpaid_monthly_charge->amount - $amount;
            $first_unpaid_monthly_charge->save();

            return true;
        }
    }

}