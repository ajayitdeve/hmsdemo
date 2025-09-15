<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Specimen Setup</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Specimen Setup</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add"><i
                            class="fa fa-plus"></i> Add Specimen Setup</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 12, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                {{-- 'code', 'department_id', 'service_group_id', 'service_id', 'specimen_master_id', 'vacutainer_id', 'test_type_id', 'color_id', 'duration', 'dosage_qty','no_of_barcode', 'short_name', 'precaution', 'clinical_history','is_applicable_for_others_test', 'is_required_precaution_on_bill', 'is_infection_dieases','is_curable', 's1_cd', 's2_cd', 'is_active', 'created_by_id', 'updated_by_id' --}}
                                <th>S.No.</th>
                                <th>Department</th>
                                <th>Service Group</th>
                                <th>Test</th>
                                <th>Specimen Code</th>
                                <th>Vacutainer</th>
                                <th>Test Type</th>
                                <th>Duration</th>
                                <th>Dosage</th>
                                <th>Bar Codes</th>
                                <th>Short Name</th>
                                <th>Is Active</th>
                                <th>Created At</th>

                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($specimenSetups as $index => $specimenSetup)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $specimenSetup->department != null ? $specimenSetup->department->name : null }}
                                    </td>
                                    <td>{{ $specimenSetup->serviceGroup != null ? $specimenSetup->serviceGroup->name : null }}
                                    </td>
                                    <td>{{ $specimenSetup->service != null ? $specimenSetup->service->code : null }}
                                    </td>
                                    <td>{{ $specimenSetup->SpecimenMaster != null ? $specimenSetup->SpecimenMaster->code : null }}
                                    </td>
                                    <td>{{ $specimenSetup->vacutainer != null ? $specimenSetup->vacutainer->name : null }}
                                    </td>
                                    <td>{{ $specimenSetup->testType != null ? $specimenSetup->testType->name : null }}
                                    </td>
                                    <td>{{ $specimenSetup->duration }}</td>
                                    <td>{{ $specimenSetup->dosage_qty }}</td>
                                    <td>{{ $specimenSetup->no_of_barcode }}</td>
                                    <td>{{ $specimenSetup->short_name }}</td>
                                    <td>
                                        @if ($specimenSetup->is_active)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                    <td>{{ $specimenSetup->created_at }}</td>

                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button wire:click="edit({{ $specimenSetup->id }})"
                                                    class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#edit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                                                <button wire:click="delete({{ $specimenSetup->id }})"
                                                    class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div>
                        {{-- {{ $specimens->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    @include('livewire.pathology.specimen-set-up.modal')

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
