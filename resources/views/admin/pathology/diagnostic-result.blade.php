<html>
<!-- New -->
<style>
    table {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

<body>
    @include('partials.back-print-btn', [
        'back_url' => route('admin.diagnostic-result-list'),
        'width' => '80%',
    ])

    <table width="80%" align="center">
        <tr style="text-align:center;">
            <td>{{ $diagnosticResultValues->first()?->parameter?->department?->name }}</td>
        </tr>

    </table>
    <br />
    <table width="80%" align="center">

        <!-- for registered patient  -->
        @if ($diagnosticResult->out_side_patient_id == null)
            <tr>
                <td width="15%">Patient Name :</td>
                <td width="40%">{{ $diagnosticResult->patient->title->name }} {{ $diagnosticResult->patient->name }}
                </td>
                <td width="5%"></td>
                <td width="15%">Age/Gender:</td>
                <td width="30%">
                    @php
                        $parsedDOB = Carbon\Carbon::parse($diagnosticResult->patient->dob);
                        $age = Carbon\Carbon::parse($parsedDOB)
                            ->diff(Carbon\Carbon::now())
                            ->format('%y years, %m months and %d days');
                    @endphp
                    {{ $age }} ({{ $diagnosticResult->patient->gender->name }})
                </td>
            <tr>

            <tr>
                <td width="15%">Bill No/ UMR No:</td>
                <td width="40%">
                    {{ $diagnosticResult->opdBilling->code }}/{{ $diagnosticResult->patient->registration_no }}</td>
                <td width="5%"></td>
                <td width="15%">Referred By:</td>
                <td width="30%"> Dr. {{ $diagnosticResult->doctor->name }}
                    {{ $diagnosticResult->doctor->qualification }} </td>
            <tr>
            <tr>
                <td width="15%">Bil Dt:</td>
                <td width="40%">{{ $diagnosticResult->opdBilling->created_at }}</td>
                <td width="5%"></td>
                <td width="15%">Report Date:</td>
                <td width="30%"> {{ $diagnosticResult->created_at }} </td>
            <tr>
            <tr>
                <td width="15%">Receiving Date:</td>
                <td width="40%">{{ $diagnosticResult->opdBilling->created_at }}</td>
                <td width="5%"></td>
                <td width="15%">Service No:</td>
                <td width="30%">{{ $diagnosticResult->opdBilling->code }} </td>
            <tr>
        @endif
        <!-- for registered patient  -->
        <!-- for outside patient -->
        @if ($diagnosticResult->out_side_patient_id != null)
            <tr>
                <td width="15%">Patient Name :</td>
                <td width="40%">{{ $diagnosticResult->outSidePatient->name }}</td>
                <td width="5%"></td>
                <td width="15%">Age/Gender:</td>
                <td width="30%">:8 M(s)/Male</td>

            </tr>
        @endif
        <!-- endof outside patient -->

    </table>

    <!-- <p>Report Title-{{ $diagnosticResultValues->first()->service->template->format->report_title }}</p> -->

    <p></p>
    <p style="width: 80%; margin: auto;">{{ $diagnosticResultValues->first()->service->name }}</p>
    <p></p>

    <table width="80%" align="center">
        <tr>
            <td width="25%">{{ $diagnosticResultValues->first()->service->template->format->column_cap_1 }}</td>
            <td width="25%">{{ $diagnosticResultValues->first()->service->template->format->column_cap_2 }}</td>
            <td width="25%">{{ $diagnosticResultValues->first()->service->template->format->column_cap_3 }}</td>
            <td width="25%">{{ $diagnosticResultValues->first()->service->template->format->column_cap_4 }}</td>
        </tr>
    </table>
    <table width="80%" align="center">
        @foreach ($diagnosticResultValues as $diagnosticResultValue)
            <!-- <p>{{ $diagnosticResultValue->parameter->name }}  - {{ $diagnosticResultValue->result_value }} </p> -->
            <tr>
                <td width="25%">{{ $diagnosticResultValue->parameter->name }}</td>
                <td width="25%">{{ $diagnosticResultValue->result_value }}</td>
                <td width="25%">
                    {{ $diagnosticResultValue->parameter->parameterValue != null ? $diagnosticResultValue->parameter->parameterValue->normal_range : null }}
                </td>
                <td width="25%">{{ $diagnosticResultValue->parameter->method }}</td>
            </tr>
        @endforeach
    </table>
    <br />

    <p style="width: 80%; margin: auto;">Reference</p>
    <p></p>

    <table width="80%" align="center">

        <tr>
            @foreach ($reamarksArr as $remark)
                <td>{{ $remark['name'] }}</td>
            @endforeach
        </tr>
        <tr>
            @foreach ($reamarksArr as $remark)
                <td>{{ $remark['noraml_range'] }}</td>
            @endforeach
        </tr>
    </table>

</body>

</html>
