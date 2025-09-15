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
                 <h5 class="modal-title">Add Doctor</h5>
                 <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()'
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent='save'>
                     <div class="row">

                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Name<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" wire:model='name' />
                                 @error('name')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Email<span class="text-danger">*</span></label>
                                 <input type="email" class="form-control" wire:model='email' />
                                 @error('email')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Mobile<span class="text-danger">*</span></label>
                                 <input type="tel" class="form-control" wire:model='mobile' />
                                 @error('mobile')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                     </div>


                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Consultation Fee (Rs.)<span class="text-danger">*</span></label>
                                 <input type="number" class="form-control" wire:model='charge' />
                                 @error('charge')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Experience<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" wire:model='experience' />
                                 @error('experience')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                     </div>


                     <div class="form-group">
                         <label>About Doctor</label>
                         <textarea rows="2" class="form-control" style="height: 50px !important;" wire:model='about_doctor'></textarea>
                         @error('about_doctor')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
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

 <!-- /Edit Modal -->

 <!--book Consultation-->

 {{-- <div wire:ignore.self class="modal custom-modal fade" id="consultation" role="dialog"> --}}
 <div wire:ignore.self class="modal custom-modal fade" id="consultation" role="dialog">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title p-0 m-0">Book Consultation </h5>
                 <button type="button" class="close" wire:click='closeModal()' data-dismiss="modal"
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
                 @if ($isDuplicateConsultation)
                     <div class="row">
                         <div class="col-md-12">
                             <h3 class="text-danger text-center">Error-Duplicate Consultation !</h3>
                         </div>
                     </div>
                 @else
                 @if(isset($patient))
                     <form wire:submit.prevent='saveConsultation'>
                         <div class="row">
                             <div class="col-md-4">
                                 <label>Reg. No : {{ $registration_no }}</label>
                             </div>
                             <div class="col-md-4">
                                <label>Name : {{ $name }}</label>
                            </div>
                            <div class="col-md-4">
                                <label>{{ $relation_name }} : {{ $father_name }}</label>
                            </div>
                         </div>

                         <div class="row">


                             <div class="col-md-4">
                                 <label>Age : <small>{{ $age }}</small> </label>

                             </div>
                             <div class="col-md-4">
                                 <label>Address : <small>{{ $address }}</small></label>
                             </div>


                             <div class="col-md-4">
                                 <label>Mother Name: {{ $mother_name }}</label>
                             </div>

                         </div>
                         <hr />

                         <div class="row">

                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Consult. Dept. <span class="text-danger">*</span></label>
                                     <select wire:model.lazy='department_id' class="form-control"
                                         wire:change="department_changed">
                                         <option value="">Select Department </option>
                                         @foreach ($departments as $department)
                                             <option value="{{ $department->id }}" @if($departmentId==$department->id) selected @endif > {{ $department->department->name }}</option>
                                         @endforeach
                                     </select>
                                     @error('department_id')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                 </div>
                             </div>

                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Unit <span class="text-danger">*</span></label>
                                     <select wire:model.lazy='unit_id' class="form-control">
                                         @foreach ($units as $unit)
                                             <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                         @endforeach
                                     </select>
                                     @error('unit_id')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                 </div>
                             </div>
                         </div>
                         <div class="row">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label> Is FOC</label>
                                     <input type="checkbox" class="form-control"  wire:model="foc">
                                </div>
                            </div>
                            @if($foc)
                            <div class="col-md-5">
                                <div class="form-group" >
                                    <label>FOC Approved By <span class="text-danger">*</span></label>
                                    <select wire:model='foc_by_id' class="form-control" required
                                       >
                                        <option value="">Select </option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            @endif

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Fee </label>
                                     <input type="number" class="form-control" readonly wire:model="department_consultation_fee">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Visit Type <span class="text-danger">*</span></label>
                                    <select wire:model='visit_type_id' class="form-control"
                                       >
                                        <option value="">Select Visit Type </option>
                                        @foreach ($visittypes as $visittype)
                                            <option value="{{ $visittype->id }}">{{ $visittype->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('visit_type_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                         </div>

                         <div class=" submit-section">
                             <button class="btn btn-primary submit-btn">Book Consultation</button>
                         </div>


                     </form>
                 @endif
                 @endif

             </div>
         </div>
     </div>
     <!--end of book consultation -->
