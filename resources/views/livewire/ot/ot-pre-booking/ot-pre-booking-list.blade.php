<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">OT Pre Booking</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">OT Pre Booking</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.ot.ot-pre-booking.create') }}" class="btn add-btn" tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add OT Pre Booking
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 11, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <td>Sr. No.</td>
                                <th>Code</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>IPD No</th>
                                <th>Ref Doctor Name</th>
                                <th>Surgery</th>
                                <th>Surgery Date</th>
                                <th>Surgery Type</th>
                                <th>For Day Care</th>
                                <th>Created By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ot_pre_bookings as $ot_pre_booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.ot.ot-pre-booking.edit', $ot_pre_booking->id) }}">{{ $ot_pre_booking->code }}</a>
                                    </td>

                                    @if ($ot_pre_booking->type == 'outside-patient')
                                        <td>{{ $ot_pre_booking?->out_side_patient?->registration_no }}</td>
                                        <td>{{ $ot_pre_booking?->out_side_patient?->name }}</td>
                                    @else
                                        <td>{{ $ot_pre_booking?->patient?->registration_no }}</td>
                                        <td>{{ $ot_pre_booking?->patient?->name }}</td>
                                    @endif

                                    <td>{{ $ot_pre_booking?->ipd?->ipdcode }}</td>
                                    <td>{{ $ot_pre_booking?->doctor?->name }}</td>
                                    <td>{{ $ot_pre_booking?->service?->name }}</td>
                                    <td>{{ date('d-M-Y h:i a', strtotime($ot_pre_booking->surgery_date)) }}</td>
                                    <td>{{ $ot_pre_booking?->surgery_type?->name }}</td>
                                    <td>{{ $ot_pre_booking?->for_day_care ? 'Y' : 'N' }}</td>
                                    <td>{{ $ot_pre_booking?->created_by?->name }}</td>
                                    <td>{{ $ot_pre_booking->created_at }}</td>
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
