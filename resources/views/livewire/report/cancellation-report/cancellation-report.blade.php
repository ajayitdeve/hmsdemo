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
                            <h3 class="m-0">Cancellation Report</h3>
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

                                @if ($cancellation_reports && count($cancellation_reports) > 0)
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
                            <h5>Total Records : {{ count($cancellation_reports) }}</h5>
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
                                        @switch($selection_type)
                                            @case('out-patient-consultation-cancellation')
                                                @foreach ($cancellation_reports as $sr => $out_patient_consultation_cancellation)
                                                    <tr>
                                                        @foreach ($export_fields as $export_field_key => $export_field)
                                                            @switch($export_field_key)
                                                                @case('sr_no')
                                                                    <td>{{ $sr + 1 }}</td>
                                                                @break

                                                                @case('visit_code')
                                                                    <td>
                                                                        {{ $out_patient_consultation_cancellation?->visit_no }}
                                                                    </td>
                                                                @break

                                                                @case('cancel_date')
                                                                    <td>
                                                                        {{ date('Y-m-d', strtotime($out_patient_consultation_cancellation?->deleted_at)) }}
                                                                    </td>
                                                                @break

                                                                @case('visit_date')
                                                                    <td>
                                                                        {{ date('Y-m-d', strtotime($out_patient_consultation_cancellation?->visit_date)) }}
                                                                    </td>
                                                                @break

                                                                @case('umr')
                                                                    <td>
                                                                        {{ $out_patient_consultation_cancellation?->patient?->registration_no }}
                                                                    </td>
                                                                @break

                                                                @case('patient_name')
                                                                    <td>
                                                                        {{ $out_patient_consultation_cancellation?->patient?->name }}
                                                                    </td>
                                                                @break

                                                                @case('doctor_name')
                                                                    <td>
                                                                        {{ $out_patient_consultation_cancellation?->doctor?->name }}
                                                                    </td>
                                                                @break

                                                                @case('department_name')
                                                                    <td>
                                                                        {{ $out_patient_consultation_cancellation?->department?->name }}
                                                                    </td>
                                                                @break

                                                                @case('unit_name')
                                                                    <td>
                                                                        {{ $out_patient_consultation_cancellation?->unit?->name }}
                                                                    </td>
                                                                @break

                                                                @case('amount')
                                                                    <td>
                                                                        {{ $out_patient_consultation_cancellation?->fee }}
                                                                    </td>
                                                                @break
                                                            @endswitch
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            @break

                                            @case('out-patient-miscellaneous-cancellation')
                                                @foreach ($cancellation_reports as $sr => $out_patient_miscellaneous_cancellation)
                                                    <tr>
                                                        @foreach ($export_fields as $export_field_key => $export_field)
                                                            @switch($export_field_key)
                                                                @case('sr_no')
                                                                    <td>{{ $sr + 1 }}</td>
                                                                @break

                                                                @case('cancel_date')
                                                                    <td>
                                                                        {{ date('Y-m-d', strtotime($out_patient_miscellaneous_cancellation?->updated_at)) }}
                                                                    </td>
                                                                @break

                                                                @case('service_date')
                                                                    <td>
                                                                        {{ date('Y-m-d', strtotime($out_patient_miscellaneous_cancellation?->created_at)) }}
                                                                    </td>
                                                                @break

                                                                @case('umr')
                                                                    <td>
                                                                        {{ $out_patient_miscellaneous_cancellation?->opdBilling?->patient?->registration_no }}
                                                                    </td>
                                                                @break

                                                                @case('patient_name')
                                                                    <td>
                                                                        {{ $out_patient_miscellaneous_cancellation?->opdBilling?->patient?->name }}
                                                                    </td>
                                                                @break

                                                                @case('service_name')
                                                                    <td>
                                                                        {{ $out_patient_miscellaneous_cancellation?->service?->name }}
                                                                    </td>
                                                                @break

                                                                @case('service_code')
                                                                    <td>
                                                                        {{ $out_patient_miscellaneous_cancellation?->service?->code }}
                                                                    </td>
                                                                @break

                                                                @case('service_group')
                                                                    <td>
                                                                        {{ $out_patient_miscellaneous_cancellation?->service?->servicegroup?->name }}
                                                                    </td>
                                                                @break

                                                                @case('qty')
                                                                    <td>
                                                                        {{ $out_patient_miscellaneous_cancellation?->quantity }}
                                                                    </td>
                                                                @break

                                                                @case('rate')
                                                                    <td>
                                                                        {{ $out_patient_miscellaneous_cancellation?->unit_service_price }}
                                                                    </td>
                                                                @break

                                                                @case('amount')
                                                                    <td>
                                                                        {{ $out_patient_miscellaneous_cancellation?->amount }}
                                                                    </td>
                                                                @break

                                                                @case('discount')
                                                                    <td>
                                                                        {{ $out_patient_miscellaneous_cancellation?->discount }}
                                                                    </td>
                                                                @break

                                                                @case('total')
                                                                    <td>
                                                                        {{ $out_patient_miscellaneous_cancellation?->total }}
                                                                    </td>
                                                                @break
                                                            @endswitch
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            @break

                                            @case('in-patient-service-cancellation')
                                            @case('in-patient-investigation-cancellation')

                                            @case('in-patient-miscellaneous-cancellation')
                                            @case('in-patient-procedure-cancellation')
                                                @foreach ($cancellation_reports as $sr => $cancellation_report)
                                                    <tr>
                                                        @foreach ($export_fields as $export_field_key => $export_field)
                                                            @switch($export_field_key)
                                                                @case('sr_no')
                                                                    <td>{{ $sr + 1 }}</td>
                                                                @break

                                                                @case('ipd_code')
                                                                    <td>{{ $cancellation_report?->lab_indent?->ipd?->ipdcode }}
                                                                    </td>
                                                                @break

                                                                @case('cancel_date')
                                                                    <td>{{ $cancellation_report?->service_date }}</td>
                                                                @break

                                                                @case('service_date')
                                                                    <td>{{ $cancellation_report?->service_date }}</td>
                                                                @break

                                                                @case('umr')
                                                                    <td>
                                                                        {{ $cancellation_report?->lab_indent?->patient?->registration_no }}
                                                                    </td>
                                                                @break

                                                                @case('patient_name')
                                                                    <td>{{ $cancellation_report?->lab_indent?->patient?->name }}
                                                                    </td>
                                                                @break

                                                                @case('service_name')
                                                                    <td>
                                                                        {{ $cancellation_report?->service?->name }}
                                                                    </td>
                                                                @break

                                                                @case('service_code')
                                                                    <td>
                                                                        {{ $cancellation_report?->service?->code }}
                                                                    </td>
                                                                @break

                                                                @case('service_group')
                                                                    <td>
                                                                        {{ $cancellation_report?->service?->servicegroup?->name }}
                                                                    </td>
                                                                @break

                                                                @case('qty')
                                                                    <td>
                                                                        {{ $cancellation_report?->quantity }}
                                                                    </td>
                                                                @break

                                                                @case('rate')
                                                                    <td>
                                                                        {{ $cancellation_report?->unit_service_price }}
                                                                    </td>
                                                                @break

                                                                @case('amount')
                                                                    <td>
                                                                        {{ $cancellation_report?->amount }}
                                                                    </td>
                                                                @break

                                                                @case('discount')
                                                                    <td>
                                                                        {{ $cancellation_report?->discount }}
                                                                    </td>
                                                                @break

                                                                @case('total')
                                                                    <td>
                                                                        {{ $cancellation_report?->total }}
                                                                    </td>
                                                                @break
                                                            @endswitch
                                                        @endforeach
                                                    </tr>
                                                @endforeach
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

            $(document).on("change", "select[name='department_id']", function() {
                @this.call("departmentChanged");
            });
        </script>
    @endpush
</div>
