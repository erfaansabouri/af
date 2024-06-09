<?php

namespace App\Exports;

use App\Models\Tenant;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DebtExport implements FromView {
    public function __construct () {

    }

    public function view (): View {
        $tenants = Tenant::query()
                         ->whereHas('debts' , function ( $query ) {
                             $query->whereNull('paid_at');
                         })
                         ->orWhereHas('warnings')
                         ->orWhereHas('monthlyCharges' , function ( $q ) {
                             $q->notPaid()
                               ->dueDatePassed();
                         })
                         ->get();

        return view('exports.debt' , [
            'tenants' => $tenants ,
        ]);
    }
}
