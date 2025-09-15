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
                                <h3>New Diet Plan</h3>
                            </div>

                            <div class="card-body" style="background: {{ $bg_color }}">
                                <div class="row mb-0 pb-0">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Diet Indent No.</label>
                                            <input class="form-control" type="text" wire:model="diet_indent_no">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Diet Indent Date</label>
                                            <input class="form-control" type="date" readonly
                                                wire:model="diet_indent_date">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>From Dept. Code<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="from_department_code">
                                            @error('from_department_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>From Dept. Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="from_department_name">
                                            @error('from_department_name')
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

                                    {{-- <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Stock Point Code<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="stock_point_code">
                                            @error('stock_point_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Stock Point Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="stock_point_name">
                                            @error('stock_point_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> --}}

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
                                            <label>UMR No</label>
                                            <input class="form-control" type="text" wire:model="umr">
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
                                            <label>Doctor Code</label>
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
                                            <label>Ward</label>
                                            <input class="form-control" type="text" readonly wire:model="ward">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Room</label>
                                            <input class="form-control" type="text" readonly wire:model="room">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Bed</label>
                                            <input class="form-control" type="text" readonly wire:model="bed">
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
                                <table data-order='[[ 3, "desc" ]]'
                                    class="datatable table table-stripped mb-0 dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Between</th>
                                            <th>And</th>
                                            <th>Food Item</th>
                                            <th>Qty.</th>
                                            <th>Instructions</th>
                                            <th>Calories</th>
                                            <th>CHO</th>
                                            <th>Protien</th>
                                            <th>Fat</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($diet_sheet_list as $diet_sheet)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $diet_sheet->note }}</td>
                                                <td>{{ $diet_sheet->note }}</td>
                                                <td>{{ $diet_sheet->note }}</td>
                                                <td>{{ $diet_sheet->note }}</td>
                                                <td>{{ $diet_sheet->note }}</td>
                                                <td>{{ $diet_sheet->note }}</td>
                                                <td>{{ $diet_sheet->note }}</td>
                                                <td>{{ $diet_sheet?->created_by?->name }}</td>
                                                <td>{{ $diet_sheet->created_at }}</td>
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
