@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr>
                <th class="text-center" rowspan="2" width="40px">Sl#</th>
                <th rowspan="2">Vendor Name</th>
                <th class="text-center" rowspan="2">Previous Year</th>
                <th class="text-center" colspan="4"><b>For The Year Of {{ $year == '' ? '' : $year }}</b></th>
                <th class="text-center" colspan="4"><b>For The Month Of
                        {{ $month == '' ? '' : date('F', mktime(0, 0, 0, $month, 10)) }}</b></th>
                <th class="text-center" rowspan="2">Vendor Payable</th>
            </tr>
            <tr>
                <th class="text-center">Lifting</th>
                <th class="text-center">Payment</th>
                <th class="text-center">Return</th>
                <th class="text-center">Due</th>
                <th class="text-center">Lifting</th>
                <th class="text-center">Payment</th>
                <th class="text-center">Return</th>
                <th class="text-center">Due</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPrevious = 0;
                $totalYearLiftings = 0;
                $totalYearPayments = 0;
                $totalYearReturn = 0;
                $totalYearBalance = 0;
                $totalMonthLiftings = 0;
                $totalMonthPayments = 0;
                $totalMonthReturn = 0;
                $totalMonthBalance = 0;
                $totalPayable = 0;
            @endphp
            @foreach ($data as $row)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $row['vendor']->name }}</td>
                    <td class="text-center">{{ number_format($row['previousBalance'], 2, '.', ',') }}</td>
                    <td class="text-center">{{ number_format($row['year_liftings'], 2, '.', ',') }}</td>
                    <td class="text-center">{{ number_format($row['year_payments'], 2, '.', ',') }}</td>
                    <td class="text-center">{{ number_format($row['year_return'], 2, '.', ',') }}</td>
                    <td class="text-center">{{ number_format($row['year_balance'], 2, '.', ',') }}</td>
                    <td class="text-center">{{ number_format($row['month_liftings'], 2, '.', ',') }}</td>
                    <td class="text-center">{{ number_format($row['month_payments'], 2, '.', ',') }}</td>
                    <td class="text-center">{{ number_format($row['month_return'], 2, '.', ',') }}</td>
                    <td class="text-center">{{ number_format($row['month_balance'], 2, '.', ',') }}</td>
                    <td class="text-center">{{ number_format($row['payable'], 2, '.', ',') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="text-end" colspan="2">Total Summary</th>
                <th class="text-center">{{ number_format($totalPrevious, 2, '.', ',') }}</th>
                <th class="text-center">{{ number_format($totalYearLiftings, 2, '.', ',') }}</th>
                <th class="text-center">{{ number_format($totalYearPayments, 2, '.', ',') }}</th>
                <th class="text-center">{{ number_format($totalYearReturn, 2, '.', ',') }}</th>
                <th class="text-center">{{ number_format($totalYearBalance, 2, '.', ',') }}</th>
                <th class="text-center">{{ number_format($totalMonthLiftings, 2, '.', ',') }}</th>
                <th class="text-center">{{ number_format($totalMonthPayments, 2, '.', ',') }}</th>
                <th class="text-center">{{ number_format($totalMonthReturn, 2, '.', ',') }}</th>
                <th class="text-center">{{ number_format($totalMonthBalance, 2, '.', ',') }}</th>
                <th class="text-center">{{ number_format($totalPayable, 2, '.', ',') }}</th>
            </tr>
        </tfoot>
    </table>
    <br>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
