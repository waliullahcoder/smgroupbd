@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead class="text-nowrap">
            <tr>
                <th class="text-center" width="20">SL#</th>
                <th>Date</th>
                <th class="text-center">Total Order</th>
                <th class="text-center">Pending</th>
                <th class="text-center">Forward</th>
                <th class="text-center">On Route</th>
                <th class="text-center">Delivery</th>
                <th class="text-center">Collected</th>
                <th class="text-center">Cancelled</th>
                <th class="text-center">Business Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_1 = 0;
                $total_2 = 0;
                $total_3 = 0;
                $total_4 = 0;
                $total_5 = 0;
                $total_6 = 0;
                $total_7 = 0;
                $total_collected = 0;
            @endphp
            @for ($i = 1; $i <= 31; $i++)
                <tr class="text-nowrap">
                    <td class="text-center">{{ $i }}</td>
                    <td>Date - {{ $i }}</td>
                    <td class="text-center">
                        @php
                            $year = request('year') ?? date('Y');
                            $month = request('month') ?? date('m');
                            if (Str::length($month) == 1) {
                                $month = '0' . $month;
                            }
                            $date = date(
                                'Y-m-d',
                                strtotime($year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)),
                            );
                            if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                $query = \App\Models\Order::where('date', $date);
                                if (request('store_id')) {
                                    $query->where('store_id', request('store_id'));
                                }
                                $totals = $query->count();
                                $total_1 += $totals;
                                if ($totals > 0) {
                                    echo number_format($totals);
                                } else {
                                    echo '-';
                                }
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>
                    <td class="text-center">
                        @php
                            if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                $query = \App\Models\Order::where('date', $date)->where('status', 'Pending');
                                if (request('store_id')) {
                                    $query->where('store_id', request('store_id'));
                                }
                                $total_pending = $query->count();
                                $total_2 += $total_pending;
                                if ($total_pending > 0) {
                                    echo number_format($total_pending);
                                } else {
                                    echo '-';
                                }
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>
                    <td class="text-center">
                        @php
                            if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                $query = \App\Models\Order::where('date', $date)->where('status', 'Forward');
                                if (request('store_id')) {
                                    $query->where('store_id', request('store_id'));
                                }
                                $total_forward = $query->count();

                                $total_3 += $total_forward;
                                if ($total_forward > 0) {
                                    echo number_format($total_forward);
                                } else {
                                    echo '-';
                                }
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>
                    <td class="text-center">
                        @php
                            if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                $query = \App\Models\Order::where('date', $date)->where('status', 'On Route');
                                if (request('store_id')) {
                                    $query->where('store_id', request('store_id'));
                                }
                                $total_on_route = $query->count();

                                $total_4 += $total_on_route;
                                if ($total_on_route > 0) {
                                    echo number_format($total_on_route);
                                } else {
                                    echo '-';
                                }
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>
                    <td class="text-center">
                        @php
                            if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                $query = \App\Models\Order::where('date', $date)->where('status', 'Delivered');
                                if (request('store_id')) {
                                    $query->where('store_id', request('store_id'));
                                }
                                $total_delivered = $query->count();

                                $total_5 += $total_delivered;
                                if ($total_delivered > 0) {
                                    echo number_format($total_delivered);
                                } else {
                                    echo '-';
                                }
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>
                    <td class="text-center">
                        @php
                            if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                $query = \App\Models\Order::where('date', $date)->where('status', 'Collected');
                                if (request('store_id')) {
                                    $query->where('store_id', request('store_id'));
                                }
                                $collected = $query->count();

                                $total_collected += $collected;
                                if ($collected > 0) {
                                    echo number_format($collected);
                                } else {
                                    echo '-';
                                }
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>
                    <td class="text-center">
                        @php
                            if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                $query = \App\Models\Order::where('date', $date)->where('status', 'Cancelled');
                                if (request('store_id')) {
                                    $query->where('store_id', request('store_id'));
                                }
                                $total_cancelled = $query->count();

                                $total_6 += $total_cancelled;
                                if ($total_cancelled > 0) {
                                    echo number_format($total_cancelled);
                                } else {
                                    echo '-';
                                }
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>
                    <td class="text-center">
                        @php
                            if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                $query = \App\Models\OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected']);
                                if (request('store_id')) {
                                    $query->where('store_id', request('store_id'));
                                }
                                $total_business = $query->sum('amount');

                                $total_7 += $total_business;
                                if ($total_business > 0) {
                                    echo number_format($total_business);
                                } else {
                                    echo '-';
                                }
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>
                </tr>
            @endfor
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right" colspan="2">Total Summary</th>
                <th class="text-center">{{ number_format($total_1) }}</th>
                <th class="text-center">{{ number_format($total_2) }}</th>
                <th class="text-center">{{ number_format($total_3) }}</th>
                <th class="text-center">{{ number_format($total_4) }}</th>
                <th class="text-center">{{ number_format($total_5) }}</th>
                <th class="text-center">{{ number_format($total_collected) }}</th>
                <th class="text-center">{{ number_format($total_6) }}</th>
                <th class="text-center">{{ number_format($total_7) }}</th>
            </tr>
        </tfoot>
    </table>

    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
