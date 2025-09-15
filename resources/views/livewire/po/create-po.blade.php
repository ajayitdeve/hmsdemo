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
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Create Purchase Order </h3>

                </div>
            </div>
        </div>
        <!-- /Page Header -->
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif


        <div class="row">
            <div class="col-md-12">
                <form wire:submit.prevent="store">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Indent Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="code" readonly />
                                @error('code')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Stock Point <span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="stock_point_id">
                                    <option value="">Select </option>
                                    @foreach ($stockpoints as $stockpoint)
                                        <option value="{{ $stockpoint->id }}">{{ $stockpoint->name }}</option>
                                    @endforeach
                                </select>
                                @error('stock_point_id')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Purchase Term <span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="purchase_term_id">
                                    <option value="">Select </option>
                                    @foreach ($purchaseterms as $purchaseterm)
                                        <option value="{{ $purchaseterm->id }}">{{ $purchaseterm->code }}</option>
                                    @endforeach
                                </select>
                                @error('purchase_term_id')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Vendor {{ $vendor_id }} <span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="vendor_id">
                                    <option value="">Select Vendor</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                    @endforeach

                                </select>
                                @error('vendor_id')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Remarks<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="remarks" />
                                @error('remarks')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>




                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 m-0 p-0 ">
                            <div class="table-responsive">
                                <table class="table table-hover table-white m-0 p-0">
                                    <thead>
                                        <tr style="font-size:12 px;">
                                            <th class="col-md-1">Item Code</th>
                                            <th class="col-md-2">Item Desc.</th>
                                            <th class="col-md-1">Qunatity</th>
                                            <th class="col-md-1">Unit Rate</th>
                                            <th class="col-md-1">Amt.</th>
                                            <th class="col-md-1">Tax(%)</th>
                                            <th class="col-md-1">Tax Amt</th>
                                            <th class="col-md-1">Sale Rate</th>
                                            <th class="col-md-1">Bonus</th>
                                            <th class="col-md-1">Dis(%)</th>
                                            <th class="col-md-1">Disc. Amt</th>
                                            <th class="col-md-2">Total Amount</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="padding: .1rem .1rem">
                                                <div class="form-group">
                                                    <select class="form-control" wire:model="item_id.0"
                                                        wire:change="itemChanged(0)">
                                                        <option value="-1">Select </option>
                                                        @foreach ($items as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->description }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('item_id')
                                                        <span class="text-danger error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td style="padding: .1rem .1rem">
                                                <input class="form-control" type="text"
                                                    wire:model="item_description.0">
                                                @error('item_description.0')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style="padding: .1rem .1rem">
                                                <input class="form-control" type="text" wire:model="quantity.0"
                                                    wire:change.live="quantityChanged(0)">
                                                @error('quantity.0')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style="padding: .1rem .1rem">
                                                <input class="form-control" type="text" wire:model="unitrate.0"
                                                    wire:change.live="unitrateChanged(0)">
                                                @error('unitrate.0')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style="padding: .1rem ">
                                                <input class="form-control" type="text"
                                                    wire:model="row_unit_into_quantity.0" readonly />

                                            </td>
                                            <td style="padding: .1rem .1rem">

                                                <input class="form-control" type="text" wire:model="igst.0" />

                                                @error('igst.0')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style="padding: .1rem .1rem">
                                                <input class="form-control" type="text" readonly
                                                    wire:model="taxamount.0">
                                                @error('taxamount.0')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            </td>
                                            <td style="padding: .1rem .1rem">
                                                <input class="form-control" type="text"
                                                    wire:model="unitsalerate.0">
                                                @error('unitsalerate.0')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style="padding: .1rem .1rem">
                                                <input class="form-control" type="text" wire:model="bonus.0">
                                                @error('bonus.0')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style="padding: .1rem .1rem">
                                                <input class="form-control" type="text"
                                                    wire:model="discount_percent.0"
                                                    wire:change.live="discountPercentChanged(0)">
                                                @error('discount_percent.0')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style="padding: .1rem .1rem">
                                                <input class="form-control" type="text"
                                                    wire:model="discounted_amount.0" readonly>
                                                @error('discounted_amount.0')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style="padding: .1rem .1rem">
                                                <input class="form-control" type="text" wire:model="row_total.0">
                                                @error('row_total.0')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style="padding: .1rem .1rem"> <a class="text-success font-18"
                                                    wire:click="add({{ $i }})"><i
                                                        class="fa fa-plus"></i></a></td>

                                        </tr>

                                        <div>
                                            @foreach ($inputs as $key => $value)
                                                <tr wire:key="{{ $loop->index }}">
                                                    <td style="padding: .1rem .1rem">
                                                        <div class="form-group">
                                                            <select class="form-control"
                                                                wire:model="item_id.{{ $value }}"
                                                                wire:change="itemChanged({{ $value }})">
                                                                <option value="-1">Select </option>
                                                                @foreach ($items as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->description }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('item_id')
                                                                <span class="text-danger error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                    <td style="padding: .1rem .1rem">
                                                        <input class="form-control" type="text"
                                                            wire:model="item_description.{{ $value }}">
                                                        @error("item_description.{{ $value }}")
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="padding: .1rem .1rem">
                                                        <input class="form-control" type="text"
                                                            wire:model="quantity.{{ $value }}"
                                                            wire:change.live="quantityChanged({{ $value }})">
                                                        @error("quantity.{{ $value }}")
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="padding: .1rem .1rem">
                                                        <input class="form-control" type="text"
                                                            wire:model="unitrate.{{ $value }}"
                                                            wire:change.live="unitrateChanged({{ $value }})">
                                                        @error("unitrate.{{ $value }}")
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="padding: .1rem ">
                                                        <input class="form-control" type="text"
                                                            wire:model="row_unit_into_quantity.{{ $value }}"
                                                            readonly />

                                                    </td>
                                                    <td style="padding: .1rem .1rem">
                                                        <input class="form-control" type="text"
                                                            wire:model="igst.{{ $value }}">

                                                        @error("igst.{{ $value }}")
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="padding: .1rem .1rem">
                                                        <input class="form-control d-inline" type="text" readonly
                                                            wire:model="taxamount.{{ $value }}">
                                                    </td>
                                                    <td style="padding: .1rem .1rem">
                                                        <input class="form-control" type="text"
                                                            wire:model="unitsalerate.{{ $value }}">
                                                        @error("unitsalerate.{{ $value }}")
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="padding: .1rem .1rem">
                                                        <input class="form-control" type="text"
                                                            wire:model="bonus.{{ $value }}">
                                                        @error("bonus.{{ $value }}")
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="padding: .1rem .1rem">
                                                        <input class="form-control" type="text"
                                                            wire:model="discount_percent.{{ $value }}"
                                                            wire:change.live="discountPercentChanged({{ $value }})">
                                                        @error("discount_percent.{{ $value }}")
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="padding: .1rem .1rem">
                                                        <input class="form-control" type="text"
                                                            wire:model="discounted_amount.{{ $value }}">
                                                        @error("discounted_amount.{{ $value }}")
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="padding: .1rem .1rem">
                                                        <input class="form-control" type="text"
                                                            wire:model="row_total.{{ $value }}">
                                                        @error("row_total.{{ $value }}")
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="padding: .1rem .1rem"> <a class="text-danger font-18"
                                                            wire:click="remove({{ $key }},{{ $value }})"><i
                                                                class="fa fa-trash-o"></i></a>
                                                        {{-- <a wire:click="remove({{$key}})">Remove {{$key}}</a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr style="padding:none !important">
                                                <td colspan="11" style="text-align: right; font-weight: bold">
                                                    Sub Total
                                                </td>
                                                <td
                                                    style="text-align: right; font-weight: bold; font-size: 16px;width: 230px">
                                                    {{ $gradSubTotal }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="11" style="text-align: right; font-weight: bold">
                                                    Discount
                                                </td>
                                                <td
                                                    style="text-align: right; font-weight: bold; font-size: 16px;width: 230px">
                                                    {{ $this->grandDiscount }}
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="11" style="text-align: right; font-weight: bold">
                                                    Tax Amount
                                                </td>
                                                <td
                                                    style="text-align: right; font-weight: bold; font-size: 16px;width: 230px">
                                                    {{ $grandTaxAmount }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="11" style="text-align: right; font-weight: bold">
                                                    Total
                                                </td>
                                                <td
                                                    style="text-align: right; font-weight: bold; font-size: 16px;width: 230px">
                                                    {{ $grandTotal }}
                                                </td>
                                            </tr>
                                        </div>


                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-white">
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- List of Indents-->
        <!-- List of Invoices-->
        <div class="row pt-2">
            <div class="col-md-12 text-center">
                <hr />
                <h3>Recent Purchase Order</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Code</th>
                                <th>Stock Point</th>
                                <th>Vendor Id</th>
                                <th>Sub Total</th>
                                <th>Discount</th>
                                <th>Tax Amount</th>
                                <th>Total</th>
                                <th>Status</th>


                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentPurchaseOrders as $purchaseOrder)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $purchaseOrder->code }}</td>
                                    <td>{{ $purchaseOrder->stockpoint->name }}</td>
                                    <td>{{ $purchaseOrder->vendor->name }}</td>
                                    <td>{{ $purchaseOrder->calSubtotal($purchaseOrder->id) }}</td>
                                    <td>{{ $purchaseOrder->calDiscount($purchaseOrder->id) }}</td>
                                    <td>{{ $purchaseOrder->calTaxamount($purchaseOrder->id) }}</td>
                                    <td>{{ $purchaseOrder->calGrandtotal($purchaseOrder->id) }}</td>
                                    <td>{{ $purchaseOrder->status ? 'Approved' : 'Not Approved' }}</td>



                                    <td>
                                        <a style="display:inline;" class="btn btn-xs text-info"
                                            href="{{ route('admin.po.print', ['purchase_order_id' => $purchaseOrder->id]) }}"><i
                                                class="fa fa-print m-r-5"></i> Print PO</a>
                                        {{-- <button style="display:inline;" wire:click="delete({{$indent->id}})"  class="btn btn-xs  text-danger" href="#" data-toggle="modal" data-target="#delete"><i class="fa fa-trash-o m-r-5"></i> Delete</button> --}}
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    {{-- {{  $vendorInvoices->links('pagination::bootstrap-5')}} --}}
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /Page Content -->
</div>
