<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Patient List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Patient List</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.patient.create') }}" class="btn add-btn"><i class="fa fa-plus"></i> New
                        Registration</a>
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
                    <table data-order='[[ 5, "desc" ]]' class="datatable table table-stripped mb-0 dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Registration No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Referral</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                                <tr>

                                    <td>{{ $patient->registration_no }} <a
                                            href="{{ route('admin.patient.edit-patient', $patient->id) }}"><i
                                                class="fa fa-edit text-primary"></i></a></td>
                                    <td>{{ $patient->name }}</td>
                                    <td>{{ $patient->email }}</td>
                                    <td>{{ $patient->phone }}</td>
                                    <td>
                                        @if ($patient->referral->name == 'Self' || $patient->referral->name == 'Walking')
                                            {{ $patient->referral->name }}
                                        @else
                                            {{ $patient->referral->referrable->name }} ( {{ $patient->referral->name }})
                                        @endif
                                    </td>
                                    <td>{{ $patient->created_at }}</td>

                                    <td>
                                        {{-- <a href="{{route('admin.patient.book-consultation',$patient->id)}}" class="btn add-btn btn-sm" ><i class="fa fa-user-md"></i>Book Consultation </a> --}}
                                        {{-- <button wire:click="bookConsultation({{$patient->id}})"  href="#consultation" data-toggle="modal" data-target="#consultation" class="btn add-btn btn-sm"><i class="fa fa-user-md"></i>Book Consultation </button> --}}
                                        <a href="{{ route('admin.patient.book-consultation', $patient->id) }}"
                                            class="btn add-btn btn-sm"><i class="fa fa-user-md"></i>Book Consultation
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
    @include('livewire.patient.modal')
    @push('page-script')
        <script>
            window.addEventListener('close-modal', event => {
                $("#add_title").modal('hide');
                $("#edit_title").modal('hide');
                $("#delete_title").modal('hide');
                $("#consultation").modal('hide');
            })
        </script>
    @endpush

</div>
