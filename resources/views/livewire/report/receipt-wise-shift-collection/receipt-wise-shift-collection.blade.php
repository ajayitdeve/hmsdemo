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
                            <h3 class="m-0">Receipt Wise Shift Collection</h3>
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
                                            <input class="form-control" type="datetime-local" wire:model='from_date'
                                                wire:change="inputDataReset">
                                            @error('from_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>To Date</label>
                                            <input class="form-control" type="datetime-local" wire:model='to_date'
                                                wire:change="inputDataReset">
                                            @error('to_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Patient Type <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="patient_type"
                                                wire:change="inputDataReset">
                                                <option value="">Both</option>
                                                <option value="op">OP</option>
                                                <option value="ip">IP</option>
                                            </select>
                                            @error('patient_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    @if ($selection_type == 'user-wise' || $selection_type == 'user-department-wise')
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

                                    @if ($selection_type == 'user-department-wise')
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

                                    @if ($selection_type == 'service-group-wise')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Service Group</label>
                                                <select class="form-control select2" name="service_group_id"
                                                    wire:model="service_group_id">
                                                    <option value="">All</option>
                                                    @foreach ($service_groups as $service_group)
                                                        <option value="{{ $service_group->id }}">
                                                            {{ $service_group->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('service_group_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    @if ($selection_type == 'service-type-wise')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Service Type</label>
                                                <select class="form-control select2" name="service_type_id"
                                                    wire:model="service_type_id">
                                                    <option value="">All</option>
                                                    @foreach ($service_types as $key => $service_type)
                                                        <option value="{{ $key }}">
                                                            {{ $service_type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('service_type_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Area <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="area" wire:change="inputDataReset">
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
                                            <label>Sorting Order <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="sorting_order"
                                                wire:change="inputDataReset">
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
                                            <select class="form-control" wire:model="cost_center_id"
                                                wire:change="inputDataReset">
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
                                        <div class="form-group border rounded px-3 pt-3 pb-2 border">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="search_type"
                                                    id="detailed-print" value="detailed-print"
                                                    wire:model="search_type" wire:change="inputDataReset">

                                                <label class="form-check-label" for="detailed-print">
                                                    Detailed Print
                                                </label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="search_type"
                                                    id="summary-print" value="summary-print" wire:model="search_type"
                                                    wire:change="inputDataReset">

                                                <label class="form-check-label" for="summary-print">
                                                    Summary Print
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>

                                @if ($receipt_wise_shift_collections && count($receipt_wise_shift_collections) > 0)
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="false">
                                            Export
                                        </button>

                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" wire:click="exportPdf">Pdf</button>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h5>Total Records : {{ count($receipt_wise_shift_collections) }}</h5>
                        </div>

                        @if ($receipt_wise_shift_collections && count($receipt_wise_shift_collections) > 0)
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    @include(
                                        "exports.receipt-wise-shift-collection.$selection_type-report",
                                        [
                                            'from_date' => $from_date,
                                            'to_date' => $to_date,
                                    
                                            'search_type' => $search_type,
                                            'patient_type' => $patient_type,
                                            'receipt_wise_shift_collections' => $receipt_wise_shift_collections,
                                    
                                            'selection_types' => $selection_types,
                                            'selection_type' => $selection_type,
                                            'service_types' => $service_types,
                                        ]
                                    )
                                </div>
                            </div>
                        @endif
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

            $(document).on("change", "select[name='user_id']", function() {
                @this.call("userChanged");
            });

            // $(document).on("change", "select[name='department_id']", function() {
            //     @this.call("departmentChanged");
            // });
        </script>
    @endpush
</div>
