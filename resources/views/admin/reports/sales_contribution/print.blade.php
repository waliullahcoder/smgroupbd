@extends('layouts.admin.print_app')

@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle mb-3" style="width: 100%;">
        @php
            $total_sum1 = 0;
            $total_sum2 = 0;
        @endphp
        @if ($criteria == 'client')
            <thead>
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Dealer Name</th>
                    <th class="text-center">By Value</th>
                    <th class="text-center">Value (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['client_sales'] as $row)
                    @php
                        $sales = $data['sales']->sum('amount');
                        $online_sales = $data['online_sales']->sum('amount');
                        $sales_returns = $data['sales_returns']->sum('amount');
                        $total_sales_amount = $sales + $online_sales - $sales_returns;
                        $client_sales = $row->amount - @$data['client_returns']->where('client_id', $row->client_id)->first()->amount ?? 0;
                        if ($client_sales > 0) {
                            $percentage = round(($client_sales * 100) / $total_sales_amount, 2);
                        } else {
                            $percentage = 0;
                        }
                    @endphp
                    <tr>
                        <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                        <td>{{ $row->client_name }}</td>
                        <td class="text-center">
                            {{ number_format($client_sales, 2, '.', ',') }}
                        </td>
                        <td class="text-center">
                            {{ number_format($percentage, 2, '.', ',') }}
                        </td>
                    </tr>
                    @php
                        $total_sum2 += $client_sales;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-right">Total</th>
                    <th class="text-center">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                    <th class="text-center"></th>
                </tr>
            </tfoot>
        @endif
        @if ($criteria == 'product')
            <thead>
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Product - Code</th>
                    <th class="text-center">By Qty</th>
                    <th class="text-center">Qty (%)</th>
                    <th class="text-center">By Value</th>
                    <th class="text-center">Value (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['sales'] as $row)
                    @php
                        $sales = $data['sales']->sum('qty');
                        $online_sales = $data['online_sales']->sum('qty');
                        $sales_returns = $data['sales_returns']->sum('qty');
                        $total_sales_qty = $sales + $online_sales - $sales_returns;

                        $sales = $data['sales']->sum('amount');
                        $online_sales = $data['online_sales']->sum('amount');
                        $sales_returns = $data['sales_returns']->sum('amount');
                        $total_sales_amount = $sales + $online_sales - $sales_returns;

                        $sales = $data['sales']->where('product_id', $row->product_id)->sum('qty');
                        $online_sales = $data['online_sales']->where('product_id', $row->product_id)->sum('qty');
                        $sales_returns = $data['sales_returns']->where('product_id', $row->product_id)->sum('qty');
                        $sales_qty = $sales + $online_sales - $sales_returns;

                        $sales = $data['sales']->where('product_id', $row->product_id)->sum('amount');
                        $online_sales = $data['online_sales']->where('product_id', $row->product_id)->sum('amount');
                        $sales_returns = $data['sales_returns']->where('product_id', $row->product_id)->sum('amount');
                        $sales_amount = $sales + $online_sales - $sales_returns;
                    @endphp
                    <tr>
                        <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                        <td>{{ $row->name }} - {{ $row->code }}</td>
                        <td class="text-center">
                            {{ number_format($sales_qty, 2, '.', ',') }}
                        </td>
                        <td class="text-center">
                            {{ number_format(round(($sales_qty * 100) / $total_sales_qty, 2), 2, '.', ',') }}
                        </td>
                        <td class="text-center">
                            {{ number_format($sales_amount, 2, '.', ',') }}
                        </td>
                        <td class="text-center">
                            {{ number_format(round(($sales_amount * 100) / $total_sales_amount, 2), 2, '.', ',') }}
                        </td>
                    </tr>
                    @php
                        $total_sum2 += $sales_amount;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">Total</th>
                    <th class="text-center">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                    <th class="text-center"></th>
                </tr>
            </tfoot>
        @endif
        @if ($criteria == 'category')
            <thead>
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Category</th>
                    <th class="text-center">By Qty</th>
                    <th class="text-center">Qty (%)</th>
                    <th class="text-center">By Value</th>
                    <th class="text-center">Value (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['sales'] as $row)
                    @php
                        $sales = $data['sales']->sum('qty');
                        $online_sales = $data['online_sales']->sum('qty');
                        $sales_returns = $data['sales_returns']->sum('qty');
                        $total_sales_qty = $sales + $online_sales - $sales_returns;

                        $sales = $data['sales']->sum('amount');
                        $online_sales = $data['online_sales']->sum('amount');
                        $sales_returns = $data['sales_returns']->sum('amount');
                        $total_sales_amount = $sales + $online_sales - $sales_returns;

                        $sales = $data['sales']->where('category_id', $row->category_id)->sum('qty');
                        $online_sales = $data['online_sales']->where('category_id', $row->category_id)->sum('qty');
                        $sales_returns = $data['sales_returns']->where('category_id', $row->category_id)->sum('qty');
                        $sales_qty = $sales + $online_sales - $sales_returns;

                        $sales = $data['sales']->where('category_id', $row->category_id)->sum('amount');
                        $online_sales = $data['online_sales']->where('category_id', $row->category_id)->sum('amount');
                        $sales_returns = $data['sales_returns']->where('category_id', $row->category_id)->sum('amount');
                        $sales_amount = $sales + $online_sales - $sales_returns;
                    @endphp
                    <tr>
                        <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                        <td>{{ $row->category_name }}</td>
                        <td class="text-center">
                            {{ number_format($sales_qty, 2, '.', ',') }}
                        </td>
                        <td class="text-center">
                            {{ number_format(round(($sales_qty * 100) / $total_sales_qty, 2), 2, '.', ',') }}
                        </td>
                        <td class="text-center">
                            {{ number_format($sales_amount, 2, '.', ',') }}
                        </td>
                        <td class="text-center">
                            {{ number_format(round(($sales_amount * 100) / $total_sales_amount, 2), 2, '.', ',') }}
                        </td>
                    </tr>
                    @php
                        $total_sum2 += $sales_amount;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">Total</th>
                    <th class="text-center">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                    <th class="text-center"></th>
                </tr>
            </tfoot>
        @endif
        @if ($criteria == 'employee')
            <thead>
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Employee</th>
                    <th class="text-center">By Value</th>
                    <th class="text-center">Value (%)</th>
                </tr>
            </thead>
            <tbody>
                @if ($data['online_sales'] > 0)
                    @php
                        $total_sales_amount = $data['total_sales'];
                        if ($data['online_sales'] > 0) {
                            $percentage = round(($data['online_sales'] * 100) / $total_sales_amount, 2);
                        } else {
                            $percentage = 0;
                        }
                    @endphp
                    <tr>
                        <td class="text-center" width="40px">1</td>
                        <td>Online Sales</td>
                        <td class="text-center">
                            {{ number_format($data['online_sales'], 2, '.', ',') }}
                        </td>
                        <td class="text-center">
                            {{ number_format($percentage, 2, '.', ',') }}
                        </td>
                    </tr>
                @endif
                @foreach ($data['sales'] as $row)
                    @php
                        $total_sales_amount = $data['total_sales'];
                        if ($row->amount > 0) {
                            $percentage = round(($row->amount * 100) / $total_sales_amount, 2);
                        } else {
                            $percentage = 0;
                        }
                    @endphp
                    <tr>
                        <td class="text-center" width="40px">
                            {{ $data['online_sales'] > 0 ? $loop->iteration + 1 : $loop->iteration }}</td>
                        <td>{{ $row->staff_name }}</td>
                        <td class="text-center">
                            {{ number_format($row->amount, 2, '.', ',') }}
                        </td>
                        <td class="text-center">
                            {{ number_format($percentage, 2, '.', ',') }}
                        </td>
                    </tr>
                    @php
                        $total_sum2 += $row->amount;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-right">Total</th>
                    <th class="text-center">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                    <th class="text-center"></th>
                </tr>
            </tfoot>
        @endif
        @if ($criteria == 'client_type')
            <thead>
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Client Type</th>
                    <th class="text-center">By Value</th>
                    <th class="text-center">Value (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['cateogry_sales'] as $row)
                    @php
                        $sales = $data['sales']->sum('amount');
                        $online_sales = $data['online_sales']->sum('amount');
                        $sales_returns = $data['sales_returns']->sum('amount');
                        $total_sales_amount = $sales + $online_sales - $sales_returns;
                        if ($row->amount > 0) {
                            $percentage = round(($row->amount * 100) / $total_sales_amount, 2);
                        } else {
                            $percentage = 0;
                        }
                    @endphp
                    <tr>
                        <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                        <td>{{ $row->client_category_name }}</td>
                        <td class="text-center">
                            {{ number_format($row->amount, 2, '.', ',') }}
                        </td>
                        <td class="text-center">
                            {{ number_format($percentage, 2, '.', ',') }}
                        </td>
                    </tr>
                    @php
                        $total_sum2 += $row->amount;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-right">Total</th>
                    <th class="text-center">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                    <th class="text-center"></th>
                </tr>
            </tfoot>
        @endif
        @if ($criteria == 'region')
            <thead>
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Region</th>
                    <th class="text-center">By Value</th>
                    <th class="text-center">Value (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['client_sales'] as $row)
                    @php
                        $sales = $data['sales']->sum('amount');
                        $online_sales = $data['online_sales']->sum('amount');
                        $sales_returns = $data['sales_returns']->sum('amount');
                        $total_sales_amount = $sales + $online_sales - $sales_returns;
                        $client_sales = $row->amount - @$data['client_returns']->where('client_id', $row->client_id)->first()->amount ?? 0;
                        if ($client_sales > 0) {
                            $percentage = round(($client_sales * 100) / $total_sales_amount, 2);
                        } else {
                            $percentage = 0;
                        }
                    @endphp
                    <tr>
                        <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                        <td>{{ $row->region_name }}</td>
                        <td class="text-center">
                            {{ number_format($client_sales, 2, '.', ',') }}
                        </td>
                        <td class="text-center">
                            {{ number_format($percentage, 2, '.', ',') }}
                        </td>
                    </tr>
                    @php
                        $total_sum2 += $client_sales;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-right">Total</th>
                    <th class="text-center">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                    <th class="text-center"></th>
                </tr>
            </tfoot>
        @endif
        @if ($criteria == 'area')
            <thead>
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Area</th>
                    <th class="text-center">By Value</th>
                    <th class="text-center">Value (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['client_sales'] as $row)
                    @php
                        $sales = $data['sales']->sum('amount');
                        $online_sales = $data['online_sales']->sum('amount');
                        $sales_returns = $data['sales_returns']->sum('amount');
                        $total_sales_amount = $sales + $online_sales - $sales_returns;
                        $client_sales = $row->amount - @$data['client_returns']->where('client_id', $row->client_id)->first()->amount ?? 0;
                        if ($client_sales > 0) {
                            $percentage = round(($client_sales * 100) / $total_sales_amount, 2);
                        } else {
                            $percentage = 0;
                        }
                    @endphp
                    <tr>
                        <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                        <td>{{ $row->area_name }}</td>
                        <td class="text-center">
                            {{ number_format($client_sales, 2, '.', ',') }}
                        </td>
                        <td class="text-center">
                            {{ number_format($percentage, 2, '.', ',') }}
                        </td>
                    </tr>
                    @php
                        $total_sum2 += $client_sales;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-right">Total</th>
                    <th class="text-center">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                    <th class="text-center"></th>
                </tr>
            </tfoot>
        @endif
        @if ($criteria == 'territory')
            <thead>
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Territory</th>
                    <th class="text-center">By Value</th>
                    <th class="text-center">Value (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['client_sales'] as $row)
                    @php
                        $sales = $data['sales']->sum('amount');
                        $online_sales = $data['online_sales']->sum('amount');
                        $sales_returns = $data['sales_returns']->sum('amount');
                        $total_sales_amount = $sales + $online_sales - $sales_returns;
                        $client_sales = $row->amount - @$data['client_returns']->where('client_id', $row->client_id)->first()->amount ?? 0;
                        if ($client_sales > 0) {
                            $percentage = round(($client_sales * 100) / $total_sales_amount, 2);
                        } else {
                            $percentage = 0;
                        }
                    @endphp
                    <tr>
                        <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                        <td>{{ $row->territory_name }}</td>
                        <td class="text-center">
                            {{ number_format($client_sales, 2, '.', ',') }}
                        </td>
                        <td class="text-center">
                            {{ number_format($percentage, 2, '.', ',') }}
                        </td>
                    </tr>
                    @php
                        $total_sum2 += $client_sales;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-right">Total</th>
                    <th class="text-center">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                    <th class="text-center"></th>
                </tr>
            </tfoot>
        @endif
    </table>
    <div style="padding-top: 30px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
