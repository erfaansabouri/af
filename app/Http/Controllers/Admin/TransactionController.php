<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\MonthlyCharge;
use App\Models\Tenant;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class TransactionController extends Controller {
    public function index ( Request $request ) {
        $started_at = Carbon::createFromTimestamp($request->get('started_at'))
                            ->startOfDay();
        $ended_at = Carbon::createFromTimestamp($request->get('ended_at'))
                          ->endOfDay();
        $tenant_type_id = $request->get('tenant_type_id');
        $records = Transaction::query()
                              ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                                  $search = $request->get('search');
                                  $query->where('id' , 'like' , '%' . $search . '%')
                                        ->orWhere('ref_id' , 'like' , '%' . $search . '%')
                                        ->orWhere('tx_id' , 'like' , '%' . $search . '%')
                                        ->orWhere('tenant_id' , 'like' , '%' . $search . '%');
                              })
                              ->when($request->get('started_at') , function ( Builder $query ) use ( $started_at ) {
                                  $query->where('created_at' , '>' , $started_at);
                              })
                              ->when($request->get('ended_at') , function ( Builder $query ) use ( $ended_at ) {
                                  $query->where('created_at' , '<' , $ended_at);
                              })
                              ->when($request->get('tenant_type_id') , function ( Builder $query ) use ( $tenant_type_id ) {
                                  $query->whereHas('tenant' , function ( $q ) use ( $tenant_type_id ) {
                                      $q->where('tenant_type_id' , $tenant_type_id);
                                  });
                              })
                              ->orderByDesc('id')
                              ->get();

        return view('metronic.admin.transactions.index' , compact('records'));
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
        $tenant_type_id = $request->get('tenant_type_id');

        return Excel::download(new TransactionExport($started_at , $ended_at , $tenant_type_id) , 'transactions.xlsx');
    }

    public function pdf ( $id ) {
        $transaction = Transaction::findOrFail($id);
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
                                                   'subject' => 'شارژ ماهیانه' ,
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
                                                   'subject' => 'بدهی' ,
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
}
