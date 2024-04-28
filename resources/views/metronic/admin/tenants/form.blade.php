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
                            ایجاد رکورد جدید
                        @endif
                    </h3>
                </div>

                <form id="my-form" method="post"
                      action="@if(isset($record)){{ route('admin.tenants.update', $record->id) }}@else{{ route('admin.tenants.store') }}@endif"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        @php
                            $image_url = '';
							if (isset($record)){
								$image_url = $record->getFirstMediaUrl('image');
							}
                        @endphp
                        <div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url({{ $image_url }})">
                            <div class="image-input-wrapper"></div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="تغییر">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>


                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">نوع کاربری
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="tenant_type_id" class="form-control selectpicker">
                                    @foreach(TenantType::all() as $tenant_type)
                                        <option @if(isset($record) && $record->tenant_type_id == $tenant_type->id) selected @endif value="{{ $tenant_type->id }}">{{ $tenant_type->type_fa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">طبقه
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="floor_id" class="form-control selectpicker">
                                    @foreach(Floor::all() as $floor)
                                        <option @if(isset($record) && $record->floor_id == $floor->id) selected @endif value="{{ $floor->id }}">{{ $floor->floor_fa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">متراژ
                                    <span class="text-danger">*</span>
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="meters"
                                       placeholder="متراژ را وارد کنید."
                                       value="{{ @$record->meters }}"/>
                            </div>
                        </div>


                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">پلاک
                                    <span class="text-danger">*</span>
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="plaque"
                                       placeholder="پلاک را وارد کنید."
                                       value="{{ @$record->plaque }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">نام
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="name"
                                       placeholder="نام را وارد کنید."
                                       value="{{ @$record->name }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">نام مالک
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="owner_first_name"
                                       placeholder="نام مالک را وارد کنید."
                                       value="{{ @$record->owner_first_name }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">نام خانوادگی مالک
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="owner_last_name"
                                       placeholder="نام خانوادگی مالک را وارد کنید."
                                       value="{{ @$record->owner_last_name }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">شماره تماس
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="phone_number"
                                       placeholder="شماره تماس را وارد کنید."
                                       value="{{ @$record->phone_number }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">َشارژ ماهیانه
                                    <span class="text-danger">*</span>
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="monthly_charge_amount"
                                       placeholder="َشارژ ماهیانه را وارد کنید."
                                       value="{{ @$record->monthly_charge_amount }}"/>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">مقدار بدهی</label>
                                <input autocomplete="off" type="text" class="form-control" name="debt_amount"
                                       placeholder="َمقدار بدهی را وارد کنید."
                                       value="{{ @$record->debt_amount }}"/>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">نوع فعالیت یا صنف فروشگاه
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="activity_type"
                                       placeholder="نوع فعالیت یا صنف فروشگاه را وارد کنید."
                                       value="{{ @$record->activity_type }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">نام کاربری جهت ورود به سامانه
                                </label>
                                <input readonly autocomplete="off" type="text" class="form-control disabled form-control-solid"
                                       placeholder="نام کاربری را وارد کنید."
                                       value="{{ @$record->username }}"/>
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
                                    <a dir="ltr" href="{{ route('admin.tenants.set-default-password', $record->id) }}" class="btn btn-light-primary">بازگردانی به پسورد پیشفرض </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">ذخیره</button>
                        <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary">بازگشت</a>
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
@endpush
