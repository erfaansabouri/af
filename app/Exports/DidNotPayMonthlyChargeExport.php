<?php

namespace App\Exports;

use App\Models\Tenant;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromView;

class DidNotPayMonthlyChargeExport implements FromView {
    public $month;

    public function __construct ( $month ) {
        $this->month = $month;
    }

    public function view (): View {
        return view('exports.did-not-pay-monthly-charge' , [
            'tenants' => Tenant::query()
                               ->whereDoesntHave('monthlyCharges' , function ( $query ) {
                                   $query->paid()
                                         ->where('month' , $this->month);
                               })->get(),
            'month' => $this->month
        ]);
    }
}
