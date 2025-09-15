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
                    <div class="card">
                        <div class="card-header">
                            <h3>In Patient Info</h3>
                        </div>

                        <div class="card-body" style="background: {{ $bg_color }}">
                            <div class="row mb-0 pb-0">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Admn No.<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" readonly wire:model="admn_no">
                                        @error('admn_no')
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

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Patient Type</label>
                                        <input class="form-control" type="text" readonly wire:model="patient_type">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>UMR No<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" readonly wire:model="umr">
                                        @error('umr')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input class="form-control" type="text" readonly wire:model="age">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <input class="form-control" type="text" readonly wire:model="gender">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Patient Details</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">Father Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="father_name"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Referred By</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="referral"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">ConsDoctorCd</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="consultant_code"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="consultant"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Ward/Room/Bed</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="ward" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="room" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="bed" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Date of Admission</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="date" class="form-control" wire:model="admn_date"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Admn Time</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="time" class="form-control" wire:model="admn_time"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Patient Address</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    wire:model="patient_address" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Patient Type</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="patient_type"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4>Insurance Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">Corp. Name</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    wire:model="corporate_code" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    wire:model="corporate_name" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Approval Amount</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    wire:model="approval_amount" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Date of Approval</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="date" class="form-control"
                                                    wire:model="date_of_approval" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Approval Time</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="time" class="form-control" wire:model="approval_time"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Total Due Amount</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    wire:model="total_due_amount" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Emp Due Amount</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    wire:model="emp_due_amount" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Address Details</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">Responsible Person</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    wire:model="responsible_proson" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Mobile Number</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="mobile_number"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Address</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="address"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Date of Birth</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="date" class="form-control" wire:model="date_of_birth"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Religion</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="religion"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">City</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="city"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">State</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="state"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Country</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="country"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Pin Code</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="pincode"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Telephone Number</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    wire:model="telephone_number" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Mobile Phone Number</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="mobile_number"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Email Address</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="email_address"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Fax No</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="fax_no"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
