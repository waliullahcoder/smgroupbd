@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr class="text-nowrap">
                <th>Collection Date</th>
                <th>Invoice</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Store</th>
                <th class="text-right">Product Amount</th>
                <th class="text-right">Discount</th>
                <th class="text-right">Shipping Charge</th>
                <th class="text-right">Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ date('d-m-Y', strtotime($row->collected_at)) }}</td>
                    <td>{{ $row->invoice }}</td>
                    <td>{{ $row->user_name }}</td>
                    <td>{{ $row->user_phone }}</td>
                    <td class="text-nowrap">{{ @$row->store->name }}</td>
                    <td class="text-right">{{ number_format($row->sub_total) }}</td>
                    <td class="text-right">{{ number_format($row->discount) }}</td>
                    <td class="text-right">{{ number_format($row->shipping_charge) }}</td>
                    <td class="text-right">{{ number_format($row->due) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right" colspan="5">Total</th>
                <th class="text-right">{{ number_format($data->sum('sub_total')) }}</th>
                <th class="text-right">{{ number_format($data->sum('discount')) }}</th>
                <th class="text-right">{{ number_format($data->sum('shipping_charge')) }}</th>
                <th class="text-right">{{ number_format($data->sum('due')) }}</th>
            </tr>
        </tfoot>
    </table>

    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
