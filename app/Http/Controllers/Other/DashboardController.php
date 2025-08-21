<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\OtherFinancialPeriodLog;
use App\Models\Warning;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        $other = \auth('other')->user();
        $ended_financials = OtherFinancialPeriodLog::query()
            ->whereHas('other')
            ->where('ended_at', '<', now())
            ->where('other_id', $other->id)
            ->get();
        return view('metronic.other.dashboard.dashboard', compact('ended_financials'));
    }
}
