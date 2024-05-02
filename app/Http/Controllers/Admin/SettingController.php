<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SettingController extends Controller {
    public function index ( Request $request ) {
        $records = Setting::query()
                          ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                              $search = $request->get('search');
                              $query->where('id' , 'like' , '%' . $search . '%');
                          })
                          ->orderByDesc('id')
                          ->get();

        return view('metronic.admin.settings.index' , compact('records'));
    }

    public function edit ( $id ) {
        $record = Setting::query()
                         ->findOrFail($id);

        return view('metronic.admin.settings.form' , compact('record'));
    }

    public function update ( Request $request , $id ) {
        $record = Setting::query()
                         ->findOrFail($id);
        $this->save($record , $request);
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت بروز شد.' , 'تبریک!');

        return redirect()->route('admin.complex-settings.settings.index');
    }

    public function save ( Setting $record , Request $request ) {
        $record->max_warning_threshold = $request->max_warning_threshold;
        $record->min_debt_amount = $request->min_debt_amount;
        $record->penalty_percent = $request->penalty_percent;
        $record->save();

        return $record;
    }

    public function destroy ( $id ) {
        $record = Setting::query()
                         ->findOrFail($id);
        $record->delete();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت حذف شد.' , 'تبریک!');

        return redirect()->route('admin.complex-settings.settings.index');
    }
}
