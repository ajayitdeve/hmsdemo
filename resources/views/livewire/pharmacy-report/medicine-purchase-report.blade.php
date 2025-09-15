<div>
    <!-- Page Content -->
    <div class="content container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-stats p-2">
                    <div class="">
                        <h3>Pharmacy-Purchase Report</h3>
                        @if ($inventories != null)
                            <button wire:click="exportExcel" class="btn btn-primary">Export Excel</button>
                        @endif
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="search">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">From </label>
                                        <input type="date" class="form-control" wire:model="from">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">To </label>
                                        <input type="date" class="form-control" wire:model="to">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Vendor</label>
                                        <select class="form-control" wire:model="vendor_id">
                                            <option value="0">Select Vendor</option>
                                            @foreach ($vendors as $vendor)
                                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Item</label>
                                        <select class="form-control" wire:model="item_id">
                                            <option value="0">Select Item</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Batch No</label>
                                        <input type="text" class="form-control" wire:model="batch_no" />

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mt-4">

                                        <button class="btn btn-block btn-primary mt-4 p-2">Search</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    @if ($inventories != null)
                                        <table data-order='[[ 0, "desc" ]]'
                                            class="datatable table table-stripped mb-0 dataTable no-footer">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Item</th>
                                                    <th>Vendor</th>
                                                    <th>Batch No </th>
                                                    <th>Quantity</th>
                                                    <th>Purchase Rate</th>
                                                    <th>MRP</th>
                                                    <th>Expiry</th>
                                                    <th>Date</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($inventories as $inventory)
                                                    <tr>
                                                        <td>{{ $inventory->id }}</td>
                                                        <td>{{ $inventory->item->description }}</td>
                                                        <td>{{ $inventory->grn->vendor->name }}</td>
                                                        <td>{{ $inventory->batch_no }}</td>
                                                        <td>{{ $inventory->quantity }}</td>
                                                        <td>{{ $inventory->purchase_rate }}</td>
                                                        <td>{{ $inventory->mrp }}</td>
                                                        <td>{{ $inventory->exd }}</td>
                                                        <td>{{ $inventory->created_at }}</td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
