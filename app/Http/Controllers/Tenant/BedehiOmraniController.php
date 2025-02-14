<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\BedehiOmrani;
use App\Models\Debt;
use App\Models\HazineOmrani;
use App\Models\MonthlyCharge;
use Auth;
use Illuminate\Http\Request;

class BedehiOmraniController extends Controller {
    public function index ( Request $request ) {
        $tenant = Auth::guard('tenant')
                      ->user();

        $bedehi_omranis = BedehiOmrani::query()
                                      ->where('tenant_id' , $tenant->id)
                                      ->get();

        $hazine_omranis = HazineOmrani::query()
                     ->where('tenant_id' , $tenant->id)
                     ->get();

        return view('metronic.tenant.bedehi-omranis.index' , compact( 'bedehi_omranis','hazine_omranis'));
    }
}
