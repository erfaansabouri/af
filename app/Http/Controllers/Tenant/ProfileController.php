<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProfileController extends Controller {
    public function edit () {
        $record = Auth::guard('tenant')
                      ->user();

        return view('metronic.tenant.profile.form' , compact('record'));
    }

    public function update ( Request $request ) {
        $record = Auth::guard('tenant')
                      ->user();
        $this->save($record , $request);
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت بروز شد.' , 'تبریک!');

        return redirect()->route('tenant.profile.edit');
    }

    public function save ( Tenant $record , Request $request ) {
        $request->validate([
                               'name' => [ 'required' ] ,
                               'owner_first_name' => [ 'required' ] ,
                               'owner_last_name' => [ 'required' ] ,
                               'phone_number' => [ 'required' ] ,
                           ]);
        $record->name = $request->get('name');
        $record->owner_first_name = $request->get('owner_first_name');
        $record->owner_last_name = $request->get('owner_last_name');
        $record->phone_number = $request->get('phone_number');
        if ( $password = $request->get('password') ) {
            $record->password = bcrypt($password);
        }
        $record->save();
    }
}
