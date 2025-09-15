<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Test Format Setup</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Test Format Setup</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Department <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" readonly
                                value="{{ $format->department->name }}" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Service Group <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" readonly
                                value="{{ $format->serviceGroup->name }}" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Service <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" readonly value="{{ $format->service->name }}" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" readonly value="{{ $format->name }}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Format Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" readonly value="{{ $format->name }}" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" readonly value="{{ $format->code }}" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Method <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" readonly value="{{ $format->method }}" />
                        </div>
                    </div>

                </div>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <h3>Existing Parameters</h3>
                        <table class="table table-bordered custom-table mb-0">
                            <thead>
                                <tr style="font-size: 12px;">
                                    <th>Id</th>
                                    <th>Sub Title</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($format->formatParameters as $formatParameter)
                                    <tr>
                                        <td>{{ $formatParameter->parameter->id }}</td>
                                        <td>{{ $formatParameter->sub_title }}</td>
                                        <td>{{ $formatParameter->parameter->code }} </td>
                                        <td>{{ $formatParameter->parameter->name }}</td>
                                        <td> <button wire:click="delete({{ $formatParameter->parameter->id }})"
                                                class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete"><i class="fa fa-trash-o m-r-5"></i>
                                                Delete</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <hr />
                <div class="row mt-2">
                    <div class="col-md-12">
                        <h3>Add New Parameters</h3>
                        <table class="table table-bordered custom-table mb-0">
                            <thead>
                                <tr style="font-size: 12px;">
                                    <th>Id</th>
                                    <th>Sub Title</th>
                                    <th>Parameter Desc</th>
                                    <th>Parameter Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parameterValuesArr as $parameterValue)
                                    <tr>
                                        <td>{{ $parameterValue['id'] }} <button type="button" class="btn-primary"
                                                wire:click="deleteCart({{ $parameterValue['id'] }})"><i
                                                    class="fa fa-trash"></i></button></td>
                                        <td>{{ $parameterValue['sub_title'] }}</td>
                                        <td>{{ $parameterValue['parameter_name'] }}</td>
                                        <td>{{ $parameterValue['parameter_code'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <form wire:submit.prevent='save' class="pt-2 mt-4">
                    <div class="row mb-0 pb-0">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Title</label>
                                <input type="text" class="form-control" wire:model='sub_title' />
                                @error('sub_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Parameters<span class="text-danger">*</span></label>
                                <select wire:model='parameter_id' class="form-control">
                                    <option value="">Select </option>
                                    @foreach ($parameters as $parameter)
                                        <option value="{{ $parameter->id }}">{{ $parameter->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parameter_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 pt-2">
                            <button type="button" class="btn btn-primary d-block mt-4"
                                wire:click="addToCart">Add</button>
                        </div>

                    </div>


                    <div class="ubmit-section mt-0 pt-0 text-center">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>

            {{-- modal --}}
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
                                                class="btn btn-primary continue-btn btn-block">Delete</>
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

            {{-- end of destroy Modal --}}
        </div>
    </div>
</div>
