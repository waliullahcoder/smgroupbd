@extends('layouts.admin.print_app')
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
    <table class="table mb-2 header-table" style="border-bottom: 1px solid #ddd;">
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Client Name :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ $client->name }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Client Code :</b>
                <span class="d-inline-block" style="min-width: 130px;">{{ $client->code }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Address :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ $client->address }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Area :</b>
                <span class="d-inline-block" style="min-width: 130px;">{{ @$client->area->name }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Mobile :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ $client->phone }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block">{{ $header_title }}</b>
                <span class="d-inline-block"></span>
            </td>
        </tr>
    </table>

    <table class="table table-bordered table-condensed table-striped align-middle mb-3">
        <thead>
            <tr>
                <th class="text-center" width="40px">SL#</th>
                <th>Delivery Date</th>
                <th>Invoice Date</th>
                <th>Invoice</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_amount = 0;
            @endphp
            @foreach ($data as $row)
                <tr>
                    <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime(@$row->delivery->date)) }}</td>
                    <td>{{ date('d-m-Y', strtotime(@$row->sales->date)) }}</td>
                    <td>{{ $row->sales->invoice }}</td>
                    <td class="text-right">{{ number_format(@$row->sales->total_amount) }}</td>
                </tr>
                @php
                    $total_amount += @$row->sales->total_amount;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-right" colspan="4"><b>Total Summary</b></td>
                <td class="text-right" colspan="1"><b>{{ number_format($total_amount) }}</b></td>
            </tr>
        </tfoot>
    </table>
    <br>
    <div>
        <div class="signature-area">
            <div class="signature-item">
                <span>Prepared By</span>
            </div>
            <div class="signature-item">
                <span>Checked By</span>
            </div>
        </div>
    </div>
    <br>
    <div style="padding-top: 30px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
