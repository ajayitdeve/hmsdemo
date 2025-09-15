<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">OT Booking</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">OT Booking</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.ot.ot-booking.create') }}" class="btn add-btn" tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add OT Booking
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[11, "desc" ]]' class="datatable table table-stripped mb-0">
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
                                <th>For Day Care</th>
                                <th>Is Cancelled</th>
                                <th>Created By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ot_bookings as $ot_booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('admin.ot.ot-booking.edit', $ot_booking->id) }}">
                                            {{ $ot_booking->code }}
                                        </a>
                                    </td>
                                    <td>{{ $ot_booking?->patient?->registration_no }}</td>
                                    <td>{{ $ot_booking?->patient?->name }}</td>
                                    <td>{{ $ot_booking?->ipd?->ipdcode }}</td>
                                    <td>{{ $ot_booking?->doctor?->name }}</td>
                                    <td>{{ $ot_booking?->service?->name }}</td>
                                    <td>{{ date('d-M-Y', strtotime($ot_booking->surgery_date)) }}</td>
                                    <td>{{ $ot_booking?->for_day_care ? 'Y' : 'N' }}</td>
                                    <td>
                                        @if ($ot_booking->is_cancelled)
                                            <a href="javascript:void(0);" class="text-danger"
                                                wire:click="booking_cancel_view({{ $ot_booking->id }}, false)">Y</a>
                                        @else
                                            <a href="javascript:void(0);" class="text-success"
                                                wire:click="booking_cancel_view({{ $ot_booking->id }}, true)">N</a>
                                        @endif
                                    </td>
                                    <td>{{ $ot_booking?->created_by?->name }}</td>
                                    <td>{{ $ot_booking->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Cancel Modal -->
    <div wire:ignore.self class="modal custom-modal fade" id="cancelModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cancel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='booking_cancel'>
                        <div class="form-group">
                            <label>Reason</label>
                            <textarea class="form-control" wire:model="reason"></textarea>
                            @error('reason')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Approved By</label>
                            <select class="form-control" wire:model="approved_by">
                                <option value="">Select one</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('approved_by')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @if ($show_cancel_button)
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Cancel Now</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('page-script')
        <script>
            window.addEventListener('show-cancel-modal', event => {
                $("#cancelModal").modal('show');
            });
            window.addEventListener('hide-cancel-modal', event => {
                $("#cancelModal").modal('hide');
            });
        </script>
    @endpush

</div>
