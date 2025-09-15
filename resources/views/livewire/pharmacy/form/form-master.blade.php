<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Form (UOM) Unit of Measurement</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">form</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i
                            class="fa fa-plus"></i> Add Form (UOM)</a>
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
                                <th>Name</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Cost Center</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($forms as $form)
                                <tr>

                                    <td>{{ $form->name }}</td>
                                    <td>{{ $form->code }}</td>
                                    <td>{{ $form->type->name }}</td>
                                    <td>{{ $form->costcenter->name }} -{{ $form->costcenter->code }}</td>


                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button wire:click="edit({{ $form->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#edit"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</button>
                                                <button wire:click="delete({{ $form->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#delete"><i
                                                        class="fa fa-trash-o m-r-5"></i> Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $forms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    @include('livewire.pharmacy.form.modal')

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
