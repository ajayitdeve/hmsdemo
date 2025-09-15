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

        <div class="col-md-6">
            <div class="card dash-widget" style="background-color: #2B77B0;">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <i class="fa-solid fa-circle-h" style="color:white;"></i>
                    </span>

                    <div class="dash-widget-info">
                        <a href="{{ route('admin.diagnostic-result-list') }}"
                            style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3>{{ App\Models\Pathology\DiagnosticResult::count() }}</h3>
                                <span>OPD Diagnostic Result</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card dash-widget" style="background-color: #A6A63B;">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <i class="fa-solid fa-briefcase-medical" style="color:white;"></i>
                    </span>

                    <div class="dash-widget-info">
                        <a href="{{ route('admin.ipd.diagnostic-result-list') }}"
                            style="text-decoration: none;color:white;">
                            <div class="dash-widget-info">
                                <h3>{{ App\Models\Pathology\IpdDiagnosticResult::count() }}</h3>
                                <span>IPD Diagnostic Result</span>
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
                    <h3 class="card-title mb-0">Recent OPD Diagnostic Result</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Patient Name</th>
                                    <th>Result Code</th>
                                    <th>Bill No</th>
                                    <th>Ref No</th>
                                    <th>Result Date</th>
                                    <th>Satus</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\Pathology\DiagnosticResult::latest()->take(10)->get() as $diagnosticResult)
                                    <tr>

                                        <td>{{ $loop->index + 1 }}</td>
                                        @if ($diagnosticResult->patient_type == 'outside')
                                            <td>{{ $diagnosticResult?->outSidePatient?->name }}</td>
                                        @else
                                            <td>{{ $diagnosticResult?->patient?->name }}</td>
                                        @endif
                                        <td>{{ $diagnosticResult->code }}</td>
                                        <td>{{ $diagnosticResult?->opdBilling?->code }}</td>
                                        <td>{{ $diagnosticResult->ref_no }}</td>
                                        <td>{{ $diagnosticResult->created_at }}</td>
                                        <td>{{ $diagnosticResult->status == 1 ? 'Done' : 'Pending' }}</td>
                                        <th><a
                                                href="{{ route('admin.print-diagnostic-report', $diagnosticResult) }}">Print</a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.diagnostic-result-list') }}">
                        View all
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Recent IPD Diagnostic Result</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Patient Name</th>
                                    <th>Result Code</th>
                                    <th>Bill No</th>
                                    <th>Ref No</th>
                                    <th>Result Date</th>
                                    <th>Satus</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\Pathology\IpdDiagnosticResult::latest()->take(10)->get() as $diagnosticResult)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $diagnosticResult?->patient?->name }}</td>
                                        <td>{{ $diagnosticResult->code }}</td>
                                        <td>{{ $diagnosticResult?->ip_service_billing?->code }}</td>
                                        <td>{{ $diagnosticResult->ref_no }}</td>
                                        <td>{{ $diagnosticResult->created_at }}</td>
                                        <td>{{ $diagnosticResult->status == 1 ? 'Done' : 'Pending' }}</td>
                                        <th>
                                            <a
                                                href="{{ route('admin.ipd.print-diagnostic-report', $diagnosticResult) }}">
                                                Print
                                            </a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.ipd.diagnostic-result-list') }}">View all</a>
                </div>
            </div>
        </div>
    </div>

</div>
