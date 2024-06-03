<?php

namespace App\Exports;

use App\Models\Tenant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PowerOutageExport implements FromView {
    public function __construct () {

    }

    public function view (): View {
        $tenants = Tenant::query()
                         ->withUnpaidChargesCount()
                         ->having('unpaid_charges_count' , '>' , 2)
                         ->get();

        return view('exports.debt' , [
            'tenants' => $tenants ,
        ]);
    }
}
