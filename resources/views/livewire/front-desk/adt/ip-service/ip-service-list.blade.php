<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">IP Service Billing List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">IP Service Billing List</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 7, "desc" ]]' class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Bill No.</th>
                                <th>Lab Indent</th>
                                <th>IPD</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>Remarks</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ip_service_billings as $ip_service_billing)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ip_service_billing->code }}</td>
                                    <td>{{ $ip_service_billing?->lab_indent?->code }}</td>
                                    <td>{{ $ip_service_billing?->ipd?->ipdcode }}</td>
                                    <td>{{ $ip_service_billing?->patient?->registration_no }}</td>
                                    <td>{{ $ip_service_billing?->patient?->name }}</td>
                                    <td>{{ $ip_service_billing->remarks }}</td>
                                    <td>{{ $ip_service_billing->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.front-desk.adt.ip-service.billing.print', $ip_service_billing->id) }}"
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
