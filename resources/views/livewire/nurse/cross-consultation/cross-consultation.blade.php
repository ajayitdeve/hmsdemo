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
                                <h3>Cross Consultation</h3>
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
                                            <label>Doctor Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="doctor_name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Priority</label>
                                            <select class="form-control" wire:model="priority">
                                                @foreach ($priorities as $priority)
                                                    <option value="{{ $priority }}">{{ $priority }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Department Name<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="department_id"
                                                data-placeholder="Select department" wire:model="department_id">
                                                <option value=""></option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Department Code</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="department_code">
                                            @error('department_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Consultant Name<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="consultant_id"
                                                wire:model="consultant_id" data-placeholder="Select consultant">
                                                <option value=""></option>
                                                @foreach ($doctors as $doctor)
                                                    <option value="{{ $doctor->id }}">
                                                        {{ $doctor->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('consultant_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Consultant Code</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="consultant_code">
                                            @error('consultant_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea class="form-control" wire:model="remarks"></textarea>
                                            @error('remarks')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-2">
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
                                <table data-order='[[ 4, "desc" ]]'
                                    class="datatable table table-stripped mb-0 dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Doctor Name</th>
                                            <th>Department Name</th>
                                            <th>Priority</th>
                                            <th>Remarks</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cross_consultant_list as $cross_consultant)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cross_consultant?->doctor?->name }}</td>
                                                <td>{{ $cross_consultant->department?->name }}</td>
                                                <td>{{ $cross_consultant->priority }}</td>
                                                <td>{{ $cross_consultant->remarks }}</td>
                                                <td>{{ $cross_consultant?->created_by?->name }}</td>
                                                <td>{{ $cross_consultant->created_at }}</td>
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

            $(document).on("change", "select[name='department_id']", function() {
                @this.call("changedDepartment");
            });

            $(document).on("change", "select[name='consultant_id']", function() {
                @this.call("changedConsultant");
            });
        </script>
    @endpush
</div>
