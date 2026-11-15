
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $report_title ?? 'Money Receipt' }}</title>

    <style>
     
@page {
    size: A4 portrait;
    margin: 15mm;
}

* {
    box-sizing: border-box;
}

html,
body {
    margin: 0;
    padding: 0;
    width: 100%;
    background: #f1f3f5;
    color: #222;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
}

.receipt-print {
    width: 100%;
    max-width: 800px;
    min-height: 500px;
    margin: 25px auto;
    padding: 30px;
    background: #fff;
    border: 1px solid #ddd;
}

/* Company Header */
.company-header {
    display: table;
    width: 100%;
    table-layout: fixed;
    padding-bottom: 18px;
    border-bottom: 2px solid #172554;
}

.company-logo,
.company-info {
    display: table-cell;
    vertical-align: middle;
}

.company-logo {
    width: 25%;
    text-align: left;
}

.company-logo img {
    display: block;
    max-width: 140px;
    max-height: 85px;
    width: auto;
    height: auto;
    object-fit: contain;
}

.company-info {
    width: 75%;
    text-align: right;
    overflow-wrap: anywhere;
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
    color: #555;
}

/* Receipt Heading */
.receipt-heading {
    text-align: center;
    margin: 22px 0;
}

.receipt-heading h3 {
    display: inline-block;
    margin: 0;
    padding: 9px 35px;
    border: 1px solid #172554;
    border-radius: 4px;
    color: #172554;
    font-size: 19px;
    letter-spacing: 2px;
    text-transform: uppercase;
}

/* Receipt Number & Date */
.receipt-meta {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
    margin-bottom: 22px;
}

.receipt-meta td {
    width: 50%;
    padding: 7px 5px;
    font-size: 13px;
    vertical-align: middle;
}

.receipt-meta .right {
    text-align: right;
}

.label {
    font-weight: bold;
    color: #333;
    white-space: nowrap;
}

/* Receipt Body */
.receipt-body {
    width: 100%;
    border: 1px solid #d5dbe5;
    border-radius: 5px;
    padding: 20px;
}

.info-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

.info-table td {
    padding: 12px 7px;
    border-bottom: 1px dashed #cbd5e1;
    vertical-align: middle;
    line-height: 1.6;
    overflow-wrap: anywhere;
}

.info-table tr:last-child td {
    border-bottom: none;
}

.info-table .field {
    width: 145px;
    font-weight: bold;
    color: #334155;
}

.info-table .colon {
    width: 15px;
    text-align: center;
}

/* Amount Box */
.amount-box {
    width: 100%;
    margin: 20px 0;
    padding: 16px;
    text-align: center;
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    border-radius: 5px;
}

.amount-box span {
    display: block;
    color: #475569;
    font-size: 12px;
    margin-bottom: 7px;
}

.amount-box h2 {
    margin: 0;
    color: #172554;
    font-size: 27px;
}

/* Amount In Words */
.amount-words {
    margin-top: 15px;
    padding: 12px 5px;
    border-bottom: 1px dashed #999;
    line-height: 1.8;
    overflow-wrap: anywhere;
}

/* Signature */
.signature-area {
    display: table;
    width: 100%;
    table-layout: fixed;
    margin-top: 85px;
}

.signature-item {
    display: table-cell;
    width: 50%;
    text-align: center;
    vertical-align: bottom;
}

.signature-item span {
    display: inline-block;
    min-width: 150px;
    padding-top: 8px;
    border-top: 1px solid #333;
    font-size: 12px;
    font-weight: bold;
}

.signature-item .staff-name {
    display: block;
    margin: 0 auto 5px;
    padding: 0;
    border: none;
    font-size: 12px;
    font-weight: bold;
}

/* Footer */
.print-footer {
    margin-top: 35px;
    padding-top: 10px;
    border-top: 1px solid #ddd;
    text-align: center;
    color: #777;
    font-size: 10px;
    line-height: 1.7;
}

/* Screen Responsive */
@media screen and (max-width: 600px) {
    .receipt-print {
        margin: 0;
        padding: 15px;
        border: none;
    }

    .company-logo {
        width: 30%;
    }

    .company-info {
        width: 70%;
    }

    .company-logo img {
        max-width: 90px;
    }

    .company-info h2 {
        font-size: 16px;
    }

    .company-info p {
        font-size: 10px;
    }

    .receipt-body {
        padding: 10px;
    }

    .info-table .field {
        width: 115px;
    }

    .signature-area {
        margin-top: 60px;
    }
}

/* Print Settings */
@media print {
    html,
    body {
        width: 100%;
        background: #fff !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .receipt-print {
        width: 100%;
        max-width: 100%;
        min-height: auto;
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
    }

    .no-print {
        display: none !important;
    }

    .company-header,
    .receipt-body,
    .amount-box,
    .signature-area,
    .print-footer {
        break-inside: avoid;
        page-break-inside: avoid;
    }
}

    </style>
</head>

<body>

<div class="receipt-print">

    <!-- Company Header -->
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


    <!-- Receipt Title -->
    <div class="receipt-heading">
        <h3>Money Receipt</h3>
    </div>

    <!-- Receipt Number & Date -->
    <table class="receipt-meta">
        <tr>
            <td>
                <span class="label">Receipt No:</span>
                {{ $data->payment_no }}
            </td>

            <td class="right">
                <span class="label">Date:</span>
                {{ $data->payment_date ? date('d-m-Y', strtotime($data->payment_date)) : '' }}
            </td>
        </tr>
    </table>

    <div class="receipt-body">

        <!-- Receipt Information -->
        <table class="info-table">

            <tr>
                <td class="field">Cash Received From</td>
                <td class="colon">:</td>
                <td>
                    <strong>{{ $data->client->name ?? 'N/A' }}</strong>
                    @if(!empty($data->client->address))
                        <br>
                        <small>{{ $data->client->address }}</small>
                    @endif
                </td>
            </tr>

            <tr>
                <td class="field">Collection For</td>
                <td class="colon">:</td>
                <td>{{ ucfirst($data->remarks ?? 'Payment Received') }}</td>
            </tr>

            <tr>
                <td class="field">Collection Type</td>
                <td class="colon">:</td>
                <td>{{ $data->collection_type ?? 'N/A' }}</td>
            </tr>

            <tr>
                <td class="field">Payment Method</td>
                <td class="colon">:</td>
                <td>{{ $data->payment_type ?? 'N/A' }}</td>
            </tr>

        </table>

        <!-- Received Amount -->
        <div class="amount-box">
            <span>Received Amount</span>
            <h2>৳ {{ number_format((float) $data->amount, 2) }}</h2>
        </div>

        <!-- Amount In Words -->
        <div class="amount-words">
            <strong>In Words:</strong>
            {{ \App\HelperClass::convertNumber($data->amount) }} Taka Only
        </div>

    </div>

    <!-- Signature -->
    <div class="signature-area">

        <div class="signature-item">
            <span>Received By</span>
        </div>

        <div class="signature-item">
            <span class="staff-name">
                {{ $data->staff->name ?? '' }}
            </span>
            <span>Prepared By</span>
        </div>

    </div>

    <!-- Footer -->
    <div class="print-footer">
        Print Date & Time:
        {{ date('d-m-Y h:i:s A') }}
        <br>
        Thank you for your payment.
    </div>

</div>

<script>
    window.addEventListener('load', function () {
        setTimeout(function () {
            window.print();
        }, 700);
    });
</script>

</body>
</html>
