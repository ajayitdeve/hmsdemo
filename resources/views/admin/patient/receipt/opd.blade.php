<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OPD Receipt</title>
    <style>
        table {
            font-family: Verdana, arial, Tahoma, sans-serif;
            width: 60%;
            margin: auto;
        }

        @media print {
            body {
                font-family: Verdana, arial, Tahoma, sans-serif;
                font-size: 8pt;
            }

            table {
                font-family: Verdana, arial, Tahoma, sans-serif;
                font-size: 8pt;
                width: 100%;
                /* margin-top: 5cm; */
                /* margin-left: 5cm; */
                /* margin-bottom: 2.5cm width: 16cm; */
            }

            table tr {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>

    @include('partials.back-print-btn', [
        'back_url' => route('admin.patient.registration-with-consultation'),
        'width' => '60%',
    ])

    <table>
        <tr>
            <td colspan="3" style="text-align:center">
                <hr style="margin: 0px; padding:0px;border: 1px solid black;">
                <h2 style="margin: 0px; padding:0px;">OUT PATIENT ASSESSMENT RECORD</h2>
                <hr style="margin: 0px;padding:0px;border: 1px solid black;">
            </td>
        </tr>
        <tr>
            <td style="width:7cm"><strong>Patient Name :</strong> {{ $patientvisit->patient->salution->name }}
                {{ $patientvisit->patient->name }}
            </td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>UMR No :</strong> {{ $patientvisit->patient->registration_no }}</td>
        </tr>
        <tr>
            <td style="width:7cm"><strong>{{ $patientvisit->patient->relation->name }} :</strong>
                {{ $patientvisit->patient->father_name }}</td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>Age/Gender :</strong> <?php echo \Carbon\Carbon::parse($patientvisit->patient->dob)->age; ?> Years /
                {{ $patientvisit->patient->gender->name }}</td>
        </tr>
        <tr>
            <td style="width:7cm"><strong>Mobile No :</strong>
                @if (isset($patientvisit->patient->mobile))
                    {{ $patientvisit->patient->mobile }}
                @endif
            </td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>Patient Type :</strong>
                @if (isset($patientvisit->patient->patient_type_id))
                    {{ $patientvisit->patient->patienttype->name }}
                @endif
            </td>
        </tr>
        <tr>
            <td style="width:7cm"><strong>Address :</strong>
                @if (isset($patientvisit->patient->address))
                    {{ $patientvisit->patient->address }}
                @endif
            </td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>Reg. Date :</strong> <?php echo \Carbon\Carbon::parse($patientvisit->patient->created_at)->format('d-M-Y'); ?> </td>
        </tr>
        <tr>
            <td style="width:7cm">
                @if (isset($patientvisit->patient->city->name))
                    {{ $patientvisit->patient->city->name }}, {{ $patientvisit->patient->state->name }}
                @endif
            </td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>Amount :</strong> {{ $patientvisit->fee }}
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center">
                <hr style="margin: 0px; padding:0px;border: 1px solid black;">

            </td>
        </tr>
        <tr>
            <td style="width:7cm"><strong>Consultation No :</strong>
                @if (isset($patientvisit->visit_no))
                    {{ $patientvisit->visit_no }}
                @endif
            </td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>Consult. Date :</strong> <?php echo \Carbon\Carbon::parse($patientvisit->created_at)->format('d-M-Y'); ?></td>
        </tr>
        <tr>
            <td style="width:7cm"><strong>Dept :</strong> {{ $patientvisit->unit->department->name }}</td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>Unit :</strong> {{ $patientvisit->unit->name }}</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center">
                <hr style="margin: 0px; padding:0px;border: 1px solid black;">

            </td>
        </tr>


    </table>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />

    <table>

        <tr>
            <td colspan="3" style="text-align:center">
                <hr style="margin: 0px; padding:0px;border: 1px solid black;">

            </td>
        </tr>
        <tr>
            <td style="max-width:9cm"><?php
            echo '<img src="data:image/png;base64,' . \Milon\Barcode\DNS1D::getBarcodePNG($patientvisit->patient->registration_no, 'C39', 1, 20) . '" alt="barcode"   />';
            
            ?><br />
                @if ($idType != null)
                    {{ $idType->name }} : {{ $patient->identification_no }}
                @endif
            </td>
            <td style="width:1cm"></td>
            <?php
            //latest paid visit (1-paid)
            $visit = \App\Models\PatientVisit::where('patient_id', $patientvisit->patient->id)->where('visit_type', 1)->latest()->first();
            $validtill = \Carbon\Carbon::parse($visit->visit_date)->addDays(15)->format('d-M-Y');
            //dd($visit->visit_date);
            // echo $validtill;
            ?>


            {{-- <td style="width:7cm"><strong>Consult. Date :  <?php echo \Carbon\Carbon::parse($patientvisit->created_at)->format('d-M-Y'); ?> </strong></td> --}}
            <td style="width:5cm;">&nbsp;Validity : {{ $validtill }}</td>
        </tr>


    </table>

</body>

</html>
