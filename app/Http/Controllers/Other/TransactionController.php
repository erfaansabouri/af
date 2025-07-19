<?php

namespace App\Http\Controllers\Other;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\OtherDebt;
use App\Models\OtherMonthlyCharge;
use App\Models\Transaction;
use App\Models\VerifyLog;
use App\Services\Convert;
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
                              ->where('other_id' , Auth::guard('other')
                                                        ->id())
                              ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                                  $search = $request->get('search');
                                  $query->where('tx_id' , 'like' , '%' . $search . '%');
                              })
                              ->orderByDesc('id')
                              ->get();

        return view('metronic.other.transactions.index' , compact('records'));
    }

    public function pdf ( $id ) {
        $transaction = Transaction::query()
                                  ->where('other_id' , Auth::guard('other')
                                                            ->id())
                                  ->paid()
                                  ->findOrFail($id);
        $pdf = PDF::loadView('pdf.other-transaction' , compact('transaction') , [] , [ 'format' => 'A5-L' ]);

        return $pdf->stream('ot-' . $transaction->id . '.pdf');
    }

    public function generateUrl ( Request $request ) {
        $transaction = null;
        if ( $other_monthly_charge_id = $request->get('other_monthly_charge_id') ) {
            $other_monthly_charge = OtherMonthlyCharge::query()
                                           ->where('id' , $other_monthly_charge_id)
                                           ->whereNull('paid_at')
                                           ->firstOrFail();
            $transaction = Transaction::query()
                                      ->create([
                                                   'other_name' => $other_monthly_charge->other->full_name ,
                                                   'other_id' => $other_monthly_charge->other_id ,
                                                   'other_monthly_charge_id' => $other_monthly_charge->id ,
                                                   'original_amount' => $other_monthly_charge->amount ,
                                                   'amount' => $other_monthly_charge->amount ,
                                                   'subject' => $other_monthly_charge->subject_and_month ,
                                               ]);
        }
        else if ( $other_debt_id = $request->get('other_debt_id') ) {
            $other_debt = OtherDebt::query()
                        ->where('id' , $other_debt_id)
                        ->whereNull('paid_at')
                        ->firstOrFail();
            $request->validate([
                                   'debt_amount' => [
                                       'required' ,
                                   ] ,
                               ] , [
                                   'debt_amount.required' => 'مبلغ الزامی است' ,
                               ]);
            $removed_comma = str_replace(',' , '' , $request->get('debt_amount'));
            $other_debt_amount_to_pay = Convert::convertToEnNumbers($removed_comma);
            if ( $other_debt_amount_to_pay > $other_debt->amount ) {
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
                                                   'other_name' => $other_debt->other->full_name ,
                                                   'other_id' => $other_debt->other_id ,
                                                   'other_debt_id' => $other_debt_id ,
                                                   'original_amount' => $other_debt_amount_to_pay ,
                                                   'amount' => $other_debt_amount_to_pay ,
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


    public function export ( Request $request ) {
        $request->validate([
                               'started_at' => [ 'required' ] ,
                               'ended_at' => [ 'required' ] ,
                           ]);
        $started_at = Carbon::createFromTimestamp($request->get('started_at'))
                            ->startOfDay();
        $ended_at = Carbon::createFromTimestamp($request->get('ended_at'))
                          ->endOfDay();

        return Excel::download(new TransactionExport($started_at , $ended_at , $request->get('other_type_id') , null) , 'transactions.xlsx');
    }

    public function chooseGateway ( Request $request ) {
        $request->validate([
                               'generate_url' => [ 'required' ] ,
                           ]);
        $generate_url = $request->get('generate_url');

        return view('metronic.tenant.choose-gateway.index' , compact('generate_url'));
    }
}
