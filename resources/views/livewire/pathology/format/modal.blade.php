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
<!-- Delete Modal -->
<div wire:ignore.self class="modal custom-modgal fade" id="delete" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form wire:submit.prevent='destroy'>
                    <div class="form-header">
                        <h3>Delete </h3>
                        <p>Are you sure want to delete ?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary continue-btn btn-block">Delete</>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-dismiss="modal"
                                    class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete  Modal -->

<!-- Add  Modal -->
<div wire:ignore.self class="modal custom-modal fade" id="add" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Format</h5>
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()' aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('partials.alert-message')

                <form wire:submit.prevent='save'>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Department <span class="text-danger">*</span></label>
                                        <select wire:model='department_id' class="form-control"
                                            wire:change='departmentChanged'>
                                            <option value="">Select </option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}
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
                                        <label>Service Group <span class="text-danger">*</span></label>
                                        <select wire:model='service_group_id' class="form-control"
                                            wire:change='serviceGroupChanged'>
                                            <option value="">Select </option>
                                            @foreach ($servicegroups as $servicegroup)
                                                <option value="{{ $servicegroup->id }}">{{ $servicegroup->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('service_group_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Service <span class="text-danger">*</span></label>
                                        <select wire:model='service_id' class="form-control">
                                            <option value="">Select </option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('service_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" wire:model='name' />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Lab Equal. Name</label>
                                        <input type="text" class="form-control" wire:model='lab_equivalent_name' />
                                        @error('lab_equivalent_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Report Title</label>
                                        <input type="text" class="form-control" wire:model='report_title' />
                                        @error('report_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label> Doctor Code</label>
                                    <select wire:model='doctor_id' class="form-control">
                                        <option value="">Select </option>
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('doctor_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 ml-4">
                                            <div class="d-flex">
                                                <label> Normal Range</label>
                                                <input type="checkbox" class="form-check-input"
                                                    wire:model='is_gender_specific'>
                                            </div>

                                        </div>

                                        <div class="col-md-2">
                                            <div class="d-flex">
                                                <label> Sample Needed</label>
                                                <input type="checkbox" class="form-check-input"
                                                    wire:model='is_sample_needed'>
                                            </div>

                                        </div>

                                        <div class="col-md-2">
                                            <div class="d-flex">
                                                <label> Growth</label>
                                                <input type="checkbox" class="form-check-input"
                                                    wire:model='is_growth'>
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="d-flex">
                                                <label> Specimen</label>
                                                <input type="checkbox" class="form-check-input"
                                                    wire:model='specimen'>
                                            </div>

                                        </div>

                                        <div class="col-md-2">
                                            <div class="d-flex">
                                                <label> Default Format</label>
                                                <input type="checkbox" class="form-check-input"
                                                    wire:model='is_default_format'>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Col Cap 1</label>
                                        <input type="text" class="form-control" wire:model='column_cap_1' />
                                        @error('column_cap_1')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Col Cap 2</label>
                                        <input type="text" class="form-control" wire:model='column_cap_2' />
                                        @error('column_cap_2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Col Cap 3</label>
                                        <input type="text" class="form-control" wire:model='column_cap_3' />
                                        @error('column_cap_3')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Col Cap 4</label>
                                        <input type="text" class="form-control" wire:model='column_cap_4' />
                                        @error('column_cap_4')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card ">
                                        <div class="card-body p-1 m-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="">Min Time</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control"
                                                                wire:model='min_time' />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">

                                                        <div class="col-md-12">
                                                            <select wire:model='time_ins_min' class="form-control">
                                                                <option value="">Select </option>
                                                                @foreach ($timins as $timin)
                                                                    <option value="{{ $timin->id }}">
                                                                        {{ $timin->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card ">
                                        <div class="card-body p-1 m-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="">Max Time</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control"
                                                                wire:model='max_time' />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">

                                                        <div class="col-md-12">
                                                            <select wire:model='time_ins_max' class="form-control">
                                                                <option value="">Select </option>
                                                                @foreach ($timins as $timin)
                                                                    <option value="{{ $timin->id }}">
                                                                        {{ $timin->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            {{-- Parameter Values  --}}

                            <div class="card">
                                <div class="card-header">
                                    <div class="table-responsive">
                                        <table class="table table-bordered custom-table mb-0">
                                            <thead>
                                                <tr style="font-size: 12px;">
                                                    <th>Id</th>
                                                    <th>Sub Title</th>
                                                    <th>Parameter Desc</th>
                                                    <th>Parameter Code</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($parameterValuesArr as $parameterValue)
                                                    <tr>
                                                        <td>{{ $parameterValue['id'] }} <button type="button"
                                                                class="btn-primary"
                                                                wire:click="deleteCart({{ $parameterValue['id'] }})"><i
                                                                    class="fa fa-trash"></i></button></td>

                                                        <td>{{ $parameterValue['sub_title'] }}</td>
                                                        <td>{{ $parameterValue['parameter_name'] }}</td>
                                                        <td>{{ $parameterValue['parameter_code'] }}</td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-0 pb-0">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Sub Title</label>
                                                <input type="text" class="form-control" wire:model='sub_title' />
                                                @error('sub_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Parameters<span class="text-danger">*</span></label>
                                                <select wire:model='parameter_id' class="form-control">
                                                    <option value="">Select </option>
                                                    @foreach ($parameters as $parameter)
                                                        <option value="{{ $parameter->id }}">{{ $parameter->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('parameter_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3 text-center">
                                            <br />
                                            <button style="float:right" type="button"
                                                class="btn btn-primary btn-sm d-block "
                                                wire:click="addToCart">Add</button>

                                        </div>

                                    </div>

                                </div>
                            </div>

                            {{-- End Parameter Values --}}
                        </div>
                    </div>

                    <div class="ubmit-section mt-0 pt-0 text-center">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Modal -->
