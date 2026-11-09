@extends('layouts.admin.print_app')
@section('content')
    @if ($report_type == 'summary')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead>
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Vendor</th>
                    <th>Product Type</th>
                    <th>Product Name</th>
                    <th class="text-right">Order Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center" width="40px"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ $row->product->vendor->name }}</td>
                        <td>{{ $row->product->category->name }}</td>
                        <td>{{ $row->product->name }}</td>
                        @php
                            $ctn = floor($row->total_qty / $row->product->ctn_size);
                            $ctn_sizes = $ctn * $row->product->ctn_size;
                            $extra = $row->total_qty - $ctn_sizes;
                            $total = $ctn . ' CTN ' . ($extra > 0 ? $extra . ' ' . $row->product->attribute->name : '');
                        @endphp
                        <td class="text-right">{{ $total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif ($report_type == 'list')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead>
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Company Name</th>
                    <th>Order Date</th>
                    <th>Client Name</th>
                    <th>Staff</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center" width="40px"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ $row->company->name }} </td>
                        <td>{{ date('d-m-Y', strtotime($row->date)) }}</td>
                        <td>{{ $row->client->name }} </td>
                        <td>{{ $row->staff->name }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <div style="padding-top: 30px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
