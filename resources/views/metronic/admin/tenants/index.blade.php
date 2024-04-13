@extends('metronic.master')
@section('content')
    @php
        $model_name = 'غرفه';
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
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            <a href="{{ route('admin.tenants.create') }}"
                               class="btn btn-success font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24"/>
														<circle fill="#000000" cx="9" cy="15" r="6"/>
														<path
                                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                                            fill="#000000" opacity="0.3"/>
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span>ایجاد</a>
                            <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Search Form-->
                        <!--begin::Search Form-->
                        <div class="mb-7">
                            <form action="#" method="get">
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-xl-12 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <input name="search" type="text" class="form-control"
                                                           placeholder="جستجو..." value="{{ request()->search }}"/>
                                                    <span><i class="flaticon2-search-1 text-muted"></i></span>
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
                                <th class="iransans-web">طبقه</th>
                                <th class="iransans-web">متراژ</th>
                                <th class="iransans-web">نام غرفه</th>
                                <th class="iransans-web">شماره تماس</th>
                                <th class="iransans-web">نوع کاربری</th>
                                <th class="iransans-web">شارژ ماهیانه</th>
                                <th class="iransans-web">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td class="iransans-web">{{ $record->id }}</td>
                                    <td class="iransans-web">{{ $record->plaque }}</td>
                                    <td class="iransans-web">{{ $record->floor->floor_fa }}</td>
                                    <td class="iransans-web">{{ $record->meters }}</td>
                                    <td class="iransans-web">{{ $record->name }}</td>
                                    <td class="iransans-web">{{ $record->phone_number }}</td>
                                    <td class="iransans-web">{{ $record->tenantType->type_fa }}</td>
                                    <td class="iransans-web">{{ is_numeric($record->monthly_charge_amount) ? number_format($record->monthly_charge_amount) : "ندارد" }}</td>
                                    <td>
                                        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <a href="{{ route('admin.tenants.edit', $record->id) }}" class="btn btn-primary  btn-icon"><i class="la la-edit"></i></a>
                                                <a href="{{ route('admin.tenants.monthly-charges', $record->id) }}" class="btn btn-success btn-icon"><i class="la la-file-invoice"></i></a>
                                                <a href="{{ route('admin.tenants.destroy', $record->id) }}" class="btn btn-danger btn-icon"><i class="la la-trash-alt"></i></a>
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
