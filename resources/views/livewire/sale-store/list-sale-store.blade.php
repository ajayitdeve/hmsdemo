<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Sales Store </h3>
                    <ul class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Sales Store Items</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('admin.sale-store.new-gin')}}" class="btn add-btn" ><i class="fa fa-eye"></i> Go to New GIN</a>
                </div>
            </div>
        </div>
        <!-- /Page Header ------>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table class="table table-striped custom-table mb-0">
                        <thead>
                            <tr>

                                <th>GIN  Code</th>
                                <th>Item</th>
                                <th>Batch No</th>
                                <th>Mfd</th>
                                <th>Exd</th>
                                <th>Quantity</th>
                                <th>Physically Received</th>
                                <th>Date</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($saleStores as $saleStore)
                            <tr>

                                <td>{{$saleStore->gin->code}}</td>
                                <td>{{$saleStore->item->description}}</td>
                                <td>{{$saleStore->batch_no}}</td>
                                <td>{{$saleStore->mfd}}</td>
                                <td>{{$saleStore->exd}}</td>
                                <td>{{$saleStore->quantity}}</td>
                                <td> @if($saleStore->received)
                                    <a class="dropdown-item"><i class="fa fa-dot-circle-o text-success"></i> Yes</a>
                                    @else
                                    <a class="dropdown-item"><i class="fa fa-dot-circle-o text-danger"></i> No</a>
                                    @endif</td>
                                <td>{{$saleStore->created_at}}</td>
                                <td></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10">No Records found</td>
                            </tr>
                            @endforelse


                        </tbody>
                    </table>
                    <div>
                        {{-- {{ $grns->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->


</div>

