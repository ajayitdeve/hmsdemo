<html>

<head>
    <title>OP Bill - Cum - Receipt</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
    @include('partials.back-print-btn', [
        'back_url' => route('admin.opd-billing-osp'),
        'width' => '90%',
    ])

    <table width="90%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" align="center" height="498">
        <tr>
            <td width="46%" height="35">
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
            <td width="45%" height="35">
                <div align="center">
                    <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center" height="99">
                        <tr>
                            <td height="47" width="54%">
                                <font size="2" face="Arial, Helvetica, sans-serif">Pt
                                    Name
                                    :{{ $opdBilling->outSidePatient->title->name }}{{ $opdBilling->outSidePatient->name }}<br>
                                    <br>
                                    Bill No &nbsp;&nbsp;&nbsp;: {{ $opdBilling->code }}<br>
                                    <br>
                                    UMR NO : {{ $opdBilling->outSidePatient->registration_no }}
                                </font>
                            </td>
                            <td height="47" width="46%">
                                <font size="2" face="Arial, Helvetica, sans-serif"><br>
                                    Bill Dt &nbsp;&nbsp;&nbsp;: {{ $opdBilling->created_at }}<br>
                                    <br>
                                    Age/Sex :
                                    {{ $opdBilling->outSidePatient->age }}Y(s)/{{ $opdBilling->outSidePatient->gender->name }}<br>
                                    <br>
                                    Phone &nbsp;&nbsp;&nbsp;&nbsp;: {{ $opdBilling->outSidePatient->mobile }}
                                </font>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" height="17">&nbsp;&nbsp;&nbsp;&nbsp;<font size="2"
                    face="Arial, Helvetica, sans-serif">Ref
                    By : WALKIN</font>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <font face="Arial, Helvetica, sans-serif" size="2">Consultant
                    : Out Side Patient</font>
            </td>
        </tr>
        <tr>
            <td colspan="2" height="47">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" height="99">
                    <tr>
                        <td height="23" width="6%">
                            <div align="center"><b>
                                    <font size="2" face="Arial, Helvetica, sans-serif">Sl.
                                        No.</font>
                                </b></div>
                        </td>
                        <td height="6" width="36%"> <b>
                                <font size="2" face="Arial, Helvetica, sans-serif">Service
                                    Name</font>
                            </b></td>
                        <td height="6" width="18%"> <b>
                                <font size="2" face="Arial, Helvetica, sans-serif">Service
                                    CD</font>
                            </b></td>
                        <td height="6" width="11%">
                            <div align="center"><b>
                                    <font size="2" face="Arial, Helvetica, sans-serif">Qty</font>
                                </b></div>
                        </td>
                        <td height="6" width="14%">
                            <div align="center"><b>
                                    <font size="2" face="Arial, Helvetica, sans-serif">Rate
                                    </font>
                                </b></div>
                        </td>
                        <td height="6" width="15%">
                            <div align="center"><b>
                                    <font size="2" face="Arial, Helvetica, sans-serif">Amount</font>
                                </b></div>
                        </td>
                    </tr>
                    @foreach ($opdBilling->opdBillingItems as $opdBillingItem)
                        <tr>
                            <td height="12" width="6%">
                                <div align="center">
                                    <font size="2" face="Arial, Helvetica, sans-serif">{{ $loop->index + 1 }}
                                    </font>
                                </div>
                            </td>
                            <td height="5" width="36%">
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    {{ $opdBillingItem->service->name }}</font>
                            </td>
                            <td height="5" width="18%">
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    {{ $opdBillingItem->service->code }}</font>
                            </td>
                            <td height="5" width="11%">
                                <div align="center">
                                    <font size="2" face="Arial, Helvetica, sans-serif">
                                        {{ $opdBillingItem->quantity }}</font>
                                </div>
                            </td>
                            <td height="5" width="14%">
                                <div align="center">
                                    <font size="2" face="Arial, Helvetica, sans-serif">
                                        {{ $opdBillingItem->unit_service_price }}</font>
                                </div>
                            </td>
                            <td height="5" width="15%">
                                <div align="center">
                                    <font size="2" face="Arial, Helvetica, sans-serif">
                                        {{ $opdBillingItem->quantity * $opdBillingItem->unit_service_price }}
                                    </font>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" height="220">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="42%">&nbsp;</td>
                        <td width="29%">&nbsp;</td>
                        <td width="14%">&nbsp;</td>
                        <td width="15%">
                            <div align="center">
                                <font size="2" face="Arial, Helvetica, sans-serif">
                                    <b>&nbsp;{{ $opdBilling->total }}</b>
                                </font>
                            </div>
                        </td>
                    </tr>

                    <td width="42%">&nbsp;</td>
                    <td width="29%">
                        <font size="2" face="Arial, Helvetica, sans-serif">Emp
                            Payable Amt </font>
                    </td>
                    <td width="14%">
                        <font size="2" face="Arial, Helvetica, sans-serif">:</font>
                    </td>
                    <td width="15%">
                        <div align="center">
                            <font size="2" face="Arial, Helvetica, sans-serif">
                                &nbsp;&nbsp;{{ number_format($opdBilling->balance, 2, '.', ',') }}</font>
                        </div>
                    </td>
        </tr>

        <tr>
            <td width="42%">&nbsp;</td>
            <td width="29%">
                <font size="2" face="Arial, Helvetica, sans-serif">Receipt
                    Amt </font>
            </td>
            <td width="14%">
                <font size="2" face="Arial, Helvetica, sans-serif">:</font>
            </td>
            <td width="15%">
                <div align="center">
                    <font size="2" face="Arial, Helvetica, sans-serif">{{ $opdBilling->paid }}</font>
                </div>
            </td>
        </tr>


    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="9%" height="31">
                <font face="Arial, Helvetica, sans-serif" size="2">Create
                    By</font>
            </td>
            <td width="38%" height="31">
                <font face="Arial, Helvetica, sans-serif" size="2">:
                    &nbsp;&nbsp;&nbsp;NMCH</font>
            </td>
            <td width="8%" height="31">
                <font face="Arial, Helvetica, sans-serif" size="2">Create
                    Dt</font>
            </td>
            <td width="24%" height="31">
                <font size="2" face="Arial, Helvetica, sans-serif">:
                    &nbsp;&nbsp;&nbsp;12-Jun-2024 09:02:30 am </font>
            </td>
            <td rowspan="3" width="21%">
                <div align="center">
                    <font face="Arial, Helvetica, sans-serif" size="2"></font>
                    <font face="Arial, Helvetica, sans-serif" size="2"></font>
                    <font face="Arial, Helvetica, sans-serif" size="2"><img
                            src="{{ asset('assets/img/admin-logo.jpg') }}" width="92"></font>
                </div>
            </td>
        </tr>
        <tr>
            <td width="9%" height="28">
                <font face="Arial, Helvetica, sans-serif" size="2">Print
                    By</font>
            </td>
            <td width="38%" height="28">
                <font face="Arial, Helvetica, sans-serif" size="2">:
                    &nbsp;&nbsp;&nbsp;{{ $opdBilling->createdByUser->name }}</font>
            </td>
            <td width="8%" height="28">
                <font size="2" face="Arial, Helvetica, sans-serif">:Print
                    Dt</font>
            </td>
            <td width="24%" height="28">
                <font face="Arial, Helvetica, sans-serif" size="2">:
                    &nbsp;&nbsp;&nbsp;{{ $opdBilling->created_at }}</font>
            </td>
        </tr>
        <tr>
            <td width="9%" height="2">
                <font face="Arial, Helvetica, sans-serif" size="2">
                    {{ $opdBilling->outSidePatient->registration_no }}</font>
            </td>
            <td width="38%" height="2">
                <font face="Arial, Helvetica, sans-serif" size="2"></font>
            </td>
            <td width="8%" height="2">
                <font size="2" face="Arial, Helvetica, sans-serif">:{{ $opdBilling->code }}</font>
            </td>
            <td width="24%" height="2">
                <div align="center">
                    <font face="Arial, Helvetica, sans-serif">
                        <font face="Arial, Helvetica, sans-serif">
                            <font size="2"></font>
                        </font>
                    </font>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <font face="Arial, Helvetica, sans-serif" size="2"></font>
                <font face="Arial, Helvetica, sans-serif" size="2"><?php
                echo '<img src="data:image/png;base64,' . \Milon\Barcode\DNS1D::getBarcodePNG($opdBilling->outSidePatient->registration_no, 'C39', 1.5, 20) . '" alt="barcode"   />';
                
                ?></font>
            </td>
            <td colspan="2">
                <font face="Arial, Helvetica, sans-serif" size="2"></font>
                <font face="Arial, Helvetica, sans-serif" size="2"><?php
                echo '<img src="data:image/png;base64,' . \Milon\Barcode\DNS1D::getBarcodePNG($opdBilling->code, 'C39', 1.5, 20) . '" alt="barcode"   />';
                
                ?></font>
            </td>
            <td width="21%">
                <div align="center">
                    <font face="Arial, Helvetica, sans-serif" size="2"><b>(Authorised
                            Signatory)</b></font>
                </div>
            </td>
        </tr>
    </table>
    </td>
    </tr>
    </table>
</body>

</html>
