<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Specimen Master</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Specimen Master</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i
                            class="fa fa-plus"></i> Add Specimen</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 6, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Specimen Code</th>
                                <th>Name</th>
                                <th>Is Active</th>
                                <th>S1_cd</th>
                                <th>s2_cd</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($specimens as $index => $specimen)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $specimen->code }}</td>
                                    <td>{{ $specimen->name }}</td>
                                    <td>
                                        @if ($specimen->is_active)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                    <td>{{ $specimen->sa_cd }}</td>
                                    <td>{{ $specimen->s2_cd }}</td>
                                    <td>{{ $specimen->created_at }}</td>


                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button wire:click="edit({{ $specimen->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#edit"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</button>
                                                <button wire:click="delete({{ $specimen->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#delete"><i
                                                        class="fa fa-trash-o m-r-5"></i> Delete</button>
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
    @include('livewire.pathology.specimen.modal')

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
