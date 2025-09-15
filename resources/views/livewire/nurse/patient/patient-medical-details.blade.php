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
                            <h3>Patient Medical Details</h3>
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

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Consultant</label>
                                        <input class="form-control" type="text" readonly wire:model="consultant">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Corp. Name<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" readonly wire:model="corporate_name">
                                        @error('corporate_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                    <h4>Nurse Notes</h4>
                                </div>
                                <div class="card-body fixed-height-card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered mb-0 nurseNotesDataTable">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Notes</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($nurse_notes as $note)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $note->note }}</td>
                                                        <td>{{ $note->created_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Vitals</h4>
                                </div>
                                <div class="card-body fixed-height-card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered mb-0 vitalsDataTable">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Entry Date Time</th>
                                                    <th>BP</th>
                                                    <th>Temperature</th>
                                                    <th>Height</th>
                                                    <th>Weight</th>
                                                    <th>Pulse</th>
                                                    <th>Respiration</th>
                                                    <th>CVP</th>
                                                    <th>Saturation</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($vitals as $vital)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ date('d-M-Y h:i a', strtotime($vital->date_time)) }}</td>
                                                        <td>{{ $vital->bp }} {{ $vital->bp_unit }}</td>
                                                        <td>{{ $vital->temperature }} {{ $vital->temperature_unit }}
                                                        </td>
                                                        <td>{{ $vital->height }} {{ $vital->height_unit }}</td>
                                                        <td>{{ $vital->weight }} {{ $vital->weight_unit }}</td>
                                                        <td>{{ $vital->pulse }} {{ $vital->pulse_unit }}</td>
                                                        <td>{{ $vital->respiration }} {{ $vital->respiration_unit }}
                                                        </td>
                                                        <td>{{ $vital->cvp }} {{ $vital->cvp_unit }}</td>
                                                        <td>
                                                            {{ $vital->saturation }} {{ $vital->saturation_unit }}
                                                        </td>
                                                        <td>{{ $vital->created_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Intake/OutPut</h4>
                                </div>
                                <div class="card-body fixed-height-card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered mb-0 intakeOutputDataTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-middle" rowspan="3">Sr. No.</th>
                                                    <th class="text-center align-middle" rowspan="3">Time</th>
                                                    <th class="text-center" colspan="6">INTAKE</th>
                                                    <th class="text-center" colspan="9">OUTPUT</th>
                                                    <th class="text-center align-middle" rowspan="3">Created At</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" colspan="3">Intravenous</th>
                                                    <th class="text-center" colspan="2">Oral</th>
                                                    <th class="text-center"></th>
                                                    <th class="text-center align-middle" rowspan="2">Urine</th>
                                                    <th class="text-center">N.G.A.S.P</th>
                                                    <th class="text-center" colspan="4">Drainage</th>
                                                    <th class="text-center align-middle" rowspan="2">Misc</th>
                                                    <th class="text-center align-middle" rowspan="2">Sub Total</th>
                                                    <th class="text-center align-middle" rowspan="2">Total</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Fluid</th>
                                                    <th class="text-center">Hrly</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center">Fluid</th>
                                                    <th class="text-center">Amount</th>
                                                    <th class="text-center">Total</th>

                                                    <th class="text-center">/R.T.A</th>
                                                    <th class="text-center">D-I</th>
                                                    <th class="text-center">D-II</th>
                                                    <th class="text-center">D-I</th>
                                                    <th class="text-center">D-II</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($intake_output_list as $intake_output)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ date('d-M-Y h:i a', strtotime($intake_output->date_time)) }}
                                                        </td>
                                                        <td>{{ $intake_output->iv_fluid }}</td>
                                                        <td>{{ $intake_output->iv_hrly }}</td>
                                                        <td>{{ $intake_output->iv_total }}</td>
                                                        <td>{{ $intake_output->oral_fluid }}</td>
                                                        <td>{{ $intake_output->oral_amount }}</td>
                                                        <td>{{ $intake_output->oral_total }}</td>
                                                        <td>{{ $intake_output->urine }}</td>
                                                        <td>{{ $intake_output->ngasp_rta }}</td>
                                                        <td>{{ $intake_output->drainage_d1 }}</td>
                                                        <td>{{ $intake_output->drainage_d2 }}</td>
                                                        <td>{{ $intake_output->drainage_d1_output }}</td>
                                                        <td>{{ $intake_output->drainage_d2_output }}</td>
                                                        <td>{{ $intake_output->misc }}</td>
                                                        <td>{{ $intake_output->sub_total }}</td>
                                                        <td>{{ $intake_output->total }}</td>
                                                        <td>{{ $intake_output->created_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    @if (false)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Doctor Notes</h4>
                                    </div>
                                    <div class="card-body fixed-height-card-body"></div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Order Medicienes</h4>
                                    </div>
                                    <div class="card-body fixed-height-card-body"></div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Order Investigations</h4>
                                    </div>
                                    <div class="card-body fixed-height-card-body"></div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Result View</h4>
                                    </div>
                                    <div class="card-body fixed-height-card-body"></div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Discharge Summary</h4>
                                    </div>
                                    <div class="card-body fixed-height-card-body"></div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Past Medical History</h4>
                                    </div>
                                    <div class="card-body fixed-height-card-body"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('page-script')
        <script>
            if ($('.nurseNotesDataTable').length > 0) {
                $('.nurseNotesDataTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [],
                    searching: false
                });
            }

            if ($('.vitalsDataTable').length > 0) {
                $('.vitalsDataTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [],
                    searching: false
                });
            }

            if ($('.intakeOutputDataTable').length > 0) {
                $('.intakeOutputDataTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [],
                    searching: false
                });
            }
        </script>
    @endpush
</div>
