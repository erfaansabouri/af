<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class TransactionController extends Controller {
    public function index ( Request $request ) {
        $records = Transaction::query()
                              ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                                  $search = $request->get('search');
                                  $query->where('id' , 'like' , '%' . $search . '%')
                                        ->orWhere('ref_id' , 'like' , '%' . $search . '%')
                                        ->orWhere('tx_id' , 'like' , '%' . $search . '%')
                                        ->orWhere('tenant_id' , 'like' , '%' . $search . '%');
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

        return Excel::download(new TransactionExport($started_at , $ended_at) , 'transactions.xlsx');
    }

    public function pdf ( $id ) {
        $transaction = Transaction::findOrFail($id);
        $pdf = PDF::loadView('pdf.transaction' , compact('transaction') , [] , [ 'format' => 'A5-L' ]);
        return $pdf->stream('t-' . $transaction->id . '.pdf');
    }
}
