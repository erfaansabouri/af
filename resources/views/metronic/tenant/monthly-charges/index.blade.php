@php use App\Models\Setting; @endphp
@extends('metronic.master')
@php
    $tenant = Auth::guard('tenant')->user();
@endphp
@section('content')
    <div class="row">
        <div class="col-xl-6">
            <div class="d-flex flex-column-fluid">
                <!--begin::Container-->
                <div class="container-fluid">
                    <div class="card card-custom">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">بدهی های پلاک {{ $tenant->plaque }}
                                    <span class="text-muted pt-2 font-size-sm d-block"></span>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    class="table table-bordered table-striped">
                                    <thead class="thead-light iransans-web">
                                    <tr>
                                        <th class="iransans-web">دلیل بدهی</th>
                                        <th class="iransans-web">مبلغ</th>
                                        <th class="iransans-web">وضعیت</th>
                                        <th class="iransans-web">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($debts as $debt)
                                        <tr>
                                            <td class="iransans-web">{{ $debt->reason }}</td>
                                            <td class="iransans-web">{{ number_format($debt->amount) }}</td>
                                            <td class="iransans-web">
                                                @if($debt->paid_at)
                                                    <span class="label label-inline label-light-success">پرداخت موفق</span>
                                                @else
                                                    <span class="label label-inline label-light-danger">پرداخت نشده</span>
                                                @endif
                                            </td>
                                            <td class="iransans-web">
                                                @if(!$debt->paid_at)
                                                    <a class="btn btn-sm btn-success" href="#">پرداخت</a>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end: Datatable-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Container-->
            </div>

        </div>
        <div class="col-xl-6">
            <div class="d-flex flex-column-fluid">
                <!--begin::Container-->
                <div class="container-fluid">
                    <div class="card card-custom">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">شارژ های ماهیانه پلاک {{ $tenant->plaque }}
                                    <span class="text-muted pt-2 font-size-sm d-block"></span>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="m-alert m-alert--icon alert alert-danger" role="alert">
                                <div class="m-alert__icon">
                                    <i class="flaticon-danger"></i>
                                </div>
                                <div class="m-alert__text">
                                    <strong>اخطار بدهی</strong>
                                    کاربر گرامی شما مبلغ {{ number_format($tenant->debts()->sum('amount')) }} ریال بدهکار هستید.
                                    <br>
                                    لطفا جهت پرداخت شارژ های ماهیانه، ابتدا بدهی خود را تسویه نمایید
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table table-bordered table-striped">
                                    <thead class="thead-light iransans-web">
                                    <tr>
                                        <th class="iransans-web">ماه</th>
                                        <th class="iransans-web">موعد پرداخت</th>
                                        <th class="iransans-web">هزینه</th>
                                        <th class="iransans-web">وضعیت</th>
                                        <th class="iransans-web">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($records as $record)
                                        <tr>
                                            <td class="iransans-web">ماه {{ $record->month }}</td>
                                            <td class="iransans-web">{{ verta($record->due_date)->format('Y/m/d') }}</td>
                                            <td class="iransans-web">
                                                پایه: {{ number_format($record->original_amount) }} ریال
                                                @if(!$record->paid_at && $record->original_amount > $record->final_amount)
                                                    <hr>
                                                    <span class="text-success"> پس از تخفیف: {{ number_format($record->final_amount) }} ریال</span>
                                                @endif
                                                @if(!$record->paid_at && $record->original_amount < $record->final_amount)
                                                    <hr>
                                                    <span class="text-danger"> با جریمه: {{ number_format($record->final_amount) }} ریال</span>
                                                @endif
                                                @if($record->paid_amount)
                                                    <hr>
                                                پرداختی شما: {{ number_format($record->paid_amount) }} ریال
                                                @endif
                                            </td>
                                            <td class="iransans-web">
                                                @if($record->paid_at)
                                                    <span class="label label-inline label-light-success">پرداخت موفق</span>
                                                @else
                                                    <span class="label label-inline label-light-danger">پرداخت نشده</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!$tenant->can_pay_monthly_charges)
                                                    ابتدا بدهی خود را تسویه نمایید
                                                @else
                                                    @if(!$record->paid_at)
                                                        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                                            <a href="{{ route('tenant.transaction.generate-url', ['monthly_charge_id' => $record->id]) }}" class="btn btn-sm btn-success">پرداخت</a>
                                                        </div>
                                                    @else
                                                    @endif
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end: Datatable-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Container-->
            </div>

        </div>
    </div>

@endsection
