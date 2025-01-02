@php use App\Models\Debt;use App\Models\HazineOmrani;use App\Models\MonthlyCharge;use App\Models\OtherDebt;use App\Models\Tenant; @endphp
@extends('metronic.master')
@section('content')
    @php
        $model_name = 'داشبورد';
    @endphp
    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                {{--  creative card --}}
                <div class="row">
                    <div class="col-3">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title w-100">
                                    <b class="card-label text-center">مبلغ کل بدهی شارژ </b>
                                </div>
                            </div>
                            <div class="card-body">
                                <h1>
                                    {{ number_format( MonthlyCharge::query()->notPaid()->dueDatePassed()->sum('original_amount') + Debt::query()->notPaid()->sum('amount') ) }} ریال
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title w-100">
                                    <b class="card-label text-center">مبلغ کل بدهی متفرقه </b>
                                </div>
                            </div>
                            <div class="card-body">
                                <h1>
                                    {{ number_format( OtherDebt::query()->notPaid()->sum('amount')) }} ریال
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title w-100">
                                    <b class="card-label text-center">مبلغ کل بدهی هزینه عمرانی </b>
                                </div>
                            </div>
                            <div class="card-body">
                                <h1>
                                    {{ number_format( HazineOmrani::query()->notPaid()->where('started_at', '<' , now())->where('ended_at' , '>' , now())->sum('original_amount')) }} ریال
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title w-100">
                                    <b class="card-label text-center">تعداد واحد بدهکار هزینه عمرانی</b>
                                </div>
                            </div>
                            <div class="card-body">
                                <h1>
                                    {{ number_format( HazineOmrani::query()->notPaid()->where('started_at', '<' , now())->where('ended_at' , '>' , now())->get()->pluck('tenant_id')->unique()->count()) }} واحد
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title w-100">
                                    <b class="card-label text-center">قطعی برق</b>
                                </div>
                            </div>
                            <div class="card-body">
                                <h1>
                                    @php
                                        $ghate_barghs = Tenant::query()->withUnpaidChargesCount()
                                        ->having('unpaid_charges_count' , '>=' , 2)
                                        ->get()
                                    @endphp
                                    {{ $ghate_barghs->count() }} کل
                                    <br>
                                    {{ $ghate_barghs->where('floor_id', 1)->count() }} زیر زمین

                                    <br>
                                    {{ $ghate_barghs->where('floor_id', 2)->count() }} همکف
                                    <br>
                                    {{ $ghate_barghs->where('floor_id', 3)->count() }} طبقه اول
                                    <br>
                                    {{ $ghate_barghs->where('floor_id', 4)->count() }} طبقه اول اداری
                                    <br>
                                    {{ $ghate_barghs->where('floor_id', 5)->count() }} طبقه دوم اداری
                                    <br>
                                    {{ $ghate_barghs->where('floor_id', 6)->count() }} طبقه سوم اداری

                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title w-100">
                                    <b class="card-label text-center">تعداد واحد بدهکار شارژ</b>
                                </div>
                            </div>
                            <div class="card-body">
                                <h1>
                                    @php
                                        $bedehkar_monthly_charge = Tenant::query()->withUnpaidChargesCount()
                                        ->having('unpaid_charges_count' , '>=' , 1)
                                        ->get()
                                    @endphp
                                    {{ $bedehkar_monthly_charge->count() }} کل
                                    <br>
                                    {{ $bedehkar_monthly_charge->where('floor_id', 1)->count() }} زیر زمین

                                    <br>
                                    {{ $bedehkar_monthly_charge->where('floor_id', 2)->count() }} همکف
                                    <br>
                                    {{ $bedehkar_monthly_charge->where('floor_id', 3)->count() }} طبقه اول
                                    <br>
                                    {{ $bedehkar_monthly_charge->where('floor_id', 4)->count() }} طبقه اول اداری
                                    <br>
                                    {{ $bedehkar_monthly_charge->where('floor_id', 5)->count() }} طبقه دوم اداری
                                    <br>
                                    {{ $bedehkar_monthly_charge->where('floor_id', 6)->count() }} طبقه سوم اداری

                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title w-100">
                                    <b class="card-label text-center">تعداد واحد استفاده کننده از شارژ تخفیف دار این ماه</b>
                                </div>
                            </div>
                            <div class="card-body">
                                <h1>
                                    {{ number_format( MonthlyCharge::query()->paid()->whereBetween('paid_at', [verta()->startMonth()->toCarbon(), verta()->endMonth()->toCarbon()])->where('paid_amount', '!=', 'original_amount')->get()->pluck('tenant_id')->unique()->count()) }} واحد
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title w-100">
                                    <b class="card-label text-center">سال مالی</b>
                                </div>
                            </div>
                            <div class="card-body">
                                <h1>
                                    از
                                    <br>
                                    {{ verta(\App\Models\FiscalYear::query()->first()->started_at)->format('Y/m/d') }}
                                    <br>
                                    تا
                                    <br>

                                    {{ verta(\App\Models\FiscalYear::query()->first()->ended_at)->format('Y/m/d') }}
                                </h1>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--end::Container-->
        </div>
    </div>

@endsection
