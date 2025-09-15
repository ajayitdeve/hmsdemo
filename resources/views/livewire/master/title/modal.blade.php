 <!-- Delete  Modal -->
 <div wire:ignore.self class="modal custom-modgal fade" id="delete_title" role="dialog">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-body">
                 <form wire:submit.prevent='destroyTitle'>
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
 <div wire:ignore.self class="modal custom-modal fade" id="add_title" role="dialog">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Add Title</h5>
                 <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()'
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='saveTitle'>
                     <div class="form-group">
                         <label>Title Name<span class="text-danger">*</span></label>
                         <input class="form-control" type="text" wire:model='name' placeholder="Title">
                         @error('name')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="form-group">
                         <label>Gender<span class="text-danger">*</span></label>
                         <select class="form-control" wire:model="gender_id">
                             <option value="">Select gender</option>
                             @foreach ($genders as $gender)
                                 <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                             @endforeach
                         </select>
                         @error('gender_id')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

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
 <div wire:ignore.self class="modal custom-modal fade" id="edit_title" role="dialog">
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
                 <form wire:submit.prevent='updateTitle'>
                     <div class="modal-body">
                         <div class="form-group">
                             <label>Title Name</label>
                             <input class="form-control" type="text" wire:model='name' />
                             @error('name')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                         </div>

                         <div class="form-group">
                             <label>Gender<span class="text-danger">*</span></label>
                             <select class="form-control" wire:model="gender_id">
                                 <option value="">Select gender</option>
                                 @foreach ($genders as $gender)
                                     <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                 @endforeach
                             </select>
                             @error('gender_id')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                         </div>

                         <div class=" submit-section">
                             <button class="btn btn-primary submit-btn">Update</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- /Edit Modal -->
