@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead class="text-nowrap">
            <tr>
                <th class="px-3 text-center" width="40px">SL#</th>
                <th class="px-3">Client Name</th>
                <th class="px-3 text-right">Total Due</th>
                <th class="px-3 text-right">30 Day</th>
                <th class="px-3 text-right">60 Day</th>
                <th class="px-3 text-right">90 Day</th>
                <th class="px-3 text-right">Over 90 Day</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_due = 0;
                $total_thirty_days_due = 0;
                $total_sixty_days_due = 0;
                $total_ninety_days_due = 0;
                $total_over_ninety_days_due = 0;
            @endphp
            @if (count($data) > 0)
                @foreach ($data['clients'] as $row)
                    @php
                        $due =
                            $data['client_sales']->where('client_id', $row->client_id)->sum('amount') -
                            $data['client_sales']->where('client_id', $row->client_id)->sum('total_paid');
                        if ($due < 0) {
                            continue;
                        }
                        $total_due += $due;

                        $one_month_due =
                            $data['client_sales']
                                ->where('client_id', $row->client_id)
                                ->where('date', '<=', $data['one_start_date'])
                                ->where('date', '>=', $data['one_end_date'])
                                ->sum('amount') -
                            $data['client_sales']
                                ->where('client_id', $row->client_id)
                                ->where('date', '<=', $data['one_start_date'])
                                ->where('date', '>=', $data['one_end_date'])
                                ->sum('total_paid');

                        $total_thirty_days_due += $one_month_due;

                        $two_month_due =
                            $data['client_sales']
                                ->where('client_id', $row->client_id)
                                ->where('date', '<=', $data['two_start_date'])
                                ->where('date', '>=', $data['two_end_date'])
                                ->sum('amount') -
                            $data['client_sales']
                                ->where('client_id', $row->client_id)
                                ->where('date', '<=', $data['two_start_date'])
                                ->where('date', '>=', $data['two_end_date'])
                                ->sum('total_paid');
                        $total_sixty_days_due += $two_month_due;

                        $three_month_due =
                            $data['client_sales']
                                ->where('client_id', $row->client_id)
                                ->where('date', '<=', $data['three_start_date'])
                                ->where('date', '>=', $data['three_end_date'])
                                ->sum('amount') -
                            $data['client_sales']
                                ->where('client_id', $row->client_id)
                                ->where('date', '<=', $data['three_start_date'])
                                ->where('date', '>=', $data['three_end_date'])
                                ->sum('total_paid');

                        $total_ninety_days_due += $three_month_due;

                        $over_three_month_due =
                            $data['client_sales']
                                ->where('client_id', $row->client_id)
                                ->where('date', '<=', $data['over_three_start_date'])
                                ->sum('amount') -
                            $data['client_sales']
                                ->where('client_id', $row->client_id)
                                ->where('date', '<=', $data['over_three_start_date'])
                                ->sum('total_paid');
                        $total_thirty_days_due += $over_three_month_due;

                    @endphp
                    <tr>
                        <td class="text-center px-3">{{ $loop->iteration }}</td>
                        <td class="px-3">{{ $row->client_name }}</td>
                        <td class="text-right px-3">{{ number_format($due, 2, '.', ',') }}</td>
                        <td class="text-right px-3">{{ number_format($one_month_due, 2, '.', ',') }}</td>
                        <td class="text-right px-3">{{ number_format($two_month_due, 2, '.', ',') }}</td>
                        <td class="text-right px-3">{{ number_format($three_month_due, 2, '.', ',') }}</td>
                        <td class="text-right px-3">{{ number_format($over_three_month_due, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        @if (count($data) > 0)
            <tfoot>
                <tr>
                    <th class="text-right text-white px-3" colspan="2">Total Summary</th>
                    <th class="text-right text-white px-3">
                        {{ number_format($total_due, 2, '.', ',') }}</th>
                    <th class="text-right text-white px-3">
                        {{ number_format($total_thirty_days_due, 2, '.', ',') }}
                    <th class="text-right text-white px-3">
                        {{ number_format($total_sixty_days_due, 2, '.', ',') }}
                    <th class="text-right text-white px-3">
                        {{ number_format($total_ninety_days_due, 2, '.', ',') }}
                    <th class="text-right text-white px-3">
                        {{ number_format($total_over_ninety_days_due, 2, '.', ',') }}
                    </th>
                </tr>
            </tfoot>
        @endif
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
