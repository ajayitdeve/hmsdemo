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
                            <h3 class="page-title">Corporate Consultation</h3>
                        </div>
                    </div>
                </div>

                <hr />

                <form wire:submit.prevent='save' class="mb-0 pb-0">
                    <div class="row mb-0 pb-0">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Organization Name <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="organization_id"
                                    data-placeholder="Select Organization" wire:model="organization_id">
                                    <option value=""></option>
                                    @foreach ($organizations as $organization)
                                        <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                                    @endforeach
                                </select>
                                @error('organization_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Organization Code</label>
                                <input class="form-control" type="text" readonly wire:model="organization_code">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mt-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="general" type="radio" name="type"
                                        value="general" wire:model="type">
                                    <label class="form-check-label" for="general">General</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="package" type="radio" name="type"
                                        value="package" wire:model="type">
                                    <label class="form-check-label" for="package">Package</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="is_casuality" type="radio" name="type"
                                        value="is_casuality" wire:model="type">
                                    <label class="form-check-label" for="is_casuality">Is Casuality</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status</label>
                                <input class="form-control" type="text" readonly wire:model="status">
                            </div>
                        </div>

                        <div class="col-md-3">
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

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Patient Name</label>
                                <input class="form-control" type="text" readonly wire:model="patient_name">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Patient Type</label>
                                <input class="form-control" type="text" readonly wire:model="patient_type">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Age</label>
                                <input class="form-control" type="text" readonly wire:model="age">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Gender</label>
                                <input class="form-control" type="text" readonly wire:model="gender">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nationality</label>
                                <input class="form-control" type="text" readonly wire:model="nationality">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Consultation No.</label>
                                <input class="form-control" type="text" readonly wire:model="consultation_no">

                                @error('consultation_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Consultation Date</label>
                                <input class="form-control" type="datetime-local" readonly
                                    wire:model="consultation_datetime">

                                @error('consultation_datetime')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Last Consultation Date</label>
                                <input class="form-control" type="date" readonly
                                    wire:model="last_consultation_date">

                                @error('last_consultation_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Payment By</label>
                                <select class="form-control" wire:model="payment_by">
                                    <option value="Personal">Personal</option>
                                    <option value="Corporate">Corporate</option>
                                    <option value="Insurance">Insurance</option>
                                </select>

                                @error('payment_by')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Ref. Source</label>
                                <select class="form-control" wire:model="ref_source">
                                    <option value="walking">Walking</option>
                                </select>

                                @error('ref_source')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Ref. Letter No.</label>
                                <input type="text" class="form-control" readonly wire:model="ref_letter_no">

                                @error('ref_letter_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Ref. Letter Date</label>
                                <input type="date" class="form-control" readonly wire:model="ref_letter_date">

                                @error('ref_letter_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Employee No.</label>
                                <input type="text" class="form-control" readonly wire:model="employee_no">

                                @error('employee_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Visit Type <span class="text-danger">*</span></label>
                                <select wire:model='visit_type_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($visit_types as $visit_type)
                                        <option value="{{ $visit_type->id }}">{{ $visit_type->name }}</option>
                                    @endforeach
                                </select>
                                @error('visit_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Consultant<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="consultant_id"
                                    data-placeholder="Select Consultant" wire:model="consultant_id">
                                    <option value=""></option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @endforeach
                                </select>

                                @error('consultant_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Consultant Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" readonly wire:model="consultant_code">

                                @error('consultant_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Consultant Fee</label>
                                <input type="text" class="form-control" readonly wire:model="consultant_fee">

                                @error('consultant_fee')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Chief Complaint</label>
                                <textarea class="form-control" wire:model="chief_complaint"></textarea>

                                @error('chief_complaint')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea class="form-control" wire:model="remarks"></textarea>

                                @error('remarks')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
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

            $(document).on("change", "select[name='organization_id']", function() {
                @this.call("organizationChanged");
            });

            $(document).on("change", "select[name='umr']", function() {
                @this.call("umrChanged");
            });

            $(document).on("change", "select[name='consultant_id']", function() {
                @this.call("consultantChanged");
            });
        </script>
    @endpush
</div>
