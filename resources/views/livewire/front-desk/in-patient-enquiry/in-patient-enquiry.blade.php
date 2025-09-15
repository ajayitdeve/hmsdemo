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
                            <h3 class="m-0">In Patient Enquiry</h3>
                        </div>

                        <div class="card-body">
                            <form wire:submit.prevent='show' class="mb-0 pb-0">

                                <div class="row mb-0 pb-0">
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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Patient Type</label>
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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Father Name</label>
                                            <input type="text" class="form-control" wire:model="father_name">
                                            @error('father_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control" wire:model="gender_id">
                                                <option value="">All</option>
                                                @foreach ($genders as $gender)
                                                    <option value="{{ $gender->id }}">
                                                        {{ $gender->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('gender_id')
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
                                            <label>Bed</label>
                                            <select class="form-control select2" name="bed_id" wire:model="bed_id">
                                                <option value="">All</option>
                                                @foreach ($beds as $bed)
                                                    <option value="{{ $bed->id }}">
                                                        {{ $bed->display_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('bed_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>UMR No.</label>
                                            <select class="form-control select2" name="umr" wire:model="umr">
                                                <option value="">All</option>
                                                @foreach ($patients as $patient)
                                                    <option value="{{ $patient->id }}">
                                                        {{ $patient->registration_no }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('umr')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Admission No.</label>
                                            <select class="form-control select2" name="ipd_id" wire:model="ipd_id">
                                                <option value="">All</option>
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

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" wire:model="address">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input type="text" class="form-control" wire:model="mobile">
                                            @error('mobile')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Admn Type</label>
                                            <select class="form-control" wire:model="admn_type_id">
                                                <option value="">All</option>
                                                @foreach ($admission_types as $admission_type)
                                                    <option value="{{ $admission_type->id }}">
                                                        {{ $admission_type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('admn_type_id')
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

                                @if ($in_patient_enquiries && count($in_patient_enquiries) > 0)
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
                            <h5>Total Records : {{ count($in_patient_enquiries) }}</h5>
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
                                        @foreach ($in_patient_enquiries as $sr => $in_patient_enquiry)
                                            <tr>
                                                @foreach ($export_fields as $export_field_key => $export_field)
                                                    @switch($export_field_key)
                                                        @case('sr_no')
                                                            <td>{{ $sr + 1 }}</td>
                                                        @break

                                                        @case('patient_name')
                                                            <td>{{ $in_patient_enquiry?->patient?->name }}</td>
                                                        @break

                                                        @case('umr')
                                                            <td>{{ $in_patient_enquiry?->patient?->registration_no }}
                                                            </td>
                                                        @break

                                                        @case('age')
                                                            <td>
                                                                {{ Carbon\Carbon::parse($in_patient_enquiry?->patient?->dob)->diff(Carbon\Carbon::now())->format('%yY') }}(s)
                                                            </td>
                                                        @break

                                                        @case('gender')
                                                            <td>{{ $in_patient_enquiry?->patient?->gender?->name }}
                                                            </td>
                                                        @break

                                                        @case('ipd_code')
                                                            <td>{{ $in_patient_enquiry?->ipdcode }}</td>
                                                        @break

                                                        @case('ipd_date')
                                                            <td>
                                                                {{ date('d-M-Y H:i:s', strtotime($in_patient_enquiry?->created_at)) }}
                                                            </td>
                                                        @break

                                                        @case('ward')
                                                            <td>
                                                                {{ $in_patient_enquiry?->ward?->name }}
                                                            </td>
                                                        @break

                                                        @case('room')
                                                            <td>
                                                                {{ $in_patient_enquiry?->room?->name }}
                                                            </td>
                                                        @break

                                                        @case('bed')
                                                            <td>
                                                                {{ $in_patient_enquiry?->bed?->display_name }}
                                                            </td>
                                                        @break

                                                        @case('doctor')
                                                            <td>
                                                                {{ $in_patient_enquiry?->patient_visit?->doctor?->name }}
                                                            </td>
                                                        @break

                                                        @case('patient_type')
                                                            <td>
                                                                {{ $in_patient_enquiry?->patient?->patienttype?->name }}
                                                            </td>
                                                        @break

                                                        @case('marital_status')
                                                            <td>
                                                                {{ $in_patient_enquiry?->patient?->marital_status?->name }}
                                                            </td>
                                                        @break

                                                        @case('city')
                                                            <td>
                                                                {{ $in_patient_enquiry?->patient?->village?->district?->name }}
                                                            </td>
                                                        @break

                                                        @case('father_name')
                                                            <td>
                                                                {{ $in_patient_enquiry?->patient?->father_name }}
                                                            </td>
                                                        @break

                                                        @case('address')
                                                            <td style="text-wrap:initial; min-width: 350px;">
                                                                {{ $in_patient_enquiry?->patient?->address }}
                                                            </td>
                                                        @break

                                                        @case('mobile')
                                                            <td>{{ $in_patient_enquiry?->patient?->mobile }}</td>
                                                        @break

                                                        @case('admn_type')
                                                            <td>{{ $in_patient_enquiry?->admin_type?->name }}</td>
                                                        @break

                                                        @case('department')
                                                            <td>{{ $in_patient_enquiry?->department?->name }}</td>
                                                        @break

                                                        @case('cost_center')
                                                            <td>{{ $in_patient_enquiry?->cost_center?->code }}</td>
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

            $(document).on("change", "select[name='umr']", function() {
                @this.call("umrChanged");
            });

            $(document).on("change", "select[name='ipd_id']", function() {
                @this.call("ipdChanged");
            });
        </script>
    @endpush
</div>
