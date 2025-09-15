<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">All MRQ </h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All MRQ</li>
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

                                <th>GRN Code</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mrqs as $mrq)
                            <tr>

                                <td><a href="{{route('admin.mrq.show-mrq',$mrq->id)}}" >{{$mrq->code}}</a></td>
                                <td>{{$mrq->stockpointfrom->name}}</td>
                                <td>{{$mrq->stockpointto->name}}</td>
                                <td>{{$mrq->request_date}}</td>
                                <td>{{$mrq->status==1?'Approved':'Not Approved'}}</td>
                                <td>{{$mrq->remarks}}</td>


                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @if($mrq->status==1)
                                            <button   class="dropdown-item text-success" href="#" data-toggle="modal" data-target="#edit"><i class="fa fa-check m-r-5"></i> Approved</button>
                                            <a target="_blank" class="dropdown-item" href="{{route('admin.mrq.print',$mrq->id)}}" ><i class="fa fa-print"></i> Print</a>
                                            @else
                                            <button wire:click="delete({{$mrq->id}})"  class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#delete"><i class="fa fa-trash m-r-5"></i> Delete</button>
                                            @endif

                                            <a class="dropdown-item text-warning" href="{{route('admin.mrq.add-mrq-items',$mrq->id)}}" ><i class="fa fa-eye"></i> View</a>

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
<!-- Delete  Modal -->
<div wire:ignore.self class="modal custom-modgal fade" id="delete" role="dialog">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-body">
                 <form wire:submit.prevent='destroy'>
                     <div class="form-header">
                         <h3>Delete </h3>
                         <p>Are you sure want to delete ?</p>
                     </div>
                     <div class="modal-btn delete-action">
                         <div class="row">
                             <div class="col-6">
                                 <button type="submit" class="btn btn-primary continue-btn btn-block">Delete</>
                             </div>
                             <div class="col-6">
                                 <a href="javascript:void(0);" data-dismiss="modal"
                                     class="btn btn-primary cancel-btn">Cancel</a>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
  <!-- /Delete  Modal -->
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

