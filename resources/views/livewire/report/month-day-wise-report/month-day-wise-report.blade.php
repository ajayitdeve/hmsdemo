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
                            <h3 class="m-0">Month Day Wise Report</h3>
                        </div>

                        <div class="card-body">
                            <form wire:submit.prevent='show' class="mb-0 pb-0">

                                <div class="row mb-0 pb-0">

                                    <div class="col-md-5">
                                        <div class="form-group border rounded px-3 pt-3 pb-2 border">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="report_type"
                                                    id="day-wise" value="day-wise" wire:model="report_type"
                                                    wire:change='reportTypeChanged'>

                                                <label class="form-check-label" for="day-wise">Day Wise</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="report_type"
                                                    id="month-wise" value="month-wise" wire:model="report_type"
                                                    wire:change='reportTypeChanged'>

                                                <label class="form-check-label" for="month-wise">Month Wise</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="report_type"
                                                    id="year-wise" value="year-wise" wire:model="report_type"
                                                    wire:change='reportTypeChanged'>

                                                <label class="form-check-label" for="year-wise">Year Wise</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-7">
                                        <div class="form-group border rounded px-3 pt-3 pb-2 border">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="registrations" value="registrations" wire:model="type"
                                                    wire:change='typeChanged'>

                                                <label class="form-check-label"
                                                    for="registrations">Registrations</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="admissions" value="admissions" wire:model="type"
                                                    wire:change='typeChanged'>

                                                <label class="form-check-label" for="admissions">Admissions</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="consultations" value="consultations" wire:model="type"
                                                    wire:change='typeChanged'>

                                                <label class="form-check-label"
                                                    for="consultations">Consultations</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="discharges" value="discharges" wire:model="type"
                                                    wire:change='typeChanged'>

                                                <label class="form-check-label" for="discharges">Discharges</label>
                                            </div>
                                        </div>
                                    </div>

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

                                    @if ($selection_type == 'consultant-wise' || $selection_type == 'consultant-wise-all-transaction')
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

                                    @if ($selection_type == 'department-wise' || $selection_type == 'department-wise-all-transaction')
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

                                    @if ($type == 'admissions')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Admin Type <span class="text-danger">*</span></label>
                                                <select class="form-control" wire:model="admin_type_id">
                                                    <option value="">All</option>
                                                    @foreach ($admin_types as $admin_type)
                                                        <option value="{{ $admin_type->id }}">
                                                            {{ $admin_type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('admin_type_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    @if ($type == 'consultations')
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
                                    @endif

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
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>

                                @if ($month_day_wise_reports && count($month_day_wise_reports) > 0)
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
                            <h5>Total Records : {{ count($month_day_wise_reports) }}</h5>
                        </div>

                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table table-sm mb-0">
                                    <thead>
                                        @switch($selection_type)
                                            @case('user-wise')
                                                @switch($type)
                                                    @case('registrations')
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>User Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Registration Fee</th>
                                                        </tr>
                                                    @break

                                                    @case('admissions')
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>User Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                        </tr>
                                                    @break

                                                    @case('consultations')
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>User Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Total Amount</th>
                                                        </tr>
                                                    @break

                                                    @case('discharges')
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>User Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Total Amount</th>
                                                        </tr>
                                                    @break
                                                @endswitch
                                            @break

                                            @case('consultant-wise')
                                                @switch($type)
                                                    @case('registrations')
                                                        {{-- <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Doctor Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Registration Fee</th>
                                                        </tr> --}}
                                                    @break

                                                    @case('admissions')
                                                        {{-- <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Doctor Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                        </tr> --}}
                                                    @break

                                                    @case('consultations')
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Doctor Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Total Amount</th>
                                                        </tr>
                                                    @break

                                                    @case('discharges')
                                                        {{-- <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Doctor Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Total Amount</th>
                                                        </tr> --}}
                                                    @break
                                                @endswitch
                                            @break

                                            @case('department-wise')
                                                @switch($type)
                                                    @case('registrations')
                                                        {{-- <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Department Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Registration Fee</th>
                                                        </tr> --}}
                                                    @break

                                                    @case('admissions')
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Department Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                        </tr>
                                                    @break

                                                    @case('consultations')
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Department Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Total Amount</th>
                                                        </tr>
                                                    @break

                                                    @case('discharges')
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Department Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Total Amount</th>
                                                        </tr>
                                                    @break
                                                @endswitch
                                            @break

                                            @case('consultant-wise-all-transaction')
                                                @switch($type)
                                                    @case('registrations')
                                                        {{-- <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Doctor Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Registration Fee</th>
                                                        </tr> --}}
                                                    @break

                                                    @case('admissions')
                                                        {{-- <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Doctor Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                        </tr> --}}
                                                    @break

                                                    @case('consultations')
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Doctor Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Total Amount</th>
                                                            <th>Discount Amount</th>
                                                        </tr>
                                                    @break

                                                    @case('discharges')
                                                        {{-- <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Doctor Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Total Amount</th>
                                                        </tr> --}}
                                                    @break
                                                @endswitch
                                            @break

                                            @case('department-wise-all-transaction')
                                                @switch($type)
                                                    @case('registrations')
                                                        {{-- <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Department Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Registration Fee</th>
                                                        </tr> --}}
                                                    @break

                                                    @case('admissions')
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Department Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                        </tr>
                                                    @break

                                                    @case('consultations')
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Department Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Total Amount</th>
                                                            <th>Discount Amount</th>
                                                        </tr>
                                                    @break

                                                    @case('discharges')
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Department Name</th>
                                                            <th>Day</th>
                                                            <th>Count</th>
                                                            <th>Total Amount</th>
                                                        </tr>
                                                    @break
                                                @endswitch
                                            @break

                                        @endswitch
                                    </thead>
                                    <tbody>
                                        @switch($selection_type)
                                            @case('user-wise')
                                                @switch($type)
                                                    @case('registrations')
                                                        @foreach ($month_day_wise_reports as $sr => $user_wise_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $user_wise_report->user_name }}</td>
                                                                <td>{{ $user_wise_report->day }}</td>
                                                                <td>{{ $user_wise_report->count }}</td>
                                                                <td>0</td>
                                                            </tr>
                                                        @endforeach
                                                    @break

                                                    @case('admissions')
                                                        @foreach ($month_day_wise_reports as $sr => $user_wise_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $user_wise_report->user_name }}</td>
                                                                <td>{{ $user_wise_report->day }}</td>
                                                                <td>{{ $user_wise_report->count }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @break

                                                    @case('consultations')
                                                        @foreach ($month_day_wise_reports as $sr => $user_wise_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $user_wise_report->user_name }}</td>
                                                                <td>{{ $user_wise_report->day }}</td>
                                                                <td>{{ $user_wise_report->count }}</td>
                                                                <td>{{ $user_wise_report->total_amount }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @break

                                                    @case('discharges')
                                                    @break

                                                @endswitch
                                            @break

                                            @case('consultant-wise')
                                                @switch($type)
                                                    @case('registrations')
                                                        {{-- @foreach ($month_day_wise_reports as $sr => $consultant_wise_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $consultant_wise_report->doctor_name }}</td>
                                                                <td>{{ $consultant_wise_report->day }}</td>
                                                                <td>{{ $consultant_wise_report->count }}</td>
                                                                <td>0</td>
                                                            </tr>
                                                        @endforeach --}}
                                                    @break

                                                    @case('admissions')
                                                        {{-- @foreach ($month_day_wise_reports as $sr => $consultant_wise_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $consultant_wise_report->doctor_name }}</td>
                                                                <td>{{ $consultant_wise_report->day }}</td>
                                                                <td>{{ $consultant_wise_report->count }}</td>
                                                            </tr>
                                                        @endforeach --}}
                                                    @break

                                                    @case('consultations')
                                                        @foreach ($month_day_wise_reports as $sr => $consultant_wise_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $consultant_wise_report->doctor_name }}</td>
                                                                <td>{{ $consultant_wise_report->day }}</td>
                                                                <td>{{ $consultant_wise_report->count }}</td>
                                                                <td>{{ $consultant_wise_report->total_amount }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @break

                                                    @case('discharges')
                                                    @break

                                                @endswitch
                                            @break

                                            @case('department-wise')
                                                @switch($type)
                                                    @case('registrations')
                                                        {{-- @foreach ($month_day_wise_reports as $sr => $department_wise_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $department_wise_report->department_name }}</td>
                                                                <td>{{ $department_wise_report->day }}</td>
                                                                <td>{{ $department_wise_report->count }}</td>
                                                                <td>0</td>
                                                            </tr>
                                                        @endforeach --}}
                                                    @break

                                                    @case('admissions')
                                                        @foreach ($month_day_wise_reports as $sr => $department_wise_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $department_wise_report->department_name }}</td>
                                                                <td>{{ $department_wise_report->day }}</td>
                                                                <td>{{ $department_wise_report->count }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @break

                                                    @case('consultations')
                                                        @foreach ($month_day_wise_reports as $sr => $department_wise_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $department_wise_report->department_name }}</td>
                                                                <td>{{ $department_wise_report->day }}</td>
                                                                <td>{{ $department_wise_report->count }}</td>
                                                                <td>{{ $department_wise_report->total_amount }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @break

                                                    @case('discharges')
                                                    @break

                                                @endswitch
                                            @break

                                            @case('consultant-wise-all-transaction')
                                                @switch($type)
                                                    @case('registrations')
                                                        {{-- @foreach ($month_day_wise_reports as $sr => $consultant_wise_all_transaction_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $consultant_wise_all_transaction_report->doctor_name }}</td>
                                                                <td>{{ $consultant_wise_all_transaction_report->day }}</td>
                                                                <td>{{ $consultant_wise_all_transaction_report->count }}</td>
                                                                <td>0</td>
                                                            </tr>
                                                        @endforeach --}}
                                                    @break

                                                    @case('admissions')
                                                        {{-- @foreach ($month_day_wise_reports as $sr => $consultant_wise_all_transaction_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $consultant_wise_all_transaction_report->doctor_name }}</td>
                                                                <td>{{ $consultant_wise_all_transaction_report->day }}</td>
                                                                <td>{{ $consultant_wise_all_transaction_report->count }}</td>
                                                            </tr>
                                                        @endforeach --}}
                                                    @break

                                                    @case('consultations')
                                                        @foreach ($month_day_wise_reports as $sr => $consultant_wise_all_transaction_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $consultant_wise_all_transaction_report->doctor_name }}</td>
                                                                <td>{{ $consultant_wise_all_transaction_report->day }}</td>
                                                                <td>{{ $consultant_wise_all_transaction_report->count }}</td>
                                                                <td>{{ $consultant_wise_all_transaction_report->total_amount }}</td>
                                                                <td>{{ $consultant_wise_all_transaction_report->discount_amount }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @break

                                                    @case('discharges')
                                                    @break

                                                @endswitch
                                            @break

                                            @case('department-wise-all-transaction')
                                                @switch($type)
                                                    @case('registrations')
                                                        {{-- @foreach ($month_day_wise_reports as $sr => $department_wise_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $department_wise_report->department_name }}</td>
                                                                <td>{{ $department_wise_report->day }}</td>
                                                                <td>{{ $department_wise_report->count }}</td>
                                                                <td>0</td>
                                                            </tr>
                                                        @endforeach --}}
                                                    @break

                                                    @case('admissions')
                                                        @foreach ($month_day_wise_reports as $sr => $department_wise_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $department_wise_report->department_name }}</td>
                                                                <td>{{ $department_wise_report->day }}</td>
                                                                <td>{{ $department_wise_report->count }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @break

                                                    @case('consultations')
                                                        @foreach ($month_day_wise_reports as $sr => $department_wise_report)
                                                            <tr>
                                                                <td>{{ $sr + 1 }}</td>
                                                                <td>{{ $department_wise_report->department_name }}</td>
                                                                <td>{{ $department_wise_report->day }}</td>
                                                                <td>{{ $department_wise_report->count }}</td>
                                                                <td>{{ $department_wise_report->total_amount }}</td>
                                                                <td>{{ $department_wise_report->discount_amount }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @break

                                                    @case('discharges')
                                                    @break

                                                @endswitch
                                            @break

                                        @endswitch
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
