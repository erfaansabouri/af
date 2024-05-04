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

    public function __construct ( $started_at , $ended_at , $tenant_type_id ) {
        $this->started_at = $started_at;
        $this->ended_at = $ended_at;
        $this->tenant_type_id = $tenant_type_id;
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
                                         ->orderByDesc('id')
                                         ->get() ,
        ]);
    }
}
