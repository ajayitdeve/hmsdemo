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
                                <h3>In Patient Credit Limit</h3>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>IPD No.<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="ipd_id"
                                                data-placeholder="Select IPD No" wire:model="ipd_id">
                                                <option value=""></option>
                                                @foreach ($ipds as $ipd)
                                                    <option value="{{ $ipd->id }}">
                                                        {{ $ipd->ipdcode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('ipd_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Patient Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_name">
                                            @error('patient_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control" type="text" readonly wire:model="age">
                                            @error('age')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Patient Type</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_type">
                                            @error('patient_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>UMR No.<span class="text-danger">*</span></label>
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
                                            @error('ward')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Room</label>
                                            <input class="form-control" type="text" readonly wire:model="room">
                                            @error('room')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Bed</label>
                                            <input class="form-control" type="text" readonly wire:model="bed">
                                            @error('bed')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Credit Limit Amount<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" wire:model="credit_limit">
                                            @error('credit_limit')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Authrization By<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="authrization_by"
                                                data-placeholder="Select Authrization By" wire:model="authrization_by">
                                                <option value=""></option>
                                                @foreach ($organizations as $organization)
                                                    <option value="{{ $organization->id }}">{{ $organization->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('authrization_by')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Authrization Code<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="authrization_code">
                                            @error('authrization_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <input class="form-control" type="text" wire:model="remarks">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary m-3">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table data-order='[[ 7, "desc" ]]'
                                    class="table table-striped datatable custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>UMR</th>
                                            <th>Admn No.</th>
                                            <th>Amount</th>
                                            <th>Authrization</th>
                                            <th>Remarks</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patient_credits as $key => $patient_credit)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $patient_credit?->patient?->registration_no }}</td>
                                                <td>{{ $patient_credit?->ipd?->ipdcode }}</td>
                                                <td>{{ $patient_credit->credit_limit }}</td>
                                                <td>{{ $patient_credit?->authrization?->name }}</td>
                                                <td>{{ $patient_credit->remarks }}</td>
                                                <td>{{ $patient_credit?->created_by?->name }}</td>
                                                <td>{{ $patient_credit->created_at }}</td>
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

            $(document).on("change", "select[name='ipd_id']", function() {
                @this.call("ipdChanged");
            });

            $(document).on("change", "select[name='umr']", function() {
                @this.call("umrChanged");
            });

            $(document).on("change", "select[name='authrization_by']", function() {
                @this.call("authrizationChanged");
            });
        </script>
    @endpush
</div>
