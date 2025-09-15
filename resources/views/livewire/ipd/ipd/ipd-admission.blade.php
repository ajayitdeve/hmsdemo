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

                <!-- Page Header -->
                <div class="page-header mb-0 pb-0">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="page-title">IPD Admission</h3>

                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <hr />
                <form wire:submit.prevent='save' class="mb-0 pb-0">
                    <div class="card card-body" style="background: {{ $bg_color }}">
                        <div class="row mb-0 pb-0">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>UMR No<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="umr" data-placeholder="Select UMR"
                                        wire:model="umr">
                                        <option value=""></option>
                                        @foreach ($patients as $patient)
                                            <option value="{{ $patient->registration_no }}">
                                                {{ $patient->registration_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('umr')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Patient Name</label>
                                    <input class="form-control" type="text" readonly wire:model="patient_name">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Age</label>
                                    <input class="form-control" type="text" readonly wire:model="patient_age">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <input class="form-control" type="text" readonly wire:model="patient_gender">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Patient Type</label>
                                    <input class="form-control" type="text" readonly wire:model="patient_type">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-0 pb-0">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Consultation</label>
                                    <input class="form-control" readonly type="text" wire:model="department">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <input class="form-control" readonly type="text" wire:model="unit">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Doctor</label>
                                    <input class="form-control" readonly type="text" readonly wire:model="doctor">
                                </div>
                            </div>
                            @if ($referrable_id == 1)
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Referral: Self</label>
                                        <input class="form-control" readonly type="text" readonly
                                            wire:model="referral_name">
                                    </div>
                                </div>
                            @endif
                            @if ($referrable_id == 2)
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Referral: Doctor</label>
                                        <input class="form-control" readonly type="text" readonly
                                            wire:model="referral_name">
                                    </div>
                                </div>
                            @endif
                            @if ($referrable_id == 3)
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Referral: Staff</label>
                                        <input class="form-control" readonly type="text" readonly
                                            wire:model="referral_name">
                                    </div>
                                </div>
                            @endif
                            @if ($referrable_id == 3)
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Referral: Staff</label>
                                        <input class="form-control" readonly type="text" readonly
                                            wire:model="referral_name">
                                    </div>
                                </div>
                            @endif
                            @if ($referrable_id == 4)
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Referral: Hospital</label>
                                        <input class="form-control" readonly type="text" readonly
                                            wire:model="referral_name">
                                    </div>
                                </div>
                            @endif
                            @if ($referrable_id == 5)
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Referral: Walking</label>
                                        <input class="form-control" readonly type="text" readonly
                                            wire:model="referral_name">
                                    </div>
                                </div>
                            @endif
                            @if ($referrable_id == 6)
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Referral: Health Cordinator</label>
                                        <input class="form-control" readonly type="text" readonly
                                            wire:model="referral_name">
                                    </div>
                                </div>
                            @endif
                            @if ($referrable_id == 5)
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Referral: Other</label>
                                        <input class="form-control" readonly type="text" readonly
                                            wire:model="referral_name">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- End of UMR Changed Auto  fethed details-->
                    <hr />
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row mb-0 pb-0">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Reason</label>
                                        <input class="form-control" wire:model='reason' type="text"
                                            wire:model="reason">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Case Type</label>
                                        <select wire:model.lazy='case_type_id' class="form-control">
                                            <option value="">Select Case Type </option>
                                            @foreach ($caseTypes as $caseType)
                                                <option value="{{ $caseType->id }}">
                                                    {{ $caseType->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('case_type_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input class="form-control" type="text" wire:model="company">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-0 pb-0">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Admn Type <span class="text-danger">*</span></label>
                                        <select wire:model.lazy='admin_type_id' class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($adminTypes as $adminType)
                                                <option value="{{ $adminType->id }}">
                                                    {{ $adminType->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('admin_type_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Admn Purpose </label>
                                        <select wire:model='admission_purpose_id' class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($admissionPurposes as $admissionPurpose)
                                                <option value="{{ $admissionPurpose->id }}">
                                                    {{ $admissionPurpose->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('admission_purpose_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                {{-- <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Ref. Source <span class="text-danger">*</span></label>
                                        <select wire:model='refer_source' class="form-control">
                                            <option value="">Select </option>
                                            <option value="walking">Walking</option>
                                        </select>
                                        @error('refer_source')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                {{-- <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Referred By <span class="text-danger">*</span></label>
                                        <select wire:model.lazy='doctor_id' class="form-control">
                                            <option value="">Select Doctor </option>
                                            @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}">
                                                    {{ $doctor->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('doctor_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div> --}}

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Payment By <span class="text-danger">*</span></label>
                                        <select wire:model='payment_by' class="form-control">
                                            <option value="">Select </option>
                                            <option value="Personal">Personal</option>
                                            <option value="Corporate">Corporate</option>
                                            <option value="Insurance">Insurance</option>
                                        </select>
                                        @error('payment_by')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Corporate Consultation No.</label>
                                        <select name="corporate_registration_id" class="form-control select2"
                                            wire:model="corporate_registration_id" data-placeholder="Select">
                                            <option value=""></option>
                                            @foreach ($corporate_registration_list as $corporate_registration)
                                                <option value="{{ $corporate_registration->id }}">
                                                    {{ $corporate_registration->corporate_consultation->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Corporate Name </label>
                                        <input class="form-control" type="text" readonly
                                            wire:model="organization_name">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Payment </label>
                                        <input class="form-control" type="number" wire:model.lazy="payment">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Diet <span class="text-danger">*</span></label>
                                        <select wire:model='diet' class="form-control">
                                            <option value="">Select </option>
                                            <option value="veg">Veg</option>
                                            <option value="nonveg">Non-Veg</option>
                                        </select>
                                        @error('diet')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Referral No </label>
                                        <input class="form-control" type="text" wire:model="referral_no">
                                    </div>
                                </div> --}}
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Policy No </label>
                                        <input class="form-control" type="text" wire:model="policy_no" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Exp. App. Amt </label>
                                        <input class="form-control" type="text" wire:model="exp_app_amt">
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-0 pb-0">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Mother Admin No </label>
                                        <input class="form-control" type="text" wire:model="mother_admission_no">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="d-flex mt-4 pl-4">

                                        <label> Is with Mother</label>
                                        <input type="checkbox" class="form-check-input" wire:model='is_with_mother'>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group row pt-3">
                                        <div class="col-md-3">
                                            <label class="form-check-label"> How Admitted ?</label>
                                        </div>
                                        <br />
                                        <div class="form-check col-md-2">
                                            <input type="radio" class="form-check-input" wire:model="admit_type"
                                                value="Walking">Walking
                                            <label class="form-check-label" for="radio1"></label>
                                        </div>
                                        <div class="form-check col-md-3">
                                            <input type="radio" class="form-check-input" wire:model="admit_type"
                                                value="Wheel Chair">Wheel Chair
                                        </div>
                                        <div class="form-check col-md-4">
                                            <input type="radio" class="form-check-input" wire:model="admit_type"
                                                value="Streatcher">Streatcher
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="card">

                                <div class="card-body">
                                    <div class="row mb-4">
                                        <label for="" class="col-md-5">PAN</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" wire:model="pan_no" />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="" class="col-md-5 ">Type of Admin</label>
                                        <div class="col-md-7">
                                            <select wire:model='type_of_admin' class="form-control">
                                                <option value="">Select</option>
                                                <option value="Package">Package</option>
                                                <option value="Non Package">Non Package</option>
                                            </select>
                                        </div>



                                    </div>
                                    <div class="row mb-4">
                                        <label for="" class="col-md-5 ">Estimated Amt.</label>
                                        <div class="col-md-7">
                                            <input type="number" class="form-control" wire:model="estimated_amt" min="0" />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="" class="col-md-5 ">Patient Source<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <select wire:model='patient_source' class="form-control">

                                                <option value="">Select</option>
                                                <option value="OP">OP</option>
                                                <option value="Emergency">Emergency</option>
                                            </select>
                                            @error('patient_source')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="" class="col-md-5 ">Nationality<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <select wire:model='nationality_id' class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($nationalities as $nationality)
                                                    <option value="{{ $nationality->id }}" selected>
                                                        {{ $nationality->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('nationality_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="" class="col-md-5 ">Passport No</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" wire:model="passport_no" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Ward Details</h5>
                                    <hr>
                                    <div class="row mb-3">
                                        <label for="" class="col-md-5">Ward<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <select class="form-control" wire:model="ward_id"
                                                wire:change="wardChanged">
                                                <option value="">Select Ward </option>
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
                                    <div class="row mb-3">
                                        <label for="" class="col-md-5 ">Room<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">

                                            <select class="form-control" wire:model="room_id"
                                                wire:change="roomChanged">
                                                <option value="">Select Room </option>
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
                                    <div class="row mb-3">
                                        <label for="" class="col-md-5 ">Bed<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">

                                            <select class="form-control" wire:model="bed_id">
                                                <option value="">Select Bed </option>
                                                @foreach ($beds as $bed)
                                                    <option value="{{ $bed->id }}">
                                                        {{ $bed->display_name }}- {{ $bed->bed_status }}</option>
                                                @endforeach
                                            </select>
                                            @error('bed_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="" class="col-md-5 ">Bed Chart </label>
                                        <div class="col-md-7 text-center">
                                            @if ($this->roomBeds != null)
                                                <a wire:click="getBedChart" href="#" data-toggle="modal"
                                                    data-target="#bedChart" class="btn btn-danger"> <i
                                                        class="fa fa-bed btn-danger fa-lg" aria-hidden="true"></i></a>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="" class="col-md-5 ">Expected Stay (Days)</label>
                                        <div class="col-md-7">
                                            <input type="number" class="form-control"
                                                wire:model="expected_stay_days" min="0" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Attendant Details</h5>
                                    <hr>
                                    <div class="row mb-3">
                                        <label for="" class="col-md-5">Name<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" wire:model="name" />
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="" class="col-md-5 ">Relation<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <select wire:model='relation_id' class="form-control">
                                                @foreach ($relations as $relation)
                                                    <option value="{{ $relation->id }}"
                                                        {{ $relation->id == $relation_id ? 'selected' : null }}>
                                                        {{ $relation->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('relation_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="" class="col-md-5 ">Mobile<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" wire:model="mobile" />
                                            @error('mobile')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="" class="col-md-5 ">Address<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" wire:model="address" />
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="" class="col-md-5 ">Alt. Mobile</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" wire:mobile="alt_mobile" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
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

            $(document).on("change", "select[name='umr']", function() {
                @this.call("umrChanged");
            });

            $(document).on("change", "select[name='corporate_registration_id']", function() {
                @this.call("corporateRegistrationChanged");
            });
        </script>
    @endpush
</div>
