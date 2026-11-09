@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle" style="width: 100%;">
        <thead class="text-nowrap">
            <tr>
                <th rowspan="2" class="text-center align-middle" width="40px">SL#</th>
                <th rowspan="2" style="width: 80px" class="align-middle">Client Name</th>
                <th rowspan="2" class="align-middle text-right">Previous</th>
                <th colspan="4" class="text-center">For The Year of {{ $year }}</th>
                <th colspan="4" class="text-center">For The Month of {{ date('F', strtotime($month)) }}</th>
                <th rowspan="2" class="align-middle text-right">Outstanding</th>
            </tr>
            <tr>
                <th class="text-right">Sales</th>
                <th class="text-right">Collections</th>
                <th class="text-right">Return</th>
                <th class="text-right">Due</th>
                <th class="text-right">Sales</th>
                <th class="text-right">Collections</th>
                <th class="text-right">Return</th>
                <th class="text-right">Due</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPreviousrealization = 0;
                $totalyearlySales = 0;
                $totalYearlyCollection = 0;
                $yearlyReturn = 0;
                $totalYearlyRealization = 0;
                $totalMonthlySales = 0;
                $totalMonthlyCollection = 0;
                $monthlyReturn = 0;
                $totalMonthlyRealization = 0;
                $totalCurrentRealization = 0;
            @endphp
            @if (count($data) > 0)
                @foreach ($data['clients'] as $row)
                    @php
                        $previous_sales = $data['client_sales']
                            ->where('client_id', $row->client_id)
                            ->where('date', '<', $data['first_of_year'])
                            ->sum('amount');
                        $previous_returns = $data['client_returns']
                            ->where('client_id', $row->client_id)
                            ->where('date', '<', $data['first_of_year'])
                            ->sum('amount');
                        $previous_collections = $data['client_collections']
                            ->where('client_id', $row->client_id)
                            ->where('payment_date', '<', $data['first_of_year'])
                            ->sum('amount');
                        $previous_balance = $previous_sales - $previous_returns - $previous_collections;

                        $month_sales = $data['client_sales']
                            ->where('client_id', $row->client_id)
                            ->where('date', '>=', $data['first_of_month'])
                            ->where('date', '<=', $data['last_of_month'])
                            ->sum('amount');
                        $month_returns = $data['client_returns']
                            ->where('client_id', $row->client_id)
                            ->where('date', '>=', $data['first_of_month'])
                            ->where('date', '<=', $data['last_of_month'])
                            ->sum('amount');
                        $month_collections = $data['client_collections']
                            ->where('client_id', $row->client_id)
                            ->where('payment_date', '>=', $data['first_of_month'])
                            ->where('payment_date', '<=', $data['last_of_month'])
                            ->sum('amount');
                        $month_balance = $month_sales - $month_returns - $month_collections;

                        $year_sales = $data['client_sales']
                            ->where('client_id', $row->client_id)
                            ->where('date', '>=', $data['first_of_year'])
                            ->where('date', '<=', $data['last_of_year'])
                            ->sum('amount');
                        $year_returns = $data['client_returns']
                            ->where('client_id', $row->client_id)
                            ->where('date', '>=', $data['first_of_year'])
                            ->where('date', '<=', $data['last_of_year'])
                            ->sum('amount');
                        $year_collections = $data['client_collections']
                            ->where('client_id', $row->client_id)
                            ->where('payment_date', '>=', $data['first_of_year'])
                            ->where('payment_date', '<=', $data['last_of_year'])
                            ->sum('amount');
                        $year_balance = $year_sales - $year_returns - $year_collections;

                        $totalDue = $previous_balance + $year_balance;
                        // if ($totalDue == 0) {
                        //     $totalDue = 1;
                        // }
                        // $collection = $row['month_collection'] + $row['month_return']; // ex: 2500
                        // $dueMinusCollection = $totalDue - $collection; //ex: 7500
                        // $credit_p = ($dueMinusCollection / $totalDue) * 100; //ex: 75%;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td style="width: 80px">{{ $row->client_name }}</td>
                        <td class="text-right text-nowrap">{{ number_format($previous_balance, 2, '.', ',') }}</td>
                        <td class="text-right text-nowrap">{{ number_format($year_sales, 2, '.', ',') }}</td>
                        <td class="text-right text-nowrap">{{ number_format($year_collections, 2, '.', ',') }}</td>
                        <td class="text-right text-nowrap">{{ number_format($year_returns, 2, '.', ',') }}</td>
                        <td class="text-right text-nowrap">{{ number_format($year_balance, 2, '.', ',') }}</td>
                        <td class="text-right text-nowrap">{{ number_format($month_sales, 2, '.', ',') }}</td>
                        <td class="text-right text-nowrap">{{ number_format($month_collections, 2, '.', ',') }}</td>
                        <td class="text-right text-nowrap">{{ number_format($month_returns, 2, '.', ',') }}</td>
                        <td class="text-right text-nowrap">{{ number_format($month_balance, 2, '.', ',') }}</td>
                        <td class="text-right text-nowrap">{{ number_format($totalDue, 2, '.', ',') }}</td>
                    </tr>
                    @php
                        $totalPreviousrealization += $previous_balance;
                        $totalyearlySales += $year_sales;
                        $totalYearlyCollection += $year_collections;
                        $yearlyReturn += $year_returns;
                        $totalYearlyRealization += $year_balance;
                        $totalMonthlySales += $month_sales;
                        $totalMonthlyCollection += $month_collections;
                        $monthlyReturn += $month_returns;
                        $totalMonthlyRealization += $month_balance;
                        $totalCurrentRealization += $totalDue;
                    @endphp
                @endforeach
            @endif
        </tbody>
        {{-- @if (count($data) > 0)
            <tfoot>
                @php
                    $totalDue = $totalPreviousrealization + $totalYearlyRealization + $totalMonthlySales; //ex: 10000
                    if ($totalDue == 0) {
                        $totalDue = 1;
                    }
                    $collection = $totalMonthlyCollection + $monthlyReturn; // ex: 2500
                    $dueMinusCollection = $totalDue - $collection; //ex: 7500
                    $creditP = ($dueMinusCollection / $totalDue) * 100; //ex: 75%;
                @endphp
                <tr>
                    <th class="text-right text-nowrap text-white px-2" colspan="2">Total Summary</th>
                    <th class="text-right text-nowrap text-white px-2">
                        {{ number_format($totalPreviousrealization, 2, '.', ',') }}</th>
                    <th class="text-right text-nowrap text-white px-2">
                        {{ number_format($totalyearlySales, 2, '.', ',') }}</th>
                    <th class="text-right text-nowrap text-white px-2">
                        {{ number_format($totalYearlyCollection, 2, '.', ',') }}</th>
                    <th class="text-right text-nowrap text-white px-2">{{ number_format($yearlyReturn, 2, '.', ',') }}
                    </th>
                    <th class="text-right text-nowrap text-white px-2">
                        {{ number_format($totalYearlyRealization, 2, '.', ',') }}</th>
                    <th class="text-right text-nowrap text-white px-2">
                        {{ number_format($totalMonthlySales, 2, '.', ',') }}</th>
                    <th class="text-right text-nowrap text-white px-2">
                        {{ number_format($totalMonthlyCollection, 2, '.', ',') }}</th>
                    <th class="text-right text-nowrap text-white px-2">{{ number_format($monthlyReturn, 2, '.', ',') }}
                    </th>
                    <th class="text-right text-nowrap text-white px-2">
                        {{ number_format($totalMonthlyRealization, 2, '.', ',') }}</th>
                    <th class="text-right text-nowrap text-white px-2">
                        {{ number_format($totalCurrentRealization, 2, '.', ',') }}</th>
                </tr>
            </tfoot>
        @endif --}}
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
