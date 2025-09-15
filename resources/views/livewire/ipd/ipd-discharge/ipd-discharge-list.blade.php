<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">IP Discharge List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">IP Discharge List</li>
                    </ul>
                </div>

                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.ipd.ip-discharge.create') }}" class="btn add-btn" tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add IP Discharge
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 11, "desc" ]]'
                        class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Discharge No.</th>
                                <th>IPD</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>Consultant</th>
                                <th>Due Reference</th>
                                <th>Discharge Type</th>
                                <th>Discharge Status</th>
                                <th>Diagnosis</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ip_discharges as $ip_discharge)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ip_discharge->discharge_no }}</td>
                                    <td>{{ $ip_discharge?->ipd?->ipdcode }}</td>
                                    <td>{{ $ip_discharge?->patient?->registration_no }}</td>
                                    <td>{{ $ip_discharge?->patient?->name }}</td>
                                    <td>{{ $ip_discharge?->doctor?->name }}</td>
                                    <td>{{ $ip_discharge?->organization?->name }}</td>
                                    <td>{{ $ip_discharge?->dischargeType?->name }}</td>
                                    <td>{{ $ip_discharge?->discharge_status }}</td>
                                    <td>{{ $ip_discharge?->diagnosis }}</td>
                                    <td>{{ $ip_discharge?->created_by?->name }}</td>
                                    <td>{{ $ip_discharge?->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.ipd.ip-discharge.print', $ip_discharge?->id) }}"
                                            class="text-dark">
                                            <i class="material-icons">print</i>
                                        </a>
                                    </td>
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
