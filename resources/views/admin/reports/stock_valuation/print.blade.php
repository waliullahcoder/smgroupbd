@extends('layouts.admin.print_app')

@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle mb-3">

        <thead>
            <tr>
                <th class="text-center" width="40px" rowspan="2">SL#</th>
                <th rowspan="2">Product Name</th>
                <th rowspan="2">Code</th>
                <th rowspan="2">UOM</th>
                <th class="text-center" rowspan="2">Stock Qty</th>
                <th class="text-center" colspan="2">Purchase value</th>
                <th class="text-center" colspan="2">Whole Sales value</th>
                <th class="text-center" colspan="2">Retail value</th>
            </tr>
            <tr>
                <th class="text-center">Cost</th>
                <th class="text-center">Value</th>
                <th class="text-center">Rate</th>
                <th class="text-center">Value</th>
                <th class="text-center">Rate</th>
                <th class="text-center">Value</th>
            </tr>
        </thead>
        <tbody>
            @php
                $key = 1;
                $total_qty = 0;
                $total_cost_value = 0;
                $total_sale_value = 0;
                $total_online_value = 0;
            @endphp
            @if (isset($data['stocks']) && count($data['stocks']) > 0)
                @foreach ($data['stocks'] as $row)
                    @php
                        $cost_value = ($row->stock_qty ?? 0) * ($row->product->price->lifting_price ?? 0);
                        $sale_value = ($row->stock_qty ?? 0) * ($row->product->price->sale_price ?? 0);
                        $online_value = ($row->stock_qty ?? 0) * ($row->product->price->online_price ?? 0);

                        $total_qty += $row->stock_qty ?? 0;
                        $total_cost_value += $cost_value;
                        $total_sale_value += $sale_value;
                        $total_online_value += $online_value;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $key++ }}</td>
                        <td class="">{{ $row->product->name ?? '' }}</td>
                        <td class="">{{ $row->product->code ?? '' }}</td>
                        <td class="">{{ $row->product->attribute->name ?? '' }}</td>
                        <td class="text-center">{{ number_format($row->stock_qty, 2) }}</td>
                        <td class="text-center">{{ number_format($row->product->price->lifting_price ?? 0, 2, '.', ',') }}</td>
                        <td class="text-center">
                            {{ number_format($cost_value, 2, '.', ',') }}
                        </td>
                        <td class="text-center">{{ number_format($row->product->price->sale_price ?? 0, 2, '.', ',') }}</td>
                        <td class="text-center">
                            {{ number_format($sale_value, 2, '.', ',') }}
                        </td>
                        <td class="text-center">{{ number_format($row->product->price->online_price ?? 0, 2, '.', ',') }}
                        </td>
                        <td class="text-center">
                            {{ number_format($online_value, 2, '.', ',') }}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        @if (isset($data['stocks']) && count($data['stocks']) > 0)
            <tfoot>
                <tr class="bg-primary">
                    <th colspan="4">Total</th>
                    <th class="text-center">{{ number_format($total_qty, 2, '.', ',') }}</th>
                    <th colspan="1" class="text-center"></th>
                    <th class="text-center">{{ number_format($total_cost_value, 2, '.', ',') }}</th>
                    <th colspan="1" class="text-center"></th>
                    <th class="text-center">{{ number_format($total_sale_value, 2, '.', ',') }}</th>
                    <th colspan="1" class="text-center"></th>
                    <th class="text-center">{{ number_format($total_online_value, 2, '.', ',') }}</th>
                </tr>
            </tfoot>
        @endif
    </table>
    <div style="padding-top: 30px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
