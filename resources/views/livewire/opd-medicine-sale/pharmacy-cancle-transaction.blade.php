<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Pharmacy Canclled Items</h3>
                    <ul class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pharmacy Canclled Items</li>
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
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table data-order='[[ 0, "desc" ]]' class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Item</th>
                                <th>Stock Point</th>
                                <th>Batch No</th>
                                <th>Exp. Date</th>
                                <th>Sale Price</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Taxable Amt.</th>
                                <th>Total</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pharmacyCancleTransactions as $pharmacyCancleTransaction)
                            <tr>
                                <td>{{$pharmacyCancleTransaction->id}}</td>
                               <td>{{$pharmacyCancleTransaction->item->code}}</td>
                                <td>{{$pharmacyCancleTransaction->stockpoint->name}}</td>
                                <td>{{$pharmacyCancleTransaction->batch_no}}</td>
                                <td>{{$pharmacyCancleTransaction->exd}}</td>
                                <td>{{$pharmacyCancleTransaction->unit_sale_price}}</td>
                                <td>{{$pharmacyCancleTransaction->quantity}}</td>
                                <td> {{$pharmacyCancleTransaction->amount }}</td>
                                <td> {{$pharmacyCancleTransaction->taxable_amount }}</td>
                                <td> {{$pharmacyCancleTransaction->total }}</td>
                                <td> {{$pharmacyCancleTransaction->updated_at }}</td>






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


