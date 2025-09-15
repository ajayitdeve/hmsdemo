<div>

    <div>
        <form wire:submit.prevent='saveConsultation'>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h2>Revisit Consultation</h2>
                        </div>

                    </div>

                </div>


                <div class="card-body">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">UMR No</label>
                                <input type="text" class="form-control" wire:model="umr" wire:change="umrChanged"
                                    required />
                            </div>

                        </div>
                        <div class="col-md-9">
                            <div class="card">

                                <div class="card-body">
                                    <div class="row pb-0 mb-0">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Patient's Name :
                                                    {{ $name != null ? $name : null }}</label>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Doctor's Name :
                                                    {{ $doctor_name != null ? $doctor_name : null }}</label>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Department :
                                                    {{ $doctor_department != null ? $doctor_department : null }}
                                                </label>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Unit :
                                                    {{ $doctor_unit != null ? $doctor_unit : null }}</label>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Father's Name :
                                                {{ $father_name != null ? $father_name : null }}</label>

                                        </div>
                                        @if ($id_type_id != null)
                                            <div class="col-md-4">
                                                <label> {{ $patient->idType->name }}: {{ $identification_no }}</label>

                                            </div>
                                        @endif
                                        <div class="col-md-12">
                                            <label>Address : {{ $address }}</label>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <table class="datatable table table-stripped mb-0 dataTable no-footer">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>UMR</th>
                                        <th>Consultation No.</th>
                                        <th>Visit Type</th>
                                        <th>Visit Date</th>
                                        <th>Unit</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($patient != null && $patient->patientvisits != null)
                                        @foreach ($patient->patientvisits as $patientvisit)
                                            <tr>
                                                <td>{{ $patientvisit->patient->name }}</td>
                                                <td>{{ $patientvisit->patient->registration_no }}</td>
                                                <td>{{ $patientvisit->visit_no }}</td>
                                                <td>{{ $patientvisit->visit_type == 1 ? 'Paid' : 'Free' }} /
                                                    {{ $patientvisit->visitType != null ? $patientvisit->visitType->name : null }}
                                                </td>
                                                <td>{{ $patientvisit->visit_date }}</td>
                                                <td>{{ $patientvisit->unit->name }}</td>
                                                <td> <a target="_blank"
                                                        href="{{ route('admin.patient.print-receipt', $patientvisit->id) }}"
                                                        class="btn add-btn btn-sm"><i class="fa fa-print-md"></i>Print
                                                        Receipt </button></td>




                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="modal-title p-0 m-0">Book Consultation</h3>
                            <hr />
                            <div>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if ($isDuplicateConsultation)
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="text-danger text-center">Error-Duplicate Consultation !</h3>
                                    </div>
                                </div>
                            @else
                                @if (isset($patient))
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
                                                    <select wire:model='department_id' class="form-control"
                                                        wire:change="department_changed">
                                                        <option value="">Select Department </option>
                                                        @foreach ($departments as $department)
                                                            <option value="{{ $department->id }}">
                                                                {{ $department->department->name }}</option>
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
                                                            <option value="{{ $unit->id }}">{{ $unit->name }}
                                                            </option>
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
                                                    <input type="checkbox" class="form-control" wire:model="foc">
                                                </div>
                                            </div>
                                            @if ($foc)
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>FOC Approved By <span
                                                                class="text-danger">*</span></label>
                                                        <select wire:model='foc_by_id' class="form-control" required>
                                                            <option value="">Select </option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}">
                                                                    {{ $user->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Fee </label>
                                                    <input type="number" class="form-control" readonly
                                                        wire:model="department_consultation_fee">

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Visit Type <span class="text-danger">*</span></label>
                                                    <select wire:model='visit_type_id' class="form-control">
                                                        <option value="">Select Visit Type </option>
                                                        @foreach ($visittypes as $visittype)
                                                            <option value="{{ $visittype->id }}">
                                                                {{ $visittype->name }}
                                                            </option>
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
        </form>
    </div>
</div>
