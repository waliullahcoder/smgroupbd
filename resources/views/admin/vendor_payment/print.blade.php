
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
        margin: auto;
    }

    /* Company Header */
    .company-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding-bottom: 15px;
        border-bottom: 2px solid #26344a;
        margin-bottom: 25px;
        min-height: 100px;
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
        color: #26344a;
        margin: 0 0 7px;
        text-transform: uppercase;
    }

    .company-info p {
        font-size: 11px;
        margin: 3px 0;
        line-height: 1.5;
    }

    /* Receipt Title */
    .voucher-title {
        text-align: center;
        margin: 20px 0 25px;
    }

    .voucher-title h3 {
        display: inline-block;
        border: 2px solid #26344a;
        padding: 9px 35px;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin: 0;
        color: #26344a;
    }

    /* Payment Information */
    .payment-info {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 25px;
    }

    .payment-info td {
        padding: 10px 8px;
        border-bottom: 1px dashed #ccc;
        font-size: 12px;
    }

    .label {
        font-weight: 700;
        color: #26344a;
    }

    /* Received From */
    .section-heading {
        font-size: 13px;
        font-weight: 700;
        color: #26344a;
        margin: 20px 0 10px;
        padding-bottom: 7px;
        border-bottom: 1px solid #ddd;
        text-transform: uppercase;
    }

    .vendor-box {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .vendor-box h4 {
        font-size: 15px;
        margin: 0 0 6px;
        color: #222;
    }

    .vendor-box p {
        font-size: 11px;
        margin: 0;
        color: #555;
        line-height: 1.5;
    }

    /* Payment Details */
    .details-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .details-table td {
        border: 1px solid #ddd;
        padding: 12px 10px;
        font-size: 12px;
    }

    .details-table .detail-label {
        background: #f5f6f8 !important;
        font-weight: 700;
        width: 25%;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    /* Amount Highlight */
    .amount-box {
        margin-top: 25px;
        padding: 20px;
        text-align: center;
        background: #f1f4f8 !important;
        border: 1px solid #d9e0e9;
        border-left: 5px solid #26344a;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .amount-box span {
        display: block;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #555;
        text-transform: uppercase;
    }

    .amount-box h2 {
        font-size: 27px;
        color: #26344a;
        margin: 0;
        font-weight: 700;
    }

    /* Amount In Words */
    .amount-words {
        margin-top: 20px;
        padding: 13px;
        border: 1px dashed #bbb;
        font-size: 12px;
        line-height: 1.7;
    }

    /* Remarks */
    .remarks-box {
        margin-top: 18px;
        padding: 12px;
        background: #fafafa !important;
        border: 1px solid #eee;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .remarks-box strong {
        color: #26344a;
    }

    /* Signature */
    .signature-area {
        display: flex;
        justify-content: space-between;
        margin-top: 110px;
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
        display: flex;
        justify-content: space-between;
        border-top: 1px solid #ddd;
        padding-top: 10px;
        margin-top: 35px;
        font-size: 10px;
        color: #555;
    }

    @media print {
        body {
            margin: 0 !important;
            padding: 0 !important;
        }

        .no-print {
            display: none !important;
        }

        .company-header {
            display: flex !important;
        }

        .voucher-wrapper {
            width: 100%;
        }

        .details-table tr,
        .payment-info tr {
            page-break-inside: avoid;
        }
    }
</style>

<div class="voucher-wrapper">

    {{-- Company Header --}}
    <div class="company-header">

        {{-- Left Logo --}}
        <div class="company-logo">

            @if(!empty($data->company->logo))
                <img src="{{ asset($data->company->logo) }}"
                     alt="Company Logo">
            @elseif(!empty($company->logo))
                <img src="{{ asset($company->logo) }}"
                     alt="Company Logo">
            @endif

        </div>

        {{-- Right Company Information --}}
        <div class="company-info">

            <h2>
                {{ $data->company->name ?? $title }}
            </h2>

            <p>
                {{ $data->company->address ?? ($company->address ?? '') }}
            </p>

            <p>
                {{ $data->company->phone ?? ($company->phone ?? '') }}
                {{ !empty($company->email) ? ' | '.$company->email : '' }}
            </p>

            <p>
                {{ $company->website ?? '' }}
            </p>

        </div>

    </div>

    {{-- Receipt Title --}}
    <div class="voucher-title">
        <h3>{{ $report_title }}</h3>
    </div>

    {{-- Payment Information --}}
    <table class="payment-info">

        <tr>
            <td width="50%">
                <span class="label">Payment No :</span>
                {{ $data->payment_no }}
            </td>

            <td width="50%" class="text-right">
                <span class="label">Payment Date :</span>
                {{ date('d-m-Y', strtotime($data->payment_date)) }}
            </td>
        </tr>

    </table>

    {{-- Vendor Information --}}
    <div class="section-heading">
        Received From
    </div>

    <div class="vendor-box">

        <h4>
            {{ $data->vendor->name ?? 'N/A' }}
        </h4>

        <p>
            {{ $data->vendor->address ?? '' }}
        </p>

        @if(!empty($data->vendor->phone))
            <p>
                Phone: {{ $data->vendor->phone }}
            </p>
        @endif

    </div>

    {{-- Payment Details --}}
    <div class="section-heading">
        Payment Information
    </div>

    <table class="details-table">

        <tr>
            <td class="detail-label">
                Collection Type
            </td>

            <td>
                {{ $data->type ?? 'N/A' }}
            </td>

            <td class="detail-label">
                Payment Type
            </td>

            <td>
                {{ $data->payment_type ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="detail-label">
                Payment No
            </td>

            <td colspan="3">
                {{ $data->payment_no }}
            </td>
        </tr>

    </table>

    {{-- Amount Highlight --}}
    <div class="amount-box">

        <span>Total Paid Amount</span>

        <h2>
            BDT {{ number_format($data->amount, 2) }}/-
        </h2>

    </div>

    {{-- Amount In Words --}}
    <div class="amount-words">

        <strong>Amount In Words:</strong>

        {{ \App\HelperClass::convertNumber($data->amount) }}
        Taka Only.

    </div>

    {{-- Remarks --}}
    <div class="remarks-box">

        <strong>Remarks:</strong>

        {{ ucfirst($data->remarks ?? 'N/A') }}

    </div>

    {{-- Signature --}}
    <div class="signature-area">

        <div class="signature-item">
            <small>&nbsp;</small>
            Receive By
        </div>

        <div class="signature-item">

            <small>
                {{ $data->staff->name ?? '' }}
            </small>

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
