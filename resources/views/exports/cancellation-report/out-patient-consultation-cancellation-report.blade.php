@extends('exports.layouts.header')

@section('content')
    <div class="pdf-header text-center">
        <h2>NARAYAN MEDICAL COLLEGE & HOSPITAL</h2>
        <p>JAMUHAR, SASARAM, ROHTAS</p>
        <p>BIHAR. Ph - 06184-281899</p>
        <h3>{{ $selection_types["$selection_type"] }}</h3>
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
            @if ($cancellation_reports)
                @foreach ($cancellation_reports as $out_patient_consultation_cancellation)
                    <tr>
                        @foreach ($selected_export_fields as $field)
                            @switch($field)
                                @case('sr_no')
                                    <td>
                                        {{ $loop->parent->iteration }}
                                    </td>
                                @break

                                @case('visit_code')
                                    <td>
                                        {{ $out_patient_consultation_cancellation?->visit_no }}
                                    </td>
                                @break

                                @case('cancel_date')
                                    <td>
                                        {{ date('Y-m-d', strtotime($out_patient_consultation_cancellation?->deleted_at)) }}
                                    </td>
                                @break

                                @case('visit_date')
                                    <td>
                                        {{ date('Y-m-d', strtotime($out_patient_consultation_cancellation?->visit_date)) }}
                                    </td>
                                @break

                                @case('umr')
                                    <td>
                                        {{ $out_patient_consultation_cancellation?->patient?->registration_no }}
                                    </td>
                                @break

                                @case('patient_name')
                                    <td>
                                        {{ $out_patient_consultation_cancellation?->patient?->name }}
                                    </td>
                                @break

                                @case('doctor_name')
                                    <td>
                                        {{ $out_patient_consultation_cancellation?->doctor?->name }}
                                    </td>
                                @break

                                @case('department_name')
                                    <td>
                                        {{ $out_patient_consultation_cancellation?->department?->name }}
                                    </td>
                                @break

                                @case('unit_name')
                                    <td>
                                        {{ $out_patient_consultation_cancellation?->unit?->name }}
                                    </td>
                                @break

                                @case('amount')
                                    <td>
                                        {{ $out_patient_consultation_cancellation?->fee }}
                                    </td>
                                @break
                            @endswitch
                        @endforeach
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
