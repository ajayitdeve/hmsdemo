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
                        <a href="{{ route('admin.blood-requisition-request') }}"
                            style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3>{{ App\Models\BloodRequisitionRequest::count() }}</h3>
                                <span>Blood Requisition</span>
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
                        <a href="{{ route('admin.blood-bank.donor-registration') }}"
                            style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3>{{ App\Models\Donor::count() }}</h3>
                                <span>Donor</span>
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
                        <a href="{{ route('admin.blood-bank.donor-questionnaire-and-consent') }}"
                            style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3>{{ App\Models\BloodDonorQuestionnaireConsent::count() }}</h3>
                                <span>Donor Questionnaire</span>
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
                        <a href="{{ route('admin.blood-bank.donor-bleeding') }}"
                            style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3> {{ \App\Models\BloodDonorBleeding::count() }}
                                </h3>
                                <span>Donor Bleeding</span>
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
                        <a href="{{ route('admin.transfusion-reaction') }}" style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3> {{ \App\Models\TransfusionReaction::count() }}</h3>
                                <span>Transfusion Reaction</span>
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
                        <a href="{{ route('admin.transfusion-return') }}" style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3> {{ \App\Models\TransfusionReactionReturn::count() }}</h3>
                                <span>Reaction Return</span>
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
                    <h3 class="card-title mb-0">Recent Blood Requisition Request</h3>
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
                                    <th>Blood Group</th>
                                    <th>PRBC</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\BloodRequisitionRequest::latest()->take(10)->get() as $blood_requisition_request)
                                    <tr>
                                        <td>{{ $blood_requisition_request->code }}</td>

                                        @if ($blood_requisition_request->type == 'outside-patient')
                                            <td>{{ $blood_requisition_request?->out_side_patient?->registration_no }}
                                            </td>
                                            <td>{{ $blood_requisition_request?->out_side_patient?->name }}</td>
                                        @else
                                            <td>{{ $blood_requisition_request?->patient?->registration_no }}</td>
                                            <td>{{ $blood_requisition_request?->patient?->name }}</td>
                                        @endif

                                        <td>{{ $blood_requisition_request?->ipd?->ipdcode }}</td>
                                        <td>{{ $blood_requisition_request?->doctor?->name }}</td>

                                        <td>{{ $blood_requisition_request?->blood_group?->name }}</td>
                                        </td>
                                        <td>{{ $blood_requisition_request?->prbc }}</td>
                                        <td>{{ $blood_requisition_request?->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.blood-requisition-request') }}">
                        View all
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Recent Transfusion Reaction</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Blood Requisition</th>
                                    <th>UMR</th>
                                    <th>Patient Name</th>
                                    <th>IPD No</th>
                                    <th>Blood Group</th>
                                    <th>Is Return</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\TransfusionReaction::latest()->take(10)->get() as $transfusion_reaction)
                                    <td> {{ $transfusion_reaction->code }}</td>
                                    <td>{{ $transfusion_reaction?->blood_requisition_request?->code }}</td>
                                    <td>{{ $transfusion_reaction?->patient?->registration_no }}</td>
                                    <td>{{ $transfusion_reaction?->patient?->name }}</td>
                                    <td>{{ $transfusion_reaction?->ipd?->ipdcode }}</td>
                                    <td>{{ $transfusion_reaction?->blood_group?->name }}</td>
                                    <td>{{ $transfusion_reaction?->status ? 'Yes' : 'No' }}</td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.transfusion-reaction') }}">View all</a>
                </div>
            </div>
        </div>
    </div>
</div>
