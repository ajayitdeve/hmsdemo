<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Post Operation</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Post Operation</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.ot.post-operation.create') }}" class="btn add-btn" tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add Post Operation
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 11, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <td>Sr. No.</td>
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
                                <th>Created By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($post_operations as $post_operation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('admin.ot.post-operation.edit', $post_operation->id) }}">
                                            {{ $post_operation->code }}
                                        </a>
                                    </td>
                                    <td>{{ $post_operation?->patient?->registration_no }}</td>
                                    <td>{{ $post_operation?->patient?->name }}</td>
                                    <td>{{ $post_operation?->ipd?->ipdcode }}</td>
                                    <td>{{ $post_operation?->ot_booking?->code }}</td>
                                    <td>{{ $post_operation?->ot_pre_operation?->code }}</td>
                                    <td>{{ $post_operation?->service?->name }}</td>
                                    <td>{{ date('d-M-Y', strtotime($post_operation->surgery_date)) }}</td>
                                    <td>{{ $post_operation?->surgery_type?->name }}</td>
                                    <td>{{ $post_operation?->ot_type?->name }}</td>
                                    <td>{{ $post_operation?->created_by?->name }}</td>
                                    <td>{{ $post_operation->created_at }}</td>
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
