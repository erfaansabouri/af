<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MonthlyCharge;
use App\Models\Tenant;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TenantController extends Controller {
    public function index ( Request $request ) {
        $records = Tenant::query()
                         ->with([
                                    'tenantType' ,
                                    'floor' ,
                                ])
                         ->withCount([ 'warnings' ])
                         ->when($request->get('search') , function ( Builder $query ) use ( $request ) {
                             $search = $request->get('search');
                             $query->where('id' , 'like' , '%' . $search . '%')
                                   ->orWhere('name' , 'like' , '%' . $search . '%')
                                   ->orWhere('plaque' , 'like' , '%' . $search . '%')
                                   ->orWhere('owner_first_name' , 'like' , '%' . $search . '%')
                                   ->orWhere('owner_last_name' , 'like' , '%' . $search . '%')
                                   ->orWhere('username' , 'like' , '%' . $search . '%');
                         })
                         ->orderByDesc('id')
                         ->get();

        return view('metronic.admin.tenants.index' , compact('records'));
    }

    public function create () {
        return view('metronic.admin.tenants.form');
    }

    public function store ( Request $request ) {
        $record = new Tenant();
        $this->save($record , $request);
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت ایجاد شد.' , 'تبریک!');

        return redirect()->route('admin.tenants.index');
    }

    public function edit ( $id ) {
        $record = Tenant::query()
                        ->findOrFail($id);

        return view('metronic.admin.tenants.form' , compact('record'));
    }

    public function update ( Request $request , $id ) {
        $record = Tenant::query()
                        ->findOrFail($id);
        $this->save($record , $request);
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت بروز شد.' , 'تبریک!');

        return redirect()->route('admin.tenants.index');
    }

    public function save ( Tenant $record , Request $request ) {
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
        $record->debt_amount = $request->get('debt_amount');
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
        $tenant = Tenant::query()
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

        return view('metronic.admin.tenants.monthly-charges.index' , compact('tenant' , 'records'));
    }

    public function setDefaultPassword ( $id ) {
        $tenant = Tenant::query()
                        ->findOrFail($id);
        $tenant->password = bcrypt($tenant->default_password);
        $tenant->save();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('رکورد با موفقیت بروز رسانی شد.' , 'تبریک!');

        return redirect()->route('admin.tenants.index');
    }

    public function fakeTransaction ( Request $request ) {
        $request->validate([
                               'paid_amount' => [
                                   'required' ,
                                   'integer' ,
                               ] ,
                               'tenant_id' => ['required']
                           ]);
        $paid_amount = $request->get('paid_amount');
        $tenant = Tenant::query()
                        ->findOrFail($request->get('tenant_id'));
        $transaction = Transaction::query()
                                  ->create([
                                               'tenant_id' => $tenant->id ,
                                               'monthly_charge_id' => null ,
                                               'original_amount' => $paid_amount ,
                                               'amount' => $paid_amount ,
                                               'subject' => 'بدهی' ,
                                           ]);
        $transaction->paid_at = now();
        $transaction->is_fake = true;
        $transaction->ref_id = 'ADMIN-PAY' . rand();
        $transaction->save();

        # اگر بیشتر از یک شارژ پایه بود ، یک شارژ رو پرداخت کن
        if ($paid_amount >= $tenant->monthly_charge_amount){
            $monthly_charge = MonthlyCharge::query()
                ->where('tenant_id', $tenant->id)
                ->whereNull('paid_amount')
                ->orderBy('month')
                ->first();

            if ($monthly_charge){
                $monthly_charge->paid_amount = $paid_amount;
                $monthly_charge->paid_at = now();
                $monthly_charge->save();
                $transaction->subject = 'شارژ ماهیانه';
                $transaction->monthly_charge_id = $monthly_charge->id;
                $transaction->save();
            }
        }

        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('پرداخت با موفقیت انجام شد.' , 'تبریک!');

        return redirect()->route('admin.tenants.monthly-charges' , $tenant->id);
    }
}
