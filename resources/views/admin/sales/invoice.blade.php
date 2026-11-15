
<style>
    @page {
        size: A4;
        margin: 10mm;
    }

    .invoice-print,
    .invoice-print * {
        box-sizing: border-box;
    }

    .invoice-print {
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
        padding: 10px;
        background: #fff;
        color: #222;
        font-family: Arial, sans-serif;
        font-size: 12px;
        line-height: 1.5;
    }

    /* Company Header */
    .invoice-print .company-header {
        width: 100%;
        display: table;
        table-layout: fixed;
        border-bottom: 3px solid #172554;
        padding: 10px 5px 15px;
        margin-bottom: 15px;
    }

    .invoice-print .company-logo,
    .invoice-print .company-info {
        display: table-cell;
        vertical-align: middle;
    }

    .invoice-print .company-logo {
        width: 30%;
        text-align: left;
    }

    .invoice-print .company-logo img {
        max-width: 160px;
        max-height: 85px;
        width: auto;
        height: auto;
        object-fit: contain;
    }

    .invoice-print .company-info {
        width: 70%;
        text-align: right;
    }

    .invoice-print .company-info h2 {
        font-size: 23px;
        font-weight: 700;
        color: #172554;
        margin: 0 0 5px;
    }

    .invoice-print .company-info p {
        font-size: 11px;
        color: #444;
        margin: 2px 0;
        line-height: 1.5;
    }

    /* Invoice Title */
    .invoice-print .invoice-title {
        text-align: center;
        margin: 15px 0;
    }

    .invoice-print .invoice-title span {
        display: inline-block;
        background: #172554;
        color: #fff;
        padding: 7px 40px;
        font-size: 17px;
        font-weight: bold;
        letter-spacing: 2px;
        border-radius: 3px;
    }

    /* Information Boxes */
    .invoice-print .invoice-info {
        display: table;
        width: 100%;
        table-layout: fixed;
        margin-bottom: 15px;
    }

    .invoice-print .info-box {
        display: table-cell;
        width: 50%;
        vertical-align: top;
        border: 1px solid #cbd5e1;
    }

    .invoice-print .info-box:first-child {
        border-right: 0;
    }

    .invoice-print .info-box-title {
        background: #eef2ff;
        color: #172554;
        padding: 7px 10px;
        font-weight: bold;
        font-size: 12px;
        border-bottom: 1px solid #cbd5e1;
    }

    .invoice-print .info-box-content {
        padding: 9px 10px;
        line-height: 1.9;
    }

    .invoice-print .info-box-content p {
        margin: 0;
        overflow-wrap: anywhere;
    }

    .invoice-print .info-box-content strong {
        display: inline-block;
        min-width: 105px;
    }

    /* Product Table */
    .invoice-print .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin: 12px 0 0;
        table-layout: auto;
    }

    .invoice-print .invoice-table thead {
        display: table-header-group;
    }

    .invoice-print .invoice-table th {
        background: #172554 !important;
        color: #fff !important;
        border: 1px solid #172554;
        padding: 9px 7px;
        font-size: 11px;
        font-weight: bold;
        text-align: left;
    }

    .invoice-print .invoice-table td {
        border: 1px solid #cbd5e1;
        padding: 8px 7px;
        font-size: 11px;
        vertical-align: middle;
    }

    .invoice-print .invoice-table tbody tr:nth-child(even) {
        background: #f8fafc !important;
    }

    .invoice-print .text-center {
        text-align: center !important;
    }

    .invoice-print .text-right {
        text-align: right !important;
    }

    /* Summary */
    .invoice-print .summary-wrapper {
        display: table;
        width: 100%;
        table-layout: fixed;
        margin-top: 15px;
    }

    .invoice-print .amount-words,
    .invoice-print .summary-area {
        display: table-cell;
        vertical-align: top;
    }

    .invoice-print .amount-words {
        width: 48%;
        padding: 12px;
        border: 1px dashed #94a3b8;
        line-height: 1.8;
    }

    .invoice-print .amount-words strong {
        color: #172554;
    }

    .invoice-print .summary-area {
        width: 52%;
        padding-left: 15px;
    }

    .invoice-print .summary-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .invoice-print .summary-table td {
        padding: 7px 10px;
        border-bottom: 1px solid #e2e8f0;
        font-size: 12px;
    }

    .invoice-print .summary-table td:last-child {
        text-align: right;
        font-weight: bold;
        white-space: nowrap;
    }

    .invoice-print .summary-table .net-row td {
        background: #172554 !important;
        color: #fff !important;
        font-size: 13px;
        font-weight: bold;
        padding: 10px;
        border: 0;
    }

    /* Opening & Payable */
    .invoice-print .payable-box {
        width: 100%;
        margin-top: 12px;
    }

    .invoice-print .payable-table {
        width: 52%;
        margin-left: auto;
        border-collapse: collapse;
    }

    .invoice-print .payable-table td {
        padding: 8px 10px;
        border: 1px solid #cbd5e1;
        font-size: 12px;
    }

    .invoice-print .payable-table td:last-child {
        text-align: right;
        font-weight: bold;
        white-space: nowrap;
    }

    .invoice-print .payable-table .payable-total td {
        background: #e0e7ff !important;
        color: #172554 !important;
        font-size: 14px;
        font-weight: bold;
    }

    /* Signature */
    .invoice-print .signature-section {
        display: table;
        width: 100%;
        table-layout: fixed;
        margin-top: 75px;
        page-break-inside: avoid;
    }

    .invoice-print .signature-item {
        display: table-cell;
        width: 33.33%;
        text-align: center;
        vertical-align: bottom;
        padding: 30px 10px 0;
    }

    .invoice-print .signature-line {
        border-top: 1px solid #333;
        padding-top: 7px;
        position: relative;
        font-size: 11px;
    }

    .invoice-print .staff-name {
        position: absolute;
        bottom: 20px;
        left: 0;
        right: 0;
        font-weight: bold;
        font-style: italic;
    }

    /* Footer */
    .invoice-print .print-footer {
        text-align: center;
        border-top: 1px solid #ddd;
        margin-top: 35px;
        padding-top: 10px;
        font-size: 10px;
        color: #666;
        page-break-inside: avoid;
    }

    .invoice-print .hotline {
        display: inline-block;
        background: #e2e8f0 !important;
        color: #172554 !important;
        padding: 6px 25px;
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    @media print {
        html,
        body {
            width: 100%;
            margin: 0 !important;
            padding: 0 !important;
            background: #fff !important;
        }

        .invoice-print {
            width: 100%;
            max-width: none;
            margin: 0;
            padding: 0;
        }

        .invoice-print .invoice-table tr,
        .invoice-print .summary-table tr,
        .invoice-print .payable-table tr {
            page-break-inside: avoid;
        }

        .invoice-print .company-header,
        .invoice-print .invoice-info,
        .invoice-print .summary-wrapper {
            page-break-inside: avoid;
        }

        .invoice-print .invoice-table th {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .invoice-print .invoice-table tbody tr:nth-child(even),
        .invoice-print .summary-table .net-row td,
        .invoice-print .payable-table .payable-total td,
        .invoice-print .hotline {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }
</style>

@php
    $hasDiscount = (float) $discount > 0;
    $hasTax = (float) $tax_amount > 0;
    $currency = '৳';
@endphp

<div class="invoice-print">

    {{-- Company Header --}}
    <div class="company-header">
        <div class="company-logo">
            @if(!empty($logo))
                <img src="{{ asset($logo) }}" alt="Company Logo">
            @endif
        </div>

        <div class="company-info">
            <h2>{{ $title }}</h2>

            @if(!empty($company))
                <p>{{ $company->address ?? '' }}</p>
                <p>
                    {{ $company->phone ?? '' }}
                    {{ !empty($company->email) ? ' | '.$company->email : '' }}
                </p>
                <p>{{ $company->website ?? '' }}</p>
            @else
                <p>{!! $informations !!}</p>
            @endif
        </div>
    </div>

    {{-- Invoice Title --}}
    <div class="invoice-title">
        <span>SALES INVOICE</span>
    </div>

    {{-- Invoice Information --}}
    <div class="invoice-info">

        <div class="info-box">
            <div class="info-box-title">INVOICE INFORMATION</div>

            <div class="info-box-content">
                <p><strong>Invoice No :</strong> {{ $data->invoice }}</p>
                <p><strong>Invoice Date :</strong> {{ date('d-m-Y', strtotime($data->date)) }}</p>
                <p><strong>Product Type :</strong> {{ $data->product_type }}</p>
            </div>
        </div>

        <div class="info-box">
            <div class="info-box-title">CUSTOMER INFORMATION</div>

            <div class="info-box-content">
                <p><strong>Client Name :</strong> {{ $data->client->name ?? 'N/A' }}</p>
                <p><strong>Contact :</strong> {{ $data->client->phone ?? 'N/A' }}</p>
                <p><strong>Address :</strong> {{ $data->client->address ?? 'N/A' }}</p>
            </div>
        </div>

    </div>

    {{-- Product Table --}}
    <table class="invoice-table">
        <thead>
            <tr>
                <th width="45" class="text-center">SL</th>
                <th>Product Name</th>

                @if($data->product_type != 'Consumer')
                    <th>Variant / SKU</th>
                @endif

                <th width="75" class="text-center">Quantity</th>
                <th width="90" class="text-right">Rate</th>
                <th width="105" class="text-right">Amount</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data->list as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>

                    @if($data->product_type == 'Consumer')
                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                    @else
                        <td>{{ $item->variant->product->name ?? 'N/A' }}</td>
                        <td>{{ $item->variant->sku ?? 'N/A' }}</td>
                    @endif

                    <td class="text-center">
                        {{ number_format($item->qty, 2) }}
                    </td>

                    <td class="text-right">
                        {{ number_format($item->rate, 2) }}
                    </td>

                    <td class="text-right">
                        {{ number_format($item->rate * $item->qty, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Amount Summary --}}
    <div class="summary-wrapper">

        <div class="amount-words">
            <strong>Amount in Words:</strong><br>
            {{ \App\HelperClass::convertNumber($net_amount) }} Taka Only
        </div>

        <div class="summary-area">
            <table class="summary-table">
                <tr>
                    <td>Total Amount</td>
                    <td>{{ $currency }} {{ number_format($total_amount, 2) }}</td>
                </tr>

                @if($hasDiscount)
                    <tr>
                        <td>Discount Amount</td>
                        <td>{{ $currency }} {{ number_format($discount, 2) }}</td>
                    </tr>
                @endif

                @if($hasTax)
                    <tr>
                        <td>
                            Tax ({{ rtrim(rtrim(number_format($tax_percent, 2, '.', ''), '0'), '.') }}%)
                        </td>
                        <td>{{ $currency }} {{ number_format($tax_amount, 2) }}</td>
                    </tr>
                @endif

                <tr class="net-row">
                    <td>Net Invoice Amount</td>
                    <td>{{ $currency }} {{ number_format($net_amount, 2) }}</td>
                </tr>
            </table>
        </div>

    </div>

    {{-- Opening & Net Payable --}}
    <div class="payable-box">
        <table class="payable-table">
            <tr>
                <td>Previous Opening Balance</td>
                <td>{{ $currency }} {{ number_format($opening, 2) }}</td>
            </tr>

            <tr class="payable-total">
                <td>Net Payable</td>
                <td>{{ $currency }} {{ number_format($payable, 2) }}</td>
            </tr>
        </table>
    </div>

    {{-- Signature --}}
    <div class="signature-section">

        <div class="signature-item">
            <div class="signature-line">
                <span class="staff-name">
                    {{ auth()->user()->name ?? '' }}
                </span>
                Prepared By
            </div>
        </div>

        <div class="signature-item">
            <div class="signature-line">
                <span class="staff-name">
                    {{ $data->staff->name ?? '' }}
                </span>
                Sales By
            </div>
        </div>

        <div class="signature-item">
            <div class="signature-line">
                Receive By
            </div>
        </div>

    </div>

    {{-- Footer --}}
    <div class="print-footer">

        @if(!empty($hotline))
            <div class="hotline">
                HOTLINE - {{ $hotline }}
            </div>
            <br>
        @endif

        <div>
            Software Designed & Developed by
            <strong>Technopark Bangladesh</strong>
            | www.technoparkbd.com
        </div>

    </div>

</div>

<script>
    window.addEventListener('load', function () {
        setTimeout(function () {
            window.print();
        }, 700);
    });
</script>
