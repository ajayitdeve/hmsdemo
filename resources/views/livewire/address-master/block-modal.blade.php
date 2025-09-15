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
                 <h5 class="modal-title">Add Block</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='save'>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Select Country</label>
                                 <select class="form-control" wire:model='country_id' wire:change="countryChanged">
                                     <option value="">Select Country</option>
                                     @foreach ($countries as $country)
                                         <option value="{{ $country->id }}">{{ $country->name }}</option>
                                     @endforeach
                                 </select>
                                 @error('country_id')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Select State</label>
                                 <select class="form-control" wire:model='state_id' wire:change="stateChanged">
                                     <option value="">Select State</option>
                                     @foreach ($states as $state)
                                         <option value="{{ $state->id }}">{{ $state->name }}</option>
                                     @endforeach
                                 </select>
                                 @error('state_id')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Select District</label>
                                 <select class="form-control" wire:model='district_id'>
                                     <option value="">Select District</option>
                                     @foreach ($districts as $district)
                                         <option value="{{ $district->id }}">{{ $district->name }}</option>
                                     @endforeach
                                 </select>
                                 @error('district_id')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Block Name</label>
                                 <input class="form-control" type="text" wire:model='name' placeholder="Block">
                                 @error('name')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
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
                 <h5 class="modal-title">Edit Block</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='update'>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Select Country</label>
                                 <select class="form-control" wire:model='country_id' wire:change="countryChanged">
                                     <option value="">Select Country</option>
                                     @foreach ($countries as $country)
                                         <option value="{{ $country->id }}">{{ $country->name }}</option>
                                     @endforeach
                                 </select>
                                 @error('country_id')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Select State</label>
                                 <select class="form-control" wire:model='state_id' wire:change="stateChanged">
                                     <option value="">Select State</option>
                                     @foreach ($states as $state)
                                         <option value="{{ $state->id }}">{{ $state->name }}</option>
                                     @endforeach
                                 </select>
                                 @error('state_id')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Select District</label>
                                 <select class="form-control" wire:model='district_id'>
                                     <option value="">Select District</option>
                                     @foreach ($districts as $district)
                                         <option value="{{ $district->id }}">{{ $district->name }}</option>
                                     @endforeach
                                 </select>
                                 @error('district_id')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Block Name</label>
                                 <input class="form-control" type="text" wire:model='name' placeholder="Block">
                                 @error('name')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
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
