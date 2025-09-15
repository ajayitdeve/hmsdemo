@extends('exports.layouts.header')

@section('content')
    <div class="pdf-header text-center">
        <h2>NARAYAN MEDICAL COLLEGE & HOSPITAL</h2>
        <p>JAMUHAR, SASARAM, ROHTAS</p>
        <p>BIHAR. Ph - 06184-281899</p>
        <h3>{{ $selection_types["$selection_type"] }} Advance Details</h3>
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
            @foreach ($groupedData as $group => $ip_advance_reports)
                <tr class="group-header">
                    <td colspan="{{ count($selected_export_fields) }}">
                        <strong>
                            {{ $selection_types[$selection_type] }}
                            :
                            {{ $group }}
                        </strong>
                    </td>
                </tr>

                @foreach ($ip_advance_reports as $ip_advance_report)
                    <tr>
                        @foreach ($selected_export_fields as $field)
                            @switch($field)
                                @case('sr_no')
                                    <td>
                                        {{ $loop->parent->iteration }}
                                    </td>
                                @break

                                @case('umr')
                                    <td>{{ $ip_advance_report?->patient?->registration_no }}</td>
                                @break

                                @case('patient_name')
                                    <td>{{ $ip_advance_report?->patient?->name }}</td>
                                @break

                                @case('ipd_code')
                                    <td>{{ $ip_advance_report?->ipd?->ipdcode }}</td>
                                @break

                                @case('admission_date')
                                    <td>
                                        {{ date('Y-m-d', strtotime($ip_advance_report?->ipd?->created_at)) }}
                                    </td>
                                @break

                                @case('advance_amount')
                                    <td>
                                        {{ $ip_advance_report?->amount }}
                                    </td>
                                @break

                                @case('doctor_name')
                                    <td>{{ $ip_advance_report?->ipd?->patient_visit?->doctor?->name }}
                                    </td>
                                @break

                                @case('department')
                                    <td>{{ $ip_advance_report?->ipd?->department?->name }}</td>
                                @break

                                @case('unit')
                                    <td>{{ $ip_advance_report?->ipd?->unit?->name }}</td>
                                @break

                                @case('ward')
                                    <td>
                                        {{ $ip_advance_report?->ipd?->ward?->name }}
                                    </td>
                                @break

                                @case('patient_type')
                                    <td>
                                        {{ $ip_advance_report?->patient?->patienttype?->name }}
                                    </td>
                                @break

                                @case('area')
                                    <td>
                                        {{ $ip_advance_report?->patient?->is_rural ? 'Rural' : 'Urban' }}
                                    </td>
                                @break

                                @case('organization_name')
                                    <td>
                                        {{ $ip_advance_report?->ipd?->corporate_registration?->organization?->name }}
                                    </td>
                                @break

                                @case('created_by')
                                    <td>{{ $ip_advance_report?->created_by?->name }}</td>
                                @break

                                @case('created_at')
                                    <td>{{ $ip_advance_report?->created_at }}</td>
                                @break
                            @endswitch
                        @endforeach
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@endsection
