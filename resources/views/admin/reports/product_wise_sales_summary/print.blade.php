@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr class="text-nowrap">
                <th class="text-center" width="20">SL#</th>
                <th>Product</th>
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
            @foreach ($data as $row)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ @$row->name }}</td>
                    <td class="text-center">
                        @php
                            $month = request('month') ?? date('m');
                            if (Str::length($month) == 1) {
                                $month = '0' . $month;
                            }
                            $year = request('year') ?? ($year = date('Y'));
                            $start_date = $year . '-' . $month . '-01';
                            $end_date = date('Y-m-t', strtotime($year . '-' . $month));
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', '>=', $start_date)
                                ->where('date', '<=', $end_date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>
                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-01';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>
                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-02';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>
                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-03';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-04';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-05';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-06';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-07';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-08';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-09';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-10';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-11';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-12';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-13';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-14';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-15';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-16';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-17';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-18';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-19';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-20';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-21';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-22';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-23';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-24';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-25';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-26';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-27';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = $year . '-' . $month . '-28';
                            $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                ->where('date', $date)
                                ->whereIn('status', ['Delivered', 'Collected'])
                                ->sum('qty');
                            echo $qty == 0 ? '-' : $qty;
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = date('Y-m-d', strtotime($year . '-' . $month . '-29'));
                            if ($date == $year . '-' . $month . '-29') {
                                $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                    ->where('date', $date)
                                    ->whereIn('status', ['Delivered', 'Collected'])
                                    ->sum('qty');
                                echo $qty == 0 ? '-' : $qty;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = date('Y-m-d', strtotime($year . '-' . $month . '-30'));
                            if ($date == $year . '-' . $month . '-30') {
                                $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                    ->whereIn('status', ['Delivered', 'Collected'])
                                    ->where('date', $date)
                                    ->sum('qty');
                                echo $qty == 0 ? '-' : $qty;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>

                    <td class="text-center">
                        @php
                            $date = date('Y-m-d', strtotime($year . '-' . $month . '-31'));
                            if ($date == $year . '-' . $month . '-31') {
                                $qty = \App\Models\OnlineSales::where('product_id', $row->id)
                                    ->whereIn('status', ['Delivered', 'Collected'])
                                    ->where('date', $date)
                                    ->sum('qty');
                                echo $qty == 0 ? '-' : $qty;
                            } else {
                                echo '-';
                            }
                        @endphp
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <th class="text-right" colspan="2">Total Summary</th>
            <th class="text-center">
                @php
                    $qty = \App\Models\OnlineSales::where('date', '>=', $start_date)
                        ->where('date', '<=', $end_date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-01';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-02';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-03';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-04';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-05';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-06';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-07';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-08';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-09';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-10';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-11';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-12';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-13';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-14';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-15';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-16';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-17';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-18';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-19';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-20';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-21';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-22';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-23';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-24';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-25';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-26';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-27';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = $year . '-' . $month . '-28';
                    $qty = \App\Models\OnlineSales::where('date', $date)
                        ->whereIn('status', ['Delivered', 'Collected'])
                        ->sum('qty');
                    echo $qty == 0 ? '-' : $qty;
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = date('Y-m-d', strtotime($year . '-' . $month . '-29'));
                    if ($date == $year . '-' . $month . '-29') {
                        $qty = \App\Models\OnlineSales::where('date', $date)
                            ->whereIn('status', ['Delivered', 'Collected'])
                            ->sum('qty');
                        echo $qty == 0 ? '-' : $qty;
                    } else {
                        echo '-';
                    }
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = date('Y-m-d', strtotime($year . '-' . $month . '-30'));
                    if ($date == $year . '-' . $month . '-30') {
                        $qty = \App\Models\OnlineSales::where('date', $date)
                            ->whereIn('status', ['Delivered', 'Collected'])
                            ->sum('qty');
                        echo $qty == 0 ? '-' : $qty;
                    } else {
                        echo '-';
                    }
                @endphp
            </th>
            <th class="text-center">
                @php
                    $date = date('Y-m-d', strtotime($year . '-' . $month . '-31'));
                    if ($date == $year . '-' . $month . '-31') {
                        $qty = \App\Models\OnlineSales::where('date', $date)
                            ->whereIn('status', ['Delivered', 'Collected'])
                            ->sum('qty');
                        echo $qty == 0 ? '-' : $qty;
                    } else {
                        echo '-';
                    }
                @endphp
            </th>
        </tfoot>
    </table>

    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
