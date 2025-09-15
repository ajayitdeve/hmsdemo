<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Parameter Setup</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Parameter Setup</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i
                            class="fa fa-plus"></i> Add Parameter</a>
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
                                <th>Code</th>
                                <th>Name</th>
                                <th>Method </th>
                                <th>Test Main Group</th>
                                <th>Multi. Val</th>
                                <th>Disp Type</th>
                                <th>Normal Range</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parameters as $index => $parameter)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $parameter->code }}</td>
                                    <td>{{ $parameter->name }}</td>
                                    <td>{{ $parameter->method }}</td>
                                    <td>{{ $parameter->serviceGroup != null ? $parameter->serviceGroup->name : null }}
                                    </td>
                                    <td>{{ $parameter->multiple_values == 0 ? 'No' : 'Yes' }}</td>
                                    <td>{{ $parameter->display_type }}</td>
                                    <td>{{ $parameter->normal_range == 0 ? 'No' : 'Yes' }}</td>

                                    <td>{{ $parameter->created_at }}</td>

                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('admin.parameter-master.edit', $parameter->id) }}"
                                                    class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>

                                                <button wire:click="delete({{ $parameter->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#delete"><i
                                                        class="fa fa-trash-o m-r-5"></i> Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                    {{-- <td><a href="{{route('admin.parameter-master.edit',$parameter->id)}}">{{$index + 1}} <span class="fa fa-edit"></span></a> </td> --}}
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
    @include('livewire.pathology.parameter.modal')

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
