<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\MessageGroup;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MessageGroupController extends Controller {
    public function index ( Request $request ) {
        $records = MessageGroup::query()

                         ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                             $search = $request->get('search');
                             $query->where('id' , 'like' , '%' . $search . '%')
                                   ->orWhere('message' , 'like' , '%' . $search . '%');
                         })
                         ->orderByDesc('id')
                         ->get();

        return view('metronic.admin.group-messages.index' , compact('records'));
    }

    public function save ( MessageGroup $record , Request $request ) {
        $request->validate([
                               'message' => [ 'required' ] ,
                           ]);
        $record->message = $request->get('message');
        $record->save();
        return $record;
    }

    public function destroy ( $id ) {
        $record = MessageGroup::query()
                        ->findOrFail($id);
        $record->delete();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت حذف شد.' , 'تبریک!');

        return redirect()->route('admin.complex-settings.message-groups.index');
    }

    public function createSendToAll(){
        return view('metronic.admin.group-messages.create-send-to-all');
    }

    public function submitSendToAll ( Request $request ) {
        $record = new MessageGroup();
        $message_group = $this->save($record , $request);
        $items = [];
        foreach ( Tenant::all() as $tenant ) {
            $items[] = [
                'tenant_id' => $tenant->id ,
                'message_group_id' => $message_group->id ,
                'message' => $message_group->message ,
                'created_at' => now() ,
                'updated_at' => now() ,
            ];
        }
        Message::query()
               ->insert($items);
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت ایجاد شد.' , 'تبریک!');

        return redirect()->route('admin.complex-settings.message-groups.index');
    }
}
