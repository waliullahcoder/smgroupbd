@php
    $netAmount = $data->net_amount ?? ($data->total_amount - $data->discount);
    $taxPct = rtrim(rtrim(number_format($data->tax_percentage ?? 0, 2), '0'), '.');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quotation - {{ $data->quotation }}</title>

    <style>
        @page { size: A4; margin: 10mm; }

        :root {
            --brand: #1f4e79;
            --brand-light: #eef3f8;
            --line: #d5dce4;
            --text: #222;
            --muted: #6b7785;
        }

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        body {
            margin: 0;
            background: #fff;
            font-family: 'PT Serif', Georgia, serif;
            color: var(--text);
            font-size: 13px;
            line-height: 1.5;
        }

        .quotation-page {
            max-width: 210mm;
            margin: 0 auto;
            padding: 10mm;
        }

        /* ---------- Header ---------- */
        .q-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding-bottom: 14px;
            border-bottom: 3px solid var(--brand);
        }
        .q-logo { flex: 0 0 auto; }
        .q-logo img { max-height: 80px; max-width: 220px; object-fit: contain; }
        .q-logo .logo-text { font-size: 26px; font-weight: bold; color: var(--brand); }

        .q-company { text-align: right; }
        .q-company h2 {
            margin: 0 0 4px;
            font-size: 22px;
            font-weight: bold;
            color: var(--brand);
        }
        .q-company p { margin: 0; color: var(--muted); font-size: 12.5px; }

        /* ---------- Title ---------- */
        .q-title-wrap { text-align: center; margin: 16px 0 14px; }
        .q-title {
            display: inline-block;
            padding: 5px 40px;
            background: var(--brand);
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 4px;
            border-radius: 3px;
        }

        /* ---------- Info boxes ---------- */
        .q-info { display: flex; gap: 14px; margin-bottom: 14px; }
        .q-box {
            flex: 1;
            border: 1px solid var(--line);
            border-radius: 4px;
            overflow: hidden;
        }
        .q-box-head {
            background: var(--brand-light);
            color: var(--brand);
            font-weight: bold;
            padding: 4px 12px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid var(--line);
        }
        .q-box-body { padding: 8px 12px; }
        .q-row { display: flex; padding: 2px 0; }
        .q-row .label { width: 105px; color: var(--muted); flex: 0 0 105px; }
        .q-row .value { flex: 1; font-weight: 600; }

        /* ---------- Items ---------- */
        .q-table { width: 100%; border-collapse: collapse; }
        .q-table thead th {
            background: var(--brand);
            color: #fff;
            padding: 7px 10px;
            font-weight: bold;
            font-size: 12.5px;
            border: 1px solid var(--brand);
        }
        .q-table tbody td {
            padding: 6px 10px;
            border: 1px solid var(--line);
        }
        .q-table tbody tr:nth-child(even) td { background: #f8fafc; }
        .q-table tr { page-break-inside: avoid; }

        .text-center { text-align: center; }
        .text-right { text-align: right; }

        /* ---------- Totals ---------- */
        .q-bottom {
            display: flex;
            gap: 14px;
            margin-top: 12px;
            align-items: flex-start;
            page-break-inside: avoid;
        }
        .q-words {
            flex: 1;
            border: 1px dashed var(--line);
            border-radius: 4px;
            padding: 8px 12px;
        }
        .q-words .label {
            color: var(--muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .q-totals {
            width: 300px;
            border: 1px solid var(--line);
            border-radius: 4px;
            overflow: hidden;
        }
        .q-totals .t-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 12px;
            border-bottom: 1px solid var(--line);
        }
        .q-totals .t-row:last-child { border-bottom: 0; }
        .q-totals .t-row.net {
            background: var(--brand);
            color: #fff;
            font-weight: bold;
            font-size: 14px;
        }

        /* ---------- Note ---------- */
        .q-note {
            margin-top: 14px;
            border-left: 4px solid var(--brand);
            background: var(--brand-light);
            padding: 8px 12px;
            border-radius: 0 4px 4px 0;
        }

        /* ---------- Signature / Footer ---------- */
        .q-footer { margin-top: 70px; page-break-inside: avoid; }
        .q-sign { display: flex; justify-content: space-between; gap: 30px; }
        .q-sign .sign-item {
            flex: 1;
            text-align: center;
            position: relative;
            border-top: 1px solid #000;
            padding-top: 4px;
        }
        .q-sign .sign-item .staff {
            position: absolute;
            top: -24px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            font-style: italic;
        }
        .q-hotline {
            margin-top: 16px;
            background: #ddd;
            text-align: center;
            font-weight: bold;
            padding: 5px;
        }
        .q-credit {
            margin-top: 8px;
            text-align: center;
            font-size: 11px;
            color: var(--muted);
        }

        @media print {
            .quotation-page { padding: 0; max-width: none; }
        }
    </style>
</head>
<body>

<div class="quotation-page">

    {{-- ===== Header: Logo (left) + Company info (right) ===== --}}
    <div class="q-header">
        <div class="q-logo">
            @if (!empty($data->company_logo))
                <img src="{{ asset($data->company_logo) }}" alt="{{ $data->company_name }}">
            @else
                <span class="logo-text">{{ $data->company_name }}</span>
            @endif
        </div>

        <div class="q-company">
            <h2>{{ $data->company_name }}</h2>
            @if (!empty($data->company_address))
                <p>{{ $data->company_address }}</p>
            @endif
            @if (!empty($data->company_phone))
                <p>Phone: {{ $data->company_phone }}</p>
            @endif
            @if (!empty($data->company_email))
                <p>Email: {{ $data->company_email }}</p>
            @endif
        </div>
    </div>

    {{-- ===== Title ===== --}}
    <div class="q-title-wrap">
        <span class="q-title">QUOTATION</span>
    </div>

    {{-- ===== Info ===== --}}
    <div class="q-info">
        <div class="q-box">
            <div class="q-box-head">Quotation To</div>
            <div class="q-box-body">
                <div class="q-row">
                    <span class="label">Party Name</span>
                    <span class="value">{{ $data->name }}</span>
                </div>
                @if (!empty($data->project_name))
                    <div class="q-row">
                        <span class="label">Project</span>
                        <span class="value">{{ $data->project_name }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="q-box">
            <div class="q-box-head">Quotation Details</div>
            <div class="q-box-body">
                <div class="q-row">
                    <span class="label">Quotation No</span>
                    <span class="value">{{ $data->quotation }}</span>
                </div>
                <div class="q-row">
                    <span class="label">Date</span>
                    <span class="value">{{ date('d M, Y', strtotime($data->date)) }}</span>
                </div>
                <div class="q-row">
                    <span class="label">Staff</span>
                    <span class="value">{{ $data->staff_name }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Items ===== --}}
    <table class="q-table">
        <thead>
            <tr>
                <th class="text-center" width="40">SL#</th>
                <th width="110">Code</th>
                <th>Product Name</th>
                <th class="text-center" width="70">Qty</th>
                <th class="text-right" width="90">Rate</th>
                <th class="text-right" width="110">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotation_details as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="text-center">{{ rtrim(rtrim(number_format($item->qty, 2, '.', ''), '0'), '.') }}</td>
                    <td class="text-right">{{ number_format($item->rate, 2) }}</td>
                    <td class="text-right">{{ number_format($item->rate * $item->qty, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ===== Totals ===== --}}
    <div class="q-bottom">
        <div class="q-words">
            <div class="label">In Words</div>
            <div><b>{{ \App\HelperClass::convertNumber($netAmount) }} Taka Only</b></div>
        </div>

        <div class="q-totals">
            <div class="t-row">
                <span>Total Amount</span>
                <span>{{ number_format($data->total_amount, 2) }}</span>
            </div>

            @if ($data->discount > 0)
                <div class="t-row">
                    <span>Discount</span>
                    <span>- {{ number_format($data->discount, 2) }}</span>
                </div>
            @endif

            @if (($data->tax_amount ?? 0) > 0)
                <div class="t-row">
                    <span>VAT & Tax ({{ $taxPct }}%)</span>
                    <span>{{ number_format($data->tax_amount, 2) }}</span>
                </div>
            @endif

            <div class="t-row net">
                <span>Net Payable</span>
                <span>{{ number_format($netAmount, 2) }} TK.</span>
            </div>
        </div>
    </div>

    {{-- ===== Note ===== --}}
    @if (!empty($data->note))
        <div class="q-note">
            <b>Note :</b> {!! nl2br(e($data->note)) !!}
        </div>
    @endif

    {{-- ===== Signature / Footer ===== --}}
    <div class="q-footer">
        <div class="q-sign">
            <div class="sign-item">
                <i class="staff">{{ $data->created_by_name }}</i>
                <span>Prepared By</span>
            </div>
            <div class="sign-item">
                <i class="staff">{{ $data->staff_name }}</i>
                <span>Approved By</span>
            </div>
            <div class="sign-item">
                <span>Received By</span>
            </div>
        </div>

        @isset($hotline)
            <div class="q-hotline">HOTLINE - {{ $hotline }}</div>
        @endisset

        <div class="q-credit">
            Software Designed & Developed by Technopark Bangladesh (visit : www.technoparkbd.com)
        </div>
    </div>

</div>
    <script>
        window.addEventListener('load', function () {
            window.print();
        });
    </script>

</body>
</html>