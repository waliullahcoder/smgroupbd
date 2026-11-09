@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr>
                <th class="text-center" width="40px">Sl#</th>
                <th>Month</th>
                <th>Year</th>
                <th>Investor Name</th>
                <th>Product Name</th>
                <th class="text-right">Product Profit</th>
                <th class="text-right">Profit %</th>
                <th class="text-right">Investor Part</th>
                <th class="text-right">Total Share</th>
                <th class="text-right">Individual Share</th>
                <th class="text-right">Per share</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td class="text-center px-3">{{ $loop->iteration }}</td>
                    <td>{{ @$row->parent->month }}</td>
                    <td>{{ $row->parent->year }}</td>
                    <td>{{ $row->investor->name }}</td>
                    <td>{{ $row->product->name }}</td>
                    <td class="text-right">{{ number_format($row->total_profit, 2) }}</td>
                    <td class="text-right">{{ number_format($row->profit_percentage, 0) }}%</td>
                    <td class="text-right">{{ number_format($row->investor_part, 2) }}</td>
                    <td class="text-right">{{ number_format($row->total_share, 0) }}</td>
                    <td class="text-right">{{ number_format($row->individual_share, 0) }}</td>
                    <td class="text-right">{{ number_format($row->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">Total</th>
                <th class="text-right">{{ number_format($data->sum('total_profit'), 2) }}</th>
                <th class="text-right"></th>
                <th class="text-right">{{ number_format($data->sum('investor_part'), 2) }}</th>
                <th class="text-right">{{ number_format($data->sum('total_share'), 0) }}</th>
                <th class="text-right">{{ number_format($data->sum('individual_share'), 0) }}</th>
                <th class="text-right">{{ number_format($data->sum('amount'), 2) }}</th>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
