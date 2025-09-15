<div>
    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">All Corporate Consultation</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Corporate Consultation</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 6, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>Consultation No.</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>Organization</th>
                                <th>Visit Type</th>
                                <th>Doctor</th>
                                <th>Created By </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($corporate_consultation_list as $corporate_consultation)
                                <tr>
                                    <td>{{ $corporate_consultation->code }}</td>
                                    <td>{{ $corporate_consultation?->patient?->registration_no }}</td>
                                    <td>{{ $corporate_consultation?->patient?->name }}</td>
                                    <td>{{ $corporate_consultation?->organization?->name }}</td>
                                    <td>{{ $corporate_consultation?->visit_type?->name }}</td>
                                    <td>{{ $corporate_consultation?->doctor?->name }}</td>
                                    <td>{{ $corporate_consultation->created_at }}</td>
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
    @endpush
</div>
