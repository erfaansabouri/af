@extends('metronic.master')
@section('content')
    @php
        $model_name = 'اخطار';
    @endphp
    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">{{ $model_name }} ها
                                <span class="text-muted pt-2 font-size-sm d-block"></span>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Search Form-->
                        <!--begin::Search Form-->
                        <div class="mb-7">
                            <form action="{{ route('admin.warnings.index') }}" method="get">
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-xl-12 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <input name="search" type="text" class="form-control"
                                                           placeholder="جستجو..." value="{{ request()->search }}"/>
                                                    <span>
                                                        <i class="flaticon2-search-1 text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                                        <button class="btn btn-light-primary px-6 font-weight-bold">اعمال فیلتر</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <table
                            class="table table-bordered table-striped">
                            <caption>{{$model_name}} ها</caption>
                            <thead class="thead-light iransans-web">
                            <tr>
                                <th class="iransans-web">شناسه</th>
                                <th class="iransans-web">پلاک</th>
                                <th class="iransans-web">دلیل اخطار</th>
                                <th class="iransans-web">تاریخ ایجاد</th>
                                <th class="iransans-web">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td class="iransans-web">{{ $record->id }}</td>
                                    <td class="iransans-web">{{ $record->tenant->plaque }}</td>
                                    <td class="iransans-web">{{ $record->reason }}</td>
                                    <td class="iransans-web">{{ verta($record->created_at)->format('Y/m/d H:i:s') }}</td>
                                    <td class="iransans-web">
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#remove-warning-{{ $record->id }}">
                                            حذف اخطار
                                        </button>

                                        <div class="modal" id="remove-warning-{{ $record->id }}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form id="my-form" method="post"
                                                          action="{{ route('admin.warnings.destroy', $record->id) }}"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        @method('POST')
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">حذف اخطار</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="col-xl-12">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">رمز امنیتی</label>
                                                                    <input autocomplete="off"  type="text" class="form-control" name="key"
                                                                           required
                                                                           placeholder="رمز امنیتی را وارد نمایید"
                                                                           value=""/>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">حذف اخطار</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
    </div>

@endsection
@push('scripts')

@endpush
