<?php

namespace App\Exports;

use App\Models\HazineOmrani;
use App\Models\Tenant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HazineOmraniExport implements FromView {
    public function __construct () {

    }

    public function view (): View {
        $tenants = Tenant::query()
            ->with(['hazineOmranis'])
            ->whereHas('hazineOmranis')
            ->get();

        return view('exports.hazine-omrani' , [
            'tenants' => $tenants ,
        ]);
    }
}
