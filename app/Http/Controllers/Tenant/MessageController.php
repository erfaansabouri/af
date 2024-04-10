<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Auth;
use Illuminate\Http\Request;

class MessageController extends Controller {
    public function index ( Request $request ) {
        $tenant = Auth::guard('tenant')
                      ->user();
        $records = $tenant->messages()
                          ->when($request->get('search') , function ( $query ) use ( $request ) {
                              $query->where('message' , 'like' , '%' . $request->search . '%');
                          })
                          ->orderBy('seen_at')
                          ->orderByDesc('id')
                          ->get();

        return view('metronic.tenant.messages.index' , compact('records'));
    }

    public function seen ( $id ) {
        $tenant = Auth::guard('tenant')
                      ->user();
        Message::query()
               ->where([
                           'tenant_id' => $tenant->id ,
                           'id' => $id ,
                       ])
               ->update([ 'seen_at' => now() ]);
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت بروز شد.' , 'تبریک!');

        return redirect()->route('tenant.messages.index');
    }
}
