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
								<h3 class="page-title">Create Invoice</h3>
								
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					{{-- @if ($errors->any())
					@foreach ($errors->all() as $error)
						<div>{{$error}}</div>
					@endforeach
					@endif  --}}
					
			
					<div class="row">
						<div class="col-md-12">
							<form wire:submit.prevent="store">
								<div class="row">
									<div class="col-sm-6 col-md-4">
										<div class="form-group">
										<label>Company <span class="text-danger">*</span></label>
										<select class="form-control" wire:model="company_id" wire:change="companyChanged">
											<option value="">Select </option>
											@foreach ($companies as $company)
												<option value="{{$company->id}}">{{$company->name}}</option>
											@endforeach
										</select>
										@error("company_id") <span class="text-danger error">{{ $message }}</span>@enderror
										</div>
									</div>
									<div class="col-sm-6 col-md-4">
										<div class="form-group">
											<label>Client <span class="text-danger">*</span></label>
											<select class="form-control" wire:model="client_id" wire:change="clientChanged">>
												<option value="">Select </option>
												@foreach ($clients as $client)
													<option value="{{$client->id}}">{{$client->name}}</option>
												@endforeach
												
											</select>
											@error("client_id") <span class="text-danger error">{{ $message }}</span>@enderror
										</div>
									</div>

									<div class="col-sm-6 col-md-4">
										<div class="form-group">
											<label>To<span class="text-danger">*</span></label>
											<input type="text" class="form-control" wire:model="to" />
											@error("to") <span class="text-danger error">{{ $message }}</span>@enderror
										</div>
									</div>
									<div class="col-sm-6 col-md-4">
										<div class="form-group">
											<label>ClientAddress<span class="text-danger">*</span></label>
											<input type="text" class="form-control" wire:model="clientaddress" />
											@error("client_address") <span class="text-danger error">{{ $message }}</span>@enderror
										</div>
									</div>
									<div class="col-sm-6 col-md-4">
										<div class="form-group">
											<label>Contact Name<span class="text-danger">*</span></label>
											<input type="text" class="form-control" wire:model="contactname" />
											@error("contactname") <span class="text-danger error">{{ $message }}</span>@enderror
										</div>
									</div>
									<div class="col-sm-6 col-md-4">
										<div class="form-group">
											<label>Description</label>
											<input type="text" class="form-control" wire:model="description" />
											@error("description") <span class="text-danger error">{{ $message }}</span>@enderror
											
										</div>
									</div>
									
									
									
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12 m-0 p-0 ">
										<div class="table-responsive">
											<table class="table table-hover table-white m-0 p-0">
												<thead>
													<tr>
														<th class="col-md-2">Employee</th>
														<th class="col-md-2">HSN</th>
														<th class="col-md-2">Description</th>
														<th class="col-md-2">Daily Rate</th>
														<th class="col-md-1">Day</th>
														<th class="col-md-1">Base Amount</th>
														<th class="col-md-1">Tax Amount</th>
														<th class="col-md-2">Net Amount</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
												<tr>
													
													
													<td style="padding: .5rem .3rem">
                                                        <div class="form-group">
															
                                                            <select class="form-control" wire:model="employee_id.0" wire:change="employeeChanged(0)">
                                                                <option value="">Select </option>
                                                                @foreach ($employees as $employee)
                                                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error("employee_id") <span class="text-danger error">{{ $message }}</span>@enderror
                                                        </div>
													</td>
													<td style="padding: .5rem .3rem">
                                                        <div class="form-group">
															
                                                            <select class="form-control" wire:model="hsn_id.0">
                                                                <option value="">Select </option>
                                                                @foreach ($hsns as  $hsn)
                                                                    <option value="{{$hsn->id}}">{{$hsn->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error("hsn_id") <span class="text-danger error">{{ $message }}</span>@enderror
                                                        </div>
													</td>
													<td style="padding: .5rem .3rem">
														<input class="form-control" type="text"  wire:model="desc.0" >
														@error("desc.0") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
													<td style="padding: .5rem .3rem">
														<input class="form-control" type="number"  wire:model="unit_price.0" wire:input="quantityIntoRate(0)">
														@error("unit_price.0") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
													<td style="padding: .5rem .3rem">
														<input class="form-control" type="text"  wire:model="quantity.0" wire:input="quantityIntoRate(0)">
														@error("quantity.0") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
                                                    <td style="padding: .5rem .3rem">
														<input class="form-control" type="number" readonly wire:model="base_amount.0">
													</td>
                                                    <td style="padding: .5rem .3rem">
														<input class="form-control"  type="number" readonly wire:model="tax_amount.0"> 
													</td>
													
                                                    <td style="padding: .5rem .3rem">
														<input class="form-control" type="number" readonly  wire:model="total_amount.0" wire:change.live="calculateTotal">
													</td>
													<td style="padding: .5rem .3rem">  <a class="text-success font-18" wire:click="add({{$i}})"><i class="fa fa-plus"></i></a></td>
													
												</tr>
												
												<div>
												@foreach($inputs as $key => $value)
												<tr wire:key="{{ $loop->index }}">
													
													<td style="padding: .5rem .3rem">
                                                        <div class="form-group">
															
                                                            <select class="form-control" wire:model="employee_id.{{$value}}" wire:change="employeeChanged({{$value}})">
                                                                <option value="">Select </option>
                                                                @foreach ($employees as $employee)
                                                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error("employee_id") <span class="text-danger error">{{ $message }}</span>@enderror
                                                        </div>
													</td>
													<td style="padding: .5rem .3rem">
                                                        <div class="form-group">
															
                                                            <select class="form-control" wire:model="hsn_id.{{$value}}" >
                                                                <option value="">Select </option>
                                                                @foreach ($hsns as $hsn)
                                                                    <option value="{{$hsn->id}}">{{$hsn->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error("hsn_id") <span class="text-danger error">{{ $message }}</span>@enderror
                                                        </div>
													</td>
													<td style="padding: .5rem .3rem">
														<input class="form-control" type="text"  wire:model="desc.{{$value}}" >
														@error("desc.{{$value}}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
                                                    <td style="padding: .5rem .3rem">
														
														<input class="form-control" type="number"  wire:model="unit_price.{{$value}}" wire:input="quantityIntoRate({{$value}})">
														@error("unit_price.{{$value}}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
													<td style="padding: .5rem .3rem">
														<input class="form-control" type="text"  wire:model="quantity.{{$value}}" wire:input="quantityIntoRate({{$value}})">
														@error("quantity.{{$value}}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
                                                    <td style="padding: .5rem .3rem">
														<input class="form-control" type="text" readonly  wire:model="base_amount.{{ $value }}">
                                                        @error("base_amount.{$value}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
                                                    <td style="padding: .5rem .3rem">
														<input class="form-control"  type="text" readonly  wire:model="tax_amount.{{ $value }}"> 
                                                        @error("tax_amount.{$value}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
                                                    
													<td style="padding: .5rem .3rem">
														<input class="form-control" type="text" readonly  wire:model="total_amount.{{ $value }}" wire:change.live="calculateTotal">
                                                        @error("total_amount.{$value}") <span class="text-danger error">{{ $message }}</span>@enderror
													</td>
													
													
													
													
													
													

												
													<td style="padding: .5rem .3rem"> <a class="text-danger font-18" wire:click="remove({{$key}},{{$value}})"><i class="fa fa-trash-o"></i></a>
                                                        {{-- <a wire:click="remove({{$key}})">Remove {{$key}}</a> --}}
                                                    </td>
												</tr>
												@endforeach
												</div>


												</tbody>
											</table>
										</div>
										<div class="table-responsive">
											<table class="table table-hover table-white">
												<tbody>
													<tr>
														
														<td></td>
														<td></td>
														<td></td>
														<td class="text-right">Total</td>
														<td style="text-align: right; width: 230px">{{$total}}</td>
													</tr>
													<tr>
														<td colspan="4" style="text-align: right">Tax</td>
														<td style="text-align: right;width: 230px">
															<input class="form-control text-right"  readonly type="text" wire:model="totalTax">
														</td>
													</tr>
													{{-- <tr>
														<td colspan="5" style="text-align: right">
															Discount %
														</td>
														<td style="text-align: right; width: 230px">
															<input class="form-control text-right" value="0" type="text">
														</td>
													</tr> --}}
													<tr>
														<td colspan="4" style="text-align: right; font-weight: bold">
															Grand Total
														</td>
														<td style="text-align: right; font-weight: bold; font-size: 16px;width: 230px">
															{{$grandTotal}}
														</td>
													</tr>
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
					<!-- List of Invoices-->
					<div class="row pt-2">
						<div class="col-md-12 text-center">
							<hr/>
							<h3>All Invoices</h3>
						</div>
					</div>
					
                </div>
				</div>
				<!-- /Page Content -->
</div>
