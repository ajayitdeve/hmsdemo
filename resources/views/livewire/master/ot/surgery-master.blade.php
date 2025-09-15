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
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Surgery</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Surgery</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto" data-toggle="tooltip" data-placement="top" title="ALT+C">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add" tabindex="1"><i
                            class="fa fa-plus"></i> Add Surgery</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 7, "desc" ]]' class="table datatable table-striped custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Sur.DesigCd</th>
                                <th>Tariff Code</th>
                                <th>Surgery Name</th>
                                <th>Surgery Type Name</th>
                                <th>Department</th>
                                <th>Amount</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surgery_list as $surgery)
                                <tr>
                                    <td>{{ $surgery->code }}</td>
                                    <td>{{ $surgery?->tariff?->code }}</td>
                                    <td>{{ $surgery?->service?->name }}</td>
                                    <td>{{ $surgery?->surgery_type?->name }}</td>
                                    <td>{{ $surgery?->department?->name }}</td>
                                    <td>{{ $surgery->amount }}</td>
                                    <td>{{ $surgery?->created_by?->name }}</td>
                                    <td>{{ $surgery->created_at }}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button wire:click="edit({{ $surgery->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#edit"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</button>
                                                <button wire:click="delete({{ $surgery->id }})" class="dropdown-item"
                                                    href="#" data-toggle="modal" data-target="#delete"><i
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

    <!-- Add  Modal -->
    <div wire:ignore.self class="modal custom-modal fade" id="add" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Surgery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='save'>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tariff<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="tariff_id"
                                        data-placeholder="Select Tariff" wire:model='tariff_id'>
                                        <option value=""></option>
                                        @foreach ($tariffs as $tariff)
                                            <option value="{{ $tariff->id }}">{{ $tariff->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tariff_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tariff Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly wire:model='tariff_code'>
                                    @error('tariff_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surgery Design Code</label>
                                    <input type="text" class="form-control" readonly wire:model='surgery_code'>
                                    @error('surgery_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surgery/Procedure<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="service_id"
                                        data-placeholder="Select Surgery/Procedure" wire:model='service_id'>
                                        <option value=""></option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('service_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surgery/Procedure Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly wire:model='service_code'>
                                    @error('service_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surgery Amount</label>
                                    <input type="text" class="form-control" readonly wire:model='surgery_amount'>
                                    @error('surgery_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surgery Type<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="surgery_type_id"
                                        data-placeholder="Select Surgery Type" wire:model='surgery_type_id'>
                                        <option value=""></option>
                                        @foreach ($surgery_types as $surgery_type)
                                            <option value="{{ $surgery_type->id }}">
                                                {{ $surgery_type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('surgery_type_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surgery Type Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly
                                        wire:model='surgery_type_code'>
                                    @error('surgery_type_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Estimated Duration</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" wire:model='estimated_duration'>

                                        <div class="input-group-append">
                                            <span class="input-group-text py-0" id="basic-addon2">min</span>
                                        </div>
                                    </div>
                                    @error('estimated_duration')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Department<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="department_id"
                                        data-placeholder="Select Department" wire:model='department_id'>
                                        <option value=""></option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Department Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly wire:model='department_code'>
                                    @error('department_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Equ Service</label>
                                    <input type="text" class="form-control" readonly wire:model='equ_service'>
                                    @error('equ_service')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Effect From</label>
                                    <input type="date" class="form-control" wire:model='effect_from'>
                                    @error('effect_from')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Effect To</label>
                                    <input type="date" class="form-control" wire:model='effect_to'>
                                    @error('effect_to')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Service Group</label>
                                    <input type="text" class="form-control" readonly wire:model='service_group'>
                                    @error('service_group')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surgery Description</label>
                                    <input type="text" class="form-control" wire:model='description'>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>S1</label>
                                    <input type="text" class="form-control" wire:model='s1'>
                                    @error('s1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>S2</label>
                                    <input type="text" class="form-control" wire:model='s2'>
                                    @error('s2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Payment On</th>
                                                <th>General Ward</th>
                                                <th>Semi Private</th>
                                                <th>Private</th>
                                                <th>Delux</th>
                                                <th>Triplesharing</th>
                                                <th>ICCU</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-control" wire:model='payment_on'>
                                                        <option value="">Select</option>
                                                        <option value="floor-nurse">Floor Nurse</option>
                                                        <option value="technician">Technician</option>
                                                        <option value="surgery">Surgery</option>
                                                        <option value="bill-amount">Bill Amount</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model='general_ward_amount'>
                                                    @error('general_ward_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model='semi_private_amount'>
                                                    @error('semi_private_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model='private_amount'>
                                                    @error('private_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model='delux_amount'>
                                                    @error('delux_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model='triplesharing_amount'>
                                                    @error('triplesharing_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model='iccu_amount'>
                                                    @error('iccu_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class=" submit-section">
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
                    <h5 class="modal-title">Edit Surgery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='update'>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tariff<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="tariff_id"
                                        data-placeholder="Select Tariff" wire:model='tariff_id'>
                                        <option value=""></option>
                                        @foreach ($tariffs as $tariff)
                                            <option value="{{ $tariff->id }}">{{ $tariff->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tariff_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tariff Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly wire:model='tariff_code'>
                                    @error('tariff_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surgery Design Code</label>
                                    <input type="text" class="form-control" readonly wire:model='surgery_code'>
                                    @error('surgery_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surgery/Procedure<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="service_id"
                                        data-placeholder="Select Surgery/Procedure" wire:model='service_id'>
                                        <option value=""></option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('service_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surgery/Procedure Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly wire:model='service_code'>
                                    @error('service_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surgery Amount</label>
                                    <input type="text" class="form-control" readonly wire:model='surgery_amount'>
                                    @error('surgery_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surgery Type<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="surgery_type_id"
                                        data-placeholder="Select Surgery Type" wire:model='surgery_type_id'>
                                        <option value=""></option>
                                        @foreach ($surgery_types as $surgery_type)
                                            <option value="{{ $surgery_type->id }}">
                                                {{ $surgery_type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('surgery_type_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surgery Type Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly
                                        wire:model='surgery_type_code'>
                                    @error('surgery_type_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Estimated Duration</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" wire:model='estimated_duration'>

                                        <div class="input-group-append">
                                            <span class="input-group-text py-0" id="basic-addon2">min</span>
                                        </div>
                                    </div>
                                    @error('estimated_duration')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Department<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="department_id"
                                        data-placeholder="Select Department" wire:model='department_id'>
                                        <option value=""></option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Department Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly wire:model='department_code'>
                                    @error('department_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Equ Service</label>
                                    <input type="text" class="form-control" readonly wire:model='equ_service'>
                                    @error('equ_service')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Effect From</label>
                                    <input type="date" class="form-control" wire:model='effect_from'>
                                    @error('effect_from')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Effect To</label>
                                    <input type="date" class="form-control" wire:model='effect_to'>
                                    @error('effect_to')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Service Group</label>
                                    <input type="text" class="form-control" readonly wire:model='service_group'>
                                    @error('service_group')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surgery Description</label>
                                    <input type="text" class="form-control" wire:model='description'>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>S1</label>
                                    <input type="text" class="form-control" wire:model='s1'>
                                    @error('s1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>S2</label>
                                    <input type="text" class="form-control" wire:model='s2'>
                                    @error('s2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Payment On</th>
                                                <th>General Ward</th>
                                                <th>Semi Private</th>
                                                <th>Private</th>
                                                <th>Delux</th>
                                                <th>Triplesharing</th>
                                                <th>ICCU</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-control" wire:model='payment_on'>
                                                        <option value="">Select</option>
                                                        <option value="floor-nurse">Floor Nurse</option>
                                                        <option value="technician">Technician</option>
                                                        <option value="surgery">Surgery</option>
                                                        <option value="bill-amount">Bill Amount</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model='general_ward_amount'>
                                                    @error('general_ward_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model='semi_private_amount'>
                                                    @error('semi_private_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model='private_amount'>
                                                    @error('private_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model='delux_amount'>
                                                    @error('delux_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model='triplesharing_amount'>
                                                    @error('triplesharing_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire:model='iccu_amount'>
                                                    @error('iccu_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

            document.addEventListener('DOMContentLoaded', function() {
                $('#add').on('shown.bs.modal', function() {
                    $('#add select:first').trigger('focus');
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                $('#edit').on('shown.bs.modal', function() {
                    $('#edit select:first').trigger('focus');
                });
            });

            document.addEventListener('keydown', function(event) {
                // Check if Alt + C is pressed
                if (event.altKey && event.code === 'KeyC') {
                    event.preventDefault();
                    $('#add').modal('show');
                }
            });

            $('[data-toggle="tooltip"]').tooltip();


            $(document).ready(function() {
                $('.select2').select2({
                    width: '100%',
                });
            });

            $(document).on("change", ".select2", function() {
                let input_name = $(this).attr("name");
                @this.set(input_name, $(this).val());
            });

            $(document).on("change", "select[name='tariff_id']", function() {
                @this.call("changedTariff");
            });

            $(document).on("change", "select[name='service_id']", function() {
                @this.call("changedService");
            });

            $(document).on("change", "select[name='surgery_type_id']", function() {
                @this.call("changedSurgeryType");
            });

            $(document).on("change", "select[name='department_id']", function() {
                @this.call("changedDepartment");
            });
        </script>
    @endpush

</div>
