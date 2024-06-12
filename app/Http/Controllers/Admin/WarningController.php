<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Transaction;
use App\Models\Warning;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class WarningController extends Controller {
    public function index ( Request $request ) {
        $records = Warning::query()
                          ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                              $search = $request->get('search');
                              $query->where('id' , 'like' , '%' . $search . '%')
                                    ->orWhere('tenant_id' , 'like' , '%' . $search . '%');
                          })
                          ->when($request->get('tenant_id') , function ( Builder $query ) use ( $request ) {
                              $query->where('tenant_id' , $request->get('tenant_id'));
                          })
                          ->orderByDesc('id')
                          ->get();

        return view('metronic.admin.warnings.index' , compact('records'));
    }

    public function destroy ( Request $request, $id ) {
        $request->validate([
            'key' => ['required'],
                           ]);

        if ($request->get('key') == '4113'){
            $record = Warning::query()
                             ->findOrFail($id);
            $record->delete();
            flash()
                ->options([
                              'timeout' => 3000 ,
                              'position' => 'top-left' ,
                          ])
                ->addSuccess('رکورد با موفقیت حذف شد.' , 'تبریک!');

            return redirect()->route('admin.warnings.index');
        }else{
            flash()
                ->options([
                              'timeout' => 3000 ,
                              'position' => 'top-left' ,
                          ])
                ->addError('رمز نادرست' , 'خطا');

            return redirect()->route('admin.warnings.index');
        }


    }
}
