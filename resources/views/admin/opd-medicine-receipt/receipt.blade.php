<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .header-heading {
            text-align: center;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .tr-head {
            border-bottom: 2px solid black;
            border-top: 2px solid black;
        }

        th {
            /* background-color: #dddddd; */
            text-align: left;
            padding: 8px;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        td {
            text-align: left;
            padding: 8px;
        }

        .body {
            border-top: 2px solid black;
            display: flex;
            justify-content: space-between;
            /* align-items: center; */
            width: 100%;
        }

        .body2 {
            display: flex;
            justify-content: space-between;
        }

        .body1,
        .body2 {
            width: 100%;

            padding: 8px;
        }

        .body1 {
            border-right: 2px solid black;
            text-align: center;
        }

        .table-style {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 2px solid black;
        }

        .table-style-1 {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        .table-style-2 {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .new {
            border-bottom: 2px solid black;
        }

        .cgst {
            width: 15%;
        }

        /* .cgst-1{
            width: 100%;
        } */
        .happy {
            display: flex;
            width: 50%;
            justify-content: space-evenly;
        }

        /* for print button */
        .container {
            height: 100px;
            position: relative;

        }

        .vertical-center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        @media print {

            .print-button {
                display: none;
            }


        }
    </style>
</head>

<body>
    @include('partials.back-print-btn', [
        'back_url' => route('admin.opd-medicine-sale.sale'),
        'width' => '100%',
    ])

    <div>
        <!-- <div class="header">
            <h1 class="header-heading"><u>Material Requisition Note</u></h1>
        </div> -->
        <div class="body">
            <div class="body1">
                <h2><b>Narayan Medical Hall</b></h2>
                <p>NMCH CAMPUS</p>
                <p>OLD GT ROAD, JAMUHAR, SASARAM</p>
                <p>ROHTAS, BIHAR</p>
                <h3>GST NO: 10ANUPS2806H1ZX</h3>
                <h3><u> Pharamcy Receipt</u></h3>
                <h3>TAX INVOICE</h3>
                <!-- <div class="happy">
                    <div>
                        <h4>Ward </h4>
                    </div>
                    <div>
                        <h4>: ENT Male WARD/ROOM 1/UNIT01/24</h4>
                    </div>
                </div> -->
            </div>
            <div class="body2">
                <div class="body-1">
                    <p>Bill No</p>
                    <p>UMR No</p>
                    <p>Dt of Supply</p>
                    <p>Patient Name</p>
                    <p>Doctor Name</p>
                    <p>Address</p>

                </div>
                <div class="body-2">
                    <p>:</p>
                    <p>:</p>
                    <p>:</p>
                    <p>:</p>
                    <p>:</p>
                    <p>:</p>
                </div>
                <div class="body-3">
                    <p>{{ $opdMedicineReceipt->code }}</p>
                    <p>{{ $opdMedicineReceipt->patient->registration_no }}</p>
                    <p>{{ date('d-M-Y h:i:s A', strtotime($opdMedicineReceipt->created_at)) }}</p>
                    <p>{{ $opdMedicineReceipt->patient->name }}</p>
                    <p>{{ $opdMedicineReceipt->patientvisit->doctor != null ? $opdMedicineReceipt->patientvisit->doctor->name : null }}
                    </p>
                    <p>{{ $opdMedicineReceipt->patient->address }} </p>
                </div>
                <div class="body-4">
                    <p>Bill Date</p>
                    <p></p>
                    <p>D.L.No.</p>
                    <p></p>
                </div>
                <div class="body-5">
                    <p>:</p>
                    <p></p>
                    <p>:</p>
                    <p></p>
                </div>
                <div class="body-6">
                    <p>{{ date('d-M-Y ', strtotime($opdMedicineReceipt->created_at)) }}</p>
                    <p></p>
                    <p>ROH-16A/2018</p>
                    <p></p>
                </div>
            </div>

        </div>


        <div class="table-section">
            <table>
                <tr class="tr-head">
                    <th>S. No.</th>
                    <th>Item Desc</th>
                    <th>HSN CODE</th>
                    <th>Sh</th>
                    <th>Batch No</th>
                    <th>Exp Dt</th>
                    <th>Bin No</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Amount Disc</th>
                    <th>Amt</th>
                    <th>Taxable Amt</th>
                    <th class="cgst">
                        <div class="table-style-1">
                            <div>
                                CGST
                            </div>
                            <div>
                                SGST
                            </div>
                        </div>

                        <div class="table-style">
                            <div>%</div>
                            <div>Amt %</div>
                            <div class="amt">Amt </div>
                        </div>

                    </th>
                    <!-- <th class="sgst">SGST

                </th> -->
                    <th>Bill Amt</th>
                </tr>
                @foreach ($opdMedicineReceipt->opdmedicinetransactions as $opdmedicinetransactions)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $opdmedicinetransactions->item->description }}</td>
                        <td>{{ $opdmedicinetransactions->item->hsn }}</td>
                        <td></td>
                        <td>{{ $opdmedicinetransactions->batch_no }}</td>
                        <td>{{ $opdmedicinetransactions->exd }}</td>
                        <td>bin</td>
                        <td>{{ $opdmedicinetransactions->quantity }}</td>
                        <td>{{ $opdmedicinetransactions->unit_sale_price }}</td>
                        <td>{{ $opdmedicinetransactions->discount }}</td>
                        <td>{{ $opdmedicinetransactions->amount }}</td>
                        <td>{{ $opdmedicinetransactions->taxable_amount }}</td>
                        <td class="cgst">

                            <div class="table-style-2">
                                <div>{{ $opdmedicinetransactions->cgst }}</div>
                                <div>
                                    {{ ($opdmedicinetransactions->taxable_amount * $opdmedicinetransactions->cgst) / 100 }}
                                </div>
                                <div>{{ $opdmedicinetransactions->sgst }}</div>
                                <div>
                                    {{ ($opdmedicinetransactions->taxable_amount * $opdmedicinetransactions->sgst) / 100 }}
                                </div>
                            </div>

                        </td>
                        <td>{{ $opdmedicinetransactions->taxable_amount + ($opdmedicinetransactions->taxable_amount * $opdmedicinetransactions->cgst) / 100 + ($opdmedicinetransactions->taxable_amount * $opdmedicinetransactions->sgst) / 100 }}
                        </td>
                    </tr>
                @endforeach

                <tr class="tr-head">

                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b> {{ $totalAmount }}</b></td>
                    <td><b>{{ $totalTaxableAmount }}</b></td>
                    <td class="cgst">

                        <div class="table-style-2 ">
                            <div></div>
                            <div>
                                <b>{{ $totalCgst }}</b>
                            </div>
                            <div class="amt"><b>{{ $totalCgst }}</b> </div>
                        </div>

                    </td>
                    <td><b>{{ $total }} </b></td>
                </tr>
                <tr></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="cgst">

                        <div class="table-style-2">
                            <div><b> Cash Amount</b></div>
                            <div> </div>
                            <div class="amt"> </div>
                        </div>

                    </td>
                    <td>
                        @if ($opdMedicineReceipt->pharmacydue)
                            {{ $opdMedicineReceipt->pharmacydue->paid_amount }}
                        @else
                            {{ $total }}
                        @endif
                    </td>
                </tr>
                @if ($opdMedicineReceipt->pharmacydue)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="cgst">

                            <div class="table-style-2">
                                <div><b> Due Amount</b></div>
                                <div> </div>
                                <div class="amt"> </div>
                            </div>

                        </td>
                        <td>

                            <p> {{ $opdMedicineReceipt->pharmacydue->due_amount }}</p>

                        </td>
                    </tr>
                @endif

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="cgst">

                        <div class="table-style-2">
                            <div><b>Recipt Amount</b> </div>
                            <div> </div>
                            <div class="amt"> </div>
                        </div>

                    </td>
                    <td> {{ $total }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Pharmacist </b></td>
                    <td class="cgst">

                        <div class="table-style-2">
                            <div></div>
                            <div> </div>
                            <div class="amt"> </div>
                        </div>

                    </td>
                    <td></td>
                </tr>
            </table>
            <div class="table-style-2">
                <div><b>Created:{{ Auth::user()->name }} {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</b> </div>
                {{-- <div class="amt"><b>Printed:</b>ABC ABC ABC </div> --}}
            </div>
        </div>
    </div>
</body>

</html>
