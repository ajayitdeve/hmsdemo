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
                    <h2>Sample Collection Entry</h2>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">

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
                                                        <th>SN {{ $sampleCollectionAlredyExist }}</th>
                                                        <th>Sevice Name</th>
                                                        <th>Specimen</th>
                                                        <th>Dosages</th>
                                                        <th>Vacutainer</th>
                                                        <th>Service Code</th>
                                                        <th>Done</th>
                                                        <th>Lab No</th>
                                                    </thead>
                                                    @if ($sampleCollectionAlredyExist == true)

                                                        @foreach ($existingSampleCollection?->sampleCollectionItems as $sampleCollectionItem)
                                                            <tr>
                                                                <td>{{ $loop->index + 1 }}</td>
                                                                <td>{{ $sampleCollectionItem?->opdBillingItem?->service?->name }}
                                                                </td>
                                                                <td>{{ $sampleCollectionItem?->opdBillingItem?->service?->specimenSetup != null ? $sampleCollectionItem->opdBillingItem->service->specimenSetup->specimenMaster->name : null }}
                                                                </td>
                                                                <td>{{ $sampleCollectionItem?->opdBillingItem?->service?->specimenSetup != null ? $sampleCollectionItem->opdBillingItem->service->specimenSetup->dosage_qty : null }}
                                                                </td>
                                                                <td>{{ $sampleCollectionItem?->opdBillingItem?->service?->specimenSetup != null ? $sampleCollectionItem->opdBillingItem->service->specimenSetup->vacutainer->name : null }}
                                                                </td>
                                                                <td>{{ $sampleCollectionItem?->opdBillingItem?->service?->code }}
                                                                </td>
                                                                <td>
                                                                    {{-- {{$sampleCollectionItem->sample_done}} --}}
                                                                    @if ($sampleCollectionItem->sample_done)
                                                                        Done
                                                                    @else
                                                                        <input type="checkbox" class="form-control"
                                                                            wire:model="sampleDone.{{ $sampleCollectionItem->opdBillingItem->service->id }}">
                                                                    @endif
                                                                </td>
                                                                <td>{{ $lab_no }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        @foreach ($opdBillingItems as $opdBillingItem)
                                                            <tr>
                                                                <td>{{ $loop->index + 1 }}</td>
                                                                <td>{{ $opdBillingItem?->service?->name }}</td>
                                                                <td>{{ $opdBillingItem?->service?->specimenSetup != null ? $opdBillingItem?->service?->specimenSetup?->specimenMaster?->name : null }}
                                                                </td>
                                                                <td>{{ $opdBillingItem?->service?->specimenSetup != null ? $opdBillingItem?->service?->specimenSetup?->dosage_qty : null }}
                                                                </td>
                                                                <td>{{ $opdBillingItem?->service?->specimenSetup != null ? $opdBillingItem?->service?->specimenSetup?->vacutainer->name : null }}
                                                                </td>
                                                                <td>{{ $opdBillingItem?->service?->code }}</td>
                                                                <td>

                                                                    @if ($opdBillingItem?->service?->issampleneeded == 1)
                                                                        <input type="checkbox" class="form-control"
                                                                            wire:model="sampleDone.{{ $opdBillingItem->service->id }}">
                                                                    @endif
                                                                </td>
                                                                <td>{{ $lab_no }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif

                                                </table>
                                            </div>
                                        </div>
                                        <div class="ubmit-section mt-0 pt-0  mb-1 text-center">
                                            <button class="btn btn-primary submit-btn">Submit</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
