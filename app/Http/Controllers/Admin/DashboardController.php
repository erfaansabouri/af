<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
 public function dashboard(){
    $view = \Cache::remember('dashboard_view', 60, function() {
        return view('metronic.admin.dashboard.dashboard')->render();
    });
    return $view;
}
}
