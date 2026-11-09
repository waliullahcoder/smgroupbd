@extends('layouts.admin.print_app')
@section('content')
    <table class="table mb-3 info-table">
        <tr>
            <td>
                <div class="d-flex align-items-center">
                    <b style="flex-shrink: 0; width: 110px; display: inline-block;">Invoice</b> :
                    {{ $data->invoice }}
                </div>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <b style="flex-shrink: 0; width: 110px; display: inline-block;">Order Date </b> :
                    {{ date('d-m-Y', strtotime($data->date)) }}
                </div>
            </td>
        </tr>
    </table>
    <table class="table table-bordered table-condensed table-striped align-middle mb-3">
        <thead>
            <tr>
                <th class="text-center">SL#</th>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $row)
                <tr>
                    <td class="text-center"><b>{{ $loop->iteration }}</b></td>
                    <td>{{ $row->product->name }}</td>
                    <td>{{ $row->product->code }}</td>
                    <td class="text-center">{{ $row->quantity . '(' . $row->product->attribute->name . ')' }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding-top: 50px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
