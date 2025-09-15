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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Department <span class="text-danger">*</span></label>
                                <select wire:model='department_id' class="form-control" wire:change='departmentChanged'>
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
                                <select wire:model='service_group_id' class="form-control">
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
                                <label>Format Name <span class="text-danger">*</span></label>
                                <select wire:model='format_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($formats as $format)
                                        <option value="{{ $format->id }}">{{ $format->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('format_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>S1</label>
                                <input type="text" class="form-control" wire:model='s1_cd' />
                                @error('s1_cd')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>S2</label>
                                <input type="text" class="form-control" wire:model='s2_cd' />
                                @error('s2_cd')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex mt-4 pl-4">

                                <label> Is Active</label>
                                <input type="checkbox" class="form-check-input" wire:model='is_active'>
                            </div>
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

<!-- Edit  Modal -->
<div wire:ignore.self class="modal custom-modal fade" id="edit" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Format</h5>
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()' aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('partials.alert-message')

                <form wire:submit.prevent='update'>
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
                                <select wire:model='service_group_id' class="form-control">
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
                                <label>Format Name <span class="text-danger">*</span></label>
                                <select wire:model='format_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($formats as $format)
                                        <option value="{{ $format->id }}">{{ $format->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('format_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>S1</label>
                                <input type="text" class="form-control" wire:model='s1_cd' />
                                @error('s1_cd')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>S2</label>
                                <input type="text" class="form-control" wire:model='s2_cd' />
                                @error('s2_cd')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex mt-4 pl-4">

                                <label> Is Active</label>
                                <input type="checkbox" class="form-check-input" wire:model='is_active'>
                            </div>
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
<!-- /Edit Modal -->
