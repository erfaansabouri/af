@extends('metronic.master')
@section('content')
    @php
        $model_name = 'بخش املاک';
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
                        <form method="post" action="{{ route('admin.properties.submit') }}">
                            @csrf
                            <!-- Text Input -->
                            <div class="mb-4">
                                <label for="textInput" class="form-label">شماره پلاک</label>
                                <input type="text" id="textInput" name="plaque" class="form-control" placeholder="شماره پلاک" required>
                            </div>

                            <div class="mb-4">
                                <label for="textInput" class="form-label">نام و نام خانوادگی</label>
                                <input type="text" id="textInput" name="full_name" class="form-control" placeholder="نام و نام خانوادگی" required>
                            </div>

                            <div class="mb-4">
                                <label for="textInput" class="form-label">شماره همراه</label>
                                <input type="text" id="textInput" name="phone" class="form-control" placeholder="شماره همراه" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">نوع</label>
                                <div class="form-check">
                                    <input type="radio" id="option1" name="type" value="مالک" class="form-check-input" required>
                                    <label for="option1" class="form-check-label">مالک</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="option2" name="type" value="سر قفلی" class="form-check-input" required>
                                    <label for="option2" class="form-check-label">سر قفلی</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="option3" name="type" value="مستاجر" class="form-check-input" required>
                                    <label for="option3" class="form-check-label">مستاجر</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="textInput" class="form-label">تاریخ شروع قرار داد</label>
                                <div class="input-icon">
                                    <input value="" type="text" class="form-control started-at-datepicker" />
                                    <input  name="started_at" type="hidden" class="alt-started-at-datepicker" />
                                    <span>
                                        <i class="flaticon-calendar text-muted"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="textInput" class="form-label">تاریخ پایان قرار داد (فقط برای مستاجر)</label>
                                <div class="input-icon">
                                    <input value="" type="text" class="form-control ended-at-datepicker" />
                                    <input  name="ended_at" type="hidden" class="alt-ended-at-datepicker" />
                                    <span>
                                        <i class="flaticon-calendar text-muted"></i>
                                    </span>
                                </div>
                            </div>
                            <!-- Radio Buttons -->


                            <!-- Submit Button -->
                            <div>
                                <button type="submit" class="btn btn-primary">ذخیره</button>
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
                autoClose: true,
                format: 'YYYY/MM/DD',
                altFormat: 'X',
                initialValueType: 'persian',
                observer: true,
                initialValue : false,
            });

            $(".ended-at-datepicker").pDatepicker({
                altField: '.alt-ended-at-datepicker',
                autoClose: true,
                format: 'YYYY/MM/DD',
                altFormat: 'X',
                initialValueType: 'persian' ,
                observer: true,
                initialValue : false,
            });
        });
    </script>
@endpush
