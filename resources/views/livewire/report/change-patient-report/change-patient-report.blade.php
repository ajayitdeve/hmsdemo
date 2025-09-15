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
                            <h3 class="m-0">Change Patient Report</h3>
                        </div>

                        <div class="card-body">
                            <form wire:submit.prevent='show' class="mb-0 pb-0">

                                <div class="row mb-0 pb-0">
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
                                            <label>Change In</label>
                                            <select name="change_in" class="form-control select2-multiple" multiple
                                                wire:model="change_in">
                                                <option value="name">Name</option>
                                                <option value="dob">Date Of Birth</option>
                                                <option value="father_name">Father Name</option>
                                                <option value="patient_type">Patient Type</option>
                                                <option value="organization">Organization</option>
                                                <option value="mobile">Mobile No</option>
                                                <option value="email">E-Mail</option>
                                                <option value="address">Address</option>
                                                <option value="country">Country</option>
                                                <option value="state">State</option>
                                                <option value="city">City</option>
                                            </select>
                                            @error('change_in')
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

                                @if ($change_patient_reports && count($change_patient_reports) > 0)
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
                            <h5>Total Records : {{ count($change_patient_reports) }}</h5>
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
                                        @foreach ($change_patient_reports as $sr => $change_patient_report)
                                            <tr>
                                                @foreach ($export_fields as $export_field_key => $export_field)
                                                    @switch($export_field_key)
                                                        @case('sr_no')
                                                            <td>{{ $sr + 1 }}</td>
                                                        @break

                                                        @case('umr')
                                                            <td>{{ $change_patient_report?->patient?->registration_no }}</td>
                                                        @break

                                                        @case('patient_name')
                                                            <td>{{ $change_patient_report?->patient?->name }}</td>
                                                        @break

                                                        @case('patient_type')
                                                            <td>
                                                                {{ $change_patient_report?->patient?->patienttype?->name }}
                                                            </td>
                                                        @break

                                                        @case('area')
                                                            <td>
                                                                {{ $change_patient_report?->patient?->is_rural ? 'Rural' : 'Urban' }}
                                                            </td>
                                                        @break

                                                        @case('ipd_code')
                                                            <td>{{ $change_patient_report?->ipd?->ipdcode }}</td>
                                                        @break

                                                        @case('organization_name')
                                                            <td>
                                                                {{ $change_patient_report?->ipd?->corporate_registration?->organization?->name }}
                                                            </td>
                                                        @break

                                                        @case('age')
                                                            <td>
                                                                {{ Carbon\Carbon::parse($change_patient_report?->patient?->dob)->diff(Carbon\Carbon::now())->format('%yY') }}(s)
                                                            </td>
                                                        @break

                                                        @case('gender')
                                                            <td>{{ $change_patient_report?->patient?->gender?->name }}</td>
                                                        @break

                                                        @case('address')
                                                            <td style="text-wrap:initial; min-width: 350px;">
                                                                {{ $change_patient_report?->patient?->address }}
                                                            </td>
                                                        @break

                                                        @case('consult_no')
                                                            <td>{{ $change_patient_report?->visit_no }}</td>
                                                        @break

                                                        @case('consult_date')
                                                            <td>{{ $change_patient_report?->visit_date }}</td>
                                                        @break

                                                        @case('doctor_name')
                                                            <td>{{ $change_patient_report?->doctor?->name }}</td>
                                                        @break

                                                        @case('visit_type')
                                                            <td>{{ $change_patient_report?->visitType?->name }}</td>
                                                        @break

                                                        @case('department')
                                                            <td>{{ $change_patient_report?->department?->name }}</td>
                                                        @break

                                                        @case('unit')
                                                            <td>{{ $change_patient_report?->unit?->name }}</td>
                                                        @break

                                                        @case('consult_fee')
                                                            <td>{{ $change_patient_report?->fee }}</td>
                                                        @break

                                                        @case('foc')
                                                            <td>{{ $change_patient_report?->foc ? 'Yes' : 'No' }}</td>
                                                        @break

                                                        @case('consult_status')
                                                            <td>
                                                                {{ $change_patient_report?->patient?->patientvisits?->count() > 1 ? 'Old' : 'New' }}
                                                            </td>
                                                        @break

                                                        @case('created_by')
                                                            <td>{{ $change_patient_report?->created_by?->name }}</td>
                                                        @break

                                                        @case('created_at')
                                                            <td>{{ $change_patient_report?->created_at }}</td>
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

                $('.select2-multiple').select2({
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
