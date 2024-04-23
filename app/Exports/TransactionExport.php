<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionExport implements FromView {
    public $started_at;
    public $ended_at;

    public function __construct ( $started_at , $ended_at ) {
        $this->started_at = $started_at;
        $this->ended_at = $ended_at;
    }

    public function view (): View {
        return view('exports.transactions' , [
            'transactions' => Transaction::query()
                                         ->paid()
                                         ->whereBetween('paid_at' , [
                                             $this->started_at ,
                                             $this->ended_at,
                                         ])
                                         ->orderByDesc('id')
                                         ->get(),
        ]);
    }
}
