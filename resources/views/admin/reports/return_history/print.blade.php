@extends('layouts.admin.print_app')

@section('content')
    @if ($report_type == 'product_summary')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead class="text-nowrap">
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Category</th>
                    <th>Vendor</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                        <td>{{ @$row->product->category->name }}</td>
                        <td>{{ @$row->product->vendor->name }}</td>
                        <td>{{ @$row->product->name }}</td>
                        <td>{{ @$row->product->code }}</td>
                        <td class="text-center">{{ number_format($row->total_qty, 2, '.', ',') }}</td>
                        <td class="text-right">{{ number_format($row->total_amount, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="6"><b>Total Summary</b></td>
                    <td class="text-center" colspan="1">
                        <b>{{ number_format($data->sum('total_amount'), 2, '.', ',') }}</b>
                    </td>
                </tr>
            </tfoot>
        </table>
    @elseif ($report_type == 'client_summary')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead class="text-nowrap">
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Area</th>
                    <th>Territory</th>
                    <th>Client Type</th>
                    <th>Client Name</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center" width="40px"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ @$row->client->area->name }}</td>
                        <td>{{ @$row->client->territory->name }}</td>
                        <td>{{ @$row->client->client_category->name }}</td>
                        <td>{{ @$row->client->name }}</td>
                        <td class="text-right">{{ number_format($row->total_amount, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="5"><b>Total Summary</b></td>
                    <td class="text-right" colspan="1">
                        <b>{{ number_format($data->sum('total_amount'), 2, '.', ',') }}</b></td>
                </tr>
            </tfoot>
        </table>
    @elseif ($report_type == 'history')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead class="text-nowrap">
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Date</th>
                    <th>Client Name</th>
                    <th>Category Name</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center" width="40px"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ date('d-m-Y', strtotime($row->return->date)) }}</td>
                        <td>{{ @$row->client->name }}</td>
                        <td>{{ @$row->product->category->name }}</td>
                        <td>{{ @$row->product->name }}</td>
                        <td>{{ @$row->product->code }}</td>
                        <td class="text-center">{{ number_format($row->qty, 2, '.', ',') }}</td>
                        <td class="text-right">{{ number_format($row->amount, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="7"><b>Total Summary</b></td>
                    <td class="text-right" colspan="1"><b>{{ number_format($data->sum('amount'), 2, '.', ',') }}</b>
                    </td>
                </tr>
            </tfoot>
        </table>
    @endif
    <div style="padding-top: 30px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
