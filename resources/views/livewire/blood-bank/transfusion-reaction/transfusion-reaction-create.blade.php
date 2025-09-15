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
                                <h3>Transfusion Reaction Create</h3>
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


                                    @if ($type == 'in-patient')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>IPD No<span class="text-danger">*</span></label>
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
                                                <label>UMR No<span class="text-danger">*</span></label>
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

                                <div class="row mb-0 pb-0">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ward</label>
                                            <input class="form-control" type="text" readonly wire:model="ward">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Room</label>
                                            <input class="form-control" type="text" readonly wire:model="room">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Bed</label>
                                            <input class="form-control" type="text" readonly wire:model="bed">
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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Blood Requisition Code</label>
                                            <select class="form-control select2" name="blood_requisition_request_id"
                                                data-placeholder="Select Requisition Code"
                                                wire:model="blood_requisition_request_id">
                                                <option value=""></option>
                                                @foreach ($blood_requisitions as $blood_requisition)
                                                    <option value="{{ $blood_requisition->id }}">
                                                        {{ $blood_requisition->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('cost_center_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Cost Center<span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="cost_center_id">
                                                @foreach ($cost_centers as $cost_center)
                                                    <option value="{{ $cost_center->id }}">
                                                        {{ $cost_center->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('cost_center_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row mb-0 pb-0">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Transfusion No<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="transfusion_no">
                                            @error('transfusion_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date of Issue<span class="text-danger">*</span></label>
                                            <input class="form-control" type="datetime-local"
                                                wire:model="date_of_issue">
                                            @error('date_of_issue')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name of U/C</label>
                                            <input class="form-control" type="text" wire:model="name_of_uc">
                                            @error('name_of_uc')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Blood Group<span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="bloodgroup_id">
                                                <option value="">Select Blood Group</option>
                                                @foreach ($blood_groups as $blood_group)
                                                    <option value="{{ $blood_group->id }}">
                                                        {{ $blood_group->name }}
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
                                            <label>Compatible with unit No</label>
                                            <input class="form-control" type="text"
                                                wire:model="compatible_with_unit_no">
                                            @error('compatible_with_unit_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date of Collection</label>
                                            <input class="form-control" type="date"
                                                wire:model="date_of_collection">
                                            @error('date_of_collection')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date of Expiry</label>
                                            <input class="form-control" type="date" wire:model="date_of_expiry">
                                            @error('date_of_expiry')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date of Supply</label>
                                            <input class="form-control" type="date" wire:model="date_of_supply">
                                            @error('date_of_supply')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Time of Supply</label>
                                            <input class="form-control" type="time" wire:model="time_of_supply">
                                            @error('time_of_supply')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <input class="form-control" type="text"
                                                wire:model="remarks_for_blood_bank">
                                            @error('remarks_for_blood_bank')
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

            $(document).on("change", "select[name='ipd_id']", function() {
                @this.call("ipdChanged");
            });

            $(document).on("change", "select[name='blood_requisition_request_id']", function() {
                @this.call("bloodRequisitionRequestChanged");
            });
        </script>
    @endpush
</div>
