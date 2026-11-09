@extends('layouts.admin.print_app')
@push('css')
    <style>
        @media screen,
        print {
            table {
                width: 100%;
            }

            table td,
            table th {
                font-family: 'PT Serif', serif;
            }
        }

        .bottom {
            border-bottom: 1px solid #000000;
            vertical-align: text-bottom;
        }

        .signature-item {
            font-family: 'PT Serif', serif;
        }

        .staff {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            font-family: 'PT Serif', serif;
        }
    </style>
@endpush
@section('content')
    <br>
    <table width="100%" border="0">
        <tbody>
            <tr>
                <td width="90px"><span><b>Payment No</b></span></td>
                <td width="10px">:</td>
                <td>{{ $data->payment_no }}</td>
                <td align="right"><span><b>Date</b></span></td>
                <td align="right" width="10px">:</td>
                <td align="right" width="90px">{{ date('d-m-Y', strtotime($data->date)) }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table width="100%" border="0">
        <tr>
            <td width="110px"><b> Investor Name </b> </td>
            <td width="10px">:</td>
            <td class="bottom">{{ @$data->investor->name }}</td>
        </tr>
    </table>
    <br>
    <table width="100%">
        <tr>
            <td width="40px"><b>For</b> </td>
            <td width="10px">:</td>
            <td class="bottom" style="min-width: 200px;">Profit Distribution Payment</td>
            <td width="40px"><b>BDT</b> </td>
            <td width="10px">:</td>
            <td class="bottom">{{ round($data->amount, 2) }}/-</td>
        </tr>
    </table>
    <br>
    <table width="100%">
        <tr>
            <td width="110px"><b>Payment Type</b> </td>
            <td width="10px">:</td>
            <td class="bottom">{{ $data->deposit_type }}</td>
            <td width="70px"><b>Deposit to</b> </td>
            <td width="10px">:</td>
            <td class="bottom">
                @php
                    if ($data->deposit_type == 'Cash Payment') {
                        echo 'Cash Payment';
                    } elseif ($data->deposit_type == 'Bkash') {
                        echo $data->bkash;
                    } elseif ($data->deposit_type == 'Rocket') {
                        echo $data->rocket;
                    } elseif ($data->deposit_type == 'Nagad') {
                        echo $data->nagad;
                    } elseif ($data->deposit_type == 'Bank Deposit') {
                        echo $data->bank_account;
                    }
                @endphp
            </td>
        </tr>
    </table>
    <br>
    <table width="100%">
        <tr>
            <td width="70px"><b>In Words</b> </td>
            <td width="10px">:</td>
            <td class="bottom"> {{ \App\HelperClass::convertNumber($data->amount) }} taka only </td>
        </tr>
    </table>
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
