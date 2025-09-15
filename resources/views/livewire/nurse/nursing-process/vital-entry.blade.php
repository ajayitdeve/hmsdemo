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
                                <h3>Vital Entry</h3>
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
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Time</th>
                                                <th colspan="2" class="text-center">BP</th>
                                                <th colspan="2" class="text-center">Temperature</th>
                                                <th colspan="2" class="text-center">Height</th>
                                                <th colspan="2" class="text-center">Weight</th>
                                                <th colspan="2" class="text-center">Pulse</th>
                                                <th colspan="2" class="text-center">Respiration</th>
                                                <th colspan="2" class="text-center">CVP</th>
                                                <th colspan="2" class="text-center">Saturation</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input class="form-control" type="datetime-local"
                                                        wire:model="date_time">
                                                    @error('date_time')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text" wire:model="bp"
                                                        id="bp-input" style="width: 80px;">
                                                    @error('bp')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" wire:model="bp_unit"
                                                        style="width: 70px;">
                                                    @error('bp_unit')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="temperature" style="width: 70px;">
                                                    @error('temperature')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <select class="form-control" wire:model="temperature_unit"
                                                        style="width: 70px">
                                                        @foreach ($temperature_units as $unit)
                                                            <option value="{{ $unit }}">
                                                                {{ $unit }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('temperature_unit')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text" wire:model="height"
                                                        style="width: 70px;">
                                                    @error('height')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <select class="form-control" wire:model="height_unit"
                                                        style="width: 80px">
                                                        @foreach ($height_units as $unit)
                                                            <option value="{{ $unit }}">
                                                                {{ $unit }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('height_unit')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text" wire:model="weight"
                                                        style="width: 70px;">
                                                    @error('weight')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <select class="form-control" wire:model="weight_unit"
                                                        style="width: 70px">
                                                        @foreach ($weight_units as $unit)
                                                            <option value="{{ $unit }}">
                                                                {{ $unit }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('weight_unit')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text" wire:model="pulse"
                                                        style="width: 70px;">
                                                    @error('pulse')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="pulse_unit" style="width: 70px;">
                                                    @error('pulse_unit')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="respiration" style="width: 70px;">
                                                    @error('respiration')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="respiration_unit" style="width: 100px">
                                                    @error('respiration_unit')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text" wire:model="cvp"
                                                        style="width: 70px;">
                                                    @error('cvp')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" wire:model="cvp_unit"
                                                        style="width: 70px;">
                                                    @error('cvp_unit')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="saturation" style="width: 70px;">
                                                    @error('saturation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="saturation_unit" style="width: 80px;">
                                                    @error('saturation_unit')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                                <table data-order='[[ 11, "desc" ]]'
                                    class="datatable table table-stripped mb-0 dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Entry Date Time</th>
                                            <th>BP</th>
                                            <th>Temperature</th>
                                            <th>Height</th>
                                            <th>Weight</th>
                                            <th>Pulse</th>
                                            <th>Respiration</th>
                                            <th>CVP</th>
                                            <th>Saturation</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vitals as $vital)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ date('d-M-Y h:i a', strtotime($vital->date_time)) }}</td>
                                                <td>{{ $vital->bp }} {{ $vital->bp_unit }}</td>
                                                <td>{{ $vital->temperature }} {{ $vital->temperature_unit }}</td>
                                                <td>{{ $vital->height }} {{ $vital->height_unit }}</td>
                                                <td>{{ $vital->weight }} {{ $vital->weight_unit }}</td>
                                                <td>{{ $vital->pulse }} {{ $vital->pulse_unit }}</td>
                                                <td>{{ $vital->respiration }} {{ $vital->respiration_unit }}</td>
                                                <td>{{ $vital->cvp }} {{ $vital->cvp_unit }}</td>
                                                <td>{{ $vital->saturation }} {{ $vital->saturation_unit }}</td>
                                                <td>{{ $vital?->created_by?->name }}</td>
                                                <td>{{ $vital->created_at }}</td>
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

    @push('page-script')
        <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Inputmask("999/999").mask("#bp-input");
            });
        </script>
    @endpush
</div>
