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
        @include('partials.alert-message')

        <div class="row mb-0 pb-0">
            <div class="col-md-12 mb-0 pb-0">
                <!-- Page Header -->
                <div class="page-header mb-0 pb-0">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="page-title">Organization Tariff Master</h3>
                        </div>
                    </div>
                </div>

                <hr />
                <form wire:submit.prevent='save' class="mb-0 pb-0">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Organization<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="organization_id"
                                    data-placeholder="Select Organization" wire:model="organization_id">
                                    <option value=""></option>
                                    @foreach ($organizations as $organization)
                                        <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                                    @endforeach
                                </select>
                                @error('organization_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Organization Code<span class="text-danger">*</span></label>
                                <input class="form-control" wire:model="organization_code" type="text" readonly />
                                @error('organization_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h4>Tariff's Priority for IP</h4>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm mb-0">
                            <tbody>
                                @if ($tariff_ip_cart)
                                    @foreach ($tariff_ip_cart as $index => $tariff_ip)
                                        <tr>
                                            <td>
                                                @if ($tariff_ip['is_default'] == 1)
                                                    Default
                                                @else
                                                    Priority {{ $tariff_ip['priority'] }}
                                                @endif
                                            </td>
                                            <td>
                                                <select class="form-control select2 ip_priority_tariff"
                                                    name="tariff_ip_cart.{{ $index }}.teriff_id"
                                                    data-index="{{ $index }}"
                                                    wire:model="tariff_ip_cart.{{ $index }}.teriff_id">
                                                    <option value="">Select Tariff</option>
                                                    @foreach ($tariffs as $tariff)
                                                        <option value="{{ $tariff->id }}">
                                                            {{ $tariff->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" readonly
                                                    wire:model="tariff_ip_cart.{{ $index }}.teriff_code">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Discount %"
                                                    wire:model="tariff_ip_cart.{{ $index }}.discount">
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <hr>
                    <h4>Tariff's Priority for OP</h4>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm mb-0">
                            <tbody>
                                @if ($tariff_op_cart)
                                    @foreach ($tariff_op_cart as $index => $tariff_ip)
                                        <tr>
                                            <td>
                                                @if ($tariff_ip['is_default'] == 1)
                                                    Default
                                                @else
                                                    Priority {{ $tariff_ip['priority'] }}
                                                @endif
                                            </td>
                                            <td>
                                                <select class="form-control select2 op_priority_tariff"
                                                    name="tariff_op_cart.{{ $index }}.teriff_id"
                                                    data-index="{{ $index }}"
                                                    wire:model="tariff_op_cart.{{ $index }}.teriff_id">
                                                    <option value="">Select Tariff</option>
                                                    @foreach ($tariffs as $tariff)
                                                        <option value="{{ $tariff->id }}">
                                                            {{ $tariff->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" readonly
                                                    wire:model="tariff_op_cart.{{ $index }}.teriff_code">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Discount %"
                                                    wire:model="tariff_op_cart.{{ $index }}.discount">
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>

                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0">
                                <thead>
                                    <tr>
                                        <th>Organization</th>
                                        <th>Cost Center</th>
                                        <th>Is Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($organization_tariffs as $organization_tariff)
                                        <tr>
                                            <td>{{ $organization_tariff?->organization?->name }}</td>
                                            <td>{{ $organization_tariff?->organization?->cost_center?->name }}</td>
                                            <td>
                                                @if ($organization_tariff?->organization?->isactive == 1)
                                                    Yes
                                                @else
                                                    No
                                                @endif
                                            </td>
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

            $(document).on("change", "select[name='organization_id']", function() {
                @this.call("organizationChanged");
            });

            $(document).on("change", ".ip_priority_tariff", function() {
                let index = $(this).attr("data-index");
                @this.call("ipTarrifChanged", index);
            });

            $(document).on("change", ".op_priority_tariff", function() {
                let index = $(this).attr("data-index");
                @this.call("opTarrifChanged", index);
            });
        </script>
    @endpush
</div>
