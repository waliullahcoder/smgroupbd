@extends('layouts.investor.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead class="text-nowrap">
            <tr>
                <th class="text-center" width="40px">SL#</th>
                <th>Product</th>
                <th class="text-center">Sales Qty</th>
                <th class="text-center">Sales Amount</th>
                <th class="text-center">Purchase Amount</th>
                <th class="text-center">Product Profit</th>
                <th class="text-center">Invest %</th>
                <th class="text-center">Investor Profit</th>
                <th class="text-center">Total Share</th>
                <th class="text-center">Your Share</th>
                <th class="text-center">Your Profit</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_lifting_amount = 0;
                $total_sales_amount = 0;
                $total_profit_amount = 0;
                $total_investors_profit = 0;
                $total_self_profit = 0;
            @endphp
            @if (count($data) > 0)
                @foreach ($data['searched_products'] as $row)
                    @php
                        $sales_qty =
                            $data['online_sales']
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty') +
                            $data['sales']
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty') -
                            $data['sales_returns']
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');
                        if ($sales_qty == 0) {
                            continue;
                        }
                        $sales_amount =
                            $data['online_sales']
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('amount') +
                            $data['sales']
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('amount') -
                            $data['sales_returns']
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('amount');
                        $lifting_amount =
                            $data['liftings']
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('amount') -
                            $data['lifting_returns']
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('amount');
                        $total_profit = $sales_amount - $lifting_amount > 0 ? $sales_amount - $lifting_amount : 0;

                        $all_investors = \App\Models\Invest::with('investor')
                            ->where('product_id', $row->product_id)
                            ->where('sattled', 0)
                            ->count();
                        $investors_profit = round((($total_profit / 100) * $row->shared_profit) / $all_investors);

                        $self_invests = \App\Models\Invest::with('investor')
                            ->where('product_id', $row->product_id)
                            ->where('investor_id', Auth::user()->investor->id)
                            ->where('sattled', 0)
                            ->count();

                        $self_profit = $self_invests * $investors_profit;

                        if ($lifting_amount < $sales_amount && $lifting_amount != 0 && $sales_amount != 0) {
                            $percentage = ($total_profit / $sales_amount) * 100;
                        } elseif ($lifting_amount == 0 && $sales_amount != 0) {
                            $percentage = 100;
                        } else {
                            $percentage = 0;
                        }
                        $total_lifting_amount += $lifting_amount;
                        $total_sales_amount += $sales_amount;
                        $total_profit_amount += $total_profit;
                        $total_investors_profit += $investors_profit;
                        $total_self_profit += $self_profit;
                    @endphp
                    <tr>
                        <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                        <td>{{ $row->name }} ({{ $row->code }})</td>
                        <td class="text-center">{{ number_format($sales_qty, 2, '.', ',') }}</td>
                        <td class="text-center">{{ number_format($sales_amount, 2, '.', ',') }}</td>
                        <td class="text-center">{{ number_format($lifting_amount, 2, '.', ',') }}</td>
                        <td class="text-center">{{ number_format($total_profit, 2, '.', ',') }}</td>
                        <td class="text-center">{{ number_format($row->shared_profit, 0, '.', ',') }}%</td>
                        <td class="text-center">{{ number_format($investors_profit, 2, '.', ',') }}</td>
                        <td class="text-center">{{ number_format($all_investors, 0, '.', ',') }}</td>
                        <td class="text-center">{{ number_format($self_invests, 0, '.', ',') }}</td>
                        <td class="text-center">{{ number_format($self_profit, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right" colspan="3">Total Summary</th>
                <th class="text-center">{{ number_format($total_sales_amount, 2, '.', ',') }}</th>
                <th class="text-center">{{ number_format($total_lifting_amount, 2, '.', ',') }}</th>
                <th class="text-center">{{ number_format($total_profit_amount, 2, '.', ',') }}</th>
                <th class="text-center"></th>
                <th class="text-center">{{ number_format($total_investors_profit, 2, '.', ',') }}</th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center">{{ number_format($total_self_profit, 2, '.', ',') }}</th>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
