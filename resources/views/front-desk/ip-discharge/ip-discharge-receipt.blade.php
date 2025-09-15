<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>IP Discharge Receipt</title>

    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            width: 100%;
            font-family: Verdana, arial, Tahoma, sans-serif;
        }

        .pdf-header h2 {
            margin-bottom: 2px;
        }

        .pdf-header h3 {
            margin-top: 5px;
            margin-bottom: 5px;
            text-decoration: underline
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            margin-top: 15px;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
            vertical-align: top;
        }

        tr.group-header td {
            background-color: #d9edf7;
            font-weight: bold;
        }

        .nowrap {
            white-space: nowrap;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .container-border {
            border: 2px solid #000;
            box-sizing: border-box;
            padding: 20px;
        }

        .underline-border {
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }

        .width-container {
            width: 80%;
            margin: auto;
        }

        @media print {
            body {}

            .width-container {
                width: 100%;
            }

            table {
                width: 100%;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    @include('partials.back-print-btn', [
        'back_url' => route('admin.ipd.ip-discharge-master'),
        'width' => '80%',
    ])

    <div class="container-border width-container">
        <div class="pdf-header text-center">
            <h2>NARAYAN MEDICAL COLLEGE & HOSPITAL</h2>
            <p>JAMUHAR, SASARAM, ROHTAS</p>
            <p>BIHAR. Ph - 06184-281899</p>
            <h3>Check Out Slip</h3>
        </div>

        <table width="100%">
            <tbody>
                <tr>
                    <th>UMR No.</th>
                    <td>{{ $ip_discharge?->patient?->registration_no }}</td>

                    <th>Discharge Date</th>
                    <td>{{ date('d-M-Y', strtotime($ip_discharge?->discharge_date)) }}</td>
                </tr>

                <tr>
                    <th>Admn. No.</th>
                    <td>{{ $ip_discharge?->ipd?->ipdcode }}</td>

                    <th>Ward</th>
                    <td>{{ $ip_discharge?->ipd?->ward?->name }}</td>
                </tr>

                <tr>
                    <th>Room</th>
                    <td>{{ $ip_discharge?->ipd?->room?->name }}</td>

                    <th>Bed</th>
                    <td>{{ $ip_discharge?->ipd?->bed?->display_name }}</td>
                </tr>

                {{-- ======================================================================================== --}}
                <tr>
                    <td colspan="4" style="margin: 10px 0;"></td>
                </tr>
                <tr>
                    <td colspan="4" style="margin: 10px 0;"></td>
                </tr>
                {{-- ======================================================================================= --}}

                <tr>
                    <th>Patient Name</th>
                    <td colspan="3">
                        <div class="underline-border">
                            {{ $ip_discharge?->patient?->name }}
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>Doctor Name</th>
                    <td colspan="3">
                        <div class="underline-border">
                            {{ $ip_discharge?->doctor?->name }}
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>Department</th>
                    <td colspan="3">
                        <div class="underline-border">
                            {{ $ip_discharge?->ipd?->department?->name }}
                        </div>
                    </td>
                </tr>

                {{-- ======================================================================================== --}}
                <tr>
                    <td colspan="4" style="margin: 10px 0;"></td>
                </tr>
                <tr>
                    <td colspan="4" style="margin: 10px 0;"></td>
                </tr>
                {{-- ======================================================================================= --}}

                <tr>
                    <th>Due Authorized By</th>
                    <td colspan="3">
                        {{-- {{ $ip_discharge?->doctor?->name }} --}}
                    </td>
                </tr>
                <tr>
                    <th>Due Amount</th>
                    <td colspan="2">
                        {{-- No Due --}}
                    </td>

                    <th>Signature</th>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="width-container">
        <table>
            <tbody>
                <tr>
                    <th>Prepared By</th>
                    <td>{{ $ip_discharge?->created_by?->name }}</td>

                    <th>Prepared At</th>
                    <td>{{ date('d-M-Y h:i:s A', strtotime($ip_discharge?->created_at)) }}</td>
                </tr>

                <tr>
                    <th>Printed By</th>
                    <td>{{ auth()->user()?->employee?->user_id ?: auth()->user()?->name }}</td>

                    <th>Printed At</th>
                    <td>{{ date('d-M-Y h:i:s A') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
