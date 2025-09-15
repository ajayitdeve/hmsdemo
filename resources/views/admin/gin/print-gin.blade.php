<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Good Issue Note : {{ $gin->code }}</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 80%;
        }

        .final-section {
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>

<body>
    @include('partials.back-print-btn', [
        'back_url' => route('admin.gin.create-gin-items', $gin->id),
        'width' => '100%',
    ])

    <div>
        <div class="header">
            <h1 class="header-heading"><u>Goods Issue Note</u></h1>
        </div>
        <div class="body">
            <div class="body1">
                <p>GIN No</p>
                <p>GIN Date</p>
                <p>Ind No</p>
                <p>Ind Dt</p>
                <p>Created By</p>
                <p>Approved By</p>
            </div>
            <div class="body2">
                <p>:</p>
                <p>:</p>
                <p>:</p>
                <p>:</p>
                <p>:</p>
                <p>:</p>
            </div>
            <div class="body3">
                <p>{{ $gin->code }}</p>
                <p>{{ date('d-M-Y ', strtotime($gin->created_at)) }}</p>
                <p>{{ $gin->mrq->code }}</p>
                <p>{{ date('d-M-Y', strtotime($gin->mrq->request_date)) }}</p>
                <p>{{ $gin->createdby->name }}</p>
                <p>{{ $gin->approvedby->name }}</p>
            </div>
            <div class="body4">
                <p>Status</p>
                <p>Stack Point</p>
                <p>To Department</p>
                <p>Dept DL No</p>
                <p>Create DT</p>
                <p>Approved DT</p>
            </div>
            <div class="body5">
                <p>:</p>
                <p>:</p>
                <p>:</p>
                <p>:</p>
                <p>:</p>
                <p>:</p>
            </div>
            <div class="body6">
                <p>{{ $gin->status ? 'Approved' : 'Not Approved' }}</p>
                <p>Central Pharmacy</p>
                <p>{{ $gin->stockpoint->name }}</p>
                <p>TICH-JAN/2B</p>
                <p>{{ $gin->created_at }}</p>
                <p>{{ $gin->created_at }}</p>
            </div>
        </div>
        <div class="table-section">
            <table>
                <tr class="tr-head">
                    <th>S. No.</th>
                    <th>Item Desc</th>
                    <th>Qty</th>
                    <th>Batch No</th>
                    <th>Bill No</th>
                    <th>Exp DT</th>
                </tr>
                @foreach ($gin->ginitems as $ginitem)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $ginitem->item->description }}</td>
                        <td>{{ $ginitem->quantity }}</td>
                        <td>{{ $ginitem->batch_no }}</td>
                        <td>{{ $ginitem->grn->invoice_no }}</td>
                        <td>{{ date('d-M-Y', strtotime($ginitem->created_at)) }}</td>
                    </tr>
                @endforeach
            </table>
            <div>
                <h4>Item remarsk</h4>
                <h4>Print Date & Time : {{ \Carbon\Carbon::now()->format('l jS \\of F Y h:i:s A') }}</h4>
            </div>
            <div class="final-section">
                <h4>Powered By</h4>
                <h4>Recived By</h4>
            </div>

        </div>
    </div>

</body>

</html>
