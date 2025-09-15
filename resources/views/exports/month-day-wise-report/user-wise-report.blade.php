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
            @switch($type)
                @case('registrations')
                    <tr>
                        <th>Sr. No.</th>
                        <th>User Name</th>
                        <th>Day</th>
                        <th>Count</th>
                        <th>Registration Fee</th>
                    </tr>
                @break

                @case('admissions')
                    <tr>
                        <th>Sr. No.</th>
                        <th>User Name</th>
                        <th>Day</th>
                        <th>Count</th>
                    </tr>
                @break

                @case('consultations')
                    <tr>
                        <th>Sr. No.</th>
                        <th>User Name</th>
                        <th>Day</th>
                        <th>Count</th>
                        <th>Total Amount</th>
                    </tr>
                @break

                @case('discharges')
                    <tr>
                        <th>Sr. No.</th>
                        <th>User Name</th>
                        <th>Day</th>
                        <th>Count</th>
                        <th>Total Amount</th>
                    </tr>
                @break
            @endswitch
        </thead>

        <tbody>
            @switch($type)
                @case('registrations')
                    @foreach ($month_day_wise_reports as $sr => $user_wise_report)
                        <tr>
                            <td>{{ $sr + 1 }}</td>
                            <td>{{ $user_wise_report->user_name }}</td>
                            <td>{{ $user_wise_report->day }}</td>
                            <td>{{ $user_wise_report->count }}</td>
                            <td>0</td>
                        </tr>
                    @endforeach
                @break

                @case('admissions')
                    @foreach ($month_day_wise_reports as $sr => $user_wise_report)
                        <tr>
                            <td>{{ $sr + 1 }}</td>
                            <td>{{ $user_wise_report->user_name }}</td>
                            <td>{{ $user_wise_report->day }}</td>
                            <td>{{ $user_wise_report->count }}</td>
                        </tr>
                    @endforeach
                @break

                @case('consultations')
                    @foreach ($month_day_wise_reports as $sr => $user_wise_report)
                        <tr>
                            <td>{{ $sr + 1 }}</td>
                            <td>{{ $user_wise_report->user_name }}</td>
                            <td>{{ $user_wise_report->day }}</td>
                            <td>{{ $user_wise_report->count }}</td>
                            <td>{{ $user_wise_report->total_amount }}</td>
                        </tr>
                    @endforeach
                @break

                @case('discharges')
                @break
            @endswitch
        </tbody>
    </table>
@endsection
