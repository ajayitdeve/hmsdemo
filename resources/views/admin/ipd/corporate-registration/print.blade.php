<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Corporate Registration</title>
    <style>
        table {
            font-family: Verdana, arial, Tahoma, sans-serif;
            width: 80%;
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
        'back_url' => route('admin.ipd.corporate-registration-list'),
        'width' => '80%',
    ])

    <table>
        <tr>
            <td colspan="3" style="text-align:center">
                <hr style="margin: 0px; padding:0px;border: 1px solid black;">
                <h2 style="margin: 0px; padding:2px;">Corporate Registration With Consultation</h2>
                <hr style="margin: 0px;padding:0px;border: 1px solid black;">
            </td>
        </tr>

        <tr>
            <td style="width:7cm">
                <strong>Patient Name :</strong>
                {{ $corporate_registration->patient->salution->name }} {{ $corporate_registration->patient->name }}
            </td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>UMR No :</strong> {{ $corporate_registration->patient->registration_no }}</td>
        </tr>

        <tr>
            <td style="width:7cm">
                <strong>{{ $corporate_registration->patient->relation->name }} :</strong>
                {{ $corporate_registration->patient->father_name }}
            </td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>Age/Gender :</strong> <?php echo \Carbon\Carbon::parse($corporate_registration->patient->dob)->age; ?> Years /
                {{ $corporate_registration->patient->gender->name }}</td>
        </tr>

        <tr>
            <td style="width:7cm"><strong>Mobile No :</strong>
                @if (isset($corporate_registration->patient->mobile))
                    {{ $corporate_registration->patient->mobile }}
                @endif
            </td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>Address :</strong>
                @if (isset($corporate_registration->patient->address))
                    {{ $corporate_registration->patient->address }}
                @endif
            </td>
        </tr>

        <tr>
            <td style="width:7cm"><strong>Organization :</strong>
                {{ $corporate_registration?->organization?->name }}
            </td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>Corporate Relation :</strong>
                {{ $corporate_registration?->relationship_to_emp == 'self' ? 'Self' : $corporate_registration?->corporate_relation?->name }}
            </td>
        </tr>

        <tr>
            <td style="width:7cm"><strong>Medical Card No. :</strong>
                {{ $corporate_registration->medical_card_no }}
            </td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>Card valid upto :</strong> {{ $corporate_registration->card_validity }}
            </td>
        </tr>


        <tr>
            <td colspan="3" style="text-align:center">
                <hr style="margin: 0px; padding:0px;border: 1px solid black;">

            </td>
        </tr>
        <tr>
            <td style="width:7cm"><strong>Consultation No. :</strong>
                {{ $corporate_registration->corporate_consultation->code }}
            </td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>Consult. Date :</strong>
                {{ \Carbon\Carbon::parse($corporate_registration->corporate_consultation->created_at)->format('d-M-Y') }}
            </td>
        </tr>

        <tr>
            <td style="width:7cm"><strong>Dept :</strong> {{ $corporate_registration->department->name }}</td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>Unit :</strong> {{ $corporate_registration->unit->name }}</td>
        </tr>

        <tr>
            <td style="width:7cm"><strong>Consultant :</strong>
                {{ $corporate_registration->corporate_consultation->doctor->name }}</td>
            <td style="width:1cm"></td>
            <td style="width:7cm"><strong>Fee :</strong> {{ $corporate_registration->corporate_fee }}</td>
        </tr>
    </table>
</body>

</html>
