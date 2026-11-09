@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr class="text-nowrap">
                <th class="text-center" width="50">SL#</th>
                <th>Date</th>
                <th>Order No.</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Area</th>
                <th>Address</th>
                <th>Product Details</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->orders->whereIn('status', ['Pending', 'Forward', 'Processing']) as $row)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-nowrap">{{ date('d-m-Y', strtotime($row->date)) }}</td>
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
                    <td>{{ $row->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
