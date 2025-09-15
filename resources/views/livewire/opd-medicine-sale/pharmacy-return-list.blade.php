<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Pharmacy Return List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pharmacy Return List</li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /Page Header -->
        {{-- <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control mb-2" wire:model.live.debounce.300mx="search" placeholder="search">
            </div>
        </div> --}}
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 10, "desc" ]]'
                        class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Code</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>Type</th>
                                <th>Return Date</th>
                                <th>Cause</th>
                                <th>Remarks</th>
                                <th>Returned By</th>
                                <th>Stock Point</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pharmacyReturns as $pharmacyReturn)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a
                                            href="{{ route('admin.pharmacy.pharmacy-return-list-items', $pharmacyReturn->id) }}">{{ $pharmacyReturn->code }}</a>
                                    </td>
                                    <td>{{ $pharmacyReturn->patient->registration_no }}</td>
                                    <td>{{ $pharmacyReturn->patient->name }}</td>
                                    <td>{{ $pharmacyReturn->patient_type }}</td>
                                    <td>{{ $pharmacyReturn->return_date }}</td>
                                    <td>{{ $pharmacyReturn->cause }}</td>
                                    <td>{{ $pharmacyReturn->remarks }}</td>
                                    <td> {{ $pharmacyReturn->approvedBy->name }}</td>
                                    <td>{{ $pharmacyReturn->stockPoint->name }}</td>
                                    <td>{{ $pharmacyReturn->created_at }}</td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <a class="dropdown-item"
                                                    href="{{ route('admin.pharmacy.pharmacy-return-list-items', $pharmacyReturn->id) }}"><i
                                                        class="fa fa-eye m-r-5"></i> View</a>
                                            </div>
                                        </div>
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


</div>
