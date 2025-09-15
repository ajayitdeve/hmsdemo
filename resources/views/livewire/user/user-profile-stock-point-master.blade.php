<div>
    @push('page-css')
        <style>
            .form-control {
                font-size: 13px;
                height: 30px !important;
            }

            label {
                display: inline-block;
                margin-bottom: 0px;
                font-size: 13px;
            }

            .custom-control-label::before,
            .custom-control-label::after {
                top: .05rem;
            }
        </style>
    @endpush

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">User Profile Stock Point</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">User Profile Stock Point</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto" data-toggle="tooltip" data-placement="top" title="ALT+C">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add" tabindex="1"><i
                            class="fa fa-plus"></i> Add User Profile Stock Point</a>
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
                                <th>Team</th>
                                <th>Stock Points</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($team_stock_points as $team_stock_point)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $team_stock_point?->team?->name }}</td>
                                    <td>
                                        {{ \App\Models\StockPoint::whereIn('id', $team_stock_point?->stock_points)->pluck('name')->implode(', ') }}
                                    </td>
                                    <td>{{ $team_stock_point?->created_by?->name }}</td>
                                    <td>{{ $team_stock_point->created_at }}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button wire:click="edit({{ $team_stock_point->id }})"
                                                    class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#edit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                                                <button wire:click="delete({{ $team_stock_point->id }})"
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
                </div>
                <div class="mt-4 d-flex justify-content-end align-items-center">
                    {{ $team_stock_points->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Delete  Modal -->
    <div wire:ignore.self class="modal custom-modgal fade" id="delete" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form wire:submit.prevent='destroy'>
                        <div class="form-header">
                            <h3>Delete </h3>
                            <p>Are you sure want to delete ?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit"
                                        class="btn btn-primary continue-btn btn-block">Delete</button>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal"
                                        class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete  Modal -->

    <!-- Add  Modal -->
    <div wire:ignore.self class="modal custom-modal fade" id="add" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='save'>
                        <div class="form-group">
                            <label>Team <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="team_id" data-placeholder="Select Team"
                                wire:model="team_id">
                                <option value=""></option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('team_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="" class="mb-2">Stock Points<span
                                            class="text-danger">*</span></label>
                                </div>

                                @foreach ($stock_point_list as $stock_point)
                                    <div class="col-md-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                value="{{ $stock_point->id }}" id="stock-point-{{ $stock_point->id }}"
                                                wire:model="stock_points">
                                            <label class="custom-control-label"
                                                for="stock-point-{{ $stock_point->id }}">{{ $stock_point->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Modal -->

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal custom-modal fade" id="edit" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='update'>
                        <div class="form-group">
                            <label>Team <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="team_id" data-placeholder="Select Team"
                                wire:model="team_id">
                                <option value=""></option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('team_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="" class="mb-2">Stock Points<span
                                            class="text-danger">*</span></label>
                                </div>

                                @foreach ($stock_point_list as $stock_point)
                                    <div class="col-md-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                value="{{ $stock_point->id }}"
                                                id="stock-point-{{ $stock_point->id }}" wire:model="stock_points">
                                            <label class="custom-control-label"
                                                for="stock-point-{{ $stock_point->id }}">{{ $stock_point->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class=" submit-section">
                            <button class="btn btn-primary submit-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Modal -->


    @push('page-script')
        <script>
            window.addEventListener('close-modal', event => {
                $("#add").modal('hide');
                $("#edit").modal('hide');
                $("#delete").modal('hide');
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

            document.addEventListener('DOMContentLoaded', function() {
                $('#add').on('shown.bs.modal', function() {
                    $('#add select').trigger('focus');
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                $('#edit').on('shown.bs.modal', function() {
                    $('#edit select').trigger('focus');
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
