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
                                <h3>Blood Requisition Request Create</h3>
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
                                            <label>Requisition Req. No</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="requisition_req_no">
                                            @error('requisition_req_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Requisition Req. Date</label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="requisition_req_date">
                                            @error('requisition_req_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Blood Group<span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="bloodgroup_id">
                                                <option value="">Select blood group</option>
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
                                            <label>Title<span class="text-danger">*</span></label>
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

                                            @error('patient_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
                                            <label for="">Gender<span class="text-danger">*</span></label>
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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Requisition Doctor Name<span class="text-danger">*</span></label>
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
                                </div>

                                <div class="row mb-0 pb-0">
                                    <div class="col-md-12">
                                        <div class="">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th colspan="3" class="text-center">
                                                            Indicate No of Units required Against Component
                                                        </th>
                                                        <th colspan="2">Shock</th>
                                                        <th colspan="2">Platelet Count</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Whole Blood
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="whole_blood">
                                                        </td>

                                                        <td>
                                                            FRESH frozen Plasma
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="ffp">
                                                        </td>

                                                        <td>
                                                            HB%
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="hb">
                                                        </td>

                                                        <td>
                                                            PT
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="pt">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            Packed Red Blood Cells (PRBC)
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="prbc">
                                                        </td>

                                                        <td>
                                                            Eryo poor Plasm
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="epp">
                                                        </td>

                                                        <td>
                                                            Pulse
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="pulse">
                                                        </td>

                                                        <td>
                                                            PTT
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="ptt">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            Pedlatric Unit
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="pu">
                                                        </td>

                                                        <td>
                                                            Cryoprecipitate
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="cryoprecipitate">
                                                        </td>

                                                        <td>
                                                            B.P.
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="bp-input"
                                                                wire:model="bp">
                                                        </td>

                                                        <td>
                                                            PVU Level
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="pvu_level">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            Leuco depleted RBC
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="ldrbc">
                                                        </td>

                                                        <td rowspan="2">
                                                            O Neg RBC with AB Plasma
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="onrbc_ab_plasma">
                                                        </td>

                                                        <td>
                                                            Weight
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="weight">
                                                        </td>

                                                        <td>
                                                            S-ALBUMIN
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="s_albumin">
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <td>
                                                            Platrents Concentrta
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="pc">
                                                        </td>

                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model="onrbc_ab_plasma_2">
                                                        </td>

                                                        <td colspan="2">
                                                            Reason for Tranfusion
                                                        </td>
                                                        <td colspan="2">
                                                            <input type="text" class="form-control"
                                                                wire:model="reason_for_over_ride">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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

            $(document).on("change", "select[name='doctor_id']", function() {
                @this.call("doctorChanged");
            });

            document.addEventListener("DOMContentLoaded", function() {
                Inputmask("999/999").mask("#bp-input");
            });
        </script>
    @endpush
</div>
