@extends('layouts.admin.print_app')
@section('content')
    @if (request('report_type') == 'summary')
        <table class="table table-bordered table-condensed table-striped align-middle">
            <thead>
                <tr class="text-nowrap">
                    <th class="text-center" width="50">SL#</th>
                    <th>Product Name</th>
                    <th class="text-right">Quantity (KG)</th>
                    @if (is_null(request('chalan')))
                        <th class="text-right">Amount</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $row)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ @$row->product->name }}</td>
                        <td class="text-right">
                            {{ number_format($row->total_quantity, 2) }}</td>
                        @if (is_null(request('chalan')))
                            <td class="text-right">{{ number_format($row->total_subtotal, 2) }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <th class="text-right" colspan="2"></th>
                <th class="text-right">{{ number_format($data->sum('total_quantity'), 2) }}</th>
                @if (is_null(request('chalan')))
                    <th class="text-right">{{ number_format($data->sum('total_subtotal'), 2) }}</th>
                @endif
            </tfoot>
        </table>
    @else
        <table class="table table-bordered table-condensed table-striped align-middle">
            <thead>
                <tr class="text-nowrap">
                    <th class="text-center" width="50">SL#</th>
                    <th>Date</th>
                    <th>Order No.</th>
                    <th>Customer Name</th>
                    <th>Area</th>
                    <th>Customer Phone</th>
                    <th>Address</th>
                    <th>Product Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $row)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
