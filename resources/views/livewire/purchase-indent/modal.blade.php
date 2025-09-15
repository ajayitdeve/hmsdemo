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
.text-danger{
    font-size:12px !important;
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
                 <h5 class="modal-title">Add Purchase Indent</h5>
                 <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()'
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            @endif
                 <form wire:submit.prevent='save'>
                     <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Stock Point <span class="text-danger">*</span></label>
                                <select wire:model='stock_point_id' class="form-control">
                                    <option value="">Select Stock Point</option>
                                    @foreach ($stockpoints as $stockpoint)
                                        <option value="{{ $stockpoint->id }}">{{ $stockpoint->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('stock_point_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendors <span class="text-danger">*</span></label>
                                <select wire:model='vendor_id' class="form-control">
                                    <option value="">Select  Vendor</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('vendor_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Type  <span class="text-danger">*</span></label>
                                <select wire:model="type_id" class="form-control">
                                    <option value="">Select type </option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>


                     <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" class="form-control" wire:model='code' />
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" wire:model='date' />
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model='status' />
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                     </div>

                     <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input type="text" class="form-control" wire:model='remarks' />
                                @error('remarks')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Request Date </label>
                                <input type="date" class="form-control" wire:model='request_date' />
                                @error('request_date')
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
                 <h5 class="modal-title">Edit Title</h5>
                 <button type="button" class="close" wire:click='closeModal()' data-dismiss="modal"
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='update'>
                     <div class="modal-body">
                         <form wire:submit.prevent='saveTitle'>
                             <div class="form-group">
                                 <label>Title Name</label>
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
