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
                            <h3 class="m-0">OPD Register Report</h3>
                        </div>

                        <div class="card-body">
                            <form wire:submit.prevent='show' class="mb-0 pb-0">

                                <div class="row mb-0 pb-0">
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
                                            <label>Sorting Order</label>
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
                                            <label>Cost Center</label>
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

                                @if ($opd_register_reports)
                                    <button type="button" wire:click="exportExcel" class="btn btn-success">
                                        Export Excel
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h5>Total Records : {{ count($opd_register_reports) }}</h5>
                        </div>

                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>UMR</th>
                                            <th>Patient Name</th>
                                            <th>Patient Type</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($opd_register_reports as $opd_register_report)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $opd_register_report?->registration_no }}</td>
                                                <td>{{ $opd_register_report?->name }}</td>
                                                <td>{{ $opd_register_report?->patienttype?->name }}</td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($opd_register_report->dob)->diff(Carbon\Carbon::now())->format('%yY') }}(s)
                                                </td>
                                                <td>{{ $opd_register_report?->gender?->name }}</td>
                                                <td style="text-wrap:initial;">
                                                    {{ $opd_register_report?->address }}</td>
                                                <td>{{ $opd_register_report?->created_by?->name }}</td>
                                                <td>{{ $opd_register_report?->created_at }}</td>
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

            // $(document).on("change", "select[name='stock_point_id']", function() {
            //     @this.call("stockPointChanged");
            // });
        </script>
    @endpush
</div>
