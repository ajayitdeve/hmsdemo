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
            border: 2px solid black;
        }

        th {
            background-color: #dddddd;
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
    </style>
</head>

<body>
    @include('partials.back-print-btn', [
        'back_url' => route('admin.mrq.create-mrq'),
        'width' => '100%',
    ])
    <div>
        <div class="header">
            <h1 class="header-heading"><u>Material Requisition Note</u>
                @if ($mrq->status == 0)
                    <span style="color:red">Not Approved</span>
                @endif
            </h1>

        </div>
        <div class="body">
            <div class="body1">
                <p>MRQ No</p>
                <p>MRQ Date</p>
                <p>Status</p>
                <p>Print Date & tim</p>
            </div>
            <div class="body2">
                <p>:</p>
                <p>:</p>
                <p>:</p>
                <p>:</p>
            </div>
            <div class="body3">
                <p>{{ $mrq->code }}</p>
                <p>{{ $mrq->request_date }}</p>
                <p>{{ $mrq->status }}</p>
                <p> {{ \Carbon\Carbon::now()->format('d-M-Y h:i:s A') }}</p>
            </div>
            <div class="body4">
                <p>From Dept</p>
                <p>To Dept</p>
                <p>Req. By</p>
            </div>
            <div class="body5">
                <p>:</p>
                <p>:</p>
                <p>:</p>
            </div>
            <div class="body6">
                <p>{{ $mrq->stockpointfrom->name }}</p>
                <p>{{ $mrq->stockpointto->name }}</p>
                <p>{{ Auth::user()->name }}</p>
            </div>
        </div>
        <div class="table-section">
            <table>
                <tr class="tr-head">
                    <th>S. No.</th>
                    <th>Item Name</th>
                    <th>BinNo</th>
                    <th>Requested Qty</th>
                    <th>Remarks</th>
                </tr>
                @foreach ($mrq->mrqitems as $mrqitem)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $mrqitem->item->description }}</td>
                        <?php
                        // $bin=\App\Models\Bin::where('item_id',$mrqitem->item->id)->first();
                        ?>
                        <td>
                            @if (isset($bin))
                                {{ $bin->code }}
                            @endif
                        </td>

                        <td>{{ $mrqitem->quantity }}</td>
                        <td></td>
                    </tr>
                @endforeach


            </table>

        </div>
    </div>

</body>

</html>
