<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">IPD List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">IPD List</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>UMR No</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Reason</th>
                                <th>Company</th>
                                <th>Payment by</th>
                                <th>Payment</th>
                                <th>Policy No.</th>
                                <th>Admit Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ipd_list as $index => $ipd)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $ipd->patient->registration_no }}</td>
                                    <td>{{ $ipd->patient->name }}</td>
                                    <td>{{ $ipd->ipdcode }}</td>
                                    <td>{{ $ipd->reason }}</td>
                                    <td>{{ $ipd->company }}</td>
                                    <td>{{ $ipd->payment_by }}</td>
                                    <td>{{ $ipd->payment }}</td>
                                    <td>{{ $ipd->policy_no }}</td>
                                    <td>{{ $ipd->admit_type }}</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @if ($ipd_details)
        @include('livewire.ipd.ipd-list.modal')

        @push('page-script')
            <script>
                $("#ipdDetails").modal('show');
            </script>
        @endpush
    @endif

</div>
