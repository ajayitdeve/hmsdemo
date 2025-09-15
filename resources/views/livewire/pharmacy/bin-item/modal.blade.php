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
                 <h5 class="modal-title">Assign Bin to Item</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='save'>

                     <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Item <span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="item_id"
                                   >
                                    <option value="">Select </option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->description }}</option>
                                    @endforeach
                                </select>
                                @error('item_id')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label>Stock Point <span class="text-danger">*</span></label>
                                 <select class="form-control" wire:model="stock_point_id"
                                     wire:change="stockPointChanged">
                                     <option value="">Select </option>
                                     @foreach ($stockpoints as $stockpoint)
                                         <option value="{{ $stockpoint->id }}">{{ $stockpoint->name }}</option>
                                     @endforeach
                                 </select>
                                 @error('stock_point_id')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label>Bin Group <span class="text-danger">*</span></label>
                                 <select class="form-control" wire:model="bin_group_id"
                                 wire:change="binGroupChanged">
                                     <option value="">Select </option>
                                     @foreach ($bingroups as $bingroup)
                                         <option value="{{ $bingroup->id }}">{{ $bingroup->name }}</option>
                                     @endforeach
                                 </select>
                                 @error('bin_group_id')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                         </div>
                         <div class="col-md-12">
                            <div class="form-group">
                                <label>Bin <span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="bin_id"
                                wire:change="binGroupChanged">
                                    <option value="">Select </option>
                                    @foreach ($bins as $bin)
                                        <option value="{{ $bin->id }}">{{ $bin->name }}</option>
                                    @endforeach
                                </select>
                                @error('bin_id')
                                    <span class="text-danger error">{{ $message }}</span>
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
                 <h5 class="modal-title">Edit Bin </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 
                     <div class="modal-body">
                     <form wire:submit.prevent='update'>

<div class="row">
   <div class="col-md-12">
       <div class="form-group">
           <label>Item <span class="text-danger">*</span></label>
           <select class="form-control" wire:model="item_id"
              >
               <option value="">Select </option>
               @foreach ($items as $item)
                   <option value="{{ $item->id }}" {{$item->id==$item_id?'selected':null}}>{{ $item->description }}</option>
               @endforeach
           </select>
           @error('item_id')
               <span class="text-danger error">{{ $message }}</span>
           @enderror
       </div>

   </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Stock Point <span class="text-danger">*</span></label>
            <select class="form-control" wire:model="stock_point_id"
                wire:change="stockPointChanged">
                <option value="">Select </option>
                @foreach ($stockpoints as $stockpoint)
                    <option value="{{ $stockpoint->id }}" {{$stockpoint->id==$stock_point_id?'selected':null}}>{{ $stockpoint->name }}</option>
                @endforeach
            </select>
            @error('stock_point_id')
                <span class="text-danger error">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Bin Group <span class="text-danger">*</span></label>
            <select class="form-control" wire:model="bin_group_id"
            wire:change="binGroupChanged">
                <option value="">Select </option>
                @foreach ($bingroups as $bingroup)
                    <option value="{{ $bingroup->id }}" {{$bingroup->id ==$bin_group_id?'selected':null}}>{{ $bingroup->name }}</option>
                @endforeach
            </select>
            @error('bin_group_id')
                <span class="text-danger error">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="col-md-12">
       <div class="form-group">
           <label>Bin <span class="text-danger">*</span></label>
           <select class="form-control" wire:model="bin_id"
           wire:change="binGroupChanged">
               <option value="">Select </option>
               @foreach ($bins as $bin)
                   <option value="{{ $bin->id }}"  {{$bin->id  ==$bin_id?'selected':null}}>{{ $bin->name }}</option>
               @endforeach
           </select>
           @error('bin_id')
               <span class="text-danger error">{{ $message }}</span>
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
