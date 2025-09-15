<div class="content container-fluid">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card card-stats p-2">
                <div class="">
                    <h3>All IPD Diagnostic Result</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0">
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
                                @foreach ($diagnosticResults as $diagnosticResult)
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
            </div>
        </div>
    </div>

</div>
