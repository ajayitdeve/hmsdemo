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
        <form wire:submit.prevent='save'>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h2>Scrap Transfer</h2>
                        </div>

                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Stock Point From</label>
                                <input type="text" class="form-control" readonly value="{{ $stockPoint?->name }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Stock Point To</label>
                                <select class="form-control" wire:model="stock_point_to_id">
                                    @foreach ($stockPoints as $stockPoint)
                                        <option value="{{ $stockPoint?->id }}">{{ $stockPoint?->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Date</label>

                                <input type="date" class="form-control" wire:model="scrap_transfer_date" />
                            </div>

                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Remarks</label>
                                <input type="text" class="form-control" wire:model="scrap_remarks" required />
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
                                        <th>Unit Purchase Price</th>
                                        <th>Unit Sale Price</th>
                                        <th>Scrap Purchase Value</th>
                                        <th>Scrap sale Value</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($arrCart as $item)
                                        <tr>
                                            <td>{{ $item['id'] }}</td>
                                            <td>{{ $item['item_code'] }}</td>
                                            <td>{{ $item['batch_no'] }}</td>
                                            <td>{{ $item['quantity'] }}</td>
                                            <td>{{ $item['unit_sale_price'] }}</td>
                                            <td>{{ $item['unit_sale_price'] }}</td>
                                            <td>{{ $item['quantity'] * $item['unit_purchase_price'] }}</td>
                                            <td>{{ $item['quantity'] * $item['unit_sale_price'] }}</td>
                                            <td>
                                                <button type="button" class="btn-primary"
                                                    wire:click="editCart({{ $item['id'] }})"><i
                                                        class="fa fa-trash"></i></button>

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
                                        <td> {{ $sumPurchaseRate }}</td>
                                        <td>{{ $sumSaleRate }}</td>
                                        <td> </td>
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
                                    <label class="col-md-4">Batch No<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        @if ($batch_nos != null)
                                            <select wire:model.lazy='batch_no' class="form-control"
                                                wire:change="batchNoChanged({{ $batch_no }})">
                                                <option value="">Select Batch No</option>
                                                @foreach ($batch_nos as $key => $item)
                                                    <option value="{{ $item['batch_no'] }}">{{ $item['batch_no'] }} (
                                                        {{ $item['quantity'] }})
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
                                        <input type="number" class="form-control" wire:model='quantity'
                                            wire:change="quantityChanged" />
                                        @error('quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row pt-2">
                            <div class="col-md-2">
                                <div class="row">
                                    <label class="col-md-6">Sale Rate<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" wire:model='unit_sale_price'
                                            readonly />

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="row">
                                    <label class="col-md-6">Pur. Rate<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" wire:model='unit_purchase_price'
                                            readonly />

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
                                        <input type="text" class="form-control" readony wire:model='exd'
                                            readonly />

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="row pt-2">
                                    <label class="col-md-6">Dis.(%)<span class="text-danger">*</span></label>
                                    <div class="col-md-6 pl-0 pr-0">
                                        <input type="number" maxlength="99" class="form-control"
                                            wire:model='discount' wire:change="discountChanged" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="row pt-2">
                                    <label class="col-md-6">Dis. Amt.<span class="text-danger">*</span></label>
                                    <div class="col-md-6 pl-0 pr-0">
                                        <input type="number" class="form-control" wire:model='discountAmount'
                                            wire:change="discountAmountChanged" readonly />
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Scrape Type</label>
                                    <select class="form-control" wire:model="scrap_type_id">
                                        @foreach ($scrapTypes as $scrapType)
                                            <option value="{{ $scrapType->id }}">{{ $scrapType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="">Remarks</label>
                                    <input type="text" class="form-control" wire:model="remarks" />
                                </div>

                            </div>
                            <div class="col-md-2 text-center">
                                <br />
                                <button type="button" class="btn btn-primary btn-sm d-block "
                                    wire:click="addToCart">Add</button>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>

                    </div>
                </div>



        </form>







    </div>
