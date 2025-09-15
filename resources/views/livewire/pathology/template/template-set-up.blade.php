<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Template Setup</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Template Setup</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i
                            class="fa fa-plus"></i> Add Template Setup</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 9, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Temp. Code</th>
                                <th>Test Main Group</th>
                                <th>Service Code</th>
                                <th>Service Name</th>
                                <th>Format Code</th>
                                <th>Is Active</th>
                                <th>S1_cd</th>
                                <th>s2_cd</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($templates as $index => $template)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $template->code }}</td>
                                    <td>{{ $template?->serviceGroup?->name }}</td>
                                    <td>{{ $template?->service?->code }}</td>
                                    <td>{{ $template?->service?->name }}</td>
                                    <td>{{ $template->format != null ? $template?->format?->code : null }}</td>
                                    <td>
                                        @if ($template->is_active)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                    <td>{{ $template->s1_cd }}</td>
                                    <td>{{ $template->s2_cd }}</td>
                                    <td>{{ $template->created_at }}</td>


                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button wire:click="edit({{ $template->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#edit"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</button>
                                                <button wire:click="delete({{ $template->id }})" class="dropdown-item"
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
    @include('livewire.pathology.template.modal')

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
