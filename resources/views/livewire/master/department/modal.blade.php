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
                 <h5 class="modal-title">Add Department</h5>
                 <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()'
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='save'>
                     <div class="form-group">
                         <label>Name<span class="text-danger">*</span></label>
                         <input type="text" class="form-control" wire:model="name">
                         @error('name')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Code<span class="text-danger">*</span></label>
                         <input type="text" class="form-control" wire:model="code">
                         @error('code')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="row">
                         <div class="col-md-6">
                             <label for="">Is Medical </label>
                         </div>
                         <div class="col-md-3">
                             <div class="form-check">
                                 <input class="form-check-input" type="radio" wire:model="is_medical" value="1">
                                 <label class="form-check-label" for="status">
                                     Yes
                                 </label>
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-check">
                                 <input class="form-check-input" type="radio" wire:model="is_medical" value="0">
                                 <label class="form-check-label" for="status">
                                     No
                                 </label>
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-md-6">
                             <label for="">Is Consultation </label>
                         </div>
                         <div class="col-md-3">
                             <div class="form-check">
                                 <input class="form-check-input" type="radio" wire:model="is_consultation"
                                     value="1">
                                 <label class="form-check-label" for="status">
                                     Yes
                                 </label>
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-check">
                                 <input class="form-check-input" type="radio" wire:model="is_consultation"
                                     value="0">
                                 <label class="form-check-label" for="status">
                                     No
                                 </label>
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-md-6">
                             <label for="">Is NMCH </label>
                         </div>
                         <div class="col-md-3">
                             <div class="form-check">
                                 <input class="form-check-input" type="radio" wire:model="is_nmch" value="1">
                                 <label class="form-check-label" for="nmch">
                                     Yes
                                 </label>
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-check">
                                 <input class="form-check-input" type="radio" wire:model="is_nmch" value="0">
                                 <label class="form-check-label" for="nmch">
                                     No
                                 </label>
                             </div>
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
                 <h5 class="modal-title">Edit Department</h5>
                 <button type="button" class="close" wire:click='closeModal()' data-dismiss="modal"
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='update'>
                     <div class="form-group">
                         <label>Name<span class="text-danger">*</span></label>
                         <input type="text" class="form-control" wire:model="name">
                         @error('name')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Code<span class="text-danger">*</span></label>
                         <input type="text" class="form-control" wire:model="code">
                         @error('code')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="row">
                         <div class="col-md-6">
                             <label for="">Is Medical </label>
                         </div>
                         <div class="col-md-3">
                             <div class="form-check">
                                 <input class="form-check-input" type="radio" wire:model="is_medical"
                                     value="1">
                                 <label class="form-check-label" for="status">
                                     Yes
                                 </label>
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-check">
                                 <input class="form-check-input" type="radio" wire:model="is_medical"
                                     value="0">
                                 <label class="form-check-label" for="status">
                                     No
                                 </label>
                             </div>
                         </div>

                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <label for="">Is Consultation </label>
                         </div>
                         <div class="col-md-3">
                             <div class="form-check">
                                 <input class="form-check-input" type="radio" wire:model="is_consultation"
                                     value="1">
                                 <label class="form-check-label" for="status">
                                     Yes
                                 </label>
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-check">
                                 <input class="form-check-input" type="radio" wire:model="is_consultation"
                                     value="0">
                                 <label class="form-check-label" for="status">
                                     No
                                 </label>
                             </div>
                         </div>

                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <label for="">Is NMCH </label>
                         </div>
                         <div class="col-md-3">
                             <div class="form-check">
                                 <input class="form-check-input" type="radio" wire:model="is_nmch" value="1">
                                 <label class="form-check-label" for="nmch">
                                     Yes
                                 </label>
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-check">
                                 <input class="form-check-input" type="radio" wire:model="is_nmch" value="0">
                                 <label class="form-check-label" for="nmch">
                                     No
                                 </label>
                             </div>
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
 <!-- /Edit Modal -->
