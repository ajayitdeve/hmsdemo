<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Goods Recipt Notes</h3>
                    <ul class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Good Receipt Notes</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Add GRN</a>
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

                                <th>Vendor</th>
                                <th>PO Code</th>
                                <th>GRN Code</th>
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Remarks</th>
                                <th>Created By</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grns as $grn)
                            <tr>

                                <td>{{$grn->vendor->name}}</td>
                                <td>{{$grn->purchaseOrder->code}}</td>
                                <td>{{$grn->code}}</td>
                                <td>{{$grn->invoice_no}}</td>
                                <td>{{$grn->invoice_date}}</td>
                                <td>{{$grn->invoice_value}}</td>
                                <td>{{$grn->remarks}}</td>
                                <td>{{$grn->createdBy!=null?$grn->createdBy->name:null}}</td>

                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button wire:click="edit({{$grn->id}})"  class="dropdown-item" href="#" data-toggle="modal" data-target="#edit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                                            <a class="dropdown-item" href="{{route('admin.grn.add-grn-items',$grn->id)}}" ><i class="fa fa-plus"></i> View</a>
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
    @include('livewire.grn.modal')
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

