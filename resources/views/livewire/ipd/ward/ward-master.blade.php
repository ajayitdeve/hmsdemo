<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Ward</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Ward</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Add Ward</a>
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
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>

                                <th>Name</th>
                                <th>Code</th>
                                <th>Ward Group</th>
                                <th>Tariff</th>
                                <th>Status</th>
                                <th>Created By </th>
                                <th>Updated By</th>
                                <th>Created At</th>

                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wards as $ward)
                            <tr>

                                <td>{{$ward->name}}</td>
                                <td>{{$ward->code}}</td>
                                <td>{{$ward->wardGroup->name}}</td>
                                <td>{{$ward->wardTariff->name}}</td>
                                <td>{{$ward->status==1?'Active':'Inactive'}}</td>
                                <td>{{$ward->createdById->name}}</td>
                                <td>{{$ward->updatedById->name}}</td>
                                <td>{{$ward->created_at}}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button wire:click="edit({{$ward->id}})"  class="dropdown-item" href="#" data-toggle="modal" data-target="#edit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                                            <button wire:click="delete({{$ward->id}})"  class="dropdown-item" href="#" data-toggle="modal" data-target="#delete"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div>
                        {{-- {{ $wards->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    @include('livewire.ipd.ward.modal')
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


