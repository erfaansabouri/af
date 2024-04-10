<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:tenant')->except('logout');
    }

    public function loginForm()
    {
        $page_info = [
            'title' => 'ورود به سامانه کاربران',
            'login_route' => route('tenant.auth.login')
        ];
        return view('metronic.auth.login', compact('page_info'));
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('tenant')
                ->attempt(['username' => $request->username, 'password' => $request->password , 'can_login' => 1])
        ) {
            return redirect()->route('tenant.dashboard.dashboard');
        }
        flash()->rtl(true)->addError('اطلاعات نامعتبر است!');
        return redirect()->back();
    }


    public function logout()
    {
        Auth::guard('tenant')->logout();
        return redirect()->route('tenant.auth.login-form');
    }
}
