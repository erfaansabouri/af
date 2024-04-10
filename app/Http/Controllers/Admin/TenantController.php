<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TenantController extends Controller {
    public function index ( Request $request ) {
        $records = Tenant::query()
                         ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                             $search = $request->get('search');
                             $query->where('id' , 'like' , '%' . $search . '%')
                                   ->orWhere('name' , 'like' , '%' . $search . '%')
                                   ->orWhere('plaque' , 'like' , '%' . $search . '%')
                                   ->orWhere('owner_first_name' , 'like' , '%' . $search . '%')
                                   ->orWhere('owner_last_name' , 'like' , '%' . $search . '%')
                                   ->orWhere('username' , 'like' , '%' . $search . '%');
                         })
                         ->orderByDesc('id')
                         ->get();

        return view('metronic.admin.tenants.index' , compact('records'));
    }

    public function create () {
        return view('metronic.admin.tenants.form');
    }

    public function store ( Request $request ) {
        $record = new Tenant();
        $this->save($record , $request);

        return redirect()->route('admin.tenants.index');
    }

    public function edit ( $id ) {
        $record = Tenant::query()
                        ->findOrFail($id);

        return view('metronic.admin.tenants.form' , compact('record'));
    }

    public function update ( Request $request , $id ) {
        $record = Tenant::query()
                        ->findOrFail($id);
        $this->save($record , $request);

        return redirect()->route('admin.tenants.index');
    }

    public function save ( Tenant $record , Request $request ) {
        $request->validate([
                               'plaque' => [ 'required' ] ,
                           ]);
        $record->plaque = $request->get('plaque');
        $record->name = $request->get('name');
        $record->owner_first_name = $request->get('owner_first_name');
        $record->owner_last_name = $request->get('owner_last_name');
        $record->username = $request->get('username');
        if ( $password = $request->get('password') ) {
            $record->password = bcrypt($password);
        }
        $record->save();
    }

    public function destroy ( $id ) {
        $record = Tenant::query()
                        ->findOrFail($id);
        $record->delete();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت حذف شد.' , 'تبریک!');

        return redirect()->route('admin.tenants.index');
    }
}
