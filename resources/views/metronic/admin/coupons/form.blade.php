@extends('metronic.master')
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(isset($record))
                            ویرایش کد تخفیف {{ $record->coupon_fa }}
                        @else
                            ایجاد رکورد جدید
                        @endif
                    </h3>
                </div>

                <form id="my-form" method="post"
                      action="{{ route('admin.coupons.update', $record->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">درصد تخفیف
                                    <span class="text-danger">*</span>
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="discount_percent"
                                       placeholder="درصد تخفیف را وارد کنید."
                                       value="{{ @$record->discount_percent }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">فعال
                                    <span class="text-danger">*</span>
                                </label>

                                <span class="switch switch-outline switch-icon switch-success">
                                    <label>
                                        <input type="checkbox" @if(isset($record) && $record->active) checked="checked" @endif name="active">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>



                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">ذخیره</button>
                        <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
