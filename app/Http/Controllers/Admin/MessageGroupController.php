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
        Message::query()
               ->where('message_group_id' , $id)
               ->delete();
        $record->delete();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت حذف شد.' , 'تبریک!');

        return redirect()->route('admin.complex-settings.message-groups.index');
    }

    public function createSendToAll () {
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

    public function createFloor () {
        return view('metronic.admin.group-messages.create-floor');
    }

    public function submitFloor ( Request $request ) {
        $request->validate([
                               'floor_id' => [ 'required' ] ,
                           ]);
        $record = new MessageGroup();
        $message_group = $this->save($record , $request);
        $items = [];
        foreach ( Tenant::where('floor_id' , $request->get('floor_id'))
                        ->get() as $tenant ) {
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

    public function createTenantType () {
        return view('metronic.admin.group-messages.create-tenant-type');
    }

    public function submitTenantType ( Request $request ) {
        $request->validate([
                               'tenant_type_id' => [ 'required' ] ,
                           ]);
        $record = new MessageGroup();
        $message_group = $this->save($record , $request);
        $items = [];
        foreach ( Tenant::where('tenant_type_id' , $request->get('tenant_type_id'))
                        ->get() as $tenant ) {
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

    public function createSingleTenant () {
        return view('metronic.admin.group-messages.create-single-tenant');
    }

    public function submitSingleTenant ( Request $request ) {
        $request->validate([
                               'plaque' => [ 'required' ] ,
                           ]);
        $record = new MessageGroup();
        $message_group = $this->save($record , $request);
        $items = [];
        foreach ( Tenant::where('plaque' , $request->get('plaque'))
                        ->get() as $tenant ) {
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

    public function edit ( $id ) {
        $record = MessageGroup::query()
                              ->findOrFail($id);

        return view('metronic.admin.group-messages.create-send-to-all' , compact('record'));
    }

    public function update ( Request $request , $id ) {
        $record = MessageGroup::query()
                              ->findOrFail($id);
        $message_group = $this->save($record , $request);
        Message::query()
               ->where('message_group_id' , $record->id)
               ->update([
                            'message' => $request->get('message') ,
                        ]);
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت ایجاد شد.' , 'تبریک!');

        return redirect()->route('admin.complex-settings.message-groups.index');
    }
}
