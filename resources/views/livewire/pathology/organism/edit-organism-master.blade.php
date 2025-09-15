<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Organism Master (Antibiotic Setup Form)</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Organism Master</li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">

            <form wire:submit.prevent='save'>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Department <span class="text-danger">*</span></label>
                            <select wire:model='department_id' class="form-control" wire:change='departmentChanged'>
                                <option value="">Select </option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Service Group <span class="text-danger">*</span></label>
                            <select wire:model='service_group_id' class="form-control">
                                <option value="">Select </option>
                                @foreach ($servicegroups as $servicegroup)
                                    <option value="{{ $servicegroup->id }}">{{ $servicegroup->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_group_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model='name' />
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex mt-4 pl-4">
                            <label> Is Active</label>
                            <input type="checkbox" class="form-check-input" wire:model='is_active'>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex mt-4 pl-4">
                            <label> Is default</label>
                            <input type="checkbox" class="form-check-input" wire:model='default_organism'>
                        </div>
                    </div>
                </div>

                @if ($currentOrganismMaster != null)
                    @if ($exist_antibiotics != null)
                        <div class="card">
                            <div class="card-header">
                                <p>Existing Antibiotics Details</p>
                                <div class="table-responsive">
                                    <table class="table table-bordered custom-table mb-0">
                                        <thead>
                                            <tr style="font-size: 12px;">
                                                <th>SN</th>
                                                <th>Anti. Code</th>
                                                <th>Desc</th>
                                                <th>Senstive</th>
                                                <th>Moderate</th>
                                                <th>Resistence</th>
                                                <th>Is Active</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($exist_antibiotics as $antibiotic)
                                                <tr>
                                                    <td>{{ $loop->iteration }} </td>
                                                    <td>{{ $antibiotic->antibiotic != null ? $antibiotic->antibiotic->code : null }}
                                                    </td>
                                                    <td>{{ $antibiotic->antibiotic != null ? $antibiotic->antibiotic->name : null }}
                                                    </td>
                                                    <td>{{ $antibiotic->antibiotic != null ? $antibiotic->antibiotic->senstive : null }}
                                                    </td>
                                                    <td>{{ $antibiotic->antibiotic != null ? $antibiotic->antibiotic->moderate : null }}
                                                    </td>
                                                    <td>{{ $antibiotic->antibiotic != null ? $antibiotic->antibiotic->resistance : null }}
                                                    </td>
                                                    <td><input class="form-control" style="height:15px; width:15px;"
                                                            type="checkbox" checked disabled></td>
                                                    <td> <button type="button"
                                                            wire:click="delete({{ $antibiotic->id }})"
                                                            class="dropdown-item text-danger" data-toggle="modal"
                                                            data-target="#delete"><i class="fa fa-trash m-r-5"></i>
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                <div class="card">
                    <div class="card-header">
                        <p>Antibiotics Details</p>
                        <div class="table-responsive">
                            <table class="table table-bordered custom-table mb-0">
                                <thead>
                                    <tr style="font-size: 12px;">
                                        <th>SN</th>
                                        <th>Anti. Code</th>
                                        <th>Desc</th>
                                        <th>Senstive</th>
                                        <th>Moderate</th>
                                        <th>Resistence</th>
                                        <th>Is Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($antibioticValuesArr as $antibioticValue)
                                        <tr>
                                            <td>{{ $antibioticValue['id'] }} <button type="button" class="btn-primary"
                                                    wire:click="deleteCart({{ $antibioticValue['id'] }})"><i
                                                        class="fa fa-trash"></i></button></td>
                                            <td>{{ $antibioticValue['code'] }}</td>
                                            <td>{{ $antibioticValue['name'] }}</td>
                                            <td>{{ $antibioticValue['senstive'] }}</td>
                                            <td>{{ $antibioticValue['moderate'] }}</td>
                                            <td>{{ $antibioticValue['resistance'] }}</td>
                                            <td><input class="form-control" style="height:15px; width:15px;"
                                                    type="checkbox" disabled
                                                    @if ($antibioticValue['is_active']) checked @endif></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-0 pb-0">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Antibiotic Name<span class="text-danger">*</span></label>
                                    <select wire:model='antibiotic_id' class="form-control"
                                        wire:change='antibioticChanged'>
                                        <option value="">Select </option>
                                        @foreach ($antibiotics as $antibiotic)
                                            <option value="{{ $antibiotic->id }}">{{ $antibiotic->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('antibiotic_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>code</label>
                                    <input type="text" class="form-control" readonly wire:model='antibiotic_name'>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Moderate</label>
                                    <input type="text" class="form-control" readonly
                                        wire:model='antibiotic_moderate'>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Sensitive</label>
                                    <input type="text" class="form-control" readonly
                                        wire:model='antibiotic_senstive'>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Moderate</label>
                                    <input type="text" class="form-control" readonly
                                        wire:model='antibiotic_moderate'>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Is Active</label>
                                    <input class="form-control" type="checkbox" disabled
                                        @if ($antibiotic_is_active) checked @endif>
                                </div>

                            </div>


                            <div class="col-md-3 text-center">
                                <br />
                                <button style="float:right" type="button" class="btn btn-primary btn-sm d-block "
                                    wire:click="addToCart">Add</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="ubmit-section mt-0 pt-0  mb-1 text-center">
                    <button class="btn btn-primary submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Delete  Modal -->
    <div wire:ignore.self class="modal custom-modgal fade" id="delete" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form wire:submit.prevent='destroy'>
                        <div class="form-header">
                            <h3>Delete </h3>
                            <p>Are you sure want to delete ?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit"
                                        class="btn btn-primary continue-btn btn-block">Delete</button>
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
    <!-- /Delete  Modal -->
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
