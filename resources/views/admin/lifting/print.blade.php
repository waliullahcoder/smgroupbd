
<style>
    @page {
        size: A4 portrait;
        margin: 12mm;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        color: #222;
        background: #fff;
    }

    .voucher-wrapper {
        width: 100%;
        max-width: 100%;
        margin: auto;
    }

    /* Company Header */
    .company-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 15px;
        border-bottom: 2px solid #26344a;
        margin-bottom: 20px;
        min-height: 100px;
        gap: 15px;
    }

    .company-logo {
        width: 25%;
        flex-shrink: 0;
        text-align: left;
    }

    .company-logo img {
        max-width: 140px;
        max-height: 85px;
        object-fit: contain;
    }

    .company-info {
        width: 75%;
        text-align: right;
    }

    .company-info h2 {
        font-size: 23px;
        font-weight: 700;
        margin: 0 0 7px;
        text-transform: uppercase;
        color: #26344a;
    }

    .company-info p {
        margin: 3px 0;
        font-size: 11px;
        line-height: 1.5;
    }

    /* Voucher Title */
    .voucher-title {
        text-align: center;
        margin: 15px 0 20px;
    }

    .voucher-title h3 {
        display: inline-block;
        font-size: 17px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 7px 30px;
        border: 1px solid #333;
        margin: 0;
        letter-spacing: 1px;
    }

    /* Information Table */
    .info-table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    .info-table td {
        padding: 8px 5px;
        border-bottom: 1px dashed #ccc;
        font-size: 12px;
    }

    .info-label {
        font-weight: 700;
        display: inline-block;
        min-width: 110px;
    }

    /* Product Table */
    .product-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }

    .product-table th {
        background: #26344a !important;
        color: #fff !important;
        padding: 9px 7px;
        font-size: 11px;
        border: 1px solid #26344a;
        text-align: center;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .product-table td {
        padding: 8px 7px;
        border: 1px solid #ddd;
        font-size: 11px;
    }

    .product-table tbody tr:nth-child(even) {
        background: #f7f8fa !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    /* Financial Summary */
    .summary-wrapper {
        display: flex;
        justify-content: flex-end;
        margin-top: 15px;
    }

    .summary-table {
        width: 320px;
        border-collapse: collapse;
    }

    .summary-table td {
        padding: 7px 10px;
        font-size: 12px;
        border-bottom: 1px solid #ddd;
    }

    .summary-table .grand-total td {
        background: #26344a !important;
        color: #fff !important;
        font-size: 14px;
        font-weight: 700;
        border: none;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    /* Amount In Words */
    .amount-words {
        margin-top: 20px;
        padding: 12px;
        background: #f5f6f8 !important;
        border-left: 3px solid #26344a;
        font-size: 12px;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    /* Signature */
    .signature-area {
        display: flex;
        justify-content: space-between;
        margin-top: 100px;
        padding: 0 20px;
    }

    .signature-item {
        width: 180px;
        text-align: center;
        border-top: 1px solid #333;
        padding-top: 8px;
        font-weight: 600;
    }

    .signature-item small {
        display: block;
        font-weight: normal;
        margin-bottom: 4px;
    }

    /* Footer */
    .print-footer {
        margin-top: 30px;
        padding-top: 8px;
        border-top: 1px solid #ddd;
        font-size: 10px;
        display: flex;
        justify-content: space-between;
    }

    @media print {
        body {
            margin: 0 !important;
            padding: 0 !important;
        }

        .no-print {
            display: none !important;
        }

        .voucher-wrapper {
            width: 100%;
        }

        .company-header {
            display: flex !important;
        }

        .product-table tr,
        .summary-table tr {
            page-break-inside: avoid;
        }
    }
</style>

@php
    $subtotal = 0;
    $total_qty = 0;

    foreach ($data->products as $row) {
        $subtotal += $row->qty * $row->lifting_price;
        $total_qty += $row->qty;
    }

    // Fixed Amount Discount
    $discount = (float) ($data->discount ?? 0);

    // Tax Percentage
    $tax_percentage = (float) ($data->tax_percentage ?? 0);

    // Final Calculation
    $after_discount = max(0, $subtotal - $discount);

    $tax_amount = ($after_discount * $tax_percentage) / 100;

    $grand_total = $after_discount + $tax_amount;
@endphp

<div class="voucher-wrapper">

    {{-- Company Header --}}
    <div class="company-header">

        {{-- Left Side Logo --}}
        <div class="company-logo">

            @if(!empty($data->company->logo))
                <img src="{{ asset($data->company->logo) }}" alt="Company Logo">
            @endif

        </div>

        {{-- Right Side Company Information --}}
        <div class="company-info">

            <h2>{{ $data->company->name ?? $title }}</h2>

            <p>
                {{ $data->company->address ?? '' }}
            </p>

            <p>
                {{ $data->company->phone ?? '' }}
                {{ $data->company->email ? ' | '.$data->company->email : '' }}
            </p>

            <p>
                {{ $data->company->website ?? '' }}
            </p>

        </div>

    </div>

    {{-- Voucher Title --}}
    <div class="voucher-title">
        <h3>{{ $report_title }}</h3>
    </div>

    {{-- Voucher Information --}}
    <table class="info-table">

        <tr>
            <td width="50%">
                <span class="info-label">Lifting No :</span>
                {{ $data->lifting_no }}
            </td>

            <td width="50%">
                <span class="info-label">Voucher No :</span>
                {{ $data->voucher_no }}
            </td>
        </tr>

        <tr>
            <td>
                <span class="info-label">Lifting Date :</span>
                {{ date('d-m-Y', strtotime($data->lifting_date)) }}
            </td>

            <td>
                <span class="info-label">Vendor Name :</span>
                {{ $data->vendor->name ?? 'N/A' }}
            </td>
        </tr>

    </table>

    {{-- Product Details --}}
    <table class="product-table">

        <thead>
            <tr>
                <th width="5%">SL</th>
                <th width="20%">Category</th>
                <th width="32%">Product Name (Code)</th>
                <th width="13%">Rate</th>
                <th width="13%">Quantity</th>
                <th width="17%">Amount</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($data->products as $row)

                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $row->product->category->name ?? 'N/A' }}
                    </td>

                    <td>
                        <strong>
                            {{ $row->product->name ?? 'N/A' }}
                        </strong>
                        <br>
                        <small>
                            {{ $row->product->code ?? '' }}
                        </small>
                    </td>

                    <td class="text-right">
                        {{ number_format($row->lifting_price, 2) }}
                    </td>

                    <td class="text-center">
                        {{ number_format($row->qty, 2) }}
                        ({{ $row->product->attribute->name ?? '' }})
                    </td>

                    <td class="text-right">
                        {{ number_format($row->qty * $row->lifting_price, 2) }}
                    </td>
                </tr>

            @endforeach

        </tbody>

        <tfoot>
            <tr>
                <th colspan="4" class="text-right">
                    Total Summary
                </th>

                <th class="text-center">
                    {{ number_format($total_qty, 2) }}
                </th>

                <th class="text-right">
                    {{ number_format($subtotal, 2) }}
                </th>
            </tr>
        </tfoot>

    </table>

    {{-- Financial Summary --}}
    <div class="summary-wrapper">

        <table class="summary-table">

            <tr>
                <td>Subtotal</td>

                <td class="text-right">
                    {{ number_format($subtotal, 2) }}
                </td>
            </tr>

            <tr>
                <td>Discount</td>

                <td class="text-right">
                    - {{ number_format($discount, 2) }}
                </td>
            </tr>

            <tr>
                <td>
                    VAT & Tax ({{ number_format($tax_percentage, 2) }}%)
                </td>

                <td class="text-right">
                    {{ number_format($tax_amount, 2) }}
                </td>
            </tr>

            <tr class="grand-total">
                <td>Net Payable</td>

                <td class="text-right">
                    {{ number_format($grand_total, 2) }}
                </td>
            </tr>

        </table>

    </div>

    {{-- Amount In Words --}}
    <div class="amount-words">

        <strong>In Words:</strong>

        {{ \App\HelperClass::convertNumber($grand_total) }} Taka Only.

    </div>

    {{-- Signature --}}
    <div class="signature-area">

        <div class="signature-item">
            <small>&nbsp;</small>
            Receive By
        </div>

        <div class="signature-item">
            <small>{{ $data->staff->name ?? '' }}</small>
            Prepare By
        </div>

    </div>

    {{-- Footer --}}
    <div class="print-footer">

        <span>
            Print Date: {{ date('d-m-Y h:i:s A') }}
        </span>

        <span>
            {{ $data->company->name ?? $title }}
        </span>

    </div>

</div>

{{-- Auto Print --}}
<script>
    window.addEventListener('load', function () {

        setTimeout(function () {
            window.print();
        }, 500);

    });
</script>
