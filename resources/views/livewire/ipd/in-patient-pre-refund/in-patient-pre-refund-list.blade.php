<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">In Patient Pre Refund List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">In Patient Pre Refund List</li>
                    </ul>
                </div>

                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.ipd.in-patient-pre-refund.create') }}" class="btn add-btn" tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add Pre Refund
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 10, "desc" ]]'
                        class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Refund No.</th>
                                <th>IPD</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
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
                            @foreach ($in_patient_pre_refunds as $in_patient_pre_refund)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $in_patient_pre_refund->refund_no }}</td>
                                    <td>{{ $in_patient_pre_refund?->ipd?->ipdcode }}</td>
                                    <td>{{ $in_patient_pre_refund?->patient?->registration_no }}</td>
                                    <td>{{ $in_patient_pre_refund?->patient?->name }}</td>
                                    <td>{{ $in_patient_pre_refund->amount }}</td>
                                    <td>{{ $in_patient_pre_refund->payment_mode }}</td>
                                    <td>{{ $in_patient_pre_refund->transaction_id }}</td>
                                    <td>{{ $in_patient_pre_refund->remarks }}</td>
                                    <td>{{ $in_patient_pre_refund?->created_by?->name }}</td>
                                    <td>{{ $in_patient_pre_refund->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.ipd.in-patient-pre-refund.print', $in_patient_pre_refund->id) }}"
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
