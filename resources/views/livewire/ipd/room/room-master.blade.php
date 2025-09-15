<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Room Master</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Room</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i
                            class="fa fa-plus"></i> Add Room</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 11, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Ward Name</th>
                                <th>Nursing Station</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Display Name</th>
                                <th>Beds</th>
                                <th>Block</th>
                                <th>Wing</th>
                                <th>Created By </th>
                                <th>Updated By</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                                <tr>
                                    <td>{{ $loop->iteration }} &nbsp; <a
                                            href="{{ route('admin.ipd.import-beds-form', ['ward_id' => $room?->ward?->id, 'room_id' => $room->id]) }}"><i
                                                class="fa fa-bed text-success" aria-hidden="true"></i></a></td>
                                    <td>{{ $room?->ward?->name }}</td>
                                    <td>{{ $room?->nurseStation?->name }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td><a href="{{ route('admin.ipd.bed-master', $room->id) }}">{{ $room->code }}</a>
                                    </td>
                                    <td>{{ $room->display_name }}</td>
                                    <td>{{ $room->beds }}</td>
                                    <td>{{ $room->block }}</td>
                                    <td>{{ $room->wing }}</td>
                                    <td>{{ $room?->createdById?->name }}</td>
                                    <td>{{ $room?->updatedById?->name }}</td>
                                    <td>{{ $room->created_at }}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button wire:click="edit({{ $room->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#edit"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</button>
                                                <button wire:click="delete({{ $room->id }})" class="dropdown-item"
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
    @include('livewire.ipd.room.modal')

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
