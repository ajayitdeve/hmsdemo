<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Service</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Service</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" wire:click="resetInputDefault" class="btn add-btn" data-toggle="modal"
                        data-target="#add"><i class="fa fa-plus"></i> Add Service</a>

                    <a href="#" wire:click="resetInputDefault" class="btn add-btn mr-2" data-toggle="modal"
                        data-target="#add-increment"><i class="fa fa-money"></i> Add Increment</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 10, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Teriff</th>
                                <th>Department</th>
                                <th>Service Group</th>
                                <th>Charge </th>
                                <th>Emg. Charge</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $index => $service)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $service->code }}</td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->teriff != null ? $service->teriff->name : null }}</td>
                                    <td>{{ $service?->department?->name }}</td>
                                    <td>{{ $service?->servicegroup?->name }}</td>
                                    <td>{{ $service->charge }}</td>
                                    <td>{{ $service->emergency_charge }}</td>
                                    <td>{{ $service->type }}</td>
                                    <td>{{ $service->isactive ? 'Active' : 'InActive' }}</td>
                                    <td>{{ $service->created_at }}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button wire:click="edit({{ $service->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#edit"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</button>
                                                <button wire:click="delete({{ $service->id }})" class="dropdown-item"
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
    @include('livewire.service.service.modal')

    @push('page-script')
        <script>
            window.addEventListener('close-modal', event => {
                $("#add").modal('hide');
                $("#edit").modal('hide');
                $("#delete").modal('hide');
                $("#add-increment").modal('hide');
            });

            $(document).ready(function() {
                $('.select2').select2({
                    width: '100%',
                });
            });

            $(document).on("change", ".select2", function() {
                let input_name = $(this).attr("name");
                @this.set(input_name, $(this).val());
            });

            $(document).on("change", "select[name='department_id']", function() {
                @this.call("departmentChanged");
            });
        </script>
    @endpush

</div>
