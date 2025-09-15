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
    <div>
    <div class="card">
        <div class="card-header">
            <h2>Good Issue Notes</h2>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-3"> MRQ Code : {{ $gin->code }}</div>
                <div class="col-md-3">Dept: {{ $gin->stock_point_id }}</div>
                <div class="col-md-3">Status: @if($gin->status==0) Not Approved @else Approved @endif</div>
                <div class="col-md-3">Date: {{ $gin->created_at }}</div>
                <div class="col-md-3">Remarks: {{ $gin->remarks }}</div>
            </div>


        </div>

    </div>
    <div class="card">
        <div class="card-header">
            <h4>MRQ Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0">
                         <thead>
                             <tr>
                                <th>MRQ Code</th>
                                <th>Item Code</th>
                                <th>Item Description</th>
                                <th>Requested Quantity</th>
                                <th>Approved Quantity</th>
                                </tr>
                         </thead>
                         <tbody>
                                  @foreach($gin->mrq->mrqitems as $mrqitem)
                                  <tr>
                                     <td>{{$mrqitem->mrq->code}}</td>
                                     <td>{{$mrqitem->item->code}}</td>
                                     <td>{{$mrqitem->item->description}}</td>
                                     <td>{{$mrqitem->quantity}}</td>
                                     <td class="text-success">{{$mrqitem->approved_quantity}}</td>

                                  </tr>
                                  @endforeach
                         </tbody>
                     </table>
                     <div>

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
                           <th>Item Code</th>
                            <th>Batch No</th>
                            <th>Manufacturing Date</th>
                            <th>Expiry Date</th>
                            <th>Quantity</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                             @foreach($gin->ginitems as $ginitem)
                             <tr>
                                <td>{{$ginitem->gin->code}}</td>
                                <td>{{$ginitem->batch_no}}</td>
                                <td>{{$ginitem->mfd}}</td>
                                <td>{{$ginitem->exd}}</td>
                                <td>{{$ginitem->quantity}}</td>
                                <td></td>
                             </tr>
                             @endforeach
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
             @if (session()->has('error'))
             <div class="alert alert-danger">
                {{ session('error') }}
            </div>
             @endif


            <form wire:submit.prevent='save'>
                <div class="row">
                    <div class="col-md-4">
                        <div class="row ">
                            <label class="col-md-3">Item<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select wire:model='item_id' class="form-control" wire:change="itemChanged" >
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
                        <div class="row ">
                            <label class="col-md-4">Batch No {{$batch_no}}<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select wire:model='batch_no' class="form-control" wire:change="batchnoChanged"  >
                                    <option value="-1">Select </option>
                                    @foreach ($batchnumbers as $batchnumber)
                                        <option value="{{ $batchnumber }}">{{ $batchnumber }}
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
                        <div class="row">
                            <label class="col-md-6">Quantity Issued<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" wire:model='quantity' wire:change='quantityChanged'/>

                                @if($quantityOverflow)
                                <span class="text-danger">Quantity should be <= {{$batchStock}}</span>
                                @endif
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
                            <label class="col-md-5">Item Stock<span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="itemstock" readonly class="form-control" wire:model='itemstock' />
                                @error('itemstock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <label class="col-md-4">Batch Stock <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="number" readonly class="form-control" wire:model='batchStock' />
                                @error('batchStock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row pt-2">
                            <label class="col-md-6">Manufacturing Date<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="text" readonly class="form-control" wire:model='mfd' />
                                @error('mfd')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>


                        </div>
                    </div>
                </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <label class="col-md-5">Expiry Date<span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" wire:model='exd' />
                                        @error('exd')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>


                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="submit" class="btn btn-primary btn-sm " value="Add" />
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center" >
                                <a target="_blank" href="{{route('admin.gin.print',$gin->id)}}" class="btn btn-info">Print GIN</a>
                            </div>
                        </div>


                </div>


            </form>


        </div>
        </div>


    </div>
