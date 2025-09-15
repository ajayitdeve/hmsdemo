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

        {{-- <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #B2A05A ;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-bed-pulse" style="color:white;"></i></span>
                    <a href="" style="text-decoration: none;color:black;">
                        <div class="dash-widget-info">
                            <h3>0</h3>
                            <span>IPD</span>
                        </div>
                    </a>
                </div>
            </div>
        </div> --}}

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #16BFC6;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-user-doctor" style="color:white;"></i></span>
                    <a href="{{ route('admin.doctor-registration') }}" style="text-decoration: none;color:black;">
                        <div class="dash-widget-info">
                            <h3>{{ \App\Models\Doctor::count() }}</h3>
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

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #FFC107;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa-solid fa-hospital-user" style="color:white;"></i></span>
                    <a href="{{ route('admin.patient.consultation-list') }}" style="text-decoration: none;color:black;">
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

        {{-- <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #DC3545;">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <i class="fa-solid fa-bed-pulse" style="color:white;"></i>
                    </span>

                    <a href="" style="text-decoration: none;color:black;">
                        <div class="dash-widget-info">
                            <h3>0</h3>
                            <span>Today's IPD</span>
                        </div>
                    </a>
                </div>
            </div>
        </div> --}}

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #75E382;">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-solid fa-rupee-sign" style="color:white;"></i></span>

                    <a href="{{ route('admin.all-opd-bill') }}" style="text-decoration: none;color:black;">
                        <div class="dash-widget-info">
                            <h3> {{ \App\Models\OpdBilling::count() }}</h3>
                            <span>OPD Billing</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget" style="background-color: #2B77B0;">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <i class="fa-solid fa-circle-h" style="color:white;"></i>
                    </span>

                    <div class="dash-widget-info">
                        <a href="{{ route('admin.front-desk.adt.ip-service.list') }}"
                            style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3>{{ App\Models\IpServiceBilling::count() }}</h3>
                                <span>IP Service</span>
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
                    <h3 class="card-title mb-0">Recent Consultation</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>UMR</th>
                                    <th>Department</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $patientvisits = \App\Models\PatientVisit::orderBy('created_at', 'DESC')->take(10)->get();
                                
                                ?>
                                @foreach ($patientvisits as $patientvisit)
                                    <tr>
                                        <td>{{ $patientvisit->id }}</td>
                                        <td>{{ $patientvisit->patient->name }}</td>
                                        <td>{{ $patientvisit->patient->registration_no }}</td>
                                        <td>{{ $patientvisit->unit->name }}</td>
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
                    <h3 class="card-title mb-0">Recent OPD Billing</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Bill No</th>
                                    <th>UMR</th>
                                    <th>Patient Name</th>
                                    <th>Created At</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\OpdBilling::latest()->take(10)->get() as $opdBilling)
                                    @if ($opdBilling->patient_type == 'outside')
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $opdBilling->code }}</td>
                                            <td>{{ $opdBilling->outSidePatient->registration_no }}</td>
                                            <td>{{ $opdBilling->outSidePatient->name }}</td>
                                            <td>{{ $opdBilling->created_at }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $opdBilling->code }}</td>
                                            <td>{{ $opdBilling->patient != null ? $opdBilling->patient->registration_no : null }}
                                            </td>
                                            <td>{{ $opdBilling->patient != null ? $opdBilling->patient->name : null }}
                                            </td>
                                            <td>{{ $opdBilling->created_at }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.all-opd-bill') }}">View all</a>
                </div>
            </div>
        </div>
    </div>



</div>
