@extends('exports.layouts.header')

@section('content')
    <div class="pdf-header text-center">
        <h3>{{ $selection_types["$selection_type"] }}</h3>
        @if ($from_date && !$to_date)
            <h4>{{ \Carbon\Carbon::parse($from_date)->format('d-M-Y h:i A') }}</h4>
        @elseif ($from_date && $to_date)
            <h4>
                {{ \Carbon\Carbon::parse($from_date)->format('d-M-Y h:i A') }}
                To
                {{ \Carbon\Carbon::parse($to_date)->format('d-M-Y h:i A') }}
            </h4>
        @endif
    </div>

    <table border="2" width="100%">
        <thead>
            <tr>
                <th>Service Group</th>
                <th>Qty.</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>Concession</th>
                <th>Receipt</th>
                <th>Due</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($receipt_wise_shift_collections as $receipt_wise_shift_collection)
                <tr>
                    <td>{{ $receipt_wise_shift_collection['service_group'] }}</td>
                    <td>{{ $receipt_wise_shift_collection['qty'] }}</td>
                    <td>{{ $receipt_wise_shift_collection['rate'] }}</td>
                    <td>{{ $receipt_wise_shift_collection['amount'] }}</td>
                    <td>{{ $receipt_wise_shift_collection['concession'] }}</td>
                    <td>{{ $receipt_wise_shift_collection['receipt'] }}</td>
                    <td>{{ $receipt_wise_shift_collection['due'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
