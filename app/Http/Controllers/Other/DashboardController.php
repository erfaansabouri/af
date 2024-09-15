<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Warning;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('metronic.other.dashboard.dashboard');
    }
}
