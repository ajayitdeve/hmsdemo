<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Blood Requisition Request</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Blood Requisition Request</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.blood-requisition-request.create') }}" class="btn add-btn" tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add Blood Requisition Request
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 10, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <td>Sr. No.</td>
                                <th>Code</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>IPD No</th>
                                <th>Ref Doctor Name</th>
                                <th>Blood Group</th>
                                <th>PRBC</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Approved By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blood_requisition_requests as $blood_requisition_request)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.blood-requisition-request.edit', $blood_requisition_request->id) }}">{{ $blood_requisition_request->code }}</a>
                                    </td>

                                    @if ($blood_requisition_request->type == 'outside-patient')
                                        <td>{{ $blood_requisition_request?->out_side_patient?->registration_no }}</td>
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
                                    <td>{{ $blood_requisition_request?->created_by?->name }}</td>
                                    <td>{{ $blood_requisition_request?->updated_by?->name }}</td>
                                    <td>{{ $blood_requisition_request->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @push('page-script')
        <script></script>
    @endpush

</div>
