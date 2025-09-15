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
                            <h3>Patient Approximate Bill</h3>
                        </div>

                        <div class="card-body">
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
                                        <label>UMR No<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" readonly wire:model="umr">
                                        @error('umr')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Consultant</label>
                                        <input class="form-control" type="text" readonly wire:model="consultant">
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
                                    <h4>Billing Details</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered m-0">
                                            <thead>
                                                <tr>
                                                    <th>Billing Head</th>
                                                    <th>Amount</th>
                                                    <th>Concession</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>IP Pharmacy Charges</td>
                                                    <td></td>
                                                    <td>0</td>
                                                </tr>

                                                <tr>
                                                    <td>Investigation Charges</td>
                                                    <td></td>
                                                    <td>0</td>
                                                </tr>

                                                <tr>
                                                    <td>Total</td>
                                                    <td></td>
                                                    <td>0</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Receipt Details</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered m-0">
                                            <thead>
                                                <tr>
                                                    <th>Receipt No.</th>
                                                    <th>Receipt Amount</th>
                                                    <th>Receipt Date</th>
                                                </tr>
                                            </thead>

                                            <tbody>

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
    </div>
</div>
