<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Department Consultation Fee</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Department Consultation Fee</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">

                </div>
            </div>
        </div>

        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Select Department</label>
                    <select class="form-control" wire:model="department_id" wire:change="departmentChanged" autofocus>
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        @if ($departmentConsultationFees != null)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Department Fee </h4>
                        </div>
                        <div class="card-body">

                            <table class="datatable table table-stripped mb-0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Department</th>
                                        <th>Fee(INR)</th>
                                        <th>Date of Change</th>
                                        <th>Is Active</th>
                                        <th>Created By</th>
                                        <th>Updated By</th>
                                        <th>Approved By</th>
                                        <th>Remarks</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departmentConsultationFees as $index => $departmentConsultationFee)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $departmentConsultationFee->department->name }}</td>
                                            <td>{{ $departmentConsultationFee->fee }}</td>
                                            <td>{{ $departmentConsultationFee->doc != null ? $departmentConsultationFee->doc : null }}
                                            </td>
                                            <td>{{ $departmentConsultationFee->is_active == 1 ? 'Yes' : 'No' }}</td>
                                            <td>{{ $departmentConsultationFee->createdById != null ? $departmentConsultationFee->createdById->name : null }}
                                            </td>
                                            <td>{{ $departmentConsultationFee->updatedById != null ? $departmentConsultationFee->updatedById->name : null }}
                                            </td>
                                            <td>{{ $departmentConsultationFee->approvedById != null ? $departmentConsultationFee->approvedById->name : null }}
                                            </td>
                                            <td>{{ $departmentConsultationFee->remarks }}</td>
                                            <td>{{ date('d-M-Y', strtotime($departmentConsultationFee->created_at)) }}
                                            </td>
                                            <td>{{ date('d-M-Y', strtotime($departmentConsultationFee->updated_at)) }}
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Change Department Fee</h4>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent='save'>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">New Fee</label>
                                            <input type="number" class="form-control" wire:model="newFee" />
                                            @error('newFee')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Date of change (eof)</label>
                                            <input type="date" class="form-control" wire:model="doc" />
                                            @error('doc')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Approved By</label>
                                            <select class="form-control" wire:model="approved_by_id">
                                                <option value="">Select</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('approved_by_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Remarks</label>
                                            <input type="text" class="form-control" wire:model="remarks" />
                                            @error('remarks')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="submit" class="btn btn-primary" value="Submit" />
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        @endif

        <!-- /Page Content -->


    </div>
