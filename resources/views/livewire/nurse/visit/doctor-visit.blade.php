<div>
    @push('page-css')
        <style>
            .form-control {
                font-size: 13px;
                height: 30px !important;
            }

            label {
                display: inline-block;
                margin-bottom: 0px;
                font-size: 13px;
            }
        </style>
    @endpush

    <!-- Page Content -->
    <div class="content container-fluid mb-0 pb-0">
        <div class="row mb-0 pb-0">
            <div class="col-md-12 mb-0 pb-0">
                @include('partials.alert-message')

                <div>
                    <form wire:submit.prevent='save' class="mb-0 pb-0">

                        <div class="card">
                            <div class="card-header">
                                <h3>Doctor Visits</h3>
                            </div>

                            <div class="card-body" style="background: {{ $bg_color }}">
                                <div class="row mb-0 pb-0">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>UMR No<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly wire:model="umr">
                                            @error('umr')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Patient Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Patient Type</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_type">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input class="form-control" type="text" readonly wire:model="status">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control" type="text" readonly wire:model="age">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <input class="form-control" type="text" readonly wire:model="gender">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Consultant</label>
                                            <input class="form-control" type="text" readonly wire:model="consultant">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Corp. Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="corporate_name">
                                            @error('corporate_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Admn No.<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly wire:model="admn_no">
                                            @error('admn_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Admn Date<span class="text-danger">*</span></label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="admn_date">
                                            @error('admn_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Ward</label>
                                            <input class="form-control" type="text" readonly wire:model="ward">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Room</label>
                                            <input class="form-control" type="text" readonly wire:model="room">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Bed</label>
                                            <input class="form-control" type="text" readonly wire:model="bed">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0 align-items-end">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Doctor Visit No.</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="doctor_visit_no">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Service Date</th>
                                                    <th>Service Type</th>
                                                    <th>Doctor Name</th>
                                                    <th>Visit Time</th>
                                                    <th>Doctor Code</th>
                                                    <th>Department</th>
                                                    <th>Service Ward</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="date"
                                                            wire:model="service_date">
                                                        @error('service_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>

                                                    <td>
                                                        <input class="form-control" type="text"
                                                            wire:model="service_type">
                                                        @error('service_type')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>

                                                    <td>
                                                        <select class="form-control select2" name="doctor_id"
                                                            data-placeholder="Select doctor" wire:model="doctor_id">
                                                            <option value=""></option>
                                                            @foreach ($doctors as $doctor)
                                                                <option value="{{ $doctor->id }}">
                                                                    {{ $doctor->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('doctor_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>

                                                    <td>
                                                        <input class="form-control" type="datetime-local"
                                                            wire:model="visit_date_time">
                                                        @error('visit_date_time')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>

                                                    <td>
                                                        <input class="form-control" type="text"
                                                            wire:model="doctor_code" readonly>
                                                        @error('doctor_code')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>

                                                    <td>
                                                        <input class="form-control" type="text"
                                                            wire:model="department" readonly>
                                                        @error('department')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>

                                                    <td>
                                                        <input class="form-control" type="text"
                                                            wire:model="service_ward" readonly>
                                                        @error('service_ward')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table data-order='[[ 10, "desc" ]]'
                                    class="datatable table table-stripped mb-0 dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>IPD Code</th>
                                            <th>UMR</th>
                                            <th>Visit Code</th>
                                            <th>Service Date</th>
                                            <th>Service Type</th>
                                            <th>Doctor</th>
                                            <th>Visit Date & Time</th>
                                            <th>Is Cancelled</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($doctor_visit_list)
                                            @foreach ($doctor_visit_list as $index => $doctor_visit)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $doctor_visit?->ipd?->ipdcode }}</td>
                                                    <td>{{ $doctor_visit?->patient?->registration_no }}</td>
                                                    <td>{{ $doctor_visit->code }}</td>
                                                    <td>{{ $doctor_visit->service_date }}</td>
                                                    <td>{{ $doctor_visit->service_type }}</td>
                                                    <td>{{ $doctor_visit?->doctor?->name }}</td>
                                                    <td>
                                                        {{ date('d-M-Y h:i a', strtotime($doctor_visit->visit_date_time)) }}
                                                    </td>
                                                    <td>
                                                        @if ($doctor_visit->is_cancelled == 0)
                                                            <a class="text-success" href="javascript:void(0)"
                                                                wire:click="view_cancel_visit({{ $doctor_visit->id }}, true)">NO</a>
                                                        @else
                                                            <a class="text-danger" href="javascript:void(0)"
                                                                wire:click="view_cancel_visit({{ $doctor_visit->id }}, false)">YES</a>
                                                        @endif
                                                    </td>
                                                    <td>{{ $doctor_visit?->created_by?->name }}</td>
                                                    <td>{{ $doctor_visit->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Indent Modal -->
    <div wire:ignore.self class="modal custom-modal fade" id="cancelVisit" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cancel Visit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='cancel_visit'>
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
                $("#cancelVisit").modal('show');
            });
            window.addEventListener('hide-cancel-modal', event => {
                $("#cancelVisit").modal('hide');
            });

            $(document).ready(function() {
                $('.select2').select2({
                    width: '100%',
                });
            });

            $(document).on("change", ".select2", function() {
                let input_name = $(this).attr("name");
                @this.set(input_name, $(this).val());
            });

            $(document).on("change", "select[name='doctor_id']", function() {
                @this.call("doctorChanged");
            });
        </script>
    @endpush
</div>
