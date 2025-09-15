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
                                <h3>OT Post Operation</h3>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Post Oper. No</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="post_operation_no">
                                            @error('post_operation_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Post Oper. Date</label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="post_operation_date">
                                            @error('post_operation_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
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
                                        <button class="nav-link btn @if ($activeTab === 'findings-surgeon-notes') active @endif"
                                            id="pills-findings-surgeon-notes-tab" data-toggle="pill"
                                            data-target="#pills-findings-surgeon-notes" type="button" role="tab"
                                            aria-controls="pills-findings-surgeon-notes" aria-selected="false"
                                            wire:click="setActiveTab('findings-surgeon-notes')">
                                            Findings/Surgeon Notes
                                        </button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn @if ($activeTab === 'uper-notes-sample-collection') active @endif"
                                            id="pills-uper-notes-sample-collection-tab" data-toggle="pill"
                                            data-target="#pills-uper-notes-sample-collection" type="button"
                                            role="tab" aria-controls="pills-uper-notes-sample-collection"
                                            aria-selected="false"
                                            wire:click="setActiveTab('uper-notes-sample-collection')">
                                            Uper.Notes/SampleCollection
                                        </button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn @if ($activeTab === 'post-anaesthesia-care-unit-record') active @endif"
                                            id="pills-post-anaesthesia-care-unit-record-tab" data-toggle="pill"
                                            data-target="#pills-post-anaesthesia-care-unit-record" type="button"
                                            role="tab" aria-controls="pills-post-anaesthesia-care-unit-record"
                                            aria-selected="false"
                                            wire:click="setActiveTab('post-anaesthesia-care-unit-record')">
                                            Post Anaesthesia Care Unit (PACU) Record
                                        </button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn @if ($activeTab === 'operation-notes') active @endif"
                                            id="pills-operation-notes-tab" data-toggle="pill"
                                            data-target="#pills-operation-notes" type="button" role="tab"
                                            aria-controls="pills-operation-notes" aria-selected="false"
                                            wire:click="setActiveTab('operation-notes')">
                                            Operation Notes
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
                                                    <label>Pre Oper. No</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="pre_operartion_no">
                                                    @error('pre_operartion_no')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Pre Oper. Date</label>
                                                    <input class="form-control" type="datetime-local" readonly
                                                        wire:model="pre_operartion_date">
                                                    @error('pre_operartion_date')
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
                                                    <input class="form-control" type="datetime-local" readonly
                                                        wire:model="ot_booking_date">
                                                    @error('ot_booking_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Surgery</label>
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
                                                    <label>Surgery Code</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="service_code">
                                                    @error('service_code')
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
                                                    <label>OT End Time</label>
                                                    <input class="form-control" type="datetime-local"
                                                        wire:model="ot_end_time">
                                                    @error('ot_end_time')
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
                                                    <label>Blood Loss</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control"
                                                            wire:model="blood_loss">

                                                        <div class="input-group-append">
                                                            <span class="input-group-text py-0"
                                                                id="basic-addon2">ml</span>
                                                        </div>
                                                    </div>
                                                    @error('blood_loss')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="custom-control custom-checkbox mt-4 mr-sm-2">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="sent-to-icu" value="1" wire:model="sent_to_icu">
                                                    <label class="custom-control-label" for="sent-to-icu">
                                                        Sent to ICU
                                                    </label>
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

                                    <div class="tab-pane fade @if ($activeTab === 'findings-surgeon-notes') show active @endif"
                                        id="pills-findings-surgeon-notes" role="tabpanel"
                                        aria-labelledby="pills-findings-surgeon-notes-tab">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Findings</label>
                                                    <textarea class="form-control" rows="5" wire:model="findings"></textarea>
                                                    @error('findings')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Surgeon Notes</label>
                                                    <textarea class="form-control" rows="5" wire:model="surgeon_notes"></textarea>
                                                    @error('surgeon_notes')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade @if ($activeTab === 'uper-notes-sample-collection') show active @endif"
                                        id="pills-uper-notes-sample-collection" role="tabpanel"
                                        aria-labelledby="pills-uper-notes-sample-collection-tab">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Oper.Notes</label>
                                                    <textarea class="form-control" rows="5" wire:model="oper_notes"></textarea>
                                                    @error('oper_notes')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Samples Collection</label>
                                                    <textarea class="form-control" rows="5" wire:model="sample_collection"></textarea>
                                                    @error('sample_collection')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade @if ($activeTab === 'post-anaesthesia-care-unit-record') show active @endif"
                                        id="pills-post-anaesthesia-care-unit-record" role="tabpanel"
                                        aria-labelledby="pills-post-anaesthesia-care-unit-record-tab">

                                        <div class="table table-responsive">
                                            <table class="table table-striped table-bordered custom-table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th>Time (Min)</th>
                                                        <th>IN</th>
                                                        <th>15</th>
                                                        <th>30</th>
                                                        <th>45</th>
                                                        <th>60</th>
                                                        <th>75</th>
                                                        <th>90</th>
                                                        <th>105</th>
                                                        <th>120</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Pulse Rate (Mt)</td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pulse_rate_in"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pulse_rate_15"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pulse_rate_30"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pulse_rate_45"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pulse_rate_60"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pulse_rate_75"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pulse_rate_90"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pulse_rate_105"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pulse_rate_120"></td>
                                                    </tr>

                                                    <tr>
                                                        <td>2</td>
                                                        <td>Blood Pressure (mmHg)</td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="bp_in"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="bp_15"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="bp_30"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="bp_45"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="bp_60"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="bp_75"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="bp_90"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="bp_105"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="bp_120"></td>
                                                    </tr>

                                                    <tr>
                                                        <td>3</td>
                                                        <td>RR (Mt)</td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="rr_in"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="rr_15"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="rr_30"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="rr_45"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="rr_60"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="rr_75"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="rr_90"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="rr_105"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="rr_120"></td>
                                                    </tr>

                                                    <tr>
                                                        <td>4</td>
                                                        <td>SPO2(%)</td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="spo2_in"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="spo2_15"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="spo2_30"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="spo2_45"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="spo2_60"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="spo2_75"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="spo2_90"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="spo2_105"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="spo2_120"></td>
                                                    </tr>

                                                    <tr>
                                                        <td>5</td>
                                                        <td>Pain Score</td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pain_score_in"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pain_score_15"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pain_score_30"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pain_score_45"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pain_score_60"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pain_score_75"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pain_score_90"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pain_score_105"></td>
                                                        <td><input type="text" class="form-control"
                                                                wire:model="pain_score_120"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade @if ($activeTab === 'operation-notes') show active @endif"
                                        id="pills-operation-notes" role="tabpanel"
                                        aria-labelledby="pills-operation-notes-tab">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pre-op-diagnosis">
                                                        Pre OP Diagnosis :
                                                    </label>
                                                    <textarea class="form-control" id="pre-op-diagnosis" wire:model="pre_op_diagnosis"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="post-op-diagnosis">
                                                        Post OP Diagnosis :
                                                    </label>
                                                    <textarea class="form-control" id="post-op-diagnosis" wire:model="post_op_diagnosis"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="procedure-planned">
                                                        Procedure Planned :
                                                    </label>
                                                    <textarea class="form-control" id="procedure-planned" wire:model="procedure_planned"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="procedure-performed">
                                                        Procedure Performed :
                                                    </label>
                                                    <textarea class="form-control" id="procedure-performed" wire:model="procedure_performed"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="surgeon">
                                                        Surgeon :
                                                    </label>
                                                    <textarea class="form-control" id="surgeon" wire:model="surgeon"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="anesthesiologist">
                                                        Anesthesiologist :
                                                    </label>
                                                    <textarea class="form-control" id="anesthesiologist" wire:model="anesthesiologist"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="asst-surgeon">
                                                        Asst. Surgeon :
                                                    </label>
                                                    <textarea class="form-control" id="asst-surgeon" wire:model="asst_surgeon"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="staff-nurses">
                                                        Staff Nurses :
                                                    </label>
                                                    <textarea class="form-control" id="staff-nurses" wire:model="staff_nurses"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="freop-antibiotic">
                                                        Freop Antibiotic :
                                                    </label>
                                                    <textarea class="form-control" id="freop-antibiotic" wire:model="freop_antibiotic"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="blood-loss">
                                                                Blood Loss :
                                                            </label>
                                                            <textarea class="form-control" id="blood-loss" wire:model="on_blood_loss"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="blood-transfusion">
                                                                Blood Transfusion :
                                                            </label>
                                                            <textarea class="form-control" id="blood-transfusion" wire:model="blood_transfusion"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="incision">
                                                        Incision :
                                                    </label>
                                                    <textarea class="form-control" id="incision" wire:model="incision"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="findings">
                                                        Findings :
                                                    </label>
                                                    <textarea class="form-control" id="findings" wire:model="on_findings"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="procedure">
                                                        Procedure :
                                                    </label>
                                                    <textarea class="form-control" id="procedure" wire:model="procedure"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="closure">
                                                        Closure :
                                                    </label>
                                                    <textarea class="form-control" id="closure" wire:model="closure"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="post-op-instruction">
                                                        Post OP Instruction :
                                                    </label>
                                                    <textarea class="form-control" id="post-op-instruction" wire:model="post_op_instruction"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="specimens-sent">
                                                        Specimens Sent :
                                                    </label>
                                                    <textarea class="form-control" id="specimens-sent" wire:model="specimens_sent"></textarea>
                                                </div>
                                            </div>
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
