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

    @if ($search_type == 'summary-print')
        @php
            $grand_total = [
                'gross_amount' => 0,
                'conc_amount' => 0,
                'advance_amount' => 0,
                'net_amount' => 0,
                'receipt_amount' => 0,
                'cash_amount' => 0,
                'online_amount' => 0,
                'other_amount' => 0,
                'due_amount' => 0,
            ];
        @endphp
        <table border="2" width="100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Gross Amt</th>
                    <th>Conc. Amt</th>
                    <th>Receipt Amt</th>
                    <th>Due Amt</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($receipt_wise_shift_collections as $user)
                    @php
                        $users_total = [
                            'opd_medicine_receipts' => [
                                'label' => 'Dep. Pharmacy Bill (OPD)',
                                'gross_amount' => 0,
                                'conc_amount' => 0,
                                'advance_amount' => 0,
                                'net_amount' => 0,
                                'receipt_amount' => 0,
                                'cash_amount' => 0,
                                'online_amount' => 0,
                                'other_amount' => 0,
                                'due_amount' => 0,
                                'is_visible' => false,
                            ],
                            'opd_billings' => [
                                'label' => 'OPD Bills (OPD Service)',
                                'gross_amount' => 0,
                                'conc_amount' => 0,
                                'advance_amount' => 0,
                                'net_amount' => 0,
                                'receipt_amount' => 0,
                                'cash_amount' => 0,
                                'online_amount' => 0,
                                'other_amount' => 0,
                                'due_amount' => 0,
                                'is_visible' => false,
                            ],
                            'ip_pharmacy_indent_billings' => [
                                'label' => 'IP Bills (IPD Item)',
                                'gross_amount' => 0,
                                'conc_amount' => 0,
                                'advance_amount' => 0,
                                'net_amount' => 0,
                                'receipt_amount' => 0,
                                'cash_amount' => 0,
                                'online_amount' => 0,
                                'other_amount' => 0,
                                'due_amount' => 0,
                                'is_visible' => false,
                            ],
                            'ip_service_billings' => [
                                'label' => 'IP Advance',
                                'gross_amount' => 0,
                                'conc_amount' => 0,
                                'advance_amount' => 0,
                                'net_amount' => 0,
                                'receipt_amount' => 0,
                                'cash_amount' => 0,
                                'online_amount' => 0,
                                'other_amount' => 0,
                                'due_amount' => 0,
                                'is_visible' => false,
                            ],
                            'op_consultation' => [
                                'label' => 'OP Consultation',
                                'gross_amount' => 0,
                                'conc_amount' => 0,
                                'advance_amount' => 0,
                                'net_amount' => 0,
                                'receipt_amount' => 0,
                                'cash_amount' => 0,
                                'online_amount' => 0,
                                'other_amount' => 0,
                                'due_amount' => 0,
                                'is_visible' => false,
                            ],
                            'registration' => [
                                'label' => 'Registration',
                                'gross_amount' => 0,
                                'conc_amount' => 0,
                                'advance_amount' => 0,
                                'net_amount' => 0,
                                'receipt_amount' => 0,
                                'cash_amount' => 0,
                                'online_amount' => 0,
                                'other_amount' => 0,
                                'due_amount' => 0,
                                'is_visible' => false,
                            ],
                        ];
                    @endphp

                    {{-- Dep. Pharmacy Bill (OPD Item) --}}
                    @foreach ($user->opd_medicine_receipts as $opd_medicine_receipt)
                        @php
                            $gross_amount = $opd_medicine_receipt->gross_amount ?? 0;
                            $discount_amount = $opd_medicine_receipt->discount_amount ?? 0;
                            $advance_amount = $opd_medicine_receipt->advance_amount ?? 0;
                            $paid_amount = $opd_medicine_receipt->paid_amount ?? 0;
                            // $total_amount = $opd_medicine_receipt->total_amount ?? 0;
                            $other_amount = $opd_medicine_receipt->other_amount ?? 0;
                            $due_amount = 0;

                            if (
                                $opd_medicine_receipt->pharmacydue &&
                                $opd_medicine_receipt->pharmacydue->is_due_cleared == 0
                            ) {
                                $due_amount = $opd_medicine_receipt->due_amount ?? 0;
                            }

                            $users_total['opd_medicine_receipts']['gross_amount'] += $gross_amount;
                            $users_total['opd_medicine_receipts']['conc_amount'] += $discount_amount;
                            $users_total['opd_medicine_receipts']['advance_amount'] += $advance_amount;
                            $users_total['opd_medicine_receipts']['net_amount'] += $paid_amount;
                            $users_total['opd_medicine_receipts']['receipt_amount'] += $paid_amount;
                            $users_total['opd_medicine_receipts']['cash_amount'] += $paid_amount;
                            $users_total['opd_medicine_receipts']['online_amount'] += 0;
                            $users_total['opd_medicine_receipts']['other_amount'] += $other_amount;
                            $users_total['opd_medicine_receipts']['due_amount'] += $due_amount;
                            $users_total['opd_medicine_receipts']['is_visible'] = true;
                        @endphp
                    @endforeach

                    {{-- OP Bills (OPD Service) --}}
                    @foreach ($user->opd_billings as $opd_billing)
                        @php
                            $gross_amount = $opd_billing->gross_amount ?? 0;
                            $discount_amount = $opd_billing->discount_amount ?? 0;
                            $advance_amount = $opd_billing->advance_amount ?? 0;
                            $paid_amount = $opd_billing->paid_amount ?? 0;
                            // $total_amount = $opd_billing->total_amount ?? 0;
                            $other_amount = $opd_billing->other_amount ?? 0;
                            $due_amount = 0;

                            if ($opd_billing->serviceDue && $opd_billing->serviceDue->is_due_cleared == 0) {
                                $due_amount = $opd_billing->due_amount ?? 0;
                            }

                            $users_total['opd_billings']['gross_amount'] += $gross_amount;
                            $users_total['opd_billings']['conc_amount'] += $discount_amount;
                            $users_total['opd_billings']['advance_amount'] += $advance_amount;
                            $users_total['opd_billings']['net_amount'] += $paid_amount;
                            $users_total['opd_billings']['receipt_amount'] += $paid_amount;
                            $users_total['opd_billings']['cash_amount'] += $paid_amount;
                            $users_total['opd_billings']['online_amount'] += 0;
                            $users_total['opd_billings']['other_amount'] += $other_amount;
                            $users_total['opd_billings']['due_amount'] += $due_amount;
                            $users_total['opd_billings']['is_visible'] = true;
                        @endphp
                    @endforeach

                    {{-- IP Bills (IPD Item) --}}
                    @foreach ($user->ip_pharmacy_indent_billings as $ip_pharmacy_indent_billing)
                        @php
                            $gross_amount = $ip_pharmacy_indent_billing->gross_amount ?? 0;
                            $discount_amount = $ip_pharmacy_indent_billing->discount_amount ?? 0;
                            $advance_amount = $ip_pharmacy_indent_billing->advance_amount ?? 0;
                            $paid_amount = $ip_pharmacy_indent_billing->paid_amount ?? 0;
                            // $total_amount = $ip_pharmacy_indent_billing->total_amount ?? 0;
                            $other_amount = $ip_pharmacy_indent_billing->other_amount ?? 0;
                            $due_amount = 0;

                            if (
                                $ip_pharmacy_indent_billing->IpPharmacyDue &&
                                $ip_pharmacy_indent_billing->IpPharmacyDue->is_due_cleared == 0
                            ) {
                                $due_amount = $ip_pharmacy_indent_billing->due_amount ?? 0;
                            }

                            $users_total['ip_pharmacy_indent_billings']['gross_amount'] += $gross_amount;
                            $users_total['ip_pharmacy_indent_billings']['conc_amount'] += $discount_amount;
                            $users_total['ip_pharmacy_indent_billings']['advance_amount'] += $advance_amount;
                            $users_total['ip_pharmacy_indent_billings']['net_amount'] += $paid_amount;
                            $users_total['ip_pharmacy_indent_billings']['receipt_amount'] += $paid_amount;

                            if ($ip_pharmacy_indent_billing->payment_by == 'cash') {
                                $users_total['ip_pharmacy_indent_billings']['cash_amount'] += $paid_amount;
                            } else {
                                $users_total['ip_pharmacy_indent_billings']['online_amount'] += $paid_amount;
                            }

                            $users_total['ip_pharmacy_indent_billings']['other_amount'] += $other_amount;
                            $users_total['ip_pharmacy_indent_billings']['due_amount'] += $due_amount;
                            $users_total['ip_pharmacy_indent_billings']['is_visible'] = true;
                        @endphp
                    @endforeach

                    {{-- IP Advance (IPD Service) --}}
                    @foreach ($user->ip_service_billings as $ip_service_billing)
                        @php
                            $gross_amount = $ip_service_billing->gross_amount ?? 0;
                            $discount_amount = $ip_service_billing->discount_amount ?? 0;
                            $advance_amount = $ip_service_billing->advance_amount ?? 0;
                            $paid_amount = $ip_service_billing->paid_amount ?? 0;
                            // $total_amount = $ip_service_billing->total_amount ?? 0;
                            $other_amount = $ip_service_billing->other_amount ?? 0;
                            $due_amount = 0;

                            if (
                                $ip_service_billing->ipServiceDue &&
                                $ip_service_billing->ipServiceDue->is_due_cleared == 0
                            ) {
                                $due_amount = $ip_service_billing->due_amount ?? 0;
                            }

                            $users_total['ip_service_billings']['gross_amount'] += $gross_amount;
                            $users_total['ip_service_billings']['conc_amount'] += $discount_amount;
                            $users_total['ip_service_billings']['advance_amount'] += $advance_amount;
                            $users_total['ip_service_billings']['net_amount'] += $paid_amount;
                            $users_total['ip_service_billings']['receipt_amount'] += $paid_amount;

                            if ($ip_pharmacy_indent_billing->payment_by == 'cash') {
                                $users_total['ip_service_billings']['cash_amount'] += $paid_amount;
                            } else {
                                $users_total['ip_service_billings']['online_amount'] += $paid_amount;
                            }

                            $users_total['ip_service_billings']['other_amount'] += $other_amount;
                            $users_total['ip_service_billings']['due_amount'] += $due_amount;
                            $users_total['ip_service_billings']['is_visible'] = true;
                        @endphp
                    @endforeach

                    {{-- Registration --}}
                    @foreach ($user->registrations as $patient)
                        @php
                            $users_total['registration']['gross_amount'] += 0;
                            $users_total['registration']['conc_amount'] += 0;
                            $users_total['registration']['advance_amount'] += 0;
                            $users_total['registration']['net_amount'] += 0;
                            $users_total['registration']['receipt_amount'] += 0;
                            $users_total['registration']['cash_amount'] += 0;
                            $users_total['registration']['online_amount'] += 0;
                            $users_total['registration']['other_amount'] += 0;
                            $users_total['registration']['due_amount'] += 0;
                            $users_total['registration']['is_visible'] = true;
                        @endphp
                    @endforeach

                    {{-- OP Consultation --}}
                    @foreach ($user->patient_visits as $patient_visit)
                        @php
                            $gross_amount = $patient_visit->fee ?? 0;
                            $discount_amount = $patient_visit->discount ?? 0;
                            $advance_amount = 0;
                            $net_amount = $patient_visit->fee ?? 0;
                            $receipt_amount = $patient_visit->fee ?? 0;
                            $cash_amount = $patient_visit->fee ?? 0;
                            $online_amount = 0;
                            $other_amount = 0;
                            $due_amount = 0;

                            $users_total['op_consultation']['gross_amount'] += $gross_amount;
                            $users_total['op_consultation']['conc_amount'] += $discount_amount;
                            $users_total['op_consultation']['advance_amount'] += $advance_amount;
                            $users_total['op_consultation']['net_amount'] += $net_amount;
                            $users_total['op_consultation']['receipt_amount'] += $receipt_amount;
                            $users_total['op_consultation']['cash_amount'] += $cash_amount;
                            $users_total['op_consultation']['online_amount'] += $online_amount;
                            $users_total['op_consultation']['other_amount'] += $other_amount;
                            $users_total['op_consultation']['due_amount'] += $due_amount;
                            $users_total['op_consultation']['is_visible'] = true;
                        @endphp
                    @endforeach

                    {{-- @foreach ($users_total as $row)
                        @if ($row['is_visible'])
                            <tr>
                                <td>{{ $row['label'] }}</td>
                                <td>{{ number_format($row['gross_amount'], 2) }}</td>
                                <td>{{ number_format($row['conc_amount'], 2) }}</td>
                                <td>{{ number_format($row['advance_amount'], 2) }}</td>
                                <td>{{ number_format($row['net_amount'], 2) }}</td>
                                <td>{{ number_format($row['receipt_amount'], 2) }}</td>
                                <td>{{ number_format($row['cash_amount'], 2) }}</td>
                                <td>{{ number_format($row['online_amount'], 2) }}</td>
                                <td>{{ number_format($row['other_amount'], 2) }}</td>
                                <td>{{ number_format($row['due_amount'], 2) }}</td>
                            </tr>
                        @endif
                    @endforeach --}}

                    @php
                        $grand_total['gross_amount'] += collect($users_total)->sum('gross_amount');
                        $grand_total['conc_amount'] += collect($users_total)->sum('conc_amount');
                        $grand_total['advance_amount'] += collect($users_total)->sum('advance_amount');
                        $grand_total['net_amount'] += collect($users_total)->sum('net_amount');
                        $grand_total['receipt_amount'] += collect($users_total)->sum('receipt_amount');
                        $grand_total['cash_amount'] += collect($users_total)->sum('cash_amount');
                        $grand_total['online_amount'] += collect($users_total)->sum('online_amount');
                        $grand_total['other_amount'] += collect($users_total)->sum('other_amount');
                        $grand_total['due_amount'] += collect($users_total)->sum('due_amount');
                    @endphp

                    <tr style="font-weight: bold; color: darkred;">
                        <td colspan="5">{{ $user->name }}</td>
                    </tr>

                    <tr style="font-weight: bold;">
                        <td>{{ $user?->department?->name }}</td>
                        <td>{{ number_format(collect($users_total)->sum('gross_amount'), 2) }}</td>
                        <td>{{ number_format(collect($users_total)->sum('conc_amount'), 2) }}</td>
                        {{-- <td>{{ number_format(collect($users_total)->sum('advance_amount'), 2) }}</td> --}}
                        {{-- <td>{{ number_format(collect($users_total)->sum('net_amount'), 2) }}</td> --}}
                        <td>{{ number_format(collect($users_total)->sum('receipt_amount'), 2) }}</td>
                        {{-- <td>{{ number_format(collect($users_total)->sum('cash_amount'), 2) }}</td> --}}
                        {{-- <td>{{ number_format(collect($users_total)->sum('online_amount'), 2) }}</td> --}}
                        {{-- <td>{{ number_format(collect($users_total)->sum('other_amount'), 2) }}</td> --}}
                        <td>{{ number_format(collect($users_total)->sum('due_amount'), 2) }}</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="10" style="padding: 20px 0;"></td>
                </tr>
                <tr style="font-weight: bold; background: #d0f0d0;">
                    <td>Grand Total :</td>
                    <td>{{ number_format($grand_total['gross_amount'], 2) }}</td>
                    <td>{{ number_format($grand_total['conc_amount'], 2) }}</td>
                    {{-- <td>{{ number_format($grand_total['advance_amount'], 2) }}</td> --}}
                    {{-- <td>{{ number_format($grand_total['net_amount'], 2) }}</td> --}}
                    <td>{{ number_format($grand_total['receipt_amount'], 2) }}</td>
                    {{-- <td>{{ number_format($grand_total['cash_amount'], 2) }}</td> --}}
                    {{-- <td>{{ number_format($grand_total['online_amount'], 2) }}</td> --}}
                    {{-- <td>{{ number_format($grand_total['other_amount'], 2) }}</td> --}}
                    <td>{{ number_format($grand_total['due_amount'], 2) }}</td>
                </tr>
            </tfoot>
        </table>
    @elseif($search_type == 'detailed-print')
        @php
            $grand_total = [
                'gross_amount' => 0,
                'conc_amount' => 0,
                'advance_amount' => 0,
                'net_amount' => 0,
                'receipt_amount' => 0,
                'cash_amount' => 0,
                'online_amount' => 0,
                'other_amount' => 0,
                'due_amount' => 0,
            ];
        @endphp
        <table border="2" width="100%">
            <thead>
                <tr>
                    <th>UMR No</th>
                    <th>Patient Name</th>
                    <th>Bill Time</th>
                    <th>Bill No</th>
                    <th>Gross Amt</th>
                    <th>Conc. Amt</th>
                    {{-- <th>Advance Amt</th> --}}
                    {{-- <th>Net Amt</th> --}}
                    <th>Receipt Amt</th>
                    {{-- <th>Cash Amt</th> --}}
                    {{-- <th>Online Amt</th> --}}
                    {{-- <th>Other Amt</th> --}}
                    <th>Due Amt</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($receipt_wise_shift_collections as $user)
                    <tr style="font-weight: bold; color: darkred;">
                        <td>{{ $user->user_id }}</td>
                        <td colspan="12">{{ $user->name }}</td>
                    </tr>

                    @php
                        $users_total = [
                            'opd_medicine_receipts' => [
                                'label' => 'Dep. Pharmacy Bill (OPD)',
                                'gross_amount' => 0,
                                'conc_amount' => 0,
                                'advance_amount' => 0,
                                'net_amount' => 0,
                                'receipt_amount' => 0,
                                'cash_amount' => 0,
                                'online_amount' => 0,
                                'other_amount' => 0,
                                'due_amount' => 0,
                                'is_visible' => false,
                            ],
                            'opd_billings' => [
                                'label' => 'OPD Bills (OPD Service)',
                                'gross_amount' => 0,
                                'conc_amount' => 0,
                                'advance_amount' => 0,
                                'net_amount' => 0,
                                'receipt_amount' => 0,
                                'cash_amount' => 0,
                                'online_amount' => 0,
                                'other_amount' => 0,
                                'due_amount' => 0,
                                'is_visible' => false,
                            ],
                            'ip_pharmacy_indent_billings' => [
                                'label' => 'IP Bills (IPD Item)',
                                'gross_amount' => 0,
                                'conc_amount' => 0,
                                'advance_amount' => 0,
                                'net_amount' => 0,
                                'receipt_amount' => 0,
                                'cash_amount' => 0,
                                'online_amount' => 0,
                                'other_amount' => 0,
                                'due_amount' => 0,
                                'is_visible' => false,
                            ],
                            'ip_service_billings' => [
                                'label' => 'IP Advance',
                                'gross_amount' => 0,
                                'conc_amount' => 0,
                                'advance_amount' => 0,
                                'net_amount' => 0,
                                'receipt_amount' => 0,
                                'cash_amount' => 0,
                                'online_amount' => 0,
                                'other_amount' => 0,
                                'due_amount' => 0,
                                'is_visible' => false,
                            ],
                            'op_consultation' => [
                                'label' => 'OP Consultation',
                                'gross_amount' => 0,
                                'conc_amount' => 0,
                                'advance_amount' => 0,
                                'net_amount' => 0,
                                'receipt_amount' => 0,
                                'cash_amount' => 0,
                                'online_amount' => 0,
                                'other_amount' => 0,
                                'due_amount' => 0,
                                'is_visible' => false,
                            ],
                            'registration' => [
                                'label' => 'Registration',
                                'gross_amount' => 0,
                                'conc_amount' => 0,
                                'advance_amount' => 0,
                                'net_amount' => 0,
                                'receipt_amount' => 0,
                                'cash_amount' => 0,
                                'online_amount' => 0,
                                'other_amount' => 0,
                                'due_amount' => 0,
                                'is_visible' => false,
                            ],
                        ];
                    @endphp

                    {{-- Dep. Pharmacy Bill (OPD Item) --}}
                    @if ($user->opd_medicine_receipts->count() > 0)
                        <tr style="font-weight: bold;">
                            <td colspan="13">{{ $users_total['opd_medicine_receipts']['label'] }}</td>
                        </tr>

                        @foreach ($user->opd_medicine_receipts as $opd_medicine_receipt)
                            @php
                                $gross_amount = $opd_medicine_receipt->gross_amount ?? 0;
                                $discount_amount = $opd_medicine_receipt->discount_amount ?? 0;
                                $advance_amount = $opd_medicine_receipt->advance_amount ?? 0;
                                $paid_amount = $opd_medicine_receipt->paid_amount ?? 0;
                                // $total_amount = $opd_medicine_receipt->total_amount ?? 0;
                                $other_amount = $opd_medicine_receipt->other_amount ?? 0;
                                $due_amount = 0;

                                if (
                                    $opd_medicine_receipt->pharmacydue &&
                                    $opd_medicine_receipt->pharmacydue->is_due_cleared == 0
                                ) {
                                    $due_amount = $opd_medicine_receipt->due_amount ?? 0;
                                }

                                $users_total['opd_medicine_receipts']['gross_amount'] += $gross_amount;
                                $users_total['opd_medicine_receipts']['conc_amount'] += $discount_amount;
                                $users_total['opd_medicine_receipts']['advance_amount'] += $advance_amount;
                                $users_total['opd_medicine_receipts']['net_amount'] += $paid_amount;
                                $users_total['opd_medicine_receipts']['receipt_amount'] += $paid_amount;
                                $users_total['opd_medicine_receipts']['cash_amount'] += $paid_amount;
                                $users_total['opd_medicine_receipts']['online_amount'] += 0;
                                $users_total['opd_medicine_receipts']['other_amount'] += $other_amount;
                                $users_total['opd_medicine_receipts']['due_amount'] += $due_amount;
                            @endphp

                            <tr>
                                <td>{{ $opd_medicine_receipt?->patient?->registration_no }}</td>
                                <td>{{ $opd_medicine_receipt?->patient?->name }}</td>
                                <td>{{ date('h:i a', strtotime($opd_medicine_receipt->created_at)) }}</td>
                                <td>{{ $opd_medicine_receipt?->code }}</td>
                                <td>{{ number_format($gross_amount, 2) }}</td>
                                <td>{{ number_format($discount_amount, 2) }}</td>
                                {{-- <td>{{ number_format($advance_amount, 2) }}</td> --}}
                                {{-- <td>{{ number_format($paid_amount, 2) }}</td> --}}
                                <td>{{ number_format($paid_amount, 2) }}</td>
                                {{-- <td>{{ number_format($paid_amount, 2) }}</td> --}}
                                {{-- <td>{{ number_format(0, 2) }}</td> --}}
                                {{-- <td>{{ number_format($other_amount, 2) }}</td> --}}
                                <td>{{ number_format($opd_medicine_receipt->due_amount, 2) }}</td>
                            </tr>
                        @endforeach

                        <tr style="font-weight: bold;">
                            <td colspan="4">Total :</td>

                            <td>{{ number_format($users_total['opd_medicine_receipts']['gross_amount'], 2) }}</td>
                            <td>{{ number_format($users_total['opd_medicine_receipts']['conc_amount'], 2) }}</td>
                            {{-- <td>{{ number_format($users_total['opd_medicine_receipts']['advance_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['opd_medicine_receipts']['net_amount'], 2) }}</td> --}}
                            <td>{{ number_format($users_total['opd_medicine_receipts']['receipt_amount'], 2) }}</td>
                            {{-- <td>{{ number_format($users_total['opd_medicine_receipts']['cash_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['opd_medicine_receipts']['online_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['opd_medicine_receipts']['other_amount'], 2) }}</td> --}}
                            <td>{{ number_format($users_total['opd_medicine_receipts']['due_amount'], 2) }}</td>
                        </tr>
                    @endif

                    {{-- OP Bills (OPD Service) --}}
                    @if ($user->opd_billings->count() > 0)
                        <tr style="font-weight: bold;">
                            <td colspan="13">{{ $users_total['opd_billings']['label'] }}</td>
                        </tr>

                        @foreach ($user->opd_billings as $opd_billing)
                            @php
                                $gross_amount = $opd_billing->gross_amount ?? 0;
                                $discount_amount = $opd_billing->discount_amount ?? 0;
                                $advance_amount = $opd_billing->advance_amount ?? 0;
                                $paid_amount = $opd_billing->paid_amount ?? 0;
                                // $total_amount = $opd_billing->total_amount ?? 0;
                                $other_amount = $opd_billing->other_amount ?? 0;
                                $due_amount = 0;

                                if ($opd_billing->serviceDue && $opd_billing->serviceDue->is_due_cleared == 0) {
                                    $due_amount = $opd_billing->due_amount ?? 0;
                                }

                                $users_total['opd_billings']['gross_amount'] += $gross_amount;
                                $users_total['opd_billings']['conc_amount'] += $discount_amount;
                                $users_total['opd_billings']['advance_amount'] += $advance_amount;
                                $users_total['opd_billings']['net_amount'] += $paid_amount;
                                $users_total['opd_billings']['receipt_amount'] += $paid_amount;
                                $users_total['opd_billings']['cash_amount'] += $paid_amount;
                                $users_total['opd_billings']['online_amount'] += 0;
                                $users_total['opd_billings']['other_amount'] += $other_amount;
                                $users_total['opd_billings']['due_amount'] += $due_amount;
                            @endphp

                            <tr>
                                <td>{{ $opd_billing?->patient?->registration_no }}</td>
                                <td>{{ $opd_billing?->patient?->name }}</td>
                                <td>{{ date('h:i a', strtotime($opd_billing->created_at)) }}</td>
                                <td>{{ $opd_billing?->code }}</td>
                                <td>{{ number_format($gross_amount, 2) }}</td>
                                <td>{{ number_format($discount_amount, 2) }}</td>
                                {{-- <td>{{ number_format($advance_amount, 2) }}</td> --}}
                                {{-- <td>{{ number_format($paid_amount, 2) }}</td> --}}
                                <td>{{ number_format($paid_amount, 2) }}</td>
                                {{-- <td>{{ number_format($paid_amount, 2) }}</td> --}}
                                {{-- <td>{{ number_format(0, 2) }}</td> --}}
                                {{-- <td>{{ number_format($other_amount, 2) }}</td> --}}
                                <td>{{ number_format($opd_billing->due_amount, 2) }}</td>
                            </tr>
                        @endforeach

                        <tr style="font-weight: bold;">
                            <td colspan="4">Total :</td>

                            <td>{{ number_format($users_total['opd_billings']['gross_amount'], 2) }}</td>
                            <td>{{ number_format($users_total['opd_billings']['conc_amount'], 2) }}</td>
                            {{-- <td>{{ number_format($users_total['opd_billings']['advance_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['opd_billings']['net_amount'], 2) }}</td> --}}
                            <td>{{ number_format($users_total['opd_billings']['receipt_amount'], 2) }}</td>
                            {{-- <td>{{ number_format($users_total['opd_billings']['cash_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['opd_billings']['online_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['opd_billings']['other_amount'], 2) }}</td> --}}
                            <td>{{ number_format($users_total['opd_billings']['due_amount'], 2) }}</td>
                        </tr>
                    @endif

                    {{-- IP Bills (IPD Item) --}}
                    @if ($user->ip_pharmacy_indent_billings->count() > 0)
                        <tr style="font-weight: bold;">
                            <td colspan="13">{{ $users_total['ip_pharmacy_indent_billings']['label'] }}</td>
                        </tr>

                        @foreach ($user->ip_pharmacy_indent_billings as $ip_pharmacy_indent_billing)
                            @php
                                $gross_amount = $ip_pharmacy_indent_billing->gross_amount ?? 0;
                                $discount_amount = $ip_pharmacy_indent_billing->discount_amount ?? 0;
                                $advance_amount = $ip_pharmacy_indent_billing->advance_amount ?? 0;
                                $paid_amount = $ip_pharmacy_indent_billing->paid_amount ?? 0;
                                // $total_amount = $ip_pharmacy_indent_billing->total_amount ?? 0;
                                $other_amount = $ip_pharmacy_indent_billing->other_amount ?? 0;
                                $due_amount = 0;

                                if (
                                    $ip_pharmacy_indent_billing->IpPharmacyDue &&
                                    $ip_pharmacy_indent_billing->IpPharmacyDue->is_due_cleared == 0
                                ) {
                                    $due_amount = $ip_pharmacy_indent_billing->due_amount ?? 0;
                                }

                                $users_total['ip_pharmacy_indent_billings']['gross_amount'] += $gross_amount;
                                $users_total['ip_pharmacy_indent_billings']['conc_amount'] += $discount_amount;
                                $users_total['ip_pharmacy_indent_billings']['advance_amount'] += $advance_amount;
                                $users_total['ip_pharmacy_indent_billings']['net_amount'] += $paid_amount;
                                $users_total['ip_pharmacy_indent_billings']['receipt_amount'] += $paid_amount;

                                if ($ip_pharmacy_indent_billing->payment_by == 'cash') {
                                    $users_total['ip_pharmacy_indent_billings']['cash_amount'] += $paid_amount;
                                } else {
                                    $users_total['ip_pharmacy_indent_billings']['online_amount'] += $paid_amount;
                                }

                                $users_total['ip_pharmacy_indent_billings']['other_amount'] += $other_amount;
                                $users_total['ip_pharmacy_indent_billings']['due_amount'] += $due_amount;
                                $users_total['ip_pharmacy_indent_billings']['is_visible'] = true;
                            @endphp

                            <tr>
                                <td>{{ $ip_pharmacy_indent_billing?->patient?->registration_no }}</td>
                                <td>{{ $ip_pharmacy_indent_billing?->patient?->name }}</td>
                                <td>{{ date('h:i a', strtotime($ip_pharmacy_indent_billing->created_at)) }}</td>
                                <td>{{ $ip_pharmacy_indent_billing?->code }}</td>
                                <td>{{ number_format($gross_amount, 2) }}</td>
                                <td>{{ number_format($discount_amount, 2) }}</td>
                                {{-- <td>{{ number_format($advance_amount, 2) }}</td> --}}
                                {{-- <td>{{ number_format($paid_amount, 2) }}</td> --}}
                                <td>{{ number_format($paid_amount, 2) }}</td>
                                {{-- <td>{{ number_format($paid_amount, 2) }}</td> --}}
                                {{-- <td>{{ number_format(0, 2) }}</td> --}}
                                {{-- <td>{{ number_format($other_amount, 2) }}</td> --}}
                                <td>{{ number_format($ip_pharmacy_indent_billing->due_amount, 2) }}</td>
                            </tr>
                        @endforeach

                        <tr style="font-weight: bold;">
                            <td colspan="4">Total :</td>

                            <td>{{ number_format($users_total['ip_pharmacy_indent_billings']['gross_amount'], 2) }}</td>
                            <td>{{ number_format($users_total['ip_pharmacy_indent_billings']['conc_amount'], 2) }}</td>
                            {{-- <td>{{ number_format($users_total['ip_pharmacy_indent_billings']['advance_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['ip_pharmacy_indent_billings']['net_amount'], 2) }}</td> --}}
                            <td>{{ number_format($users_total['ip_pharmacy_indent_billings']['receipt_amount'], 2) }}</td>
                            {{-- <td>{{ number_format($users_total['ip_pharmacy_indent_billings']['cash_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['ip_pharmacy_indent_billings']['online_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['ip_pharmacy_indent_billings']['other_amount'], 2) }}</td> --}}
                            <td>{{ number_format($users_total['ip_pharmacy_indent_billings']['due_amount'], 2) }}</td>
                        </tr>
                    @endif

                    {{-- IP Advance (IPD Service) --}}
                    @if ($user->ip_service_billings->count() > 0)
                        <tr style="font-weight: bold;">
                            <td colspan="13">{{ $users_total['ip_service_billings']['label'] }}</td>
                        </tr>

                        @foreach ($user->ip_service_billings as $ip_service_billing)
                            @php
                                $gross_amount = $ip_service_billing->gross_amount ?? 0;
                                $discount_amount = $ip_service_billing->discount_amount ?? 0;
                                $advance_amount = $ip_service_billing->advance_amount ?? 0;
                                $paid_amount = $ip_service_billing->paid_amount ?? 0;
                                // $total_amount = $ip_service_billing->total_amount ?? 0;
                                $other_amount = $ip_service_billing->other_amount ?? 0;
                                $due_amount = 0;

                                if (
                                    $ip_service_billing->ipServiceDue &&
                                    $ip_service_billing->ipServiceDue->is_due_cleared == 0
                                ) {
                                    $due_amount = $ip_service_billing->due_amount ?? 0;
                                }

                                $users_total['ip_service_billings']['gross_amount'] += $gross_amount;
                                $users_total['ip_service_billings']['conc_amount'] += $discount_amount;
                                $users_total['ip_service_billings']['advance_amount'] += $advance_amount;
                                $users_total['ip_service_billings']['net_amount'] += $paid_amount;
                                $users_total['ip_service_billings']['receipt_amount'] += $paid_amount;

                                if ($ip_pharmacy_indent_billing->payment_by == 'cash') {
                                    $users_total['ip_service_billings']['cash_amount'] += $paid_amount;
                                } else {
                                    $users_total['ip_service_billings']['online_amount'] += $paid_amount;
                                }

                                $users_total['ip_service_billings']['other_amount'] += $other_amount;
                                $users_total['ip_service_billings']['due_amount'] += $due_amount;
                                $users_total['ip_service_billings']['is_visible'] = true;
                            @endphp

                            <tr>
                                <td>{{ $ip_service_billing?->patient?->registration_no }}</td>
                                <td>{{ $ip_service_billing?->patient?->name }}</td>
                                <td>{{ date('h:i a', strtotime($ip_service_billing->created_at)) }}</td>
                                <td>{{ $ip_service_billing?->code }}</td>
                                <td>{{ number_format($gross_amount, 2) }}</td>
                                <td>{{ number_format($discount_amount, 2) }}</td>
                                {{-- <td>{{ number_format($advance_amount, 2) }}</td> --}}
                                {{-- <td>{{ number_format($paid_amount, 2) }}</td> --}}
                                <td>{{ number_format($paid_amount, 2) }}</td>
                                {{-- <td>{{ number_format($paid_amount, 2) }}</td> --}}
                                {{-- <td>{{ number_format(0, 2) }}</td> --}}
                                {{-- <td>{{ number_format($other_amount, 2) }}</td> --}}
                                <td>{{ number_format($ip_service_billing->due_amount, 2) }}</td>
                            </tr>
                        @endforeach

                        <tr style="font-weight: bold;">
                            <td colspan="4">Total :</td>

                            <td>{{ number_format($users_total['ip_service_billings']['gross_amount'], 2) }}</td>
                            <td>{{ number_format($users_total['ip_service_billings']['conc_amount'], 2) }}</td>
                            {{-- <td>{{ number_format($users_total['ip_service_billings']['advance_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['ip_service_billings']['net_amount'], 2) }}</td> --}}
                            <td>{{ number_format($users_total['ip_service_billings']['receipt_amount'], 2) }}</td>
                            {{-- <td>{{ number_format($users_total['ip_service_billings']['cash_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['ip_service_billings']['online_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['ip_service_billings']['other_amount'], 2) }}</td> --}}
                            <td>{{ number_format($users_total['ip_service_billings']['due_amount'], 2) }}</td>
                        </tr>
                    @endif

                    {{-- Registration --}}
                    @if ($user->registrations->count() > 0)
                        <tr style="font-weight: bold;">
                            <td colspan="13">{{ $users_total['registration']['label'] }}</td>
                        </tr>

                        @foreach ($user->registrations as $patient)
                            @if ($patient->patientvisits->count() == 0)
                                @php
                                    $gross_amount = 0;
                                    $discount_amount = 0;
                                    $advance_amount = 0;
                                    $net_amount = 0;
                                    $receipt_amount = 0;
                                    $cash_amount = 0;
                                    $online_amount = 0;
                                    $other_amount = 0;
                                    $due_amount = 0;

                                    $users_total['registration']['gross_amount'] += $gross_amount;
                                    $users_total['registration']['conc_amount'] += $discount_amount;
                                    $users_total['registration']['advance_amount'] += $advance_amount;
                                    $users_total['registration']['net_amount'] += $net_amount;
                                    $users_total['registration']['receipt_amount'] += $receipt_amount;
                                    $users_total['registration']['cash_amount'] += $cash_amount;
                                    $users_total['registration']['online_amount'] += $online_amount;
                                    $users_total['registration']['other_amount'] += $other_amount;
                                    $users_total['registration']['due_amount'] += $due_amount;
                                @endphp

                                <tr>
                                    <td>{{ $patient?->registration_no }}</td>
                                    <td>{{ $patient?->name }}</td>
                                    <td>{{ date('h:i a', strtotime($patient->created_at)) }}</td>
                                    <td></td>
                                    <td>{{ number_format($gross_amount, 2) }}</td>
                                    <td>{{ number_format($discount_amount, 2) }}</td>
                                    {{-- <td>{{ number_format($advance_amount, 2) }}</td> --}}
                                    {{-- <td>{{ number_format($net_amount, 2) }}</td> --}}
                                    <td>{{ number_format($receipt_amount, 2) }}</td>
                                    {{-- <td>{{ number_format($cash_amount, 2) }}</td> --}}
                                    {{-- <td>{{ number_format($online_amount, 2) }}</td> --}}
                                    {{-- <td>{{ number_format($other_amount, 2) }}</td> --}}
                                    <td>{{ number_format($due_amount, 2) }}</td>
                                </tr>
                            @endif
                        @endforeach

                        <tr style="font-weight: bold;">
                            <td colspan="4">Total :</td>

                            <td>{{ number_format($users_total['registration']['gross_amount'], 2) }}</td>
                            <td>{{ number_format($users_total['registration']['conc_amount'], 2) }}</td>
                            {{-- <td>{{ number_format($users_total['registration']['advance_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['registration']['net_amount'], 2) }}</td> --}}
                            <td>{{ number_format($users_total['registration']['receipt_amount'], 2) }}</td>
                            {{-- <td>{{ number_format($users_total['registration']['cash_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['registration']['online_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['registration']['other_amount'], 2) }}</td> --}}
                            <td>{{ number_format($users_total['registration']['due_amount'], 2) }}</td>
                        </tr>
                    @endif

                    {{-- OP Consultation --}}
                    @if ($user->patient_visits->count() > 0)
                        <tr style="font-weight: bold;">
                            <td colspan="13">{{ $users_total['op_consultation']['label'] }}</td>
                        </tr>

                        @foreach ($user->patient_visits as $patient_visit)
                            @php
                                $gross_amount = $patient_visit->fee ?? 0;
                                $discount_amount = $patient_visit->discount ?? 0;
                                $advance_amount = 0;
                                $net_amount = $patient_visit->fee ?? 0;
                                $receipt_amount = $patient_visit->fee ?? 0;
                                $cash_amount = $patient_visit->fee ?? 0;
                                $online_amount = 0;
                                $other_amount = 0;
                                $due_amount = 0;

                                $users_total['op_consultation']['gross_amount'] += $gross_amount;
                                $users_total['op_consultation']['conc_amount'] += $discount_amount;
                                $users_total['op_consultation']['advance_amount'] += $advance_amount;
                                $users_total['op_consultation']['net_amount'] += $net_amount;
                                $users_total['op_consultation']['receipt_amount'] += $receipt_amount;
                                $users_total['op_consultation']['cash_amount'] += $cash_amount;
                                $users_total['op_consultation']['online_amount'] += $online_amount;
                                $users_total['op_consultation']['other_amount'] += $other_amount;
                                $users_total['op_consultation']['due_amount'] += $due_amount;
                            @endphp

                            <tr>
                                <td>{{ $patient_visit?->patient?->registration_no }}</td>
                                <td>{{ $patient_visit?->patient?->name }}</td>
                                <td>{{ date('h:i a', strtotime($patient_visit?->created_at)) }}</td>
                                <td>{{ $patient_visit->visit_no }}</td>
                                <td>{{ number_format($gross_amount, 2) }}</td>
                                <td>{{ number_format($discount_amount, 2) }}</td>
                                {{-- <td>{{ number_format($advance_amount, 2) }}</td> --}}
                                {{-- <td>{{ number_format($net_amount, 2) }}</td> --}}
                                <td>{{ number_format($receipt_amount, 2) }}</td>
                                {{-- <td>{{ number_format($cash_amount, 2) }}</td> --}}
                                {{-- <td>{{ number_format($online_amount, 2) }}</td> --}}
                                {{-- <td>{{ number_format($other_amount, 2) }}</td> --}}
                                <td>{{ number_format($due_amount, 2) }}</td>
                            </tr>
                        @endforeach

                        <tr style="font-weight: bold;">
                            <td colspan="4">Total :</td>

                            <td>{{ number_format($users_total['op_consultation']['gross_amount'], 2) }}</td>
                            <td>{{ number_format($users_total['op_consultation']['conc_amount'], 2) }}</td>
                            {{-- <td>{{ number_format($users_total['op_consultation']['advance_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['op_consultation']['net_amount'], 2) }}</td> --}}
                            <td>{{ number_format($users_total['op_consultation']['receipt_amount'], 2) }}</td>
                            {{-- <td>{{ number_format($users_total['op_consultation']['cash_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['op_consultation']['online_amount'], 2) }}</td> --}}
                            {{-- <td>{{ number_format($users_total['op_consultation']['other_amount'], 2) }}</td> --}}
                            <td>{{ number_format($users_total['op_consultation']['due_amount'], 2) }}</td>
                        </tr>
                    @endif

                    @php
                        $grand_total['gross_amount'] += collect($users_total)->sum('gross_amount');
                        $grand_total['conc_amount'] += collect($users_total)->sum('conc_amount');
                        $grand_total['advance_amount'] += collect($users_total)->sum('advance_amount');
                        $grand_total['net_amount'] += collect($users_total)->sum('net_amount');
                        $grand_total['receipt_amount'] += collect($users_total)->sum('receipt_amount');
                        $grand_total['cash_amount'] += collect($users_total)->sum('cash_amount');
                        $grand_total['online_amount'] += collect($users_total)->sum('online_amount');
                        $grand_total['other_amount'] += collect($users_total)->sum('other_amount');
                        $grand_total['due_amount'] += collect($users_total)->sum('due_amount');
                    @endphp

                    <tr style="font-weight: bold; background: #9fa3e7;">
                        <td colspan="4">{{ $user->name }} Total :</td>
                        <td>{{ number_format(collect($users_total)->sum('gross_amount'), 2) }}</td>
                        <td>{{ number_format(collect($users_total)->sum('conc_amount'), 2) }}</td>
                        {{-- <td>{{ number_format(collect($users_total)->sum('advance_amount'), 2) }}</td> --}}
                        {{-- <td>{{ number_format(collect($users_total)->sum('net_amount'), 2) }}</td> --}}
                        <td>{{ number_format(collect($users_total)->sum('receipt_amount'), 2) }}</td>
                        {{-- <td>{{ number_format(collect($users_total)->sum('cash_amount'), 2) }}</td> --}}
                        {{-- <td>{{ number_format(collect($users_total)->sum('online_amount'), 2) }}</td> --}}
                        {{-- <td>{{ number_format(collect($users_total)->sum('other_amount'), 2) }}</td> --}}
                        <td>{{ number_format(collect($users_total)->sum('due_amount'), 2) }}</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="13" style="padding: 20px 0;"></td>
                </tr>
                <tr style="font-weight: bold; background: #d0f0d0;">
                    <td colspan="4">Grand Total :</td>
                    <td>{{ number_format($grand_total['gross_amount'], 2) }}</td>
                    <td>{{ number_format($grand_total['conc_amount'], 2) }}</td>
                    {{-- <td>{{ number_format($grand_total['advance_amount'], 2) }}</td> --}}
                    {{-- <td>{{ number_format($grand_total['net_amount'], 2) }}</td> --}}
                    <td>{{ number_format($grand_total['receipt_amount'], 2) }}</td>
                    {{-- <td>{{ number_format($grand_total['cash_amount'], 2) }}</td> --}}
                    {{-- <td>{{ number_format($grand_total['online_amount'], 2) }}</td> --}}
                    {{-- <td>{{ number_format($grand_total['other_amount'], 2) }}</td> --}}
                    <td>{{ number_format($grand_total['due_amount'], 2) }}</td>
                </tr>
            </tfoot>
        </table>
    @endif
@endsection
