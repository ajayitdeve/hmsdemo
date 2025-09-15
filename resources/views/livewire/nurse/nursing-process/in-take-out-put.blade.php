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
                                <h3>InTake/OutPut</h3>
                            </div>

                            <div class="card-body" style="background: {{ $bg_color }}">
                                <div class="row mb-0 pb-0">
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
                                            <label>Patient Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Patient Type</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_type">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input class="form-control" type="text" readonly wire:model="status">
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
                                            <input class="form-control" type="text" readonly
                                                wire:model="corporate_name">
                                            @error('corporate_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

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
                                            <label>Admn Date<span class="text-danger">*</span></label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="admn_date">
                                            @error('admn_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

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
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center align-middle" rowspan="3">Time</th>
                                                <th class="text-center" colspan="6">INTAKE</th>
                                                <th class="text-center" colspan="9">OUTPUT</th>
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
                                            <tr>
                                                <td>
                                                    <input class="form-control" type="datetime-local"
                                                        wire:model="date_time">
                                                    @error('date_time')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text" wire:model="iv_fluid">
                                                    @error('iv_fluid')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text" wire:model="iv_hrly">
                                                    @error('iv_hrly')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text" wire:model="iv_total">
                                                    @error('iv_total')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="oral_fluid">
                                                    @error('oral_fluid')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="oral_amount">
                                                    @error('oral_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="oral_total">
                                                    @error('oral_total')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text" wire:model="urine">
                                                    @error('urine')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="ngasp_rta">
                                                    @error('ngasp')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="drainage_d1">
                                                    @error('drainage_d1')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="drainage_d2">
                                                    @error('drainage_d2')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="drainage_d1_output">
                                                    @error('drainage_d1')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="drainage_d2_output">
                                                    @error('drainage_d2')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text" wire:model="misc">
                                                    @error('misc')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text"
                                                        wire:model="sub_total">
                                                    @error('sub_total')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="form-control" type="text" wire:model="total">
                                                    @error('total')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table data-order='[[ 19, "desc" ]]'
                                    class="datatable table table-stripped table-bordered mb-0 dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle" rowspan="3">Sr. No.</th>
                                            <th class="text-center align-middle" rowspan="3">Time</th>
                                            <th class="text-center" colspan="6">INTAKE</th>
                                            <th class="text-center" colspan="9">OUTPUT</th>
                                            <th class="text-center align-middle" rowspan="3">Created By</th>
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
                                                <td>{{ $intake_output?->created_by?->name }}</td>
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
        </div>
    </div>
</div>
