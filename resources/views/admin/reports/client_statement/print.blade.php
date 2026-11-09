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
    <table class="table mb-2 header-table" style="border-bottom: 1px solid #ddd;">
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Client Name :</b>
                <span class="d-inline-block" style="min-width: 200px; font-weight: normal;">{{ $client->name }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Client Code :</b>
                <span class="d-inline-block" style="min-width: 130px; font-weight: normal;">{{ $client->code }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Address :</b>
                <span class="d-inline-block" style="min-width: 200px; font-weight: normal;">{{ $client->address }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Area :</b>
                <span class="d-inline-block"
                    style="min-width: 130px; font-weight: normal;">{{ @$client->area->name }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Mobile :</b>
                <span class="d-inline-block" style="min-width: 200px; font-weight: normal;">{{ $client->phone }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block">{{ $header_title }}</b>
                <span class="d-inline-block"></span>
            </td>
        </tr>
    </table>

    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr>
                <th colspan="7" class="text-right px-3">Previous Balance</th>
                <th class="text-right px-3">{{ number_format($data['previousBalance'], 2, '.', ',') }}</th>
            </tr>
            <tr>
                <th class="text-center" width="40px">Sl#</th>
                <th>Date</th>
                <th>Voucher</th>
                <th>Particulars</th>
                <th class="text-right">Sales</th>
                <th class="text-right">Collection</th>
                <th class="text-right">Return</th>
                <th class="text-right">Balance</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalSales = 0;
                $totalCollections = 0;
                $totalReturns = 0;
                $balance = $data['previousBalance'];
            @endphp
            @foreach ($data['statements'] as $statement)
                <tr>
                    <td class="text-center px-3">{{ $loop->iteration }}</td>
                    <td>{{ $statement['date'] }}</td>
                    <td>{{ $statement['invoice'] }}</td>
                    <td>{{ $statement['particulars'] }}</td>
                    <td class="text-right px-3">{{ number_format($statement['sales'], 2, '.', ',') }}</td>
                    <td class="text-right px-3">{{ number_format($statement['collection'], 2, '.', ',') }}</td>
                    <td class="text-right px-3">{{ number_format($statement['return'], 2, '.', ',') }}</td>
                    <td class="text-right px-3">{{ number_format($statement['balance'], 2, '.', ',') }}</td>
                </tr>
                @php
                    $totalSales += $statement['sales'];
                    $totalCollections += $statement['collection'];
                    $totalReturns += $statement['return'];
                    $balance = $statement['balance'];
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right px-3">Total Summary</th>
                <th class="text-right px-3">{{ number_format($totalSales, 2, '.', ',') }}</th>
                <th class="text-right px-3">{{ number_format($totalCollections, 2, '.', ',') }}</th>
                <th class="text-right px-3">{{ number_format($totalReturns, 2, '.', ',') }}</th>
                <th class="text-right px-3">{{ number_format($balance, 2, '.', ',') }}</th>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
