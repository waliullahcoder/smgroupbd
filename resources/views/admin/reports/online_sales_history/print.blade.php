@extends('layouts.admin.print_app')

@section('content')
    @if ($report_type == 'product_summary')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead>
                <tr>
                    <th class="text-center">SL#</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th class="text-right">Quantity (KG)</th>
                    <th class="text-right">Avarage Rate</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $row)
                    <tr>
                        <td class="text-center"><b>{{ $key + 1 }}</b></td>
                        <td>{{ @$row->product->name }}</td>
                        <td>{{ @$row->product->code }}</td>
                        <td class="text-right">{{ number_format($row->total_qty, 2) }}</td>
                        <td class="text-right">{{ number_format($row->total_amount / $row->total_qty, 2) }}</td>
                        <td class="text-right">{{ number_format($row->total_amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="3"><b>Total Summary</b></td>
                    <td class="text-right" colspan="1"><b>{{ number_format($data->sum('total_qty'), 2) }}</b></td>
                    <td class="text-right" colspan="1"></td>
                    <td class="text-right" colspan="1"><b>{{ number_format($data->sum('total_amount'), 2) }}</b></td>
                </tr>
            </tfoot>
        </table>
    @elseif ($report_type == 'history')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead>
                <tr class="text-nowrap">
                    <th class="text-center">SL#</th>
                    <th>Date</th>
                    <th>Invoice</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Product Name</th>
                    <th class="text-right">Quantity (KG)</th>
                    <th class="text-right">Rate</th>
                    <th class="text-right">Amount</th>
                    <th class="text-right">Status</th>
                    <th class="text-right">Sales By</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ date('d-m-Y', strtotime($row->created_at)) }}</td>
                        <td>{{ @$row->order->invoice }}</td>
                        <td>{{ @$row->order->user_name }}</td>
                        <td>{{ @$row->order->user_phone }}</td>
                        <td>{{ @$row->product->name }}</td>
                        <td class="text-right">{{ $row->quantity }}</td>
                        <td class="text-right">{{ $row->sale_price }}</td>
                        <td class="text-right">{{ $row->subtotal }}</td>
                        <td class="text-right">{{ @$row->order->status }}</td>
                        <td class="text-right">{{ @$row->order->staff->name }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="6"><b>Total Summary</b></td>
                    <td class="text-right" colspan="1"><b>{{ number_format($data->sum('quantity'), 2) }}</b></td>
                    <td class="text-right" colspan="1"></td>
                    <td class="text-right" colspan="1"><b>{{ number_format($data->sum('subtotal'), 2) }}</b></td>
                    <td class="text-right" colspan="1"></td>
                    <td class="text-right" colspan="1"></td>
                </tr>
            </tfoot>
        </table>
    @endif
    <div style="padding-top: 30px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
