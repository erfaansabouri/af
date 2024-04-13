@extends('metronic.master')
@section('content')
    @php
        $model_name = "شارژ های ماهیانه" . " " . $tenant->name;
    @endphp
    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">{{ $model_name }}
                                <span class="text-muted pt-2 font-size-sm d-block"></span>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Search Form-->
                        <!--begin::Search Form-->
                        <div class="mb-7">
                            <form action="#" method="get">
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-xl-12 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <input name="search" type="text" class="form-control"
                                                           placeholder="جستجو..." value="{{ request()->search }}"/>
                                                    <span>
                                                        <i class="flaticon2-search-1 text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                                        <button class="btn btn-light-primary px-6 font-weight-bold">اعمال فیلتر</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped">
                                <caption>شارژ های ماهیانه</caption>
                                <thead class="thead-light iransans-web">
                                <tr>
                                    <th class="iransans-web">سال</th>
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
                                        <td class="iransans-web">{{ $record->fiscalYear->year }}</td>
                                        <td class="iransans-web">{{ $record->persian_month }}</td>
                                        <td class="iransans-web">{{ verta($record->due_date)->format('Y/m/d') }}</td>
                                        <td class="iransans-web">
                                            پایه: {{ number_format($record->original_amount) }} ریال
                                            @if(!$record->paid_at && $record->original_amount != $record->final_amount)
                                                <hr>
                                                <span class="text-success">                                            پس از تخفیف: {{ number_format($record->final_amount) }} ریال</span>
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
                                            @if(!$record->paid_at)
                                                <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                                    <div class="btn-group" role="group" aria-label="First group">
                                                        <a href="{{ route('transaction.generate-url', ['monthly_charge_id' => $record->id]) }}" class="btn btn-primary">پرداخت</a>
                                                    </div>
                                                </div>
                                            @else
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

@endsection
