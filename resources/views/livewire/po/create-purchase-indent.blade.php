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
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Create Purchase Indent </h3>
                    {{-- <ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="">Dashboard</a></li>
									<li class="breadcrumb-item active">Purchase Indent</li>
								</ul> --}}
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.po.list-purchase-indent') }}" class="btn add-btn"><i class="fa fa-list"></i>
                        All Purchase Indents</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

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
                                <label>Type <span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="type_id">
                                    <option value="">Select </option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Vendor <span class="text-danger">*</span></label>
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
                                <label>Request Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" wire:model="request_date" />
                                @error('request_date')
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
                                        <tr>
                                            <th class="col-md-2">Item Description</th>
                                            <th class="col-md-4">Item Code</th>
                                            <th class="col-md-2">Qunatity</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>


                                            <td style="padding: .5rem .3rem">
                                                <div class="form-group">
                                                    <select class="form-control" wire:model="item_id.0"
                                                        wire:change="itemChanged(0)">
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
                                            <td style="padding: .5rem .3rem">
                                                <input class="form-control" type="text"
                                                    wire:model="item_description.0">
                                                @error('item_description.0')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style="padding: .5rem .3rem">
                                                <input class="form-control" type="text" wire:model="quantity.0"
                                                    wire:change.live="calculateTotal">
                                                @error('quantity.0')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </td>

                                            <td style="padding: .5rem .3rem"> <a class="text-success font-18"
                                                    wire:click="add({{ $i }})"><i
                                                        class="fa fa-plus"></i></a></td>

                                        </tr>

                                        <div>
                                            @foreach ($inputs as $key => $value)
                                                <tr wire:key="{{ $loop->index }}">

                                                    <td style="padding: .5rem .3rem">
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
                                                            @error("item_id{{ $value }}")
                                                                <span class="text-danger error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </td>

                                                    <td style="padding: .5rem .3rem">

                                                        <input class="form-control" type="text"
                                                            wire:model="item_description.{{ $value }}">
                                                        @error("item_description.{{ $value }}")
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="padding: .5rem .3rem">
                                                        <input class="form-control" type="text"
                                                            wire:model="quantity.{{ $value }}"
                                                            wire:change.live="calculateTotal">
                                                        @error("quantity.{{ $value }}")
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </td>

                                                    <td style="padding: .5rem .3rem"> <a class="text-danger font-18"
                                                            wire:click="remove({{ $key }},{{ $value }})"><i
                                                                class="fa fa-trash-o"></i></a>
                                                        {{-- <a wire:click="remove({{$key}})">Remove {{$key}}</a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2" style="text-align: right; font-weight: bold">
                                                    Total Quantity
                                                </td>
                                                <td
                                                    style="text-align: right; font-weight: bold; font-size: 16px;width: 230px">
                                                    {{ $total }}
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
                <h3>Recent Indents</h3>
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
                                <th>Vendor </th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Status</th>


                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentIndents as $indent)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $indent->code }}</td>
                                    <td>{{ $indent->stockpoint->name }}</td>
                                    <td>{{ $indent->vendor ? $indent->vendor->name : null }}</td>
                                    <td>{{ $indent->type->name }}</td>
                                    <td>{{ $indent->request_date }}</td>
                                    <td>
                                        @if ($indent->status == 1)
                                            <span class="badge bg-inverse-success">PO Created</span>
                                        @else
                                            <span class="badge bg-inverse-danger">Pending</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($indent->status == 1)
                                            <a style="display:inline;" class="btn btn-xs text-info" target="_blank"
                                                href="{{ route('admin.po.print', $indent->purchaseorder->first()?->id) }}"><i
                                                    class="fa fa-print "></i>View PO</a>
                                        @else
                                            {{-- <a style="display:inline;" class="btn btn-xs text-info"
                                                href="{{ route('admin.po.create-po', ['purchase_indent_id' => $indent->id]) }}"><i
                                                    class="fa fa-print "></i> Create PO</a> --}}

                                            <a style="display:inline;" class="btn btn-xs text-info"
                                                href="{{ route('admin.po.create-po-new', ['purchase_indent_id' => $indent->id]) }}"><i
                                                    class="fa fa-print "></i> Create PO</a>
                                        @endif
                                        <button style="display:inline;float:right"
                                            wire:click="delete({{ $indent->id }})" class="btn btn-xs  text-danger"
                                            href="#" data-toggle="modal" data-target="#delete"><i
                                                class="fa fa-trash-o m-r-5"></i> Delete</button>
                                        <a style="display:inline;float:right" class="btn btn-xs  text-success"
                                            href="{{ route('admin.po.show-purchase-indent', $indent->id) }}"><i
                                                class="fa fa-eye m-r-5"></i> View</button>
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
    <!-- /Page Content -->
</div>
