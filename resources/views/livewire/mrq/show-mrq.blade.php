<div>
    @push('page-css')
    <style>
        .form-control{
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
                <div class="col-md-3">To Dept: {{ $mrq->stockpointto->name }}</div>
                <div class="col-md-3">From Dept: {{ $mrq->stockpointfrom->name }}</div>
                <div class="col-md-3">Date: {{ $mrq->request_date }}</div>
                <div class="col-md-3">Remarks: {{ $mrq->remarks }}</div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Status : @if($mrq->status==1) <button class="btn-success">Approved</button> @else <button class="btn-danger">Not Approved</button>@endif
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
                           <th>Code</th>
                            <th>Item</th>
                            <th>Quantity (Requested)</th>
                            <th>Quantity (Approved)</th>
                           <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                             @foreach($mrq->mrqitems as $mrqitem)
                             <tr>
                                <td>{{$mrqitem->mrq->code}}</td>
                                <td>{{$mrqitem->item->code}}</td>
                                <td>{{$mrqitem->quantity}}</td>
                                <td>{{$mrqitem->approved_quantity}}</td>
                                <td>
                                   @if($mrq->status==0) <button wire:click="edit({{$mrqitem->id}})"  class="dropdown-item" href="#" data-toggle="modal" data-target="#edit"><i class="fa fa-pencil m-r-5"></i> Edit</button>@endif
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
{{--
@if($mrq->status==0)
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('admin.gin.store-gin')}}">
                @csrf
            <div class="ubmit-section mt-0 pt-0 text-center">
                <input type="hidden" name="mrq_id" value="{{$mrq->id}}">
                <input type="submit" value="Approve" class="btn btn-md btn-success " />
            </div>
            </form>
        </div>
        </div>
    @endif --}}

    @if($mrq->status==0)
    <div class="card">
        <div class="card-body">

            <div class="ubmit-section mt-0 pt-0 text-center">
               <button wire:click="approveMrq" class="btn btn-md btn-success">Approve</button>
            </div>

        </div>
        </div>
    @endif
    </div>
  <!-- Edit Modal -->
  <!-- Add  Modal -->
<div wire:ignore.self class="modal custom-modal fade" id="edit" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
                <button type="button" class="close" wire:click='closeModal()' data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='update'>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label">Item<span class="text-danger">*</span></label>
                                 <select wire:model='item_id' class="form-control" >
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

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label">Quantity<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model='quantity' />
                                    @error('quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label">Approved Quantity<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model='approved_quantity' />
                                    @error('approved_quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>


                    </div>

                    <div class="ubmit-section mt-0 pt-0 text-center">
                        <button class="btn btn-md btn-primary ">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Modal -->
</div>







@push('page-script')
    <script>
        window.addEventListener('close-modal', event => {
           $("#add").modal('hide');
           $("#edit").modal('hide');
           $("#delete").modal('hide');
        })
        </script>
    @endpush
