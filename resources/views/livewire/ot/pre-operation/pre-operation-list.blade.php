<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Pre Operation</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pre Operation</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.ot.pre-operation.create') }}" class="btn add-btn" tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add Pre Operation
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 9, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <td>Sr. No.</td>
                                <th>Code</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>IPD No</th>
                                <th>OT Booking Code</th>
                                <th>Type</th>
                                <th>Surgery</th>
                                <th>Surgery Type</th>
                                <th>Surgery Date</th>
                                <th>OT</th>
                                <th>Created By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pre_operations as $pre_operation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('admin.ot.pre-operation.edit', $pre_operation->id) }}">
                                            {{ $pre_operation->code }}
                                        </a>
                                    </td>
                                    <td>{{ $pre_operation?->patient?->registration_no }}</td>
                                    <td>{{ $pre_operation?->patient?->name }}</td>
                                    <td>{{ $pre_operation?->ipd?->ipdcode }}</td>
                                    <td>{{ $pre_operation?->ot_booking?->code }}</td>
                                    <td>{{ ucfirst($pre_operation->type) }}</td>
                                    <td>{{ $pre_operation?->service?->name }}</td>
                                    <td>{{ $pre_operation?->surgery_type?->name }}</td>
                                    <td>{{ date('d-M-Y', strtotime($pre_operation->surgery_date)) }}</td>
                                    <td>{{ $pre_operation?->ot?->name }}</td>
                                    <td>{{ $pre_operation?->created_by?->name }}</td>
                                    <td>{{ $pre_operation->created_at }}</td>
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
