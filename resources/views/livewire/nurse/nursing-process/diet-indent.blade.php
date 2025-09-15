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
                                <h3>Diet Indent</h3>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Diet Indent No.<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="diet_indent_no">
                                            @error('admn_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
                                            <label>UMR No<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly wire:model="umr">
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
                                            <label>Diet Indent Date<span class="text-danger">*</span></label>
                                            <input class="form-control" type="date" wire:model="diet_indent_date">
                                            @error('diet_indent_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Diet Indent Time<span class="text-danger">*</span></label>
                                            <input class="form-control" type="time" wire:model="diet_indent_time">
                                            @error('diet_indent_time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Height ({{ $height_unit }})</label>
                                            <input class="form-control" type="number" step="0.1"
                                                wire:model="height" min="0">
                                            @error('height')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Weight ({{ $weight_unit }})</label>
                                            <input class="form-control" type="number" step="0.1"
                                                wire:model="weight" min="0">
                                            @error('weight')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>BMI</label>
                                            <input class="form-control" type="text" readonly wire:model="bmi">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Diet Type<span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="diet_type">
                                                <option value="">Select Diet Type</option>
                                                @foreach ($diet_types as $type)
                                                    <option value="{{ $type }}">{{ $type }}</option>
                                                @endforeach
                                            </select>
                                            @error('diet_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Diet Category<span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="diet_category">
                                                <option value="">Select Diet Category</option>
                                                @foreach ($diet_categories as $category)
                                                    <option value="{{ $category }}">{{ $category }}</option>
                                                @endforeach
                                            </select>
                                            @error('diet_category')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Meal/Juice Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" wire:model="meal">
                                            @error('meal')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diagnosis</label>
                                            <textarea class="form-control" rows="6" wire:model="diagnosis"></textarea>
                                            @error('diagnosis')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Notes</label>
                                            <textarea class="form-control" rows="6" wire:model="note"></textarea>
                                            @error('note')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
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
                                <table data-order='[[ 12, "desc" ]]'
                                    class="datatable table table-stripped mb-0 dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Code</th>
                                            <th>Date Time</th>
                                            <th>Height</th>
                                            <th>Weight</th>
                                            <th>BMI</th>
                                            <th>Type</th>
                                            <th>Category</th>
                                            <th>Meal</th>
                                            <th>Diagnosis</th>
                                            <th>Note</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($diet_indent_list as $diet_indent)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $diet_indent->code }}</td>
                                                <td>
                                                    {{ date('d-M-Y', strtotime($diet_indent->diet_indent_date)) }}
                                                    {{ date('h:i a', strtotime($diet_indent->diet_indent_time)) }}
                                                </td>
                                                <td>{{ $diet_indent->height }} {{ $height_unit }}</td>
                                                <td>{{ $diet_indent->weight }} {{ $weight_unit }}</td>
                                                <td>{{ $diet_indent->bmi }}</td>
                                                <td>{{ $diet_indent->diet_type }}</td>
                                                <td>{{ $diet_indent->diet_category }}</td>
                                                <td>{{ $diet_indent->meal }}</td>
                                                <td>{{ $diet_indent->diagnosis }}</td>
                                                <td>{{ $diet_indent->note }}</td>
                                                <td>{{ $diet_indent?->created_by?->name }}</td>
                                                <td>{{ $diet_indent->created_at }}</td>
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
