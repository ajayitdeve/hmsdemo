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
                                <h3>To Be Discharged Patient</h3>
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
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Discharge No.</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="discharge_no">
                                        </div>
                                    </div>
                                    <div class="col-md-9"></div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Admitted Doctor Code</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="admitted_doctor_code">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Admitted Doctor Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="admitted_doctor_name">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Department</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="admitted_doctor_department">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Discharge Date</label>
                                            <input class="form-control" type="datetime-local"
                                                wire:model="discharge_date_time">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Discharge Doctor Code<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" wire:model="doctor_code"
                                                readonly>
                                            @error('doctor_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Discharge Doctor<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="doctor_id"
                                                data-placeholder="Select doctor" wire:model="doctor_id">
                                                <option value=""></option>
                                                @if ($doctors)
                                                    @foreach ($doctors as $doctor)
                                                        <option value="{{ $doctor->id }}">
                                                            {{ $doctor->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('doctor_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Department</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="department">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Review Date</label>
                                            <input class="form-control" type="date" wire:model="review_date">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea class="form-control" wire:model="remarks"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('page-script')
        <script>
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
                @this.call("changedDoctor");
            });
        </script>
    @endpush
</div>
