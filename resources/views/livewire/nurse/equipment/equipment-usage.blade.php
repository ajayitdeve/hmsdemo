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
                    <form wire:submit.prevent='save' class="mb-0 pb-0">

                        <div class="card">
                            <div class="card-header">
                                <h3>Equipment Usage</h3>
                            </div>

                            <div class="card-body" style="background: {{ $bg_color }}">
                                <div class="row mb-0 pb-0">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>UMR No<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly wire:model="umr">
                                            @error('umr')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Patient Name</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_name">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Patient Type</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="patient_type">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input class="form-control" type="text" readonly wire:model="status">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control" type="text" readonly wire:model="age">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <input class="form-control" type="text" readonly wire:model="gender">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Consultant</label>
                                            <input class="form-control" type="text" readonly wire:model="consultant">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Corp. Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="corporate_name">
                                            @error('corporate_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Admn No.<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" readonly wire:model="admn_no">
                                            @error('admn_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Admn Date<span class="text-danger">*</span></label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="admn_date">
                                            @error('admn_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Ward</label>
                                            <input class="form-control" type="text" readonly wire:model="ward">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Room</label>
                                            <input class="form-control" type="text" readonly wire:model="room">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Bed</label>
                                            <input class="form-control" type="text" readonly wire:model="bed">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0 align-items-end">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Usage No.</label>
                                            <input class="form-control" type="text" readonly wire:model="usage_no">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Usage Date</label>
                                            <input class="form-control" type="datetime-local" readonly
                                                wire:model="usage_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>EquipGroup Name</th>
                                                    <th>Equip Name</th>
                                                    <th>Equip Code</th>
                                                    <th>From Time</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if ($arrCart)
                                                    @foreach ($arrCart as $index => $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>

                                                            <td>
                                                                <select class="form-control select2"
                                                                    name="equipment_group_id"
                                                                    data-index="{{ $index }}"
                                                                    data-placeholder="Select Group"
                                                                    wire:model="arrCart.{{ $index }}.equipment_group_id">
                                                                    <option value=""></option>
                                                                    @foreach ($equipment_groups as $equipment_group)
                                                                        <option value="{{ $equipment_group->id }}">
                                                                            {{ $equipment_group->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error("arrCart.$index.equipment_group_id")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>

                                                            <td>
                                                                <select class="form-control select2"
                                                                    name="equipment_id"
                                                                    data-index="{{ $index }}"
                                                                    data-placeholder="Select Equipment"
                                                                    wire:model="arrCart.{{ $index }}.equipment_id">
                                                                    <option value=""></option>
                                                                    @isset($equipments[$index])
                                                                        @foreach ($equipments[$index] as $equipment)
                                                                            <option value="{{ $equipment['id'] }}">
                                                                                {{ $equipment['name'] }}</option>
                                                                        @endforeach
                                                                    @endisset
                                                                </select>
                                                                @error("arrCart.$index.equipment_id")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>

                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    wire:model="arrCart.{{ $index }}.equipment_code"
                                                                    readonly>
                                                                @error("arrCart.$index.equipment_code")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>

                                                            <td>
                                                                <input class="form-control" type="datetime-local"
                                                                    wire:model="arrCart.{{ $index }}.from_date_time">
                                                                @error("arrCart.$index.from_date_time")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>

                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm"
                                                                    wire:click="addRow">
                                                                    <i class="fa fa-add"></i>
                                                                </button>

                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    wire:click="removeRow({{ $index }})">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table data-order='[[ 5, "desc" ]]'
                                    class="datatable table table-stripped mb-0 dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Usage Code</th>
                                            <th>IPD Code</th>
                                            <th>UMR</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($equipment_usage_list)
                                            @foreach ($equipment_usage_list as $index => $equipment_usage)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" data-toggle="modal"
                                                            data-target="#equipmentItemDetailsModal"
                                                            wire:click="getEquipmentUsageItemDetails({{ $equipment_usage->id }})">
                                                            {{ $equipment_usage->code }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $equipment_usage?->ipd?->ipdcode }}</td>
                                                    <td>{{ $equipment_usage?->patient?->registration_no }}</td>
                                                    <td>{{ $equipment_usage?->created_by?->name }}</td>
                                                    <td>{{ $equipment_usage->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Start Modal -->
                    <div wire:ignore.self class="modal custom-modal fade" id="equipmentItemDetailsModal"
                        tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>EquipGroup Name</th>
                                                    <th>Equip Name</th>
                                                    <th>Equip Code</th>
                                                    <th>From Time</th>
                                                    <th>To Time</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if ($equipment_usage_items)
                                                    @foreach ($equipment_usage_items as $index => $equipment_usage_item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $equipment_usage_item?->equipment_group?->name }}
                                                            </td>
                                                            <td>{{ $equipment_usage_item?->equipment?->name }}</td>
                                                            <td>{{ $equipment_usage_item->equipment_code }}</td>
                                                            <td>
                                                                {{ date('d-M-Y h:i a', strtotime($equipment_usage_item->from_date_time)) }}
                                                            </td>
                                                            <td>
                                                                {{ $equipment_usage_item->to_date_time ? date('d-M-Y h:i a', strtotime($equipment_usage_item->to_date_time)) : '-' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
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
                let input_index = $(this).attr("data-index");

                @this.set(`arrCart.${input_index}.${input_name}`, $(this).val());
            });

            $(document).on("change", "select[name='equipment_group_id']", function() {
                let input_index = $(this).attr("data-index");
                @this.call("equipmentGroupChanged", input_index);
            });

            $(document).on("change", "select[name='equipment_id']", function() {
                let input_index = $(this).attr("data-index");
                @this.call("equipmentChanged", input_index);
            });
        </script>
    @endpush
</div>
