@php use App\Models\MonthlyCharge; @endphp
@extends('metronic.master')
@section('content')
    <div class="row">
        <div class="col-xl-6">
            <div>
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title">
                                    <h3 class="card-label">{{ "ایجاد بدهکاری برای پلاک " . $tenant->plaque }}
                                        <span class="text-muted pt-2 font-size-sm d-block"></span>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">

                                <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('admin.tenants.submit-bedehkari') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group">
                                            <label for="exampleInputEmail1">مبلغ بدهکاری</label>
                                            <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                                            <input type="text" class="form-control m-input m-input--square" id="numberInput2" aria-describedby="emailHelp" placeholder="" name="amount">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="exampleInputEmail1">دلیل بدهکاری</label>
                                            <input type="text" class="form-control m-input m-input--square" aria-describedby="emailHelp" placeholder="" name="reason">
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <div class="m-form__actions">
                                            <button type="submit" class="btn btn-dark">ثبت بدهکاری</button>
                                        </div>
                                    </div>
                                </form>
                                <!--end: Datatable-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Container-->
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div>
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title">
                                    <h3 class="card-label">{{ "ایجاد بستانکاری برای پلاک " . $tenant->plaque }}
                                        <span class="text-muted pt-2 font-size-sm d-block"></span>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">

                                <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('admin.tenants.submit-bestankari') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group">
                                            <label for="exampleInputEmail1">مبلغ بستانکاری</label>
                                            <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                                            <input type="text" class="form-control m-input m-input--square" id="numberInput" aria-describedby="emailHelp" placeholder="" name="amount">
                                            <span class="m-form__help">لطفا مبلغی کمتر یا مساوی با ({{ number_format($tenant->getFirstUnpaidMonthlyCharge()->original_amount ?? 0) }} ریال) وارد نمایید.</span>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <div class="m-form__actions">
                                            <button type="submit" class="btn btn-success">ثبت بستانکاری</button>
                                        </div>
                                    </div>
                                </form>
                                <!--end: Datatable-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Container-->
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <div class="row">
        <div class="col-xl-6">
            <div>
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title">
                                    <h3 class="card-label">{{ "بدهی های پلاک" . " " . $tenant->plaque }}
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
                                                <td class="iransans-web">{{ number_format($debt->amount) }} ریال</td>
                                                <td class="iransans-web">
                                                    @if($debt->paid_at)
                                                        <span class="label label-inline label-light-success">پرداخت موفق</span>
                                                    @else
                                                        <span class="label label-inline label-light-danger">پرداخت نشده</span>
                                                    @endif
                                                </td>
                                                <td class="iransans-web">
                                                    @if(!$debt->paid_at)
                                                        <a class="btn btn-sm btn-danger" href="{{ route('admin.tenants.remove-bedehkari', $debt->id) }}">حذف بدهی</a>
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
        <div class="col-xl-6">
            <div>
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title">
                                    <h3 class="card-label">{{ "شارژ های ماهیانه پلاک" . " " . $tenant->plaque }}
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
                                            <th class="iransans-web">ماه</th>
                                            <th class="iransans-web">موعد پرداخت</th>
                                            <th class="iransans-web">مبلغ</th>
                                            <th class="iransans-web">وضعیت</th>
                                            <th class="iransans-web">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record)
                                            <tr>
                                                <td class="iransans-web"> ماه {{ $record->month }}</td>
                                                <td class="iransans-web">{{ verta($record->due_date)->format('Y/m/d') }}</td>
                                                <td class="iransans-web">
                                                    پایه: {{ number_format($record->original_amount) }} ریال
                                                    @if(!$record->paid_at && $record->original_amount != $record->final_amount)
                                                        <hr>
                                                        <span class="text-success"> پس از تخفیف: {{ number_format($record->final_amount) }} ریال</span>
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
                                                <td class="iransans-web">
                                                    @if($record->paid_via == MonthlyCharge::PAID_VIA['ADMIN'])
                                                        <a class="btn btn-sm btn-danger" href="{{ route('admin.tenants.restore-monthly-charge', $record->id) }}">بازگردانی</a>
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
    </div>
    <br>
    <hr>
    <div class="row">
        <div class="col-xl-6">
            <div>
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title">
                                    <h3 class="card-label">{{ "ایجاد هزینه مالکیتی برای پلاک " . $tenant->plaque }}
                                        <span class="text-muted pt-2 font-size-sm d-block"></span>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">

                                <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('admin.tenants.submit-ownership-debt') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group">
                                            <label for="exampleInputEmail1">مبلغ هزینه مالکیتی</label>
                                            <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                                            <input type="text" class="form-control m-input m-input--square" id="numberInput3" aria-describedby="emailHelp" placeholder="" name="amount">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">موعد پرداخت
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input value="" type="text" class="form-control started-at-datepicker" />
                                            <input  name="due_date" type="hidden" class="alt-started-at-datepicker" />
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <div class="m-form__actions">
                                            <button type="submit" class="btn btn-dark">ثبت هزینه مالکیتی</button>
                                        </div>
                                    </div>
                                </form>
                                <!--end: Datatable-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Container-->
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <div class="row">
        <div class="col-xl-6">
            <div>
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title">
                                    <h3 class="card-label">{{ "هزینه های مالکیتی پلاک" . " " . $tenant->plaque }}
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
                                            <th class="iransans-web">موعد پرداخت</th>
                                            <th class="iransans-web">مبلغ</th>
                                            <th class="iransans-web">وضعیت</th>
                                            <th class="iransans-web">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ownership_debts as $ownership_debt)
                                            <tr>
                                                <td class="iransans-web">{{ verta($ownership_debt->due_date)->formatJalaliDate() }}</td>
                                                <td class="iransans-web">{{ number_format($ownership_debt->amount) }} ریال</td>
                                                <td class="iransans-web">
                                                    @if($ownership_debt->paid_at)
                                                        <span class="label label-inline label-light-success">پرداخت موفق</span>
                                                    @else
                                                        <span class="label label-inline label-light-danger">پرداخت نشده</span>
                                                    @endif
                                                </td>
                                                <td class="iransans-web">
                                                    @if(!$ownership_debt->paid_at)
                                                        <a class="btn btn-sm btn-danger" href="{{ route('admin.tenants.remove-ownership-debt', $ownership_debt->id) }}">حذف بدهی</a>
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
    </div>
    <br>
    <hr>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const numberInput = document.getElementById('numberInput');
            const numberInput2 = document.getElementById('numberInput2');
            const numberInput3 = document.getElementById('numberInput3');

            const persianToEnglish = (str) => {
                const persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
                const englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                return str.replace(/[\u06F0-\u06F9]/g, (match) => {
                    return englishNumbers[persianNumbers.indexOf(match)];
                }).replace(/[\u0660-\u0669]/g, (match) => {
                    return englishNumbers[match.charCodeAt(0) - 0x0660];
                });
            };

            numberInput.addEventListener('input', (event) => {
                let value = event.target.value;
                value = persianToEnglish(value);
                value = value.replace(/,/g, '');
                if (!isNaN(value)) {
                    event.target.value = Number(value).toLocaleString();
                }
            });

            numberInput2.addEventListener('input', (event) => {
                let value = event.target.value;
                value = persianToEnglish(value);
                value = value.replace(/,/g, '');
                if (!isNaN(value)) {
                    event.target.value = Number(value).toLocaleString();
                }
            });
            numberInput3.addEventListener('input', (event) => {
                let value = event.target.value;
                value = persianToEnglish(value);
                value = value.replace(/,/g, '');
                if (!isNaN(value)) {
                    event.target.value = Number(value).toLocaleString();
                }
            });
        });


    </script>

    <script>
        $(document).ready(function() {
            $(".started-at-datepicker").pDatepicker({
                altField: '.alt-started-at-datepicker',
                minDate: new persianDate().unix(),
                autoClose: true,
                format: 'YYYY/MM/DD',
                altFormat: 'X',
                initialValueType: 'persian',
                observer: true,
            });

            $(".ended-at-datepicker").pDatepicker({
                altField: '.alt-ended-at-datepicker',
                minDate: new persianDate().unix(),
                autoClose: true,
                format: 'YYYY/MM/DD',
                altFormat: 'X',
                initialValueType: 'persian' ,
                observer: true,
            });
        });
    </script>
@endpush
