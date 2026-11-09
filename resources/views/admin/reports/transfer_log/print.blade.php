@extends('layouts.admin.print_app')

@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle mb-3">
        <thead>
            <tr>
                <th class="text-center">SL#</th>
                <th>Date</th>
                <th>Host Store</th>
                <th>Destination Store</th>
                <th>Transfer No</th>
                <th>Product Name</th>
                <th>Code / Variant</th>
                <th class="text-right">Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td class="text-center"><b>{{ $loop->iteration }}</b></td>
                    <td>{{ date('d-m-Y', strtotime(@$row->transfer->date)) }}</td>
                    <td>{{ @$row->transfer->host->name }}</td>
                    <td>{{ @$row->transfer->destination->name }}</td>
                    <td>{{ @$row->transfer->transfer_no }}</td>
                    <td>{{ @$row->product->name }}</td>
                    <td>{{ @$row->product->code ?? @$row->variant->sku }}</td>
                    <td class="text-right">{{ number_format($row->qty, 2, '.', ',') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-right" colspan="7"><b>Total Summary</b></td>
                <td class="text-right" colspan="1"><b>{{ number_format($data->sum('qty'), 2, '.', ',') }}</b></td>
            </tr>
        </tfoot>
    </table>

    <div style="padding-top: 30px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
