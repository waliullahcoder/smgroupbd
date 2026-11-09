@extends('layouts.admin.print_app')
@section('content')
    <table class="table mb-3 info-table" style="border-bottom: 1px solid #ddd;">
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 120px;">Return No :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ $data->return_no }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Vendor Name :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ @$data->vendor->name }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <div class="overflow-hidden">
                    <b class="d-inline-block" style="min-width: 120px;">Return Date :</b>
                    <span class="d-inline-block"
                        style="min-width: 200px;">{{ date('d-m-Y', strtotime($data->date)) }}</span>
                </div>
            </td>
            <td class="text-right">
                <div class="overflow-hidden">
                    <b class="d-inline-block text-left">Total Amount :</b>
                    <span class="d-inline-block"
                        style="min-width: 200px;">{{ number_format($data->list->sum('amount') - $data->list->sum('lifting_discount'), 2, '.', ',') }}</span>
                </div>
            </td>
        </tr>
    </table>

    <table class="table table-bordered table-condensed table-striped align-middle mb-3">
        <thead>
            <tr>
                <th class="text-center">SL#</th>
                <th>Product Category</th>
                <th>Product Name</th>
                <th>{{ $data->product_type == 'Consumer' ? 'Code' : 'Variant' }}</th>
                <th class="text-center">Rate</th>
                <th class="text-center">Quantity</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($data->list as $key => $row)
                <tr>
                    <td class="text-center"><b>{{ $key + 1 }}</b></td>
                    <td>{{ @$row->product->category->name ?? @$row->variant->product->category->name }}</td>
                    <td>{{ @$row->product->name ?? @$row->vairant->product->name }}</td>
                    <td>{{ @$row->product->code ?? @$row->variant->sku }}</td>
                    <td class="text-center">{{ number_format($row->lifting_product->lifting_price, 2, '.', ',') }}</td>
                    <td class="text-center">
                        {{ $row->qty . (@$row->product->attribute->name ? '(' . @$row->product->attribute->name . ')' : '') }}
                    </td>
                    <td class="text-right">
                        {{ number_format($row->qty * $row->lifting_product->lifting_price, 2, '.', ',') }}</td>
                </tr>
                @php
                    $total += $row->qty * $row->lifting_product->lifting_price;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-right" colspan="6"><b>Total Summary</b></td>
                <td class="text-right" colspan="1"><b>{{ number_format($total, 2, '.', ',') }}</b></td>
            </tr>
        </tfoot>
    </table>
    <div class="mb-3">
        <b>In words : {{ \App\HelperClass::convertNumber($total) }} taka.</b>
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
