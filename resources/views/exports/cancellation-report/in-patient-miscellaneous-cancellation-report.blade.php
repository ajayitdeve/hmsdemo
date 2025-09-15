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
                @foreach ($cancellation_reports as $cancellation_report)
                    <tr>
                        @foreach ($selected_export_fields as $field)
                            @switch($field)
                                @case('sr_no')
                                    <td>
                                        {{ $loop->parent->iteration }}
                                    </td>
                                @break

                                @case('ipd_code')
                                    <td>{{ $cancellation_report?->lab_indent?->ipd?->ipdcode }}</td>
                                @break

                                @case('cancel_date')
                                    <td>{{ $cancellation_report?->service_date }}</td>
                                @break

                                @case('service_date')
                                    <td>{{ $cancellation_report?->service_date }}</td>
                                @break

                                @case('umr')
                                    <td>
                                        {{ $cancellation_report?->lab_indent?->patient?->registration_no }}
                                    </td>
                                @break

                                @case('patient_name')
                                    <td>{{ $cancellation_report?->lab_indent?->patient?->name }}</td>
                                @break

                                @case('service_name')
                                    <td>
                                        {{ $cancellation_report?->service?->name }}
                                    </td>
                                @break

                                @case('service_code')
                                    <td>
                                        {{ $cancellation_report?->service?->code }}
                                    </td>
                                @break

                                @case('service_group')
                                    <td>
                                        {{ $cancellation_report?->service?->servicegroup?->name }}
                                    </td>
                                @break

                                @case('qty')
                                    <td>
                                        {{ $cancellation_report?->quantity }}
                                    </td>
                                @break

                                @case('rate')
                                    <td>
                                        {{ $cancellation_report?->unit_service_price }}
                                    </td>
                                @break

                                @case('amount')
                                    <td>
                                        {{ $cancellation_report?->amount }}
                                    </td>
                                @break

                                @case('discount')
                                    <td>
                                        {{ $cancellation_report?->discount }}
                                    </td>
                                @break

                                @case('total')
                                    <td>
                                        {{ $cancellation_report?->total }}
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
