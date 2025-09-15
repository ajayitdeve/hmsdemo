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
    <div class="content container-fluid">
        @include('partials.alert-message')

        <div class="row">
            <div class="col-md-12">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="page-title">Patient Registration</h3>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted">Next UMR: <u>{{ $nextUMR }}</u></p>
                        </div>

                    </div>
                </div>
                <!-- /Page Header -->

                <form wire:submit.prevent='confirmation'>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Patient Name<span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-4 mr-0 pr-0">
                                        <select class="form-control" wire:model="title_id" tabindex="0" autofocus
                                            wire:change="titleChanged">
                                            @foreach ($titles as $title)
                                                <option value="{{ $title->id }}">{{ $title->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('title_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-8 ml-0 pl-0">
                                        <input wire:model="name" class="form-control " type="text">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>DOB {{ $dob }}<span class="text-danger">*</span></label>
                                <input class="form-control" type="date" wire:model.lazy="dob"
                                    wire:change.lazy='calculateAge' max="{{ date('Y-m-d') }}"
                                    min="{{ date('Y-m-d', strtotime('-100 year', time())) }}">
                                @error('dob')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Enter Age<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" wire:model.live="rawage" min="0"
                                    max="200" wire:change.live='changeRwaAge'>
                                <span class="text-danger">{{ $ageError }}</span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Calculated Age</label>
                                <input class="form-control" type="text" wire:model="age" max="99" disabled
                                    tabindex="-1">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Gender<span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="gender_id" wire:change="genderChanged">

                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                    @endforeach
                                </select>
                                @error('gender_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Marital Status<span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="marital_id">
                                    <option value="-1">Select Marital Status</option>
                                    @foreach ($maritals as $marital)
                                        <option value="{{ $marital->id }}">{{ $marital->name }}</option>
                                    @endforeach
                                </select>
                                @error('marital_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Nationality<span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="nationality_id">
                                    <option value="-1">Select Nationality</option>
                                    @foreach ($nationalities as $nationality)
                                        <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                    @endforeach
                                </select>
                                @error('nationality_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Area<span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="area">
                                    <option value="0">Urban</option>
                                    <option value="1">Rural</option>
                                </select>
                                @error('area')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- Shift one field here -->
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label> Blood Group<span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="bloodgroup_id">
                                    <option value="-1">Select Blood Group</option>
                                    @foreach ($bloodgroups as $bloodgroup)
                                        <option value="{{ $bloodgroup->id }}">{{ $bloodgroup->name }}</option>
                                    @endforeach
                                </select>
                                @error('bloodgroup_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Referral<span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="referralmenu_id"
                                    wire:change="referralmenuChanged">
                                    <option value="-1">Select Referral</option>
                                    @foreach ($referralmenus as $referralmenu)
                                        <option value="{{ $referralmenu['id'] }}">{{ $referralmenu['name'] }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('referralmenu_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if ($referralmenu_id != 1 && $referralmenu_id != 5)
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Select {{ $referralmenuname }}<span class="text-danger">*</span></label>
                                    <select class="form-control" wire:model="referral_id">
                                        <option value="">Select {{ $referralmenuname }}</option>
                                        @foreach ($referrals as $referral)
                                            <option value="{{ $referral->id }}">{{ $referral->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('referral_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" wire:model="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input class="form-control" wire:model="mobile"
                                    onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                    type="tel" maxlength="10" pattern="[0-9]{10}"
                                    title="10 digit mobile number">
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Search Village"
                                    wire:model.live="village_text" wire:change="villageChanged">
                                <select class="form-control" wire:model="village_id"
                                    wire:change="villageSelectionChanged">
                                    <option value="-1">Select Village</option>
                                    @foreach ($villages as $village)
                                        <option value="{{ $village->id }}">{{ $village->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Address<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" wire:model="address">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Pin Code</label>
                                <input class="form-control" wire:model="pincode" type="text"
                                    onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                    type="tel" maxlength="6" pattern="[0-9]{6}" title="6 Digit Pincode">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Religion</label>
                                <select class="form-control" wire:model="religion_id">
                                    <option value="-1">Select Religion</option>
                                    @foreach ($religions as $religion)
                                        <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                                    @endforeach
                                </select>
                                @error('religion_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Father's Name<span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-4 mr-0 pr-0">
                                        <select class="form-control" wire:model="relation_id">

                                            @foreach ($relations as $relation)
                                                <option value="{{ $relation->id }}">{{ $relation->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('relation_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-8 ml-0 pl-0">
                                        <input class="form-control " type="text" wire:model="father_name">
                                        @error('father_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Occupation</label>
                                <select class="form-control" wire:model="occupation_id">
                                    <option value="-1">Select occupation</option>
                                    @foreach ($occupations as $occupation)
                                        <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                    @endforeach
                                </select>
                                @error('occupation_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Mother's Name</label>
                                <input class="form-control" type="text" wire:model="mother_name">
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">

                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Patient Type<span class="text-danger">*</span> </label>
                                <select class="form-control" wire:model="patient_type_id">
                                    @foreach ($patienttypes as $patienttype)
                                        <option value="{{ $patienttype->id }}">{{ $patienttype->name }}</option>
                                    @endforeach
                                </select>
                                @error('patient_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Id Type</label>
                                <select class="form-control" wire:model="id_type_id">
                                    <option value="">Select Id</option>
                                    @foreach ($idTypes as $idType)
                                        <option value="{{ $idType->id }}">{{ $idType->name }}</option>
                                    @endforeach
                                </select>
                                @error('patient_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if ($id_type_id != null)
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Identification Number</label>
                                    <input class="form-control" type="text" wire:model="identification_no"
                                        maxlength="20" required>

                                </div>
                            </div>
                        @endif

                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Remarks<span class="text-danger"> </label>
                                <input type="text" class="form-control" wire:model="remarks">
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Confirmation  Modal -->
    <div wire:ignore.self class="modal custom-modgal fade" id="confirmationModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form wire:submit.prevent='save'>
                        <div class="form-header">
                            <h3>Save </h3>
                            <p>Are you sure want to save ?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit"
                                        class="btn btn-primary continue-btn btn-block">Save</button>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal"
                                        class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Confirmation  Modal -->

    @push('page-script')
        <script>
            window.addEventListener('open-confirmation-modal', event => {
                $("#confirmationModal").modal('show');
            });
        </script>
    @endpush
    <!-- /Page Content -->
</div>
