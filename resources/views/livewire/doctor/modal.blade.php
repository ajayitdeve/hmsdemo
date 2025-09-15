@push('page-css')
    <style>
        .form-control {
            font-size: 13px;
            height: 30px !important;
        }

        label {
            display: inline-block;
            margin-bottom: 0px;
            font-size: 13px;
        }
    </style>
@endpush
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
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Doctor</h5>
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()' aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('partials.alert-message')

                <form wire:submit.prevent='save'>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Consultation Type <span class="text-danger">*</span></label>
                                <select wire:model='consultation_type_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($consultationtypes as $consultationtype)
                                        <option value="{{ $consultationtype->id }}">{{ $consultationtype->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('consultation_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor Type <span class="text-danger">*</span></label>
                                <select wire:model='doctor_type_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($doctortypes as $doctortype)
                                        <option value="{{ $doctortype->id }}">{{ $doctortype->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('doctor_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Consulting Type <span class="text-danger">*</span></label>
                                <select wire:model='consulting_type_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($consultingtypes as $consultingtype)
                                        <option value="{{ $consultingtype->id }}">{{ $consultingtype->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('consulting_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Department <span class="text-danger">*</span></label>
                                <select wire:model='department_id' class="form-control" wire:change="departmentChanged">
                                    <option value="">Select </option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Unit <span class="text-danger">*</span></label>
                                <select wire:model='unit_id' class="form-control">
                                    <option value="">Select unit</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">
                                            {{ $unit->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Payment Type <span class="text-danger">*</span></label>
                                <select wire:model='payment_type_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($paymenttypes as $paymenttype)
                                        <option value="{{ $paymenttype->id }}">{{ $paymenttype->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('payment_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" readonly wire:model='code' />
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Title<span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="title_id" autofocus wire:change="titleChanged">
                                    <option value="">Select</option>
                                    @foreach ($titles as $title)
                                        <option value="{{ $title->id }}">{{ $title->name }}</option>
                                    @endforeach
                                </select>
                                @error('title_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model='name' />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Alias</label>
                                <input type="text" class="form-control" wire:model='alias' />
                                @error('alias')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Registration No. <span class="text-danger">*</span></label>
                                <input type="test" class="form-control" wire:model='registration_no' />
                                @error('registration_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Designation<span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" wire:model='designation' />
                                @error('designation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Cost Center <span class="text-danger">*</span></label>
                                <select wire:model='cost_center_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($costcenters as $costcenter)
                                        <option value="{{ $costcenter->id }}">{{ $costcenter->code }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cost_center_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Specialization<span class="text-danger">*</span></label>
                                <select wire:model='specialization_id' class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($specializations as $specialization)
                                        <option value="{{ $specialization->id }}">{{ $specialization->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('specialization_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Specialization-1 </label>
                                <select wire:model='specialization1' class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($specializations as $specialization)
                                        <option value="{{ $specialization->id }}">{{ $specialization->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('specialization1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Specialization-2 </label>
                                <select wire:model='specialization2' class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($specializations as $specialization)
                                        <option value="{{ $specialization->id }}">{{ $specialization->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('specialization2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Qualification </label>
                                <input type="text" wire:model='qualification' class="form-control">

                                @error('qualification')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Consulting Room</label>
                                <input type="number" class="form-control" wire:model='consulting_room'
                                    min="0" max="500" />
                                @error('consulting_room')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Gender <span class="text-danger">*</span></label>
                                <select wire:model='gender_id' class="form-control" wire:change="genderChanged">
                                    <option value="">Select </option>
                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender->id }}">{{ $gender->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('gender_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>DOB</label>
                                <input type="date" class="form-control" wire:model='dob' />
                                @error('dob')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Marrige Date</label>
                                <input type="date" class="form-control" wire:model='marriage_date' />
                                @error('marriage_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Experience</label>
                                <input type="text" class="form-control" wire:model='experience' />
                                @error('experience')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mobile
                                    {{-- <span class="text-danger">*</span> --}}
                                </label>
                                <input class="form-control" wire:model="mobile"
                                    onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                    type="tel" maxlength="10" pattern="[0-9]{10}"
                                    title="10 digit mobile number">
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Email Id</label>
                                <input type="email" class="form-control" wire:model='email' />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model='password' />
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>DOJ</label>
                                <input type="date" class="form-control" wire:model='doj' />
                                @error('doj')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Resigned Date</label>
                                <input type="date" class="form-control" wire:model='resigned_date' />
                                @error('resigned_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor Fee</label>
                                <input type="number" class="form-control" wire:model='fee' min="0" />
                                @error('fee')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>About Doctor</label>
                                <textarea rows="2" class="form-control" wire:model='about_doctor'></textarea>
                                @error('about_doctor')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea rows="2" class="form-control" wire:model='address'></textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="submit-section mt-0 pt-0 text-center">
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
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Doctor </h5>
                <button type="button" class="close" wire:click='closeModal()' data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('partials.alert-message')

                <form wire:submit.prevent='update'>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Consultation Type <span class="text-danger">*</span></label>
                                <select wire:model='consultation_type_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($consultationtypes as $consultationtype)
                                        <option value="{{ $consultationtype->id }}">{{ $consultationtype->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('consultation_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor Type <span class="text-danger">*</span></label>
                                <select wire:model='doctor_type_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($doctortypes as $doctortype)
                                        <option value="{{ $doctortype->id }}">{{ $doctortype->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('doctor_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Consulting Type <span class="text-danger">*</span></label>
                                <select wire:model='consulting_type_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($consultingtypes as $consultingtype)
                                        <option value="{{ $consultingtype->id }}">{{ $consultingtype->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('consulting_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Department <span class="text-danger">*</span></label>
                                <select wire:model='department_id' class="form-control"
                                    wire:change="departmentChanged">
                                    <option value="">Select </option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Unit <span class="text-danger">*</span></label>
                                <select wire:model='unit_id' class="form-control">
                                    <option value="">Select unit</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">
                                            {{ $unit->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Payment Type <span class="text-danger">*</span></label>
                                <select wire:model='payment_type_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($paymenttypes as $paymenttype)
                                        <option value="{{ $paymenttype->id }}">{{ $paymenttype->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('payment_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" readonly wire:model='code' />
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Title<span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="title_id" autofocus
                                    wire:change="titleChanged">
                                    <option value="">Select</option>
                                    @foreach ($titles as $title)
                                        <option value="{{ $title->id }}">{{ $title->name }}</option>
                                    @endforeach
                                </select>
                                @error('title_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model='name' />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Alias</label>
                                <input type="text" class="form-control" wire:model='alias' />
                                @error('alias')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Registration No. <span class="text-danger">*</span></label>
                                <input type="test" class="form-control" wire:model='registration_no' />
                                @error('registration_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Designation<span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" wire:model='designation' />
                                @error('designation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Cost Center <span class="text-danger">*</span></label>
                                <select wire:model='cost_center_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($costcenters as $costcenter)
                                        <option value="{{ $costcenter->id }}">{{ $costcenter->code }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cost_center_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Specialization<span class="text-danger">*</span></label>
                                <select wire:model='specialization_id' class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($specializations as $specialization)
                                        <option value="{{ $specialization->id }}">{{ $specialization->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('specialization_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Specialization-1 </label>
                                <select wire:model='specialization1' class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($specializations as $specialization)
                                        <option value="{{ $specialization->id }}">{{ $specialization->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('specialization1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Specialization-2 </label>
                                <select wire:model='specialization2' class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($specializations as $specialization)
                                        <option value="{{ $specialization->id }}">{{ $specialization->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('specialization2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Qualification </label>
                                <input type="text" wire:model='qualification' class="form-control">

                                @error('qualification')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Consulting Room</label>
                                <input type="number" class="form-control" wire:model='consulting_room'
                                    min="0" max="500" />
                                @error('consulting_room')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Gender <span class="text-danger">*</span></label>
                                <select wire:model='gender_id' class="form-control" wire:change="genderChanged">
                                    <option value="">Select </option>
                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender->id }}">{{ $gender->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('gender_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>DOB</label>
                                <input type="date" class="form-control" wire:model='dob' />
                                @error('dob')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Marrige Date</label>
                                <input type="date" class="form-control" wire:model='marriage_date' />
                                @error('marriage_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Experience</label>
                                <input type="text" class="form-control" wire:model='experience' />
                                @error('experience')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mobile
                                    {{-- <span class="text-danger">*</span> --}}
                                </label>
                                <input class="form-control" wire:model="mobile"
                                    onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                    type="tel" maxlength="10" pattern="[0-9]{10}"
                                    title="10 digit mobile number">
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Email Id</label>
                                <input type="email" class="form-control" wire:model='email' />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>DOJ</label>
                                <input type="date" class="form-control" wire:model='doj' />
                                @error('doj')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Resigned Date</label>
                                <input type="date" class="form-control" wire:model='resigned_date' />
                                @error('resigned_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor Fee</label>
                                <input type="number" class="form-control" wire:model='fee' min="0" />
                                @error('fee')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>About Doctor</label>
                                <textarea rows="2" class="form-control" wire:model='about_doctor'></textarea>
                                @error('about_doctor')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea rows="2" class="form-control" wire:model='address'></textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="submit-section mt-0 pt-0 text-center">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Modal -->
