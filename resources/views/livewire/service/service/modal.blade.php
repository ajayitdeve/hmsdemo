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
<!-- Delete Holiday Modal -->
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
                <h5 class="modal-title">Add Service</h5>
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
                                <label>Teriff <span class="text-danger">*</span></label>
                                <select name="teriff_id" wire:model='teriff_id' class="form-control"
                                    data-placeholder="Select Teriff">
                                    <option value=""></option>
                                    @foreach ($teriffs as $teriff)
                                        <option value="{{ $teriff->id }}">{{ $teriff->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('teriff_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Department <span class="text-danger">*</span></label>
                                <select name="department_id" wire:model='department_id' class="form-control select2"
                                    data-placeholder="Select Department">
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
                                <label>Service Group <span class="text-danger">*</span></label>
                                <select name="service_group_id" wire:model='service_group_id'
                                    class="form-control select2" data-placeholder="Select Service Group">
                                    <option value=""></option>
                                    @foreach ($servicegroups as $servicegroup)
                                        <option value="{{ $servicegroup->id }}">
                                            {{ $servicegroup->name }}
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
                                <label>Billing Head <span class="text-danger">*</span></label>
                                <select wire:model='billing_head_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($billingheads as $billinghead)
                                        <option value="{{ $billinghead->id }}">{{ $billinghead->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('billing_head_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cost Center <span class="text-danger">*</span></label>
                                <select wire:model='cost_center_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($costcenters as $costcenter)
                                        <option value="{{ $costcenter->id }}">{{ $costcenter->name }}
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
                                <label>Location <span class="text-danger">*</span></label>
                                <select wire:model='location_id' class="form-control">
                                    <option value="">Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Service Type<span class="text-danger">*</span></label>
                                <select wire:model='type' class="form-control">
                                    <option value="">Select</option>
                                    <option value="S">Service</option>
                                    <option value="I">Investigation</option>
                                    <option value="M">Miscellaneous</option>
                                    <option value="P">Procedure</option>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Service Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model='name' />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea class="form-control" wire:model='remarks' rows="2"></textarea>
                                @error('remarks')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Service Charge<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model='charge'
                                    wire:change='chargeChange()' />
                                @error('charge')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Emergency Charge<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model='emergency_charge' />
                                @error('emergency_charge')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Hospital %</label>
                                <input type="number" class="form-control" wire:model='hospital_percent'
                                    wire:change='hospitalPercentChange()' />
                                @error('hospital_percent')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Hospital Amount</label>
                                <input type="number" class="form-control" wire:model='hospital_amount'
                                    wire:change='hospitalAmountChange()' />
                                @error('hospital_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor % </label>
                                <input type="number" wire:model='doctor_percent' class="form-control"
                                    wire:change='doctorPercentChange()'>

                                @error('doctor_percent')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor amount </label>
                                <input type="number" wire:model='doctor_amount' class="form-control"
                                    wire:change='doctorAmountChange()'>

                                @error('doctor_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mr-2 pr-2">
                        <div class="col-md-2 mr-2">
                            <div class="row form-group p-2" style="border:1px solid #ced4da">
                                <label class="col-md-8 text-bold mt-1"><strong>Is Package</strong></label>
                                <input type="checkbox" class="form-control col-md-2" wire:model='ispackage' />
                                @error('ispackage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2 mr-2">
                            <div class="row form-group p-2" style="border:1px solid #ced4da">
                                <label class="col-md-8 text-bold mt-1"><strong>Is Procedure</strong></label>
                                <input type="checkbox" class="form-control col-md-2" wire:model='isprocedure' />
                                @error('isprocedure')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2 mr-2">
                            <div class="row form-group p-2" style="border:1px solid #ced4da">
                                <label class="col-md-8 text-bold mt-1"><strong>Is OutSide</strong></label>
                                <input type="checkbox" class="form-control col-md-2" wire:model='isoutside' />
                                @error('isoutside')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2 mr-2">
                            <div class="row form-group p-2" style="border:1px solid #ced4da">
                                <label class="col-md-11 text-bold mt-1"><strong>Is Sample Needed</strong></label>
                                <input type="checkbox" class="form-control col-md-1" wire:model='issampleneeded' />
                                @error('issampleneeded')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="row form-group p-2" style="border:1px solid #ced4da">
                                <label class="col-md-8 text-bold mt-1"><strong>Is Diet</strong></label>
                                <input type="checkbox" class="form-control col-md-2" wire:model='isdiet' />
                                @error('isdiet')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                <h5 class="modal-title">Edit Service</h5>
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()'
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('partials.alert-message')

                <form wire:submit.prevent='update'>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Teriff <span class="text-danger">*</span></label>
                                <select name="teriff_id" wire:model='teriff_id' class="form-control"
                                    data-placeholder="Select Teriff">
                                    <option value=""></option>
                                    @foreach ($teriffs as $teriff)
                                        <option value="{{ $teriff->id }}">{{ $teriff->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('teriff_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Department <span class="text-danger">*</span></label>
                                <select name="department_id" wire:model='department_id' class="form-control select2"
                                    data-placeholder="Select Department">
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
                                <label>Service Group <span class="text-danger">*</span></label>
                                <select name="service_group_id" wire:model='service_group_id'
                                    class="form-control select2" data-placeholder="Select Service Group">
                                    <option value=""></option>
                                    @foreach ($servicegroups as $servicegroup)
                                        <option value="{{ $servicegroup->id }}">
                                            {{ $servicegroup->name }}
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
                                <label>Billing Head <span class="text-danger">*</span></label>
                                <select wire:model='billing_head_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($billingheads as $billinghead)
                                        <option value="{{ $billinghead->id }}">{{ $billinghead->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('billing_head_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cost Center <span class="text-danger">*</span></label>
                                <select wire:model='cost_center_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($costcenters as $costcenter)
                                        <option value="{{ $costcenter->id }}">{{ $costcenter->name }}
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
                                <label>Location <span class="text-danger">*</span></label>
                                <select wire:model='location_id' class="form-control">
                                    <option value="">Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Service Type<span class="text-danger">*</span></label>
                                <select wire:model='type' class="form-control">
                                    <option value="">Select</option>
                                    <option value="S">Service</option>
                                    <option value="I">Investigation</option>
                                    <option value="M">Miscellaneous</option>
                                    <option value="P">Procedure</option>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Service Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model='name' />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea class="form-control" wire:model='remarks' rows="2"></textarea>
                                @error('remarks')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Service Charge<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model='charge'
                                    wire:change='chargeChange()' />
                                @error('charge')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Emergency Charge<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model='emergency_charge' />
                                @error('emergency_charge')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Hospital %</label>
                                <input type="number" class="form-control" wire:model='hospital_percent'
                                    wire:change='hospitalPercentChange()' />
                                @error('hospital_percent')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Hospital Amount</label>
                                <input type="number" class="form-control" wire:model='hospital_amount'
                                    wire:change='hospitalAmountChange()' />
                                @error('hospital_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor % </label>
                                <input type="number" wire:model='doctor_percent' class="form-control"
                                    wire:change='doctorPercentChange()'>

                                @error('doctor_percent')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor amount </label>
                                <input type="number" wire:model='doctor_amount' class="form-control"
                                    wire:change='doctorAmountChange()'>

                                @error('doctor_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mr-2 pr-2">
                        <div class="col-md-2 mr-2">
                            <div class="row form-group p-2" style="border:1px solid #ced4da">
                                <label class="col-md-8 text-bold mt-1"><strong>Is Package</strong></label>
                                <input type="checkbox" class="form-control col-md-2" wire:model='ispackage' />
                                @error('ispackage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2 mr-2">
                            <div class="row form-group p-2" style="border:1px solid #ced4da">
                                <label class="col-md-8 text-bold mt-1"><strong>Is Procedure</strong></label>
                                <input type="checkbox" class="form-control col-md-2" wire:model='isprocedure' />
                                @error('isprocedure')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2 mr-2">
                            <div class="row form-group p-2" style="border:1px solid #ced4da">
                                <label class="col-md-8 text-bold mt-1"><strong>Is OutSide</strong></label>
                                <input type="checkbox" class="form-control col-md-2" wire:model='isoutside' />
                                @error('isoutside')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2 mr-2">
                            <div class="row form-group p-2" style="border:1px solid #ced4da">
                                <label class="col-md-11 text-bold mt-1"><strong>Is Sample Needed</strong></label>
                                <input type="checkbox" class="form-control col-md-1" wire:model='issampleneeded' />
                                @error('issampleneeded')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="row form-group p-2" style="border:1px solid #ced4da">
                                <label class="col-md-8 text-bold mt-1"><strong>Is Diet</strong></label>
                                <input type="checkbox" class="form-control col-md-2" wire:model='isdiet' />
                                @error('isdiet')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="ubmit-section mt-0 pt-0 text-center">
                        <button class="btn btn-primary submit-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Modal -->


<!-- Add increment  Modal -->
<div wire:ignore.self class="modal custom-modal fade" id="add-increment" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Increment</h5>
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()'
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='add_increment'>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Percent <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model='percentage'
                                    style="font-size: 15px !important; height: 44px !important;">
                                @error('percentage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="ubmit-section mt-3 pt-0 text-center">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add increment Modal -->
