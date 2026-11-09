@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle" style="font-size: 12px;">
        <thead>
            <tr class="text-nowrap">
                <th>Store</th>
                <th class="text-center">Total</th>
                <th class="text-center">01</th>
                <th class="text-center">02</th>
                <th class="text-center">03</th>
                <th class="text-center">04</th>
                <th class="text-center">05</th>
                <th class="text-center">06</th>
                <th class="text-center">07</th>
                <th class="text-center">08</th>
                <th class="text-center">09</th>
                <th class="text-center">10</th>
                <th class="text-center">11</th>
                <th class="text-center">12</th>
                <th class="text-center">13</th>
                <th class="text-center">14</th>
                <th class="text-center">15</th>
                <th class="text-center">16</th>
                <th class="text-center">17</th>
                <th class="text-center">18</th>
                <th class="text-center">19</th>
                <th class="text-center">20</th>
                <th class="text-center">21</th>
                <th class="text-center">22</th>
                <th class="text-center">23</th>
                <th class="text-center">24</th>
                <th class="text-center">25</th>
                <th class="text-center">26</th>
                <th class="text-center">27</th>
                <th class="text-center">28</th>
                <th class="text-center">29</th>
                <th class="text-center">30</th>
                <th class="text-center">31</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_amount = 0;
                $total_1 = 0;
                $total_2 = 0;
                $total_3 = 0;
                $total_4 = 0;
                $total_5 = 0;
                $total_6 = 0;
                $total_7 = 0;
                $total_8 = 0;
                $total_9 = 0;
                $total_10 = 0;
                $total_11 = 0;
                $total_12 = 0;
                $total_13 = 0;
                $total_14 = 0;
                $total_15 = 0;
                $total_16 = 0;
                $total_17 = 0;
                $total_18 = 0;
                $total_19 = 0;
                $total_20 = 0;
                $total_21 = 0;
                $total_22 = 0;
                $total_23 = 0;
                $total_24 = 0;
                $total_25 = 0;
                $total_26 = 0;
                $total_27 = 0;
                $total_28 = 0;
                $total_29 = 0;
                $total_30 = 0;
                $total_31 = 0;
            @endphp
            @foreach ($data as $row)
                <tr>
                    <td>{{ @$row->name }}</td>
                    <td class="text-center">
                        @php
                            $month = request('month') ?? date('m');
                            if (Str::length($month) == 1) {
                                $month = '0' . $month;
                            }
                            $year = request('year') ?? ($year = date('Y'));
                            $start_date = $year . '-' . $month . '-01';
                            $end_date = $year . '-' . $month . '-31';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', '>=', $start_date)
                                ->where('date', '<=', $end_date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_amount += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>
                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-01';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_1 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>
                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-02';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_2 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-03';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_3 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-04';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_4 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-05';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_5 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-06';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_6 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-07';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_7 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-08';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_8 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-09';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_9 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-10';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_10 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-11';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_11 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-12';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_12 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-13';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_13 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-14';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_14 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-15';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_15 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-16';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_16 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-17';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_17 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-18';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_18 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-19';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_19 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-20';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_20 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-21';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_21 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-22';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_22 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-23';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_23 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-24';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_24 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-25';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_25 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-26';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_26 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-27';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_27 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-28';
                            $totals = \App\Models\Order::where('store_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->count();
                            $total_28 += $totals;
                            if ($totals > 0) {
                                echo $totals;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = date('Y-m-d', strtotime($year . '-' . $month . '-29'));
                            if ($date == $year . '-' . $month . '-29') {
                                $totals = \App\Models\Order::where('store_id', $row->id)
                                    ->where('date', $date)
                                    ->whereIn('status', ['Delivered', 'Collected'])
                                    ->count();
                                $total_29 += $totals;
                                if ($totals > 0) {
                                    echo $totals;
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
                            $date = date('Y-m-d', strtotime($year . '-' . $month . '-30'));
                            if ($date == $year . '-' . $month . '-30') {
                                $totals = \App\Models\Order::where('store_id', $row->id)
                                    ->where('date', $date)
                                    ->whereIn('status', ['Delivered', 'Collected'])
                                    ->count();
                                $total_29 += $totals;
                                if ($totals > 0) {
                                    echo $totals;
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
                            $date = date('Y-m-d', strtotime($year . '-' . $month . '-31'));
                            if ($date == $year . '-' . $month . '-31') {
                                $totals = \App\Models\Order::where('store_id', $row->id)
                                    ->where('date', $date)
                                    ->whereIn('status', ['Delivered', 'Collected'])
                                    ->count();
                                $total_29 += $totals;
                                if ($totals > 0) {
                                    echo $totals;
                                } else {
                                    echo '-';
                                }
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right">Total</th>
                <th class="text-center">{{ $total_amount }}</th>
                <th class="text-center">{{ $total_1 }}</th>
                <th class="text-center">{{ $total_2 }}</th>
                <th class="text-center">{{ $total_3 }}</th>
                <th class="text-center">{{ $total_4 }}</th>
                <th class="text-center">{{ $total_5 }}</th>
                <th class="text-center">{{ $total_6 }}</th>
                <th class="text-center">{{ $total_7 }}</th>
                <th class="text-center">{{ $total_8 }}</th>
                <th class="text-center">{{ $total_9 }}</th>
                <th class="text-center">{{ $total_10 }}</th>
                <th class="text-center">{{ $total_11 }}</th>
                <th class="text-center">{{ $total_12 }}</th>
                <th class="text-center">{{ $total_13 }}</th>
                <th class="text-center">{{ $total_14 }}</th>
                <th class="text-center">{{ $total_15 }}</th>
                <th class="text-center">{{ $total_16 }}</th>
                <th class="text-center">{{ $total_17 }}</th>
                <th class="text-center">{{ $total_18 }}</th>
                <th class="text-center">{{ $total_19 }}</th>
                <th class="text-center">{{ $total_20 }}</th>
                <th class="text-center">{{ $total_21 }}</th>
                <th class="text-center">{{ $total_22 }}</th>
                <th class="text-center">{{ $total_23 }}</th>
                <th class="text-center">{{ $total_24 }}</th>
                <th class="text-center">{{ $total_25 }}</th>
                <th class="text-center">{{ $total_26 }}</th>
                <th class="text-center">{{ $total_27 }}</th>
                <th class="text-center">{{ $total_28 }}</th>
                <th class="text-center">{{ $total_29 }}</th>
                <th class="text-center">{{ $total_30 }}</th>
                <th class="text-center">{{ $total_31 }}</th>
            </tr>
        </tfoot>
    </table>

    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
