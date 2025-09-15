@extends('layouts.admin')
@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    {{-- <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Welcome Admin!</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div> --}}
    <!-- /Page Header -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card card-stats p-2">
                <div class="">
                    <h3>Sale Stores</h3>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0 dataTable no-footer" id="DataTables_Table_0" >
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Stock Point</th>
                                    <th>GIN Id</th>
                                    <th>MRQ Id</th>
                                    <th>Item</th>
                                    <th>Batch No</th>
                                    <th>Mfd</th>
                                    <th>Exp.</th>
                                    <th>Quantity</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salestores as $salestore)
                                <tr>
                                    <td>{{$salestore->id}}</td>
                                    <td>{{$salestore->stockpoint->name}}</td>
                                    <td>{{$salestore->gin->code}}</td>
                                    <td>{{$salestore->gin->mrq->code}}</td>
                                    <td>{{$salestore->item->description}}</td>
                                     <td>{{$salestore->batch_no}}</td>
                                    <td>{{$salestore->mfd}}</td>
                                    <td>{{$salestore->exd}}</td>
                                    <td>{{$salestore->quantity}}</td>
                                    <td>{{$salestore->created_at}}</td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
