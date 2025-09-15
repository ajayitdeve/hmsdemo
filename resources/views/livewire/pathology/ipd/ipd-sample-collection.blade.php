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
                    <h2>IPD Sample Collection Entry</h2>
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
                                                        <th>SN No.</th>
                                                        <th>Sevice Name</th>
                                                        <th>Specimen</th>
                                                        <th>Dosages</th>
                                                        <th>Vacutainer</th>
                                                        <th>Service Code</th>
                                                        <th>Done</th>
                                                        <th>Lab No</th>
                                                    </thead>
                                                    @if ($sampleCollectionAlredyExist == true)

                                                        @foreach ($existingSampleCollection?->sample_collection_items as $sampleCollectionItem)
                                                            <tr>
                                                                <td>{{ $loop->index + 1 }}</td>
                                                                <td>{{ $sampleCollectionItem?->ipd_billing_item?->service?->name }}
                                                                </td>
                                                                <td>{{ $sampleCollectionItem?->ipd_billing_item?->service?->specimenSetup != null ? $sampleCollectionItem?->ipd_billing_item?->service?->specimenSetup?->specimenMaster?->name : null }}
                                                                </td>
                                                                <td>{{ $sampleCollectionItem?->ipd_billing_item?->service?->specimenSetup != null ? $sampleCollectionItem?->ipd_billing_item?->service?->specimenSetup?->dosage_qty : null }}
                                                                </td>
                                                                <td>{{ $sampleCollectionItem?->ipd_billing_item?->service?->specimenSetup != null ? $sampleCollectionItem?->ipd_billing_item?->service?->specimenSetup?->vacutainer->name : null }}
                                                                </td>
                                                                <td>{{ $sampleCollectionItem?->ipd_billing_item?->service?->code }}
                                                                </td>
                                                                <td>
                                                                    @if ($sampleCollectionItem->sample_done)
                                                                        Done
                                                                    @else
                                                                        <input type="checkbox" class="form-control"
                                                                            wire:model="sampleDone.{{ $sampleCollectionItem->ipd_billing_item->service->id }}">
                                                                    @endif
                                                                </td>
                                                                <td>{{ $lab_no }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        @foreach ($ipd_billing_items as $ipd_billing_item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $ipd_billing_item?->service?->name }}</td>
                                                                <td>{{ $ipd_billing_item?->service?->specimenSetup != null ? $ipd_billing_item?->service?->specimenSetup?->specimenMaster?->name : null }}
                                                                </td>
                                                                <td>{{ $ipd_billing_item?->service?->specimenSetup != null ? $ipd_billing_item?->service?->specimenSetup?->dosage_qty : null }}
                                                                </td>
                                                                <td>{{ $ipd_billing_item?->service?->specimenSetup != null ? $ipd_billing_item?->service?->specimenSetup?->vacutainer->name : null }}
                                                                </td>
                                                                <td>{{ $ipd_billing_item?->service?->code }}</td>
                                                                <td>

                                                                    @if ($ipd_billing_item?->service?->issampleneeded == 1)
                                                                        <input type="checkbox" class="form-control"
                                                                            wire:model="sampleDone.{{ $ipd_billing_item->service->id }}">
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

            $(document).on("change", "select[name='ipd_service_billing_id']", function() {
                @this.call("ipdBillingChanged");
            });
        </script>
    @endpush
</div>
