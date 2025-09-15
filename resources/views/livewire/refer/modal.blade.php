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

<!-- Add  Modal -->
<div wire:ignore.self class="modal custom-modal fade" id="referPatient" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Refer Patient</h5>
                {{-- <input type="text" wire:model='isReferSame' /> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($latestPatientRefer != null)
                    <div class="row">
                        <div class="col-md-12">
                            <p>Patient Referal History</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-info">
                                        <th>S.N.</th>
                                        <th>Refer From</th>
                                        <th>Refer To</th>
                                        <th>Remarks</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patientVisit?->refers as $refer)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                {{ $refer?->department?->name }},
                                                {{ $refer?->unit?->name }} ,
                                                {{ $refer?->doctor?->name }}
                                            </td>
                                            <td>
                                                {{ $refer?->departmentto?->name }},
                                                {{ $refer?->unitto?->name }},
                                                {{ $refer?->doctorto?->name }}
                                            </td>
                                            <th>{{ $refer->remarks }}</th>
                                            <td>{{ $refer->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                @if ($isReferSame == true)
                    <p class="text-danger"> *Warning:Source and Desitination of Patient is same !</p>
                @endif

                <form wire:submit.prevent='saveReferPatient'>
                    <div class="row">
                        {{-- following condition is checkd because PatientVisit will be null until referPatient(patient_visit_id) method will be called  --}}
                        @if ($patientVisit != null)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>UMR <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly
                                        value="{{ $patientVisit?->patient?->registration_no }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly
                                        value="{{ $patientVisit?->patient?->name }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Visit Date <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly
                                        value="{{ $patientVisit->visit_date }}">
                                </div>
                            </div>
                        @endif
                        {{--  @if ($patientVisit != null) is colose here --}}
                    </div>

                    @if ($latestPatientRefer != null)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Department From <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly readonly
                                        value="{{ $latestPatientRefer?->departmentto?->name }}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Unit From<span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" readonly readonly
                                        value="{{ $latestPatientRefer?->unitto?->name }}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Doctor From <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" readonly readonly
                                        value="{{ $latestPatientRefer?->doctorto?->name }}">

                                </div>
                            </div>
                        </div>
                    @endif
                    {{--   @if ($latestPatientRefer != null) is closed here --}}

                    {{-- If  $latestPatientRefer==null means no refere exist for the patient visit i.e. Department/Unit/Dortor come for patientvisits table --}}

                    @if ($latestPatientRefer == null)
                        <div class="row">
                            {{-- following condition is checkd because PatientVisit will be null until referPatient(patient_visit_id) method will be called  --}}
                            @if ($patientVisit != null)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Department From <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" readonly readonly
                                            value="{{ $patientVisit?->department?->name }}">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Unit From<span class="text-danger">*</span></label>

                                        <input type="text" class="form-control" readonly readonly
                                            value="{{ $patientVisit?->unit?->name }}">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Doctor From <span class="text-danger">*</span></label>

                                        <input type="text" class="form-control" readonly readonly
                                            value="{{ $patientVisit->doctor != null ? $patientVisit?->doctor?->name : null }}">

                                    </div>
                                </div>
                            @endif
                            {{-- @if ($patientVisit != null)  is closed here --}}
                        </div>
                    @endif
                    {{-- @if ($latestPatientRefer == null) is closed here --}}

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Department To <span class="text-danger">*</span></label>
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

                        <div class="col-md-4">
                            @if ($this->department_id)
                                <div class="form-group">
                                    <label>Unit To <span class="text-danger">*</span></label>
                                    <select wire:model='unit_id' class="form-control" wire:change.lazy="unitChanged">
                                        <option value="">Select </option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            @if ($this->department_id && $this->unit_id)
                                <div class="form-group">
                                    <label>Doctor To<span class="text-danger">*</span></label>
                                    <select wire:model='doctor_id' wire:change='doctorChanged' class="form-control">
                                        <option value="">Select </option>
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('doctor_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks<span class="text-danger">*</span></label>
                                <textarea class="form-control" wire:model="remarks"></textarea>
                                @error('remarks')
                                    <span class="text-danger" row="3">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="ubmit-section mt-0 pt-0 text-center">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- /Add Modal -->
