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

            .tree ul {
                list-style: none;
                margin: 0;
                padding-left: 1.2rem;
                position: relative;
            }

            .tree ul::before {
                content: "";
                border-left: 1px dashed #ccc;
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0.4rem;
            }

            .tree li {
                margin: .4rem 0;
                padding-left: 1.2rem;
                position: relative;
            }

            .tree li::before {
                content: "";
                position: absolute;
                top: 0.9rem;
                left: 0;
                width: 1rem;
                border-top: 1px dashed #ccc;
            }

            .tree a {
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                padding: .3rem .5rem;
                border-radius: .25rem;
                transition: 0.2s;
                font-size: 0.95rem;
            }

            .tree a:hover {
                background: #f8f9fa;
            }

            .tree i {
                margin-right: .4rem;
                color: #f43b48;
            }

            .badge {
                font-size: 0.75rem;
            }

            .tree ul>li>a {
                color: #f43b48;
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
                            <h3 class="m-0">Bed Status Enquiry</h3>
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

                                    @if ($selection_type == 'ward-wise')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Ward</label>
                                                <select class="form-control select2" name="ward_id"
                                                    wire:model="ward_id">
                                                    <option value="">All</option>
                                                    @foreach ($wards as $ward)
                                                        <option value="{{ $ward?->id }}">
                                                            {{ $ward?->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('ward_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    @if ($selection_type == 'nursestation-wise')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nursestation</label>
                                                <select class="form-control select2" name="nursestation_id"
                                                    wire:model="nursestation_id">
                                                    <option value="">All</option>
                                                    @foreach ($nursestations as $nursestation)
                                                        <option value="{{ $nursestation?->id }}">
                                                            {{ $nursestation?->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('nursestation_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">

                            <div class="card card-body">
                                <h4>Ward → Room → Bed</h4>
                                <div class="tree">
                                    <ul>
                                        @if ($bed_status_enquiries && $bed_status_enquiries->count() > 0)
                                            @foreach ($bed_status_enquiries as $bed_status_enquiry)
                                                <li>
                                                    <a data-toggle="collapse"
                                                        href="#ward-{{ $bed_status_enquiry->id }}">
                                                        <i class="fas fa-hospital"></i>
                                                        {{ $bed_status_enquiry->name }}
                                                    </a>

                                                    <ul class="collapse show" id="ward-{{ $bed_status_enquiry->id }}">

                                                        @if ($bed_status_enquiry?->rooms && $bed_status_enquiry?->rooms->count() > 0)
                                                            @foreach ($bed_status_enquiry?->rooms as $room)
                                                                <li>
                                                                    <a data-toggle="collapse"
                                                                        href="#room-{{ $room->id }}">
                                                                        <i class="fas fa-door-open"></i>
                                                                        {{ $room->name }}
                                                                    </a>
                                                                    <ul class="collapse" id="room-{{ $room->id }}">

                                                                        @if ($room?->room_beds && $room?->room_beds->count() > 0)
                                                                            @foreach ($room?->room_beds as $bed)
                                                                                <li>
                                                                                    <i class="fas fa-procedures"></i>
                                                                                    {{ $bed->display_name }}
                                                                                    @if ($bed->bed_status == 'used')
                                                                                        <span
                                                                                            class="badge badge-danger">Occupied</span>
                                                                                    @else
                                                                                        <span
                                                                                            class="badge badge-success">Available</span>
                                                                                    @endif
                                                                                </li>
                                                                            @endforeach
                                                                        @endif

                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
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

            $(document).on("change", "select[name='umr']", function() {
                @this.call("umrChanged");
            });

            $(document).on("change", "select[name='ipd_id']", function() {
                @this.call("ipdChanged");
            });
        </script>
    @endpush
</div>
