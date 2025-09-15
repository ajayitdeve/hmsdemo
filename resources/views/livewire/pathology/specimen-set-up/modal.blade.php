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
                <h5 class="modal-title">Add Specimen Setup</h5>
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
                                        <label>Sample <span class="text-danger">*</span></label>
                                        <select wire:model='specimen_master_id' class="form-control">
                                            <option value="">Select </option>
                                            @foreach ($specimenMasters as $specimenMaster)
                                                <option value="{{ $specimenMaster->id }}">{{ $specimenMaster->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('specimen_master_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Duration (In Minutes)</label>
                                        <input type="number" class="form-control" wire:model='duration'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Dosage Quantity</label>
                                        <input type="number" class="form-control" wire:model='dosage_qty'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>No. Of Barcode Lables <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model='no_of_barcode'>
                                        @error('no_of_barcode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Vacutainer <span class="text-danger">*</span></label>
                                        <select wire:model='vacutainer_id' class="form-control">
                                            <option value="">Select </option>
                                            @foreach ($vacutainers as $vacutainer)
                                                <option value="{{ $vacutainer->id }}">{{ $vacutainer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('vacutainer_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Test Type <span class="text-danger">*</span></label>
                                        <select wire:model='test_type_id' class="form-control">
                                            <option value="">Select </option>
                                            @foreach ($testtypes as $testtype)
                                                <option value="{{ $testtype->id }}">{{ $testtype->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('test_type_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Short Name </label>
                                        <input type="text" class="form-control" wire:model='short_name'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Precautions </label>
                                        <input type="text" class="form-control" wire:model='precaution'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Clinical History </label>
                                        <input type="text" class="form-control" wire:model='clinical_history'>
                                    </div>
                                </div>
                            </div>
                            <div class="row">


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Color</label>
                                        <select wire:model='color_id' class="form-control">
                                            <option value="">Select </option>
                                            @foreach ($colors as $color)
                                                <option style="background-color:#{{ $color->code }}"
                                                    value="{{ $color->id }}">#{{ $color->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <?php
                                        $myColor = \App\Models\Pathology\Color::find($color_id);
                                        ?>
                                        @if ($myColor)
                                            <div
                                                style="height:20px;width:inherit;background-color:#{{ $myColor->code }}">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>S1</label>
                                        <input type="text" class="form-control" wire:model='s1_cd'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>S2</label>
                                        <input type="text" class="form-control" wire:model='s2_cd'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex mt-4 pl-4">

                                        <label> Is Active</label>
                                        <input type="checkbox" class="form-check-input" wire:model='is_active'>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            wire:model='is_applicable_for_others_test'>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Applicable For Others Test
                                        </label>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            wire:model='is_required_precaution_on_bill'>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Required Precaution On Bill
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            wire:model='is_infection_dieases'>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Infection Dieases
                                        </label>
                                    </div>
                                </div>
                                @if ($is_infection_dieases)
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model='is_curable'>
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Is Curable
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="ubmit-section mt-0 pt-0 mb-1 text-center">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /Add Modal -->
<!-- Edit Modal -->
<div wire:ignore.self class="modal custom-modal fade" id="edit" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Specimen Setup</h5>
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()'
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('partials.alert-message')

                <form wire:submit.prevent='update'>
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
                                        <label>Sample <span class="text-danger">*</span></label>
                                        <select wire:model='specimen_master_id' class="form-control">
                                            <option value="">Select </option>
                                            @foreach ($specimenMasters as $specimenMaster)
                                                <option value="{{ $specimenMaster->id }}">
                                                    {{ $specimenMaster->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('specimen_master_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Duration (In Minutes)</label>
                                        <input type="number" class="form-control" wire:model='duration'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Dosage Quantity</label>
                                        <input type="number" class="form-control" wire:model='dosage_qty'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>No. Of Barcode Lables <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model='no_of_barcode'>
                                        @error('no_of_barcode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Vacutainer <span class="text-danger">*</span></label>
                                        <select wire:model='vacutainer_id' class="form-control">
                                            <option value="">Select </option>
                                            @foreach ($vacutainers as $vacutainer)
                                                <option value="{{ $vacutainer->id }}">{{ $vacutainer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('vacutainer_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Test Type <span class="text-danger">*</span></label>
                                        <select wire:model='test_type_id' class="form-control">
                                            <option value="">Select </option>
                                            @foreach ($testtypes as $testtype)
                                                <option value="{{ $testtype->id }}">{{ $testtype->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('test_type_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Short Name </label>
                                        <input type="text" class="form-control" wire:model='short_name'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Precautions </label>
                                        <input type="text" class="form-control" wire:model='precaution'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Clinical History </label>
                                        <input type="text" class="form-control" wire:model='clinical_history'>
                                    </div>
                                </div>
                            </div>
                            <div class="row">


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Color</label>
                                        <select wire:model='color_id' class="form-control">
                                            <option value="">Select </option>
                                            @foreach ($colors as $color)
                                                <option style="background-color:#{{ $color->code }}"
                                                    value="{{ $color->id }}">#{{ $color->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <?php
                                        $myColor = \App\Models\Pathology\Color::find($color_id);
                                        ?>
                                        @if ($myColor)
                                            <div
                                                style="height:20px;width:inherit;background-color:#{{ $myColor->code }}">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>S1</label>
                                        <input type="text" class="form-control" wire:model='s1_cd'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>S2</label>
                                        <input type="text" class="form-control" wire:model='s2_cd'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex mt-4 pl-4">

                                        <label> Is Active</label>
                                        <input type="checkbox" class="form-check-input" wire:model='is_active'>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            wire:model='is_applicable_for_others_test'>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Applicable For Others Test
                                        </label>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            wire:model='is_required_precaution_on_bill'>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Required Precaution On Bill
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            wire:model='is_infection_dieases'>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Infection Dieases
                                        </label>
                                    </div>
                                </div>
                                @if ($is_infection_dieases)
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model='is_curable'>
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Is Curable
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>



                        </div>

                    </div>
                    <div class="ubmit-section mt-0 pt-0 mb-1 text-center">
                        <button class="btn btn-primary submit-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /Add Modal -->
