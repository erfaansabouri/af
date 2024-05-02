<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Warning;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        $messages = Message::query()
            ->where('tenant_id', Auth::guard('tenant')->id())
            ->orderByDesc('id')
            ->get();
        $warnings = Warning::query()
            ->where('tenant_id', Auth::guard('tenant')->id())
            ->orderByDesc('id')
            ->get();
        return view('metronic.tenant.dashboard.dashboard', compact('messages', 'warnings'));
    }
}
