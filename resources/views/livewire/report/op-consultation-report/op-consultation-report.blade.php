<div>
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

            .custom-control-label::before,
            .custom-control-label::after {
                top: .05rem;
            }
        </style>
    @endpush

    <!-- Page Content -->
    <div class="content container-fluid mb-0 pb-0">
        <div class="row mb-0 pb-0">
            <div class="col-md-12 mb-0 pb-0">
                @include('partials.alert-message')

                <div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="m-0">OP Consultation Report</h3>
                        </div>

                        <div class="card-body">
                            <form wire:submit.prevent='show' class="mb-0 pb-0">

                                <div class="row mb-0 pb-0">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Selection Type <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="selection_type"
                                                wire:change="selectionTypeChanged">
                                                @foreach ($selection_types as $selection_type_key => $selection_type_value)
                                                    <option value="{{ $selection_type_key }}">
                                                        {{ $selection_type_value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('selection_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>From Date</label>
                                            <input class="form-control" type="datetime-local" wire:model='from_date'>
                                            @error('from_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>To Date</label>
                                            <input class="form-control" type="datetime-local" wire:model='to_date'>
                                            @error('to_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Patient Type <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="patient_type_id">
                                                <option value="">All</option>
                                                @foreach ($patient_types as $patient_type)
                                                    <option value="{{ $patient_type->id }}">
                                                        {{ $patient_type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('patient_type_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    @if ($selection_type == 'patient-wise')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Patient Name</label>
                                                <input type="text" class="form-control" wire:model="patient_name">
                                                @error('patient_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    @if ($selection_type == 'consultant-wise')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Consultant</label>
                                                <select class="form-control select2" name="consultant_id"
                                                    wire:model="consultant_id">
                                                    <option value="">All</option>
                                                    @foreach ($consultants as $consultant)
                                                        <option value="{{ $consultant->id }}">
                                                            {{ $consultant->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('consultant_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    @if ($selection_type == 'referral-wise')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Referral</label>
                                                <select class="form-control" wire:model="referralmenu_id"
                                                    wire:change="referralmenuChanged">
                                                    <option value="">Select Referral</option>
                                                    @foreach ($referralmenus as $referralmenu)
                                                        <option value="{{ $referralmenu['id'] }}">
                                                            {{ $referralmenu['name'] }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @error('referralmenu_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        @if ($referralmenu_id && $referralmenu_id != 1 && $referralmenu_id != 5)
                                            <div class="col-sm-6 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label>Select {{ $referralmenuname }}</label>
                                                    <select class="form-control" wire:model="referral_id">
                                                        <option value="">Select {{ $referralmenuname }}</option>
                                                        @foreach ($referrals as $referral)
                                                            <option value="{{ $referral->id }}">
                                                                {{ $referral->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('referral_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                    @endif

                                    @if ($selection_type == 'department-wise' || $selection_type == 'unit-wise' || $selection_type == 'inpatient-register')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select class="form-control select2" name="department_id"
                                                    wire:model="department_id">
                                                    <option value="">All</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}">
                                                            {{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('department_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    @if ($selection_type == 'unit-wise')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Unit</label>
                                                <select class="form-control select2" name="unit_id"
                                                    data-placeholder="Select Unit" wire:model="unit_id">
                                                    <option value=""></option>
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
                                    @endif

                                    @if ($selection_type == 'user-wise')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>User</label>
                                                <select class="form-control select2" name="user_id"
                                                    wire:model="user_id">
                                                    <option value="">All</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('user_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    @if ($selection_type == 'consultation-no-wise')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Consultation No</label>
                                                <input type="text" class="form-control" wire:model="consultation_no">
                                                @error('consultation_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    @if ($selection_type == 'city-wise')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>City</label>
                                                <select class="form-control select2" name="district_id"
                                                    wire:model="district_id">
                                                    <option value="">All</option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district->id }}">
                                                            {{ $district->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('district_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    @if ($selection_type == 'organization-wise')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Organization</label>
                                                <select class="form-control select2" name="organization_id"
                                                    wire:model="organization_id">
                                                    <option value="">All</option>
                                                    @foreach ($organizations as $organization)
                                                        <option value="{{ $organization->id }}">
                                                            {{ $organization->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('organization_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Cons Status <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="visit_type">
                                                <option value="new">New</option>
                                                <option value="old">Old</option>
                                                <option value="both">Both</option>
                                            </select>
                                            @error('visit_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Area <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="area">
                                                <option value="">Both</option>
                                                <option value="0">Urban</option>
                                                <option value="1">Rural</option>
                                            </select>
                                            @error('area')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Visit Type <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="visit_type_id">
                                                <option value="">All</option>
                                                @foreach ($visit_types as $visit_type)
                                                    <option value="{{ $visit_type->id }}">
                                                        {{ $visit_type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('visit_type_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sorting Order <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="sorting_order">
                                                <option value="asc">Ascending</option>
                                                <option value="desc">Descending</option>
                                            </select>
                                            @error('sorting_order')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Cost Center <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="cost_center_id">
                                                @foreach ($cost_centers as $cost_center)
                                                    <option value="{{ $cost_center->id }}">
                                                        {{ $cost_center->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('cost_center_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Export Fields <span class="text-danger">*</span></label>

                                            <div class="mt-1">
                                                @foreach ($selected_export_fields as $key)
                                                    <span class="badge badge-primary font-weight-normal">
                                                        {{ $export_fields["$key"] }}
                                                    </span>
                                                @endforeach
                                            </div>

                                            <div class="row mt-2">
                                                @foreach ($export_fields as $key => $export_field)
                                                    <div class="col-md-3">
                                                        <div class="">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="ex-{{ $key }}"
                                                                    value="{{ $key }}"
                                                                    wire:model="selected_export_fields">
                                                                <label class="custom-control-label"
                                                                    for="ex-{{ $key }}">
                                                                    {{ $export_field }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>

                                @if ($op_consultation_reports && count($op_consultation_reports) > 0)
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="false">
                                            Export
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" wire:click="exportPdf">Pdf</button>
                                            <button class="dropdown-item" wire:click="exportExcel">Excel</button>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h5>Total Records : {{ count($op_consultation_reports) }}</h5>
                        </div>

                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table table-sm mb-0">
                                    <thead>
                                        <tr>
                                            @foreach ($export_fields as $export_field)
                                                <th>{{ $export_field }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($op_consultation_reports as $sr => $op_consultation_report)
                                            <tr>
                                                @foreach ($export_fields as $export_field_key => $export_field)
                                                    @switch($export_field_key)
                                                        @case('sr_no')
                                                            <td>{{ $sr + 1 }}</td>
                                                        @break

                                                        @case('umr')
                                                            <td>{{ $op_consultation_report?->patient?->registration_no }}</td>
                                                        @break

                                                        @case('patient_name')
                                                            <td>{{ $op_consultation_report?->patient?->name }}</td>
                                                        @break

                                                        @case('patient_type')
                                                            <td>
                                                                {{ $op_consultation_report?->patient?->patienttype?->name }}
                                                            </td>
                                                        @break

                                                        @case('area')
                                                            <td>
                                                                {{ $op_consultation_report?->patient?->is_rural ? 'Rural' : 'Urban' }}
                                                            </td>
                                                        @break

                                                        @case('ipd_code')
                                                            <td>{{ $op_consultation_report?->ipd?->ipdcode }}</td>
                                                        @break

                                                        @case('organization_name')
                                                            <td>
                                                                {{ $op_consultation_report?->ipd?->corporate_registration?->organization?->name }}
                                                            </td>
                                                        @break

                                                        @case('age')
                                                            <td>
                                                                {{ Carbon\Carbon::parse($op_consultation_report?->patient?->dob)->diff(Carbon\Carbon::now())->format('%yY') }}(s)
                                                            </td>
                                                        @break

                                                        @case('gender')
                                                            <td>{{ $op_consultation_report?->patient?->gender?->name }}</td>
                                                        @break

                                                        @case('address')
                                                            <td style="text-wrap:initial; min-width: 350px;">
                                                                {{ $op_consultation_report?->patient?->address }}
                                                            </td>
                                                        @break

                                                        @case('consult_no')
                                                            <td>{{ $op_consultation_report?->visit_no }}</td>
                                                        @break

                                                        @case('consult_date')
                                                            <td>{{ $op_consultation_report?->visit_date }}</td>
                                                        @break

                                                        @case('doctor_name')
                                                            <td>{{ $op_consultation_report?->doctor?->name }}</td>
                                                        @break

                                                        @case('visit_type')
                                                            <td>{{ $op_consultation_report?->visitType?->name }}</td>
                                                        @break

                                                        @case('department')
                                                            <td>{{ $op_consultation_report?->department?->name }}</td>
                                                        @break

                                                        @case('unit')
                                                            <td>{{ $op_consultation_report?->unit?->name }}</td>
                                                        @break

                                                        @case('consult_fee')
                                                            <td>{{ $op_consultation_report?->fee }}</td>
                                                        @break

                                                        @case('foc')
                                                            <td>{{ $op_consultation_report?->foc ? 'Yes' : 'No' }}</td>
                                                        @break

                                                        @case('consult_status')
                                                            <td>
                                                                {{ $op_consultation_report?->patient?->patientvisits?->count() > 1 ? 'Old' : 'New' }}
                                                            </td>
                                                        @break

                                                        @case('created_by')
                                                            <td>{{ $op_consultation_report?->created_by?->name }}</td>
                                                        @break

                                                        @case('created_at')
                                                            <td>{{ $op_consultation_report?->created_at }}</td>
                                                        @break
                                                    @endswitch
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('page-script')
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    width: '100%',
                });
            });

            $(document).on("change", ".select2", function() {
                let input_name = $(this).attr("name");
                @this.set(input_name, $(this).val());
            });

            $(document).on("change", "select[name='department_id']", function() {
                @this.call("departmentChanged");
            });
        </script>
    @endpush
</div>
