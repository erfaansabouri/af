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
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">پلاک<span class="text-danger">*</span></label>
                                <input autocomplete="off" type="text" class="form-control" name="plaque"
                                       placeholder="پلاک را وارد کنید."
                                       value="{{ @$record->plaque }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">نام<span class="text-danger">*</span></label>
                                <input autocomplete="off" type="text" class="form-control" name="name"
                                       placeholder="نام را وارد کنید."
                                       value="{{ @$record->name }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">نام مغازه دار<span class="text-danger">*</span></label>
                                <input autocomplete="off" type="text" class="form-control" name="owner_first_name"
                                       placeholder="نام مغازه دار را وارد کنید."
                                       value="{{ @$record->owner_first_name }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">نام خانوادگی مغازه دار<span class="text-danger">*</span></label>
                                <input autocomplete="off" type="text" class="form-control" name="owner_last_name"
                                       placeholder="نام خانوادگی مغازه دار را وارد کنید."
                                       value="{{ @$record->owner_last_name }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">نام کاربری<span class="text-danger">*</span></label>
                                <input autocomplete="off" type="text" class="form-control" name="username"
                                       placeholder="نام کاربری را وارد کنید."
                                       value="{{ @$record->username }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">رمز عبور<span class="text-danger">*</span></label>
                                <input autocomplete="off" type="password" class="form-control" name="password"
                                       placeholder="رمز عبور را وارد کنید."
                                       value=""/>
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
