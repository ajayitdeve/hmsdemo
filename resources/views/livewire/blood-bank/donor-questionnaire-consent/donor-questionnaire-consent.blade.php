<div>

    <!-- Page Content -->
    <div class="content container-fluid">
        @include('partials.alert-message')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Donor Questionnaire & Consent</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Donor Questionnaire & Consent</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('admin.blood-bank.donor-questionnaire-and-consent.create') }}" class="btn add-btn"
                        tabindex="1">
                        <i class="fa fa-plus"></i>
                        Add Donor Questionnaire & Consent
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
                                <th>Donor No</th>
                                <th>Donor Name</th>
                                <th>UMR</th>
                                <th>Patient Name</th>
                                <th>Blood Bag No</th>
                                <th>Created By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donor_questionnaire_consents as $donor_questionnaire_consent)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.blood-bank.donor-questionnaire-and-consent.edit', $donor_questionnaire_consent->id) }}">
                                            {{ $donor_questionnaire_consent->code }}
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('admin.blood-bank.donor-registration.edit', $donor_questionnaire_consent->donor_id) }}">
                                            {{ $donor_questionnaire_consent?->donor?->code }}
                                        </a>
                                    </td>
                                    <td>{{ $donor_questionnaire_consent?->donor?->name }}</td>
                                    <td>{{ $donor_questionnaire_consent?->patient?->registration_no }}</td>
                                    <td>{{ $donor_questionnaire_consent?->patient?->name }}</td>
                                    <td>{{ $donor_questionnaire_consent?->blood_bag_no }}</td>
                                    <td>{{ $donor_questionnaire_consent?->created_by?->name }}</td>
                                    <td>{{ $donor_questionnaire_consent->created_at }}</td>
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
