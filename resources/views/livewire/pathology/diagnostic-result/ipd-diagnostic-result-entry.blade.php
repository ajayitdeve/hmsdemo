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
    <div>
        @include('partials.alert-message')

        <form wire:submit.prevent='save'>
            <div class="card">
                <div class="card-header">

                    <h2>IPD Diagnostic Result Entry</h2>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Bill No<span class="text-danger">*</span></label>
                                                <select class="form-control select2" name="ipd_service_billing_id"
                                                    data-placeholder="Select Bill No."
                                                    wire:model="ipd_service_billing_id">
                                                    <option value=""></option>
                                                    @foreach ($ipd_service_billing_list as $ipd_service_billing)
                                                        <option value="{{ $ipd_service_billing->id }}">
                                                            {{ $ipd_service_billing->code }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('ipd_service_billing_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">UMR</label>
                                                <input type="text" class="form-control" readonly wire:model="umr">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Patient's Name</label>
                                                <input type="text" class="form-control" readonly wire:model="name">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Gender/Age {{ $gender }}</label>
                                                <input type="text" class="form-control" readonly
                                                    wire:model="gender_age">
                                            </div>
                                        </div>

                                    </div>

                                    @if ($status)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table">
                                                    <thead>
                                                        <th>Sevice Name</th>
                                                        <th>Service Group</th>
                                                        <th>Service Date</th>
                                                        <th>Service Code</th>
                                                        <th>Format Cd</th>
                                                        <th>Lab No</th>
                                                    </thead>
                                                    @foreach ($ipd_billing_items as $ipd_billing_item)
                                                        <tr
                                                            wire:click="serviceSelected({{ $ipd_billing_item->service_id }})">

                                                            <td>
                                                                <input type="checkbox"
                                                                    value="{{ $ipd_billing_item->service_id }}"
                                                                    checked>{{ $ipd_billing_item?->service?->name }}
                                                            </td>
                                                            <td>
                                                                {{ $ipd_billing_item?->service?->serviceGroup?->code }}
                                                            </td>
                                                            <td>
                                                                {{ $ipd_billing_item?->ip_service_billing?->created_at }}
                                                            </td>
                                                            <td>{{ $ipd_billing_item?->service?->code }}</td>
                                                            <td>
                                                                {{ $ipd_billing_item?->service?->format != null ? $ipd_billing_item?->service?->format?->code : null }}
                                                            </td>
                                                            <td>
                                                                {{ $ipd_billing_item?->ip_service_billing?->ipd_sample_collection != null ? $ipd_billing_item?->ip_service_billing?->ipd_sample_collection?->lab_no : null }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>

                                    @endif

                                    @if ($selectedServiceId)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table">
                                                    <thead>
                                                        <th>Parameteres</th>
                                                        <th>Res. Values</th>
                                                        <th>Normal Values</th>
                                                        <th>Method</th>
                                                        <th>Param. Code</th>
                                                        <th>Organism</th>
                                                        <th>A.B. Needed</th>
                                                    </thead>
                                                    @if ($diagnostic_result)
                                                        @foreach ($diagnostic_result?->diagnosticResultValues as $diagnosticResultValue)
                                                            @if ($diagnosticResultValue->service_id == $this->selectedServiceId)
                                                                <tr>
                                                                    <td>
                                                                        {{ $diagnosticResultValue->parameter->name }}
                                                                    </td>

                                                                    <td>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text"
                                                                                id="basic-addon1"><a
                                                                                    wire:click="edit({{ $diagnosticResultValue->id }})"
                                                                                    href="#" data-toggle="modal"
                                                                                    data-target="#edit"><i
                                                                                        class="fa fa-pencil m-r-5"></i>
                                                                                    Edit</a></span>
                                                                            <input type="text"
                                                                                class="input-group-text" readonly
                                                                                value="{{ $diagnosticResultValue->result_value }}">
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        @if ($diagnosticResultValue?->parameter?->normal_range == 1)
                                                                            {{ $diagnosticResultValue?->parameter?->parameterValue != null ? $diagnosticResultValue?->parameter?->parameterValue?->normal_range : null }}
                                                                        @else
                                                                            NA
                                                                        @endif
                                                                    </td>

                                                                    <td>
                                                                        {{ $diagnosticResultValue?->parameter?->method }}
                                                                    </td>

                                                                    <td>
                                                                        {{ $diagnosticResultValue?->parameter?->code }}
                                                                    </td>

                                                                    <td></td>

                                                                    <td>
                                                                        @if ($diagnosticResultValue?->parameter?->antibiotic_needed == 0)
                                                                            N
                                                                        @else
                                                                            Y
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @foreach ($selectedService?->format?->formatParameters as $formatParameter)
                                                            <tr>
                                                                <td> {{ $formatParameter?->parameter?->name }}</td>
                                                                <td><input type="text" class="form-control"
                                                                        wire:model="result_value.{{ $formatParameter->parameter->id }}" />
                                                                </td>
                                                                <td>
                                                                    @if ($formatParameter?->parameter?->normal_range == 1)
                                                                        {{ $formatParameter?->parameter?->parameterValu != null ? $formatParameter?->parameter?->parameterValue?->normal_range : null }}
                                                                    @else
                                                                        NA
                                                                    @endif
                                                                </td>
                                                                <td>{{ $formatParameter?->parameter?->method }}</td>
                                                                <td>{{ $formatParameter?->parameter?->code }}</td>
                                                                <td></td>
                                                                <td>
                                                                    @if ($formatParameter?->parameter?->antibiotic_needed == 0)
                                                                        N
                                                                    @else
                                                                        Y
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="ubmit-section mt-0 pt-0  mb-1 text-center">
                                        <button class="btn btn-primary submit-btn" type="button"
                                            wire:click="saveResult">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal custom-modal fade" id="edit" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Parameter Value</h5>
                    <button type="button" class="close" wire:click='closeModal()' data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='update'>
                        <div class="form-group">
                            <label>Parameter Result Value</label>
                            <input class="form-control" type="text" wire:model='result_value' required />
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" submit-section">
                            <button class="btn btn-primary submit-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Modal -->



    @push('page-script')
        <script>
            window.addEventListener('close-modal', event => {
                $("#add").modal('hide');
                $("#edit").modal('hide');
                $("#delete").modal('hide');
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

            $(document).on("change", "select[name='ipd_service_billing_id']", function() {
                @this.call("ipdBillingChanged");
            });
        </script>
    @endpush
</div>
