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
                 <h5 class="modal-title">Add Ward</h5>
                 <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()'
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='save'>
                     <div class="form-group">
                         <label>Name</label>
                         <input class="form-control" type="text" wire:model='name' placeholder="Name">
                         @error('name')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Display Name</label>
                         <input class="form-control" type="text" wire:model='display_name' placeholder="Name">

                     </div>
                     <div class="form-group">
                         <label>Ward Group</label>
                         <select class="form-control" wire:model="ward_group_id">
                             <option value=""> Select Ward Group</option>
                             @foreach ($wardGroups as $wardGroup)
                                 <option value="{{ $wardGroup->id }}">{{ $wardGroup->name }}</option>
                             @endforeach
                         </select>
                         @error('ward_group_id')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Tariff Applicable</label>
                         <select class="form-control" wire:model="ward_tariff_id">
                             <option value=""> Select Tariff</option>
                             @foreach ($wardTariffs as $wardTariff)
                                 <option value="{{ $wardTariff->id }}">{{ $wardTariff->name }}</option>
                             @endforeach
                         </select>
                         @error('ward_tariff_id')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Priority</label>
                         <input class="form-control" type="number" wire:model='priority' placeholder="Name">
                         @error('priority')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex mt-4 pl-4">

                                <label> Is Active</label>
                                <input type="checkbox" class="form-check-input" wire:model='status'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex mt-4 pl-4">

                                <label> Is Casuality</label>
                                <input type="checkbox" class="form-check-input" wire:model='is_casaulity'>
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
                 <h5 class="modal-title">Edit Ward Group</h5>
                 <button type="button" class="close" wire:click='closeModal()' data-dismiss="modal"
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='update'>
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" wire:model='name' placeholder="Name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Display Name</label>
                        <input class="form-control" type="text" wire:model='display_name' placeholder="Name">

                    </div>
                    <div class="form-group">
                        <label>Ward Group</label>
                        <select class="form-control" wire:model="ward_group_id">
                            <option value=""> Select Ward Group</option>
                            @foreach ($wardGroups as $wardGroup)
                                <option value="{{ $wardGroup->id }}">{{ $wardGroup->name }}</option>
                            @endforeach
                        </select>
                        @error('ward_group_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Tariff Applicable</label>
                        <select class="form-control" wire:model="ward_tariff_id">
                            <option value=""> Select Tariff</option>
                            @foreach ($wardTariffs as $wardTariff)
                                <option value="{{ $wardTariff->id }}">{{ $wardTariff->name }}</option>
                            @endforeach
                        </select>
                        @error('ward_tariff_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Priority</label>
                        <input class="form-control" type="number" wire:model='priority' placeholder="Name">
                        @error('priority')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                       <div class="col-md-6">
                           <div class="d-flex mt-4 pl-4">

                               <label> Is Active</label>
                               <input type="checkbox" class="form-check-input" wire:model='status'>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="d-flex mt-4 pl-4">

                               <label> Is Casuality</label>
                               <input type="checkbox" class="form-check-input" wire:model='is_casuality'>
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
