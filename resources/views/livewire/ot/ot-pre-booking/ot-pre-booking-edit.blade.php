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
                                <h3>OT Pre Booking Edit</h3>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">
                                    <div class="col-md-12">
                                        <div class="form-group border rounded px-3 pt-3 pb-2 border">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="in-patient" value="in-patient" wire:model="type" disabled>

                                                <label class="form-check-label" for="in-patient">In Patient</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="out-patient" value="out-patient" wire:model="type" disabled>

                                                <label class="form-check-label" for="out-patient">Out Patient</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="outside-patient" value="outside-patient" wire:model="type"
                                                    disabled>

                                                <label class="form-check-label" for="outside-patient">
                                                    OutSide Patient
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Pre Booking No</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="pre_booking_no">
                                            @error('pre_booking_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Pre Booking Date</label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="pre_booking_date">
                                            @error('pre_booking_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group border rounded px-2 py-1 border mt-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="booking_type"
                                                    id="selective" value="selective" wire:model="booking_type">
                                                <label class="form-check-label" for="selective">Selective</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="booking_type"
                                                    id="emergency" value="emergency" wire:model="booking_type">
                                                <label class="form-check-label" for="emergency">Emergency</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input class="form-control" type="text" readonly wire:model="status">
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    @if ($type == 'in-patient')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>IPD No<span class="text-danger">*</span></label>
                                                <select class="form-control select2" name="ipd_id"
                                                    data-placeholder="Select" wire:model="ipd_id" disabled>
                                                    <option value=""></option>
                                                    @foreach ($ipds as $ipd)
                                                        <option value="{{ $ipd->id }}">
                                                            {{ $ipd->ipdcode }}</option>
                                                    @endforeach
                                                </select>
                                                @error('ipd_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    @if ($type == 'out-patient')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>UMR No<span class="text-danger">*</span></label>
                                                <select class="form-control select2" name="umr"
                                                    data-placeholder="Select" wire:model="umr" disabled>
                                                    <option value=""></option>
                                                    @foreach ($patients as $patient)
                                                        <option value="{{ $patient->registration_no }}">
                                                            {{ $patient->registration_no }}</option>
                                                    @endforeach
                                                </select>
                                                @error('umr')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Title<span class="text-danger">*</span></label>
                                            <select class="form-control" @disabled($type != 'outside-patient') @required($type == 'outside-patient')
                                                wire:model="title_id">
                                                <option value="">Title</option>
                                                @foreach ($titles as $title)
                                                    <option value="{{ $title->id }}">
                                                        {{ $title->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('title_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Patient Name</label>
                                            <input class="form-control" type="text" @disabled($type != 'outside-patient')
                                                @required($type == 'outside-patient') wire:model="patient_name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control" type="text" @disabled($type != 'outside-patient')
                                                @required($type == 'outside-patient') wire:model="age" min="0" max="200">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Gender</label>
                                            <select class="form-control" @disabled($type != 'outside-patient') @required($type == 'outside-patient')
                                                wire:model="gender_id">
                                                <option>Gender</option>
                                                @foreach ($genders as $gender)
                                                    <option value="{{ $gender->id }}">
                                                        {{ $gender->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('gender_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    @if ($type == 'outside-patient')
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Mobile No</label>
                                                <input type="number" class="form-control" wire:model="mobile">
                                                @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" class="form-control" wire:model="address">
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    @if ($type == 'in-patient' || $type == 'out-patient')
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Patient Type</label>
                                                <input class="form-control" type="text" readonly
                                                    wire:model="patient_type">
                                            </div>
                                        </div>
                                    @endif

                                    @if ($type == 'out-patient')
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Admn No.<span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" readonly
                                                    wire:model="admn_no">
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
                                    @endif

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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Consultant</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="consultant_name">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Corp. Code</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="corporate_code">
                                            @error('corporate_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Corp. Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="corporate_name">
                                            @error('corporate_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0 pb-0">
                                    <div class="col-md-12">
                                        <hr>
                                    </div>

                                    <div class="col-md-9">
                                        <h4 class="mb-0">Surgery Details</h4>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="custom-control custom-checkbox my-0 mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="fordaycare"
                                                value="1" wire:model="for_day_care">
                                            <label class="custom-control-label" for="fordaycare">For Day
                                                Care</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ref. Doctor Name<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="doctor_id"
                                                data-placeholder="Select Doctor" wire:model="doctor_id">
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
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Doctor Code<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="doctor_code">
                                            @error('doctor_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Surgery/Procedure<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="service_id"
                                                data-placeholder="Select Surgery/Procedure" wire:model="service_id">
                                                <option value=""></option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">
                                                        {{ $service->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('service_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Surgery/Procedure Code<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="service_code">

                                            @error('service_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Surgery Date</label>
                                            <input class="form-control" type="datetime-local"
                                                wire:model="surgery_date">

                                            @error('surgery_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Surgery Type</label>
                                            <select class="form-control select2" name="surgery_type_id"
                                                data-placeholder="Select Type" wire:model="surgery_type_id">
                                                <option value=""></option>
                                                @foreach ($surgery_types as $surgery_type)
                                                    <option value="{{ $surgery_type->id }}">
                                                        {{ $surgery_type->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('surgery_type_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Surgery Type Code</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="surgery_type_code">
                                            @error('surgery_type_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diagnosis</label>
                                            <textarea class="form-control" wire:model="diagnosis"></textarea>
                                            @error('diagnosis')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Remarks (If Any)</label>
                                            <textarea class="form-control" wire:model="remarks"></textarea>
                                            @error('remarks')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

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
                @this.call("doctorChanged");
            });

            $(document).on("change", "select[name='service_id']", function() {
                @this.call("serviceChanged");
            });

            $(document).on("change", "select[name='surgery_type_id']", function() {
                @this.call("surgeryTypeChanged");
            });
        </script>
    @endpush
</div>
