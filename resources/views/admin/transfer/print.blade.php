@extends('layouts.admin.print_app')
@section('content')
    <table class="table mb-2 info-table" style="background-color: #ddd;">
        <tr>
            <td style="padding-bottom: 0px !important">
                <b class="d-inline-block">Transfer Invoice: </b>
                <span class="d-inline-block">#{{ $data->transfer_no }}</span>
            </td>
            <td style="padding-bottom: 0px !important" class="text-right">
                <b class="d-inline-block text-left">Transfer Date:</b>
                <span class="d-inline-block">{{ date('d-m-Y', strtotime($data->date)) }}</span>
            </td>
        </tr>
    </table>

    <table class="table mb-3 info-table" style="border-bottom: 1px solid #ddd;">
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 120px;">From Store :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ @$data->host->name }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left">To Store :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ @$data->destination->name }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <div class="overflow-hidden">
                    <b class="d-inline-block" style="min-width: 120px;">Send By :</b>
                    <span class="d-inline-block"
                        style="min-width: 200px;">{{ date('d-m-Y', strtotime($data->date)) }}</span>
                </div>
            </td>
            <td class="text-right">
                <div class="overflow-hidden">
                    <b class="d-inline-block text-left">Received By :</b>
                    <span class="d-inline-block" style="min-width: 200px;">{{ @$data->approveBy->name }}</span>
                </div>
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
