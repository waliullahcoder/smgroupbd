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

        .staff {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
@endpush
@section('content')
    <table class="table mb-0 info-table" style="border: 2px solid black;">
        <tbody>
            <tr>
                <td style="border: none;" width="150px"><b>Vahical Number</b></td>
                <td style="border: none;" width="5px">:</td>
                <td style="border: none;">{{ @$data->vehicle->registration_no }}</td>
                <td style="border: none;" colspan="3"></td>
            </tr>
            <tr>
                <td style="border: none;" width="120px"><b>Driver Name</b></td>
                <td style="border: none;" width="15px">:</td>
                <td style="border: none;">{{ @$data->driver->name }}</td>
                <td style="border: none;" width="150px"><b>Serial No</b></td>
                <td style="border: none;" width="15px">:</td>
                <td style="border: none;">{{ $data->serial_no }}</td>
            </tr>
            <tr>
                <td style="border: none;" width="120px"><b>Drlivery Man</b></td>
                <td style="border: none;" width="15px">:</td>
                <td style="border: none;">{{ @$data->delivery_man->name }}</td>
                <td style="border: none;" width="150px"><b>Delivery Date</b></td>
                <td style="border: none;" width="15px">:</td>
                <td style="border: none;">{{ date('d-M-Y', strtotime($data->date)) }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table mb-3 info-table" style="border: 2px solid black; margin-top: -2px;">
        <thead>
            <tr>
                <th>SL#</th>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Amount</th>
                <th>Discount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ @$item->order->order_code }}</td>
                    <td>{{ @$item->order->user_name }}</td>
                    <td>{{ @$item->order->user_phone }}</td>
                    <td>{{ @$item->order->total }}</td>
                    <td>{{ @$item->order->discount }}</td>
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
                            <i class="staff">{{ auth()->user()->name }}</i>
                            <span>Prepared By</span>
                        </div>
                    </td>
                    <td style="border: none;">
                        <div class="signature-item">
                            <span>Store-in-Charge</span>
                        </div>
                    </td>
                    <td style="border: none;" width="33%">
                        <div class="signature-item">
                            <span>Security Check</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
