<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DailyLogByDateExport;
use App\Exports\DailyLogByPlaqueExport;
use App\Exports\PropertyExport;
use App\Http\Controllers\Controller;
use App\Models\DailyLog;
use App\Models\Property;
use App\Models\Tenant;
use App\Services\Convert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PropertyController extends Controller {
    public function index ( Request $request ) {
        return view('metronic.admin.properties.index');
    }

    public function submit ( Request $request ) {
        $request->validate([
                               'plaque' => [ 'required' ] ,
                               'full_name' => [ 'required' ] ,
                               'phone' => [ 'required' ] ,
                               'type' => [ 'required' ] ,
                               'started_at' => [ 'required' ] ,
                               'ended_at' => [ 'nullable' ] ,
                           ]);
        $plaque = Convert::convertToEnNumbers($request->get('plaque'));
        $full_name = $request->get('full_name');
        $phone = $request->get('phone');
        $type = $request->get('type');
        $started_at = Carbon::createFromTimestamp(Convert::jalaliToTimestamp($request->get('started_at')))
                            ->format("Y-m-d");
        if ( $request->get('ended_at') ) {
            $ended_at = Carbon::createFromTimestamp(Convert::jalaliToTimestamp($request->get('ended_at')))
                              ->format("Y-m-d");
        }
        else {
            $ended_at = null;
        }
        $tenant = Tenant::query()
                        ->findOrFail($plaque);
        Property::query()
                ->create([
                             'tenant_id' => $tenant->id ,
                             'plaque' => $plaque ,
                             'full_name' => $full_name ,
                             'phone' => $phone ,
                             'type' => $type ,
                             'started_at' => $started_at ,
                             'ended_at' => $ended_at ,
                         ]);
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت ذخیره شد.' , 'تبریک!');

        return redirect()->back();
    }

    public function exportByPlaque ( Request $request ) {
        $request->validate([
                               'plaque' => [ 'required' ] ,
                           ]);
        $plaque = Convert::convertToEnNumbers($request->get('plaque'));
        $tenant = Tenant::query()
                        ->findOrFail($plaque);
        $properties = Property::query()
                              ->where('tenant_id' , $tenant->id)
                              ->get();

        return Excel::download(new PropertyExport($properties) , $tenant->id . '-properties-by-plaque.xlsx');
    }

    public function exportEndedAt ( Request $request ) {

        $properties = Property::query()
                              ->whereNotNull('ended_at')
                              ->orderBy('ended_at' , 'asc')
                              ->get();

        return Excel::download(new PropertyExport($properties) , 'properties-ended-at.xlsx');
    }

    public function exportAll ( Request $request ) {

        $properties = Property::query()
                              ->orderBy('started_at' , 'asc')
                              ->get();

        return Excel::download(new PropertyExport($properties) , 'properties-all.xlsx');
    }
}
