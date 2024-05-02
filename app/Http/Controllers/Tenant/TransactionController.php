<?php

namespace App\Http\Controllers\Tenant;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
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
                                                   'subject' => 'شارژ ماهیانه',
                                               ]);
        }
        else if ( $debt_amount = $request->get('debt_amount') ) {
            if ( $debt_amount > $tenant->debt_amount ) {
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
                                                   'subject' => 'بدهی',
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
        $monthly_charge = MonthlyCharge::query()
                                       ->find($transaction->monthly_charge_id);
        try {
            $receipt = Payment::amount($transaction->amount / 10)
                              ->transactionId($tx_id)
                              ->verify();
            $transaction->paid_at = now();
            $transaction->ref_id = $receipt->getReferenceId();
            $transaction->save();
            if ( $transaction->monthly_charge_id ) {
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
            if ( $transaction->subject == 'بدهی' ) {
                $transaction->tenant->decrement('debt_amount' , $transaction->amount);
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
            $transaction->failed_at = now();
            $transaction->save();
            if ($monthly_charge){
                $monthly_charge->failed_at = now();
                $monthly_charge->save();
            }
            echo $exception->getMessage();
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

        return Excel::download(new TransactionExport($started_at , $ended_at) , 'transactions.xlsx');
    }
}
