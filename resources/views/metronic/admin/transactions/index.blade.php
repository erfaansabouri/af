@extends('metronic.master')
@section('content')
    @php
        $model_name = 'تراکنش';
    @endphp
    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">{{ $model_name }} ها
                                <span class="text-muted pt-2 font-size-sm d-block"></span>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Search Form-->
                        <!--begin::Search Form-->
                        <div class="mb-7">
                            <form action="{{ route('admin.transactions.index') }}" method="get">
                                <div class="row align-items-center">
                                    <div class="col-lg-2 col-xl-2">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-xl-12 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <input data-jdp name="started_at"  value="" type="text" class="form-control started-at-datepicker" />
                                                    <span>
                                                        <i class="flaticon-calendar text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-xl-2">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-xl-12 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <input data-jdp name="ended_at" value="" type="text" class="form-control ended-at-datepicker" />
                                                    <span>
                                                        <i class="flaticon-calendar text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-xl-2">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-xl-12 my-2 my-md-0">
                                                <select name="transaction_type" class="form-control selectpicker">
                                                    <option value="">نوع تراکنش</option>
                                                    <option @if(request('transaction_type') == 'tejari') selected @endif value="tejari">تجاری</option>
                                                    <option @if(request('transaction_type') == 'edari') selected @endif value="edari">اداری</option>
                                                    <option @if(request('transaction_type') == 'malekiati') selected @endif value="malekiati">مالکیتی</option>
                                                    <option @if(request('transaction_type') == 'motefareghe') selected @endif value="motefareghe">متفرقه</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-xl-2 mt-5 mt-lg-0">
                                        <button class="btn btn-light-primary px-6 font-weight-bold">جستجو</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="mb-7">
                            <form action="{{ route('admin.transactions.export') }}" method="get">
                                <div class="row align-items-center">
                                    <div class="col-lg-2 col-xl-2">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-xl-12 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <input data-jdp value="" name="started_at" type="text" class="form-control started-at-datepicker" />
                                                    <span>
                                                        <i class="flaticon-calendar text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-xl-2">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-xl-12 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <input data-jdp value="" name="ended_at" type="text" class="form-control ended-at-datepicker" />
                                                    <span>
                                                        <i class="flaticon-calendar text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-xl-2">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-xl-12 my-2 my-md-0">
                                                <select name="transaction_type" class="form-control selectpicker">
                                                    <option value="">نوع تراکنش</option>
                                                    <option @if(request('transaction_type') == 'tejari') selected @endif value="tejari">تجاری</option>
                                                    <option @if(request('transaction_type') == 'edari') selected @endif value="edari">اداری</option>
                                                    <option @if(request('transaction_type') == 'malekiati') selected @endif value="malekiati">مالکیتی</option>
                                                    <option @if(request('transaction_type') == 'motefareghe') selected @endif value="motefareghe">متفرقه</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-2 col-xl-2">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-xl-12 my-2 my-md-0">
                                                <select name="paid_via" class="form-control selectpicker">
                                                    <option value="">نوع پرداخت</option>
                                                    <option value="{{ \App\Models\Transaction::PAID_VIA['BEHPARDAKHT'] }}">به پرداخت</option>
                                                    <option value="{{ \App\Models\Transaction::PAID_VIA['ADMIN'] }}">مدیریت</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-xl-2 mt-5 mt-lg-0">
                                        <button class="btn btn-light-primary px-6 font-weight-bold">دریافت خروجی اکسل</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <table
                            class="table table-bordered table-striped">
                            <caption>{{$model_name}} ها</caption>
                            <thead class="thead-light iransans-web">
                            <tr>
                                <th class="iransans-web">آی دی سیستم</th>
                                <th class="iransans-web">پلاک</th>
                                <th class="iransans-web">موضوع پرداخت</th>
                                <th class="iransans-web">مبلغ</th>
                                <th class="iransans-web">وضعیت پرداخت</th>
                                <th class="iransans-web">تاریخ ایجاد</th>
                                <th class="iransans-web">اطلاعات بانکی</th>
                                <th class="iransans-web">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td class="iransans-web">{{ $record->id }}</td>
                                    <td class="iransans-web">
                                        {{ $record?->tenant?->plaque ?? '' }} {{ $record?->other->plaque ?? '' }}
                                        <br>
                                        {{ $record->tenant_or_other }}
                                    </td>
                                    <td class="iransans-web">{{ $record->subject }}</td>
                                    <td class="iransans-web">{{ number_format($record->amount) }} ریال</td>
                                    <td class="iransans-web">
                                        @if($record->status == 'پرداخت موفق')
                                            <div class="badge badge-success">
                                                {{ $record->status }}
                                            </div>
                                        @endif

                                        @if($record->status == 'پرداخت ناموفق')
                                            <div class="badge badge-danger">
                                                {{ $record->status }}
                                            </div>
                                        @endif

                                            @if($record->status == 'در حال پرداخت')
                                                <div class="badge badge-warning">
                                                    {{ $record->status }}
                                                </div>
                                            @endif
                                    </td>
                                    <td class="iransans-web">{{ verta($record->created_at)->format('Y/m/d H:i:s') }}</td>
                                    <td class="iransans-web" dir="ltr" style="direction: ltr">
                                        @if($record->paid_via == \App\Models\Transaction::PAID_VIA['ADMIN'])
                                            پرداخت توسط مدیریت
                                        @endif
                                        @if($record->verifyLogs)
                                            @foreach($record->verifyLogs as $verify_log)
                                                @if($verify_log->request)
                                                    @foreach(json_decode($verify_log->request, true) as $k => $v)
                                                        @if($k != 'CardHolderInfo')
                                                            {{ __($k) }}:
                                                            <br><b>{{ $v }}</b>
                                                            <hr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                @if($verify_log->exception_message)
                                                    <br>
                                                    متن خطا : {{ $verify_log->exception_code }} {{ $verify_log->exception_message }}
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="iransans-web">
                                        @if($record->paid_at)
                                            <a href="{{ route('admin.transactions.pdf', $record->id) }}" class="btn btn-primary">PDF</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

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

@endpush
