<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Scrap Transfer List </h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Scraps</li>
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
                                <th>From</th>
                                <th>To</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scraps as $scrap)
                            <tr>
                                <td>{{$scrap->id}}</td>
                                <td>{{$scrap->code}}</td>
                                <td>{{$scrap->stockPointFrom!=null?$scrap->stockPointFrom->name:null}}</td>
                                <td>{{$scrap->stockPointTo!=null?$scrap->stockPointTo->name:null}}</td>
                                <td>{{$scrap->scrap_transfer_date}}</td>
                                <td>{{$scrap->status?'Appproved':'Not Approved'}}</td>
                                <td>{{$scrap->remarks}}</td>


                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                           {{-- @if(!$scrap->status) <button wire:click="edit({{$scrap->id}})"  class="dropdown-item" href="#" href="#" data-toggle="modal" data-target="#edit"><i class="fa fa-pencil m-r-5"></i> Edit</button>@endif --}}
                                            <a class="dropdown-item" href="{{route('admin.pharmacy.scrap.list-scrap-item',$scrap->id)}}" ><i class="fa fa-plus"></i> View</a>
                                        </div>
                                    </div>
                                </td>
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

