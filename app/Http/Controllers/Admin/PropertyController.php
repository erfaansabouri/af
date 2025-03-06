<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DailyLogByDateExport;
use App\Exports\DailyLogByPlaqueExport;
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
                               'phone' => ['required'],
                               'type' => ['required'],
                               'started_at' => ['required'],
                               'ended_at' => ['nullable'],
                           ]);

        $plaque = Convert::convertToEnNumbers($request->get('plaque'));
        $full_name = $request->get('full_name');
        $phone = $request->get('phone');
        $type = $request->get('type');
        $started_at = Carbon::createFromTimestamp($request->get('started_at'))->format("Y-m-d");
        if ($request->get('ended_at')) {
            $ended_at = Carbon::createFromTimestamp($request->get('ended_at'))->format("Y-m-d");
        } else {
            $ended_at = null;
        }
        $tenant = Tenant::query()->findOrFail($plaque);

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

    public function exportByPlaque (Request $request) {
        $request->validate([
                               'plaque' => [ 'required' ] ,
                           ]);

        $plaque = Convert::convertToEnNumbers($request->get('plaque'));
        $tenant = Tenant::query()->findOrFail($plaque);

        return Excel::download(new DailyLogByPlaqueExport($tenant->id) , $tenant->id.'-by-plaque.xlsx');

    }

    public function exportByDate (Request $request) {
        $request->validate([
                               'started_at' => [ 'required' ] ,
                               'ended_at' => [ 'required' ] ,
                           ]);


        return Excel::download(new DailyLogByDateExport($request->get('started_at'), $request->get('ended_at')) , 'by-date.xlsx');

    }
}
