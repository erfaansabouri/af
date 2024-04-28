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
                            ارسال پیام به یک طبقه خاص
                        @endif
                    </h3>
                </div>

                <form id="my-form" method="post"
                      action="{{ route('admin.complex-settings.message-groups.submit-floor') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">

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
