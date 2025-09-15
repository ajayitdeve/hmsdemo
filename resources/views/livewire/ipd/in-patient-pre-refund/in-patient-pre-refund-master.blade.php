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
                                <h3 class="m-0">In Patient Pre Refund</h3>
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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <input class="form-control" type="text" readonly wire:model="gender">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
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
                                            <label>Corporate Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="corporate_name">
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

                            <div class="card-body pt-0">
                                <hr>
                                <h4>Previous Advance Details</h4>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped datatable">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Mode</th>
                                                <th>Created By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($prev_advance_list as $prev_advance)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ date('Y-m-d H:i:s a', strtotime($prev_advance?->created_at)) }}
                                                    </td>
                                                    <td>{{ $prev_advance?->amount }}</td>
                                                    <td>{{ $prev_advance?->mode }}</td>
                                                    <td>{{ $prev_advance?->created_by?->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-body pt-0">
                                <hr>
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Refund No. <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly wire:model="refund_no">
                                            @error('refund_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Refund Date <span class="text-danger">*</span></label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="refund_date">
                                            @error('refund_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Approx. Bill Amount</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="gross_amount">
                                            @error('gross_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Total Advance</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="total_advance">
                                            @error('total_advance')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Due Amount</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="due_amount">
                                            @error('due_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Amount <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" wire:model="amount">
                                            @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Payment Mode <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="payment_mode">
                                                <option value="cash">Cash</option>
                                                <option value="online">Online</option>
                                            </select>
                                            @error('payment_mode')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    @if ($payment_mode == 'online')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Transaction ID <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    wire:model="transaction_id">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <input class="form-control" type="text" wire:model="remarks">
                                            @error('remarks')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Save
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

            $(document).on("change", "select[name='ipd_id']", function() {
                @this.call("ipdChanged");
            });
        </script>
    @endpush
</div>
