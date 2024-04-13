<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function __construct () {
        $this->middleware('guest:admin')
             ->except('logout');
    }

    public function loginForm () {
        $page_info = [
            'title' => 'ورود به سامانه مدیریت' ,
            'login_route' => route('admin.auth.login'),
        ];

        return view('metronic.auth.login' , compact('page_info'));
    }

    public function login ( Request $request ) {
        Auth::guard('tenant')
            ->logout();

        $this->validate($request , [
            'username' => 'required' ,
            'password' => 'required',
        ]);
        if ( Auth::guard('admin')
                 ->attempt([
                               'username' => $request->username ,
                               'password' => $request->password ,
                               'can_login' => 1,
                           ]) ) {
            return redirect()->route('admin.dashboard.dashboard');
        }
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addError('اطلاعات صحیح نمیباشد' , 'خطا!');

        return redirect()->back();
    }

    public function logout () {
        Auth::guard('admin')
            ->logout();

        return redirect()->route('admin.auth.login-form');
    }
}
