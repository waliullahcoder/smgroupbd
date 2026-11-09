@extends('layouts.admin.print_app')
@section('content')
    <table class="table mb-3 info-table">
        <tr>
            <td>
                <div class="d-flex align-items-center"><b style="flex-shrink: 0; width: 110px; display: inline-block;">Return
                        No.</b> :
                    {{ $data->return_no }}</div>
            </td>
            <td>
                <div class="d-flex align-items-center"><b style="flex-shrink: 0; width: 110px; display: inline-block;">Return
                        Date</b> :
                    {{ date('d-m-Y', strtotime($data->date)) }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="d-flex align-items-center"><b style="flex-shrink: 0; width: 110px; display: inline-block;">Client
                        Name.</b> :
                    {{ $data->client->name }}</div>
            </td>
            <td>
                <div class="d-flex align-items-center"><b
                        style="flex-shrink: 0; width: 110px; display: inline-block;">Destination Store</b> :
                    {{ $data->store->name }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="d-flex align-items-center"><b style="flex-shrink: 0; width: 110px; display: inline-block;">Return
                        By</b> :
                    {{ $data->staff->name }}</div>
            </td>
            <td>
                <div class="d-flex align-items-center"><b style="flex-shrink: 0; width: 110px; display: inline-block;">Store
                        Approve</b> :
                    {{ $data->approveBy ? $data->approveBy->name : 'Not Approved' }}</div>
            </td>
        </tr>
    </table>
    @if ($data->product_type == 'Consumer')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead>
                <tr class="text-nowrap">
                    <th class="text-center" width="40px">SL#</th>
                    <th>Product Category</th>
                    <th>Product Name (Code)</th>
                    <th class="text-right">Rate</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Sales Discount</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->list as $row)
                    <tr>
                        <td class="text-center" width="40px"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ $row->product->category->name }}</td>
                        <td>{{ $row->product->name }} ({{ $row->product->code }})</td>
                        <td class="text-right">{{ number_format($row->product->price->sale_price, 2, '.', ',') }}</td>
                        <td class="text-right">{{ $row->qty . '(' . $row->product->attribute->name . ')' }} </td>
                        <td class="text-right">{{ $row->sales_discount }} </td>
                        <td class="text-right">{{ number_format($row->amount - $row->sales_discount, 2, '.', ',') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="5"><b>Total Summary</b></td>
                    <td class="text-right" colspan="1">
                        <b>{{ number_format($data->list->sum('sales_discount'), 2, '.', ',') }}</b>
                    </td>
                    <td class="text-right" colspan="1"><b>{{ number_format($data->amount, 2, '.', ',') }}</b></td>
                </tr>
            </tfoot>
        </table>
    @else
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead>
                <tr class="text-nowrap">
                    <th class="text-center" width="40px">SL#</th>
                    <th>Product Category</th>
                    <th>Product Name</th>
                    <th>Variant</th>
                    <th class="text-right">Rate</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Sales Discount</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->list as $row)
                    <tr>
                        <td class="text-center" width="40px"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ @$row->product->category->name }}</td>
                        <td>{{ @$row->product->name }}</td>
                        <td>{{ @$row->variant->sku }}</td>
                        <td class="text-right">{{ number_format($row->price, 2, '.', ',') }}</td>
                        <td class="text-right">{{ $row->qty }} </td>
                        <td class="text-right">{{ $row->sales_discount }} </td>
                        <td class="text-right">{{ number_format($row->amount - $row->sales_discount, 2, '.', ',') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="5"><b>Total Summary</b></td>
                    <td class="text-right" colspan="1"><b>{{ number_format($data->list->sum('qty'), 2, '.', ',') }}</b>
                    </td>
                    <td class="text-right" colspan="1">
                        <b>{{ number_format($data->list->sum('sales_discount'), 2, '.', ',') }}</b>
                    </td>
                    <td class="text-right" colspan="1"><b>{{ number_format($data->amount, 2, '.', ',') }}</b></td>
                </tr>
            </tfoot>
        </table>
    @endif
    <div style="padding-top: 50px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
