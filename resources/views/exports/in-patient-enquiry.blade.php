@extends('exports.layouts.header')

@section('content')
    <div class="pdf-header text-center">
        <h2>NARAYAN MEDICAL COLLEGE & HOSPITAL</h2>
        <p>JAMUHAR, SASARAM, ROHTAS</p>
        <p>BIHAR. Ph - 06184-281899</p>
        <h3>In Patient Enquiry</h3>
        {{-- <h4></h4> --}}
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
            @foreach ($in_patient_enquiries as $in_patient_enquiry)
                <tr>
                    @foreach ($selected_export_fields as $field)
                        @switch($field)
                            @case('sr_no')
                                <td>
                                    {{ $loop->parent->iteration }}
                                </td>
                            @break

                            @case('patient_name')
                                <td>{{ $in_patient_enquiry?->patient?->name }}</td>
                            @break

                            @case('umr')
                                <td>{{ $in_patient_enquiry?->patient?->registration_no }}
                                </td>
                            @break

                            @case('age')
                                <td>
                                    {{ Carbon\Carbon::parse($in_patient_enquiry?->patient?->dob)->diff(Carbon\Carbon::now())->format('%yY') }}(s)
                                </td>
                            @break

                            @case('gender')
                                <td>{{ $in_patient_enquiry?->patient?->gender?->name }}
                                </td>
                            @break

                            @case('ipd_code')
                                <td>{{ $in_patient_enquiry?->ipdcode }}</td>
                            @break

                            @case('ipd_date')
                                <td>
                                    {{ date('d-M-Y H:i:s', strtotime($in_patient_enquiry?->created_at)) }}
                                </td>
                            @break

                            @case('ward')
                                <td>
                                    {{ $in_patient_enquiry?->ward?->name }}
                                </td>
                            @break

                            @case('room')
                                <td>
                                    {{ $in_patient_enquiry?->room?->name }}
                                </td>
                            @break

                            @case('bed')
                                <td>
                                    {{ $in_patient_enquiry?->bed?->display_name }}
                                </td>
                            @break

                            @case('doctor')
                                <td>
                                    {{ $in_patient_enquiry?->patient_visit?->doctor?->name }}
                                </td>
                            @break

                            @case('patient_type')
                                <td>
                                    {{ $in_patient_enquiry?->patient?->patienttype?->name }}
                                </td>
                            @break

                            @case('marital_status')
                                <td>
                                    {{ $in_patient_enquiry?->patient?->marital_status?->name }}
                                </td>
                            @break

                            @case('city')
                                <td>
                                    {{ $in_patient_enquiry?->patient?->village?->district?->name }}
                                </td>
                            @break

                            @case('father_name')
                                <td>
                                    {{ $in_patient_enquiry?->patient?->father_name }}
                                </td>
                            @break

                            @case('address')
                                <td style="text-wrap:initial; min-width: 350px;">
                                    {{ $in_patient_enquiry?->patient?->address }}
                                </td>
                            @break

                            @case('mobile')
                                <td>{{ $in_patient_enquiry?->patient?->mobile }}</td>
                            @break

                            @case('admn_type')
                                <td>{{ $in_patient_enquiry?->admin_type?->name }}</td>
                            @break

                            @case('department')
                                <td>{{ $in_patient_enquiry?->department?->name }}</td>
                            @break

                            @case('cost_center')
                                <td>{{ $in_patient_enquiry?->cost_center?->code }}</td>
                            @break
                        @endswitch
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
