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
                            <h3 class="page-title">Corporate Registration</h3>
                        </div>
                    </div>
                </div>

                <hr />

                <form wire:submit.prevent='save' class="mb-0 pb-0">
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

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ID Type</label>
                                <select name="id_type_id" class="form-control" wire:model="id_type_id" readonly>
                                    <option value=""></option>
                                    @foreach ($id_types as $id_type)
                                        <option value="{{ $id_type->id }}">{{ $id_type->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-3">
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

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Organization Code</label>
                                <input class="form-control" type="text" readonly wire:model="organization_code">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Medical Card No. <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" wire:model="medical_card_no">
                                @error('medical_card_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Card Valid upto <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" wire:model="card_validity">
                                @error('card_validity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Relationship to Emp</label>
                                <select class="form-control" wire:model="relationship_to_emp">
                                    <option value="self">Self</option>
                                    <option value="dependent">Dependent</option>
                                </select>
                                @error('relationship_to_emp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if ($relationship_to_emp == 'dependent')
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Corporate Relation <span class="text-danger">*</span></label>
                                    <select class="form-control" name="corporate_relation_id"
                                        wire:model="corporate_relation_id">
                                        <option value="">Select</option>
                                        @foreach ($corporate_relations as $corporate_relation)
                                            <option value="{{ $corporate_relation->id }}">
                                                {{ $corporate_relation->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('corporate_relation_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Corporate Relation <span class="text-danger">*</span></label>
                                    <select class="form-control" wire:model="relationship_to_emp">
                                        <option value="self">Self</option>
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Employee No. <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" wire:model="employee_no">
                                @error('employee_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Employee Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" wire:model="employee_name">
                                @error('employee_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Designation</label>
                                <input class="form-control" type="text" wire:model="employee_designation">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Department <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="department_id"
                                    data-placeholder="Select Department" wire:model="department_id">
                                    <option value=""></option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Unit <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="unit_id" data-placeholder="Select Unit"
                                    wire:model="unit_id">
                                    <option value=""></option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Cost Center <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="cost_center_id"
                                    data-placeholder="Select Cost Center" wire:model="cost_center_id">
                                    <option value=""></option>
                                    @foreach ($costcenters as $costcenter)
                                        <option value="{{ $costcenter->id }}">{{ $costcenter->name }}</option>
                                    @endforeach
                                </select>
                                @error('cost_center_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Referral Letter No.</label>
                                <input class="form-control" type="text" wire:model="referral_letter_no">
                                @error('referral_letter_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Letter Date <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" wire:model="referral_letter_date">
                                @error('referral_letter_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Purpose</label>
                                <select name="purpose" class="form-control" wire:model="purpose">
                                    <option value="">Select Purpose</option>
                                    <option value="consultation">Consultation</option>
                                    <option value="investigation">Investigation</option>
                                    <option value="consultation-and-investigation">
                                        Consultation & Investigation
                                    </option>
                                    <option value="pharmacy">Pharmacy</option>
                                </select>

                                @error('purpose')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Payment Mode</label>
                                <select name="payment_mode" class="form-control" wire:model="payment_mode">
                                    <option value="cash">Cash</option>
                                    <option value="credit">Credit</option>
                                    <option value="online">Online</option>
                                    <option value="all">All</option>
                                </select>
                                @error('payment_mode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Letter For</label>

                                <div class="mt-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="op" value="OP" wire:model="letter_for">
                                        <label class="form-check-label" for="op">OP</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="ip" value="IP" wire:model="letter_for">
                                        <label class="form-check-label" for="ip">IP</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>TPA Name</label>
                                <select class="form-control select2" name="tpa_name" data-placeholder="Select TPA"
                                    wire:model="tpa_name">
                                    <option value=""></option>
                                    @foreach ($organizations as $organization)
                                        <option value="{{ $organization->name }}">{{ $organization->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Letter Issued By</label>
                                <input class="form-control" type="text" wire:model="letter_issued_by">
                                @error('letter_issued_by')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Enter Diagnosis</label>
                                <textarea class="form-control" wire:model="diagnosis" rows="3" style="height: unset !important;"></textarea>
                                @error('diagnosis')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
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

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label>Consultant Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" readonly wire:model="consultant_code">

                                @error('consultant_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Department Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" readonly wire:model="department_name">

                                @error('department_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label>Consultant Fee</label>
                                <input type="text" class="form-control" readonly wire:model="consultant_fee">

                                @error('consultant_fee')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Department Corporate Fee<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" readonly
                                    wire:model="department_corporate_fee">

                                @error('department_corporate_fee')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

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

            $(document).on("change", "select[name='umr']", function() {
                @this.call("umrChanged");
            });

            $(document).on("change", "select[name='organization_id']", function() {
                @this.call("organizationChanged");
            });

            $(document).on("change", "select[name='department_id']", function() {
                @this.call("departmentChanged");
            });

            $(document).on("change", "select[name='consultant_id']", function() {
                @this.call("consultantChanged");
            });
        </script>
    @endpush
</div>
