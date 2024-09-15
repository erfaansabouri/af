<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function __construct () {
        $this->middleware('guest:other')
             ->except('logout');
    }

    public function loginForm () {
        $page_info = [
            'title' => 'ورود به سامانه متفرقه' ,
            'login_route' => route('other.auth.login'),
        ];

        return view('metronic.auth.login' , compact('page_info'));
    }

    public function login ( Request $request ) {
        Auth::guard('admin')
            ->logout();
        Auth::guard('tenant')
            ->logout();
        $this->validate($request , [
            'username' => 'required' ,
            'password' => 'required',
        ]);
        if ( Auth::guard('other')
                 ->attempt([
                               'username' => $request->username ,
                               'password' => $request->password ,
                           ] , (boolean)$request->remember) ) {
            return redirect()->route('other.dashboard.dashboard');
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
        Auth::guard('other')
            ->logout();

        return redirect()->route('other.auth.login-form');
    }
}
