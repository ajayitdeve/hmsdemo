<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Bed Master</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Bed Master</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i
                            class="fa fa-plus"></i> Add Bed</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[12, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Display Name</th>
                                <th>Bed Code</th>
                                <th>Is Dummy</th>
                                <th>Is Oxygen</th>
                                <th>Is Suction</th>
                                <th>Is Windows </th>
                                <th>Ward</th>
                                <th>Room</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($beds as $bed)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bed->display_name }}</td>
                                    <td>{{ $bed->code }}</td>
                                    <td>{{ $bed->is_dummy_room }}</td>
                                    <td>{{ $bed->is_oxygen }}</td>
                                    <td>{{ $bed->is_suction }}</td>
                                    <td>{{ $bed->is_window }}</td>
                                    <td>{{ $bed->ward->name }}</td>
                                    <td>{{ $bed->room->name }}</td>
                                    <td>{{ $bed->bed_status }}</td>
                                    <td>{{ $bed->createdById->name }}</td>
                                    <td>{{ $bed->updatedById->name }}</td>
                                    <td>{{ $bed->created_at }}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button wire:click="edit({{ $bed->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#edit"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</button>
                                                <button wire:click="delete({{ $bed->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#delete"><i
                                                        class="fa fa-trash-o m-r-5"></i> Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    @include('livewire.ipd.bed.modal')

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
