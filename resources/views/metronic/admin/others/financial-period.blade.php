@php use App\Models\Floor;use App\Models\TenantType; @endphp
@extends('metronic.master')
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        تعریف دوره مالی  برای پلاک {{ $record->plaque }}
                    </h3>
                </div>

                <form id="my-form" method="post"
                      action="{{ route('admin.others.create-financial-period', $record->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                      <div class="row">
                          <div class="col-xl-6">
                              <div class="form-group">
                                  <label class="col-form-label">تاریخ شروع
                                      <span class="text-danger">*</span>
                                  </label>
                                  <input value="" type="text" class="form-control started-at-datepicker" />
                                  <input  name="started_at" type="hidden" class="alt-started-at-datepicker" />
                              </div>
                          </div>

                          <div class="col-xl-6">
                              <div class="form-group">
                                  <label class="col-form-label">تاریخ پایان
                                      <span class="text-danger">*</span>
                                  </label>
                                  <input value="" type="text" class="form-control ended-at-datepicker" />
                                  <input  name="ended_at" type="hidden" class="alt-ended-at-datepicker" />
                              </div>
                          </div>
                      </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success mr-2">تعریف دوره مالی به مبلغ ماهیانه {{ number_format($record->monthly_charge_amount) }} ریال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div>
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title">
                                    <h3 class="card-label">{{ "شارژ های ماهیانه پلاک" . " " . $record->plaque }}
                                        <span class="text-muted pt-2 font-size-sm d-block"></span>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table
                                        class="table table-bordered table-striped">
                                        <thead class="thead-light iransans-web">
                                        <tr>
                                            <th class="iransans-web">ماه</th>
                                            <th class="iransans-web">موعد پرداخت</th>
                                            <th class="iransans-web">مبلغ</th>
                                            <th class="iransans-web">وضعیت</th>
                                            <th class="iransans-web">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>


                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--end: Datatable-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Container-->
                </div>
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
