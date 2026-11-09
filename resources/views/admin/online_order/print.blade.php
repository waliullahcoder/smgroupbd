@extends('layouts.admin.print_app')
@push('css')
    <style>
        .info-table thead {
            background-color: #fff;
            color: #333;
        }

        .font {
            font-family: 'PT Serif', serif;
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
    <table class="table mb-3 info-table" style="border-bottom: 1px solid #ddd;">
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 120px;">Invoice No :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ $data->invoice }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Shipping Address :</b>
                <span class="d-inline-block" style="min-width: 110px;">{{ $data->shipping_address }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <div class="overflow-hidden">
                    <b class="d-inline-block" style="min-width: 120px;">Date :</b>
                    <span class="d-inline-block"
                        style="min-width: 200px;">{{ date('d-m-Y', strtotime($data->date)) }}</span>
                </div>
            </td>
            <td class="text-right">
                <div class="overflow-hidden">
                    <b class="d-inline-block text-left">Shippping Charge :</b>
                    <span class="d-inline-block" style="min-width: 110px;">{{ $data->shipping_charge }}</span>
                </div>
            </td>
        </tr>
    </table>
    <table class="table table-bordered table-condensed table-striped align-middle mb-3">
        <thead>
            <tr>
                <th class="text-center">SL#</th>
                <th>Product Name (Code)</th>
                <th class="text-right">Rate</th>
                <th class="text-center">Quantity</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->products as $row)
                <tr>
                    <td class="text-center"><b>{{ $loop->iteration }}</b></td>
                    <td>{{ @$row->product->name }} ({{ @$row->product->code }})</td>
                    <td class="text-right">{{ number_format($row->sale_price, 2) }}</td>
                    <td class="text-center">{{ $row->quantity . ' (' . @$row->product->attribute->name . ')' }} </td>
                    <td class="text-right">{{ number_format($row->subtotal, 2, '.', ',') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right" colspan="4">Total</th>
                <th class="text-right">{{ number_format($data->products->sum('subtotal'), 2, '.', ',') }}</th>
            </tr>
        </tfoot>
    </table>
    <div class="mb-3 font">
        <b>In words : </b> {{ \App\HelperClass::convertNumber($data->total) }} taka.
    </div>
    <div style="padding-top: 50px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
