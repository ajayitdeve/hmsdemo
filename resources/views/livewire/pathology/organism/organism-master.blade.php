<div>
    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Organism Master (Antibiotic Setup Form)</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Organism Master</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i
                            class="fa fa-plus"></i> Add Organism</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 7, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Department</th>
                                <th>Service Group</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Antibiotics</th>
                                <th>Is Active</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($organisms as $index => $organism)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $organism?->department?->name }}</td>
                                    <td>{{ $organism?->serviceGroup?->name }}</td>
                                    <td>{{ $organism->name }}</td>
                                    <td>{{ $organism->code }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($organism->antibiotics as $antibiotic)
                                                <li>{{ $antibiotic->antibiotic ? $antibiotic->antibiotic->name : null }}
                                                </li>
                                            @endforeach
                                    </td>
                                    </ul>
                                    <td>{{ $organism->is_active == 1 ? 'Yes' : 'No' }}</td>
                                    <td>{{ $organism->created_at }}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('admin.organism-master.edit', $organism->id) }}"
                                                    class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <button wire:click="delete({{ $organism->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#delete"><i
                                                        class="fa fa-trash-o m-r-5"></i>
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
    @include('livewire.pathology.organism.modal')

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
