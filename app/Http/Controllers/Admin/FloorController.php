<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FloorController extends Controller {
    public function index ( Request $request ) {
        $records = Floor::query()
                         ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                             $search = $request->get('search');
                             $query->where('id' , 'like' , '%' . $search . '%')
                                   ->orWhere('floor' , 'like' , '%' . $search . '%')
                                   ->orWhere('floor_fa' , 'like' , '%' . $search . '%');
                         })
                         ->orderByDesc('id')
                         ->get();

        return view('metronic.admin.floors.index' , compact('records'));
    }


    public function edit ( $id ) {
        $record = Floor::query()
                        ->findOrFail($id);

        return view('metronic.admin.floors.form' , compact('record'));
    }

    public function update ( Request $request , $id ) {
        $record = Floor::query()
                        ->findOrFail($id);
        $this->save($record , $request);

        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت بروز شد.' , 'تبریک!');

        return redirect()->route('admin.complex-settings.floors.index');
    }

    public function save ( Floor $record , Request $request ) {

    }

    public function destroy ( $id ) {
        $record = Floor::query()
                        ->findOrFail($id);
        $record->delete();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت حذف شد.' , 'تبریک!');

        return redirect()->route('admin.complex-settings.floors.index');
    }
}
