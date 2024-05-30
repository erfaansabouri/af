<?php

namespace App\Http\Controllers;

use App\Models\MonthlyCharge;
use App\Models\Tenant;
use App\Models\Transaction;
use Auth;
use Illuminate\Http\Request;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class TransactionController extends Controller {
    public function generateUrl ( Request $request ) {
        $transaction = null;
        $tenant = Tenant::query()
                        ->find($request->get('tenant_id'));
        if ( $monthly_charge_id = $request->get('monthly_charge_id') ) {
            $monthly_charge = MonthlyCharge::query()
                                           ->where('id' , $monthly_charge_id)
                                           ->whereNull('paid_at')
                                           ->firstOrFail();

            $transaction = Transaction::query()
                                      ->create([
                                                   'tenant_id' => $monthly_charge->tenant_id ,
                                                   'monthly_charge_id' => $monthly_charge->id ,
                                                   'original_amount' => $monthly_charge->original_amount ,
                                                   'amount' => $monthly_charge->final_amount ,
                                                   'subject' => 'شارژ ماهیانه'
                                               ]);
        }

        else if ( $debt_amount = $request->get('debt_amount') ) {
            if ($debt_amount > $tenant->debt_amount){
                flash()
                    ->options([
                                  'timeout' => 3000 ,
                                  'position' => 'top-left' ,
                              ])
                    ->addError('مبلغ بیش از حد مجاز' , 'خطا!');
                return redirect()->back();
            }
            $transaction = Transaction::query()
                                      ->create([
                                                   'tenant_id' => $request->get('tenant_id') ,
                                                   'original_amount' => $debt_amount ,
                                                   'amount' => $debt_amount ,
                                                   'subject' => 'بدهی'
                                               ]);
        }
        else {
            dd("ERROR");
        }
        $invoice = ( new Invoice )->amount($transaction->amount / 10);
        return Payment::callbackUrl(route('web.verify'))
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
                flash()
                    ->options([
                                  'timeout' => 3000 ,
                                  'position' => 'top-left' ,
                              ])
                    ->addSuccess('پرداخت با موفقیت انجام شد.' , 'تبریک!');
                if ( Auth::guard('tenant')
                         ->check() ) {
                    return redirect()->route('tenant.monthly-charges.index');
                }
                else {
                    return redirect()->route('admin.tenants.monthly-charges' , $monthly_charge->tenant_id);
                }
            }
            if ($transaction->subject == 'بدهی'){
                $transaction->tenant->decrement('debt_amount', $transaction->amount);
                flash()
                    ->options([
                                  'timeout' => 3000 ,
                                  'position' => 'top-left' ,
                              ])
                    ->addSuccess('پرداخت با موفقیت انجام شد.' , 'تبریک!');
                if ( Auth::guard('tenant')
                         ->check() ) {
                    return redirect()->route('tenant.monthly-charges.index');
                }
                else {
                    return redirect()->route('admin.tenants.monthly-charges' , $transaction->tenant_id);
                }
            }
        }
        catch ( InvalidPaymentException $exception ) {
            $monthly_charge->transaction->failed_at = now();
            $monthly_charge->transaction->save();
            echo $exception->getMessage();
        }
    }
}
