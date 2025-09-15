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
                                <h3 class="m-0">IP Discharge</h3>
                            </div>

                            <div class="card-body pb-0" style="background: {{ $bg_color }}">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>UMR No.<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="umr"
                                                data-placeholder="Select UMR" wire:model="umr">
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
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_name">
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
                                            <label>Status</label>
                                            <input class="form-control" type="text" readonly wire:model="status">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Admn No.</label>
                                            <input class="form-control" type="text" readonly wire:model="admn_no">
                                            @error('admn_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Admn Date</label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="admn_date">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Admn Type</label>
                                            <input class="form-control" type="text" readonly wire:model="admn_type">
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
                                            <label>Consultant</label>
                                            <input class="form-control" type="text" readonly wire:model="consultant">
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
                                </div>

                            </div>

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-3">Discharge Details</h4>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Discharge No. <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="discharge_no">
                                                    @error('discharge_no')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Discharge Date</label>
                                                    <input class="form-control"
                                                        min="{{ date('Y-m-d H:i', strtotime('-1 days')) }}"
                                                        type="datetime-local" wire:model="discharge_date">
                                                    @error('discharge_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Consultant</label>
                                                    <select class="form-control select2" name="consultant_id"
                                                        data-placeholder="Select Consultant"
                                                        wire:model="consultant_id">
                                                        <option value=""></option>
                                                        @foreach ($doctors as $doctor)
                                                            <option value="{{ $doctor->id }}">
                                                                {{ $doctor->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('consultant_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Consultant Code</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="consultant_code">
                                                    @error('consultant_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Due Reference</label>
                                                    <select class="form-control select2" name="due_reference_id"
                                                        data-placeholder="Select Due Reference"
                                                        wire:model="due_reference_id">
                                                        <option value=""></option>
                                                        @foreach ($due_references as $due_reference)
                                                            <option value="{{ $due_reference->id }}">
                                                                {{ $due_reference->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('due_reference_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Due Reference Code</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="due_reference_code">
                                                    @error('due_reference_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Discharge Type <span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="discharge_type"
                                                        data-placeholder="Select Discharge Type"
                                                        wire:model="discharge_type">
                                                        <option value=""></option>
                                                        @foreach ($discharge_types as $discharge_type)
                                                            <option value="{{ $discharge_type?->id }}">
                                                                {{ $discharge_type?->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('discharge_type')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Discharge Status</label>
                                                    <select class="form-control select2" name="discharge_status"
                                                        wire:model="discharge_status">
                                                        @foreach ($discharge_statuses as $discharge_status)
                                                            <option value="{{ $discharge_status }}">
                                                                {{ $discharge_status }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('discharge_status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Diagnosis</label>
                                                    <textarea class="form-control" rows="2" wire:model="diagnosis"></textarea>
                                                    @error('diagnosis')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <h4 class="mb-3">Bill Details</h4>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Bill No.</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="bill_no">
                                                    @error('bill_no')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Bill Date</label>
                                                    <input class="form-control" type="date" readonly
                                                        wire:model="bill_date">
                                                    @error('bill_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gross Amount</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="gross_amount">
                                                    @error('gross_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Concession</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="concession">
                                                    @error('concession')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Total Advance</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="total_advance">
                                                    @error('total_advance')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Received Amount</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="received_amount">
                                                    @error('received_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Due Amount</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="due_amount">
                                                    @error('due_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Refund Amount</label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="refund_amount">
                                                    @error('refund_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Print Check Out Slip
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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

            $(document).on("change", "select[name='consultant_id']", function() {
                @this.call("consultantChanged");
            });

            $(document).on("change", "select[name='due_reference_id']", function() {
                @this.call("dueReferenceChanged");
            });
        </script>
    @endpush
</div>
