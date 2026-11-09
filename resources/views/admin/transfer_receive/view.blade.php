@extends('layouts.admin.print_app')
@section('content')
    <table class="table mb-3 info-table">
        <tr>
            <td>
                <div class="d-flex align-items-center"><b
                        style="flex-shrink: 0; width: 110px; display: inline-block;">Transfer No.</b> :
                    {{ $data->transfer_no }}</div>
            </td>
            <td>
                <div class="d-flex align-items-center"><b
                        style="flex-shrink: 0; width: 110px; display: inline-block;">Transfer Date.</b> :
                    {{ date('d-m-Y', strtotime($data->date)) }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="d-flex align-items-center"><b
                        style="flex-shrink: 0; width: 110px; display: inline-block;">From</b> :
                    {{ $data->host->name }}</div>
            </td>
            <td>
                <div class="d-flex align-items-center"><b style="flex-shrink: 0; width: 110px; display: inline-block;">To </b>
                    :
                    {{ $data->destination->name }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="d-flex align-items-center"><b style="flex-shrink: 0; width: 110px; display: inline-block;">Send
                        By</b> :
                    {{ $data->staff->name }}</div>
            </td>
            <td>
                <div class="d-flex align-items-center"><b
                        style="flex-shrink: 0; width: 110px; display: inline-block;">Receive By</b> :
                    {{ @$data->approveBy->name ?? 'Not Approved' }}</div>
            </td>
        </tr>
    </table>
    <table class="table table-bordered table-condensed table-striped align-middle mb-3">
        @if ($data->product_type == 'Consumer')
            <thead>
                <tr class="align-middle">
                    <th class="text-center">SL#</th>
                    <th>Product Category</th>
                    <th>Product Name</th>
                    <th>Code</th>
                    <th class="text-right">Qty</th>
                    <th class="text-start">Approve Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->list as $row)
                    <tr class="align-middle">
                        <td class="text-center"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ $row->product->category->name }}</td>
                        <td>{{ $row->product->name }}</td>
                        <td>{{ $row->product->code }}</td>
                        <td class="text-right">{{ $row->qty }}</td>
                        <td class="text-start">{{ $data->approve == 1 ? 'Approved' : 'Not Approved' }}</td>
                    </tr>
                @endforeach
            </tbody>
        @else
            <thead>
                <tr class="align-middle">
                    <th class="text-center">SL#</th>
                    <th>Product Category</th>
                    <th>Product Name</th>
                    <th>Variant</th>
                    <th class="text-right">Qty</th>
                    <th class="text-start">Approve Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->list as $row)
                    <tr class="align-middle">
                        <td class="text-center"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ @$row->product->category->name }}</td>
                        <td>{{ @$row->product->name }}</td>
                        <td>{{ @$row->variant->sku }}</td>
                        <td class="text-right">{{ $row->qty }}</td>
                        <td class="text-start">{{ $data->approve == 1 ? 'Approved' : 'Not Approved' }}</td>
                    </tr>
                @endforeach
            </tbody>
        @endif
    </table>
    <div style="padding-top: 50px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
