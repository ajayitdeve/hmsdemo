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
    <div>
        <form wire:submit.prevent='pharmacyReturn'>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9">
                        <h2>Pharmacy Return</h2>
                    </div>

                </div>
            </div>


            <div class="card-body">

                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="form-group">
                                <label for="">Bill No</label>
                                <input type="text" class="form-control" wire:model="bill_no"
                                    wire:change="billNoChanged" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Patient's Name</label>
                                            <input type="text" class="form-control" readonly wire:model="name">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Doctor's Name</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="doctor_name">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Department</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="doctor_department">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Unit</label>
                                            <input type="text" class="form-control" readonly
                                                wire:model="doctor_unit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="table-responsive">
                   <table class="table table-striped custom-table mb-0">
                        <thead>
                            <tr>


                               <th>Id</th>
                                <th>Item Id</th>
                                <th>Batch No</th>
                                <th>Qunatity</th>
                                <th>Unit Sale Price</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Taxable Amount</th>
                                <th>Total</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($opdMedicineTransacrions as $opdMedicineTransacrion)
                                 <tr>
                                    <td>{{$opdMedicineTransacrion->id}}</td>
                                    <td>{{$opdMedicineTransacrion->item->description}}</td>
                                    <td>{{$opdMedicineTransacrion->batch_no}}</td>
                                    <td>{{$opdMedicineTransacrion->quantity}}</td>
                                    <td>{{$opdMedicineTransacrion->unit_sale_price}}</td>
                                    <td>{{$opdMedicineTransacrion->amount}}</td>
                                    <td>{{$opdMedicineTransacrion->discount}}</td>
                                    <td>{{$opdMedicineTransacrion->taxable_amount}}</td>
                                    <td>{{$opdMedicineTransacrion->total}}</td>


                                 </tr>
                                 @endforeach
                                 <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>{{ $opdPatientReceipt!=null?$opdPatientReceipt->opdmedicinetransactions->sum('total'):null}}</strong></td>


                                </tr>
                        </tbody>
                    </table>
                    <div>

                    </div>
                </div>
            </div>



        </div>
     <div class="row mb-5">
        <div class="col-md-12">
            <div class="table-responsive">
               <table class="table table-striped custom-table mb-0">
                    <thead>
                        <tr>


                           <th>Id</th>
                            <th>Item Id</th>
                            <th>Batch No</th>
                            <th>Qunatity</th>
                            <th>Unit Sale Price</th>
                            <th>Amount</th>
                            <th>Discount</th>
                            <th>Taxable Amount</th>
                            <th>Total</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                           <?php $grandTotal=0.0 ; ?>
                        @foreach ($arrCart as $item)
                             <tr>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['item_id']}}</td>
                                <td>{{$item['batch_no']}}</td>
                                <td>{{$item['quantity']}}</td>
                                <td>{{$item['unit_sale_price']}}</td>
                                <td>{{$item['amount']}}</td>
                                <td>{{$item['discount']}}</td>
                                <td>{{$item['taxable_amount']}}</td>
                                <td>{{$item['total']}}</td>
                                <td>
                                    <button type="button" class="btn-primary" wire:click="editCart({{$item['id']}})"><i class="fa fa-trash"></i></button>

                                </td>

                             </tr>
                             @endforeach
                             <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{ $payableAmount}}</td>
                                <td></td>

                            </tr>
                    </tbody>
                </table>
                <div>

                </div>
            </div>
        </div>
    </div>


        <div class="card">
            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                    <div class="row">
                        <div class="col-md-4">
                            <div class="row ">
                                <label class="col-md-4">Item<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select wire:model='item_id' class="form-control" wire:change="itemChanged">
                                        <option value="-1">Select </option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['description'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('item_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row ">
                                <label class="col-md-4">Batch No<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    @if($batch_nos!=null)
                                    <select wire:model.lazy='batch_no' class="form-control" wire:change="batchNoChanged({{$batch_no}})">
                                        <option value="">Select Batch No</option>
                                        @foreach ($batch_nos as $key=>$item)
                                            <option value="{{ $item['batch_no'] }}">{{ $item['batch_no'] }}  ( {{$item['quantity']}})
                                            </option>
                                        @endforeach
                                        @error('batch_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </select>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-md-4">Quantity<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" wire:model='quantity' wire:change="quantityChanged" />
                                    @error('quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row pt-2">
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-md-4">Sale Price<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" wire:model='unit_sale_price' />

                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row pt-2">
                                <label class="col-md-4">Amount<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" wire:model='amount' />


                                </div>


                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-md-4">Expiry Date<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" readony wire:model='exd' readonly  />

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="row pt-2">
                                <label class="col-md-6">Dis.(%)<span class="text-danger">*</span></label>
                                <div class="col-md-6 pl-0 pr-0">
                                    <input type="number" maxlength="99" class="form-control" wire:model='discount' wire:change="discountChanged"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="row pt-2">
                                <label class="col-md-6">Dis. Amt.<span class="text-danger">*</span></label>
                                <div class="col-md-6 pl-0 pr-0">
                                    <input type="number" class="form-control" wire:model='discountAmount' wire:change="discountAmountChanged"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row pt-2">
                                <label class="col-md-4">Taxable Amount<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" wire:model='taxable_amount' />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="row pt-2">
                                    <label class="col-md-4">CGST<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" wire:model="cgst" />
                                    </div>
                                </div>
                            </div>
                    </div>
                    @if($discount!=0 || $discountAmount!=0)
                  <div class="row p-2 m-2 bg-info">
                    <div class="col-md-12">
                        <label class="col-md-4">Discount Approved By <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <select wire:model='discount_approved_by_id' class="form-control">
                                {{-- <option value="-1">Select </option> --}}
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                  </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">

                                <div class="row pt-2">
                                    <label class="col-md-4">SGST<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" wire:model="sgst" />
                                    </div>
                                </div>

                        </div>
                        <div class="col-md-4">

                                <div class="row pt-2">
                                    <label class="col-md-4">Total<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" wire:model='total' />
                                    </div>
                                </div>

                        </div>
                        <div class="col-md-1 text-center">
                            <button type="button" class="btn btn-primary btn-sm d-block "  wire:click="addToCart">Add</button>

                        </div>
                        {{-- <div class="col-md-1 text-center">

                            <button type="submit"  class="btn btn-primary btn-sm d-block"  >Submit</button>
                        </div> --}}
                    </div>
                    {{-- Payment Section --}}
                    <div class="row mt-2 border-top border-primary">
                        @if(isset($pharmacyDue))
                        @if($pharmacyDue->where('is_due_cleared',0)->count())
                        <div class="col-md-3">
                            <div class="row pt-2">
                                <label class="col-md-6">Dues<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" readonly value="{{$pharmacyDue->where('is_due_cleared',0)->sum('due_amount')}}" />
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                        <div class="col-md-3">
                            <div class="row pt-2">
                                <label class="col-md-6">Payable Amount<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" wire:model="payableAmount" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row pt-2">
                                <label class="col-md-6">Paying Amount<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" wire:model="payingAmount" wire:change='payingAmountChanged' />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row pt-2">
                                <label class="col-md-6">Due Amount<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" wire:model="dueAmount" />
                                </div>
                            </div>
                        </div>

                    </div>
                    @if($dueAmount!=0)
                        <div class="row p-2 m-2 bg-info">
                          <div class="col-md-12">
                              <label class="col-md-4">Due Approved By <span class="text-danger">*</span></label>
                              <div class="col-md-8">
                                  <select wire:model='due_approved_by_id' class="form-control">
                                      {{-- <option value="-1">Select </option> --}}
                                      @foreach ($users as $user)
                                          <option value="{{ $user->id }}">{{ $user->name }}
                                          </option>
                                      @endforeach
                                  </select>

                              </div>
                          </div>
                        </div>
                          @endif
                          <div class="row mt-2 border-top border-primary">
                            <div class="col-md-4">
                                <div class="row mt-2">

                                        <label class="col-md-6">Cash  Amount Received  <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" wire:model="cashAmount" wire:change="cashAmountChanged" />
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row mt-2">

                                        <label class="col-md-6">Balance to return   <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" wire:model="balanceAgainstCash" />
                                        </div>
                                </div>
                            </div>
                        </div>
                          <div class="row">
                            <div class="col-md-12 text-center">

                                <button type="submit" class="btn btn-primary"> Return Medicine</button>
                            </div>
                          </div>

            </div>
        </div>



        </form>







</div>
