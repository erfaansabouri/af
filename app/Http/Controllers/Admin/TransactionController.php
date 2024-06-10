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
        $paid_via = $request->get('paid_via');

        return Excel::download(new TransactionExport($started_at , $ended_at , $tenant_type_id, $paid_via) , 'transactions.xlsx');
    }

    public function pdf ( $id ) {
        $transaction = Transaction::findOrFail($id);
        $pdf = PDF::loadView('pdf.transaction' , compact('transaction') , [] , [ 'format' => 'A5-L' ]);

        return $pdf->stream('t-' . $transaction->id . '.pdf');
    }
}
