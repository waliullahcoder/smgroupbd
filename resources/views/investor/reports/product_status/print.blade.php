@extends('layouts.investor.print_app')

@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle mb-3">
        @if (request('product_type') == 'Consumer' || is_null(request('product_type')))
            <thead>
                <tr class="text-nowrap">
                    <th class="text-center" width="40px">Sl#</th>
                    <th>Product Name</th>
                    <th>Code</th>
                    <th>UOM</th>
                    <th class="text-right">Opening</th>
                    <th class="text-right">Lifting</th>
                    <th class="text-right">L Return</th>
                    <th class="text-right">Sales</th>
                    <th class="text-right">S Return</th>
                    <th class="text-right">Transfer</th>
                    <th class="text-right">Received</th>
                    <th class="text-right">Online Sales</th>
                    <th class="text-right">Balance</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data) > 0)
                    @foreach ($data['searched_products'] as $row)
                        @php
                            $opening_liftings = $data['liftings']
                                ->where('product_id', $row->product_id)
                                ->where('date', '<', $data['start_date'])
                                ->sum('qty');

                            $opening_lifting_returns = $data['lifting_returns']
                                ->where('product_id', $row->product_id)
                                ->where('date', '<', $data['start_date'])
                                ->sum('qty');

                            $opening_sales = $data['sales']
                                ->where('product_id', $row->product_id)
                                ->where('date', '<', $data['start_date'])
                                ->sum('qty');

                            $opening_sales_returns = $data['sales_returns']
                                ->where('product_id', $row->product_id)
                                ->where('date', '<', $data['start_date'])
                                ->sum('qty');

                            $opening_online_sales = $data['online_sales']
                                ->where('product_id', $row->product_id)
                                ->where('date', '<', $data['start_date'])
                                ->sum('qty');

                            $opening_transfers = $data['transfer_or_receives']
                                ->whereIn('host_id', $data['store_id'])
                                ->where('product_id', $row->product_id)
                                ->where('date', '<', $data['start_date'])
                                ->sum('qty');

                            $opening_receives = $data['transfer_or_receives']
                                ->whereIn('destination_id', $data['store_id'])
                                ->where('product_id', $row->product_id)
                                ->where('date', '<', $data['start_date'])
                                ->sum('qty');
                            $opening =
                                $opening_liftings +
                                $opening_sales_returns +
                                $opening_receives -
                                $opening_lifting_returns -
                                $opening_sales -
                                $opening_transfers -
                                $opening_online_sales;

                            $liftings = $data['liftings']
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');

                            $lifting_returns = $data['lifting_returns']
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');

                            $sales = $data['sales']
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');

                            $sales_returns = $data['sales_returns']
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');

                            $online_sales = $data['online_sales']
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');

                            $transfers = $data['transfer_or_receives']
                                ->whereIn('host_id', $data['store_id'])
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');

                            $receives = $data['transfer_or_receives']
                                ->whereIn('destination_id', $data['store_id'])
                                ->where('product_id', $row->product_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');

                            $balance =
                                $opening +
                                $liftings +
                                $sales_returns +
                                $receives -
                                $lifting_returns -
                                $sales -
                                $transfers -
                                $online_sales;
                        @endphp

                        @if ($opening == 0 && $liftings == 0 && $sales_returns && $receives && $lifting_returns && $sales && $transfers && $online_sales)
                            @continue
                        @endif
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->code }}</td>
                            <td>{{ $row->attribute_name }}</td>
                            <td class="text-right">{{ number_format($opening, 2, '.', ',') }}</td>
                            <td class="text-right">
                                {{ number_format($liftings, 2, '.', ',') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($lifting_returns, 2, '.', ',') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($sales, 2, '.', ',') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($sales_returns, 2, '.', ',') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($transfers, 2, '.', ',') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($receives, 2, '.', ',') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($online_sales, 2, '.', ',') }}
                            </td>
                            <td class="text-right">{{ number_format($balance, 2, '.', ',') }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        @else
            <thead class="text-nowrap">
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Product Name</th>
                    <th>Variant</th>
                    <th class="text-right">Opening</th>
                    <th class="text-right">Lifting</th>
                    <th class="text-right">Lifting Return</th>
                    <th class="text-right">Sales</th>
                    <th class="text-right">Sales Return</th>
                    <th class="text-right">Transfer</th>
                    <th class="text-right">Received</th>
                    <th class="text-right">Online Sales</th>
                    <th class="text-right">Stock Balance</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data) > 0)
                    @foreach ($data['searched_products'] as $row)
                        @php
                            $opening_liftings = $data['liftings']
                                ->where('sku_id', $row->sku_id)
                                ->where('date', '<', $data['start_date'])
                                ->sum('qty');

                            $opening_lifting_returns = $data['lifting_returns']
                                ->where('sku_id', $row->sku_id)
                                ->where('date', '<', $data['start_date'])
                                ->sum('qty');

                            $opening_sales = $data['sales']
                                ->where('sku_id', $row->sku_id)
                                ->where('date', '<', $data['start_date'])
                                ->sum('qty');

                            $opening_sales_returns = $data['sales_returns']
                                ->where('sku_id', $row->sku_id)
                                ->where('date', '<', $data['start_date'])
                                ->sum('qty');

                            $opening_online_sales = $data['online_sales']
                                ->where('sku_id', $row->sku_id)
                                ->where('date', '<', $data['start_date'])
                                ->sum('qty');

                            $opening_transfers = $data['transfer_or_receives']
                                ->whereIn('host_id', $data['store_id'])
                                ->where('sku_id', $row->sku_id)
                                ->where('date', '<', $data['start_date'])
                                ->sum('qty');

                            $opening_receives = $data['transfer_or_receives']
                                ->whereIn('destination_id', $data['store_id'])
                                ->where('sku_id', $row->sku_id)
                                ->where('date', '<', $data['start_date'])
                                ->sum('qty');

                            $opening =
                                $opening_liftings +
                                $opening_sales_returns +
                                $opening_receives -
                                $opening_lifting_returns -
                                $opening_sales -
                                $opening_transfers -
                                $opening_online_sales;

                            $liftings = $data['liftings']
                                ->where('sku_id', $row->sku_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');

                            $lifting_returns = $data['lifting_returns']
                                ->where('sku_id', $row->sku_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');

                            $sales = $data['sales']
                                ->where('sku_id', $row->sku_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');

                            $sales_returns = $data['sales_returns']
                                ->where('sku_id', $row->sku_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');

                            $online_sales = $data['online_sales']
                                ->where('sku_id', $row->sku_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');

                            $transfers = $data['transfer_or_receives']
                                ->whereIn('host_id', $data['store_id'])
                                ->where('sku_id', $row->sku_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');

                            $receives = $data['transfer_or_receives']
                                ->whereIn('destination_id', $data['store_id'])
                                ->where('sku_id', $row->sku_id)
                                ->where('date', '>=', $data['start_date'])
                                ->where('date', '<=', $data['end_date'])
                                ->sum('qty');

                            $balance =
                                $opening +
                                $liftings +
                                $sales_returns +
                                $receives -
                                $lifting_returns -
                                $sales -
                                $transfers -
                                $online_sales;
                        @endphp

                        @if ($opening == 0 && $liftings == 0 && $sales_returns && $receives && $lifting_returns && $sales && $transfers && $online_sales)
                            @continue
                        @endif
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->sku }}</td>
                            <td class="text-right">{{ number_format($opening, 2, '.', ',') }}</td>
                            <td class="text-right">
                                {{ number_format($liftings, 2, '.', ',') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($lifting_returns, 2, '.', ',') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($sales, 2, '.', ',') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($sales_returns, 2, '.', ',') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($transfers, 2, '.', ',') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($receives, 2, '.', ',') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($online_sales, 2, '.', ',') }}
                            </td>
                            <td class="text-right">{{ number_format($balance, 2, '.', ',') }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        @endif
    </table>
    <div style="padding-top: 30px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
