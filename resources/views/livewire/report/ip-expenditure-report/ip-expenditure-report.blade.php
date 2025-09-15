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
                            <h3 class="m-0">IP Expenditure Report</h3>
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
                                            <label>Admission No</label>
                                            <select class="form-control select2" name="ipd_id"
                                                data-placeholder="Select Admission No" wire:model="ipd_id">
                                                <option value=""></option>
                                                @foreach ($ipds as $ipd)
                                                    <option value="{{ $ipd->id }}">
                                                        {{ $ipd->ipdcode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('ipd_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Patient Name</label>
                                            <input type="text" class="form-control" wire:model="patient_name">
                                            @error('patient_name')
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
                                            <label>UMR No</label>
                                            <select class="form-control select2" name="umr"
                                                data-placeholder="Select UMR" wire:model="umr">
                                                <option value=""></option>
                                                @foreach ($patients as $patient)
                                                    <option value="{{ $patient->registration_no }}">
                                                        {{ $patient->registration_no }}</option>
                                                @endforeach
                                            </select>
                                            @error('umr')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Balance Amount B/W</label>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <input type="text" class="form-control"
                                                        wire:model="balance_start">
                                                </div>
                                                <div class="px-2">To</div>
                                                <div>
                                                    <input type="text" class="form-control"
                                                        wire:model="balance_last">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ward</label>
                                            <select class="form-control select2" name="ward_id" wire:model="ward_id">
                                                <option value="">All</option>
                                                @foreach ($wards as $ward)
                                                    <option value="{{ $ward->id }}">
                                                        {{ $ward->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('ward_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Admn Purpose</label>
                                            <select class="form-control" wire:model="admn_purpose_id">
                                                <option value="">All</option>
                                                @foreach ($admn_purposes as $admn_purpose)
                                                    <option value="{{ $admn_purpose->id }}">
                                                        {{ $admn_purpose->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('admn_purpose_id')
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

                                @if ($ip_expenditure_reports && count($ip_expenditure_reports) > 0)
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
                            <h5>Total Records : {{ count($ip_expenditure_reports) }}</h5>
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
                                        @foreach ($ip_expenditure_reports as $sr => $ip_expenditure_report)
                                            <tr>
                                                @foreach ($export_fields as $export_field_key => $export_field)
                                                    @switch($export_field_key)
                                                        @case('sr_no')
                                                            <td>{{ $sr + 1 }}</td>
                                                        @break

                                                        @case('umr')
                                                            <td>{{ $ip_expenditure_report?->patient?->registration_no }}</td>
                                                        @break

                                                        @case('patient_name')
                                                            <td>{{ $ip_expenditure_report?->patient?->name }}</td>
                                                        @break

                                                        @case('patient_type')
                                                            <td>
                                                                {{ $ip_expenditure_report?->patient?->patienttype?->name }}
                                                            </td>
                                                        @break

                                                        @case('area')
                                                            <td>
                                                                {{ $ip_expenditure_report?->patient?->is_rural ? 'Rural' : 'Urban' }}
                                                            </td>
                                                        @break

                                                        @case('ipd_code')
                                                            <td>{{ $ip_expenditure_report?->ipd?->ipdcode }}</td>
                                                        @break

                                                        @case('organization_name')
                                                            <td>
                                                                {{ $ip_expenditure_report?->ipd?->corporate_registration?->organization?->name }}
                                                            </td>
                                                        @break

                                                        @case('age')
                                                            <td>
                                                                {{ Carbon\Carbon::parse($ip_expenditure_report?->patient?->dob)->diff(Carbon\Carbon::now())->format('%yY') }}(s)
                                                            </td>
                                                        @break

                                                        @case('gender')
                                                            <td>{{ $ip_expenditure_report?->patient?->gender?->name }}</td>
                                                        @break

                                                        @case('address')
                                                            <td style="text-wrap:initial; min-width: 350px;">
                                                                {{ $ip_expenditure_report?->patient?->address }}
                                                            </td>
                                                        @break

                                                        @case('consult_no')
                                                            <td>{{ $ip_expenditure_report?->visit_no }}</td>
                                                        @break

                                                        @case('consult_date')
                                                            <td>{{ $ip_expenditure_report?->visit_date }}</td>
                                                        @break

                                                        @case('doctor_name')
                                                            <td>{{ $ip_expenditure_report?->doctor?->name }}</td>
                                                        @break

                                                        @case('visit_type')
                                                            <td>{{ $ip_expenditure_report?->visitType?->name }}</td>
                                                        @break

                                                        @case('department')
                                                            <td>{{ $ip_expenditure_report?->department?->name }}</td>
                                                        @break

                                                        @case('unit')
                                                            <td>{{ $ip_expenditure_report?->unit?->name }}</td>
                                                        @break

                                                        @case('consult_fee')
                                                            <td>{{ $ip_expenditure_report?->fee }}</td>
                                                        @break

                                                        @case('foc')
                                                            <td>{{ $ip_expenditure_report?->foc ? 'Yes' : 'No' }}</td>
                                                        @break

                                                        @case('consult_status')
                                                            <td>
                                                                {{ $ip_expenditure_report?->patient?->patientvisits?->count() > 1 ? 'Old' : 'New' }}
                                                            </td>
                                                        @break

                                                        @case('created_by')
                                                            <td>{{ $ip_expenditure_report?->created_by?->name }}</td>
                                                        @break

                                                        @case('created_at')
                                                            <td>{{ $ip_expenditure_report?->created_at }}</td>
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
        </script>
    @endpush
</div>
