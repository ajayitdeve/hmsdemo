<div>
	@push('page-css')
<style>
    .form-control{
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
								<h3 class="page-title">Create Purchase Order   </h3>

							</div>
						</div>
					</div>
					<!-- /Page Header -->
					 @if ($errors->any())
					@foreach ($errors->all() as $error)
						<div>{{$error}}</div>
					@endforeach
					@endif


					<div class="row">
						<div class="col-md-12">
							<form wire:submit.prevent="store">
								<div class="row">
                                    <div class="col-sm-6 col-md-3">
										<div class="form-group">
											<label>Indent Code<span class="text-danger">*</span></label>
											<input type="text" class="form-control" wire:model="code"  readonly/>
											@error("code") <span class="text-danger error">{{ $message }}</span>@enderror
										</div>
									</div>
									<div class="col-sm-6 col-md-3">
										<div class="form-group">
										<label>Stock Point <span class="text-danger">*</span></label>
										<select class="form-control" wire:model="stock_point_id"  required>
											<option value="">Select </option>
											@foreach ($stockpoints as $stockpoint)
												<option value="{{$stockpoint->id}}">{{$stockpoint->name}}</option>
											@endforeach
										</select>
										@error("stock_point_id") <span class="text-danger error">{{ $message }}</span>@enderror
										</div>
									</div>
                                    <div class="col-sm-6 col-md-3">
										<div class="form-group">
										<label>Purchase Term <span class="text-danger">*</span></label>
										<select class="form-control" wire:model="purchase_term_id"  required>
											<option value="">Select </option>
											@foreach ($purchaseterms as $purchaseterm)
												<option value="{{$purchaseterm->id}}">{{$purchaseterm->code}}</option>
											@endforeach
										</select>
										@error("purchase_term_id") <span class="text-danger error">{{ $message }}</span>@enderror
										</div>
									</div>
									<div class="col-sm-6 col-md-3">
										<div class="form-group">
											<label>Vendor {{$vendor_id}} <span class="text-danger">*</span></label>
											<select class="form-control" wire:model="vendor_id" required >
												<option value="">Select Vendor</option>
												@foreach ($vendors as $vendor)
													<option value="{{$vendor->id}}">{{$vendor->name}}</option>
												@endforeach

											</select>
											@error("vendor_id") <span class="text-danger error">{{ $message }}</span>@enderror
										</div>
									</div>


									<div class="col-sm-6 col-md-3">
										<div class="form-group">
											<label>Remarks<span class="text-danger">*</span></label>
											<input type="text" class="form-control" wire:model="remarks" required />
											@error("remarks") <span class="text-danger error">{{ $message }}</span>@enderror
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

													</tr>
												</thead>
												<tbody>



												@foreach($inputs as $key => $value)
												<tr wire:key="{{ $loop->index }}">
													<td style="padding: .1rem .1rem">
                                                        <div class="form-group">
                                                            <input class="form-control" type="text"  wire:model="item_id.{{$loop->index}}" wire:change="itemChanged({{$loop->index}})" readonly>
															 @error("item_id") <span class="text-danger error">{{ $message }}</span>@enderror
                                                        </div>
													</td>
        											<td style="padding: .1rem .1rem">
														<input class="form-control" type="text"  wire:model="item_description.{{$loop->index}}" readonly>
														@error("item_description.{{$loop->index}}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
													<td style="padding: .1rem .1rem">
														<input class="form-control" type="text"  wire:model="quantity.{{$loop->index}}" wire:change.live="quantityChanged({{$loop->index}})" readonly>
														@error("quantity.{{$loop->index}}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
                                                    <td style="padding: .1rem .1rem">
														<input class="form-control" type="text"  wire:model="unitrate.{{$loop->index}}" wire:change.live="unitrateChanged({{$loop->index}})">
														@error("unitrate.{{$loop->index}}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
													<td style="padding: .1rem ">
														<input class="form-control" type="text"  wire:model="row_unit_into_quantity.{{$loop->index}}" readonly />

													</td>
													<td style="padding: .1rem .1rem">
														<input class="form-control" type="text"  wire:model="igst.{{$loop->index}}" >

														@error("igst.{{$loop->index}}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
													<td style="padding: .1rem .1rem">
														<input class="form-control d-inline"  type="text" readonly wire:model="taxamount.{{$loop->index}}" >
													</td>
													<td style="padding: .1rem .1rem">
														<input class="form-control" type="text"  wire:model="unitsalerate.{{$loop->index}}" >
														@error("unitsalerate.{{$loop->index}}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
													<td style="padding: .1rem .1rem">
														<input class="form-control" type="text"  wire:model="bonus.{{$loop->index}}" >
														@error("bonus.{{$loop->index}}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
													<td style="padding: .1rem .1rem">
														<input class="form-control" type="text"  wire:model="discount_percent.{{$loop->index}}" wire:change.live="discountPercentChanged({{$loop->index}})">
														@error("discount_percent.{{$loop->index}}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
													<td style="padding: .1rem .1rem">
														<input class="form-control" type="text"  wire:model="discounted_amount.{{$loop->index}}" >
														@error("discounted_amount.{{$loop->index}}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
													<td style="padding: .1rem .1rem">
														<input class="form-control" type="text"  wire:model="row_total.{{$loop->index}}" >
														@error("row_total.{{$loop->index}}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>

												</tr>
												@endforeach
                                                <tr style="padding:none !important">
                                                    <td colspan="11" style="text-align: right; font-weight: bold">
                                                        Sub Total
                                                    </td>
                                                    <td style="text-align: right; font-weight: bold; font-size: 16px;width: 230px">
                                                       {{-- {{$gradSubTotal}} --}}
                                                    </td>
                                                </tr>
												<tr>
                                                    <td colspan="11" style="text-align: right; font-weight: bold">
                                                       Discount
                                                    </td>
                                                    <td style="text-align: right; font-weight: bold; font-size: 16px;width: 230px">
                                                        {{$this->grandDiscount}}
                                                    </td>

                                                </tr>
												<tr>
                                                    <td colspan="11" style="text-align: right; font-weight: bold">
                                                        Tax Amount
                                                    </td>
                                                    <td style="text-align: right; font-weight: bold; font-size: 16px;width: 230px">
                                                        {{$grandTaxAmount}}
                                                    </td>
                                                </tr>
												<tr>
                                                    <td colspan="11" style="text-align: right; font-weight: bold">
                                                        Total
                                                    </td>
                                                    <td style="text-align: right; font-weight: bold; font-size: 16px;width: 230px">
														{{$grandTotal}}
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
								<hr/>
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
                            <td>{{$loop->index +1}}</td>
							<td>{{$purchaseOrder->code}}</td>
                            <td>{{$purchaseOrder->stockpoint->name}}</td>
							<td>{{$purchaseOrder->vendor?$purchaseOrder->vendor->name:null}}</td>
							<td>{{$purchaseOrder->calSubtotal($purchaseOrder->id)}}</td>
							<td>{{$purchaseOrder->calDiscount($purchaseOrder->id)}}</td>
							<td>{{$purchaseOrder->calTaxamount($purchaseOrder->id)}}</td>
							<td>{{$purchaseOrder->calGrandtotal($purchaseOrder->id)}}</td>
							<td>{{$purchaseOrder->status ? 'Approved' : 'Not Approved'}}</td>



                            <td>
                                <a style="display:inline;" class="btn btn-xs text-info" href="{{route('admin.po.print',['purchase_order_id'=>$purchaseOrder->id])}}"><i class="fa fa-print m-r-5"></i> Print PO</a>
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
