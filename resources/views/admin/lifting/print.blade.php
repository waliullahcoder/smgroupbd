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
                <b class="d-inline-block" style="min-width: 120px;">Lifting No :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ $data->lifting_no }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Voucher No :</b>
                <span class="d-inline-block" style="min-width: 110px;">{{ $data->voucher_no }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <div class="overflow-hidden">
                    <b class="d-inline-block" style="min-width: 120px;">Lifting Date :</b>
                    <span class="d-inline-block"
                        style="min-width: 200px;">{{ date('d-m-Y', strtotime($data->lifting_date)) }}</span>
                </div>
            </td>
            <td class="text-right">
                <div class="overflow-hidden">
                    <b class="d-inline-block text-left">Vendor Name :</b>
                    <span class="d-inline-block" style="min-width: 110px;">{{ $data->vendor->name }}</span>
                </div>
            </td>
        </tr>
    </table>
    <table class="table table-bordered table-condensed table-striped align-middle mb-3">
        <thead>
            <tr>
                <th class="text-center">SL#</th>
                <th>Product Category</th>
                <th>Product Name (Code)</th>
                <th class="text-right">Rate</th>
                <th class="text-center">Quantity</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_qty = 0;
            @endphp
            @foreach ($data->products as $row)
                <tr>
                    <td class="text-center"><b>{{ $loop->iteration }}</b></td>
                    <td>{{ $row->product->category->name }}</td>
                    <td>{{ $row->product->name }} ({{ $row->product->code }})</td>
                    <td class="text-right">{{ number_format($row->lifting_price, 2) }}</td>
                    <td class="text-center">{{ $row->qty . '(' . $row->product->attribute->name . ')' }} </td>
                    <td class="text-right">{{ number_format($row->qty * $row->lifting_price, 2, '.', ',') }}</td>
                </tr>
                @php
                    $total_qty += $row->qty;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-right" colspan="4"><b>Total Summary</b></td>
                <td class="text-center" colspan="1"><b>{{ number_format($total_qty, 2, '.', ',') }}</b></td>
                <td class="text-right" colspan="1"><b>{{ number_format($data->total_cost, 2, '.', ',') }}</b></td>
            </tr>
        </tfoot>
    </table>
    <div class="mb-3 font">
        <b>In words : </b> {{ \App\HelperClass::convertNumber($data->total_cost) }} taka.
    </div>
    <div>
        <div class="signature-area">
            <div class="signature-item">
                <span>Receive By</span>
            </div>
            <div class="signature-item">
                <i class="staff">{{ @$data->staff->name }}</i>
                <span>Prepare By</span>
            </div>
        </div>
    </div>
    <div style="padding-top: 50px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
