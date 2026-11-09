@extends('layouts.admin.print_app')
@section('content')
    @if (request('report_type') == 'product_wise')
        <table class="table table-bordered table-condensed table-striped align-middle">
            <thead>
                <tr class="text-nowrap">
                    <th class="text-center" width="20">SL#</th>
                    <th>Product</th>
                    <th class="text-right">Total Qty</th>
                    <th class="text-right">Total Amount</th>
                    <th class="text-right">Product Discount</th>
                    <th class="text-right">Discount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-nowrap">{{ @$row->product->name }}</td>
                        <td class="text-right">{{ number_format($row->total_qty, 2) }}</td>
                        <td class="text-right">{{ number_format($row->total_amount, 2) }}</td>
                        <td class="text-right">{{ number_format($row->total_product_discount, 2) }}</td>
                        <td class="text-right">{{ number_format($row->total_discount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right" colspan="2">Total</th>
                    <th class="text-right">{{ number_format($data->sum('total_qty'), 2) }}</th>
                    <th class="text-right">{{ number_format($data->sum('total_amount'), 2) }}</th>
                    <th class="text-right">{{ number_format($data->sum('total_product_discount'), 2) }}</th>
                    <th class="text-right">{{ number_format($data->sum('total_discount'), 2) }}</th>
                </tr>
            </tfoot>
        </table>
    @else
        <table class="table table-bordered table-condensed table-striped align-middle">
            <thead>
                <tr class="text-nowrap">
                    <th class="text-center" width="20">SL#</th>
                    <th>Date</th>
                    <th>Invoice</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Products</th>
                    <th class="text-right">Total Amount</th>
                    <th class="text-right">Discount</th>
                    <th class="text-right">Net Amount</th>
                    <th class="text-right">Staff</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-nowrap">{{ date('d-m-Y', strtotime($row->date)) }}</td>
                        <td>{{ $row->invoice }}</td>
                        <td>{{ $row->client_name }}</td>
                        <td>{{ $row->client_phone }}</td>
                        <td>
                            @foreach ($row->list as $key => $item)
                                @if ($key > 0)
                                    <br>
                                @endif
                                {{ $key + 1 . '. ' . @$item->product->name }}
                            @endforeach
                        </td>
                        <td class="text-right">{{ number_format($row->total_amount, 2) }}</td>
                        <td class="text-right">{{ number_format($row->discount, 2) }}</td>
                        <td class="text-right">{{ number_format($row->net_amount, 2) }}</td>
                        <td class="text-right">{{ @$row->staff->name }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right" colspan="6">Total</th>
                    <th class="text-right">{{ number_format($data->sum('total_amount'), 2) }}</th>
                    <th class="text-right">{{ number_format($data->sum('discount'), 2) }}</th>
                    <th class="text-right">{{ number_format($data->sum('net_amount'), 2) }}</th>
                    <th class="text-right"></th>
                </tr>
            </tfoot>
        </table>
    @endif

    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
