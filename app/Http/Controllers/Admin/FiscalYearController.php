<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FiscalYear;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FiscalYearController extends Controller {
    public function index ( Request $request ) {
        $records = FiscalYear::query()
                         ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                             $search = $request->get('search');
                             $query->where('id' , 'like' , '%' . $search . '%')
                                   ->orWhere('year' , 'like' , '%' . $search . '%');
                         })
                         ->orderByDesc('id')
                         ->get();

        return view('metronic.admin.fiscal-years.index' , compact('records'));
    }

    public function create () {
        return view('metronic.admin.fiscal-years.form');
    }

    public function store ( Request $request ) {
        $record = new FiscalYear();
        $this->save($record , $request);

        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت ایجاد شد.' , 'تبریک!');

        return redirect()->route('admin.fiscal-years.index');
    }

    public function edit ( $id ) {
        $record = FiscalYear::query()
                        ->findOrFail($id);

        return view('metronic.admin.fiscal-years.form' , compact('record'));
    }

    public function update ( Request $request , $id ) {
        $record = FiscalYear::query()
                        ->findOrFail($id);
        $this->save($record , $request);

        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت بروز شد.' , 'تبریک!');

        return redirect()->route('admin.fiscal-years.index');
    }

    public function save ( FiscalYear $record , Request $request ) {
        $request->validate([
                               'year' => [ 'required', 'unique:fiscal_years,year' ] ,
                               'started_at' => [ 'required' ] ,
                               'ended_at' => [ 'required' ] ,
                           ]);
        $record->year = $request->get('year');
        $record->started_at = Carbon::createFromTimestamp($request->get('started_at'));
        $record->ended_at = Carbon::createFromTimestamp($request->get('ended_at'));
        $record->save();
    }

    public function destroy ( $id ) {
        $record = FiscalYear::query()
                        ->findOrFail($id);
        $record->delete();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت حذف شد.' , 'تبریک!');

        return redirect()->route('admin.fiscal-years.index');
    }
}
