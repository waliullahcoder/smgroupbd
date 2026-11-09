@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr class="text-nowrap">
                <th class="text-center" width="30">SL#</th>
                <th>Date</th>
                <th>Invoice No</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Area</th>
                <th>Address</th>
                <th>Products</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr style="font-size: 12px;">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-nowrap">{{ date('d-m-Y', strtotime($row->date)) }}</td>
                    <td>{{ $row->invoice }}</td>
                    <td>{{ $row->user_name }}</td>
                    <td>{{ $row->user_phone }}</td>
                    <td>{{ @$row->area->name }}</td>
                    <td>{{ $row->shipping_address }}</td>
                    <td>
                        <ul>
                            @foreach ($row->products as $item)
                                <li class="text-nowrap">
                                    {{ $item->product->name . ' - ' . $item->quantity . ' ' . @$item->product->attribute->name }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-right">{{ $row->due }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right" colspan="8">Total Summary</th>
                <th class="text-right">{{ number_format($data->sum('due'), 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
