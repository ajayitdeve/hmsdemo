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
                 <h5 class="modal-title">Add Health Coordinator</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='save'>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Name</label>
                                 <input class="form-control" type="text" wire:model='name' placeholder="Name">
                                 @error('name')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Father's Name</label>
                                 <input class="form-control" type="text" wire:model='father_name'
                                     placeholder="Father Name">
                                 @error('father_name')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Email</label>
                                 <input class="form-control" type="email" wire:model='email' placeholder="Email">
                                 @error('email')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Mobile</label>
                                 <input class="form-control" wire:model="mobile"
                                     onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                     type="tel" maxlength="10" pattern="[0-9]{10}" title="10 digit mobile number">
                                 @error('mobile')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>DOB</label>
                                 <input class="form-control" type="date" wire:model.lazy="dob"
                                     max="{{ date('Y-m-d') }}"
                                     min="{{ date('Y-m-d', strtotime('-100 year', time())) }}">

                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Address</label>
                                 <input class="form-control" type="text" wire:model='address' placeholder="Address">
                             </div>
                         </div>
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
 <div wire:ignore.self class="modal custom-modal fade" id="edit" role="dialog">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Edit Country</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='update'>
                     <div class="modal-body">
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Name</label>
                                     <input class="form-control" type="text" wire:model='name' placeholder="Name">
                                     @error('name')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Father's Name</label>
                                     <input class="form-control" type="text" wire:model='father_name'
                                         placeholder="Father Name">
                                     @error('father_name')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Email</label>
                                     <input class="form-control" type="email" wire:model='email'
                                         placeholder="Email">
                                     @error('email')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Mobile</label>
                                     <input class="form-control" wire:model="mobile"
                                         onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                         type="tel" maxlength="10" pattern="[0-9]{10}"
                                         title="10 digit mobile number">
                                     @error('mobile')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>DOB</label>
                                     <input class="form-control" type="date" wire:model.lazy="dob"
                                         max="{{ date('Y-m-d') }}"
                                         min="{{ date('Y-m-d', strtotime('-100 year', time())) }}">

                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Address</label>
                                     <input class="form-control" type="text" wire:model='address'
                                         placeholder="Address">

                                 </div>
                             </div>

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
