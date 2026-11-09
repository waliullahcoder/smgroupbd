@extends('layouts.admin.print_app')
@push('css')
    <style>
        .sum_data {
            font-weight: bold;
            font-size: 12px;
            border-bottom: 2px solid #333;
            color: #333;
            width: 100%;
        }

        .mb-2 {
            margin-bottom: 10px !important;
        }

        .align-bottom {
            vertical-align: bottom !important;
        }
    </style>
@endpush
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr class="text-nowrap">
                <th class="text-center" width="30">SL</th>
                <th class="text-left">Invoice No</th>
                <th class="text-left">Customer Name</th>
                <th class="text-right" width="11%">Total Amount</th>
                <th class="text-right" width="11%">Discount</th>
                <th class="text-right" width="11%">Net Payable</th>
                <th class="text-right" width="11%">Total Cost</th>
                <th class="text-right" width="11%">Gross Profit</th>
                <th class="text-right" width="11%">Profit %</th>
            </tr>
        </thead>

        <tbody>
            @php
                $total_sales = 0;
                $total_discount = 0;
                $total_payable = 0;
                $total_cost = 0;
                $total_profit = 0;
            @endphp
            @foreach ($data as $row)
                <tr>
                    <td class="text-center align-bottom">{{ $loop->iteration }}</td>
                    <td class="align-bottom text-left">{!! $row['issue_no'] !!}</td>
                    <td class="align-bottom text-left">{{ $row['customer_name'] }}</td>
                    <td class="align-bottom text-right">
                        {!! is_null($row['issue_no'])
                            ? '<div class="sum_data">' . $row['total_amount'] . '</div>'
                            : $row['total_amount'] !!}
                    </td>
                    <td class="align-bottom text-right">
                        {!! is_null($row['issue_no']) ? '<div class="sum_data">' . $row['discount'] . '</div>' : $row['discount'] !!}
                    </td>
                    <td class="align-bottom text-right">
                        {!! is_null($row['issue_no']) ? '<div class="sum_data">' . $row['net_payable'] . '</div>' : $row['net_payable'] !!}
                    </td>
                    <td class="align-bottom text-right">
                        {!! is_null($row['issue_no']) ? '<div class="sum_data">' . $row['total_cost'] . '</div>' : $row['total_cost'] !!}
                    </td>
                    <td class="align-bottom text-right">
                        {!! is_null($row['issue_no'])
                            ? '<div class="sum_data">' . $row['gross_profit'] . '</div>'
                            : $row['gross_profit'] !!}
                    </td>
                    <td class="align-bottom text-right">
                        {!! is_null($row['issue_no']) ? '<div class="sum_data">' . $row['profit'] . '</div>' : $row['profit'] !!}
                    </td>
                </tr>
                @php
                    if (is_null($row['issue_no'])) {
                        $total_sales += $row['total_amount'];
                        $total_discount += $row['discount'];
                        $total_payable += $row['net_payable'];
                        $total_cost += $row['total_cost'];
                        $total_profit += $row['gross_profit'];
                    }
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            @php
                if (count($data) > 0) {
                    $percentage = number_format(($total_profit / $total_payable) * 100, 2, '.', '');
                } else {
                    $percentage = 0;
                }
            @endphp
            <tr>
                <th class="text-right" colspan="3">Grand Total</th>
                <th class="text-right">{{ $total_sales }}</th>
                <th class="text-right">{{ $total_discount }}</th>
                <th class="text-right">{{ $total_payable }}</th>
                <th class="text-right">{{ $total_cost }}</th>
                <th class="text-right">{{ $total_profit }}</th>
                <th class="text-right">{{ $percentage }}</th>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
