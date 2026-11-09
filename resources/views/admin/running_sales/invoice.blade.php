@extends('layouts.admin.invoice_app')
@push('css')
    <style>
        @page {
            size: a4;
        }

        .info-table thead {
            background-color: #fff;
            color: #333;
        }

        .info-table thead th {
            border-bottom: 2px solid #000 !important;
            border-right: 2px dotted #888;
        }

        .info-table tfoot td,
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

        .info-table th,
        .info-table td,
        .header-table td {
            line-height: 1;
            padding: 3px 12px 1px !important;
            font-family: 'PT Serif', serif;
            font-weight: normal;
        }

        .info-table th,
        .info-table td {
            padding: 0px 12px 5px !important;
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
    <div class="content-wrapper">
        <table class="table mb-0 header-table" style="border: 2px solid black;">
            <tr>
                <td>
                    <b class="d-inline-block" style="min-width: 100px;">Invoice No :</b>
                    <span class="d-inline-block" style="min-width: 200px;">{{ $data->invoice }}</span>
                </td>
                <td class="text-right">
                    <b class="d-inline-block text-left">Invoice Date :</b>
                    <span class="d-inline-block" style="min-width: 130px;">{{ date('d-m-Y', strtotime($data->date)) }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <b class="d-inline-block" style="min-width: 100px;">Client Name :</b>
                    <span class="d-inline-block" style="min-width: 200px;">{{ @$data->client->name }}</span>
                </td>
                <td class="text-right">
                    <b class="d-inline-block text-left">Contact Number :</b>
                    <span class="d-inline-block" style="min-width: 130px;">{{ @$data->client->phone }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b class="d-inline-block" style="min-width: 100px;">Address :</b>
                    <span class="d-inline-block" style="min-width: 200px;">{{ @$data->client->address }}</span>
                </td>
            </tr>
        </table>
        <table class="table info-table align-middle" style="border: 2px solid black; margin-top: -2px; margin-bottom: 5px;">
            <thead>
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Product Name</th>
                    <th>Variant</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th width="70px" class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->list as $item)
                    <tr>
                        <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                        <td>{{ @$item->variant->product->name }}</td>
                        <td>{{ @$item->variant->sku }}</td>
                        <td>{{ @$item->qty }}</td>
                        <td>{{ number_format($item->rate, 2, '.', ',') }}</td>
                        <td class="text-right" width="70px">{{ number_format($item->rate * $item->qty, 2, '.', ',') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" rowspan="3"><b>In words :</b>
                        {{ \App\HelperClass::convertNumber($data->total_amount - $data->discount) }} Taka
                        Only</td>
                    <td class="text-right" colspan="2"><b>Total Amount :</b></td>
                    <td class="text-right" width="70px">{{ number_format($data->total_amount, 2, '.', ',') }}</td>
                </tr>
                @if ($data->discount > 0)
                    <tr>
                        <td class="text-right" colspan="2"><b>Discount Amount :</b></td>
                        <td class="text-right" width="70px">{{ number_format($data->discount, 2, '.', ',') }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="text-right" colspan="2"><b>Net Invoice Amount :</b></td>
                    <td class="text-right" width="70px">
                        {{ number_format($data->total_amount - $data->discount, 2, '.', ',') }}</td>
                </tr>
            </tfoot>
        </table>
        <table class="table mb-0 info-table align-middle" style="border: 2px solid black;">
            <tbody>
                <tr>
                    <td class="text-right" colspan="5"><b>Opening :</b></td>
                    <td class="text-right" width="70px">{{ number_format($opening, 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <td class="text-right" colspan="5"><b>Net Payable :</b></td>
                    @php
                        $payable = $opening + $data->total_amount - $data->discount;
                    @endphp
                    <td class="text-right" width="70px">{{ number_format($payable, 2, '.', ',') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <footer class="print-footer">
        <div>
            <table class="table mb-0 border-0">
                <tbody>
                    <tr>
                        <td style="border: none;" width="33%">
                            <div class="signature-item">
                                <i class="staff">{{ auth()->user()->name }}</i>
                                <span>Prepared By</span>
                            </div>
                        </td>
                        <td style="border: none;">
                            <div class="signature-item">
                                <i class="staff">{{ @$data->staff->name }}</i>
                                <span>Sales By</span>
                            </div>
                        </td>
                        <td style="border: none;" width="33%">
                            <div class="signature-item">
                                <span>Receive By</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @isset($hotline)
            <h4 class="report-title mb-2" style="background-color: #ddd;">HOTLINE - {{ $hotline }}</h4>
        @endisset
        <div>Software Designed & Developed by Technopark Bangladesh (visit :
            wwww.technoparkbd.com)</div>
    </footer>
@endsection
