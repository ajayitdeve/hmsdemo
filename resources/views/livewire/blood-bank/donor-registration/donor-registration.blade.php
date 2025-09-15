<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Donor Registration</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Donor Registration</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.blood-bank.donor-registration.create') }}" class="btn add-btn"
                        tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add Donor Registration
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
                                <th>Name</th>
                                <th>Relation</th>
                                <th>Relation Name</th>
                                <th>Mobile</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>IPD No</th>
                                <th>Created By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donor_list as $donor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('admin.blood-bank.donor-registration.edit', $donor->id) }}">
                                            {{ $donor->code }}
                                        </a>
                                    </td>
                                    <td>{{ $donor->name }}</td>
                                    <td>{{ $donor->relation?->name }}</td>
                                    <td>{{ $donor->father_name }}</td>
                                    <td>{{ $donor->mobile }}</td>
                                    <td>{{ $donor?->patient?->registration_no }}</td>
                                    <td>{{ $donor?->patient?->name }}</td>
                                    <td>{{ $donor?->ipd?->ipdcode }}</td>
                                    <td>{{ $donor?->created_by?->name }}</td>
                                    <td>{{ $donor->created_at }}</td>
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
