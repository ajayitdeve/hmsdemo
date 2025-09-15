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
        <div class="card">
            <div class="card-header">
                <h2>MRQ Details</h2>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-3"> MRQ Code : {{ $mrq->code }}</div>
                    <div class="col-md-3">To Dept: {{ $mrq->stock_point_to_id }}</div>
                    <div class="col-md-3">From Dept: {{ $mrq->stock_point_from_id }}</div>
                    <div class="col-md-3">Date: {{ $mrq->request_date }}</div>
                    <div class="col-md-3">Remarks: {{ $mrq->remarks }}</div>
                </div>


            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mrq->mrqitems as $mrqitem)
                                <tr>
                                    <td>{{$mrqitem->mrq->code}}</td>
                                    <td>{{$mrqitem->item->code}}</td>
                                    <td>{{$mrqitem->quantity}}</td>
                                    <td>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @if($mrqitem->mrq->status == 1)
                                                    <button class="dropdown-item text-success" href="#" data-toggle="modal"
                                                        data-target="#edit"><i class="fa fa-check m-r-5"></i> Approved</button>
                                                @else
                                                    <button wire:click="delete({{$mrqitem->id}})"
                                                        class="dropdown-item text-danger" href="#" data-toggle="modal"
                                                        data-target="#delete"><i class="fa fa-trash m-r-5"></i> Delete</button>
                                                    <button wire:click="edit({{$mrqitem->id}})"
                                                        class="dropdown-item text-warning" href="#" data-toggle="modal"
                                                        data-target="#edit"><i class="fa fa-trash m-r-5"></i> Edit</button>
                                                @endif

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>

                    </div>
                </div>
            </div>
        </div>

        @if($mrq->status == 0)
                <div class="card">
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif


                        <form wire:submit.prevent='save'>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row ">
                                        <label class="col-md-3">Item<span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <select wire:model='item_id' class="form-control">
                                                <option value="-1">Select </option>
                                                @foreach ($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('item_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="row">
                                        <label class="col-md-3">Quantity<span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" wire:model='quantity' />
                                            @error('quantity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn-primary btn-sm" value="Add" />
                                        </div>

                                    </div>
                                </div>

                            </div>



                        </form>
                        <div class="row mt-2 pt-2">

                            <div class="col-md-12 text-center">
                                <hr />
                                <a target="_blank" href="{{route('admin.mrq.print', $mrq->id)}}" class="btn btn-info">Print
                                    MRQ</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        @endif
    <!-- modal -->
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

                        <div class="row ">
                            <label class="col-md-3">Item<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select wire:model='item_id' class="form-control">
                                    <option value="-1">Select </option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}" {{$item->id == $mrq_item_id ? 'selected' : null}}>
                                            {{ $item->description }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('item_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row mt-1 pt-1">
                            <label class="col-md-3">Quantity<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" wire:model='quantity' />
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                </div>




                <div class="ubmit-section mt-0 pt-0 text-center">
                    <button class="btn btn-primary submit-btn m-1">Submit</button>
                </div>
                </form>
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
            })
        </script>
    @endpush

</div>
