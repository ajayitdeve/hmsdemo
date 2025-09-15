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
                    <form wire:submit.prevent='confirmation' class="mb-0 pb-0">

                        <div class="card">
                            <div class="card-header">
                                <h3>Day Care Edit</h3>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>DayCare No</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="day_care_no">
                                            @error('day_care_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>DayCare Date</label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="day_care_date">
                                            @error('day_care_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group border rounded px-2 py-1 border mt-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="scheduled-patients" value="scheduled-patients"
                                                    wire:model="type">
                                                <label class="form-check-label" for="scheduled-patients">
                                                    Scheduled Patients
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="unscheduled-patients" value="unscheduled-patients"
                                                    wire:model="type">
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
                                </div>

                                <hr>
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn @if ($activeTab === 'procedure-details') active @endif"
                                            id="pills-procedure-details-tab" data-toggle="pill"
                                            data-target="#pills-procedure-details" type="button" role="tab"
                                            aria-controls="pills-procedure-details" aria-selected="true"
                                            wire:click="setActiveTab('procedure-details')">
                                            Procedure Details
                                        </button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn @if ($activeTab === 'consultant-details') active @endif"
                                            id="pills-consultant-details-tab" data-toggle="pill"
                                            data-target="#pills-consultant-details" type="button" role="tab"
                                            aria-controls="pills-consultant-details" aria-selected="false"
                                            wire:click="setActiveTab('consultant-details')">
                                            Consultant Details
                                        </button>
                                    </li>
                                </ul>
                                <hr>


                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade @if ($activeTab === 'procedure-details') show active @endif"
                                        id="pills-procedure-details" role="tabpanel"
                                        aria-labelledby="pills-procedure-details-tab">

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
                                                    <label>Operation Theatre</label>
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
                                                    <label>OT Code</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="ot_code">
                                                    @error('ot_code')
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
                                        </div>

                                        <hr>

                                        <div class="row mb-0 pb-0">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Ref. Doctor</label>
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
                                                    <label>Doctor Code</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="doctor_code">
                                                    @error('doctor_code')
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

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Diagnosis</label>
                                                    <textarea class="form-control" wire:model="diagnosis"></textarea>
                                                    @error('diagnosis')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Remarks (If Any)</label>
                                                    <textarea class="form-control" wire:model="remarks"></textarea>
                                                    @error('remarks')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade @if ($activeTab === 'consultant-details') show active @endif"
                                        id="pills-consultant-details" role="tabpanel"
                                        aria-labelledby="pills-consultant-details-tab">

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

            $(document).on("change", "select[name='ot_id']", function() {
                @this.call("otChanged");
            });

            $(document).on("change", "select[name='doctor_id']", function() {
                @this.call("doctorChanged");
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
