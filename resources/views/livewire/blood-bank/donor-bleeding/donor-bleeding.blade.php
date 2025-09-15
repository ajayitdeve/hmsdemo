<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Donor Bleeding</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Donor Bleeding</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.blood-bank.donor-bleeding.create') }}" class="btn add-btn" tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add Donor Bleeding
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-order='[[ 8, "desc" ]]' class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <td>Sr. No.</td>
                                <th>Code</th>
                                <th>Consent Code</th>
                                <th>Bag No</th>
                                <th>Donor Code</th>
                                <th>Donor Name</th>

                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>IPD No</th>
                                <th>Blood Group</th>
                                <th>Bag Type</th>
                                <th>Doctor</th>
                                <th>Created By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donor_bleedings as $donor_bleeding)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.blood-bank.donor-bleeding.edit', $donor_bleeding->id) }}">
                                            {{ $donor_bleeding->code }}
                                        </a>
                                    </td>
                                    <td>
                                        @if ($donor_bleeding?->blood_donor_questionnaire_consent_id)
                                            <a
                                                href="{{ route('admin.blood-bank.donor-questionnaire-and-consent.edit', $donor_bleeding?->blood_donor_questionnaire_consent_id) }}">
                                                {{ $donor_bleeding?->questionnaire_consent?->code }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $donor_bleeding?->blood_bag_no }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.blood-bank.donor-registration.edit', $donor_bleeding?->donor_id) }}">
                                            {{ $donor_bleeding?->donor?->code }}
                                        </a>
                                    </td>
                                    <td>{{ $donor_bleeding?->donor?->name }}</td>

                                    @if ($donor_bleeding->type == 'outside-patient')
                                        <td>{{ $donor_bleeding?->out_side_patient?->registration_no }}</td>
                                        <td>{{ $donor_bleeding?->out_side_patient?->name }}</td>
                                    @else
                                        <td>{{ $donor_bleeding?->patient?->registration_no }}</td>
                                        <td>{{ $donor_bleeding?->patient?->name }}</td>
                                    @endif

                                    <td>{{ $donor_bleeding?->ipd?->ipdcode }}</td>
                                    <td>{{ $donor_bleeding?->blood_group?->name }}</td>
                                    <td>{{ $donor_bleeding?->bag_type?->name }}</td>
                                    <td>{{ $donor_bleeding?->doctor?->name }}</td>


                                    <td>{{ $donor_bleeding?->created_by?->name }}</td>
                                    <td>{{ $donor_bleeding->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @push('page-script')
        <script></script>
    @endpush

</div>
