@extends('metronic.master')
@section('content')
    @php
        $model_name = 'حضور و غیاب';
    @endphp
    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">{{ $model_name }} | امروز {{ verta()->formatJalaliDate() }}
                                <span class="text-muted pt-2 font-size-sm d-block"></span>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.daily-logs.submit') }}">
                            @csrf
                            <!-- Text Input -->
                            <div class="mb-4">
                                <label for="textInput" class="form-label">شماره پلاک</label>
                                <input type="text" id="textInput" name="plaque" class="form-control" placeholder="شماره پلاک" required>
                            </div>

                            <!-- Radio Buttons -->
                            <div class="mb-4">
                                <label class="form-label">وضعیت</label>
                                <div class="form-check">
                                    <input type="radio" id="option1" name="status" value="غیبت" class="form-check-input" required>
                                    <label for="option1" class="form-check-label">غیبت</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="option2" name="status" value="دکور" class="form-check-input" required>
                                    <label for="option2" class="form-check-label">دکور</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="option3" name="status" value="تعطیل" class="form-check-input" required>
                                    <label for="option3" class="form-check-label">تعطیل</label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit" class="btn btn-primary">ذخیره</button>
                            </div>
                        </form>
                    </div>

                    <hr>
                    <div class="card-body">
                        <form method="get" action="{{ route('admin.export-by-plaque') }}">
                            <!-- Text Input -->
                            <div class="mb-4">
                                <label for="textInput" class="form-label">شماره پلاک</label>
                                <input type="text" id="textInput" name="plaque" class="form-control" placeholder="شماره پلاک" required>
                            </div>

                            <!-- Radio Buttons -->

                            <!-- Submit Button -->
                            <div>
                                <button type="submit" class="btn btn-primary">دریافت خروجی اکسل بر اساس پلاک</button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="card-body">
                        <form action="{{ route('admin.export-by-date') }}" method="get">
                            <div class="row align-items-center">
                                <div class="col-lg-2 col-xl-2">
                                    <div class="row align-items-center">
                                        <div class="col-lg-12 col-xl-12 my-2 my-md-0">
                                            <div class="input-icon">
                                                <input value="" type="text" class="form-control started-at-datepicker" />
                                                <input  name="started_at" type="hidden" class="alt-started-at-datepicker" />
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
                                                <input value="" type="text" class="form-control ended-at-datepicker" />
                                                <input  name="ended_at" type="hidden" class="alt-ended-at-datepicker" />
                                                <span>
                                                    <i class="flaticon-calendar text-muted"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-2 col-xl-2 mt-5 mt-lg-0">
                                    <button class="btn btn-primary">دریافت خروجی اکسل بر اساس تاریخ</button>
                                </div>
                            </div>
                        </form>
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
