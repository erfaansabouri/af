<?php

namespace App\Http\Controllers;

use App\Models\MonthlyCharge;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class TransactionController extends Controller {
    public function generateUrl ( Request $request ) {
        $transaction = null;
        if ( $monthly_charge_id = $request->get('monthly_charge_id') ) {
            $monthly_charge = MonthlyCharge::query()
                                           ->where('id' , $monthly_charge_id)
                                           ->whereNull('paid_at')
                                           ->firstOrFail();
            $transaction = Transaction::query()
                                      ->create([
                                                   'tenant_id' => $monthly_charge->tenant_id ,
                                                   'monthly_charge_id' => $monthly_charge->id ,
                                                   'amount' => $monthly_charge->original_amount ,
                                               ]);
        }
        else {
            dd("ERROR");
        }
        $invoice = ( new Invoice )->amount($transaction->amount / 10);

        return Payment::callbackUrl(route('transaction.verify'))
                      ->purchase($invoice , function ( $driver , $transactionId ) use ( $transaction ) {
                          $transaction->tx_id = $transactionId;
                          $transaction->save();
                      })
                      ->pay()
                      ->render();
    }

    public function verify ( Request $request ) {
        $tx_id = $request->get('Authority');
        $transaction = Transaction::query()
                                  ->where('tx_id' , $tx_id)
                                  ->firstOrFail();
        try {
            $receipt = Payment::amount($transaction->amount / 10)
                              ->transactionId($tx_id)
                              ->verify();
            $transaction->paid_at = now();
            $transaction->ref_id = $receipt->getReferenceId();
            $transaction->save();
            if ( $transaction->monthly_charge_id ) {
                $monthly_charge = MonthlyCharge::query()
                                               ->findOrFail($transaction->monthly_charge_id);
                $monthly_charge->paid_at = now();
                $monthly_charge->paid_amount = $transaction->amount;
                $monthly_charge->save();

                return redirect()->route('tenant.monthly-charges.index');
            }
        }
        catch ( InvalidPaymentException $exception ) {

            echo $exception->getMessage();
        }
    }
}
