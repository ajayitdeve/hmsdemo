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
                            <h3 class="page-title">Organization Master</h3>
                        </div>
                    </div>
                </div>

                <hr />
                <form wire:submit.prevent='save' class="mb-0 pb-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-0 pb-0">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Organization Code</label>
                                        <input class="form-control" wire:model="code" type="text" readonly />
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Organization Name <span class="text-danger">*</span></label>
                                        <input class="form-control" wire:model="name" type="text" />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="row">
                                        <label>Organization / Insurance</label>
                                    </div>
                                    <div class="form-group row pt-1">

                                        <div class="form-check col-md-5">
                                            <input type="radio" class="form-check-input" wire:model="type"
                                                value="C">Organization
                                            <label class="form-check-label" for="radio1"></label>
                                        </div>
                                        <div class="form-check col-md-5">
                                            <input type="radio" class="form-check-input" wire:model="type"
                                                value="I">Insurance
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group input-group">

                                        <select class="form-control" wire:model="color">
                                            <option value="">Select color</option>
                                            @foreach ($colors as $myColor)
                                                <option value="{{ $myColor->code }}"
                                                    style="background:#{{ $myColor->code }}">{{ $myColor->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div
                                            style="height:50px width:100px; background:#{{ $color }}; color:#{{ $color }}">
                                            {{ $color }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group row input-group">
                                        <label class="col-md-6">Letter Required {{ $isletterrequired }}</label>
                                        <input class="form-control  text-left" type="checkbox"
                                            wire:model="isletterrequired" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-0 pb-0">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Contract Date <span class="text-danger">*</span></label>
                                        <input class="form-control" type="date" wire:model="contractdate" />
                                        @error('contractdate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Effect From <span class="text-danger">*</span></label>
                                        <input class="form-control" type="date" wire:model="effectedfrom" />
                                        @error('effectedfrom')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Effect To <span class="text-danger">*</span></label>
                                        <input class="form-control" type="date" wire:model="effectedto" />
                                        @error('effectedto')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Contact Person <span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model="contact_person_id">
                                            <option value="">Select Contact Person</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                            @error('contact_person_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>PAN
                                            {{-- <span class="text-danger">*</span> --}}
                                        </label>
                                        <input class="form-control" type="text" wire:model="pan" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>TAN
                                            {{-- <span class="text-danger">*</span> --}}
                                        </label>
                                        <input class="form-control" type="text" wire:model="tan" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>GST No</label>
                                        <input class="form-control" type="text" wire:model="gstcode" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Bill Clearance Days</label>
                                        <input class="form-control" type="number" wire:model="clearancedays" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="row">
                                        <label>Pharmacy</label>
                                    </div>
                                    <div class="form-group row pt-1">

                                        <div class="form-check col-md-5">
                                            <input type="radio" class="form-check-input" wire:model="pharmacy"
                                                value="cash">Cash
                                            <label class="form-check-label" for="radio1"></label>
                                        </div>
                                        <div class="form-check col-md-5">
                                            <input type="radio" class="form-check-input" wire:model="pharmacy"
                                                value="credit">Credit
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Cost Center</label>
                                        <select class="form-control" wire:model="cost_center_id">
                                            @foreach ($costCenters as $costCenter)
                                                <option value="{{ $costCenter->id }}">{{ $costCenter->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <input class="form-control" type="text" wire:model="remarks" />
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row mb-0 pb-0">
                                <div class="col-sm-1">
                                    <br />
                                    &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;OP
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label>OP Org %</label>
                                        <input class="form-control" type="number" wire:model="ip_org_percent" />
                                    </div>
                                </div>

                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label>IP Emp %</label>
                                        <input class="form-control" type="number" wire:model="ip_emp_percent" />
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <br />
                                    &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;IP
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label>OP Org %</label>
                                        <input class="form-control" type="number" wire:model="op_org_percent" />
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label>OP Emp %</label>
                                        <input class="form-control" type="number" wire:model="op_emp_percent" />
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <br />
                                    Consultation
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label>Numbers</label>
                                        <input class="form-control" type="number"
                                            wire:model="consultation_number" />
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label>Days</label>
                                        <input class="form-control" type="number" wire:model="consultation_days" />
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label>Disc %</label>
                                        <input class="form-control" type="number"
                                            wire:model="consultation_discount" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <hr>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" wire:model="address" />
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>City <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" wire:model="city" />
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>State <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" wire:model="state" />
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Country <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" wire:model="country" />
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Pin Code</label>
                                <input class="form-control" type="number" wire:model="country" />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" type="number" wire:model="phone" />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Alt Phone</label>
                                <input class="form-control" type="number" wire:model="alt_phone" />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" wire:model="email" />
                            </div>
                        </div>

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

                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Effected From</th>
                                        <th>Effected To</th>
                                        <th>color</th>
                                        <th>Is Active</th>
                                        <th>Created At</th>
                                        {{-- <th class="text-right">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($organizations as $organization)
                                        <tr>

                                            <td>{{ $organization->name }}</td>
                                            <td>{{ $organization->code }}</td>
                                            <td>{{ $organization->type }}</td>
                                            <td>{{ $organization->effectedfrom }}</td>
                                            <td>{{ $organization->effectedto }}</td>
                                            <td>{{ $organization->color }}</td>
                                            <td>{{ $organization->isactive }}</td>
                                            <td>{{ $organization->created_at }}</td>
                                            {{-- <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <button wire:click="edit({{ $organization->id }})"
                                                            class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#edit"><i class="fa fa-pencil m-r-5"></i>
                                                            Edit</button>
                                                        <button wire:click="delete({{ $organization->id }})"
                                                            class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#delete"><i class="fa fa-trash-o m-r-5"></i>
                                                            Delete</button>
                                                    </div>
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                            <div>
                                {{-- {{ $organizations->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
