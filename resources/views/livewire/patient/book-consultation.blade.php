<div>
    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Book Consultation {{ $lastConsultationDepartmentId }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Book Consultation</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.patient.consultation-list') }}" class="btn add-btn"><i
                            class="fa fa-plus"></i> All Consultation</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
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
                                                    <option value="">Select Department</option>
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
                                                <select wire:model='unit_id' class="form-control">
                                                    <option value="">Select Unit</option>
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
                                                    <label>FOC Approved By <span class="text-danger">*</span></label>
                                                    <select wire:model='foc_by_id' class="form-control" required>
                                                        <option value="">Select </option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}
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
                                                <select wire:model='visit_type_id' class="form-control" required>
                                                    <option value="">Select Visit Type </option>
                                                    @foreach ($visittypes as $visittype)
                                                        <option value="{{ $visittype->id }}">{{ $visittype->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('visit_type_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Remarks<span class="text-danger"> </label>
                                                <input type="text" class="form-control" wire:model="description">
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
        </div>
    </div>
</div>
<!-- /Page Content -->
</div>
