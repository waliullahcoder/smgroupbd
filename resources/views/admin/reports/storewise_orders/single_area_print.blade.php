@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr class="text-nowrap">
                <th class="text-center" width="20">SL#</th>
                <th>Order No.</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Area</th>
                <th>Address</th>
                <th>Product Details</th>
                <th class="text-center">Collection Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->orders->whereIn('status', ['Pending', 'Forward', 'Processing', 'On Route', 'Delivered']) as $row)
                <tr style="font-size: 12px;">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $row->invoice }}</td>
                    <td>{{ $row->user_name }}</td>
                    <td>{{ $row->user_phone }}</td>
                    <td>{{ @$row->area->name }}</td>
                    <td>{{ $row->shipping_address }}</td>
                    <td>
                        @php
                            $string = '';
                            foreach ($row->products as $key => $item) {
                                $string .=
                                    ($key > 0 ? ', ' : '') .
                                    @$item->product->name .
                                    ' - ' .
                                    $item->quantity .
                                    ' ' .
                                    @$item->product->attribute->name .
                                    ' - ' .
                                    $item->subtotal .
                                    'Taka ';
                            }
                        @endphp
                        {{ $string }}
                    </td>
                    <td class="text-center">{{ number_format($row->due) }}</td>
                    <td>{{ $row->status }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right" colspan="7">Total</th>
                <th class="text-center">{{ number_format($data->orders->whereIn('status', ['Pending', 'Forward', 'Processing', 'On Route', 'Delivered'])->sum('due')) }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
