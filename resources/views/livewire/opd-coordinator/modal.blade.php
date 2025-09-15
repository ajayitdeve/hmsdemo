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
<div wire:ignore.self class="modal custom-modal fade" id="assignDoctor" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif
                <form wire:submit.prevent='save'>
                    @if ($patientVisit != null)
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>UMR<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly
                                        value="{{ $patientVisit->patient->registration_no }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly
                                        value="{{ $patientVisit->patient->name }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Visit Date<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly
                                        value="{{ $patientVisit->visit_date }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Department<span class="text-danger">*</span></label>
                                    <select wire:model='department_id' class="form-control"
                                        wire:change="departmentChanged">
                                        <option value="">Select </option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('doctor_department_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Unit<span class="text-danger">*</span></label>
                                    <select wire:model='unit_id' class="form-control" wire:change.lazy="unitChanged">

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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Doctor<span class="text-danger">*</span></label>
                                    <select wire:model='doctor_id' class="form-control">
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
                            </div>
                        </div>
                    @endif
                    <div class="ubmit-section mt-0 pt-0 text-center">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Modal -->
