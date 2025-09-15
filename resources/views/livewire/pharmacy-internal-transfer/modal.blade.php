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
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Good Issue Notes</h5>
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()' aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='save'>
                    <div class="row">
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label>Stock Point<span class="text-danger">*</span></label>
                                <select wire:model='stock_point_id' class="form-control">
                                    <option value="-1">Select </option>
                                    @foreach ($stockPoints as $stockPoint)
                                        <option value="{{ $stockPoint->id }}">{{ $stockPoint->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('stock_point_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Material Requisition Code<span class="text-danger">*</span></label>
                                <select wire:model='mrq_id' class="form-control" wire:change='mrqChanged'>
                                    <option value="-1">Select </option>
                                    @foreach ($mrqs as $mrq)
                                        <option value="{{ $mrq->id }}">{{ $mrq->code }} (
                                            {{ $mrq->stockpointfrom->name }}) - ({{ $mrq->stockpointto->name }}) |
                                            {{ $mrq->request_date }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mrq_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Code </label>
                                <input type="text" class="form-control" wire:model='code' readonly />
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    @if ($mrq_id > 0)
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>From </label>
                                    <input type="text" class="form-control" readonly
                                        value={{ $mrq->stockpointfrom->name }}>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>To </label>
                                    <input type="text" class="form-control" readonly
                                        value={{ $mrq->stockpointto->name }}>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Request Date </label>
                                    <input type="text" class="form-control" readonly value={{ $mrq->request_date }}>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status </label>
                                    <br/>
                                    <button
                                        class="brn btn-{{ $mrq->status == 0 ? 'danger' : 'success' }}">{{ $mrq->status == 0 ? 'Pending' : 'Approved' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($currentGins != null)
                        <div class="card p-0 m-0">
                            <div class="card-header p-0 m-0">
                                <p>Exising GIN for above MRQ</p>
                            </div>
                            <div class="card-body p-0 m-0">
                                <table class="table table-bordered p-0 m-0">
                                    <thead>
                                        <tr>
                                            <th>GIN ID / Code </th>
                                            <th>MRQ</th>
                                            <th>Status</th>
                                            <th>Created At</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($currentGins as $currentGin)
                                            <tr>
                                                <td>{{ $currentGin->id }} / {{ $currentGin->code }}</td>
                                                <td>{{ $currentGin->mrq->code }}</td>
                                                <td>{{ $currentGin->status }}</td>
                                                <td>{{ $currentGin->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="card p-0 m-0">
                            <div class="card-header p0 m-0"><p>Existing GIN Items</p></div>
                            <div class="card-body p-0 m-0">
                                <table class="table table-bordered p-0 m-0">
                                    <thead>
                                        <tr>
                                            <th>GIN ID / Code </th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Batch no</th>
                                            <th>Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($currentGins as $currentGin)
                                            @foreach ($currentGin->ginItems as $item)
                                                <tr>
                                                    <td>{{ $item->gin->id }} / {{ $item->gin->code }}</td>
                                                    <td>{{ $item->item->code }}</td>
                                                    <td>{{ $item->batch_no }}</td>
                                                    <td>{{ $item->created_at }}</td>

                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                          </div>



                    @endif
                    <div class="row">
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
                        @if ($ginCount == 0)
                            <button class="btn btn-primary submit-btn">Submit</button>
                        @endif
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
                <h5 class="modal-title">Edit Title</h5>
                <button type="button" class="close" wire:click='closeModal()' data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='update'>
                    <div class="modal-body">
                        <form wire:submit.prevent='saveTitle'>
                            <div class="form-group">
                                <label>Title Name </label>
                                <input class="form-control" type="text" wire:model='name' />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
