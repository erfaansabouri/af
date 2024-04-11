<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('metronic.tenant.dashboard.dashboard');
    }
}
