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
                      action="@if(isset($record)){{ route('admin.fiscal-years.update', $record->id) }}@else{{ route('admin.fiscal-years.store') }}@endif"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">سال
                                    <span class="text-danger">*</span>
                                </label>
                                <input autocomplete="off" type="text" class="form-control" name="year"
                                       placeholder="سال را وارد کنید."
                                       value="{{ @$record->year }}"/>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">تاریخ شروع
                                    <span class="text-danger">*</span>
                                </label>
                                <input value="@if(@$record->started_at) {{ verta($record->started_at)->format('Y-m-d') }} @endif" type="text" class="form-control started-at-datepicker" />
                                <input  name="started_at" type="hidden" class="alt-started-at-datepicker" />
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="col-form-label">تاریخ پایان
                                    <span class="text-danger">*</span>
                                </label>
                                <input value="@if(@$record->ended_at) {{ verta($record->ended_at)->format('Y-m-d') }} @endif" type="text" class="form-control ended-at-datepicker" />
                                <input  name="ended_at" type="hidden" class="alt-ended-at-datepicker" />
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">ذخیره</button>
                        <a href="{{ route('admin.fiscal-years.index') }}" class="btn btn-secondary">بازگشت</a>
                    </div>
                </form>
            </div>
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
