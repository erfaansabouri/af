<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DebtExport;
use App\Exports\PowerOutageExport;
use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller {
    public function debt ( Request $request ) {
        return Excel::download(new DebtExport() , 'debt.xlsx');
    }

    public function powerOutage ( Request $request ) {
        return Excel::download(new PowerOutageExport() , 'power-outage.xlsx');
    }
}
