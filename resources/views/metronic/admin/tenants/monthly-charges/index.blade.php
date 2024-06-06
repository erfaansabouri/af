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

                        <button data-toggle="modal" data-target="#fake-transaction" class="btn btn-light-dark">ثبت تراکنش توسط مدیریت</button>
                        <div class="modal" id="fake-transaction">
                            <form action="{{ route('admin.tenants.fake-transaction') }}" method="POST" class="modal-dialog">
                                @csrf
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">مبلغ</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        مبلغ پرداختی را وارد نمایید.
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                                                <input id="numberInput" autocomplete="off" type="text" class="form-control" name="paid_amount"
                                                       placeholder="مبلغ را وارد کنید."
                                                       value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">ثبت</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <hr>

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
                                        <td class="iransans-web"> ماه{{ $record->month }}</td>
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
                                                        <a href="{{ route('admin.transaction.generate-url', ['monthly_charge_id' => $record->id]) }}" class="btn btn-primary">پرداخت درگاهی</a>
                                                        <br>


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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const numberInput = document.getElementById('numberInput');

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
        });

    </script>
@endpush
