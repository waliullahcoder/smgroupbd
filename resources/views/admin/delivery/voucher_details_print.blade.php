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
            top: -32px;
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

        .info-table tfoot th {
            border-top: 2px solid #000 !important;
            border-right: 2px dotted #888;
        }
    </style>
@endpush
@section('content')
    <table class="table mb-0 header-table" style="border: 2px solid black;">
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Vahical Number :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ @$data->vehicle->registration_no }}</span>
            </td>
            <td class="text-right">
            </td>
        </tr>
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Driver Name :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ @$data->driver->name }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Serial No :</b>
                <span class="d-inline-block" style="min-width: 130px;">{{ $data->serial_no }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Delivery Man :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ @$data->delivery_man->name }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Delivery Date :</b>
                <span class="d-inline-block" style="min-width: 130px;">{{ date('d-M-Y', strtotime($data->date)) }}</span>
            </td>
        </tr>
    </table>
    <table class="table mb-3 info-table" style="border: 2px solid black; margin-top: -2px;">
        <thead>
            <tr>
                <th class="text-center" width="40px">SL#</th>
                <th>Invoice No</th>
                <th>Client Name</th>
                <th>Bill Amount</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                    <td>{{ $item->sales->invoice }}</td>
                    <td>{{ @$item->sales->client->name }}</td>
                    <td>{{ number_format($item->total_amount, 2, '.', ',') }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right" colspan="3">Total</th>
                <th>{{ number_format($items->sum('total_amount'), 2, '.', ',') }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 50px;">
        <table class="table mb-0 border-0">
            <tbody>
                <tr>
                    <td style="border: none;" width="33%">
                        <div class="signature-item">
                            <span>Delivery Man</span>
                        </div>
                    </td>
                    <td style="border: none;">
                        <div class="signature-item">
                            <span>Account</span>
                        </div>
                    </td>
                    <td style="border: none;" width="33%">
                        <div class="signature-item">
                            <span>Admin</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
