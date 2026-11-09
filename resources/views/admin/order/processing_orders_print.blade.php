@extends('layouts.admin.invoice_app')
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

        .staff {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
        }
    </style>
@endpush
@section('content')
    <table class="table mb-3 info-table" style="border: 2px solid black; margin-top: -2px;">
        <thead>
            <tr>
                <th>SL#</th>
                <th>Vendor</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ @$item->product->vendor->name }}</td>
                    <td>{{ @$item->product->name }}</td>
                    <td>{{ @$item->product->code }}</td>
                    <td>{{ $item->qty }} {{ @$item->product->attribute->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <table class="table mb-3 info-table" style="border: 2px solid black; margin-top: -2px;">
        <tbody>
            <tr>
                <td>
                    <label>Invoice No : </label>
                    @foreach ($invoices as $invoice)
                        @if ($loop->iteration > 1)
                            {{ ', ' }}
                        @endif
                        {{ $invoice->order_code }}
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
    <div style="padding-top: 50px;">
        <table class="table mb-0 border-0">
            <tbody>
                <tr>
                    <td style="border: none;" width="50%">
                        <div class="signature-item">
                            <i class="staff">{{ auth()->user()->name }}</i>
                            <span>Prepared By</span>
                        </div>
                    </td>
                    <td style="border: none;" width="50%">
                        <div class="signature-item">
                            <span>Store-in-Charge</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
