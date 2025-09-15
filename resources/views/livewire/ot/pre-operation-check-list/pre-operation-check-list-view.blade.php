<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Pre Operation CheckList</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pre Operation CheckList</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.ot.pre-operation-checklist.create') }}" class="btn add-btn" tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add Pre Operation CheckList
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
                                <th>OT Pre Operation</th>
                                <th>Surgery</th>
                                <th>Surgery Date</th>
                                <th>Blood Group</th>
                                <th>Weight</th>
                                <th>Height</th>
                                <th>Created By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pre_operation_checklists as $pre_operation_checklist)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.ot.pre-operation-checklist.edit', $pre_operation_checklist->id) }}">
                                            {{ $pre_operation_checklist->code }}
                                        </a>
                                    </td>
                                    <td>{{ $pre_operation_checklist?->patient?->registration_no }}</td>
                                    <td>{{ $pre_operation_checklist?->patient?->name }}</td>
                                    <td>{{ $pre_operation_checklist?->ipd?->ipdcode }}</td>
                                    <td>{{ $pre_operation_checklist?->ot_pre_operation?->code }}</td>
                                    <td>{{ $pre_operation_checklist?->service?->name }}</td>
                                    <td>{{ date('d-M-Y', strtotime($pre_operation_checklist->surgery_date)) }}</td>
                                    <td>{{ $pre_operation_checklist?->blood_group?->name }}</td>
                                    <td>{{ $pre_operation_checklist->weight }}</td>
                                    <td>{{ $pre_operation_checklist->height }}</td>
                                    <td>{{ $pre_operation_checklist?->created_by?->name }}</td>
                                    <td>{{ $pre_operation_checklist->created_at }}</td>
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
