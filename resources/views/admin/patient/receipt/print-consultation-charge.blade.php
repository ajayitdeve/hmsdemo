<html>

<head>
    <title>Consultation Fee Receipt</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
    <style>
        table {
            font-family: Verdana, arial, Tahoma, sans-serif;
            /* margin-top: 1cm; */
            /* maegin-bottom: 1.8cm margin-right: 1.5cm; */
            /* margin-left: 1.5cm width: 18cm; */
        }

        @media print {

            body {
                font-family: Verdana, arial, Tahoma, sans-serif;
                margin-top: 1cm;
                maegin-bottom: 1.8cm margin-right: 1.5cm;
                margin-left: 1.5cm width: 18cm;
                font-size: 8pt;
            }

            table {
                font-family: Verdana, arial, Tahoma, sans-serif;
                font-size: 8pt;
                /* margin-top: 5cm;
                margin-left: 5cm;
                margin-bottom: 2.5cm width: 16cm; */
            }

            .noPrint {
                display: none;
            }

        }
    </style>

    @include('partials.back-print-btn', [
        'back_url' => route('admin.patient.consultation-list'),
        'width' => '55%',
    ])


    <table border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" align="center" height="300">
        <tr>
            <td width="47%" height="35">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" height="99">
                    <tr>
                        <td height="47" width="19%">
                            <div align="center"><img src="{{ asset('assets/img/admin-logo.jpg') }}" width="92">
                            </div>
                        </td>
                        <td height="47" width="81%">
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
                                                OP Bill - Cum - Receipt </font>
                                        </b>
                                    </font>
                                </font>
                            </div>
                        </td>
                    </tr>
                </table>
                <div align="center"></div>
            </td>
            <td width="53%" height="35">
                <div align="center">
                    <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center" height="99">
                        <tr>
                            <td height="47" width="54%">
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    Name :{{ $patientvisit->patient->salution->name }}
                                    {{ $patientvisit->patient->name }}<br>
                                    <br />
                                    UMR NO : {{ $patientvisit->patient->registration_no }}<br />
                                    <br />
                                    {{ $patientvisit->patient->relation->name }} :
                                    {{ $patientvisit->patient->father_name }}
                                </font>
                            </td>
                            <td height="47" width="46%">
                                <font size="2" face="Arial, Helvetica, sans-serif"><br>
                                    Bill Dt
                                    &nbsp;&nbsp;&nbsp;:{{ date('d-m-Y', strtotime($consultation_charge->created_at)) }}
                                    <br>
                                    <br>
                                    Age/Sex : <?php echo \Carbon\Carbon::parse($patientvisit->patient->dob)->age; ?> Years /
                                    {{ $patientvisit->patient->gender->name }}<br>
                                    <br>
                                    Phone &nbsp;&nbsp;&nbsp;&nbsp;: {{ $patientvisit->patient->mobile }}<br />
                                    <br />
                                    Address: {{ $patientvisit->patient->address }}
                                </font>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>


        <tr>
        <tr>
            <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>


                        <td height="6" width="11%">
                            <div align="center"><b>
                                    <font size="2" face="Arial, Helvetica, sans-serif">Amount</font>
                                </b></div>
                        </td>
                        <td height="6" width="14%">
                            <div align="center"><b>
                                    <font size="2" face="Arial, Helvetica, sans-serif">Reaceive By
                                    </font>
                                </b></div>
                        </td>
                        <td height="6" width="15%">
                            <div align="center"><b>
                                    <font size="2" face="Arial, Helvetica, sans-serif">Date</font>
                                </b></div>
                        </td>
                    </tr>

                    <tr>
                        <td height="5" width="14%">
                            <div align="center">
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    {{ $consultation_charge->amount }}</font>
                            </div>
                        </td>
                        <td height="5" width="14%">
                            <div align="center">
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    {{ $consultation_charge->user->name }}</font>
                            </div>
                        </td>
                        <td height="5" width="15%">
                            <div align="center">
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    {{ $consultation_charge->created_at }}</font>
                            </div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>

        </tr>
    </table>
</body>

</html>
