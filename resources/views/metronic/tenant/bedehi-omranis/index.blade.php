@php use App\Models\Setting; @endphp
@extends('metronic.master')
@php
    $tenant = Auth::guard('tenant')->user();
@endphp
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="d-flex flex-column-fluid">
                <!--begin::Container-->
                <div class="container-fluid">
                    <div class="card card-custom">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">بدهی های هزینه عمرانی پلاک {{ $tenant->plaque }}
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
                                        <th class="iransans-web">مبلغ</th>
                                        <th class="iransans-web">وضعیت</th>
                                        <th class="iransans-web">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bedehi_omranis as $b)
                                        <tr>
                                            <td class="iransans-web">{{ number_format($b->amount) }} ریال</td>
                                            <td class="iransans-web">
                                                @if($b->paid_at)
                                                    <span class="label label-inline label-light-success">پرداخت موفق</span>
                                                @else
                                                    <span class="label label-inline label-light-danger">پرداخت نشده</span>
                                                @endif
                                            </td>
                                            <td class="iransans-web">
                                                @if(!$b->paid_at)
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#bedehi-omrani-modal-{{ $b->id }}">
                                                        پرداخت بدهی
                                                    </button>




                                                    {{--{{ route('tenant.transaction.generate-url', ['debt_id' => $debt->id]) }}--}}
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
            <hr>
            <br>
            <div class="d-flex flex-column-fluid">
                <!--begin::Container-->
                <div class="container-fluid">
                    <div class="card card-custom">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">هزینه های عمرانی فصلی پلاک {{ $tenant->plaque }}
                                    <span class="text-muted pt-2 font-size-sm d-block"></span>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">


                            @if(!$tenant->can_pay_hazine_omranis)
                                <div class="m-alert m-alert--icon alert alert-danger" role="alert">
                                    <div class="m-alert__icon">
                                        <i class="flaticon-danger"></i>
                                    </div>
                                    <div class="m-alert__text">
                                        <strong>اخطار بدهی</strong>
                                        کاربر گرامی شما مبلغ {{ number_format($tenant->bedehiOmranis()->notPaid()->sum('amount')) }} ریال بدهکار هستید.
                                        <br>
                                        لطفا جهت پرداخت هزینه عمرانی، ابتدا بدهی عمرانی خود را تسویه نمایید
                                    </div>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table
                                    class="table table-bordered table-striped">
                                    <thead class="thead-light iransans-web">
                                    <tr>
                                        <th class="iransans-web">عنوان</th>
                                        <th class="iransans-web">هزینه</th>
                                        <th class="iransans-web">وضعیت</th>
                                        <th class="iransans-web">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($hazine_omranis as $h)
                                        <tr>
                                            <td class="iransans-web"> {{ $h->subject_and_month }}</td>
                                            <td class="iransans-web">
                                                پایه: {{ number_format($h->original_amount) }} ریال
                                                @if(!$h->paid_at && $h->original_amount > $h->final_amount)
                                                    <hr>
                                                    <span class="text-success"> پس از تخفیف: {{ number_format($h->final_amount) }} ریال</span>
                                                @endif
                                                @if(!$h->paid_at && $h->original_amount < $h->final_amount)
                                                    <hr>
                                                    <span class="text-danger"> با جریمه: {{ number_format($h->final_amount) }} ریال</span>
                                                @endif
                                                @if($h->paid_amount)
                                                    <hr>
                                                پرداختی شما: {{ number_format($h->paid_amount) }} ریال
                                                @endif
                                            </td>
                                            <td class="iransans-web">
                                                @if($h->paid_at)
                                                    <span class="label label-inline label-light-success">پرداخت موفق</span>
                                                @else
                                                    <span class="label label-inline label-light-danger">پرداخت نشده</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!$tenant->can_pay_hazine_omranis)
                                                    ابتدا بدهی خود را تسویه نمایید
                                                @elseif($h->id != @$tenant->getFirstUnpaidHazineOmrani()->id)
                                                    --
                                                @elseif($h->id != @$tenant->getFirstUnpaidHazineOmrani()->id && @$tenant->oneMonthPassedFromFirstUnpaidMonthlyCharge())
                                                    ابتدا هزینه فصل قبل را تسویه نمایید
                                                @else
                                                    @if(!$h->paid_at)
                                                        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                                            <a href="{{ route('tenant.transaction.choose-gateway', ['generate_url' => route('tenant.transaction.generate-url', ['hazine_omrani_id' => $h->id])]) }}" class="btn btn-sm btn-success">پرداخت</a>
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

    @foreach($bedehi_omranis as $b)
        <!-- The Modal -->
        <div class="modal" id="bedehi-omrani-modal-{{ $b->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="my-form" method="post"
                          action="{{ route('tenant.transaction.generate-url') }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">پرداخت بدهی عمرانی</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label class="col-form-label">مبلغ پرداختی به ریال</label>
                                    <input autocomplete="off" type="text" class="form-control" name="bedehi_omrani_amount"
                                           placeholder="مبلغ پرداختی به ریال را وارد نمایید"
                                           value=""/>
                                    <input type="hidden" name="bedehi_omrani_id" value="{{ $b->id }}">
                                </div>
                                <span class="text-primary">حداکثر مبلغ قابل پرداخت {{ number_format($b->amount) }} ریال میباشد</span>
                            </div>

                            {{-- radio button for gatway ( pasargard or behpardakht ) --}}
                            <div class="form-group mt-3">
                                <label class="col-form-label">انتخاب درگاه پرداخت</label>
                                <div>
                                    <div class="form-check form-check-inline align-items-center d-flex">
                                        <input class="form-check-input" type="radio" name="gateway" id="pasargad" value="pasargad" checked>
                                        <label class="form-check-label d-flex align-items-center ms-2" for="pasargad">
                                            <img src="{{ asset('seeds/icons/pasargad.jpg') }}" alt="پاسارگاد" style="height: 55px; margin-left: 6px;">
                                            پاسارگاد
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline align-items-center d-flex">
                                        <input class="form-check-input" type="radio" name="gateway" id="mellat" value="mellat">
                                        <label class="form-check-label d-flex align-items-center ms-2" for="mellat">
                                            <img src="{{ asset('seeds/icons/mellat.png') }}" alt="ملت" style="height: 55px; margin-left: 6px;">
                                            ملت
                                        </label>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">رفتن به درگاه</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endforeach



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
