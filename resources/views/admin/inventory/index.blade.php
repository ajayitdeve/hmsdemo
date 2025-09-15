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
                    <h3>Inventory</h3>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0 dataTable no-footer" id="DataTables_Table_0" >
                            <thead>
                                <tr>
                                    <td>Id</td>
                                    <td>GRN Id</td>
                                    <td>Item</td>
                                    <td>Batch No</td>
                                    <td>Quantity</td>
                                    <td>Bonus</td>
                                    <td>Purchase Rate</td>
                                    <td>MRP</td>
                                    <td>Discount</td>
                                    <td>Expiry Date</td>
                                    <td>Created At</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventories as $inventory)
                                <tr>
                                    <td>{{$inventory->id}}</td>
                                    <td>{{$inventory->grn->code}}</td>
                                    <td>{{$inventory->item->description}}</td>
                                    <td>{{$inventory->batch_no}}</td>
                                    <td>{{$inventory->quantity}}</td>
                                    <td>{{$inventory->bonus}}</td>
                                    <td>{{$inventory->purchase_rate}}</td>
                                    <td>{{$inventory->mrp}}</td>
                                    <td>{{$inventory->discount}}</td>
                                    <td>{{$inventory->exd}}</td>
                                    <td>{{$inventory->created_at}}</td>
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
