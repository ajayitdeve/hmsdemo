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
                                <h3>OT Booking Edit</h3>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">
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
                                            <label>Booking Date</label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="booking_date">
                                            @error('booking_date')
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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>UMR No<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="umr"
                                                data-placeholder="Select UMR" wire:model="umr" disabled>
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
                                </ul>
                                <hr>


                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade @if ($activeTab === 'surgery-details') show active @endif"
                                        id="pills-surgery-details" role="tabpanel"
                                        aria-labelledby="pills-surgery-details-tab">

                                        <div class="row mb-0 pb-0">
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
                                                        data-placeholder="Select Surgery/Procedure"
                                                        wire:model="service_id">
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
                                                    <label>Surgery/Procedure Code<span
                                                            class="text-danger">*</span></label>
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

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Surgery Duration</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control"
                                                            wire:model="duration" min="0" readonly>

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
                                                    <label>Surgery Date</label>
                                                    <input class="form-control" type="date" min="{{ date('Y-m-d') }}"
                                                        wire:model="surgery_date">
                                                    @error('surgery_date')
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
                                                    <label>Anesthesia Type</label>
                                                    <select class="form-control select2" name="anesthesia_type_id"
                                                        data-placeholder="Select Anesthesia Type"
                                                        wire:model="anesthesia_type_id">
                                                        <option value=""></option>
                                                        @foreach ($anesthesia_types as $anesthesia_type)
                                                            <option value="{{ $anesthesia_type->id }}">
                                                                {{ $anesthesia_type->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('anesthesia_type_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="custom-control custom-checkbox mt-4 mr-sm-2">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="fordaycare" value="1" wire:model="for_day_care">
                                                    <label class="custom-control-label" for="fordaycare">For Day
                                                        Care</label>
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
                                                    <label>Remarks (If Any)</label>
                                                    <textarea class="form-control" wire:model="remarks"></textarea>
                                                    @error('remarks')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Diagnosis<span class="text-danger">*</span></label>
                                                    <textarea class="form-control" wire:model="diagnosis"></textarea>
                                                    @error('diagnosis')
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

            $(document).on("change", "select[name='doctor_id']", function() {
                @this.call("doctorChanged");
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
