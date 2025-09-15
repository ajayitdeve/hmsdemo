<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Corporate Relation Master</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Corporate Relation Master</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_corporate_relation"><i
                            class="fa fa-plus"></i> Add Corporate Relation</a>
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
                    <table class="table table-striped custom-table mb-0">
                        <thead>
                            <tr>

                                <th>Corporate Relation Name</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($corporate_relations as $corporate_relation)
                                <tr>

                                    <td>{{ $corporate_relation->name }}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button wire:click="edit({{ $corporate_relation->id }})"
                                                    class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#edit_corporate_relation"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit
                                                </button>
                                                <button wire:click="delete({{ $corporate_relation->id }})"
                                                    class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete_corporate_relation"><i
                                                        class="fa fa-trash-o m-r-5"></i>
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div>
                        {{ $corporate_relations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    @include('livewire.ipd.corporate-relation.modal')
    @push('page-script')
        <script>
            window.addEventListener('close-modal', event => {
                $("#add_corporate_relation").modal('hide');
                $("#edit_corporate_relation").modal('hide');
                $("#delete_corporate_relation").modal('hide');
            })
        </script>
    @endpush

</div>
