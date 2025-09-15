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
                 <h5 class="modal-title">Add Room</h5>
                 <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()'
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='save'>
                     <div class="form-group">
                         <label>Name<span class="text-danger">*</span></label>
                         <input class="form-control" type="text" wire:model='name' placeholder="Name">
                         @error('name')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Code<span class="text-danger">*</span></label>
                         <input class="form-control" type="text" wire:model='code' placeholder="Code">
                         @error('code')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>No of Beds<span class="text-danger">*</span></label>
                         <input class="form-control" type="number" wire:model='beds' placeholder="Beds">
                         @error('beds')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Bed Prefix</label>
                         <input class="form-control" type="text" wire:model='bed_prefix' placeholder="Bed Prefix">
                     </div>
                     <div class="form-group">
                         <label>Ward<span class="text-danger">*</span></label>
                         <select class="form-control" wire:model="ward_id">
                             <option value=""> Select Group</option>
                             @foreach ($wards as $ward)
                                 <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                             @endforeach
                         </select>
                         @error('ward_id')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Nursing Station<span class="text-danger">*</span></label>
                         <select class="form-control" wire:model="nurse_station_id">
                             <option value=""> Nurse Station</option>
                             @foreach ($nurseStations as $nurseStation)
                                 <option value="{{ $nurseStation->id }}">{{ $nurseStation->name }}</option>
                             @endforeach
                         </select>
                         @error('nurse_station_id')
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
                 <h5 class="modal-title">Edit Ward Group</h5>
                 <button type="button" class="close" wire:click='closeModal()' data-dismiss="modal"
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='update'>
                     <div class="form-group">
                         <label>Name<span class="text-danger">*</span></label>
                         <input class="form-control" type="text" wire:model='name' placeholder="Name">
                         @error('name')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Code<span class="text-danger">*</span></label>
                         <input class="form-control" type="text" wire:model='code' placeholder="Code">
                         @error('code')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>No of Beds</label>
                         <input class="form-control" type="number" readonly wire:model='beds' placeholder="Beds">
                         @error('beds')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Bed Prefix</label>
                         <input class="form-control" type="text" readonly wire:model='bed_prefix'
                             placeholder="Bed Prefix">
                     </div>
                     <div class="form-group">
                         <label>Ward<span class="text-danger">*</span></label>
                         <select class="form-control" wire:model="ward_id">
                             <option value=""> Select Group</option>
                             @foreach ($wards as $ward)
                                 <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                             @endforeach
                         </select>
                         @error('ward_id')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Nursing Station<span class="text-danger">*</span></label>
                         <select class="form-control" wire:model="nurse_station_id">
                             <option value=""> Nurse Station</option>
                             @foreach ($nurseStations as $nurseStation)
                                 <option value="{{ $nurseStation->id }}">{{ $nurseStation->name }}</option>
                             @endforeach
                         </select>
                         @error('nurse_station_id')
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
 <!-- /Edit Modal -->
