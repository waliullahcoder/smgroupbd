@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr>
                <th class="text-center" width="50">SL#</th>
                <th>Date</th>
                <th>Payment No</th>
                <th>Collection Type</th>
                <th>Pay Mode</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td class="text-center" width="50">{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime($row->payment_date)) }}</td>
                    <td>{{ $row->payment_no }}</td>
                    <td>{{ $row->collection_type }}</td>
                    <td>{{ $row->payment_type }}</td>
                    <td>{{ $row->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
