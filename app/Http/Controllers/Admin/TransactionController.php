<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\Convert;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class TransactionController extends Controller {
    public function index ( Request $request ) {
        $started_at = Carbon::createFromTimestamp(Convert::jalaliToTimestamp($request->get('started_at')))
                            ->startOfDay();
        $ended_at = Carbon::createFromTimestamp(Convert::jalaliToTimestamp($request->get('ended_at')))
                          ->endOfDay();

        $tenant_type_id = $request->get('tenant_type_id');
        $transaction_type = $request->get('transaction_type');
        $records = Transaction::query()
                              ->with([ 'verifyLogs' ])
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
                              ->when($transaction_type == 'tejari' , function ( Builder $query ) use ( $transaction_type ) {
                                  $query->whereHas('tenant' , function ( $q ) use ( $transaction_type ) {
                                      $q->where('tenant_type_id' , 1);
                                  });
                              })
                              ->when($transaction_type == 'edari' , function ( Builder $query ) use ( $transaction_type ) {
                                  $query->whereHas('tenant' , function ( $q ) use ( $transaction_type ) {
                                      $q->where('tenant_type_id' , 2);
                                  });
                              })
                              ->when($transaction_type == 'malekiati' , function ( Builder $query ) use ( $transaction_type ) {
                                  $query->whereNotNull('ownership_debt_id');
                              })
                              ->when($transaction_type == 'motefareghe' , function ( Builder $query ) use ( $transaction_type ) {
                                  $query->whereNotNull('other_id');
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
        $started_at = Carbon::createFromTimestamp(Convert::jalaliToTimestamp($request->get('started_at')))
                            ->startOfDay();
        $ended_at = Carbon::createFromTimestamp(Convert::jalaliToTimestamp($request->get('ended_at')))
                          ->endOfDay();
        $tenant_type_id = $request->get('tenant_type_id');
        $paid_via = $request->get('paid_via');
        $transaction_type = $request->get('transaction_type');


        return Excel::download(new TransactionExport($started_at , $ended_at , $transaction_type , $paid_via) , 'transactions.xlsx');
    }

    public function pdf ( $id ) {
        $transaction = Transaction::findOrFail($id);
        $view = $transaction->tenant_id ? 'pdf.transaction' : 'pdf.other-transaction';
        $pdf = PDF::loadView($view , compact('transaction') , [] , [ 'format' => 'A5-L' ]);

        return $pdf->stream('t-' . $transaction->id . '.pdf');
    }
}
