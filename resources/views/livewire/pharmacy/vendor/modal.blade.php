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
<!-- Delete  Modal -->
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
                <h5 class="modal-title">Add Vendor</h5>
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()' aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='save'>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Item Group<span class="text-danger">*</span></label>
                                <select wire:model='type_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" wire:model='name' />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Legal Name</label>
                                <input type="text" class="form-control" wire:model='legal_name' />
                                @error('legal_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CST NO.</label>
                                <input type="text" class="form-control" wire:model='cst_no' />

                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Drug License No </label>
                                <input type="text" wire:model='drug_license_no' class="form-control" placeholder="">

                                @error('drug_license_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Drug License Exp Date</label>
                                <input type="date" class="form-control" wire:model="drug_license_exp_date" />

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>GST NO<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="gst_no" />
                                @error('gst_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>PAN No</label>
                                <input type="text" class="form-control" wire:model="pan_no" />
                                @error('pan_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Payment Days<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model="payment_days" />
                                @error('payment_days')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Delivery Days</label>
                                <input type="number" class="form-control" wire:model="delivery_days" />

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
                <h5 class="modal-title">Edit Vendor</h5>
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()'
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='update'>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Item Group<span class="text-danger">*</span></label>
                                <select wire:model='type_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $type->id == $type_id ? 'selected' : null }}>{{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" wire:model='name' />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Legal Name</label>
                                <input type="text" class="form-control" wire:model='legal_name' />
                                @error('legal_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CST NO.<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model='cst_no' />
                                @error('cst_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Drug License No </label>
                                <input type="text" wire:model='drug_license_no' class="form-control"
                                    placeholder="">

                                @error('drug_license_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Drug License Exp Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" wire:model="drug_license_exp_date" />
                                @error('drug_license_exp_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>GST NO<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="gst_no" />
                                @error('gst_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>PAN No</label>
                                <input type="text" class="form-control" wire:model="pan_no" />
                                @error('pan_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Payment Days<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model="payment_days" />
                                @error('payment_days')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Delivery Days<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model="delivery_days" />
                                @error('delivery_days')
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
<!-- /Edit Modal -->
