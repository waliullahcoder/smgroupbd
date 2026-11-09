@extends('layouts.admin.print_app')
@push('css')
    <style>
        @media print {
            table {
                width: 100%;
            }
        }

        .bottom {
            border-bottom: 1px solid #000000;
            vertical-align: text-bottom;
        }
    </style>
@endpush
@section('content')
    <br>
    <table width="100%" border="0">
        <tbody>
            <tr>
                <td width="100px"><span><b>Payment No</b></span></td>
                <td width="10px">:</td>
                <td>{{ $data->payment_no }}</td>
                <td align="right"><span><b>Date</b></span></td>
                <td align="right" width="10px">:</td>
                <td align="right" width="90px">{{ date('d-m-Y', strtotime($data->payment_date)) }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table width="100%" border="0">
        <tr>
            <td width="120px"><strong> Cash Received </strong> </td>
            <td width="10px">:</td>
            <td class="bottom">{{ $data->vendor->name }}
                ({{ $data->vendor->address }})</td>
        </tr>
    </table>
    <br>
    <table width="100%">
        <tr>
            <td width="40px"><strong>For</strong> </td>
            <td width="10px">:</td>
            <td class="bottom">{{ ucfirst($data->remarks) }}</td>
            <td width="40px"><strong>BDT</strong> </td>
            <td width="10px">:</td>
            <td class="bottom">{{ round($data->amount, 2) }}/-</td>
        </tr>
    </table>
    <br>
    <table width="100%">
        <tr>
            <td width="130px"><strong>Collection Type</strong> </td>
            <td width="10px">:</td>
            <td class="bottom">{{ $data->type }}</td>
            <td width="130px"><strong>Payment Type</strong> </td>
            <td width="10px">:</td>
            <td class="bottom">{{ $data->payment_type }}</td>
        </tr>
    </table>
    <br>
    <table width="100%">
        <tr>
            <td width="80px"><strong>In Words</strong> </td>
            <td width="10px">:</td>
            <td class="bottom">
                <b>In words : {{ \App\HelperClass::convertNumber($data->amount) }} taka.</b>
                Taka Only
            </td>
        </tr>
    </table>
    <div>
        <div class="signature-area">
            <div class="signature-item">
                <span>Receive By</span>
            </div>
            <div class="signature-item">
                <i class="staff">{{ $data->staff->name }}</i>
                <span>Prepare By</span>
            </div>
        </div>
    </div>
    <div style="padding-top: 50px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
