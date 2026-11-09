@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr>
                <th class="text-center" width="50">SL#</th>
                <th>Date</th>
                <th>Category</th>
                <th>Product</th>
                <th>Product Code</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td class="text-center" width="50">{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime($row->return->date)) }}</td>
                    <td>{{ @$row->product->category->name }}</td>
                    <td>{{ @$row->product->name }}</td>
                    <td>{{ @$row->product->code }}</td>
                    <td>{{ $row->qty }}</td>
                    <td>{{ $row->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
