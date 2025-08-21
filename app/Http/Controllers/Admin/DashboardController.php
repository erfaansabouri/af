<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OtherFinancialPeriodLog;
use Cache;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function dashboard () {
        $view = Cache::remember('dashboard_view' , 60 , function () {
            $ended_financials = OtherFinancialPeriodLog::query()
                                                       ->whereHas('other')
                                                       ->where('ended_at' , '<' , now())
                                                       ->get();

            return view('metronic.admin.dashboard.dashboard' , compact('ended_financials'))->render();
        });

        return $view;
    }
}
