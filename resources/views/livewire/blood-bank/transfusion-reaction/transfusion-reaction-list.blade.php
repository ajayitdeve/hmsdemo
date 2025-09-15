<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Transfusion Reaction</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Transfusion Reaction</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.transfusion-reaction.create') }}" class="btn add-btn" tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add Transfusion Reaction
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
                                <th>Blood Requisition</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>IPD No</th>
                                <th>Blood Group</th>
                                <th>Is Return</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transfusion_reaction_list as $transfusion_reaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.transfusion-reaction.edit', $transfusion_reaction->id) }}">
                                            {{ $transfusion_reaction->code }}
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('admin.blood-requisition-request.edit', $transfusion_reaction?->blood_requisition_request_id) }}">
                                            {{ $transfusion_reaction?->blood_requisition_request?->code }}
                                        </a>
                                    </td>
                                    <td>{{ $transfusion_reaction?->patient?->registration_no }}</td>
                                    <td>{{ $transfusion_reaction?->patient?->name }}</td>

                                    <td>{{ $transfusion_reaction?->ipd?->ipdcode }}</td>
                                    <td>{{ $transfusion_reaction?->blood_group?->name }}</td>

                                    <td>{{ $transfusion_reaction?->status ? 'Yes' : 'No' }}</td>

                                    <td>{{ $transfusion_reaction?->created_by?->name }}</td>
                                    <td>{{ $transfusion_reaction?->updated_by?->name }}</td>
                                    <td>{{ $transfusion_reaction->created_at }}</td>
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
