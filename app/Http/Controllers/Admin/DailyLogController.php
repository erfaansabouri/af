<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DailyLogByDateExport;
use App\Exports\DailyLogByPlaqueExport;
use App\Exports\HazineOmraniExport;
use App\Http\Controllers\Controller;
use App\Models\DailyLog;
use App\Models\Tenant;
use App\Services\Convert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DailyLogController extends Controller {
    public function index ( Request $request ) {
        return view('metronic.admin.daily-logs.index');
    }

    public function submit ( Request $request ) {
        $request->validate([
                               'plaque' => [ 'required' ] ,
                               'status' => [ 'required' ] ,
                               'date' => ['required'],
                               'time' => ['required'],
                           ]);
        $request_date = verta(Carbon::createFromTimestamp($request->get('date'))->format("Y-m-d"))->format('Y/m/d');

        \Illuminate\Support\Facades\Cache::put('request_date', $request_date, 60);

        // Optionally, you can retrieve the cached value later like this:
        // $cachedDate = \Illuminate\Support\Facades\Cache::get('request_date')
        //save it in cache
        $date = Carbon::createFromTimestamp($request->get('date'))->format("Y-m-d");
        $plaque = Convert::convertToEnNumbers($request->get('plaque'));
        $tenant = Tenant::query()->findOrFail($plaque);
        DailyLog::query()
                ->updateOrCreate([
                                     'tenant_id' => $tenant->id ,
                                     'date' => $date ,
                                     'time' => $request->get('time'),
                                 ] , [
                                     'status' => $request->get('status'),
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
