<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessageGroup;
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

    public function create () {
        return view('metronic.admin.group-messages.form');
    }

    public function store ( Request $request ) {
        $record = new MessageGroup();
        $this->save($record , $request);

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

        return view('metronic.admin.group-messages.form' , compact('record'));
    }

    public function update ( Request $request , $id ) {
        $record = MessageGroup::query()
                        ->findOrFail($id);
        $this->save($record , $request);

        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت بروز شد.' , 'تبریک!');

        return redirect()->route('admin.complex-settings.message-groups.index');
    }

    public function save ( MessageGroup $record , Request $request ) {
        $request->validate([
                               'message' => [ 'required' ] ,
                           ]);
        $record->message = $request->get('message');
        $record->save();
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
}
