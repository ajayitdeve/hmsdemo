<html>

<head>
    <title>IP Pre Refund Receipt</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
    <style>
        table {
            font-family: Verdana, arial, Tahoma, sans-serif;
            width: 80%;
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
            }

            .noPrint {
                display: none;
            }

        }
    </style>

    @include('partials.back-print-btn', [
        'back_url' => route('admin.ipd.in-patient-pre-refund'),
        'width' => '80%',
    ])


    <table border="1" cellspacing="0" cellpadding="10" bordercolor="#000000" align="center">
        <tr>
            <td width="50%">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                        <td>
                            <div>
                                <img src="{{ asset('assets/img/admin-logo.jpg') }}">
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <font size="3" face="Arial, Helvetica, sans-serif"><b>
                                        <font size="2">NARAYAN
                                            MEDICAL COLLEGE &amp; HOSPITAL</font>
                                    </b><br>
                                    <br>
                                    <font size="2">JAMUHAR,SASARAM, ROHTAS <br>
                                        BIHAR. Ph - 06184-281899 <br>
                                        <b>
                                            <font size="3"><br>
                                                IP Pre Refund - Receipt </font>
                                        </b>
                                    </font>
                                </font>
                            </div>
                        </td>
                    </tr>
                </table>
                <div align="center"></div>
            </td>

            <td width="50%">
                <div>
                    <table border="0" cellspacing="0" cellpadding="8">
                        <tr>
                            <td>
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    Name: {{ $ip_pre_refund?->patient?->title?->name }}
                                    {{ $ip_pre_refund?->patient?->name }}
                                </font>
                            </td>

                            <td>
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    Refund No: {{ $ip_pre_refund?->refund_no }}
                                </font>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    Father Name: {{ $ip_pre_refund?->patient?->relation?->name }}
                                    {{ $ip_pre_refund?->patient?->father_name }}
                                </font>
                            </td>

                            <td>
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    Refund Date: {{ $ip_pre_refund?->refund_date }}
                                </font>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    UMR NO: {{ $ip_pre_refund?->patient?->registration_no }}
                                </font>
                            </td>

                            <td>
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    Age/Sex :
                                    {{ \Carbon\Carbon::parse($ip_pre_refund?->patient?->dob)?->age }} Years
                                    / {{ $ip_pre_refund?->patient?->gender?->name }}
                                </font>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    IPD NO: {{ $ip_pre_refund?->ipd?->ipdcode }}
                                </font>
                            </td>

                            <td>
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    Phone: {{ $ip_pre_refund?->patient?->mobile }}
                                </font>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    Address: {{ $ip_pre_refund?->patient?->address }}
                                </font>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center">
                    <tr>
                        <td>
                            <div align="center">
                                <b>
                                    <font size="2" face="Arial, Helvetica, sans-serif">
                                        Refund Amount
                                    </font>
                                </b>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <b>
                                    <font size="2" face="Arial, Helvetica, sans-serif">
                                        Received By
                                    </font>
                                </b>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <b>
                                    <font size="2" face="Arial, Helvetica, sans-serif">
                                        Date
                                    </font>
                                </b>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div align="center">
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    {{ $ip_pre_refund?->amount }}
                                </font>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    {{ $ip_pre_refund?->created_by?->name }}</font>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    {{ $ip_pre_refund?->created_at }}</font>
                            </div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
