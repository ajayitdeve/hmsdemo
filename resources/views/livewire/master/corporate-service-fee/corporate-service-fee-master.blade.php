<div>
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

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Corporate Service Fee</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Corporate Service Fee</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">

                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form wire:submit.prevent="show" class="mb-0 pb-0">

                            <div class="row mb-0 pb-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Teriff Name</label>
                                        <select class="form-control select2" name="teriff_id" wire:model="teriff_id">
                                            <option value="">All</option>
                                            @foreach ($teriffs as $teriff)
                                                <option value="{{ $teriff->id }}">
                                                    {{ $teriff->name }}
                                                </option>
                                            @endforeach
                                            @error('teriff_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Teriff Code</label>
                                        <input class="form-control" type="text" wire:model="teriff_code" readonly>
                                    </div>
                                </div>

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
                                            @error('service_group_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Service Group Code</label>
                                        <input class="form-control" type="text" wire:model="service_group_code"
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Cost Center</label>
                                        <select class="form-control" wire:model="cost_center_id">
                                            <option value="">Select Cost Center</option>
                                            @foreach ($cost_centers as $cost_center)
                                                <option value="{{ $cost_center->id }}">
                                                    {{ $cost_center->name }}
                                                </option>
                                            @endforeach
                                            @error('cost_center_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            Show
                                        </button>

                                        <button type="button" wire:click="save" class="btn btn-primary ml-3">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Code</th>
                                <th>Service Name</th>
                                <th>Charge</th>

                                <th></th>

                                <th>Corp Serv Code</th>
                                <th>Corp Serv Name</th>
                                <th>Charge</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($services as $key => $service)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $service->code }}</td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->charge }}</td>

                                    <td></td>

                                    <td>
                                        <input type="text" class="form-control"
                                            wire:model.defer="services.{{ $key }}.corporate_service_fee.code">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control"
                                            wire:model.defer="services.{{ $key }}.corporate_service_fee.name">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control"
                                            wire:model.defer="services.{{ $key }}.corporate_service_fee.charge">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

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

            $(document).on("change", "select[name='teriff_id']", function() {
                @this.call("teriffChanged");
            });

            $(document).on("change", "select[name='service_group_id']", function() {
                @this.call("serviceGroupChanged");
            });
        </script>
    @endpush

</div>
