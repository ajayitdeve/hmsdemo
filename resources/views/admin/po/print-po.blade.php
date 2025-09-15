<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OPD Receipt</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table {
            font-family: arial, sans-serif;
            width: 80%;
            font-size: 12px;
            margin: auto;
        }

        @media print {
            table {
                width: 100%;
            }

            table tr {
                margin-bottom: 10px;

            }

            table,
            th,
            td {
                border: 1px solid black;
                border-collapse: collapse;
            }

        }
    </style>
</head>

<body>
    @include('partials.back-print-btn', [
        'back_url' => route('admin.po.list-purchase-order'),
        'width' => '80%',
    ])

    <table border="1">
        <tr>
            <td style="text-align:center" colspan="14">
                <h2 style="margin: 0px; padding:0px;">NARAYAN MEDICAL HALL

                    @if ($purchaseOrder->status == 0)
                        <span style="color:red">: PO Not Approved</span>
                    @endif
                </h2>
            </td>
        </tr>
        <tr>
            <td style="text-align:center" colspan="14">
                <p>JAMUHAR,SASARAM<br />ROHTAS,<br />BIHAR<br />GST NO:10ANUPS2806Z1x </p>
                <p style="margin-bottom:0px;"><strong><u> Purchase Order</u></strong></p>
                <p><u>CENTRAL PHARMACY</u></p>
            </td>
        </tr>
        <tr>
            <td style="width:40%" colspan="6">
                To<br />
                {{ $purchaseOrder->vendor->name }}<br />
                {{ $purchaseOrder->vendor->address }}<br />
                <br>
                Phone : <br />
                GST No: {{ $purchaseOrder->vendor->gst_no }}
            </td>
            <td style="width:30%" colspan="4">
                PO No: {{ $purchaseOrder->code }}<br />
                PO Date: {{ \Carbon\Carbon::parse($purchaseOrder->created_at)->format('d-M-Y') }}<br />
                Status: @if ($purchaseOrder->status == 1)
                    Approved
                @else
                    Pending
                @endif
                <br />
                Delivery Period: {{ $purchaseOrder->vendor->delivery_days }} <br />
                Credit Period: {{ $purchaseOrder->vendor->payment_days }} <br />

            </td>
            <td style="width:30%" colspan="4">
                Indent No: {{ $purchaseOrder->purchaseindent->code }} <br />
                Indent Date: {{ \Carbon\Carbon::parse($purchaseOrder->purchaseindent->date)->format('d-M-Y') }} <br />
            </td>
        </tr>

        <tr>
            <td colspan="14" style="padding: 5px;">
                Dear Sir,<br /><br />
                Sub: Supply of items required for Hospital<br />
                We are pleased to plac purcharse order for supply of following items.
                <br />
            </td>
        </tr>
        <tr style="text-align: center">
            <td>S.N.</td>
            <td>Description Of Goods</td>
            <td>HSN Code</td>
            <td>Quantity</td>
            <td>Bonus</td>
            <td>UOM</td>
            <td>Rate</td>
            <td>Total</td>
            <td>Disc(%)</td>
            <td>Taxable Value</td>
            <td colspan="2">CGST
                <hr />Rate &nbsp Amt.
            </td>
            <td colspan="2">CGST
                <hr />Rate &nbsp Amt.
            </td>


        </tr>


        @foreach ($purchaseOrderItems as $index => $purchaseOrderItem)
            <tr style="text-align: center">
                <td>{{ $index + 1 }}</td>
                <td>{{ $purchaseOrderItem->item->description }}</td>
                <td>{{ $purchaseOrderItem->item->hsn }}</td>
                <td>{{ $purchaseOrderItem->quantity }}</td>
                <td>{{ $purchaseOrderItem->bonus }}</td>

                <td>{{ $purchaseOrderItem->item->purchaseuom->name }}</td>
                <td>{{ $purchaseOrderItem->unitrate }}</td>
                <td>{{ $purchaseOrderItem->quantity * $purchaseOrderItem->unitrate }}</td>
                <td>{{ $purchaseOrderItem->discount_percent }}</td>
                <td>{{ $purchaseOrderItem->quantity * $purchaseOrderItem->unitrate - ($purchaseOrderItem->quantity * $purchaseOrderItem->unitrate * $purchaseOrderItem->discount_percent) / 100 }}
                </td>
                <td>{{ $purchaseOrderItem->item->sgst }}</td>
                <td>{{ ($purchaseOrderItem->quantity * $purchaseOrderItem->unitrate - ($purchaseOrderItem->quantity * $purchaseOrderItem->unitrate * $purchaseOrderItem->discount_percent) / 100) * ($purchaseOrderItem->item->sgst / 100) }}
                </td>
                <td>{{ $purchaseOrderItem->item->cgst }}</td>
                <td>{{ ($purchaseOrderItem->quantity * $purchaseOrderItem->unitrate - ($purchaseOrderItem->quantity * $purchaseOrderItem->unitrate * $purchaseOrderItem->discount_percent) / 100) * ($purchaseOrderItem->item->cgst / 100) }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="8" rowspan="4" style="border:0px !important">
                <?php
                //    $obj=new IndianCurrency(number_format((float)$purchaseOrder->calTaxamount($purchaseOrder->id), 2, '.', ''));
                //    echo $obj->get_word();
                $obj = new \App\Services\IndianCurrency(number_format((float) $purchaseOrder->calGrandtotal($purchaseOrder->id), 2, '.', ''));
                echo $obj->get_words();
                ?>
            </td>
            <td colspan="2" style="border:0px !important">Sub Total</td>
            <td colspan="2" style="border:0px !important">:</td>
            <td colspan="2" style="border:0px !important;float:right">
                {{ number_format((float) $purchaseOrder->calSubtotal($purchaseOrder->id), 2, '.', '') }}</td>
        </tr>

        <td colspan="2" style="border:0px !important">Discount</td>
        <td colspan="2" style="border:0px !important">:</td>
        <td colspan="2" style="border:0px !important;float:right">
            {{ number_format((float) $purchaseOrder->calDiscount($purchaseOrder->id), 2, '.', '') }}</td>
        </tr>
        <tr>

            <td colspan="2" style="border:0px !important">Tax Amount</td>
            <td colspan="2" style="border:0px !important">:</td>
            <td colspan="2" style="border:0px !important;float:right">
                {{ number_format((float) $purchaseOrder->calTaxamount($purchaseOrder->id), 2, '.', '') }}</td>
        </tr>
        <tr>

            <td colspan="2" style="border:0px !important">PO total Amount</td>
            <td colspan="2" style="border:0px !important">:</td>
            <td colspan="2" style="border:0px !important;float:right">
                {{ number_format((float) $purchaseOrder->calGrandtotal($purchaseOrder->id), 2, '.', '') }}</td>
        </tr>
        <tr>
            <td colspan="14"> {{ $purchaseOrder->purchaseterm->details }}</td>
        </tr>
    </table>

</body>

</html>
