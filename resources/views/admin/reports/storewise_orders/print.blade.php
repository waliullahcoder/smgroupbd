@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr>
                <th class="text-center" width="40px">SL#</th>
                <th>Store Name</th>
                <th class="text-center" width="100">Total Order</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_orders = 0;
            @endphp
            @foreach ($data as $row)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ @$row->name }}</td>
                    <td class="text-center">
                        {{ number_format(count($row->orders->whereIn('status', ['Pending', 'Forward', 'Processing', 'On Route', 'Delivered']))) }}
                    </td>
                </tr>
                @php
                    $total_orders += count($row->orders->whereIn('status', ['Pending', 'Forward', 'Processing', 'On Route', 'Delivered']));
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-end">Total Summary</th>
                <th class="text-center">
                    {{ number_format($total_orders) }}
                </th>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
