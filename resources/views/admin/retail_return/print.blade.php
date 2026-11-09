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
                <b class="d-inline-block" style="min-width: 100px;">Voucher No :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ $data->return_no }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Customer Name :</b>
                <span class="d-inline-block" style="min-width: 130px;">{{ @$data->client_name }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Return Date :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ date('d-m-Y', strtotime($data->date)) }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Store :</b>
                <span class="d-inline-block" style="min-width: 130px;">{{ @$data->store->name }}</span>
            </td>
        </tr>
    </table>

    <table class="table table-bordered table-condensed table-striped align-middle mb-3">
        <thead>
            <tr class="text-nowrap">
                <th class="text-center" width="30">SL#</th>
                <th>Product Name</th>
                <th class="text-right">Rate</th>
                <th class="text-right">Quantity</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->list as $row)
                <tr>
                    <td class="text-center" width="30"><b>{{ $loop->iteration }}</b></td>
                    <td>{{ $row->product->name }}</td>
                    <td class="text-right">{{ number_format($row->price, 2) }}</td>
                    <td class="text-right">{{ number_format($row->qty) }}</td>
                    <td class="text-right">{{ number_format($row->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mb-3">
        <b>In words :</b> {{ \App\HelperClass::convertNumber($data->amount) }} taka.
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
