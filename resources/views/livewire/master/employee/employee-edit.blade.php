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
                                <h3>Employee Edit</h3>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Catgeory<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="employee_category_id"
                                                data-placeholder="Select Catgeory" wire:model="employee_category_id">
                                                <option value=""></option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('employee_category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Employee Code<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" wire:model="employee_code">
                                            @error('employee_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Title<span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="title_id"
                                                wire:change="titleChanged">
                                                @foreach ($titles as $title)
                                                    <option value="{{ $title->id }}">{{ $title->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('title_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Employee Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" wire:model="employee_name">
                                            @error('employee_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Gender<span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="gender_id"
                                                wire:change="genderChanged">
                                                @foreach ($genders as $gender)
                                                    <option value="{{ $gender->id }}">
                                                        {{ $gender->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('gender_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Father's Name<span class="text-danger">*</span></label>
                                            <div class="row">
                                                <div class="col-md-4 mr-0 pr-0">
                                                    <select class="form-control" wire:model="relation_id">
                                                        @foreach ($relations as $relation)
                                                            <option value="{{ $relation->id }}">{{ $relation->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('relation_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-8 ml-0 pl-0">
                                                    <input class="form-control " type="text"
                                                        wire:model="father_name">
                                                    @error('father_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>D.O.B<span class="text-danger">*</span></label>
                                            <input class="form-control" type="date" wire:model="dob">
                                            @error('dob')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>D.O.J<span class="text-danger">*</span></label>
                                            <input class="form-control" type="date" wire:model="doj">
                                            @error('doj')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Religion</label>
                                            <select class="form-control" wire:model="religion_id">
                                                <option value="">Not Specified</option>
                                                @foreach ($religions as $religion)
                                                    <option value="{{ $religion->id }}">{{ $religion->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('religion_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Nationality</label>
                                            <select class="form-control" wire:model="nationality_id">
                                                <option value="">Not Specified</option>
                                                @foreach ($nationalities as $nationality)
                                                    <option value="{{ $nationality->id }}">{{ $nationality->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('nationality_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Marital Status</label>
                                            <select class="form-control" wire:model="marital_id">
                                                <option value="">Not Specified</option>
                                                @foreach ($maritals as $marital)
                                                    <option value="{{ $marital->id }}">{{ $marital->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('marital_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Qualification<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" wire:model="qualification">
                                            @error('qualification')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Qualified University</label>
                                            <input class="form-control" type="text"
                                                wire:model="qualified_university">
                                            @error('qualified_university')
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
                                            <label>Designation<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="designation_id"
                                                data-placeholder="Select Designation" wire:model="designation_id">
                                                <option value=""></option>
                                                @foreach ($designations as $designation)
                                                    <option value="{{ $designation->id }}">
                                                        {{ $designation->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('designation_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mt-4">
                                            <div class="form-group rounded px-2 pt-1 border mt-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="is_hod"
                                                        id="is_hod" value="1" wire:model="is_hod">
                                                    <label class="form-check-label" for="is_hod">IsHOD</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Cost Center<span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="cost_center_id">
                                                @foreach ($cost_centers as $cost_center)
                                                    <option value="{{ $cost_center->id }}">
                                                        {{ $cost_center->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('cost_center_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Blood Group</label>
                                            <select class="form-control" wire:model="bloodgroup_id">
                                                <option value="">Not Specified</option>
                                                @foreach ($bloodgroups as $bloodgroup)
                                                    <option value="{{ $bloodgroup->id }}">
                                                        {{ $bloodgroup->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('bloodgroup_id')
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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="email" wire:model="email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Pin Code</label>
                                            <input class="form-control" wire:model="pincode" type="text"
                                                onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                                type="tel" maxlength="6" pattern="[0-9]{6}"
                                                title="6 Digit Pincode">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Village<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="village_id"
                                                data-placeholder="Select Village" wire:model="village_id">
                                                <option value=""></option>
                                                @foreach ($villages as $village)
                                                    <option value="{{ $village->id }}">
                                                        {{ $village->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('village_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" wire:model="address">
                                            @error('address')
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

            $(document).on("change", "select[name='village_id']", function() {
                @this.call("villageChanged");
            });
        </script>
    @endpush
</div>
