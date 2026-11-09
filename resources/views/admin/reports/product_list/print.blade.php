@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr>
                <th>SL#</th>
                <th>Vendor Name</th>
                <th>Product Name</th>
                <th>Product Category</th>
                <th>UOM</th>
                <th>Product Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $row)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $row->vendor->name }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->category->name }}</td>
                    <td>{{ $row->attribute->name }}</td>
                    <td>{{ $row->price->sale_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
