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

        .custom-control-label::before,
        .custom-control-label::after {
            top: .05rem;
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
                <h5 class="modal-title">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()' aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='save'>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Type <span class="text-danger">*</span></label>
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

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Group <span class="text-danger">*</span></label>
                                <select wire:model='item_group_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($itemgroups as $itemgroup)
                                        <option value="{{ $itemgroup->id }}">{{ $itemgroup->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('item_group_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Generic <span class="text-danger">*</span></label>
                                <select wire:model="generic_id" class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($generics as $generic)
                                        <option value="{{ $generic->id }}">{{ $generic->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('generic_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Form Code <span class="text-danger">*</span></label>
                                <select wire:model="form_id" class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($forms as $form)
                                        <option value="{{ $form->id }}">{{ $form->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('form_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Item Code</label>
                                <input type="text" class="form-control" wire:model='code' readonly />
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Item Description<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model='description'
                                    wire:change='itemDescriptionChanged' />
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Category</label>
                                <select wire:model="category_id" class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Specialization </label>
                                <select wire:model="item_specialization_id" class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($itemspecializations as $itemspecialization)
                                        <option value="{{ $itemspecialization->id }}">{{ $itemspecialization->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('item_specialization_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Manufacturer</label>
                                <select wire:model="manufacturer_id" class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($manufacturers as $manufacturer)
                                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('manufacturer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Purchase UOM <span class="text-danger">*</span></label>
                                <select wire:model='purchase_uom_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($uoms as $uom)
                                        <option value="{{ $uom->id }}">{{ $uom->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('puchase_uom_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Issue UOM <span class="text-danger">*</span></label>
                                <select wire:model='issue_uom_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($uoms as $uom)
                                        <option value="{{ $uom->id }}">{{ $uom->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('issue_uom_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>HSN Code <span class="text-danger">*</span></label>
                                <input type="text" wire:model='hsn' class="form-control" placeholder="HSN">

                                @error('hsn')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>SGST <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="sgst" />
                                @error('igst')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CGST <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="cgst" />
                                @error('cgst')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>IGST <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="igst" />
                                @error('igst')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Alert Days Before Expiry</label>
                                <input type="number" class="form-control" wire:model="alert_days_before_expiry">
                                @error('alert_days_before_expiry')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sale Rate for Billing Amount</label>
                                <input type="text" class="form-control" wire:model="sale_rate_for_billing_amount">
                                @error('sale_rate_for_billing_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sale Rate for Billing Percentage</label>
                                <input type="text" class="form-control"
                                    wire:model="sale_rate_for_billing_percentage">
                                @error('sale_rate_for_billing_percentage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sale Rate for Billing Used For</label>
                                <select wire:model="sale_rate_for_billing_used_for" class="form-control">
                                    <option value="both">Both</option>
                                    <option value="op">OP</option>
                                    <option value="ip">IP</option>
                                </select>
                                @error('sale_rate_for_billing_used_for')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @if ($type_id == 1)
                            <div class="col-md-2">
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="is_asset"
                                            value="1" wire:model="is_asset">
                                        <label class="custom-control-label" for="is_asset">
                                            Is Asset
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-2">
                            <div class="">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="batch_no_required"
                                        value="1" wire:model="batch_no_required">
                                    <label class="custom-control-label" for="batch_no_required">
                                        Batch No Req
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="is_narcotic"
                                        value="1" wire:model="is_narcotic">
                                    <label class="custom-control-label" for="is_narcotic">
                                        Is Narcotic
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="is_high_risk"
                                        value="1" wire:model="is_high_risk">
                                    <label class="custom-control-label" for="is_high_risk">
                                        Is Hight Risk
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="is_non_returnable_item"
                                        value="1" wire:model="is_non_returnable_item">
                                    <label class="custom-control-label" for="is_non_returnable_item">
                                        Is Non Returnable Item
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section mt-3 pt-0 text-center">
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
                <h5 class="modal-title">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()'
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='update'>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Type <span class="text-danger">*</span></label>
                                <select wire:model='type_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($types as $type)
                                        @if ($type->id == $type_id)
                                            <option selected value="{{ $type->id }}">{{ $type->name }}
                                            </option>
                                        @else
                                            <option value="{{ $type->id }}">{{ $type->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Group <span class="text-danger">*</span></label>
                                <select wire:model='item_group_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($itemgroups as $itemgroup)
                                        <option value="{{ $itemgroup->id }}">{{ $itemgroup->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('item_group_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Generic <span class="text-danger">*</span></label>
                                <select wire:model="generic_id" class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($generics as $generic)
                                        <option value="{{ $generic->id }}">{{ $generic->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('generic_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Form Code <span class="text-danger">*</span></label>
                                <select wire:model="form_id" class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($forms as $form)
                                        <option value="{{ $form->id }}">{{ $form->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('form_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Item Code</label>
                                <input type="text" class="form-control" wire:model='code' readonly />
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Item Description<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model='description' />
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Category</label>
                                <select wire:model="category_id" class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Specialization </label>
                                <select wire:model="item_specialization_id" class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($itemspecializations as $itemspecialization)
                                        <option value="{{ $itemspecialization->id }}">{{ $itemspecialization->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('item_specialization_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Manufacturer</label>
                                <select wire:model="manufacturer_id" class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($manufacturers as $manufacturer)
                                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('manufacturer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Purchase UOM <span class="text-danger">*</span></label>
                                <select wire:model='purchase_uom_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($uoms as $uom)
                                        <option value="{{ $uom->id }}">{{ $uom->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('puchase_uom_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Issue UOM <span class="text-danger">*</span></label>
                                <select wire:model='issue_uom_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($uoms as $uom)
                                        <option value="{{ $uom->id }}">{{ $uom->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('issue_uom_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>HSN Code </label>
                                <input type="text" wire:model='hsn' class="form-control" placeholder="HSN">

                                @error('hsn')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>IGST</label>
                                <input type="text" class="form-control" wire:model="igst" />
                                @error('igst')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CGST</label>
                                <input type="text" class="form-control" wire:model="cgst" />
                                @error('cgst')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>SGST</label>
                                <input type="text" class="form-control" wire:model="sgst" />
                                @error('igst')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Alert Days Before Expiry</label>
                                <input type="number" class="form-control" wire:model="alert_days_before_expiry">
                                @error('alert_days_before_expiry')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sale Rate for Billing Amount</label>
                                <input type="number" class="form-control" wire:model="sale_rate_for_billing_amount">
                                @error('sale_rate_for_billing_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sale Rate for Billing Percentage</label>
                                <input type="number" class="form-control"
                                    wire:model="sale_rate_for_billing_percentage">
                                @error('sale_rate_for_billing_percentage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sale Rate for Billing Used For</label>
                                <select wire:model="sale_rate_for_billing_used_for" class="form-control">
                                    <option value="both">Both</option>
                                    <option value="op">OP</option>
                                    <option value="ip">IP</option>
                                </select>
                                @error('sale_rate_for_billing_used_for')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @if ($type_id == 1)
                            <div class="col-md-2">
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="is_asset"
                                            value="1" wire:model="is_asset">
                                        <label class="custom-control-label" for="is_asset">
                                            Is Asset
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-2">
                            <div class="">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="batch_no_required"
                                        value="1" wire:model="batch_no_required">
                                    <label class="custom-control-label" for="batch_no_required">
                                        Batch No Req
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="is_narcotic"
                                        value="1" wire:model="is_narcotic">
                                    <label class="custom-control-label" for="is_narcotic">
                                        Is Narcotic
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="is_high_risk"
                                        value="1" wire:model="is_high_risk">
                                    <label class="custom-control-label" for="is_high_risk">
                                        Is Hight Risk
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="is_non_returnable_item"
                                        value="1" wire:model="is_non_returnable_item">
                                    <label class="custom-control-label" for="is_non_returnable_item">
                                        Is Non Returnable Item
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="submit-section mt-3 pt-0 text-center">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Edit Modal -->
