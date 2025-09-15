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
                                <h3>OT Pre Operation</h3>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Pre Oper. No</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="pre_operation_no">
                                            @error('pre_operation_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Pre Oper. Date</label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="pre_operation_date">
                                            @error('pre_operation_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group border rounded px-2 py-1 border mt-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="pre_operation_type"
                                                    id="scheduled-patients" value="scheduled-patients"
                                                    wire:model="pre_operation_type">
                                                <label class="form-check-label" for="scheduled-patients">
                                                    Scheduled Patients
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="pre_operation_type"
                                                    id="unscheduled-patients" value="unscheduled-patients"
                                                    wire:model="pre_operation_type">
                                                <label class="form-check-label" for="unscheduled-patients">
                                                    UnScheduled Patients
                                                </label>
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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>UMR No<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="umr"
                                                data-placeholder="Select UMR" wire:model="umr">
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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Patient Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control" type="text" readonly wire:model="age">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <input class="form-control" type="text" readonly wire:model="gender">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Patient Type</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_type">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Admn No.<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly wire:model="admn_no">
                                            @error('admn_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Admn Date<span class="text-danger">*</span></label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="admn_date">
                                            @error('admn_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Ward</label>
                                            <input class="form-control" type="text" readonly wire:model="ward">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Room</label>
                                            <input class="form-control" type="text" readonly wire:model="room">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
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
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Corp. Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="corporate_name">
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn @if ($activeTab === 'surgery-details') active @endif"
                                            id="pills-surgery-details-tab" data-toggle="pill"
                                            data-target="#pills-surgery-details" type="button" role="tab"
                                            aria-controls="pills-surgery-details" aria-selected="true"
                                            wire:click="setActiveTab('surgery-details')">Surgery
                                            Details</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn @if ($activeTab === 'surgeon-anesthetist-details') active @endif"
                                            id="pills-surgeon-anesthetist-details-tab" data-toggle="pill"
                                            data-target="#pills-surgeon-anesthetist-details" type="button"
                                            role="tab" aria-controls="pills-surgeon-anesthetist-details"
                                            aria-selected="false"
                                            wire:click="setActiveTab('surgeon-anesthetist-details')">
                                            Surgeon/Anesthetist Details
                                        </button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn @if ($activeTab === 'pre-anaesthesia-check-record-1') active @endif"
                                            id="pills-pre-anaesthesia-check-record-1-tab" data-toggle="pill"
                                            data-target="#pills-pre-anaesthesia-check-record-1" type="button"
                                            role="tab" aria-controls="pills-pre-anaesthesia-check-record-1"
                                            aria-selected="false"
                                            wire:click="setActiveTab('pre-anaesthesia-check-record-1')">
                                            Pre Anaesthesia Check (PAC) Record - I
                                        </button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn @if ($activeTab === 'pre-anaesthesia-check-record-2') active @endif"
                                            id="pills-pre-anaesthesia-check-record-2-tab" data-toggle="pill"
                                            data-target="#pills-pre-anaesthesia-check-record-2" type="button"
                                            role="tab" aria-controls="pills-pre-anaesthesia-check-record-2"
                                            aria-selected="false"
                                            wire:click="setActiveTab('pre-anaesthesia-check-record-2')">
                                            Pre Anaesthesia Check (PAC) Record - II
                                        </button>
                                    </li>
                                </ul>
                                <hr>


                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade @if ($activeTab === 'surgery-details') show active @endif"
                                        id="pills-surgery-details" role="tabpanel"
                                        aria-labelledby="pills-surgery-details-tab">

                                        <div class="row mb-0 pb-0">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Surgery<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="service_id"
                                                        data-placeholder="Select Surgery" wire:model="service_id">
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
                                                    <label>Surgery Code<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="service_code">
                                                    @error('service_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>OT Booking No</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="ot_booking_no">
                                                    @error('ot_booking_no')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>OT Booking Date</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="ot_booking_date">
                                                    @error('ot_booking_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Surgery Type</label>
                                                    <select class="form-control select2" name="surgery_type_id"
                                                        data-placeholder="Select Surgery Type"
                                                        wire:model="surgery_type_id">
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

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Surgery Date</label>
                                                    <input class="form-control" type="date"
                                                        wire:model="surgery_date">
                                                    @error('surgery_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Duration</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" readonly
                                                            wire:model="duration">

                                                        <div class="input-group-append">
                                                            <span class="input-group-text py-0"
                                                                id="basic-addon2">min</span>
                                                        </div>
                                                    </div>

                                                    @error('duration')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>From</label>
                                                    <input class="form-control" type="time"
                                                        wire:model="from_time">
                                                    @error('from_time')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>To</label>
                                                    <input class="form-control" type="time" wire:model="to_time">
                                                    @error('to_time')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>OT Type<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="ot_type_id"
                                                        data-placeholder="Select OT Type" wire:model="ot_type_id">
                                                        <option value=""></option>
                                                        @foreach ($ot_types as $ot_type)
                                                            <option value="{{ $ot_type->id }}">
                                                                {{ $ot_type->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('ot_type_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>OT Type Code<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="ot_type_code">
                                                    @error('ot_type_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Operation Theatre<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="ot_id"
                                                        data-placeholder="Select Operation Theatre"
                                                        wire:model="ot_id">
                                                        <option value=""></option>
                                                        @foreach ($ot_list as $ot)
                                                            <option value="{{ $ot->id }}">
                                                                {{ $ot->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('ot_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>OT Code<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="ot_code">
                                                    @error('ot_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>OT Start Time</label>
                                                    <input class="form-control" type="datetime-local"
                                                        wire:model="ot_start_time">
                                                    @error('ot_start_time')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Estimated Time</label>
                                                    <input class="form-control" type="datetime-local"
                                                        wire:model="estimated_time">
                                                    @error('estimated_time')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>ICD Code</label>
                                                    <input class="form-control" type="text" wire:model="icd_code">
                                                    @error('icd_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>CPT Code</label>
                                                    <input class="form-control" type="text" wire:model="cpt_code">
                                                    @error('cpt_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-0 pb-0">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>OP. Diagnosis</label>
                                                    <textarea class="form-control" wire:model="op_diagnosis"></textarea>
                                                    @error('op_diagnosis')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>OP. Procedure</label>
                                                    <textarea class="form-control" wire:model="op_procedure"></textarea>
                                                    @error('op_procedure')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade @if ($activeTab === 'surgeon-anesthetist-details') show active @endif"
                                        id="pills-surgeon-anesthetist-details" role="tabpanel"
                                        aria-labelledby="pills-surgeon-anesthetist-details-tab">

                                        <div class="table table-responsive">
                                            <table class="table table-striped custom-table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th>Attendant Type</th>
                                                        <th>Attendant Name</th>
                                                        <th>Attendant Code</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($arrCart)
                                                        @foreach ($arrCart as $index => $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    <select
                                                                        class="form-control select2 attendant_type_id"
                                                                        name="arrCart.{{ $index }}.attendant_type_id"
                                                                        data-index="{{ $index }}"
                                                                        data-placeholder="Select Type"
                                                                        wire:model="arrCart.{{ $index }}.attendant_type_id">
                                                                        <option value=""></option>
                                                                        @foreach ($attendant_types as $attendant_type)
                                                                            <option
                                                                                value="{{ $attendant_type['id'] }}">
                                                                                {{ $attendant_type['name'] }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error("arrCart.$index.attendant_type_id")
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </td>

                                                                <td>
                                                                    <select class="form-control select2 attendant_id"
                                                                        name="arrCart.{{ $index }}.attendant_id"
                                                                        data-index="{{ $index }}"
                                                                        data-placeholder="Select Name"
                                                                        wire:model="arrCart.{{ $index }}.attendant_id">
                                                                        <option value=""></option>
                                                                        @isset($item['attendant_list'])
                                                                            @foreach ($item['attendant_list'] as $attendant_list)
                                                                                <option
                                                                                    value="{{ $attendant_list['id'] }}">
                                                                                    {{ $attendant_list['name'] }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endisset
                                                                    </select>
                                                                    @error("arrCart.$index.attendant_id")
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </td>

                                                                <td>
                                                                    <input class="form-control" type="text"
                                                                        wire:model="arrCart.{{ $index }}.attendant_code"
                                                                        readonly>
                                                                    @error("arrCart.$index.attendant_code")
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </td>

                                                                <td>
                                                                    <button type="button"
                                                                        class="btn btn-success btn-sm"
                                                                        wire:click="addRow">
                                                                        <i class="fa fa-add"></i>
                                                                    </button>

                                                                    <button type="button"
                                                                        class="btn btn-danger btn-sm"
                                                                        wire:click="removeRow({{ $index }})">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade @if ($activeTab === 'pre-anaesthesia-check-record-1') show active @endif"
                                        id="pills-pre-anaesthesia-check-record-1" role="tabpanel"
                                        aria-labelledby="pills-pre-anaesthesia-check-record-1-tab">

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="3" class="align-middle">
                                                            <h5 class="text-center m-0">
                                                                PREOPERATIVE CARE DIVISION - PRE ANAESTHESIA CHECK (PAC)
                                                                RECORD
                                                            </h5>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <label for="date" class="col-md-4">DATE :</label>
                                                                <div class="col-md-8">
                                                                    <input type="datetime-local" class="form-control"
                                                                        id="date" wire:model="pacr1_date">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <label for="height" class="col-md-4">HEIGHT
                                                                    :</label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            id="height" wire:model="pacr1_height">
                                                                        <div class="input-group-append">
                                                                            <span
                                                                                class="input-group-text py-0">(CM)</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="row">
                                                                <label for="weight" class="col-md-4">WEIGHT
                                                                    :</label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            id="weight" wire:model="pacr1_weight">
                                                                        <div class="input-group-append">
                                                                            <span
                                                                                class="input-group-text py-0">(KG)</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="row">
                                                                <label for="community" class="col-md-4">COMMUNITY
                                                                    :</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control"
                                                                        id="community" wire:model="pacr1_community">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="row">
                                                                <label for="anaesthesia" class="col-md-4">ANAESTHESIA
                                                                    :</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control"
                                                                        id="anaesthesia"
                                                                        wire:model="pacr1_anaesthesia">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <label for="bmi" class="col-md-4">BMI
                                                                    :</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control"
                                                                        id="bmi" wire:model="pacr1_bmi">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="row">
                                                                <label for="dept" class="col-md-4">DEPT
                                                                    :</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control"
                                                                        id="dept" wire:model="pacr1_dept">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <label for="sx-plan" class="col-md-4">SX PLAN
                                                                    :</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control"
                                                                        id="sx-plan" wire:model="pacr1_sx_plan">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="row">
                                                                <label for="surgeon" class="col-md-4">SURGEON
                                                                    :</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control"
                                                                        id="surgeon" wire:model="pacr1_surgeon">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3">
                                                            <div class="row">
                                                                <label class="col-md-2">RISK FACTORS
                                                                    :</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        wire:model="pacr1_risk_factors">
                                                                </div>

                                                                <label class="col-md-2">ALLERGY
                                                                    :</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        wire:model="pacr1_allergy">
                                                                </div>
                                                            </div>

                                                            <div class="row mt-4">
                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="sht" wire:model="pacr1_sht">
                                                                        <label class="custom-control-label"
                                                                            for="sht">SHT</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="cad" wire:model="pacr1_cad">
                                                                        <label class="custom-control-label"
                                                                            for="cad">CAD</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="post-cabg"
                                                                            wire:model="pacr1_post_cabg">
                                                                        <label class="custom-control-label"
                                                                            for="post-cabg">POST CABG</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="post-ptca"
                                                                            wire:model="pacr1_post_ptca">
                                                                        <label class="custom-control-label"
                                                                            for="post-ptca">POST PTCA</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="post-dvt"
                                                                            wire:model="pacr1_post_dvt">
                                                                        <label class="custom-control-label"
                                                                            for="post-dvt">POST DVT</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-1">
                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="post-pre"
                                                                            wire:model="pacr1_post_pre">
                                                                        <label class="custom-control-label"
                                                                            for="post-pre">POST PRE</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="dm" wire:model="pacr1_dm">
                                                                        <label class="custom-control-label"
                                                                            for="dm">DM</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="ba" wire:model="pacr1_ba">
                                                                        <label class="custom-control-label"
                                                                            for="ba">BA</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="copd" wire:model="pacr1_copd">
                                                                        <label class="custom-control-label"
                                                                            for="copd">COPD</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="cva" wire:model="pacr1_cva">
                                                                        <label class="custom-control-label"
                                                                            for="cva">CVA</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-1">
                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="resp-infection"
                                                                            wire:model="pacr1_resp_infection">
                                                                        <label class="custom-control-label"
                                                                            for="resp-infection">RESP.INFECTION</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="smoker" wire:model="pacr1_smoker">
                                                                        <label class="custom-control-label"
                                                                            for="smoker">SMOKER</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="alcoholic"
                                                                            wire:model="pacr1_alcoholic">
                                                                        <label class="custom-control-label"
                                                                            for="alcoholic">ALCOHOLIC</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="anticoagulant"
                                                                            wire:model="pacr1_anticoagulant">
                                                                        <label class="custom-control-label"
                                                                            for="anticoagulant">ANTICOAGULANT</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="osa" wire:model="pacr1_osa">
                                                                        <label class="custom-control-label"
                                                                            for="osa">OSA</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-1">
                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="hyper-thyroid"
                                                                            wire:model="pacr1_hyper_thyroid">
                                                                        <label class="custom-control-label"
                                                                            for="hyper-thyroid">HYPER THYROID</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="hypothroid"
                                                                            wire:model="pacr1_hypothroid">
                                                                        <label class="custom-control-label"
                                                                            for="hypothroid">HYPOTHROID</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="obesity" wire:model="pacr1_obesity">
                                                                        <label class="custom-control-label"
                                                                            for="obesity">OBESITY</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="fits" wire:model="pacr1_fits">
                                                                        <label class="custom-control-label"
                                                                            for="fits">FITS</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="antiplatlet"
                                                                            wire:model="pacr1_antiplatlet">
                                                                        <label class="custom-control-label"
                                                                            for="antiplatlet">ANTIPLATLET</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-1">
                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="chronic-pain"
                                                                            wire:model="pacr1_chronic_pain">
                                                                        <label class="custom-control-label"
                                                                            for="chronic-pain">CHRONIC PAIN (>
                                                                            3M)</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col"></div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="long-term-steroid"
                                                                            wire:model="pacr1_long_term_steroid">
                                                                        <label class="custom-control-label"
                                                                            for="long-term-steroid">LONG TERM
                                                                            STEROID</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col"></div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="antiepileptic"
                                                                            wire:model="pacr1_antiepileptic">
                                                                        <label class="custom-control-label"
                                                                            for="antiepileptic">ANTIEPILEPTIC</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td rowspan="6">
                                                            <label>CURRENT DRUG R</label>
                                                            <textarea class="form-control" wire:model="pacr1_current_drug_r" rows="30"></textarea>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="ho-eventful-preoperative-period"
                                                                    wire:model="pacr1_ho_eventful_preoperative_period">
                                                                <label class="custom-control-label"
                                                                    for="ho-eventful-preoperative-period">H/O EVENTFUL
                                                                    PREOPERATIVE
                                                                    PERIOD</label>
                                                            </div>

                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="ho-previous-sx"
                                                                    wire:model="pacr1_ho_previous_sx">
                                                                <label class="custom-control-label"
                                                                    for="ho-previous-sx">H/O PREVIOUS SX</label>
                                                            </div>

                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="ho-eventful-anaesthesia"
                                                                    wire:model="pacr1_ho_eventful_anaesthesia">
                                                                <label class="custom-control-label"
                                                                    for="ho-eventful-anaesthesia">H/O EVENTFUL
                                                                    ANAESTHESIA</label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="cough" wire:model="pacr1_cough">
                                                                        <label class="custom-control-label"
                                                                            for="cough">
                                                                            COUGH
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="wheezing"
                                                                            wire:model="pacr1_wheezing">
                                                                        <label class="custom-control-label"
                                                                            for="wheezing">
                                                                            WHEEZING
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="sputum" wire:model="pacr1_sputum">
                                                                        <label class="custom-control-label"
                                                                            for="sputum">
                                                                            SPUTUM
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="recent-lri-uri"
                                                                            wire:model="pacr1_recent_lri_uri">
                                                                        <label class="custom-control-label"
                                                                            for="recent-lri-uri">
                                                                            RECENT LRI/URI
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3">
                                                            <div class="row">
                                                                <div class="col">
                                                                    GE :
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="anaemia" wire:model="pacr1_anaemia">
                                                                        <label class="custom-control-label"
                                                                            for="anaemia">
                                                                            ANAEMIA
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="jaundice"
                                                                            wire:model="pacr1_jaundice">
                                                                        <label class="custom-control-label"
                                                                            for="jaundice">
                                                                            JAUNDICE
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="cyanosis"
                                                                            wire:model="pacr1_cyanosis">
                                                                        <label class="custom-control-label"
                                                                            for="cyanosis">
                                                                            CYANOSIS
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="clubbing"
                                                                            wire:model="pacr1_clubbing">
                                                                        <label class="custom-control-label"
                                                                            for="clubbing">
                                                                            CLUBBING
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="pedal-edema"
                                                                            wire:model="pacr1_pedal_edema">
                                                                        <label class="custom-control-label"
                                                                            for="pedal-edema">
                                                                            PEDAL EDEMA
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3">
                                                            <div class="row">
                                                                <label class="col-md-4">AIRWAY / SPINE
                                                                    ASSESSMENT
                                                                    :</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control"
                                                                        wire:model="pacr1_airway_spine">
                                                                </div>
                                                            </div>

                                                            <div class="row mt-4">
                                                                <div class="col-md-3">
                                                                    MPT : I, II, III, IV
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="ltd-mo" wire:model="pacr1_ltd_mo">
                                                                        <label class="custom-control-label"
                                                                            for="ltd-mo">LTD MO</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="bucked-tooth"
                                                                            wire:model="pacr1_bucked_tooth">
                                                                        <label class="custom-control-label"
                                                                            for="bucked-tooth">BUCKED TOOTH</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="loose-tooth"
                                                                            wire:model="pacr1_loose_tooth">
                                                                        <label class="custom-control-label"
                                                                            for="loose-tooth">LOOSE TOOTH</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-1">
                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="denture" wire:model="pacr1_denture">
                                                                        <label class="custom-control-label"
                                                                            for="denture">DENTURE</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="short-neck"
                                                                            wire:model="pacr1_short_neck">
                                                                        <label class="custom-control-label"
                                                                            for="short-neck">SHORT NECK</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="receding-mandible"
                                                                            wire:model="pacr1_receding_mandible">
                                                                        <label class="custom-control-label"
                                                                            for="receding-mandible">RECEDING
                                                                            MANDIBLE</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="rnm" wire:model="pacr1_rnm">
                                                                        <label class="custom-control-label"
                                                                            for="rnm">
                                                                            RNM
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-1">
                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="hyphosis"
                                                                            wire:model="pacr1_hyphosis">
                                                                        <label class="custom-control-label"
                                                                            for="hyphosis">HYPHOSIS</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="adentulous"
                                                                            wire:model="pacr1_adentulous">
                                                                        <label class="custom-control-label"
                                                                            for="adentulous">ADENTULOUS</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="scoliosis"
                                                                            wire:model="pacr1_scoliosis">
                                                                        <label class="custom-control-label"
                                                                            for="scoliosis">SCOLIOSIS</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="lordosis"
                                                                            wire:model="pacr1_lordosis">
                                                                        <label class="custom-control-label"
                                                                            for="lordosis">
                                                                            LORDOSIS
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-3">
                                                                <label class="col-md-4">OTHERS :</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control"
                                                                        wire:model="pacr1_others">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade @if ($activeTab === 'pre-anaesthesia-check-record-2') show active @endif"
                                        id="pills-pre-anaesthesia-check-record-2" role="tabpanel"
                                        aria-labelledby="pills-pre-anaesthesia-check-record-2-tab">

                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <label class="col-md-4">SUPINE : HR :</label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            wire:model="pacr2_supine">

                                                                        <div class="input-group-append">
                                                                            <span
                                                                                class="input-group-text py-0">/mt</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="row">
                                                                <label class="col-md-4">BP :</label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            wire:model="pacr2_supine_bp">

                                                                        <div class="input-group-append">
                                                                            <span
                                                                                class="input-group-text py-0">mmHg</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="row">
                                                                <label class="col-md-4">SPO2% :</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control"
                                                                        wire:model="pacr2_supine_spo2">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td rowspan="2">
                                                            <div class="row mb-2">
                                                                <label class="col-md-4">CVS :</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control"
                                                                        wire:model="pacr2_cvs">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <label class="col-md-4">R.S :</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control"
                                                                        wire:model="pacr2_rs">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <label class="col-md-4">P/A :</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control"
                                                                        wire:model="pacr2_pa">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <label class="col-md-4">ERECT : HR :</label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            wire:model="pacr2_erect">

                                                                        <div class="input-group-append">
                                                                            <span
                                                                                class="input-group-text py-0">/mt</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="row">
                                                                <label class="col-md-4">BP :</label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            wire:model="pacr2_erect_bp">

                                                                        <div class="input-group-append">
                                                                            <span
                                                                                class="input-group-text py-0">mmHg</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="4">
                                                            <table class="table table-borderless table-sm">
                                                                <tr>
                                                                    <td>
                                                                        INVESTIGATIONS :
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">HB :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_hb">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">TC :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_tc">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">DC :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_dc">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">ESR :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_esr">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">RBS :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_rbs">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">PLATLET :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_platlet">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">BT :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_bt">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">PT :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_pt">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">INR :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_inr">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">APTT :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_aptt">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">LFT :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_lft">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">BI.UREA :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_bi_urea">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">SR.CREAT :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_sr_creat">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">CT :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_ct">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">HIV :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_hiv">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">HBSAG :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_hbsag">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">HCV :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_hcv">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-8">S.ELECTROLYTES
                                                                                :</label>
                                                                            <div class="col-md-4">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_s_electrolytes">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td colspan="4">
                                                                        <div class="row">
                                                                            <label class="col-md-6">BLOOD GR & RH
                                                                                TYPING :</label>
                                                                            <div class="col-md-6">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_blood_gr_rh_typing">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td colspan="2">
                                                                        <div class="row">
                                                                            <label class="col-md-3">ECG :</label>
                                                                            <div class="col-md-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_ecg">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">ECHO :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_echo">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-4">TFT :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_tft">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <label class="col-md-8">PFT :</label>
                                                                            <div class="col-md-4">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_pft">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td colspan="4">
                                                                        <div class="row">
                                                                            <label class="col-md-6">TMT :</label>
                                                                            <div class="col-md-6">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_tmt">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td colspan="2">
                                                                        <div class="row">
                                                                            <label class="col-md-3">ABG :</label>
                                                                            <div class="col-md-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_abg">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td colspan="2">
                                                                        <div class="row">
                                                                            <label class="col-md-4">CHEST X-RAY
                                                                                :</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_chest_xray">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td colspan="3">
                                                                        <div class="row">
                                                                            <label class="col-md-6">BILL VENOUS DOPPER
                                                                                ABG FOR BOTH LL :</label>
                                                                            <div class="col-md-6">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pacr2_bill_venous_dopper_abg_for_both_ll">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3">
                                                            <div class="row mb-2">
                                                                <label class="col-md-6">SPECIALIST OPINION BEFORE
                                                                    SURGERY (SPECIFY) :</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control"
                                                                        wire:model="pacr2_specialist_opinion_before_surgery">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <label class="col-md-6">ANY FURTHER INVESTIGATION
                                                                    REQUIRED BEFORE SURGERY :</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control"
                                                                        wire:model="pacr2_any_further_investigation_required_before_surgery">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <label class="col-md-6">BLOOD RESERVE :</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control"
                                                                        wire:model="pacr2_blood_reserve">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td rowspan="3">
                                                            <label>REMARKS :</label>
                                                            <textarea class="form-control" rows="15" wire:model="pacr2_remarks"></textarea>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3" class="align-middle">
                                                            <h5 class="text-center m-0">FIT FOR GA / RA / LA UNDER ASA
                                                                PHY.STATUS I / II / II /
                                                                IV / FOR REVIEW :</h5>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3">
                                                            <h5>ADVICE</h5>

                                                            <div class="row mb-3">
                                                                <label class="col-md-6">1. NPO FOR :</label>
                                                                <div class="col-md-6">
                                                                    <textarea class="form-control" wire:model="pacr2_npo_for"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <label class="col-md-6">2. PRE MEDICATION :</label>
                                                                <div class="col-md-6">
                                                                    <textarea class="form-control" wire:model="pacr2_pre_medication"></textarea>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
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

            $(document).on("change", "select[name='service_id']", function() {
                @this.call("serviceChanged");
            });

            $(document).on("change", "select[name='surgery_type_id']", function() {
                @this.call("surgeryTypeChanged");
            });

            $(document).on("change", "select[name='ot_type_id']", function() {
                @this.call("otTypeChanged");
            });

            $(document).on("change", "select[name='ot_id']", function() {
                @this.call("otChanged");
            });

            $(document).on("change", ".select2.attendant_type_id", function() {
                let input_name = $(this).attr("name");
                let input_index = $(this).attr("data-index");

                @this.set(input_name, $(this).val());
                @this.call("attendantTypeChanged", input_index);
            });

            $(document).on("change", ".select2.attendant_id", function() {
                let input_name = $(this).attr("name");
                let input_index = $(this).attr("data-index");

                @this.set(input_name, $(this).val());
                @this.call("attendantChanged", input_index);
            });
        </script>
    @endpush
</div>
