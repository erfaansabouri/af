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

    public function updatePhoneNumber ( Request $request ) {
        $record = Auth::guard('tenant')
                      ->user();
        $record->phone_number = $request->get('phone_number');
        $record->save();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('شماره با موفقیت بروز شد.' , 'تبریک!');

        return redirect()->route('tenant.dashboard.dashboard');
    }

    public function save ( Tenant $record , Request $request ) {
        $request->validate([
                               'name' => [ 'nullable' ] ,
                               'owner_first_name' => [ 'nullable' ] ,
                               'owner_last_name' => [ 'nullable' ] ,
                               'phone_number' => [ 'nullable' ] ,
                           ]);
        $record->name = $request->get('name');
        $record->owner_first_name = $request->get('owner_first_name');
        $record->owner_last_name = $request->get('owner_last_name');
        $record->phone_number = $request->get('phone_number');
        $record->activity_type = $request->get('activity_type');
        $record->save();

        if ( $password = $request->get('password') ) {
            $record->password = bcrypt($password);
        }
        if ( $request->hasFile('image') ) {
            $record->addMediaFromRequest('image')
                   ->toMediaCollection('image');
        }
        $record->save();
    }
}
