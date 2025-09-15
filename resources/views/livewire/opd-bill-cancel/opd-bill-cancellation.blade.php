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

    <div>
        @include('partials.alert-message')

        <form wire:submit.prevent='confirmation'>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h2>Cancel OPD Billing </h2>
                        </div>

                    </div>
                </div>


                <div class="card-body">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Bill No</label>
                                        <input type="text" class="form-control" wire:model="bill_no"
                                            wire:change="billNoChanged" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Patient's Name</label>
                                                <input type="text" class="form-control" readonly wire:model="name">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">UMR</label>
                                                <input type="text" class="form-control" readonly
                                                    wire:model="registration_no">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" class="form-control" readonly
                                                    wire:model="address">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Code</th>
                                    <th>Is Canceled</th>
                                    <th>Service</th>
                                    <th>Qunatity</th>
                                    <th>Unit Sale Price</th>
                                    <th>Amount</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($opdBillingIteams as $opdBillingIteam)
                                    <tr>
                                        <td>{{ $opdBillingIteam->id }}</td>
                                        <td>{{ $opdBillingIteam->opdBilling->code }}</td>
                                        <td>
                                            @if ($opdBillingIteam->is_cancled == 1)
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    wire:click='view_item_cancel({{ $opdBillingIteam->id }})'>Yes</button>
                                            @else
                                                <button type="button" class="btn btn-success btn-sm"
                                                    wire:click='view_item_cancel({{ $opdBillingIteam->id }}, true)'>No</button>
                                            @endif
                                        </td>
                                        <td>{{ $opdBillingIteam->service->name }}</td>
                                        <td>{{ $opdBillingIteam->quantity }}</td>
                                        <td>{{ $opdBillingIteam->unit_service_price }}</td>
                                        <td>{{ $opdBillingIteam->amount }}</td>
                                        <td>{{ $opdBillingIteam->discount }}</td>
                                        <td>{{ $opdBillingIteam->total }}</td>


                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td>Total</td>
                                    <td><strong>{{ $opdBilling != null ? $opdBilling->opdBillingItems->where('is_cancled', '0')->sum('total') : null }}</strong>
                                    </td>


                                </tr>
                            </tbody>
                        </table>
                        <div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-12 text-center">
                    @if ($opdBilling != null)
                        <button type="submit" class="btn btn-primary">All Cancle</button>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Cancel Modal -->
    <div wire:ignore.self class="modal custom-modal fade" id="cancelModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cancel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='cancel'>
                        <div class="form-group">
                            <label>Reason</label>
                            <textarea class="form-control" wire:model="reason"></textarea>
                            @error('reason')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Approved By</label>
                            <select class="form-control" wire:model="approved_by">
                                <option value="">Select one</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('approved_by')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @if ($show_cancel_button)
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Cancel Now</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation  Modal -->
    <div wire:ignore.self class="modal custom-modal fade" id="confirmationModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cancel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='cancel_bill'>
                        <div class="form-group">
                            <label>Reason</label>
                            <textarea class="form-control" wire:model="reason"></textarea>
                            @error('reason')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Approved By</label>
                            <select class="form-control" wire:model="approved_by">
                                <option value="">Select one</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('approved_by')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Cancel Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Confirmation  Modal -->

    @push('page-script')
        <script>
            window.addEventListener('open-confirmation-modal', event => {
                $("#confirmationModal").modal('show');
            });

            window.addEventListener('hide-confirmation-modal', event => {
                $("#confirmationModal").modal('hide');
            });

            window.addEventListener('show-cancel-modal', event => {
                $("#cancelModal").modal('show');
            });

            window.addEventListener('hide-cancel-modal', event => {
                $("#cancelModal").modal('hide');
            });
        </script>
    @endpush
</div>
