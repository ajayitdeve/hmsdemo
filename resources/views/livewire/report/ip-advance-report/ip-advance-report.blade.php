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
                            <h3 class="m-0">IP Advance Report</h3>
                        </div>

                        <div class="card-body">
                            <form wire:submit.prevent='show' class="mb-0 pb-0">

                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group border rounded px-3 pt-3 pb-2 border">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="patient_status"
                                                    id="admitted" value="admitted" wire:model="patient_status">

                                                <label class="form-check-label" for="admitted">Admitted</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="patient_status"
                                                    id="discharge" value="discharge" wire:model="patient_status">

                                                <label class="form-check-label" for="discharge">Discharge</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="patient_status"
                                                    id="both" value="both" wire:model="patient_status">

                                                <label class="form-check-label" for="both">Both</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group border rounded px-3 pt-3 pb-2 border">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="service_type"
                                                    id="called-off" value="called-off" wire:model="service_type">

                                                <label class="form-check-label" for="called-off">Called Off</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="service_type"
                                                    id="called-on" value="called-on" wire:model="service_type">

                                                <label class="form-check-label" for="called-on">Called On</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="service_type"
                                                    id="both" value="both" wire:model="service_type">

                                                <label class="form-check-label" for="both">Both</label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

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
                                            <input class="form-control" type="date" wire:model='from_date'>
                                            @error('from_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>To Date</label>
                                            <input class="form-control" type="date" wire:model='to_date'>
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

                                    @if ($selection_type == 'admission-no-wise')
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
                                    @endif

                                    @if ($selection_type == 'department-wise')
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

                                @if ($ip_advance_reports && count($ip_advance_reports) > 0)
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
                            <h5>Total Records : {{ count($ip_advance_reports) }}</h5>
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
                                        @foreach ($ip_advance_reports as $sr => $ip_advance_report)
                                            <tr>
                                                @foreach ($export_fields as $export_field_key => $export_field)
                                                    @switch($export_field_key)
                                                        @case('sr_no')
                                                            <td>{{ $sr + 1 }}</td>
                                                        @break

                                                        @case('umr')
                                                            <td>{{ $ip_advance_report?->patient?->registration_no }}</td>
                                                        @break

                                                        @case('patient_name')
                                                            <td>{{ $ip_advance_report?->patient?->name }}</td>
                                                        @break

                                                        @case('ipd_code')
                                                            <td>{{ $ip_advance_report?->ipd?->ipdcode }}</td>
                                                        @break

                                                        @case('admission_date')
                                                            <td>
                                                                {{ date('Y-m-d', strtotime($ip_advance_report?->ipd?->created_at)) }}
                                                            </td>
                                                        @break

                                                        @case('advance_amount')
                                                            <td>
                                                                {{ $ip_advance_report?->amount }}
                                                            </td>
                                                        @break

                                                        @case('doctor_name')
                                                            <td>{{ $ip_advance_report?->ipd?->patient_visit?->doctor?->name }}
                                                            </td>
                                                        @break

                                                        @case('department')
                                                            <td>{{ $ip_advance_report?->ipd?->department?->name }}</td>
                                                        @break

                                                        @case('unit')
                                                            <td>{{ $ip_advance_report?->ipd?->unit?->name }}</td>
                                                        @break

                                                        @case('ward')
                                                            <td>
                                                                {{ $ip_advance_report?->ipd?->ward?->name }}
                                                            </td>
                                                        @break

                                                        @case('patient_type')
                                                            <td>
                                                                {{ $ip_advance_report?->patient?->patienttype?->name }}
                                                            </td>
                                                        @break

                                                        @case('area')
                                                            <td>
                                                                {{ $ip_advance_report?->patient?->is_rural ? 'Rural' : 'Urban' }}
                                                            </td>
                                                        @break

                                                        @case('organization_name')
                                                            <td>
                                                                {{ $ip_advance_report?->ipd?->corporate_registration?->organization?->name }}
                                                            </td>
                                                        @break

                                                        @case('created_by')
                                                            <td>{{ $ip_advance_report?->created_by?->name }}</td>
                                                        @break

                                                        @case('created_at')
                                                            <td>{{ $ip_advance_report?->created_at }}</td>
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
