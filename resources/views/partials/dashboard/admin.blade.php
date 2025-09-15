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

    @include('partials.medicine-expiry-alert')

    <div class="row">

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #478AC3;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-hospital-user" style="color:white;"></i></span>
                    <a href="{{ route('admin.patient.consultation-list') }}" style="text-decoration: none;color:black;">
                        <div class="dash-widget-info">
                            <h3>{{ \App\Models\PatientVisit::count() }}</h3>
                            <span>OPD</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #B2A05A ;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-bed-pulse" style="color:white;"></i></span>
                    <a href="{{ route('admin.ipd.ipd-list') }}" style="text-decoration: none;color:black;">
                        <div class="dash-widget-info">
                            <h3>
                                {{ \App\Models\Ipd\Ipd::count() }}
                            </h3>
                            <span>IPD</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #16BFC6;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-user-doctor" style="color:white;"></i></span>
                    <a href="{{ route('admin.doctor-registration') }}" style="text-decoration: none;color:black;">
                        <div class="dash-widget-info">
                            <h3>
                                {{ \App\Models\Doctor::count() }}
                            </h3>
                            <span>Doctor</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #D0181B; ">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-id-card-clip" style="color:white;"></i></span>
                    <a href="{{ route('admin.patient.list') }}" style="text-decoration: none;color:black;">
                        <div class="dash-widget-info">
                            <h3>{{ \App\Models\Patient::count() }}</h3>
                            <span>Patients</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #FFC107;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-hospital-user" style="color:white;"></i></span>
                    <a href="{{ route('admin.patient.consultation-list', ['today' => true]) }}"
                        style="text-decoration: none;color:black;">
                        <div class="dash-widget-info">
                            <h3>
                                {{ \App\Models\PatientVisit::whereDate('visit_date', \Carbon\Carbon::today()->toDateString())->count() }}
                            </h3>
                            <span>Today's OPD</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #DC3545;">
                <div class="card-body">

                    <span class="dash-widget-icon"><i class="fa-solid fa-bed-pulse" style="color:white;"></i></span>

                    <a href="{{ route('admin.ipd.ipd-list', ['today' => true]) }}"
                        style="text-decoration: none;color:black;">
                        <div class="dash-widget-info">
                            <h3>
                                {{ \App\Models\Ipd\Ipd::whereDate('created_at', \Carbon\Carbon::today()->toDateString())->count() }}
                            </h3>
                            <span>Today's IPD</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color:#10c016;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-users" style="color:white;"></i></span>
                    <a href="{{ route('admin.employee') }}" style="text-decoration: none;color:black;">
                        <div class="dash-widget-info">
                            <h3>
                                {{ \App\Models\Employee::count() }}
                            </h3>
                            <span>Employee</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #346ce4;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-building" style="color:white;"></i></span>
                    <a href="{{ route('admin.ipd.organization-master') }}" style="text-decoration: none;color:black;">
                        <div class="dash-widget-info">
                            <h3>
                                {{ \App\Models\Ipd\Organization::count() }}
                            </h3>
                            <span>Organization</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        {{-- <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #75E382;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-solid fa-rupee-sign" style="color:white;"></i></span>

                    <a href="" style="text-decoration: none;color:black;">
                        <div class="dash-widget-info">
                            <h3>0</h3>
                            <span>Revenue</span>
                        </div>
                    </a>
                </div>
            </div>
        </div> --}}

        {{-- <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #17A2B8;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-book-medical" style="color:white;"></i></span>
                    <a href="{{ route('admin.patient-visit.doctor-wise-consultation') }}"
                        style="text-decoration: none;color:black;">
                        <div class="dash-widget-info">
                            <h3></h3>
                            <span>Report</span>
                        </div>
                    </a>
                </div>
            </div>
        </div> --}}
    </div>





    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Recent Consultation</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>UMR</th>
                                    <th>Department</th>
                                    <th>Doctor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Models\PatientVisit::latest()->take(10)->get() as $patientvisit)
                                    <tr>
                                        <td>{{ $patientvisit?->patient?->name }}</td>
                                        <td>{{ $patientvisit?->patient?->registration_no }}</td>
                                        <td>{{ $patientvisit?->department?->name }}</td>
                                        <td>
                                            @if ($patientvisit->doctor_id != null)
                                                <a
                                                    href="{{ route('admin.consultation.doctor-wise-consultation', $patientvisit->doctor_id) }}">
                                                    {{ $patientvisit->doctor->name }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.patient.consultation-list') }}">View all Consultation</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Recent IPD</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table custom-table table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>UMR</th>
                                    <th>Code</th>
                                    <th>Reason</th>
                                    <th>Company</th>
                                    <th>Payment by</th>
                                    <th>Payment</th>
                                    <th>Policy No.</th>
                                    <th>Admit Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Models\Ipd\Ipd::latest()->take(10)->get() as $ipd)
                                    <tr>
                                        <td>{{ $ipd->patient->name }}</td>
                                        <td>{{ $ipd->patient->registration_no }}</td>
                                        <td>{{ $ipd->ipdcode }}</td>
                                        <td>{{ $ipd->reason }}</td>
                                        <td>{{ $ipd->company }}</td>
                                        <td>{{ $ipd->payment_by }}</td>
                                        <td>{{ $ipd->payment }}</td>
                                        <td>{{ $ipd->policy_no }}</td>
                                        <td>{{ $ipd->admit_type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.ipd.ipd-list') }}">View all IPD</a>
                </div>
            </div>
        </div>
    </div>

</div>
