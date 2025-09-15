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
<!-- Delete Holiday Modal -->
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
                                <button type="submit" class="btn btn-primary continue-btn btn-block">Delete</>
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
<!-- Add  Modal -->
<div wire:ignore.self class="modal custom-modal fade" id="add" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Package</h5>
                {{-- <button wire:click="selectedServices">Selected Services</button> --}}
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()' aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('partials.alert-message')

                <form wire:submit.prevent='save'>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Teriff <span class="text-danger">*</span></label>
                                <select wire:model='teriff_id' class="form-control">
                                    <option value="">Select Teriff</option>
                                    @foreach ($teriffs as $teriff)
                                        <option value="{{ $teriff->id }}">{{ $teriff->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('teriffe_id')
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
                                <label>Billing Head <span class="text-danger">*</span></label>
                                <select wire:model='billing_head_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($billingheads as $billinghead)
                                        <option value="{{ $billinghead->id }}">{{ $billinghead->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('billing_head_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cost Center <span class="text-danger">*</span></label>
                                <select wire:model='cost_center_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($costcenters as $costcenter)
                                        <option value="{{ $costcenter->id }}">{{ $costcenter->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cost_center_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Location <span class="text-danger">*</span></label>
                                <select wire:model='location_id' class="form-control">
                                    <option value="">Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Service Type<span class="text-danger">*</span></label>
                                <select wire:model='type' class="form-control">
                                    <option value="">Select</option>
                                    <option value="S">Service </option>
                                    <option value="I">Investigation </option>
                                    <option value="M">Miscellaneous </option>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Package Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model='name' />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Service Charge<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model='charge' />
                                @error('charge')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Emergency Charge<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model='emergency_charge' />
                                @error('emergency_charge')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Hospital %</label>
                                <input type="number" class="form-control" wire:model='hospital_percent' />
                                @error('hospital_percent')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Hospital Amount</label>
                                <input type="number" class="form-control" wire:model='hospital_amount' />
                                @error('hospital_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor % </label>
                                <input type="number" wire:model='doctor_percent' class="form-control">

                                @error('doctor_percent')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor amount </label>
                                <input type="number" wire:model='doctor_amount' class="form-control">

                                @error('doctor_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="row mr-2 pr-2">
                        {{-- <div class="col-md-3">
                            <div class="d-flex gap-2 align-items-center border p-2">
                                <input type="checkbox" wire:model='ispackage' id="ispackage" />
                                <label for="ispackage">
                                    <strong>Is Package</strong>
                                </label>
                            </div>

                            @error('ispackage')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        <div class="col-md-3">
                            <div class="d-flex gap-2 align-items-center border p-2">
                                <input type="checkbox" wire:model='isprocedure' id="isprocedure" />
                                <label for="isprocedure">
                                    <strong>Is Procedure</strong>
                                </label>
                            </div>

                            @error('isprocedure')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex gap-2 align-items-center border p-2">
                                <input type="checkbox" wire:model='isoutside' id="isoutside" />
                                <label for="isoutside">
                                    <strong>Is OutSide</strong>
                                </label>
                            </div>

                            @error('isoutside')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex gap-2 align-items-center border p-2">
                                <input type="checkbox" wire:model='issampleneeded' id="issampleneeded" />
                                <label for="issampleneeded">
                                    <strong>Is Sample Needed</strong>
                                </label>
                            </div>

                            @error('issampleneeded')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex gap-2 align-items-center border p-2">
                                <input type="checkbox" wire:model='isdiet' id="isdiet" />
                                <label for="isdiet">
                                    <strong>Is Diet</strong>
                                </label>
                            </div>

                            @error('isdiet')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table datatable table-stripped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>S.No.</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Teriff</th>
                                            <th>Service Group</th>
                                            <th>Charge </th>
                                            <th>Emg. Charge</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $index => $service)
                                            <tr>
                                                <td><input type="checkbox" wire:model='selected'
                                                        value="{{ $service->id }}"></td>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $service->code }}</td>
                                                <td>{{ $service->name }}</td>
                                                <td>{{ $service->teriff != null ? $service->teriff->name : null }}
                                                </td>
                                                <td>{{ $service->servicegroup->name }}</td>
                                                <td>{{ $service->charge }}</td>
                                                <td>{{ $service->emergency_charge }}</td>
                                                <td>{{ $service->type }}</td>
                                                <td>{{ $service->isactive ? 'Active' : 'InActive' }}</td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"><i
                                                                class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <button wire:click="edit({{ $service->id }})"
                                                                class="dropdown-item" href="#"
                                                                data-toggle="modal" data-target="#edit"><i
                                                                    class="fa fa-pencil m-r-5"></i> Edit</button>
                                                            <button wire:click="delete({{ $service->id }})"
                                                                class="dropdown-item" href="#"
                                                                data-toggle="modal" data-target="#delete"><i
                                                                    class="fa fa-trash-o m-r-5"></i>
                                                                Delete</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="ubmit-section mt-0 pt-0 text-center">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Modal -->

<!-- Edit Modal -->
<div wire:ignore.self class="modal custom-modal fade" id="edit" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Package</h5>

                {{-- <button wire:click="selectedServices">Selected Services</button> --}}
                <button type="button" class="close" data-dismiss="modal" wire:click='closeModal()'
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('partials.alert-message')

                <form wire:submit.prevent='update'>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Teriff <span class="text-danger">*</span></label>
                                <select wire:model='teriff_id' class="form-control">
                                    <option value="">Select Teriff</option>
                                    @foreach ($teriffs as $teriff)
                                        <option value="{{ $teriff->id }}">{{ $teriff->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('teriffe_id')
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
                                <label>Billing Head <span class="text-danger">*</span></label>
                                <select wire:model='billing_head_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($billingheads as $billinghead)
                                        <option value="{{ $billinghead->id }}">{{ $billinghead->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('billing_head_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cost Center <span class="text-danger">*</span></label>
                                <select wire:model='cost_center_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($costcenters as $costcenter)
                                        <option value="{{ $costcenter->id }}">{{ $costcenter->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cost_center_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Location <span class="text-danger">*</span></label>
                                <select wire:model='location_id' class="form-control">
                                    <option value="">Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Service Type<span class="text-danger">*</span></label>
                                <select wire:model='type' class="form-control">
                                    <option value="">Select</option>
                                    <option value="S">Service </option>
                                    <option value="I">Investigation </option>
                                    <option value="M">Miscellaneous </option>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Package Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model='name' />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Service Charge<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model='charge' />
                                @error('charge')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Emergency Charge<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model='emergency_charge' />
                                @error('emergency_charge')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Hospital %</label>
                                <input type="number" class="form-control" wire:model='hospital_percent' />
                                @error('hospital_percent')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Hospital Amount</label>
                                <input type="number" class="form-control" wire:model='hospital_amount' />
                                @error('hospital_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor % </label>
                                <input type="number" wire:model='doctor_percent' class="form-control">

                                @error('doctor_percent')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Doctor amount </label>
                                <input type="number" wire:model='doctor_amount' class="form-control">

                                @error('doctor_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>

                    <div class="row mr-2 pr-2">
                        {{-- <div class="col-md-3">
                            <div class="d-flex gap-2 align-items-center border p-2">
                                <input type="checkbox" wire:model='ispackage' id="ispackage" />
                                <label for="ispackage">
                                    <strong>Is Package</strong>
                                </label>
                            </div>

                            @error('ispackage')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        <div class="col-md-3">
                            <div class="d-flex gap-2 align-items-center border p-2">
                                <input type="checkbox" wire:model='isprocedure' id="isprocedure" />
                                <label for="isprocedure">
                                    <strong>Is Procedure</strong>
                                </label>
                            </div>

                            @error('isprocedure')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex gap-2 align-items-center border p-2">
                                <input type="checkbox" wire:model='isoutside' id="isoutside" />
                                <label for="isoutside">
                                    <strong>Is OutSide</strong>
                                </label>
                            </div>

                            @error('isoutside')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex gap-2 align-items-center border p-2">
                                <input type="checkbox" wire:model='issampleneeded' id="issampleneeded" />
                                <label for="issampleneeded">
                                    <strong>Is Sample Needed</strong>
                                </label>
                            </div>

                            @error('issampleneeded')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex gap-2 align-items-center border p-2">
                                <input type="checkbox" wire:model='isdiet' id="isdiet" />
                                <label for="isdiet">
                                    <strong>Is Diet</strong>
                                </label>
                            </div>

                            @error('isdiet')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table edit-datatable table-stripped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>S.No.</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Teriff</th>
                                            <th>Service Group</th>
                                            <th>Charge </th>
                                            <th>Emg. Charge</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $index => $service)
                                            <tr>
                                                <td><input type="checkbox" wire:model='selected'
                                                        value="{{ $service->id }}"></td>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $service->code }}</td>
                                                <td>{{ $service->name }}</td>
                                                <td>{{ $service->teriff != null ? $service->teriff->name : null }}</td>
                                                <td>{{ $service->servicegroup->name }}</td>
                                                <td>{{ $service->charge }}</td>
                                                <td>{{ $service->emergency_charge }}</td>
                                                <td>{{ $service->type }}</td>
                                                <td>{{ $service->isactive ? 'Active' : 'InActive' }}</td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"><i
                                                                class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <button wire:click="edit({{ $service->id }})"
                                                                class="dropdown-item" href="#"
                                                                data-toggle="modal" data-target="#edit"><i
                                                                    class="fa fa-pencil m-r-5"></i> Edit</button>
                                                            <button wire:click="delete({{ $service->id }})"
                                                                class="dropdown-item" href="#"
                                                                data-toggle="modal" data-target="#delete"><i
                                                                    class="fa fa-trash-o m-r-5"></i> Delete</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="ubmit-section mt-0 pt-0 text-center">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Modal -->
