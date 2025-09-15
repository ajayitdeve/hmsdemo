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
        <form wire:submit.prevent='save'>
            <div class="card">
                <div class="card-header">

                    <h2>Diagnostic Result Entry</h2>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Bill No</label>
                                                <input type="text" class="form-control" wire:model="opd_billing_code"
                                                    wire:change="opdBillingCodeChanged" required />
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Patient Type</label>
                                                <input type="text" class="form-control" readonly
                                                    wire:model="patient_type">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
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
                                        <div class="col-md-2">
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
                                                    @foreach ($opdBillingItems as $opdBillingItem)
                                                        <tr
                                                            wire:click="serviceSelected({{ $opdBillingItem->service_id }})">

                                                            <td><input type="checkbox"
                                                                    value="{{ $opdBillingItem->service_id }}"
                                                                    checked>{{ $opdBillingItem?->service?->name }}</td>
                                                            <td>{{ $opdBillingItem?->service?->serviceGroup->code }}
                                                            </td>
                                                            <td>{{ $opdBillingItem?->opdBilling?->created_at }}</td>
                                                            <td>{{ $opdBillingItem?->service?->code }}</td>
                                                            <td>{{ $opdBillingItem?->service?->format != null ? $opdBillingItem?->service?->format?->code : null }}
                                                            </td>
                                                            <td>{{ $opdBillingItem?->service?->code }}</td>
                                                            <td>{{ $opdBillingItem?->opdBilling?->sampleCollection != null ? $opdBillingItem?->opdBilling?->sampleCollection?->lab_no : null }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>

                                    @endif

                                    @if ($selectedServiceId != null)

                                        <?php
                                        $diagnosticResult = \App\Models\Pathology\DiagnosticResult::where('opd_billing_id', $this->opdBilling->id)->first();
                                        //  $currentDiagnosticResultValuesByService = $diagnosticResult->diagnosticResultValues;
                                        
                                        //dd( $diagnosticResult->diagnosticResultValues);
                                        // $arr1=[];
                                        //   foreach($diagnosticResult->diagnosticResultValues as $diagnosticResultValue ){
                                        //     if($diagnosticResultValue->service_id==$this->selectedServiceId){
                                        //         $temp=[];
                                        //         $temp['parameter_id']=$diagnosticResultValue->parameter_id;
                                        //         $temp['result_value']=$diagnosticResultValue->result_value;
                                        //         $temp['service_id']=$diagnosticResultValue->service_id;
                                        //         array_push($arr1,$temp);
                                        //     }
                                        //   }
                                        //   dd($arr1);
                                        ?>
                                        {{-- <p wire:model="selectedServiceId"> {{$selectedServiceId}}</p>
                                        {{$selectedService->format}} --}}
                                        {{-- @if ($selectedService->template != null && $selectedService->template->format != null && $selectedService->template->format->formatParameters != null) --}}
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
                                                    @if ($diagnosticResult != null)
                                                        <tr>
                                                            <td colspan="7">
                                                                <?php
                                                                // echo "<pre>";
                                                                //     print_r($diagnosticResult->diagnosticResultValues);
                                                                //      echo "</pre>";
                                                                ?>
                                                            </td>
                                                        </tr>

                                                        @foreach ($diagnosticResult?->diagnosticResultValues as $diagnosticResultValue)
                                                            @if ($diagnosticResultValue->service_id == $this->selectedServiceId)
                                                                <tr>
                                                                    <td> {{ $diagnosticResultValue->parameter->name }}
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
                                                                    <td>


                                                                        @if ($diagnosticResultValue?->parameter?->normal_range == 1)
                                                                            {{ $diagnosticResultValue?->parameter?->parameterValue != null ? $diagnosticResultValue?->parameter?->parameterValue?->normal_range : null }}
                                                                        @else
                                                                            NA
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $diagnosticResultValue?->parameter?->method }}
                                                                    </td>
                                                                    <td>{{ $diagnosticResultValue?->parameter?->code }}
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
                                                {{-- <button wire:click="saveResult">Save</button> --}}
                                            </div>
                                        </div>
                                    @endif

                                    <div class="ubmit-section mt-0 pt-0  mb-1 text-center">
                                        <button class="btn btn-primary submit-btn" wire:click="saveResult">Save</button>

                                    </div>
                                    {{-- <div class="ubmit-section mt-0 pt-0  mb-1 text-center">
                                            <button class="btn btn-primary submit-btn">Submit</button>
                                        </div> --}}
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>


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
                            <div class="modal-body">
                                <form wire:submit.prevent='saveTitle'>
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
                    })
                </script>
            @endpush

        </div>

    </div>
</div>
