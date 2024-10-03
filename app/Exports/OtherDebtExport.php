<?php

namespace App\Exports;

use App\Models\Other;
use App\Models\Tenant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OtherDebtExport implements FromView {
    public function __construct () {

    }

    public function view (): View {
        $others = Other::query()
                       ->whereHas('otherDebts' , function ( $query ) {
                           $query->whereNull('paid_at');
                       })
                       ->orWhereHas('otherMonthlyCharges' , function ( $q ) {
                           $q->notPaid()
                             ->dueDatePassed();
                       })
                       ->get();

        return view('exports.other-debt' , [
            'others' => $others ,
        ]);
    }
}
