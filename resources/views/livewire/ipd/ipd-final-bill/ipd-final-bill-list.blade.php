<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">IP Final Bill List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">IP Final Bill List</li>
                    </ul>
                </div>

                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.ipd.ip-final-bill.create') }}" class="btn add-btn" tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add IP Final Bill
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 14, "desc" ]]'
                        class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Bill No.</th>
                                <th>IPD</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>Due Amount</th>
                                <th>Authorized By</th>
                                <th>Concession</th>
                                <th>Authorized By</th>
                                <th>Amount</th>
                                <th>Mode</th>
                                <th>Transaction ID</th>
                                <th>Remarks</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ip_final_bills as $ip_final_bill)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ip_final_bill->bill_no }}</td>
                                    <td>{{ $ip_final_bill?->ipd?->ipdcode }}</td>
                                    <td>{{ $ip_final_bill?->patient?->registration_no }}</td>
                                    <td>{{ $ip_final_bill?->patient?->name }}</td>
                                    <td>{{ $ip_final_bill?->due_amount }}</td>
                                    <td>{{ $ip_final_bill?->due_authorized_by?->name }}</td>
                                    <td>{{ $ip_final_bill?->concession }}</td>
                                    <td>{{ $ip_final_bill?->concession_authorized_by?->name }}</td>
                                    <td>{{ $ip_final_bill?->amount }}</td>
                                    <td>{{ $ip_final_bill?->payment_mode }}</td>
                                    <td>{{ $ip_final_bill?->transaction_id }}</td>
                                    <td>{{ $ip_final_bill?->remarks }}</td>
                                    <td>{{ $ip_final_bill?->created_by?->name }}</td>
                                    <td>{{ $ip_final_bill?->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.ipd.ip-final-bill.print', $ip_final_bill?->id) }}"
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
