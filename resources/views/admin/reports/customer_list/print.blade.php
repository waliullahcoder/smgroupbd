@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr class="text-nowrap">
                <th class="text-center" width="30">SL#</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Area</th>
                <th>Address</th>
                <th class="text-center">Order Qty</th>
                <th class="text-center">Order Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $row->user_name }}</td>
                    <td>{{ $row->user_phone }}</td>
                    <td>{{ @$row->area->name }}</td>
                    <td>{{ $row->shipping_address }}</td>
                    <td class="text-right">{{ number_format($row->total_count) }}</td>
                    <td class="text-right">{{ number_format($row->amount) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right" colspan="5">Total Summary</th>
                <th class="text-right">{{ number_format($data->sum('total_count')) }}</th>
                <th class="text-right">{{ number_format($data->sum('amount')) }}</th>
            </tr>
        </tfoot>
    </table>

    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
