<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Lab Indent List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Lab Indent List</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 9, "desc" ]]' class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Indent No.</th>
                                <th>IPD</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>Remarks</th>
                                <th>Instructions</th>
                                <th>Diagnosis</th>
                                <th>Is Cancelled</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lab_indents as $lab_indent)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.nurse.service-lab-indent.view-lab-indent', $lab_indent->id) }}">
                                            {{ $lab_indent->code }}
                                        </a>
                                    </td>
                                    <td>{{ $lab_indent->ipd?->ipdcode }}</td>
                                    <td>{{ $lab_indent->patient?->registration_no }}</td>
                                    <td>{{ $lab_indent->patient?->name }}</td>
                                    <td>{{ $lab_indent->remarks }}</td>
                                    <td>{{ $lab_indent->instructions }}</td>
                                    <td>{{ $lab_indent->clinical_summary_diagnosis }}</td>
                                    <td>
                                        @if ($lab_indent->is_cancelled == 0)
                                            <a class="text-success" href="javascript:void(0)"
                                                wire:click="view_cancel_indent({{ $lab_indent->id }}, true)">NO</a>
                                        @else
                                            <a class="text-danger" href="javascript:void(0)"
                                                wire:click="view_cancel_indent({{ $lab_indent->id }}, false)">YES</a>
                                        @endif
                                    </td>
                                    <td>{{ $lab_indent->status }}</td>
                                    <td>{{ $lab_indent->created_at }}</td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <a class="dropdown-item"
                                                    href="{{ route('admin.nurse.service-lab-indent.view-lab-indent', $lab_indent->id) }}"><i
                                                        class="fa fa-eye m-r-5"></i> View</a>
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

    <!-- Cancel Indent Modal -->
    <div wire:ignore.self class="modal custom-modal fade" id="cancelIndent" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cancel Indent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='cancel_indent'>
                        <div class="form-group">
                            <label>Reason</label>
                            <textarea class="form-control" wire:model="reason"></textarea>
                            @error('reason')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Approved By</label>
                            <select class="form-control" wire:model="approved_by">
                                <option value="">Select one</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('approved_by')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @if ($show_cancel_button)
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Cancel Now</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('page-script')
        <script>
            window.addEventListener('show-cancel-modal', event => {
                $("#cancelIndent").modal('show');
            });
            window.addEventListener('hide-cancel-modal', event => {
                $("#cancelIndent").modal('hide');
            });
        </script>
    @endpush

</div>
