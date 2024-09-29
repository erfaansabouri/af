<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Models\MonthlyCharge;
use App\Models\OtherDebt;
use App\Models\OtherMonthlyCharge;
use Auth;
use Illuminate\Http\Request;

class MonthlyChargeController extends Controller {
    public function index ( Request $request ) {
        $other = Auth::guard('other')
                     ->user();
        $records = OtherMonthlyCharge::query()
                                     ->when($request->get('search') , function ( $query ) use ( $request ) {
                                         $query->where(function ( $q ) use ( $request ) {
                                             $q->where('id' , 'like' , '%' . $request->search . '%');
                                         });
                                     })
                                     ->where('other_id' , $other->id)
                                     ->orderBy('due_date')
                                     ->get();
        $debts = OtherDebt::query()
                          ->where('other_id' , $other->id)
                          ->get();

        return view('metronic.other.monthly-charges.index' , compact('records' , 'debts'));
    }
}
