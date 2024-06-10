<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionExport implements FromView {
    public $started_at;
    public $ended_at;
    public $tenant_type_id;
    public $paid_via;

    public function __construct ( $started_at , $ended_at , $tenant_type_id , $paid_via ) {
        $this->started_at = $started_at;
        $this->ended_at = $ended_at;
        $this->tenant_type_id = $tenant_type_id;
        $this->paid_via = $paid_via;
    }

    public function view (): View {
        return view('exports.transactions' , [
            'transactions' => Transaction::query()
                                         ->paid()
                                         ->whereBetween('paid_at' , [
                                             $this->started_at ,
                                             $this->ended_at ,
                                         ])
                                         ->when($this->tenant_type_id , function ( Builder $query ) {
                                             $query->whereHas('tenant' , function ( $q ) {
                                                 $q->where('tenant_type_id' , $this->tenant_type_id);
                                             });
                                         })
                                         ->when($this->paid_via , function ( Builder $query ) {
                                             $query->where('paid_via' , $this->paid_via);
                                         })
                                         ->orderByDesc('id')
                                         ->get() ,
        ]);
    }
}
