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
                                <h3>Abnormal Entry</h3>
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
                                            <label>Abnormal No.</label>
                                            <input class="form-control" type="text" readonly
                                                wire:model="abnormal_no">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Abnormal Date</label>
                                            <input class="form-control" type="date" readonly
                                                wire:model="abnormal_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Abnormal Name</th>
                                                    <th>Abnormal Code</th>
                                                    <th>Date & Time</th>
                                                    <th>Temperature</th>
                                                    <th>Remarks</th>
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
                                                                    name="arrCart.{{ $index }}.abnormal_id"
                                                                    data-index="{{ $index }}"
                                                                    data-placeholder="Select name"
                                                                    wire:model="arrCart.{{ $index }}.abnormal_id">
                                                                    <option value=""></option>
                                                                    @foreach ($abnormal_master as $abnormal)
                                                                        <option value="{{ $abnormal->id }}">
                                                                            {{ $abnormal->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error("arrCart.$index.abnormal_id")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>

                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    wire:model="arrCart.{{ $index }}.abnormal_code"
                                                                    readonly>
                                                                @error("arrCart.$index.abnormal_code")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>

                                                            <td>
                                                                <input class="form-control" type="datetime-local"
                                                                    wire:model="arrCart.{{ $index }}.date_time">
                                                                @error("arrCart.$index.date_time")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>

                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    wire:model="arrCart.{{ $index }}.temperature">
                                                                @error("arrCart.$index.temperature")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>

                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    wire:model="arrCart.{{ $index }}.remarks">
                                                                @error("arrCart.$index.remarks")
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
                                <table data-order='[[ 4, "desc" ]]'
                                    class="datatable table table-stripped mb-0 dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Code</th>
                                            <th>IPD</th>
                                            <th>UMR No.</th>
                                            <th>Patient Name</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($abnormal_list as $abnormal)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="javascript:void(0);" data-toggle="modal"
                                                        data-target="#abnormalItemDetailsModal"
                                                        wire:click="getAbnormalItemDetails({{ $abnormal->id }})">
                                                        {{ $abnormal->code }}
                                                    </a>
                                                </td>
                                                <td>{{ $abnormal->ipd?->ipdcode }}</td>
                                                <td>{{ $abnormal->patient?->registration_no }}</td>
                                                <td>{{ $abnormal->patient?->name }}</td>
                                                <td>{{ $abnormal?->created_by?->name }}</td>
                                                <td>{{ $abnormal->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Start Modal -->
                    <div wire:ignore.self class="modal custom-modal fade" id="abnormalItemDetailsModal"
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
                                                    <th>Abnormal Name</th>
                                                    <th>Abnormal Code</th>
                                                    <th>Date & Time</th>
                                                    <th>Temperature</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if ($abnormal_item_list)
                                                    @foreach ($abnormal_item_list as $index => $abnormal_item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $abnormal_item?->abnormal?->name }}</td>
                                                            <td>{{ $abnormal_item?->abnormal?->code }}</td>
                                                            <td>{{ date('d-M-Y h:i a', strtotime($abnormal_item->date_time)) }}
                                                            </td>
                                                            <td>{{ $abnormal_item->temperature }}</td>
                                                            <td>{{ $abnormal_item->remarks }}</td>
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
            document.addEventListener('livewire:load', function() {
                Livewire.hook('afterDomUpdate', () => {
                    $('.select2').select2({
                        width: '100%',
                    });
                });
            });

            $(document).ready(function() {
                $('.select2').select2({
                    width: '100%',
                });
            });

            $(document).on("change", ".select2", function() {
                let input_name = $(this).attr("name");
                let input_index = $(this).attr("data-index");

                @this.set(input_name, $(this).val());
                @this.call("abnormalChanged", input_index);
            });
        </script>
    @endpush
</div>
