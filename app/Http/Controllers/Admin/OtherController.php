<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Other;
use App\Models\Tenant;
use App\Services\Convert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OtherController extends Controller {
    public function index ( Request $request ) {
        $records = Other::query()
                        ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                            $search = $request->get('search');
                            $query->where('id' , 'like' , '%' . $search . '%')
                                  ->orWhere('plaque' , 'like' , '%' . $search . '%')
                                  ->orWhere('description' , 'like' , '%' . $search . '%');
                        })
                        ->orderByDesc('id')
                        ->get();

        return view('metronic.admin.others.index' , compact('records'));
    }

    public function create () {
        return view('metronic.admin.others.create');
    }

    public function store ( Request $request ) {
        $request->validate([
                               'plaque' => [ 'required' ] ,
                               'description' => [ 'nullable' ] ,
                               'tenant_id' => [ 'nullable' ] ,
                               'monthly_charge_amount' => [ 'required' ] ,
                               'username' => [ 'required' ] ,
                               'password' => [ 'required' ] ,
                           ]);
        $record = new Other();
        $record->plaque = $request->get('plaque');
        $record->description = $request->get('description');
        $record->tenant_id = $request->get('tenant_id');
        $record->monthly_charge_amount = Convert::convertToEnNumbers($request->get('monthly_charge_amount'));
        $record->username = $request->get('username');
        $record->password = bcrypt($request->get('password'));
        $record->save();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت ایجاد شد.' , 'تبریک!');

        return redirect()->route('admin.others.index');
    }
}
