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
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Add Bed to {{ $room->ward->name }} / {{ $room->name }}</h5>
                 <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()'
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='save'>
                     <div class="form-group">
                         <label>Display Name<span class="text-danger">*</span></label>
                         <input class="form-control" type="text" wire:model='display_name'
                             placeholder="Display Name">
                     </div>

                     <div class="form-group">
                         <label>Bed Code<span class="text-danger">*</span></label>
                         <input class="form-control" type="text" wire:model='code' placeholder="Code">
                         @error('code')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="form-group row">
                         <div class="col-md-4">
                             <label class="form-check-label"> Bed Status ?</label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="bed_status"
                                 value="vacant">Vacant
                             <label class="form-check-label" for="radio1"></label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="bed_status" value="used">Used
                         </div>
                     </div>
                     <hr />
                     <div class="form-group row">
                         <div class="col-md-4">
                             <label class="form-check-label"> Is Dummy Room ?</label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_dummy_room"
                                 value="1">Yes
                             <label class="form-check-label" for="radio1"></label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_dummy_room" value="0">No
                         </div>
                     </div>

                     <div class="form-group row">
                         <div class="col-md-4">
                             <label class="form-check-label"> Is Oxygen ?</label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_oxygen" value="1">Yes
                             <label class="form-check-label" for="radio1"></label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_oxygen" value="0">No

                         </div>
                     </div>
                     <div class="form-group row">
                         <div class="col-md-4">
                             <label class="form-check-label"> Is Suction ?</label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_suction" value="1">Yes
                             <label class="form-check-label" for="radio1"></label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_suction"
                                 value="0">No

                         </div>
                     </div>
                     <div class="form-group row">
                         <div class="col-md-4">
                             <label class="form-check-label"> Is Window ?</label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_window"
                                 value="1">Yes
                             <label class="form-check-label" for="radio1"></label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_window" value="0">No

                         </div>
                     </div>
                     <hr />


                     <div class=" submit-section">
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
                 <h5 class="modal-title">Edit Bed</h5>
                 <button type="button" class="close" wire:click='closeModal()' data-dismiss="modal"
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='update'>
                     <div class="form-group">
                         <label>Display Name<span class="text-danger">*</span></label>
                         <input class="form-control" type="text" wire:model='display_name'
                             placeholder="Display Name">
                     </div>

                     <div class="form-group">
                         <label>Bed Code<span class="text-danger">*</span></label>
                         <input class="form-control" type="text" wire:model='code' placeholder="Code">
                         @error('code')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="form-group row">
                         <div class="col-md-4">
                             <label class="form-check-label"> Bed Status ?</label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="bed_status"
                                 value="vacant">Vacant
                             <label class="form-check-label" for="radio1"></label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="bed_status"
                                 value="used">Used
                         </div>
                     </div>
                     <hr />
                     <div class="form-group row">
                         <div class="col-md-4">
                             <label class="form-check-label"> Is Dummy Room ?</label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_dummy_room"
                                 value="1">Yes
                             <label class="form-check-label" for="radio1"></label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_dummy_room"
                                 value="0">No
                         </div>
                     </div>

                     <div class="form-group row">
                         <div class="col-md-4">
                             <label class="form-check-label"> Is Oxygen ?</label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_oxygen"
                                 value="1">Yes
                             <label class="form-check-label" for="radio1"></label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_oxygen" value="0">No

                         </div>
                     </div>
                     <div class="form-group row">
                         <div class="col-md-4">
                             <label class="form-check-label"> Is Suction ?</label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_suction"
                                 value="1">Yes
                             <label class="form-check-label" for="radio1"></label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_suction"
                                 value="0">No

                         </div>
                     </div>
                     <div class="form-group row">
                         <div class="col-md-4">
                             <label class="form-check-label"> Is Window ?</label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_window"
                                 value="1">Yes
                             <label class="form-check-label" for="radio1"></label>
                         </div>
                         <div class="form-check col-md-3">
                             <input type="radio" class="form-check-input" wire:model="is_window" value="0">No

                         </div>
                     </div>
                     <hr />


                     <div class=" submit-section">
                         <button class="btn btn-primary submit-btn">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- /Edit Modal -->
