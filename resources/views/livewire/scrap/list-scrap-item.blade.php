<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Scrap Items </h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Scrap Items</li>
                    </ul>
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
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>

                                <th>Id</th>
                                <th>Code</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Remarks</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scrapItems as $scrapItem)
                            <tr>
                                <td>{{$scrapItem->id}}</td>
                                <td>{{$scrapItem->scrap->code}}</td>
                                <td>{{$scrapItem->item->code}} - {{$scrapItem->item->description}}</td>
                                <td>{{$scrapItem->quantity}}</td>
                                 <td>{{$scrapItem->remarks}}</td>


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
    <!-- /Page Content -->



</div>

