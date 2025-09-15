<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">IP Pharmacy Billing List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">IP Pharmacy Billing List</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 9, "desc" ]]' class="datatable table table-stripped mb-0 dataTable">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Bill No.</th>
                                <th>NRQ No.</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>IPD Code</th>
                                <th>Total</th>
                                <th>Stock Point</th>
                                <th>Destination Name</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ip_pharmacy_bills as $ip_pharmacy_billing)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ip_pharmacy_billing->code }}</td>
                                    <td>{{ $ip_pharmacy_billing?->pharmacy_indent?->nrq_code }}</td>
                                    <td>{{ $ip_pharmacy_billing?->patient?->registration_no }}</td>
                                    <td>{{ $ip_pharmacy_billing?->patient?->name }}</td>
                                    <td>{{ $ip_pharmacy_billing?->ipd?->ipdcode }}</td>
                                    <td>{{ $ip_pharmacy_billing->total }}</td>
                                    <td>{{ $ip_pharmacy_billing?->stock_point?->name }}</td>
                                    <td>{{ $ip_pharmacy_billing->drug_destination_name }}</td>
                                    <td>{{ $ip_pharmacy_billing->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.pharmacy.issues.ip-pharmacy-billing.print', $ip_pharmacy_billing->id) }}"
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
