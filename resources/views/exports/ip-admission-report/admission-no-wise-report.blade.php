@extends('exports.layouts.header')

@section('content')
    <div class="pdf-header text-center">
        <h2>NARAYAN MEDICAL COLLEGE & HOSPITAL</h2>
        <p>JAMUHAR, SASARAM, ROHTAS</p>
        <p>BIHAR. Ph - 06184-281899</p>
        <h3>{{ $selection_types["$selection_type"] }} Admission Details</h3>
        @if ($from_date && !$to_date)
            <h4>{{ \Carbon\Carbon::parse($from_date)->format('d-M-Y h:i A') }}</h4>
        @elseif ($from_date && $to_date)
            <h4>
                {{ \Carbon\Carbon::parse($from_date)->format('d-M-Y h:i A') }}
                To
                {{ \Carbon\Carbon::parse($to_date)->format('d-M-Y h:i A') }}
            </h4>
        @endif
    </div>

    <table border="2" width="100%">
        <thead style="display: table-header-group;">
            <tr>
                @foreach ($selected_export_fields as $key)
                    <th>{{ $export_fields["$key"] }}</th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            @foreach ($ip_admission_reports as $ip_admission_report)
                <tr>
                    @foreach ($selected_export_fields as $field)
                        @switch($field)
                            @case('sr_no')
                                <td>
                                    {{ $loop->parent->iteration }}
                                </td>
                            @break

                            @case('ipd_code')
                                <td>{{ $ip_admission_report?->ipdcode }}</td>
                            @break

                            @case('umr')
                                <td>{{ $ip_admission_report?->patient?->registration_no }}</td>
                            @break

                            @case('patient_name')
                                <td>{{ $ip_admission_report?->patient?->name }}</td>
                            @break

                            @case('age')
                                <td>
                                    {{ Carbon\Carbon::parse($ip_admission_report?->patient?->dob)->diff(Carbon\Carbon::now())->format('%yY') }}(s)
                                </td>
                            @break

                            @case('gender')
                                <td>{{ $ip_admission_report?->patient?->gender?->name }}</td>
                            @break

                            @case('address')
                                <td>
                                    {{ $ip_admission_report?->patient?->address }}
                                </td>
                            @break

                            @case('patient_type')
                                <td>
                                    {{ $ip_admission_report?->patient?->patienttype?->name }}
                                </td>
                            @break

                            @case('area')
                                <td>
                                    {{ $ip_admission_report?->patient?->is_rural ? 'Rural' : 'Urban' }}
                                </td>
                            @break

                            @case('admission_date')
                                <td>
                                    {{ date('Y-m-d', strtotime($ip_admission_report?->created_at)) }}
                                </td>
                            @break

                            @case('admn_type')
                                <td>
                                    {{ $ip_admission_report?->admin_type?->name }}
                                </td>
                            @break

                            @case('patient_source')
                                <td>
                                    {{ $ip_admission_report?->patient_source }}
                                </td>
                            @break

                            @case('doctor_name')
                                <td>{{ $ip_admission_report?->patient_visit?->doctor?->name }}</td>
                            @break

                            @case('department')
                                <td>{{ $ip_admission_report?->department?->name }}</td>
                            @break

                            @case('unit')
                                <td>{{ $ip_admission_report?->unit?->name }}</td>
                            @break

                            @case('ward')
                                <td>
                                    {{ $ip_admission_report?->ward?->name }}
                                </td>
                            @break

                            @case('organization_name')
                                <td>
                                    {{ $ip_admission_report?->corporate_registration?->organization?->name }}
                                </td>
                            @break

                            @case('purpose')
                                <td>
                                    {{ $ip_admission_report?->admin_purpose?->name }}
                                </td>
                            @break

                            @case('created_by')
                                <td>{{ $ip_admission_report?->created_by?->name }}</td>
                            @break

                            @case('created_at')
                                <td>{{ $ip_admission_report?->created_at }}</td>
                            @break
                        @endswitch
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
