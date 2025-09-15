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
                                <h3>Drug Indent</h3>
                            </div>

                            <div class="card-body" style="background: {{ $bg_color }}">
                                <div class="row mb-0 pb-0">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>NRQ No.<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly wire:model="nrq_no">
                                            @error('nrq_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>NRQ Date<span class="text-danger">*</span></label>
                                            <input class="form-control" type="date" readonly wire:model="nrq_date">
                                            @error('nrq_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Req By</label>
                                            <input class="form-control" type="text" readonly wire:model="req_by">
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
                                            <input class="form-control" readonly type="text" wire:model="ward">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Room</label>
                                            <input class="form-control" readonly type="text" wire:model="room">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Bed</label>
                                            <input class="form-control" readonly type="text" wire:model="bed">
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
                                            <label>Patient Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>From Nurse Dept.</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="nurse_department_code">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>From Nurse Dept. Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="nurse_department_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Doctor</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="doctor_code">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Doctor Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="doctor_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Stock Point<span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="stock_point_id" disabled>
                                                <option value="">Select Stock Point</option>
                                                @foreach ($stock_points as $stockpoint)
                                                    <option value="{{ $stockpoint->id }}">
                                                        {{ $stockpoint->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('stock_point_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Stock Point Code</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="stock_point_code">
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
                                            <label>Patient Type</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_type">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>From Doctor Dept.</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="doctor_department_code">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>From Doctor Dept. Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="doctor_department_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <input class="form-control" type="text" readonly wire:model="remarks">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Item Name</th>
                                                <th>Batch No</th>
                                                <th>Qunatity</th>
                                                <th>Unit Sale Price</th>
                                                <th>Amount</th>
                                                <th>Discount</th>
                                                <th>Taxable Amount</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $grandTotal = 0.0; ?>
                                            @foreach ($arrCart as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->item->description }}</td>
                                                    <td>{{ $item['batch_no'] }}</td>
                                                    <td>{{ $item['quantity'] }}</td>
                                                    <td>{{ $item['unit_sale_price'] }}</td>
                                                    <td>{{ $item['amount'] }}</td>
                                                    <td>{{ $item['discount'] }}</td>
                                                    <td>{{ $item['taxable_amount'] }}</td>
                                                    <td>{{ $item['total'] }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <th>{{ $payableAmount }}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
