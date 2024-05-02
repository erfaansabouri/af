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
                         ->where('debt_amount' , '>' , 0)
                         ->orWhereHas('warnings')
                         ->orWhereHas('monthlyCharges' , function ( $q ) {
                             $q->notPaid()
                               ->dueDatePassed();
                         });

        return view('exports.debt' , [
            'tenants' => $tenants,
        ]);
    }
}
