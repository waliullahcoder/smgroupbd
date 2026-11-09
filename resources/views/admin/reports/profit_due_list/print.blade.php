@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr>
                <th class="text-center" width="40px">Sl#</th>
                <th>Investor Name</th>
                <th>Invest Date</th>
                <th class="text-right">Total Invest</th>
                <th class="text-right">Total Profit</th>
                <th class="text-right">Total Withdraw</th>
                <th class="text-right">Due</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_invest = 0;
                $total_profit = 0;
                $total_widthdraw = 0;
                $total_due = 0;
            @endphp
            @foreach ($data as $row)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $row['investor_name'] }}</td>
                    <td>{{ $row['dates'] }}</td>
                    <td class="text-right">{{ number_format($row['total_invest'], 2) }}</td>
                    <td class="text-right">{{ number_format($row['total_profit'], 2) }}</td>
                    <td class="text-right">
                        {{ number_format($row['withdraw_invest'] + $row['withdraw_profit'], 2) }}</td>
                    <td class="text-right">{{ number_format($row['due'], 2) }}</td>
                </tr>
                @php
                    $total_invest += $row['total_invest'];
                    $total_profit += $row['total_profit'];
                    $total_widthdraw += $row['withdraw_invest'] + $row['withdraw_profit'];
                    $total_due += $row['due'];
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Total</th>
                <th class="text-right">{{ number_format($total_invest, 2) }}</th>
                <th class="text-right">{{ number_format($total_profit, 2) }}</th>
                <th class="text-right">{{ number_format($total_widthdraw, 2) }}</th>
                <th class="text-right">{{ number_format($total_due, 2) }}</th>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
