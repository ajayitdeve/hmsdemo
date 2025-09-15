<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Consultation List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Consultation List</li>
                    </ul>
                </div>
                {{-- <div class="col-auto float-right ml-auto">
                    <a href="{{route('admin.patientvisit.create')}}" class="btn add-btn" ><i class="fa fa-plus"></i> New Registration</a>
                </div> --}}
            </div>
        </div>
        <!-- /Page Header -->
        {{-- <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control mb-2" wire:model.live.debounce.300mx="search" placeholder="search">
            </div>
        </div> --}}
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 7, "desc" ]]' class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Consultation No.</th>
                                <th>UMR</th>
                                <th>Name</th>
                                <th>Relation</th>
                                <th>Relation Name</th>
                                <th>Mobile</th>
                                <th>Visit Type</th>
                                <th>Visit Date</th>
                                <th>Unit</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patientvisits as $patientvisit)
                                <tr>
                                    <td>
                                        {{ $patientvisit->visit_no }}
                                        <a href="javasctipt:void(0);" class="btn btn-sm btn-danger btn-block"
                                            wire:click="view_cancel_consultation({{ $patientvisit->id }})">
                                            <i class="fa fa-close"></i>
                                            Consultation
                                        </a>
                                    </td>
                                    <td>{{ $patientvisit->patient->registration_no }}</td>
                                    <td>
                                        {{ $patientvisit->patient->name }}
                                    </td>
                                    <td>
                                        {{ $patientvisit?->patient?->relation?->name }}
                                    </td>
                                    <td>
                                        {{ $patientvisit?->patient?->father_name }}
                                    </td>
                                    <td>{{ $patientvisit->patient->mobile }}</td>
                                    <td>{{ $patientvisit->visit_type == 1 ? 'Paid' : 'Free' }} /
                                        {{ $patientvisit->visitType != null ? $patientvisit->visitType->name : null }}
                                        {{ $patientvisit->foc == 1 ? 'FOC' : null }}</td>
                                    <td>{{ $patientvisit->visit_date }}</td>
                                    <td>{{ $patientvisit->unit->name }}</td>
                                    <td>{{ $patientvisit->patient->address }}</td>
                                    <td>
                                        @if ($patientvisit->visit_type == 1)
                                            <a href="{{ route('admin.patient.print-receipt', $patientvisit->id) }}"
                                                class="btn add-btn btn-sm mb-1"><i class="fa fa-inr"></i>Print
                                                Prescription
                                            </a>
                                        @endif

                                        <a href="{{ route('admin.patient.print_consultation_charge', $patientvisit->id) }}"
                                            class="btn add-btn btn-sm"><i class="fa fa-user"></i>Print Consult.
                                        </a>
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

    <!-- Cancel Modal -->
    <div wire:ignore.self class="modal custom-modal fade" id="cancelModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cancel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='cancel'>
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

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Cancel Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('page-script')
        <script>
            window.addEventListener('show-cancel-modal', event => {
                $("#cancelModal").modal('show');
            });

            window.addEventListener('hide-cancel-modal', event => {
                $("#cancelModal").modal('hide');
            });
        </script>
    @endpush
</div>
