<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Pharmacy Return Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pharmacy Return Details</li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /Page Header -->
        {{-- <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control mb-2" wire:model.live.debounce.300mx="search" placeholder="search">
            </div>
        </div> --}}
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Code</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Unit Sale Rate</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Taxable Amt</th>
                                <th>total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pharmacyReturnItems as $pharmacyReturnItem)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pharmacyReturnItem->pharmacyReturn->code }}</td>
                                    <td>{{ $pharmacyReturnItem->item->description }}</td>
                                    <td>{{ $pharmacyReturnItem->quantity }}</td>
                                    <td>{{ $pharmacyReturnItem->unit_sale_price }}</td>
                                    <td>{{ $pharmacyReturnItem->amount }}</td>
                                    <td>{{ $pharmacyReturnItem->discount }}</td>
                                    <td>{{ $pharmacyReturnItem->taxable_amount }}</td>
                                    <td>{{ $pharmacyReturnItem->total }}</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->


</div>
