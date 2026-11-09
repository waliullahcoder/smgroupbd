@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr>
                <th colspan="5" style="text-align: right; font-weight: bold;">Previous Balance</th>
                <th style="text-align: right;">{{ number_format($data['previousBalance'], 2, '.', ',') }}</th>
            </tr>
            <tr>
                <th class="text-center">SL#</th>
                <th class="text-left">Date</th>
                <th class="text-right">Purchase</th>
                <th class="text-right">Payment</th>
                <th class="text-right">Returns</th>
                <th class="text-right">Balance</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalLifting = 0;
                $totalPayment = 0;
                $totalReturn = 0;
            @endphp
            @foreach ($data['statements'] as $statement)
                <tr>
                    <td class="text-center px-3">{{ $loop->iteration }}</td>
                    <td class="text-left px-3">{{ $statement['date'] }}</td>
                    <td class="text-right px-3">{{ number_format($statement['lifting'], 2, '.', ',') }}</td>
                    <td class="text-right px-3">{{ number_format($statement['payment'], 2, '.', ',') }}</td>
                    <td class="text-right px-3">{{ number_format($statement['return'], 2, '.', ',') }}</td>
                    <td class="text-right px-3">{{ number_format($statement['balance'], 2, '.', ',') }}</td>
                </tr>
                @php
                    $totalLifting += $statement['lifting'];
                    $totalPayment += $statement['payment'];
                    $totalReturn += $statement['return'];
                @endphp
            @endforeach
        </tbody>
    </table>
    <br>

    <table class="table table-bordered table-condensed table-striped align-middle">
        <tfoot>
            <tr>
                <th style="text-align: right;"><b>Total Purchase : </b></th>
                <td width="120" style="text-align: right;">{{ number_format(round($totalLifting, 2), 2, '.', ',') }}</td>
            </tr>

            <tr>
                <th style="text-align: right;"><b>Total Payment : </b></th>
                <td width="120" style="text-align: right;">{{ number_format(round($totalPayment, 2), 2, '.', ',') }}</td>
            </tr>

            <tr>
                <th style="text-align: right;"><b>Total Return : </b></th>
                <td width="120" style="text-align: right;">{{ number_format(round($totalReturn, 2), 2, '.', ',') }}</td>
            </tr>

            <tr>
                <th style="text-align: right;"><b>Total Balance : </b></th>
                <td width="120" style="text-align: right;">
                    {{ number_format(round($totalLifting - ($totalPayment - $totalReturn), 2), 2, '.', ',') }}</td>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
