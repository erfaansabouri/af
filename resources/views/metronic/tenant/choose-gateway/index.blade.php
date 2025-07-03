@extends('metronic.master')
@section('content')
    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">انتخاب درگاه
                                <span class="text-muted pt-2 font-size-sm d-block"></span>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- درگاه بانک ملت و پاسارگاد قابل انتخاب باشد --}}
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ $generate_url }}&gateway=mellat"
                                   class="btn btn-primary btn-block mb-3">درگاه بانک ملت</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ $generate_url }}&gateway=pasargad"
                                   class="btn btn-primary btn-block mb-3">درگاه بانک پاسارگاد</a>
                            </div>
                        </div>
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
