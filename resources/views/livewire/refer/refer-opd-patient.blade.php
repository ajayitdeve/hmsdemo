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
                    <table data-order='[[ 4, "desc" ]]' class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>UMR</th>
                                <th>Consultation No.</th>
                                <th>Visit Type</th>
                                <th>Visit Date</th>
                                <th>Unit</th>
                                <th>Doctor</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patientvisits as $patientvisit)
                                <tr>
                                    <td>{{ $patientvisit?->patient?->name }}</td>
                                    <td>{{ $patientvisit?->patient?->registration_no }}</td>
                                    <td>{{ $patientvisit->visit_no }}</td>
                                    <td>{{ $patientvisit->visit_type == 1 ? 'Paid' : 'Free' }}</td>
                                    <td>{{ $patientvisit->visit_date }}</td>
                                    <td>{{ $patientvisit->unit->name }}</td>
                                    <td>{{ $patientvisit->doctor != null ? $patientvisit?->doctor?->name : null }}</td>
                                    <td>
                                        <button wire:click="referPatient({{ $patientvisit->id }})"
                                            class="btn btn-primary btn-sm" href="#" data-toggle="modal"
                                            data-target="#referPatient"><i class="la la-stethoscope m-r-5"></i>Refer
                                            Patient</button>
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

    @include('livewire.refer.modal')

    @push('page-script')
        <script>
            window.addEventListener('close-modal', event => {
                $("#referPatient").modal('hide');
            });
        </script>
    @endpush

</div>
