@extends('exports.layouts.header')

@section('content')
    <div class="pdf-header text-center">
        <h2>NARAYAN MEDICAL COLLEGE & HOSPITAL</h2>
        <p>JAMUHAR, SASARAM, ROHTAS</p>
        <p>BIHAR. Ph - 06184-281899</p>
        <h3>{{ $selection_types["$selection_type"] }} Consultation Details</h3>
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
            @if ($selection_type == 'patient-wise' || $selection_type == 'consultation-no-wise')
                @foreach ($opConsultationReports as $op_consultation_report)
                    <tr>
                        @foreach ($selected_export_fields as $field)
                            @switch($field)
                                @case('sr_no')
                                    <td>
                                        {{ $loop->parent->iteration }}
                                    </td>
                                @break

                                @case('umr')
                                    <td>
                                        {{ $op_consultation_report?->patient?->registration_no }}
                                    </td>
                                @break

                                @case('patient_name')
                                    <td>
                                        {{ $op_consultation_report?->patient?->name }}
                                    </td>
                                @break

                                @case('patient_type')
                                    <td>
                                        {{ $op_consultation_report?->patient?->patienttype?->name }}
                                    </td>
                                @break

                                @case('area')
                                    <td>
                                        {{ $op_consultation_report?->patient?->is_rural ? 'Rural' : 'Urban' }}
                                    </td>
                                @break

                                @case('ipd_code')
                                    <td>{{ $op_consultation_report?->ipd?->ipdcode }}</td>
                                @break

                                @case('organization_name')
                                    <td>
                                        {{ $op_consultation_report?->ipd?->corporate_registration?->organization?->name }}
                                    </td>
                                @break

                                @case('age')
                                    <td>
                                        {{ \Carbon\Carbon::parse($op_consultation_report?->patient?->dob)->diff(\Carbon\Carbon::now())->format('%yY') }}(s)
                                    </td>
                                @break

                                @case('gender')
                                    <td>
                                        {{ $op_consultation_report?->patient?->gender?->name }}
                                    </td>
                                @break

                                @case('address')
                                    <td style="text-wrap:initial;">
                                        {{ $op_consultation_report?->patient?->address }}
                                    </td>
                                @break

                                @case('consult_no')
                                    <td>
                                        {{ $op_consultation_report?->visit_no }}
                                    </td>
                                @break

                                @case('consult_date')
                                    <td>
                                        {{ $op_consultation_report?->visit_date }}
                                    </td>
                                @break

                                @case('doctor_name')
                                    <td>
                                        {{ $op_consultation_report?->doctor?->name }}
                                    </td>
                                @break

                                @case('visit_type')
                                    <td>
                                        {{ $op_consultation_report?->visitType?->name }}
                                    </td>
                                @break

                                @case('department')
                                    <td>
                                        {{ $op_consultation_report?->department?->name }}
                                    </td>
                                @break

                                @case('unit')
                                    <td>
                                        {{ $op_consultation_report?->unit?->name }}
                                    </td>
                                @break

                                @case('consult_fee')
                                    <td class="text-right">
                                        {{ $op_consultation_report?->fee }}
                                    </td>
                                @break

                                @case('foc')
                                    <td>
                                        {{ $op_consultation_report?->foc ? 'Yes' : 'No' }}
                                    </td>
                                @break

                                @case('consult_status')
                                    <td>
                                        {{ $op_consultation_report?->patient?->patientvisits?->count() > 1 ? 'Old' : 'New' }}
                                    </td>
                                @break

                                @case('created_by')
                                    <td>
                                        {{ $op_consultation_report?->created_by?->name }}
                                    </td>
                                @break

                                @case('created_at')
                                    <td>
                                        {{ $op_consultation_report?->created_at }}
                                    </td>
                                @break
                            @endswitch
                        @endforeach
                    </tr>
                @endforeach
            @else
                @foreach ($groupedData as $group => $op_consultation_reports)
                    <tr class="group-header">
                        <td colspan="{{ count($selected_export_fields) }}">
                            <strong>
                                {{ $selection_types[$selection_type] }}
                                :
                                {{ $group }}
                            </strong>
                        </td>
                    </tr>

                    @foreach ($op_consultation_reports as $op_consultation_report)
                        <tr>
                            @foreach ($selected_export_fields as $field)
                                @switch($field)
                                    @case('sr_no')
                                        <td>
                                            {{ $loop->parent->iteration }}
                                        </td>
                                    @break

                                    @case('umr')
                                        <td>
                                            {{ $op_consultation_report?->patient?->registration_no }}
                                        </td>
                                    @break

                                    @case('patient_name')
                                        <td>
                                            {{ $op_consultation_report?->patient?->name }}
                                        </td>
                                    @break

                                    @case('patient_type')
                                        <td>
                                            {{ $op_consultation_report?->patient?->patienttype?->name }}
                                        </td>
                                    @break

                                    @case('area')
                                        <td>
                                            {{ $op_consultation_report?->patient?->is_rural ? 'Rural' : 'Urban' }}
                                        </td>
                                    @break

                                    @case('ipd_code')
                                        <td>{{ $op_consultation_report?->ipd?->ipdcode }}</td>
                                    @break

                                    @case('organization_name')
                                        <td>
                                            {{ $op_consultation_report?->ipd?->corporate_registration?->organization?->name }}
                                        </td>
                                    @break

                                    @case('age')
                                        <td>
                                            {{ \Carbon\Carbon::parse($op_consultation_report?->patient?->dob)->diff(\Carbon\Carbon::now())->format('%yY') }}(s)
                                        </td>
                                    @break

                                    @case('gender')
                                        <td>
                                            {{ $op_consultation_report?->patient?->gender?->name }}
                                        </td>
                                    @break

                                    @case('address')
                                        <td style="text-wrap:initial;">
                                            {{ $op_consultation_report?->patient?->address }}
                                        </td>
                                    @break

                                    @case('consult_no')
                                        <td>
                                            {{ $op_consultation_report?->visit_no }}
                                        </td>
                                    @break

                                    @case('consult_date')
                                        <td>
                                            {{ $op_consultation_report?->visit_date }}
                                        </td>
                                    @break

                                    @case('doctor_name')
                                        <td>
                                            {{ $op_consultation_report?->doctor?->name }}
                                        </td>
                                    @break

                                    @case('visit_type')
                                        <td>
                                            {{ $op_consultation_report?->visitType?->name }}
                                        </td>
                                    @break

                                    @case('department')
                                        <td>
                                            {{ $op_consultation_report?->department?->name }}
                                        </td>
                                    @break

                                    @case('unit')
                                        <td>
                                            {{ $op_consultation_report?->unit?->name }}
                                        </td>
                                    @break

                                    @case('consult_fee')
                                        <td class="text-right">
                                            {{ $op_consultation_report?->fee }}
                                        </td>
                                    @break

                                    @case('foc')
                                        <td>
                                            {{ $op_consultation_report?->foc ? 'Yes' : 'No' }}
                                        </td>
                                    @break

                                    @case('consult_status')
                                        <td>
                                            {{ $op_consultation_report?->patient?->patientvisits?->count() > 1 ? 'Old' : 'New' }}
                                        </td>
                                    @break

                                    @case('created_by')
                                        <td>
                                            {{ $op_consultation_report?->created_by?->name }}
                                        </td>
                                    @break

                                    @case('created_at')
                                        <td>
                                            {{ $op_consultation_report?->created_at }}
                                        </td>
                                    @break
                                @endswitch
                            @endforeach
                        </tr>
                    @endforeach
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
