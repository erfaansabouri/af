<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Debt;
use App\Models\MonthlyCharge;
use App\Models\Other;
use App\Models\OtherDebt;
use App\Models\OtherFinancialPeriodLog;
use App\Models\OtherMonthlyCharge;
use App\Models\Tenant;
use App\Models\Transaction;
use App\Services\Convert;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OtherController extends Controller {
	public function index ( Request $request ) {
		$records = Other::query()
						->when($request->get('search') , function ( Builder $query ) use ( $request ) {
							$search = $request->get('search');
							$query->where('id' , 'like' , '%' . $search . '%')
								  ->orWhere('plaque' , 'like' , '%' . $search . '%')
								  ->orWhere('description' , 'like' , '%' . $search . '%');
						})
						->orderByDesc('id')
						->get();

		return view('metronic.admin.others.index' , compact('records'));
	}

	public function create () {
		return view('metronic.admin.others.create');
	}

	public function store ( Request $request ) {
		$request->validate([
							   'plaque' => [ 'required' ] ,
							   'description' => [ 'nullable' ] ,
							   'tenant_id' => [ 'nullable' ] ,
							   'monthly_charge_amount' => [ 'required' ] ,
							   'username' => [ 'required' ] ,
							   'password' => [ 'required' ] ,
						   ]);
		$record = new Other();
		$record->plaque = $request->get('plaque');
		$record->description = $request->get('description');
		$record->tenant_id = $request->get('tenant_id');
		$record->monthly_charge_amount = Convert::convertToEnNumbers($request->get('monthly_charge_amount'));
		$record->username = $request->get('username');
		$record->password = bcrypt($request->get('password'));
		$record->save();
		flash()
			->options([
						  'timeout' => 3000 ,
						  'position' => 'top-left' ,
					  ])
			->addSuccess('رکورد با موفقیت ایجاد شد.' , 'تبریک!');

		return redirect()->route('admin.others.index');
	}

	public function edit ( $id ) {
		$record = Other::query()
					   ->findOrFail($id);

		return view('metronic.admin.others.edit' , compact('record'));
	}

	public function update ( Request $request , $id ) {
		$request->validate([
							   'plaque' => [ 'required' ] ,
							   'description' => [ 'nullable' ] ,
							   'tenant_id' => [ 'nullable' ] ,
							   'monthly_charge_amount' => [ 'required' ] ,
							   'username' => [ 'required' ] ,
							   'password' => [ 'nullable' ] ,
						   ]);
		$record = Other::query()
					   ->findOrFail($id);
		$record->plaque = $request->get('plaque');
		$record->description = $request->get('description');
		$record->tenant_id = $request->get('tenant_id');
		$record->monthly_charge_amount = Convert::convertToEnNumbers($request->get('monthly_charge_amount'));
		$record->username = $request->get('username');
		if ( $request->get('password') ) {
			$record->password = bcrypt($request->get('password'));
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

	public function setDefaultPassword ( $id ) {
		$other = Other::query()
					  ->findOrFail($id);
		$other->password = bcrypt($other->default_password);
		$other->save();
		flash()
			->options([
						  'timeout' => 3000 ,
						  'position' => 'top-left' ,
					  ])
			->addSuccess('رکورد با موفقیت بروز رسانی شد.' , 'تبریک!');

		return redirect()->route('admin.others.index');
	}

	#
	public function financialPeriod ( $id ) {
		$record = Other::query()
					   ->findOrFail($id);

		return view('metronic.admin.others.financial-period' , compact('record'));
	}

	public function createFinancialPeriod ( Request $request , $id ) {
		$record = Other::query()
					   ->findOrFail($id);
		$request->validate([
							   'started_at' => [ 'required' ] ,
							   'ended_at' => [ 'required'] ,
						   ]);
		$started_at = Carbon::createFromTimestamp(Convert::jalaliToTimestamp($request->get('started_at')));
		$ended_at = Carbon::createFromTimestamp(Convert::jalaliToTimestamp($request->get('ended_at')));

        if ($started_at->greaterThan($ended_at)){
            flash()
                ->options([
                              'timeout' => 3000 ,
                              'position' => 'top-left' ,
                          ])
                ->addError('تاریخ شروع نمی تواند از تاریخ پایان بزرگتر باشد.' , 'خطا');

            return redirect()->back();
        }

        OtherFinancialPeriodLog::query()
            ->create([
                         'other_id' => $id ,
                         'started_at' => $started_at ,
                         'ended_at' => $ended_at ,
                     ]);

		$i = 1;
		while ( 1 ) {
			$due_date = verta($started_at)
				->addMonths($i - 1)
				->startMonth()
				->toCarbon();
			if ($due_date->greaterThan($ended_at)){
				break;
			}
			OtherMonthlyCharge::query()
						 ->create([
											 'other_id' => $id ,
											 'original_amount' => $record->monthly_charge_amount ,
											 'amount' => $record->monthly_charge_amount ,
											 'due_date' => $due_date ,
										 ]);
			$i++;
		}

		flash()
			->options([
						  'timeout' => 3000 ,
						  'position' => 'top-left' ,
					  ])
			->addSuccess('رکورد با موفقیت بروز رسانی شد.' , 'تبریک!');

		return redirect()->back();
	}

    public function submitBestankari ( Request $request ) {
        $request->validate([
                               'amount' => [ 'required' ] ,
                               'other_id' => [ 'required' ] ,
                           ]);
        $other = Other::query()
                        ->findOrFail($request->get('other_id'));
        $amount = str_replace(',' , '' , $request->get('amount'));
        $amount = Convert::convertToEnNumbers($amount);
        $result = $other->submitBestankari($amount);
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
        $other_monthly_charge = OtherMonthlyCharge::query()
                                       ->findOrFail($id);
        if ( $other_monthly_charge->paid_via != OtherMonthlyCharge::PAID_VIA[ 'ADMIN' ] ) {

            flash()
                ->options([
                              'timeout' => 3000 ,
                              'position' => 'top-left' ,
                          ])
                ->addSuccess('شارژی که از طریق به پرداخت انجام شده باشد قابلیت بازگشت ندارد.' , 'خطا');

            return redirect()->back();
        }
        Transaction::query()
                   ->where('other_monthly_charge_id' , $other_monthly_charge->id)
                   ->delete();
        $other_monthly_charge->paid_via = null;
        $other_monthly_charge->amount = $other_monthly_charge->original_amount;
        $other_monthly_charge->paid_at = null;
        $other_monthly_charge->save();
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
                               'other_id' => [ 'required' ] ,
                               'reason' => [ 'required' ] ,
                           ]);
        $other = Other::query()
                        ->findOrFail($request->get('other_id'));
        $amount = str_replace(',' , '' , $request->get('amount'));
        $amount = Convert::convertToEnNumbers($amount);
        $reason = $request->get('reason');
        $other->addDebt($amount , $reason , OtherDebt::TYPES[ 'NORMAL' ]);
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('بدهی ایجاد شد.' , 'تبریک');

        return redirect()->back();
    }

    public function removeBedehkari ( Request $request , $id ) {
        $other_debt = OtherDebt::query()
                    ->findOrFail($id);
        $other_debt->other->removeDebt($id);
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('بدهی حذف شد.' , 'تبریک');

        return redirect()->back();
    }

    public function removeMonthlyCharge ($id) {
        $other_monthly_charge = OtherMonthlyCharge::query()
                                       ->findOrFail($id);
        if ( $other_monthly_charge->paid_via == OtherMonthlyCharge::PAID_VIA[ 'BEHPARDAKHT' ] ) {

            flash()
                ->options([
                              'timeout' => 3000 ,
                              'position' => 'top-left' ,
                          ])
                ->addSuccess('شارژی که از طریق به پرداخت انجام شده باشد قابلیت حذف ندارد.' , 'خطا');

            return redirect()->back();
        }
        $other_monthly_charge->delete();
        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('شارژ ماهیانه حذف شد.' , 'تبریک');

        return redirect()->back();
    }

    public function deleteFinancialPeriodLog ($id) {
        OtherFinancialPeriodLog::query()->findOrFail($id)->delete();

        flash()
            ->options([
                          'timeout' => 3000 ,
                          'position' => 'top-left' ,
                      ])
            ->addSuccess('با موفقیت حذف شد' , 'تبریک');

        return redirect()->back();
    }

}
