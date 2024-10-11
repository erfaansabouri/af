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
                            ارسال پیام به همه پلاک ها
                        @endif
                    </h3>
                </div>

                <form id="my-form" method="post"
                      action="@if(isset($record)) {{ route('admin.complex-settings.message-groups.update', $record->id) }} @else {{ route('admin.complex-settings.message-groups.submit-send-to-all') }} @endif"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">پیام
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" name="message" rows="5">{{ @$record->message }}</textarea>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">ذخیره</button>
                        <a href="{{ route('admin.complex-settings.message-groups.index') }}" class="btn btn-secondary">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
