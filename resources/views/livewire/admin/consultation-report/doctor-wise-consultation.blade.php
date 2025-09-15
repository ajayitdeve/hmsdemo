<div>

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Dr. {{ $doctor->name }} , Consultation List</h3>
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
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table data-order='[[ 0, "desc" ]]' class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>UMR</th>
                                <th>Consultation No.</th>
                                <th>Visit Type</th>
                                <th>Visit Date</th>
                                <th>Unit</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patientvisits as $patientvisit)
                                <tr>
                                    <td>{{ $patientvisit->patient->name }}</td>
                                    <td>{{ $patientvisit->patient->registration_no }}</td>
                                    <td>{{ $patientvisit->visit_no }}</td>
                                    <td>{{ $patientvisit->visit_type == 1 ? 'Paid' : 'Free' }} /
                                        {{ $patientvisit->visitType != null ? $patientvisit->visitType->name : null }}
                                        {{ $patientvisit->foc == 1 ? 'FOC' : null }}</td>
                                    <td>{{ $patientvisit->visit_date }}</td>
                                    <td>{{ $patientvisit->unit->name }}</td>
                                    <td>
                                        @if ($patientvisit->visit_type == 1)
                                            <a target="_blank"
                                                href="{{ route('admin.patient.print-receipt', $patientvisit->id) }}"
                                                class="btn add-btn btn-sm"><i class="fa fa-inr"></i>Print Prescription
                                                </button>
                                        @endif

                                        <a target="_blank"
                                            href="{{ route('admin.patient.print_consultation_charge', $patientvisit->id) }}"
                                            class="btn add-btn btn-sm"><i class="fa fa-user"></i>Print Consult.
                                            </button>

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


</div>
