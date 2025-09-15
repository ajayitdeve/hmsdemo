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
                                <button type="submit" class="btn btn-primary continue-btn btn-block">Delete</>
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
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Material Requisition (MRQ)</h5>
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()' aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='save'>
                    <div class="row">


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>From Department</label>
                                <select wire:model='stock_point_from_id' class="form-control">
                                    @foreach ($stockPoints as $stockPoint)
                                        @if ($stockPoint->id == $stock_point_from_id)
                                            <option value="{{ $stockPoint->id }}">{{ $stockPoint->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>To Department</label>
                                <select wire:model='stock_point_to_id' class="form-control">
                                    @foreach ($stockPoints as $stockPoint)
                                        @if ($stockPoint->id !== $stock_point_from_id)
                                            <option value="{{ $stockPoint->id }}">{{ $stockPoint->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Code </label>
                                <input readonly type="text" class="form-control" wire:model='code' />
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control" wire:model='request_date' readonly />
                                @error('request_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input type="text" wire:model='remarks' class="form-control" placeholder="">

                                @error('remarks')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>




                    <div class="ubmit-section mt-0 pt-0 text-center">
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
                <h5 class="modal-title">Edit Material Requisition (MRQ)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='update'>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>To Department <br /><b>{{ $to?->name }} </b></label>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>From Department <br /><b>{{ $stockPoint?->name }}</b></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Code </label>
                                <input readonly type="text" class="form-control" wire:model='code' />
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" readonly class="form-control" wire:model='request_date' />
                                @error('request_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input type="text" wire:model='remarks' class="form-control" placeholder="">

                                @error('remarks')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>




                    <div class="ubmit-section mt-0 pt-0 text-center">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Edit Modal -->
