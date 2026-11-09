@extends('layouts.admin.print_app')
@section('content')
    @if ($report_type == 'summary')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead class="text-nowrap">
                <tr>
                    <th class="text-center">SL#</th>
                    <th>Product Category</th>
                    <th>Product Name ({{ request('product_type') == 'Consumer' || is_null(request('product_type')) ? 'Code' : 'Variant' }})</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ $row->product->category->name }}</td>
                        <td>{{ $row->product->name }}
                            ({{ request('product_type') == 'Consumer' || is_null(request('product_type')) ? @$row->product->code : @$row->variant->sku }})
                        </td>
                        <td class="text-right">{{ number_format($row->total_lifting_qty, 2, '.', ',') }}</td>
                        <td class="text-right">{{ number_format($row->total_lifting_price, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="3"><b>Total Summary</b></td>
                    <td class="text-right" colspan="1">
                        <b>{{ number_format($data->sum('total_lifting_qty'), 2, '.', ',') }}</b>
                    </td>
                    <td class="text-right" colspan="1">
                        <b>{{ number_format($data->sum('total_lifting_price'), 2, '.', ',') }}</b>
                    </td>
                </tr>
            </tfoot>
        </table>
    @elseif ($report_type == 'history')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead>
                <tr>
                    <th class="text-center">SL#</th>
                    <th>Date</th>
                    <th>Voucher No.</th>
                    <th>Product Category</th>
                    <th>Product Name ({{ request('product_type') == 'Consumer' || is_null(request('product_type')) ? 'Code' : 'Variant' }})</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Rate</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ date('d-m-Y', strtotime($row->lifting->lifting_date)) }}</td>
                        <td>{{ $row->lifting->voucher_no }}</td>
                        <td>{{ $row->product->category->name }}</td>
                        <td>{{ $row->product->name }}
                            ({{ request('product_type') == 'Consumer' || is_null(request('product_type')) ? $row->product->code : $row->variant->sku }})
                        </td>
                        <td class="text-right">{{ number_format($row->qty, 2, '.', ',') }} </td>
                        <td class="text-right">{{ number_format($row->lifting_price, 2, '.', ',') }}</td>
                        <td class="text-right">{{ number_format($row->qty * $row->lifting_price, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="5"><b>Total Summary</b></td>
                    <td class="text-right" colspan="1"><b>{{ number_format($data->sum('qty'), 2, '.', ',') }}</b></td>
                    <td class="text-right" colspan="1"></td>
                    <td class="text-right" colspan="1">
                        <b>{{ number_format($data->sum('qty') * $data->sum('lifting_price'), 2, '.', ',') }}</b></td>
                </tr>
            </tfoot>
        </table>
    @endif
    <div style="padding-top: 30px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
