@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr>
                <th class="text-right" colspan="5">Previous Balance</th>
                <th class="text-right">{{ number_format($previous_balance, 2) }}</th>
            </tr>
            <tr>
                <th class="text-center" width="40px">Sl#</th>
                <th>Date</th>
                <th>Description</th>
                <th class="text-right">Amount In</th>
                <th class="text-right">Amount Out</th>
                <th class="text-right">Balance</th>
            </tr>
        </thead>
        <tbody>
            @php
                $balance = $previous_balance;
                $amount_in = 0;
                $amount_out = 0;
            @endphp
            @foreach ($data as $row)
                <tr>
                    @php
                        $balance += $row->amount_in - $row->amount_out;
                        $amount_in += $row->amount_in;
                        $amount_out += $row->amount_out;
                    @endphp
                    <td class="text-center px-3">{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime($row->date)) }}</td>
                    <td>{{ $row->type }}</td>
                    <td class="text-right">{{ number_format($row->amount_in, 2) }}</td>
                    <td class="text-right">{{ number_format($row->amount_out, 2) }}</td>
                    <td class="text-right">{{ number_format($balance, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Total</th>
                <th class="text-right">{{ number_format($amount_in, 2) }}</th>
                <th class="text-right">{{ number_format($amount_out, 2) }}</th>
                <th class="text-right">{{ number_format($balance, 2) }}</th>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
