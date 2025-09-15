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
<div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <h2>Add GRN Items</h2>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h3>Existing GRN Items</h3>
                    <div class="table-responsive">
                       <table class="table table-striped custom-table mb-0">
                            <thead>
                                <tr>
                                   <th>Code</th>
                                    <th>Item</th>
                                    <th>Batch No</th>
                                    <th>Mfd.</th>
                                    <th>Exp.</th>
                                    <th>Quantity</th>
                                    <th>Bonus</th>
                                    <th>MRP</th>
                                    <th>Discount</th>
                                    <th>Tax</th>
                                    <th>HSN Code</th>
                                    {{-- <th class="text-right">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventories as $inventory)
                                <tr>
                                    <td>{{$inventory->grn->code}}</td>
                                    <td>{{$inventory->item->description}}</td>
                                    <td>{{$inventory->batch_no}}</td>
                                    <td>{{$inventory->mfd}}</td>
                                    <td>{{$inventory->exd}}</td>
                                    <td>{{$inventory->quantity}}</td>
                                    <td>{{$inventory->bonus}}</td>
                                    <td>{{$inventory->mrp}}</td>
                                    <td>{{$inventory->discount}}</td>
                                    <td>{{$inventory->tax}}</td>
                                    <td>{{$inventory->hsncode}}</td>

                                    {{-- <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button wire:click="edit({{$grn->id}})"  class="dropdown-item" href="#" data-toggle="modal" data-target="#edit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                                                <a class="dropdown-item" href="{{route('admin.grn.add-grn-items',$grn->id)}}" ><i class="fa fa-plus"></i> View</a>
                                            </div>
                                        </div>
                                    </td> --}}
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <div>
                            {{-- {{ $grns->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
           <table class="table table-striped custom-table mb-0">
                <thead>
                    <tr>
                       <th>Code</th>
                        <th>Item</th>
                        <th>Batch No</th>
                        <th>Mfd.</th>
                        <th>Exp.</th>
                        <th>Quantity</th>
                        <th>Bonus</th>
                        <th>MRP</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th>HSN Code</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($arrCart as $cart)
                    <tr>
                        <td>{{$cart['grn_code']}}</td>
                        <td>{{$cart['item_description']}}</td>
                        <td>{{$cart['batch_no']}}</td>
                        <td>{{$cart['mfd']}}</td>
                        <td>{{$cart['exd']}}</td>
                        <td>{{$cart['quantity']}}</td>
                        <td>{{$cart['bonus']}}</td>
                        <td>{{$cart['mrp']}}</td>
                        <td>{{$cart['discount']}}</td>
                        <td>{{$cart['tax']}}</td>
                        <td>{{$cart['hsncode']}}</td>

                        <td> <button type="button" class="btn-primary"
                            wire:click="editCart({{ $cart['id'] }})"><i
                                class="fa fa-trash"></i></button></td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
            <div>
                {{-- {{ $grns->links() }} --}}
            </div>
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


        <form wire:submit.prevent='save'>
            <div class="row">
                <div class="col-md-4">
                    <div class="row ">
                        <label class="col-md-3">Item<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <select wire:model='item_id' class="form-control" wire:change="itemChanged">
                                <option value="-1">Select </option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->description }}
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
                    <div class="row pb-3">
                        <label class="col-md-3">Batch No <span class="text-danger">*</span></label>
                       <div class="col-md-9">
                        <input type="text" class="form-control" wire:model='batch_no' />
                        @error('batch_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                       </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row pb-3">
                        <label class="col-md-5">Manufacturing Date <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input type="date" class="form-control" wire:model='mfd' />
                        @error('mfd')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pb-3">
                <div class="col-md-4">
                    <div class="row">
                        <label class="col-md-3">Expiry Date <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" wire:model='exd' />
                            @error('exd')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <label class="col-md-3">Quantity<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" wire:model='quantity' wire:change="quantityChanged"/>
                            <span class="text-danger">{{$this->quantityError}}</span>
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <label class="col-md-3">Purchase Rate <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" wire:model='purchase_rate' class="form-control" >

                            @error('purchase_rate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="row pb-3">
                        <label class="col-md-3">Bonus<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" wire:model='bonus' class="form-control" >

                        @error('bonus')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row pb-3">
                        <label class="col-md-3">MRP<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" wire:model='mrp' class="form-control" >

                        @error('mrp')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row pb-3">
                        <label class="col-md-3">Discount<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" wire:model='discount' class="form-control" >

                        @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>

                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <label class="col-md-3">Tax <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" wire:model='tax' class="form-control" >

                            @error('tax')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <label class="col-md-3">HSN Code <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" wire:model='hsncode' class="form-control" >

                            @error('hsncode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary btn-sm d-block "
                    wire:click="addToCart">Add</button>
                </div>
            </div>
<div class="row m-2">
    <div class="col-md-12 text-center">
        <hr>
        <input type="submit" class="btn btn-primary " value="Submit" />
    </div>
</div>
        </form>
        {{-- <div class="row">
            <div class="col-md-12 text-center">
                <hr/>
                <a class="btn btn-success" href="">Print GRN</a>
            </div>
        </div> --}}
    </div>
    </div>


</div>

