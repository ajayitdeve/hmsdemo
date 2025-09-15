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
                                <h3>User Create</h3>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Employee Code<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="employee_id"
                                                data-placeholder="Select Employee Code" wire:model="employee_id">
                                                <option value=""></option>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}">
                                                        {{ $employee->employee_code }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('employee_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Employee Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="employee_name">
                                            @error('employee_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Department<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="department_id"
                                                data-placeholder="Select Department" wire:model="department_id">
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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>User Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" wire:model="user_name">
                                            @error('user_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>User ID<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" wire:model="user_id">
                                            @error('user_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Password<span class="text-danger">*</span></label>
                                            <input class="form-control" type="password" wire:model="password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Confirm Password<span class="text-danger">*</span></label>
                                            <input class="form-control" type="password"
                                                wire:model="password_confirmation" autocomplete="new-password">
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>User Profile<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="team_id"
                                                data-placeholder="Select User Profile" wire:model="team_id">
                                                <option value=""></option>
                                                @foreach ($teams as $team)
                                                    <option value="{{ $team->id }}">
                                                        {{ $team->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('team_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email<span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" wire:model="email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input class="form-control" type="text" wire:model="mobile">
                                            @error('mobile')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0 pb-0">
                                    <div class="col-md-12">
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

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

            $(document).on("change", "select[name='employee_id']", function() {
                @this.call("employeeChanged");
            });
        </script>
    @endpush
</div>
