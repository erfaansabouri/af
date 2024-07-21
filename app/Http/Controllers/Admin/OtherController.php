<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DidNotPayMonthlyChargeExport;
use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\Debt;
use App\Models\MonthlyCharge;
use App\Models\Other;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OtherController extends Controller {


    public function create () {
        return view('metronic.admin.others.form');
    }

    public function store ( Request $request ) {
        $record = new Other();
        $request->validate([
                               'plaque' => [ 'required' ] ,
                               'password' => [ 'required' ] ,
                               'type' => [ 'required' ] ,
                               'started_at' => [ 'required' ] ,
                               'ended_at' => [ 'required' ] ,
                               'monthly_charge_amount' => [
                                   'required' ,
                                   'numeric' ,
                               ] ,
                               'debt_amount' => [
                                   'required' ,
                                   'numeric' ,
                               ] ,
                           ]);
        $record->plaque = $request->get('plaque');
        $record->type = $request->get('type');
        $record->tenant_id = $request->get('tenant_id');
        $record->monthly_charge_started_at = Carbon::createFromTimestamp($request->get('started_at'))
                                                   ->startOfDay();
        $record->monthly_charge_ended_at = Carbon::createFromTimestamp($request->get('ended_at'))
                                                   ->endOfDay();
        $record->monthly_charge_amount = $request->get('monthly_charge_amount');
        $record->debt_amount = $request->get('debt_amount');
        $record->save();
        if ( $password = $request->get('password') ) {
            $record->password = bcrypt($password);
        }
        $record->save();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت ایجاد شد.' , 'تبریک!');

        return redirect()->route('admin.others.index');
    }

    public function index ( Request $request ) {
        $records = Other::query()
                        ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                            $search = $request->get('search');
                            $query->where('id' , 'like' , '%' . $search . '%')
                                  ->orWhere('plaque' , 'like' , '%' . $search . '%');
                        })
                        ->orderByDesc('id')
                        ->get();

        return view('metronic.admin.others.index' , compact('records'));
    }

    public function edit ( $id ) {
        $record = Other::query()
                       ->findOrFail($id);

        return view('metronic.admin.others.form' , compact('record'));
    }

    public function update ( Request $request , $id ) {
        $record = Other::query()
                       ->findOrFail($id);
        $request->validate([
                               'plaque' => [ 'required' ] ,
                               'password' => [ 'nullable' ] ,
                               'type' => [ 'required' ] ,
                               'debt_amount' => [
                                   'required' ,
                                   'numeric' ,
                               ] ,
                           ]);
        $record->plaque = $request->get('plaque');
        $record->type = $request->get('type');
        $record->tenant_id = $request->get('tenant_id');
        $record->debt_amount = $request->get('debt_amount');
        $record->save();
        if ( $password = $request->get('password') ) {
            $record->password = bcrypt($password);
        }
        $record->save();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت بروز شد.' , 'تبریک!');

        return redirect()->route('admin.others.index');
    }

    #####








    public function save ( Other $record , Request $request ) {
        $request->validate([
                               'plaque' => [ 'required' ] ,
                               'floor_id' => [ 'required' ] ,
                               'tenant_type_id' => [ 'required' ] ,
                               'monthly_charge_amount' => [
                                   'required' ,
                                   'numeric' ,
                               ] ,
                           ]);
        $record->plaque = $request->get('plaque');
        $record->name = $request->get('name');
        $record->owner_first_name = $request->get('owner_first_name');
        $record->owner_last_name = $request->get('owner_last_name');
        $record->phone_number = $request->get('phone_number');
        $record->floor_id = $request->get('floor_id');
        $record->tenant_type_id = $request->get('tenant_type_id');
        $record->meters = $request->get('meters');
        $record->monthly_charge_amount = $request->get('monthly_charge_amount');
        $record->activity_type = $request->get('activity_type');
        $record->save();
        if ( $password = $request->get('password') ) {
            $record->password = bcrypt($password);
        }
        if ( $request->hasFile('image') ) {
            $record->addMediaFromRequest('image')
                   ->toMediaCollection('image');
        }
        $record->save();
    }

    public function monthlyCharges ( Request $request , $id ) {
        $tenant = Other::query()
                        ->findOrFail($id);
        $records = MonthlyCharge::query()
                                ->when($request->get('search') , function ( $query ) use ( $request ) {
                                    $query->where(function ( $q ) use ( $request ) {
                                        $q->where('id' , 'like' , '%' . $request->search . '%')
                                          ->orWhere('month' , 'like' , '%' . $request->search . '%');
                                    });
                                })
                                ->where('tenant_id' , $id)
                                ->get();
        $debts = Debt::query()
                     ->where('tenant_id' , $tenant->id)
                     ->get();

        return view('metronic.admin.others.monthly-charges.index' , compact('tenant' , 'records' , 'debts'));
    }

    public function setDefaultPassword ( $id ) {
        $tenant = Other::query()
                        ->findOrFail($id);
        $tenant->password = bcrypt($tenant->default_password);
        $tenant->save();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت بروز رسانی شد.' , 'تبریک!');

        return redirect()->route('admin.others.index');
    }

    public function submitBestankari ( Request $request ) {
        $request->validate([
                               'amount' => [ 'required' ] ,
                               'tenant_id' => [ 'required' ] ,
                           ]);
        $tenant = Other::query()
                        ->findOrFail($request->get('tenant_id'));
        $amount = str_replace(',' , '' , $request->get('amount'));
        $result = $tenant->submitBestankari($amount);
        if ( $result ) {
            flash()
                ->options([
                              'timeout' => 3000 ,
                              'position' => 'top-left' ,
                          ])
                ->addSuccess('بستانکاری با موفقیت اعمال شد و از شارژ ماهیانه کاسته شد.' , 'تبریک');

            return redirect()->back();
        }
        else {
            flash()
                ->options([
                              'timeout' => 3000 ,
                              'position' => 'top-left' ,
                          ])
                ->addError('مبلغ بیش از حد مجاز' , 'خطا');

            return redirect()->back();
        }
    }

    public function restoreMonthlyCharge ( $id ) {
        $monthly_charge = MonthlyCharge::query()
                                       ->findOrFail($id);
        if ( $monthly_charge->paid_via != MonthlyCharge::PAID_VIA[ 'ADMIN' ] ) {

            flash()
                ->options([
                              'timeout' => 3000 ,
                              'position' => 'top-left' ,
                          ])
                ->addSuccess('شارژی که از طریق به پرداخت انجام شده باشد قابلیت بازگشت ندارد.' , 'خطا');

            return redirect()->back();
        }
        Transaction::query()
                   ->where('monthly_charge_id' , $monthly_charge->id)
                   ->delete();
        $monthly_charge->paid_via = null;
        $monthly_charge->original_amount = $monthly_charge->tenant->monthly_charge_amount;
        $monthly_charge->paid_amount = 0;
        $monthly_charge->paid_at = null;
        $monthly_charge->save();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('شارژ ماهیانه به حالت اولیه بازگشت.' , 'تبریک');

        return redirect()->back();
    }

    public function submitBedehkari ( Request $request ) {
        $request->validate([
                               'amount' => [ 'required' ] ,
                               'tenant_id' => [ 'required' ] ,
                               'reason' => [ 'required' ] ,
                           ]);
        $tenant = Other::query()
                        ->findOrFail($request->get('tenant_id'));
        $amount = str_replace(',' , '' , $request->get('amount'));
        $reason = $request->get('reason');
        $tenant->addDebt($amount , $reason , Debt::TYPES[ 'NORMAL' ]);
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('بدهی ایجاد شد.' , 'تبریک');

        return redirect()->back();
    }

    public function removeBedehkari ( Request $request , $id ) {
        $debt = Debt::query()
                    ->findOrFail($id);
        $debt->tenant->removeDebt($id);
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('بدهی حذف شد.' , 'تبریک');

        return redirect()->back();
    }
}
