<!-- Payment  Modal -->
<div wire:ignore.self class="modal custom-modal fade" id="payment-sheet-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pay Now</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('partials.alert-message')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Wallet Amount</label>
                            <input type="text" class="form-control" wire:model="walletAmount" readonly />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Credit Limit</label>
                            <input type="text" class="form-control" wire:model="creditLimit" readonly />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Payable Amount<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="payableAmount" readonly />
                            @error('payableAmount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Due Amount<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="dueAmount" readonly />
                            @error('dueAmount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Paying Amount<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="payingAmount"
                                wire:change='payingAmountChanged'>
                            @error('payingAmount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Payment Mode<span class="text-danger">*</span></label>
                            <select class="form-control" wire:model='payment_mode'>
                                <option value="">Select one</option>
                                <option value="cash">Cash</option>
                                <option value="online">Online</option>
                                <option value="wallet">Wallet</option>
                            </select>
                            @error('payment_mode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if ($payment_mode == 'online')
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Transaction ID<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model='transaction_id'>
                                @error('transaction_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif
                </div>

                <div class="submit-section mt-2">
                    <button class="btn btn-primary submit-btn">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Payment Modal -->
