@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr>
                <th class="text-center" width="40px">SL#</th>
                <th>Product Name</th>
                <th class="text-center">Demand Qty</th>
                <th class="text-center">Stock Qty</th>
                <th class="text-center">Balance Qty</th>
            </tr>
        </thead>
        <tbody>
            @if (count($data) > 0)
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $row['product']->name }}</td>
                        <td class="text-center">{{ number_format($row['demand_qty'], 2) }}</td>
                        <td class="text-center">{{ number_format($row['stock_qty'], 2) }}</td>
                        <td class="text-center">{{ $row['stock_qty'] > $row['demand_qty'] ? number_format($row['stock_qty'] - $row['demand_qty']) : '('.number_format($row['demand_qty'] - $row['stock_qty']).')' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
