@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr>
                <th class="text-center" width="50">SL#</th>
                <th>Date</th>
                <th>Invoice</th>
                <th>Sales Type</th>
                <th>Products</th>
                <th>Amount</th>
                <th>Discount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td class="text-center" width="50">{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime($row->date)) }}</td>
                    <td>{{ $row->invoice }}</td>
                    <td>{{ $row->sales_type }}</td>
                    <td>
                        @foreach ($row->list as $item)
                            {{ @$item->product->name }} {{ $loop->iteration > 1 ? ', ' : '' }}
                        @endforeach
                    </td>
                    <td>{{ $row->total_amount }}</td>
                    <td>{{ $row->discount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
