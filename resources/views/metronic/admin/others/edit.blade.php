@php use App\Models\Floor;use App\Models\TenantType; @endphp
@extends('metronic.master')
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        ویرایش متفرقه پلاک {{ $record->plaque }}
                    </h3>
                </div>

                <form id="my-form" method="post"
                      action="{{ route('admin.others.update', $record->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
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
                                <label class="col-form-label">شرح
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="description"
                                       placeholder="شرح را وارد کنید."
                                       value="{{ @$record->description }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">پلاک اداری یا تجاری مربوطه
                                </label>
                                <select name="tenant_id" class="form-control selectpicker">
                                    <option value="">انتخاب کنید</option>
                                    @foreach(\App\Models\Tenant::all() as $tenant)
                                        <option value="{{ $tenant->id }}">پلاک {{ $tenant->plaque }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">شارژ ماهیانه
                                    <span class="text-danger">*</span>
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="monthly_charge_amount"
                                       placeholder="َشارژ ماهیانه را وارد کنید."
                                       value="{{ @$record->monthly_charge_amount }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">نام کاربری جهت ورود به سامانه
                                </label>
                                <span class="text-danger">*</span>

                                <input autocomplete="off" type="text" class="form-control" name="username"
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
                                    <a dir="ltr" href="{{ route('admin.others.set-default-password', $record->id) }}" class="btn btn-light-primary">بازگردانی به پسورد پیشفرض </a>
                                @endif
                            </div>
                        </div>
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
@endpush
