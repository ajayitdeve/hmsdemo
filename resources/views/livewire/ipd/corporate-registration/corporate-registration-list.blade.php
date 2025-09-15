<div>
    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">All Corporate Registration</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Corporate Registration</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 8, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Consultation No.</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>Organization</th>
                                <th>Department</th>
                                <th>Unit</th>
                                <th>Fee</th>
                                <th>Is Cancelled</th>
                                <th>Created By</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($corporate_registration_list as $corporate_registration)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $corporate_registration?->corporate_consultation?->code }}</td>
                                    <td>{{ $corporate_registration?->patient?->registration_no }}</td>
                                    <td>{{ $corporate_registration?->patient?->name }}</td>
                                    <td>{{ $corporate_registration?->organization?->name }}</td>
                                    <td>{{ $corporate_registration?->department?->name }}</td>
                                    <td>{{ $corporate_registration?->unit?->name }}</td>
                                    <td>{{ $corporate_registration?->corporate_fee }}</td>
                                    <td>
                                        @if ($corporate_registration->is_cancelled == 0)
                                            <a class="text-success" href="javascript:void(0)"
                                                wire:click="view_cancel_registration({{ $corporate_registration->id }}, true)">NO</a>
                                        @else
                                            <a class="text-danger" href="javascript:void(0)"
                                                wire:click="view_cancel_registration({{ $corporate_registration->id }}, false)">YES</a>
                                        @endif
                                    </td>
                                    <td>{{ $corporate_registration->created_at }}</td>
                                    <td class="text-center">
                                        @if ($corporate_registration->is_cancelled == 0)
                                            <a class="text-dark"
                                                href="{{ route('admin.ipd.corporate-registration-print', $corporate_registration->id) }}">
                                                <i class="material-icons">print</i>
                                            </a>
                                        @else
                                            Cancelled
                                        @endif
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

    <!-- Cancel Indent Modal -->
    <div wire:ignore.self class="modal custom-modal fade" id="cancelRegistration" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cancel Corporate Registration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='cancel_registration'>
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
                $("#cancelRegistration").modal('show');
            });
            window.addEventListener('hide-cancel-modal', event => {
                $("#cancelRegistration").modal('hide');
            });
        </script>
    @endpush
</div>
