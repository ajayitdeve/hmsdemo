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

            .custom-control-label::before,
            .custom-control-label::after {
                top: .05rem;
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
                                <h3>Donor Bleeding Create</h3>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">
                                    <div class="col-md-12">
                                        <div class="form-group border rounded px-3 pt-3 pb-2 border">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="in-patient" value="in-patient" wire:model="type">

                                                <label class="form-check-label" for="in-patient">In Patient</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="out-patient" value="out-patient" wire:model="type">

                                                <label class="form-check-label" for="out-patient">Out Patient</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="outside-patient" value="outside-patient" wire:model="type">

                                                <label class="form-check-label" for="outside-patient">
                                                    OutSide Patient
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Donor Reg. No<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="donor_id"
                                                data-placeholder="Select Donor No" wire:model="donor_id">
                                                <option value=""></option>
                                                @foreach ($donors as $donor)
                                                    <option value="{{ $donor->id }}">
                                                        {{ $donor->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('donor_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="donor_title">
                                            @error('donor_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Donor Name</label>
                                            <input class="form-control" type="text" readonly wire:model="donor_name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control" type="text" readonly wire:model="donor_age">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Gender</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="donor_gender">
                                            @error('donor_gender')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Father Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="donor_father_name">
                                        </div>
                                    </div>


                                    @if ($type == 'in-patient')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>IPD No</label>
                                                <select class="form-control select2" name="ipd_id"
                                                    data-placeholder="Select" wire:model="ipd_id">
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
                                                <label>UMR No</label>
                                                <select class="form-control select2" name="umr"
                                                    data-placeholder="Select" wire:model="umr">
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
                                            <label>Title</label>
                                            <select class="form-control" @readonly($type != 'outside-patient') @required($type == 'outside-patient')
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
                                            <input class="form-control" type="text" @readonly($type != 'outside-patient')
                                                @required($type == 'outside-patient') wire:model="patient_name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control" type="number" @readonly($type != 'outside-patient')
                                                @required($type == 'outside-patient') wire:model="age" min="0" max="200">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Gender</label>
                                            <select class="form-control" @readonly($type != 'outside-patient') @required($type == 'outside-patient')
                                                wire:model="gender_id">
                                                <option value="">Gender</option>
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

                                    @if ($type == 'out-patient')
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Admn No.</label>
                                                <input class="form-control" type="text" readonly
                                                    wire:model="admn_no">
                                                @error('admn_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <hr>

                                <div class="row mb-0 pb-0">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Questionnaire Consent Code</label>
                                            <select class="form-control select2"
                                                name="blood_donor_questionnaire_consent_id"
                                                data-placeholder="Select Questionnaire Consent"
                                                wire:model="blood_donor_questionnaire_consent_id">
                                                <option value=""></option>
                                                @foreach ($donor_questionnaire_consents as $donor_questionnaire_consent)
                                                    <option value="{{ $donor_questionnaire_consent->id }}">
                                                        {{ $donor_questionnaire_consent->code }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('blood_donor_questionnaire_consent_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Bleeding No</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="bleeding_no">
                                            @error('bleeding_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Blood Bag No</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="blood_bag_no">
                                            @error('blood_bag_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Blood Bag Date</label>
                                            <input type="datetime-local" class="form-control" readonly
                                                wire:model="blood_bag_date">
                                            @error('blood_bag_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Type of Bag</label>
                                            <select class="form-control" wire:model="bag_type_id">
                                                <option value="">Select Bag Type</option>
                                                @foreach ($bag_types as $bag_type)
                                                    <option value="{{ $bag_type->id }}">
                                                        {{ $bag_type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('bag_type_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Blood Group</label>
                                            <select class="form-control" wire:model="bloodgroup_id">
                                                <option value="">Select Blood Group</option>
                                                @foreach ($bloodgroups as $bloodgroup)
                                                    <option value="{{ $bloodgroup->id }}">
                                                        {{ $bloodgroup->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('bloodgroup_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Volume</label>
                                            <input type="text" class="form-control" wire:model="volume">
                                            @error('volume')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Tube No</label>
                                            <input type="text" class="form-control" wire:model="tube_no">
                                            @error('tube_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Temperature</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" wire:model="temperature">
                                                <div class="input-group-append">
                                                    <span class="input-group-text py-0" id="basic-addon2">deg</span>
                                                </div>
                                            </div>
                                            @error('temperature')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Hemoglobin</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" wire:model="hemoglobin">
                                                <div class="input-group-append">
                                                    <span class="input-group-text py-0" id="basic-addon2">gm%</span>
                                                </div>
                                            </div>
                                            @error('hemoglobin')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">LagTime</label>
                                            <input type="text" class="form-control" wire:model="lagtime">
                                            @error('lagtime')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Weight</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" wire:model="weight">
                                                <div class="input-group-append">
                                                    <span class="input-group-text py-0" id="basic-addon2">kg</span>
                                                </div>
                                            </div>
                                            @error('weight')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Pulse</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" wire:model="pulse">
                                                <div class="input-group-append">
                                                    <span class="input-group-text py-0" id="basic-addon2">min</span>
                                                </div>
                                            </div>
                                            @error('pulse')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Bleeding From DateTime</label>
                                            <input type="datetime-local" class="form-control"
                                                wire:model="bleeding_from_time">
                                            @error('bleeding_from_time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Bleeding To DateTime</label>
                                            <input type="datetime-local" class="form-control"
                                                wire:model="bleeding_to_time">
                                            @error('bleeding_to_time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Phlebotomy Site</label>
                                            <input type="text" class="form-control" wire:model="phlebotomy_site">
                                            @error('phlebotomy_site')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">B.P.</label>
                                            <input type="text" class="form-control" id="bp-input"
                                                wire:model="bp">
                                            @error('bp')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Phlebotomist</label>
                                            <input type="text" class="form-control" wire:model="phlebotomist">
                                            @error('phlebotomist')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Staff Nurse</label>
                                            <input type="text" class="form-control" wire:model="staff_nurse">
                                            @error('staff_nurse')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Doctor Name</label>
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
                                            <label for="">Doctor Code</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="doctor_code">
                                            @error('doctor_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0 pb-0">
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
        <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
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

            $(document).on("change", "select[name='ipd_id']", function() {
                @this.call("ipdChanged");
            });

            $(document).on("change", "select[name='umr']", function() {
                @this.call("umrChanged");
            });

            $(document).on("change", "select[name='donor_id']", function() {
                @this.call("donorChanged");
            });

            $(document).on("change", "select[name='doctor_id']", function() {
                @this.call("doctorChanged");
            });

            document.addEventListener("DOMContentLoaded", function() {
                Inputmask("999/999").mask("#bp-input");
            });
        </script>
    @endpush
</div>
