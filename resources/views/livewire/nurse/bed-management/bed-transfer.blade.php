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
                                <h3>Bed Transfer</h3>
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
                                            <label>Status</label>
                                            <input class="form-control" type="text" readonly wire:model="status">
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
                                            <label>Cost Center<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="cost_center_id"
                                                data-placeholder="Select cost center" wire:model="cost_center_id">
                                                <option value=""></option>
                                                @foreach ($cost_centers as $cost_center)
                                                    <option value="{{ $cost_center->id }}">
                                                        {{ $cost_center->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('cost_center_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Ward<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="ward_id"
                                                data-placeholder="Select ward" wire:model="ward_id">
                                                <option value=""></option>
                                                @foreach ($wards as $ward)
                                                    <option value="{{ $ward->id }}">
                                                        {{ $ward->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('ward_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Room<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="room_id" wire:model="room_id"
                                                data-placeholder="Select room" wire:change="roomChanged">
                                                <option value=""></option>
                                                @foreach ($rooms as $room)
                                                    <option value="{{ $room->id }}">
                                                        {{ $room->display_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('room_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Bed<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="bed_id"
                                                data-placeholder="Select bed" wire:model="bed_id">
                                                <option value=""></option>
                                                @foreach ($beds as $bed)
                                                    <option value="{{ $bed->id }}">
                                                        {{ $bed->display_name }} - {{ $bed->bed_status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('bed_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <a wire:click="getBedChart" href="#" data-toggle="modal"
                                                data-target="#bedChart" class="btn btn-danger btn-block">
                                                <i class="fa fa-bed btn-danger fa-lg" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Transfer Date</label>
                                            <input type="date" class="form-control" wire:model="transfer_date">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Transfer Time</label>
                                            <input type="time" class="form-control" wire:model="transfer_time">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Authorized By<span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="authorized_by_id">
                                                <option value="">Select one</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('authorized_by_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Reason<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" wire:model="reason">
                                            @error('reason')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table data-order='[[ 8, "desc" ]]'
                                    class="datatable table table-stripped mb-0 dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>From Ward/Room/Bed</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Allocation</th>
                                            <th>Transfer</th>
                                            <th>Reason for Transfer</th>
                                            <th>Authorized By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bed_transfer_list as $bed_transfer)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $bed_transfer?->ward?->name }} /
                                                    {{ $bed_transfer?->room?->name }} /
                                                    {{ $bed_transfer?->bed?->display_name }}
                                                </td>
                                                <td>{{ date('d-M-Y h:i a', strtotime($bed_transfer->from)) }}</td>
                                                <td>
                                                    {{ $bed_transfer->to ? date('d-M-Y h:i a', strtotime($bed_transfer->to)) : '-' }}
                                                </td>
                                                <td>{{ $bed_transfer->is_ipd_allocation ? 'YES' : 'NO' }}</td>
                                                <td>{{ $bed_transfer->is_transfer ? 'YES' : 'NO' }}</td>
                                                <td>{{ $bed_transfer->transfer_narration }}</td>
                                                <td>{{ $bed_transfer?->updated_by?->name }}</td>
                                                <td>{{ $bed_transfer->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /Page Content -->
    @include('livewire.ipd.ipd.modal')
    @push('page-script')
        <script>
            window.addEventListener('close-modal', event => {
                $("#bedChart").modal('hide');
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

            $(document).on("change", "select[name='ward_id']", function() {
                @this.call("wardChanged");
            });

            $(document).on("change", "select[name='room_id']", function() {
                @this.call("roomChanged");
            });
        </script>
    @endpush
</div>
