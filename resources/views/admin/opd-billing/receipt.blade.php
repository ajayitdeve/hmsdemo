<html>

<head>
    <title>OP Bill - Cum - Receipt</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
            color: #000;
        }

        .a4-sheet {
            width: 21cm;
            min-height: 29.7cm;
            margin: auto;
            padding: 20px;
            background: #fff;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .bill-header td {
            vertical-align: top;
            padding: 5px;
        }

        .bill-header img {
            max-height: 80px;
        }

        .section-title {
            font-weight: bold;
            font-size: 15px;
            text-align: center;
            padding: 5px 0;
        }

        .patient-bill td {
            font-size: 13px;
            padding: 3px 5px;
            vertical-align: top;
            line-height: 1;
        }

        .patient-bill td b {
            display: inline-block;
            min-width: 90px;
            margin-bottom: 4px;
        }

        .items th,
        .items td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            font-size: 13px;
        }

        .items th {
            background: #f5f5f5;
            font-weight: bold;
        }

        .summary td {
            padding: 5px;
            font-size: 13px;
        }

        .sign-box {
            text-align: center;
            font-weight: bold;
            padding-top: 20px;
        }

        .footer-logo {
            max-height: 60px;
        }

        .created-by-details {
            font-size: 13px;
        }

        @media print {
            body {
                margin: 0;
            }

            .a4-sheet {
                margin: 0;
                padding: 10mm;
                box-shadow: none;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    @include('partials.back-print-btn', [
        'back_url' => route('admin.all-opd-bill'),
        'width' => '50%',
    ])

    <div class="a4-sheet">
        <!-- Header -->
        <table class="bill-header">
            <tr>
                <td width="20%">
                    <img src="{{ asset('assets/img/admin-logo.jpg') }}">
                </td>
                <td width="60%" align="center">
                    <b>NARAYAN MEDICAL COLLEGE & HOSPITAL</b><br>
                    JAMUHAR, SASARAM, ROHTAS, BIHAR<br>
                    Ph - 06184-281899<br><br>
                    <span class="section-title">OP Bill - Cum - Receipt</span>
                </td>
                <td width="20%" align="right"></td>
            </tr>
        </table>
        <hr>

        <!-- Patient Info + Bill Info -->
        <table class="patient-bill">
            <tr>
                <!-- Patient Details -->
                <td width="60%" valign="top">
                    <table style="width:100%;">
                        <tr>
                            <td><b>UMR No:</b> {{ $opdBilling->patient->registration_no }}</td>
                        </tr>
                        <tr>
                            <td><b>Pt Name:</b> {{ $opdBilling->patient->salution->name }}
                                {{ $opdBilling->patient->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Father Name:</b> {{ $opdBilling->patient->father_name }}</td>
                        </tr>
                        <tr>
                            <td><b>Phone:</b> {{ $opdBilling->patient->mobile }}</td>
                        </tr>
                        <tr>
                            <td><b>Address:</b> {{ $opdBilling->patient->address }}</td>
                        </tr>
                    </table>
                </td>

                <!-- Bill Details -->
                <td width="40%" valign="top" align="right">
                    <table style="width:100%;">
                        <tr>
                            <td align="right"><b>Bill No:</b> {{ $opdBilling->code }}</td>
                        </tr>
                        <tr>
                            <td align="right"><b>Age/Sex:</b>
                                {{ date('Y') - date('Y', strtotime($opdBilling->patient->dob)) }} Y /
                                {{ $opdBilling->patient->gender->name }}
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><b>Date:</b>
                                {{ date('d-m-Y h:i A', strtotime($opdBilling->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td align="right"><b>Consultant:</b>
                                {{ strtoupper($opdBilling->patientvisit->unit->name) }}</td>
                        </tr>
                        <tr>
                            <td align="right"><b>Ref By:</b> WALKIN</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br>

        <!-- Items -->
        <table class="items">
            <thead>
                <tr>
                    <th>Sl. No.</th>
                    <th>Service Name</th>
                    <th>Service Code</th>
                    <th>Qty</th>
                    <th style="text-align: right;">Rate</th>
                    <th style="text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($opdBilling->opdBillingItems()->where('is_cancled', '0')->get() as $opdBillingItem)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            {{ $opdBillingItem?->service?->corporate_service_fee?->name ?: $opdBillingItem?->service?->name }}
                        </td>
                        <td>
                            {{ $opdBillingItem?->service?->corporate_service_fee?->code ?: $opdBillingItem?->service?->code }}
                        </td>
                        <td>{{ $opdBillingItem->quantity }}</td>
                        <td style="text-align: right;">
                            {{ $opdBillingItem->unit_service_price }}
                        </td>
                        <td style="text-align: right;">
                            {{ $opdBillingItem->quantity * $opdBillingItem->unit_service_price }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>

        <!-- Summary -->
        <table class="summary" width="100%">
            <tr>
                <td align="right" width="80%"><b>Total:</b></td>
                <td align="right" width="20%"><b>{{ $totalAmount }}</b></td>
            </tr>
            @if ($totaldDiscount > 0)
                <tr>
                    <td align="right"><b>Discount:</b></td>
                    <td align="right">-{{ number_format($totaldDiscount, 2) }}</td>
                </tr>
            @endif
            <tr>
                <td align="right"><b>Payable Amt:</b></td>
                <td align="right">{{ number_format($opdBilling->total_amount, 2) }}</td>
            </tr>
            @if ($opdBilling->due_amount > 0)
                <tr>
                    <td align="right"><b>Receipt Amt:</b></td>
                    <td align="right">{{ $opdBilling->paid_amount }}</td>
                </tr>
                <tr>
                    <td align="right"><b>Due Amount:</b></td>
                    <td align="right">{{ $opdBilling->due_amount }}</td>
                </tr>
            @else
                <tr>
                    <td align="right"><b>Receipt Amt:</b></td>
                    <td align="right">{{ $opdBilling->paid_amount }}</td>
                </tr>
            @endif
        </table>
        <br><br>

        <!-- Footer -->
        <table width="100%" class="created-by-details">
            <tr>
                <td><b>Created By:</b> {{ $createdBy->name }}</td>
                <td><b>Created Dt:</b> {{ date('d-m-Y h:i:s A', strtotime($opdBilling->created_at)) }}</td>
                <td class="sign-box">
                    <img src="{{ asset('assets/img/admin-logo.jpg') }}" class="footer-logo"><br>
                    (Authorised Signatory)
                </td>
            </tr>
            <tr>
                <td><b>Printed By:</b> {{ auth()->user()->name }}</td>
                <td><b>Printed Dt:</b> {{ date('d-m-Y h:i:s A') }}</td>
                <td></td>
            </tr>
        </table>
        <br><br>

        <!-- Barcode Section -->
        <table width="100%" style="margin-top:10px;">
            <tr>
                <td align="left">
                    <b>UMR No:</b> {{ $opdBilling->patient->registration_no }}<br>
                    <?php
                    echo '<img src="data:image/png;base64,' . \Milon\Barcode\DNS1D::getBarcodePNG($opdBilling->patient->registration_no, 'C39', 1.5, 30) . '" />';
                    ?>
                </td>
                <td align="right">
                    <b>Bill No:</b> {{ $opdBilling->code }}<br>
                    <?php
                    echo '<img src="data:image/png;base64,' . \Milon\Barcode\DNS1D::getBarcodePNG($opdBilling->code, 'C39', 1.5, 30) . '" />';
                    ?>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>
