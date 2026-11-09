@extends('layouts.admin.print_app')

@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle mb-3">
        @if (request('product_type') == 'Consumer' || is_null(request('product_type')))
            <thead>
                <tr class="text-nowrap">
                    <th class="text-center" width="20">Sl#</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>UOM</th>
                    <th class="text-right">Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $key = 1;
                @endphp
                @if (count($data) > 0)
                    @foreach ($data['searched_products'] as $row)
                        @php
                            $liftings = $data['liftings']->where('product_id', $row->product_id)->sum('qty');
                            $lifting_returns = $data['lifting_returns']
                                ->where('product_id', $row->product_id)
                                ->sum('qty');
                            $sales = $data['sales']->where('product_id', $row->product_id)->sum('qty');
                            $sales_returns = $data['sales_returns']->where('product_id', $row->product_id)->sum('qty');
                            $online_sales = $data['online_sales']->where('product_id', $row->product_id)->sum('qty');
                            $retail_sales = $data['retail_sales']->where('product_id', $row->product_id)->sum('qty');
                            $transfers = $data['transfer_or_receives']
                                ->whereIn('host_id', $data['store_id'])
                                ->where('product_id', $row->product_id)
                                ->sum('qty');
                            $receives = $data['transfer_or_receives']
                                ->whereIn('destination_id', $data['store_id'])
                                ->where('product_id', $row->product_id)
                                ->sum('qty');

                            $balance =
                                $liftings +
                                $sales_returns +
                                $receives -
                                $lifting_returns -
                                $sales -
                                $retail_sales -
                                $transfers -
                                $online_sales;
                        @endphp

                        @if ((is_null($row->alert_quantity) && $balance > 1) || $row->alert_quantity > $balance)
                            @continue
                        @endif
                        <tr>
                            <td class="text-center">{{ $key++ }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->category_name }}</td>
                            <td>{{ $row->attribute_name }}</td>
                            <td class="text-right">{{ number_format($balance) }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        @else
            <thead class="text-nowrap">
                <tr>
                    <th class="text-center" width="20">Sl#</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Variant</th>
                    <th>UOM</th>
                    <th class="text-right">Balance</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data) > 0)
                    @foreach ($data['searched_products'] as $row)
                        @php
                            $liftings = $data['liftings']->where('sku_id', $row->sku_id)->sum('qty');
                            $lifting_returns = $data['lifting_returns']->where('sku_id', $row->sku_id)->sum('qty');
                            $sales = $data['sales']->where('sku_id', $row->sku_id)->sum('qty');
                            $sales_returns = $data['sales_returns']->where('sku_id', $row->sku_id)->sum('qty');
                            $online_sales = $data['online_sales']->where('sku_id', $row->sku_id)->sum('qty');
                            $retail_sales = $data['retail_sales']->where('sku_id', $row->sku_id)->sum('qty');
                            $transfers = $data['transfer_or_receives']
                                ->whereIn('host_id', $data['store_id'])
                                ->where('sku_id', $row->sku_id)
                                ->sum('qty');
                            $receives = $data['transfer_or_receives']
                                ->whereIn('destination_id', $data['store_id'])
                                ->where('sku_id', $row->sku_id)
                                ->sum('qty');

                            $balance =
                                $liftings +
                                $sales_returns +
                                $receives -
                                $lifting_returns -
                                $sales -
                                $retail_sales -
                                $transfers -
                                $online_sales;
                        @endphp

                        @if ((is_null($row->alert_quantity) && $balance > 1) || $row->alert_quantity > $balance)
                            @continue
                        @endif
                        <tr>
                            <td class="text-center">{{ $key++ }}</td>
                            <td>{{ $row->name }} ({{ $row->code }})</td>
                            <td>{{ $row->category_name }}</td>
                            <td>{{ $row->sku }}</td>
                            <td>{{ $row->attribute_name }}</td>
                            <td class="text-right">{{ number_format($balance) }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        @endif
    </table>
    <div style="padding-top: 30px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
