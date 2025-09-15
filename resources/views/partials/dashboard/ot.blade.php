<div class="content container-fluid">
    @include('partials.alert-message')

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Welcome {{ Auth::user()->name }}!</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->


    <div class="row">

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #2B77B0;">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <i class="fa-solid fa-circle-h" style="color:white;"></i>
                    </span>

                    <div class="dash-widget-info">
                        <a href="{{ route('admin.ot.ot-pre-booking') }}" style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3>{{ App\Models\OtPreBooking::count() }}</h3>
                                <span>OT Pre Booking</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #A6A63B;">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <i class="fa-solid fa-briefcase-medical" style="color:white;"></i>
                    </span>

                    <div class="dash-widget-info">
                        <a href="{{ route('admin.ot.ot-booking') }}" style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3>{{ App\Models\OtBooking::count() }}</h3>
                                <span>OT Booking</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #C60196;">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <i class="fa-solid fa-suitcase-medical" style="color:white"></i>
                    </span>

                    <div class="dash-widget-info">
                        <a href="{{ route('admin.ot.day-care') }}" style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3>{{ App\Models\OtDayCare::count() }}</h3>
                                <span>OT Day Care</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #EC851E;">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <i class="fa-solid fa-hand-holding-medical" style="color:white"></i>
                    </span>

                    <div class="dash-widget-info">
                        <a href="{{ route('admin.ot.pre-operation') }}" style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3> {{ \App\Models\OtPreOperation::count() }}
                                </h3>
                                <span>OT Pre Operation</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #6C330F;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-kit-medical" style="color:white;"></i></span>
                    <div class="dash-widget-info">
                        <a href="{{ route('admin.ot.pre-operation-checklist') }}"
                            style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3> {{ \App\Models\OtPreOperationCheckList::count() }}</h3>
                                <span>Pre Operation CheckList</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #FFC107;">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <i class="fa-solid fa-hand-holding-droplet" style="color:white;"></i>
                    </span>

                    <div class="dash-widget-info">
                        <a href="{{ route('admin.ot.post-operation') }}" style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3> {{ \App\Models\OtPostOperation::count() }}</h3>
                                <span>OT Post Operation</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Recent OT Booking</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>UMR</th>
                                    <th>Patient Name</th>
                                    <th>IPD No</th>
                                    <th>Ref Doctor Name</th>
                                    <th>Surgery</th>
                                    <th>Surgery Date</th>
                                    <th>For Day Care</th>
                                    <th>Is Cancelled</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\OtBooking::latest()->take(10)->get() as $ot_booking)
                                    <tr>
                                        <td>{{ $ot_booking->code }}</td>
                                        <td>{{ $ot_booking?->patient?->registration_no }}</td>
                                        <td>{{ $ot_booking?->patient?->name }}</td>
                                        <td>{{ $ot_booking?->ipd?->ipdcode }}</td>
                                        <td>{{ $ot_booking?->doctor?->name }}</td>
                                        <td>{{ $ot_booking?->service?->name }}</td>
                                        <td>{{ date('d-M-Y', strtotime($ot_booking->surgery_date)) }}</td>
                                        <td>{{ $ot_booking?->for_day_care ? 'Y' : 'N' }}</td>
                                        <td>{{ $ot_booking->is_cancelled ? 'Y' : 'N' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.ot.ot-booking') }}">
                        View all
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Recent Post Operation</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>UMR</th>
                                    <th>Patient Name</th>
                                    <th>IPD No</th>
                                    <th>OT Booking</th>
                                    <th>OT Pre Operation</th>
                                    <th>Surgery</th>
                                    <th>Surgery Date</th>
                                    <th>Surgery Type</th>
                                    <th>OT Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\OtPostOperation::latest()->take(10)->get() as $post_operation)
                                    <tr>
                                        <td>{{ $post_operation->code }}</td>
                                        <td>{{ $post_operation?->patient?->registration_no }}</td>
                                        <td>{{ $post_operation?->patient?->name }}</td>
                                        <td>{{ $post_operation?->ipd?->ipdcode }}</td>
                                        <td>{{ $post_operation?->ot_booking?->code }}</td>
                                        <td>{{ $post_operation?->ot_pre_operation?->code }}</td>
                                        <td>{{ $post_operation?->service?->name }}</td>
                                        <td>{{ date('d-M-Y', strtotime($post_operation->surgery_date)) }}</td>
                                        <td>{{ $post_operation?->surgery_type?->name }}</td>
                                        <td>{{ $post_operation?->ot_type?->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.ot.post-operation') }}">View all</a>
                </div>
            </div>
        </div>
    </div>
</div>
