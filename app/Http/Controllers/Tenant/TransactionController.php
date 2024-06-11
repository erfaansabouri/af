<?php

namespace App\Http\Controllers\Tenant;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\Debt;
use App\Models\MonthlyCharge;
use App\Models\Tenant;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class TransactionController extends Controller {
    public function index ( Request $request ) {
        $records = Transaction::query()
                              ->where('tenant_id' , Auth::guard('tenant')
                                                        ->id())
                              ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                                  $search = $request->get('search');
                                  $query->where('tx_id' , 'like' , '%' . $search . '%');
                              })
                              ->orderByDesc('id')
                              ->get();

        return view('metronic.tenant.transactions.index' , compact('records'));
    }

    public function pdf ( $id ) {
        $transaction = Transaction::query()
                                  ->where('tenant_id' , Auth::guard('tenant')
                                                            ->id())
                                  ->paid()
                                  ->findOrFail($id);
        $pdf = PDF::loadView('pdf.transaction' , compact('transaction') , [] , [ 'format' => 'A5-L' ]);

        return $pdf->stream('t-' . $transaction->id . '.pdf');
    }

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
                                                   'original_amount' => $monthly_charge->original_amount ,
                                                   'amount' => $monthly_charge->final_amount ,
                                                   'subject' => $monthly_charge->subject_and_month ,
                                               ]);
        }
        else if ( $debt_id = $request->get('debt_id') ) {
            $debt = Debt::query()
                        ->where('id' , $debt_id)
                        ->whereNull('paid_at')
                        ->firstOrFail();
            $request->validate([
                                   'debt_amount' => [
                                       'required' ,
                                   ] ,
                               ] , [
                                   'debt_amount.required' => 'مبلغ الزامی است' ,
                               ]);
            $debt_amount_to_pay =  str_replace(',' , '' , $request->get('debt_amount'));;
            if ($debt_amount_to_pay > $debt->amount){
                flash()
                    ->options([
                                  'timeout' => 3000 ,
                                  'position' => 'top-left' ,
                              ])
                    ->addError('مبلغ بیش از حد مجاز' , 'خطا');

                return redirect()->back();
            }
            $transaction = Transaction::query()
                                      ->create([
                                                   'tenant_id' => $debt->tenant_id ,
                                                   'debt_id' => $debt_id ,
                                                   'original_amount' => $debt_amount_to_pay ,
                                                   'amount' => $debt_amount_to_pay ,
                                                   'subject' => 'پرداخت بدهی' ,
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
        $tx_id = $request->get('RefId') ?? $request->get('Authority');
        $transaction = Transaction::query()
                                  ->where('tx_id' , $tx_id)
                                  ->firstOrFail();
        try {
            $receipt = Payment::amount($transaction->amount / 10)
                              ->transactionId($tx_id)
                              ->verify();
            $transaction->paid_at = now();
            $transaction->ref_id = $request->get('RefId');
            $transaction->save();
            if ( $transaction->monthly_charge_id ) {
                $monthly_charge = MonthlyCharge::query()
                                               ->find($transaction->monthly_charge_id);
                $monthly_charge->paid_at = now();
                $monthly_charge->paid_amount = $transaction->amount;
                $monthly_charge->save();

                return view('payment.redirect' , [
                    'success' => true ,
                    'code' => $tx_id ,
                ]);
            }
            if ( $transaction->debt_id ) {
                $debt = Debt::query()
                            ->find($transaction->debt_id);
                if ( $transaction->amount < $debt->amount ) {
                    $debt->amount = $debt->amount - $transaction->amount;
                }
                else {
                    $debt->paid_at = now();
                }
                $debt->save();

                return view('payment.redirect' , [
                    'success' => true ,
                    'code' => $tx_id ,
                ]);
            }
        }
        catch ( InvalidPaymentException $exception ) {
            $transaction->failed_at = now();
            $transaction->save();

            return view('payment.redirect' , [
                'failed' => true ,
                'failed_message' => $exception->getMessage() ,
            ]);
        }
    }

    public function export ( Request $request ) {
        $request->validate([
                               'started_at' => [ 'required' ] ,
                               'ended_at' => [ 'required' ] ,
                           ]);
        $started_at = Carbon::createFromTimestamp($request->get('started_at'))
                            ->startOfDay();
        $ended_at = Carbon::createFromTimestamp($request->get('ended_at'))
                          ->endOfDay();

        return Excel::download(new TransactionExport($started_at , $ended_at , $request->get('tenant_type_id') , null) , 'transactions.xlsx');
    }
}
