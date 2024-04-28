<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller {
    public function index ( Request $request ) {
        $records = Transaction::query()
                              ->where('tenant_id' , Auth::guard('tenant')
                                                        ->id())
                              ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                                  $search = $request->get('search');
                                  $query->where('tx_id' , 'like' , '%' . $search . '%');
                              })
                              ->orderByDesc('id')
                              ->get();

        return view('metronic.tenant.transactions.index' , compact('records'));
    }
}
