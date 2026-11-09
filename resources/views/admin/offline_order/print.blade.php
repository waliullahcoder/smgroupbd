@extends('layouts.admin.print_app')
@push('css')
    <style>
        .info-table thead {
            background-color: #fff;
            color: #333;
        }

        .info-table thead th {
            border-bottom: 2px solid #000 !important;
            border-right: 2px dotted #888;
        }

        .info-table tbody td {
            border-top: 2px dotted #888;
            border-right: 2px dotted #888;
        }

        .info-table td,
        .header-table td {
            padding: 3px 12px 1px !important;
            font-family: 'PT Serif', serif;
        }

        .d-inline-block {
            display: inline-block;
        }

        .overflow-hidden {
            overflow: hidden;
        }
    </style>
@endpush
@section('content')
    <table class="table mb-2 header-table" style="border-bottom: 1px solid #ddd;">
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Invoice :</b>
                <span class="d-inline-block">{{ $data->invoice }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Order Receive :</b>
                <span class="d-inline-block" style="min-width: 160px;">{{ @$data->client->name }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Order Date :</b>
                <span class="d-inline-block">{{ date('d-m-Y', strtotime($data->date)) }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Staff :</b>
                <span class="d-inline-block" style="min-width: 160px;">{{ @$data->staff->name }}</span>
            </td>
        </tr>
    </table>

    <table class="table table-bordered table-condensed table-striped align-middle mb-3">
        <thead>
            <tr>
                <th class="text-center" width="40px">SL#</th>
                <th>Vendor</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th class="text-center">Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $row)
                <tr>
                    <td class="text-center" width="40px"><b>{{ $loop->iteration }}</b></td>
                    <td>{{ $row->product->vendor->name }}</td>
                    <td>{{ $row->product->code }}</td>
                    <td>{{ $row->product->name }}</td>
                    <td class="text-center">
                        {{ number_format($row->quantity, 2, '.', ',') . '(' . $row->product->attribute->name . ')' }} </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-right" colspan="4"><b>Total Summary</b></td>
                <td class="text-center" colspan="1"><b>{{ number_format($products->sum('quantity'), 2, '.', ',') }}</b>
                </td>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 50px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
