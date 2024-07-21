@php use App\Models\Floor;use App\Models\TenantType; @endphp
@extends('metronic.master')
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(isset($record))
                            ویرایش اطلاعات
                        @else
                            ایجاد کاربر متفرقه جدید
                        @endif
                    </h3>
                </div>

                <form id="my-form" method="post"
                      action="@if(isset($record)){{ route('admin.others.update', $record->id) }}@else{{ route('admin.others.store') }}@endif"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">پلاک واحد متفرقه
                                    <span class="text-danger">*</span>
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="plaque"
                                       placeholder="پلاک را وارد کنید."
                                       value="{{ @$record->plaque }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">نوع
                                    <span class="text-danger">*</span>
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="type"
                                       placeholder="مثلا ویترین، غرفه یا ..."
                                       value="{{ @$record->type }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">پلاک واحد اداری/تجاری مربوطه
                                    <span class="text-danger"></span>
                                </label>
                                <select name="floor_id" class="form-control selectpicker">
                                    <option value="">انتخاب کنید</option>
                                    @foreach(\App\Models\Tenant::all() as $tenant)
                                        <option @if(isset($record) && $record->tenant_id == $tenant->id) selected @endif value="{{ $tenant->id }}">{{ $tenant->plaque }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">رمز عبور جهت ورود به سامانه
                                    <span class="text-danger">*</span>
                                </label>
                                <input autocomplete="off" type="password" class="form-control" name="password"
                                       placeholder="رمز عبور را وارد کنید."
                                       value=""/>
                                @if(@$record)
                                    <br>
                                    <a dir="ltr" href="{{ route('admin.others.set-default-password', $record->id) }}" class="btn btn-light-primary">بازگردانی به پسورد پیشفرض </a>
                                @endif
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">مبلغ بدهی
                                    <span class="text-danger">*</span>
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="debt_amount"
                                       placeholder="مبلغ بدهی را وارد کنید."
                                       value="{{ @$record->debt_amount ?? 0 }}"/>
                            </div>
                        </div>



                        @if(!isset($record))
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="col-form-label">کرایه ماهیانه
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input autocomplete="off" type="text" class="form-control" name="monthly_charge_amount"
                                           placeholder="کرایه ماهیانه را وارد کنید."
                                           value="{{ @$record->monthly_charge_amount }}"/>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="col-form-label">تاریخ شروع سال مالی
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-icon">
                                        <input value="" type="text" class="form-control started-at-datepicker" />
                                        <input  name="started_at" type="hidden" class="alt-started-at-datepicker" />
                                        <span>
                                            <i class="flaticon-calendar text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="col-form-label">تاریخ پایان سال مالی
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-icon">
                                        <input value="" type="text" class="form-control ended-at-datepicker" />
                                        <input  name="ended_at" type="hidden" class="alt-ended-at-datepicker" />
                                        <span>
                                            <i class="flaticon-calendar text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif






                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">ذخیره</button>
                        <a href="{{ route('admin.others.index') }}" class="btn btn-secondary">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>


        var avatar5 = new KTImageInput('kt_image_5');


        avatar5.on('remove', function(imageInput) {
            swal.fire({
                title: 'Image successfully removed !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Got it!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
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
