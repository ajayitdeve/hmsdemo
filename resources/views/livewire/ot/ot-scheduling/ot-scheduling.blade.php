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

            .box-container {
                max-width: 400px;
                margin: auto
            }

            .box-row {
                display: flex;
                justify-content: space-between;
                align-items: center
            }

            .box-section {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                width: 150px;
                margin-bottom: 10px;
            }

            .box-section p {
                margin: 0;
            }

            .box {
                width: 25px;
                height: 25px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .not-available {
                background: #7e83fc;
            }

            .available {
                background: #fefdc4;
            }

            .booked {
                background: #1ba215;
            }

            .cancelled {
                background: #fb8d85;
            }

            .w-125 {
                min-width: 150px;
            }
        </style>
    @endpush

    <!-- Page Content -->
    <div class="content container-fluid mb-0 pb-0">
        <div class="row mb-0 pb-0">
            <div class="col-md-12 mb-0 pb-0">
                @include('partials.alert-message')

                <div>
                    <form wire:submit.prevent='confirmation' class="mb-0 pb-0">

                        <div class="card">
                            <div class="card-header">
                                <h3>OT Scheduling</h3>
                            </div>

                            <div class="card-body">
                                <div class="row mb-0 pb-0">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Operation Theater Type<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="ot_type_id"
                                                        data-placeholder="Select OT Type" wire:model="ot_type_id">
                                                        <option value=""></option>
                                                        @foreach ($ot_types as $ot_type)
                                                            <option value="{{ $ot_type->id }}">{{ $ot_type->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('ot_type_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Operation Theater Type Code<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="ot_type_code">
                                                    @error('ot_type_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Schedule From<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="date"
                                                        wire:model="schedule_from" min="{{ date('Y-m-d') }}">
                                                    @error('schedule_from')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Schedule To<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="date" wire:model="schedule_to"
                                                        min="{{ date('Y-m-d') }}">
                                                    @error('schedule_to')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Code<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" readonly
                                                        wire:model="code">
                                                    @error('code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Status<span class="text-danger">*</span></label>
                                                    <select class="form-control" wire:model="status">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                    @error('status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-secondary btn-block mt-3"
                                                    wire:click="schedule">Schedule</button>
                                            </div>

                                            <div class="col-md-3">
                                                <button class="btn btn-primary btn-block mt-3">Save</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="box-container">
                                            <div class="box-row">
                                                <div class="box-section">
                                                    <div class="box not-available"></div>
                                                    <p>Not Available</p>
                                                </div>

                                                <div class="box-section">
                                                    <div class="box available"></div>
                                                    <p>Available</p>
                                                </div>
                                            </div>

                                            <div class="box-row">
                                                <div class="box-section">
                                                    <div class="box booked"></div>
                                                    <p>Booked</p>
                                                </div>

                                                <div class="box-section">
                                                    <div class="box cancelled"></div>
                                                    <p>Cancelled</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                @if ($ot_list)
                    <div>
                        <div class="table-responsive">
                            <table class="table table-stripped table-bordered mb-0 no-footer">
                                <thead>
                                    <tr>
                                        <th>OT/Date</th>
                                        <th>OT/Time</th>
                                        @foreach ($ot_list as $ot)
                                            <th>{{ $ot->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dates as $date)
                                        @foreach ($timeSlots as $time)
                                            <tr>
                                                <td class="w-125">{{ $date }}</td>
                                                <td class="w-125">{{ $time }}</td>
                                                @foreach ($ot_list as $ot)
                                                    @php
                                                        $key = "{$date}_{$time}_{$ot->id}";
                                                        $status = $scheduleData[$key]['status'] ?? 'available';
                                                    @endphp
                                                    <td class="{{ $status }} w-125">
                                                        <select
                                                            wire:model.defer="scheduleData.{{ $key }}.status"
                                                            class="form-control form-control-sm {{ $status }}">
                                                            <option value="available">Available</option>
                                                            <option value="booked">Booked</option>
                                                            <option value="cancelled">Cancelled</option>
                                                            <option value="not-available">Not Available</option>
                                                        </select>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Confirmation  Modal -->
    <div wire:ignore.self class="modal custom-modgal fade" id="confirmationModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form wire:submit.prevent='save'>
                        <div class="form-header">
                            <h3>Save </h3>
                            <p>Are you sure want to save ?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn btn-block">Save</button>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal"
                                        class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Confirmation  Modal -->

    @push('page-script')
        <script>
            window.addEventListener('open-confirmation-modal', event => {
                $("#confirmationModal").modal('show');
            });

            window.addEventListener('close-confirmation-modal', event => {
                $("#confirmationModal").modal('hide');
            });

            $(document).ready(function() {
                $('.select2').select2({
                    width: '100%',
                });
            });

            $(document).on("change", ".select2", function() {
                let input_name = $(this).attr("name");
                @this.set(input_name, $(this).val());
            });

            $(document).on("change", "select[name='ot_type_id']", function() {
                @this.call("otTypeChanged");
            });
        </script>
    @endpush
</div>
