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
            <br>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card card-custom">
                        <div class="card-header">
                            <h3 class="card-title">
                                شارژ های ماهیانه پلاک {{ $record->plaque }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="m-portlet">
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">
                                                Small Table
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__body">

                                    <!--begin::Section-->
                                    <div class="m-section">
                                        <span class="m-section__sub">
                                            Add <code>.table-sm</code> to make tables more compact by cutting cell padding in half.
                                        </span>
                                        <div class="m-section__content">
                                            <table class="table table-sm m-table m-table--head-bg-brand">
                                                <thead class="thead-inverse">
                                                <tr>
                                                    <th>#</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Username</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Jhon</td>
                                                    <td>Stone</td>
                                                    <td>@jhon</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Lisa</td>
                                                    <td>Nilson</td>
                                                    <td>@lisa</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>Larry</td>
                                                    <td>the Bird</td>
                                                    <td>@twitter</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!--end::Section-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-custom">
                        <div class="card-header">
                            <h3 class="card-title">
                                شارژ های ماهیانه پلاک {{ $record->plaque }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="m-portlet">
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__body">

                                    <!--begin::Section-->
                                    <div class="m-section">
                                        <span class="m-section__sub">
                                        </span>
                                        <div class="m-section__content">
                                            <table class="table table-sm m-table m-table--head-bg-brand">
                                                <thead class="thead-inverse">
                                                <tr>
                                                    <th>موعد پرداخت</th>
                                                    <th>مبلغ</th>
                                                    <th>وضعیت پرداخت</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($record->otherMonthlyCharges as $omc)
                                                <tr>
                                                    <td>{{ verta($omc->due_date)->format('Y/m/d') }}</td>
                                                    <td>{{ number_format($omc->amount) }} ریال</td>
                                                    <td>
                                                        @if($record->paid_at)
                                                            <span class="label label-inline label-light-success">پرداخت موفق</span>
                                                        @else
                                                            <span class="label label-inline label-light-danger">پرداخت نشده</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!--end::Section-->
                                </div>
                            </div>
                        </div>
                    </div>
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
