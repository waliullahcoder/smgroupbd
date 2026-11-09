@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr>
                <th colspan="7" class="text-right px-3">Previous Balance</th>
                <th class="text-right px-3">{{ $data['previousBalance'] }}</th>
            </tr>
            <tr>
                <th class="text-center" width="40px">Sl#</th>
                <th>Date</th>
                <th>Voucher</th>
                <th>Particulars</th>
                <th class="text-right">Sales</th>
                <th class="text-right">Collection</th>
                <th class="text-right">Return</th>
                <th class="text-right">Balance</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalSales = 0;
                $totalCollections = 0;
                $totalReturns = 0;
                $balance = $data['previousBalance'];
            @endphp
            @foreach ($data['statements'] as $statement)
                <tr>
                    <td class="text-center px-3">{{ $loop->iteration }}</td>
                    <td>{{ $statement['date'] }}</td>
                    <td>{{ $statement['invoice'] }}</td>
                    <td>{{ $statement['particulars'] }}</td>
                    <td class="text-right px-3">{{ $statement['sales'] }}</td>
                    <td class="text-right px-3">{{ $statement['collection'] }}</td>
                    <td class="text-right px-3">{{ $statement['return'] }}</td>
                    <td class="text-right px-3">{{ $statement['balance'] }}</td>
                </tr>
                @php
                    $totalSales += $statement['sales'];
                    $totalCollections += $statement['collection'];
                    $totalReturns += $statement['return'];
                    $balance = $statement['balance'];
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right px-3">Total Summary</th>
                <th class="text-right px-3">{{ $totalSales }}</th>
                <th class="text-right px-3">{{ $totalCollections }}</th>
                <th class="text-right px-3">{{ $totalReturns }}</th>
                <th class="text-right px-3">{{ $balance }}</th>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
