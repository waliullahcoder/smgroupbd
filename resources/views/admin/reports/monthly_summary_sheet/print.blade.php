@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead class="text-nowrap">
            <tr>
                <th class="text-center" width="20">SL#</th>
                <th>Month</th>
                <th class="text-right">Total Sales</th>
                <th class="text-right">Total Purchases</th>
                @foreach ($expense_heads as $key => $item)
                    <th class="text-right">{{ $item->head_name }}</th>
                    @php
                        ${'total_' . $key} = 0;
                    @endphp
                @endforeach
                <th class="text-right">Net Profit</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_sales = 0;
                $total_purchase = 0;
                $total_profit = 0;
            @endphp
            @foreach ($data as $row)
                @php
                    $total_sales += $row['sales'];
                    $total_purchase += $row['purchases'];
                    $total_profit += $row['net_profit'];
                @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-nowrap">{{ $row['date'] }}</td>
                    <td class="text-right">{{ number_format($row['sales']) }}</td>
                    <td class="text-right">{{ number_format($row['purchases']) }}</td>
                    @foreach ($expense_heads as $key => $item)
                        <td class="text-right">{{ number_format($row[$item->head_name]) }}</td>
                        @php
                            ${'total_' . $key} += $row[$item->head_name];
                        @endphp
                    @endforeach
                    <td class="text-right">
                        {{ $row['net_profit'] >= 0 ? number_format($row['net_profit']) : '(' . number_format(abs($row['net_profit'])) . ')' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right" colspan="2">Total Summary</th>
                <th class="text-right">{{ number_format($total_sales) }}</th>
                <th class="text-right">{{ number_format($total_purchase) }}</th>
                @foreach ($expense_heads as $key => $item)
                    <th class="text-right">{{ number_format(${'total_' . $key}) }}</th>
                @endforeach
                <th class="text-right">
                    {{ $total_profit >= 0 ? number_format($total_profit) : '(' . number_format(abs($total_profit)) . ')' }}
                </th>
            </tr>
        </tfoot>
    </table>

    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
