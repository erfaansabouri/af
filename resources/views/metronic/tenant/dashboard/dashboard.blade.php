@extends('metronic.master')
@section('content')
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <div class="row">
                    <div class="col-xl-4">
                        <!--begin::Stats Widget 16-->
                        <a href="#" class="card card-custom card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-info svg-icon-3x ml-n1"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Shopping/Cart3.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <title>Stockholm-icons / Shopping / Cart3</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs></defs>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000"></path>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5">شارژ ماهیانه من</div>
                                <div class="font-weight-bold text-inverse-white font-size-sm">{{ is_numeric(Auth::guard('tenant')->user()->monthly_charge_amount) ?  number_format(Auth::guard('tenant')->user()->monthly_charge_amount) . " ریال " : "-"}}</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 16-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin::Stats Widget 17-->
                        <a href="#" class="card card-custom bg-info bg-hover-state-info card-stretch card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <title>Stockholm-icons / Layout / Layout-4-blocks</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs></defs>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                            <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-info font-weight-bolder font-size-h5 mb-2 mt-5">مجموع پرداختی من</div>
                                <div class="font-weight-bold text-inverse-info font-size-sm">{{ number_format(Auth::guard('tenant')->user()->transactions()->whereNotNull('paid_at')->sum('amount')) }} ریال</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 17-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin::Stats Widget 18-->
                        <a href="#" class="card card-custom bg-dark bg-hover-state-dark card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <title>Stockholm-icons / Media / Equalizer</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs></defs>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-dark font-weight-bolder font-size-h5 mb-2 mt-5">مبلغ باقی مانده از شارژ تا پایان اردیبهشت 1404</div>
                                <div class="font-weight-bold text-inverse-dark font-size-sm">{{ number_format(Auth::guard('tenant')->user()->monthlyCharges()->whereNull('paid_at')->sum('original_amount')) }} ریال </div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 18-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">


                        <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                            @foreach($messages as $message)
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title" data-toggle="collapse" data-target="#collapse{{ $message->id }}">
                                            پیام جدید {{ verta($message->created_at)->format('%d %B %Y') }}
                                        </div>
                                    </div>
                                    <div id="collapse{{ $message->id }}" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            {{ $message->message }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-xl-12">


                        <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                            @foreach($warnings as $warning)
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title" data-toggle="collapse" data-target="#collapsew{{ $warning->id }}">
                                            اخطار {{ verta($warning->created_at)->format('%d %B %Y') }}
                                        </div>
                                    </div>
                                    <div id="collapsew{{ $warning->id }}" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            {{ $warning->reason }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                <hr>
                @if(Auth::guard('tenant')->user()->phone_number == null)
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="m-portlet m-portlet--tab">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">

                                                <h3 class="m-portlet__head-text">
                                                    وارد کردن شماره همراه
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                    <!--begin::Form-->
                                    <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('tenant.profile.update-phone-number') }}">
                                        @csrf
                                        @method('POST')
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group m--margin-top-10">
                                                <div class="alert m-alert m-alert--default text-danger" role="alert">
                                                     جهت استفاده از برنامه و دریافت پیامک ، ثبت اطلاعات الزامی است.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">نام کاربر
                                                </label>
                                                <input autocomplete="off" type="text" class="form-control" name="owner_first_name"
                                                       placeholder="نام کاربر را وارد کنید."
                                                       value="{{ Auth::guard('tenant')->user()->owner_first_name }}"/>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">نام خانوادگی کاربر
                                                </label>
                                                <input autocomplete="off" type="text" class="form-control" name="owner_last_name"
                                                       placeholder="نام خانوادگی کاربر را وارد کنید."
                                                       value="{{ Auth::guard('tenant')->user()->owner_last_name }}"/>
                                            </div>
                                            <div class="form-group m-form__group">
                                                <label for="exampleInputEmail1">شماره همراه</label>
                                                <input name="phone_number" dir="ltr" style="direction: ltr" value="09" type="text" class="form-control m-input" id="phone" aria-describedby="phone" placeholder="09...">
                                            </div>
                                        </div>
                                        <div class="m-portlet__foot m-portlet__foot--fit">
                                            <div class="m-form__actions">
                                                <button type="submit" class="btn btn-primary">ثبت</button>
                                            </div>
                                        </div>
                                    </form>

                                    <!--end::Form-->
                                </div>

                            </div>
                        </div>
                    </div>

                @endif

                <!--End::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection
