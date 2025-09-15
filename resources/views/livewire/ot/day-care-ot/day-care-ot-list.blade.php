<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Day Care</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Day Care</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.ot.day-care.create') }}" class="btn add-btn" tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add Day Care
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 13, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <td>Sr. No.</td>
                                <th>Code</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>IPD No</th>
                                <th>OT Booking Code</th>
                                <th>Type</th>
                                <th>Surgery</th>
                                <th>Surgery Type</th>
                                <th>Surgery Date</th>
                                <th>OT</th>
                                <th>Ref Doctor Name</th>
                                <th>Created By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($day_care_ots as $day_care_ot)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.ot.day-care.edit', $day_care_ot->id) }}">{{ $day_care_ot->code }}</a>
                                    </td>
                                    <td>{{ $day_care_ot?->patient?->registration_no }}</td>
                                    <td>{{ $day_care_ot?->patient?->name }}</td>
                                    <td>{{ $day_care_ot?->ipd?->ipdcode }}</td>
                                    <td>{{ $day_care_ot?->ot_booking?->code }}</td>
                                    <td>{{ ucfirst($day_care_ot->type) }}</td>
                                    <td>{{ $day_care_ot?->service?->name }}</td>
                                    <td>{{ $day_care_ot?->surgery_type?->name }}</td>
                                    <td>{{ date('d-M-Y', strtotime($day_care_ot->surgery_date)) }}</td>
                                    <td>{{ $day_care_ot?->ot?->name }}</td>
                                    <td>{{ $day_care_ot?->doctor?->name }}</td>
                                    <td>{{ $day_care_ot?->created_by?->name }}</td>
                                    <td>{{ $day_care_ot->created_at }}</td>
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
