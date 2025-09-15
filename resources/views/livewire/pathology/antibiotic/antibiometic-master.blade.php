<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Antibiotic Master</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Antibiotic Master</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i
                            class="fa fa-plus"></i> Add Antibiotic</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 8, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Anti. Code</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Sensitive</th>
                                <th>Moderate</th>
                                <th>Resistence</th>
                                <th>Is Active</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($antibiotics as $index => $antibiotic)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $antibiotic->code }}</td>
                                    <td>{{ $antibiotic->name }}</td>
                                    <td>{{ $antibiotic->description }}</td>
                                    <td>{{ $antibiotic->senstive }}</td>
                                    <td>{{ $antibiotic->moderate }}</td>
                                    <td>{{ $antibiotic->resistance }}</td>
                                    <td>
                                        @if ($antibiotic->is_active)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                    <td>{{ $antibiotic->created_at }}</td>

                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button wire:click="edit({{ $antibiotic->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#edit"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</button>
                                                <button wire:click="delete({{ $antibiotic->id }})"
                                                    class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div>
                        {{-- {{ $parameters->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    @include('livewire.pathology.antibiotic.modal')

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
