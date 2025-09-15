<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Discharge Type</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Case Type</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto" data-toggle="tooltip" data-placement="top" title="ALT+C">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add" tabindex="1"><i
                            class="fa fa-plus"></i> Add Discharge Type</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discharge_types as $discharge_type)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $discharge_type->name }}</td>
                                    <td>{{ $discharge_type->description }}</td>

                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button wire:click="edit({{ $discharge_type->id }})"
                                                    class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#edit"><i class="fa fa-pencil m-r-5"></i> Edit
                                                </button>
                                                <button wire:click="delete({{ $discharge_type->id }})"
                                                    class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-end align-items-center">
                    {{ $discharge_types->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    @include('livewire.master.discharge-type.modal')

    @push('page-script')
        <script>
            window.addEventListener('close-modal', event => {
                $("#add").modal('hide');
                $("#edit").modal('hide');
                $("#delete").modal('hide');
            });

            document.addEventListener('DOMContentLoaded', function() {
                $('#add').on('shown.bs.modal', function() {
                    $('#add input:first').trigger('focus');
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                $('#edit').on('shown.bs.modal', function() {
                    $('#edit input:first').trigger('focus');
                });
            });

            document.addEventListener('keydown', function(event) {
                // Check if Alt + C is pressed
                if (event.altKey && event.code === 'KeyC') {
                    event.preventDefault();
                    $('#add').modal('show');
                }
            });

            $('[data-toggle="tooltip"]').tooltip();
        </script>
    @endpush

</div>
