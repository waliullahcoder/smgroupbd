@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead class="text-nowrap">
            <tr>
                <th class="text-center" width="40px">SL#</th>
                <th>Category Name</th>
                <th>Product Name</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Sales Amount</th>
                <th class="text-right">Lifting Amount</th>
                <th class="text-right">Profit Amount</th>
                <th class="text-right">Profit</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_sales_qty = 0;
                $total_sales_amount = 0;
                $total_lifting_amount = 0;
                $total_profit = 0;
            @endphp
            @if (isset($data['rows']))
                @foreach ($data['rows'] as $i => $row)
                    @php
                        $total_sales_qty += $row['qty'];
                        $total_sales_amount += $row['sales_amount'];
                        $total_lifting_amount += $row['lifting'];
                        $total_profit += $row['profit'];
                    @endphp
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $row['product']->category->name }}</td>
                        <td>{{ $row['product']->name }}</td>
                        <td class="text-center">{{ number_format($row['qty'], 2) }}</td>
                        <td class="text-right">{{ number_format($row['sales_amount'], 2) }}</td>
                        <td class="text-right">{{ number_format($row['lifting'], 2) }}</td>
                        <td class="text-right">{{ number_format($row['profit'], 2) }}</td>
                        <td class="text-center">{{ number_format($row['percentage'], 2) }}%</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            @php
                // Profit percentage
                if ($total_sales_amount > 0) {
                    $overall_profit = $total_profit;
                    $overall_percentage = ($overall_profit / $total_sales_amount) * 100;
                } else {
                    $overall_percentage = 0;
                }
            @endphp
            <tr class="bg-primary">
                <th class="text-white text-right" colspan="3">Total Summary</th>

                <th class="text-white text-center">
                    {{ number_format($total_sales_qty, 2) }}
                </th>

                <th class="text-white text-right">
                    {{ number_format($total_sales_amount, 2) }}
                </th>

                <th class="text-white text-right">
                    {{ number_format($total_lifting_amount, 2) }}
                </th>

                <th class="text-white text-right">
                    {{ number_format($total_profit, 2) }}
                </th>

                <th class="text-center text-white">
                    <div class="progress">
                        <div class="progress-bar progress-bar-success"
                            style="width:{{ round($overall_percentage) }}%; height:5px;">
                        </div>
                    </div>
                    <span class="progress-parcent text-white">
                        {{ number_format($overall_percentage, 2) }}%
                    </span>
                </th>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
