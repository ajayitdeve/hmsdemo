 <!-- Delete type Modal -->
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
                 <h5 class="modal-title">Add Manufacturer </h5>
                 <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()'
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='save'>
                     <div class="form-group">
                         <label>Name</label>
                         <input class="form-control" type="text" wire:model='name' placeholder="Manufacturer Name">
                         @error('name')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="form-group">
                         <label>Cost Center<span class="text-danger">*</span></label>
                         <select wire:model='cost_center_id' class="form-control">

                             @foreach ($costcenters as $costcenter)
                                 <option value="{{ $costcenter->id }}">{{ $costcenter->name }} - {{ $costcenter->code }}
                                 </option>
                             @endforeach
                         </select>
                         @error('cost_center_id')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Type<span class="text-danger">*</span></label>
                         <select wire:model='type_id' class="form-control">

                             @foreach ($types as $type)
                                 <option value="{{ $type->id }}">{{ $type->name }} </option>
                             @endforeach
                         </select>
                         @error('type_id')
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
 <div wire:ignore.self class="modal custom-modal fade" id="edit" role="dialog">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Edit Manufacturer</h5>
                 <button type="button" class="close" wire:click='closeModal()' data-dismiss="modal"
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='update'>
                     <div class="form-group">
                         <label>Name</label>
                         <input class="form-control" type="text" wire:model='name' placeholder="Manufacturer Name">
                         @error('name')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="form-group">
                         <label>Cost Center<span class="text-danger">*</span></label>
                         <select wire:model='cost_center_id' class="form-control">

                             @foreach ($costcenters as $costcenter)
                                 <option value="{{ $costcenter->id }}">{{ $costcenter->name }} -
                                     {{ $costcenter->code }}</option>
                             @endforeach
                         </select>
                         @error('cost_center_id')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Type<span class="text-danger">*</span></label>
                         <select wire:model='type_id' class="form-control">

                             @foreach ($types as $type)
                                 <option value="{{ $type->id }}">{{ $type->name }} </option>
                             @endforeach
                         </select>
                         @error('type_id')
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
