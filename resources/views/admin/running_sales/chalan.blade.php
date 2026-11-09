@extends('layouts.admin.invoice_app')
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
    <table class="table mb-0 header-table" style="border: 2px solid black;">
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Outlet Name :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ @$data->client->name }}</span>
            </td>
            <td class="text-right">
            </td>
        </tr>
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Contact :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ @$data->client->phone }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Chalan No :</b>
                <span class="d-inline-block" style="min-width: 130px;">{{ $data->invoice }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">Address :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ @$data->client->address }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">Date :</b>
                <span class="d-inline-block" style="min-width: 130px;">{{ date('d-M-Y', strtotime($data->date)) }}</span>
            </td>
        </tr>
    </table>
    <table class="table mb-3 info-table" style="border: 2px solid black; margin-top: -2px;">
        <thead>
            <tr>
                <th class="text-center" width="40px">SL#</th>
                <th>Description of Goods</th>
                <th>Item Code</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->list as $item)
                <tr>
                    <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                    <td>{{ @$item->product->name }}</td>
                    <td>{{ @$item->product->code }}</td>
                    {{-- @php
                        $ctn = floor($item->qty / $item->product->ctn_size);
                        $ctn_sizes = $ctn * $item->product->ctn_size;
                        $extra = $item->qty - $ctn_sizes;
                    @endphp --}}
                    {{-- <td>{{ $ctn . ' CTN ' . ($extra > 0 ? $extra . ' ' . @$item->product->attribute->name : '') }}</td> --}}
                    <td>{{ $item->qty }} ({{ $item->product->attribute->name }})</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding-top: 50px;">
        <table class="table mb-0 border-0">
            <tbody>
                <tr>
                    <td style="border: none;" width="33%">
                        <div class="signature-item">
                            <i class="staff">{{ @$data->staff->name }}</i>
                            <span>Prepared By</span>
                        </div>
                    </td>
                    <td style="border: none;">
                        <div class="signature-item">
                            <i class="staff">{{ Auth::user()->name }}</i>
                            <span>Checked By</span>
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
@endsection
