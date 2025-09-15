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
        </style>
    @endpush

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Wallet List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Wallet List</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto" data-toggle="tooltip" data-placement="top" title="ALT+C">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add" tabindex="1"><i
                            class="fa fa-plus"></i> Add Wallet Balance</a>
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
                                <th>IPD No</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>Mode</th>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wallet_transactions as $wallet_transaction)
                                <tr>
                                    <td>{{ $wallet_transaction?->ipd?->ipdcode }}</td>
                                    <td>{{ $wallet_transaction?->patient?->registration_no }}</td>
                                    <td>{{ $wallet_transaction?->patient?->name }}</td>
                                    <td>{{ $wallet_transaction->mode }}</td>
                                    <td>{{ $wallet_transaction->transaction_id }}</td>
                                    <td>{{ $wallet_transaction->amount }}</td>
                                    <td>{{ $wallet_transaction->status }}</td>
                                    <td>{{ $wallet_transaction?->created_by?->name }}</td>
                                    <td>{{ $wallet_transaction->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='save'>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>UMR No<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="patient_id" data-placeholder="Select UMR"
                                        wire:model="patient_id">
                                        <option value=""></option>
                                        @foreach ($patients as $patient)
                                            <option value="{{ $patient->id }}">
                                                {{ $patient->registration_no }}</option>
                                        @endforeach
                                    </select>
                                    @error('patient_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Patient Name<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" readonly wire:model="patient_name">
                                    @error('patient_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Father's Name</label>
                                    <input class="form-control" type="text" readonly wire:model="father_name">
                                    @error('father_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input class="form-control" type="text" readonly wire:model="mobile">
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>IPD No<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="ipd_id" data-placeholder="Select IPD"
                                        wire:model="ipd_id">
                                        <option value=""></option>
                                        @foreach ($ipds as $ipd)
                                            <option value="{{ $ipd->id }}">
                                                {{ $ipd->ipdcode }}</option>
                                        @endforeach
                                    </select>
                                    @error('ipd_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>IPD Date<span class="text-danger">*</span></label>
                                    <input class="form-control" type="datetime-local" readonly wire:model="ipd_date">
                                    @error('ipd_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Wallet Amount</label>
                                    <input class="form-control" type="number" readonly wire:model="wallet_amount">
                                    @error('wallet_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Credit Limit</label>
                                    <input class="form-control" type="number" readonly
                                        wire:model="wallet_credit_limit">
                                    @error('wallet_credit_limit')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Mode<span class="text-danger">*</span></label>
                                    <select class="form-control" wire:model="mode">
                                        <option value="cash">Cash</option>
                                        <option value="online">Online</option>
                                    </select>
                                    @error('mode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            @if ($mode == 'online')
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Transaction ID<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" wire:model="transaction_id">
                                        @error('transaction_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Amount<span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" min="1" max="100000000"
                                        wire:model="amount">
                                    @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Save</button>
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
                    <h5 class="modal-title">Edit Wallet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='update'>
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

            $(document).ready(function() {
                $('.select2').select2({
                    width: '100%',
                });
            });

            $(document).on("change", ".select2", function() {
                let input_name = $(this).attr("name");
                @this.set(input_name, $(this).val());
            });

            $(document).on("change", "select[name='patient_id']", function() {
                @this.call("umrChanged");
            });

            $(document).on("change", "select[name='ipd_id']", function() {
                @this.call("ipdChanged");
            });
        </script>
    @endpush

</div>
