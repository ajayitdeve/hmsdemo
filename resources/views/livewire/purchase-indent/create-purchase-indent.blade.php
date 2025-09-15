<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Purchase Indent</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Purchase Indent</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Add Item Group</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table class="datatable table table-bordered table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>

                                <th>Stock Point</th>
                                <th>Vendor Id</th>
                                <th>Type Id</th>
                                <th>Code</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchaseIndents as $purchaseIndent)
                            <tr>

                                <td>{{$purchaseIndent->stock_point_id}}</td>
                                <td>{{$purchaseIndent->vendor_id}}</td>
                                <td>{{$purchaseIndent->type_id}}</td>
                                <td><a href="{{route('admin.purchase-indent.add-purchase-indent-item',['indent_id'=>$purchaseIndent->id])}}">{{$purchaseIndent->code}}</a></td>
                                <td>{{$purchaseIndent->request_date}}</td>
                                <td>{{$purchaseIndent->type_id}}</td>
                                <td>{{$purchaseIndent->status}}</td>
                                <td>{{$purchaseIndent->remarks}}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button wire:click="edit({{$purchaseIndent->id}})"  class="dropdown-item" href="#" data-toggle="modal" data-target="#edit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                                            <button wire:click="delete({{$purchaseIndent->id}})"  class="dropdown-item" href="#" data-toggle="modal" data-target="#delete"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div>
                        {{-- {{ $items->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    @include('livewire.purchase-indent.modal')
    @push('page-script')
    <script>
        window.addEventListener('close-modal', event => {
           $("#add").modal('hide');
           $("#edit").modal('hide');
           $("#delete").modal('hide');
        })
        </script>
    @endpush

</div>

