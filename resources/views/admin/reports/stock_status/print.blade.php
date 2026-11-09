@extends('layouts.admin.print_app')

@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle mb-3">
        <thead>
            <tr class="text-nowrap">
                <th class="text-center" width="40px">Sl#</th>
                <th>Product Name</th>
                <th>Code</th>
                <th>UOM</th>
                {{-- <th class="text-right">Opening</th>
                <th class="text-right">Lifting</th>
                <th class="text-right">L Return</th>
                <th class="text-right">Sales</th>
                <th class="text-right">S Return</th>
                <th class="text-right">Transfer</th>
                <th class="text-right">Received</th>
                <th class="text-right">Retail Sales</th>
                <th class="text-right">Retail Returns</th>
                <th class="text-right">Online Delivery</th> --}}
                <th class="text-right">Balance</th>
            </tr>
        </thead>
        <tbody>
            @php
                $key = 1;
                use Carbon\Carbon;
            @endphp
            @if (isset($data['stocks']) && count($data['stocks']) > 0)
                @foreach ($data['stocks'] as $row)
                    <tr>
                        <td class="text-center">{{ $key++ }}</td>
                        <td>{{ $row->product->name ?? '' }}</td>
                        <td>{{ $row->product->code ?? '' }}</td>
                        <td>{{ $row->product->attribute->name ?? '' }}</td>
                        {{-- <td class="text-center px-3">{{ number_format($opening, 2) }}</td>
                            <td class="text-center px-3">
                                {{ number_format($liftings, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($lifting_returns, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($sales, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($sales_returns, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($transfers, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($receives, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($retail_sales, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($retail_returns, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($online_sales, 2) }}
                            </td> --}}
                        <td class="text-right">{{ number_format($row->stock_qty, 2) }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div style="padding-top: 30px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
