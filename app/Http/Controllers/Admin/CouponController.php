<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CouponController extends Controller {
    public function index ( Request $request ) {
        $records = Coupon::query()
                        ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                            $search = $request->get('search');
                            $query->where('id' , 'like' , '%' . $search . '%')
                                  ->orWhere('coupon' , 'like' , '%' . $search . '%')
                                  ->orWhere('coupon_fa' , 'like' , '%' . $search . '%');
                        })
                        ->orderByDesc('id')
                        ->get();

        return view('metronic.admin.coupons.index' , compact('records'));
    }


    public function edit ( $id ) {
        $record = Coupon::query()
                       ->findOrFail($id);

        return view('metronic.admin.coupons.form' , compact('record'));
    }

    public function update ( Request $request , $id ) {
        $record = Coupon::query()
                       ->findOrFail($id);
        $this->save($record , $request);

        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت بروز شد.' , 'تبریک!');

        return redirect()->route('admin.coupons.index');
    }

    public function save ( Coupon $record , Request $request ) {
        $request->validate([
                               'discount_percent' => [ 'required', 'numeric' ] ,
                           ]);
        $record->discount_percent = $request->get('discount_percent');
        $record->active = $request->get('active') == 'on';
        $record->save();
    }

    public function destroy ( $id ) {
        $record = Coupon::query()
                       ->findOrFail($id);
        $record->delete();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت حذف شد.' , 'تبریک!');

        return redirect()->route('admin.coupons.index');
    }
}
