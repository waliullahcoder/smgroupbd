@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead class="text-nowrap">
            <tr>
                <th class="text-center" width="30px">SL#</th>
                <th>Region</th>
                <th>Area</th>
                <th>Territory</th>
                <th>Client Name</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Credit Limit</th>
                <th>Reference</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td class="text-center" width="30px">{{ $loop->iteration }}</td>
                    <td>{{ $row->area->region->name }}</td>
                    <td>{{ $row->area->name }}</td>
                    <td>{{ $row->territory->name }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->phone }}</td>
                    <td>{{ $row->address }}</td>
                    <td>{{ $row->credit_limit }}</td>
                    <td>{{ $row->reference->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
