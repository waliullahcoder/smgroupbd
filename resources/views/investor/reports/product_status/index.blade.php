@extends('layouts.investor.report_app')

@section('form')
    <div class="row g-3">
        <input type="hidden" name="print" value="">
        <input type="hidden" name="filter" value="1">
        <div class="col-md-3 col-sm-6">
            <label for="store_id" class="form-label"><b>Store</b></label>
            <select name="store_id[]" id="store_id" class="form-select select" data-placeholder="Select Store" multiple>
                <option value=""></option>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}"
                        {{ is_array(request('store_id')) && in_array($store->id, request('store_id')) ? 'selected' : '' }}>
                        {{ $store->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="date_range" class="form-label"><b>Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required
                value="{{ !is_null($start_date) && !is_null($end_date) ? date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date)) : date('d-m-Y') . ' to ' . date('d-m-Y') }}">
        </div>
        <div class="col-sm-6">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select name="product_id[]" id="product_id" class="form-select select" data-placeholder="Select Products"
                multiple>
                <option value=""></option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}"
                        {{ is_array(request('product_id')) && in_array($product->id, request('product_id')) ? 'selected' : '' }}>
                        {{ $product->name }} ({{ $product->code }})</option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-sm">
            @if (request('product_type') == 'Consumer' || is_null(request('product_type')))
                <thead class="text-nowrap">
                    <tr>
                        <th class="px-3 text-center" width="40px">SL#</th>
                        <th class="px-3">Product</th>
                        <th class="px-3 text-center" width="90">Opening</th>
                        <th class="px-3 text-center" width="90">Lifting</th>
                        <th class="px-3 text-center" width="90">Lifting Return</th>
                        <th class="px-3 text-center" width="90">Sales</th>
                        <th class="px-3 text-center" width="90">Sales Return</th>
                        <th class="px-3 text-center" width="90">Transfer</th>
                        <th class="px-3 text-center" width="90">Received</th>
                        <th class="px-3 text-center" width="90">Online Sales</th>
                        <th class="px-3 text-center" width="90">Stock Balance</th>
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

                            @if (
                                $opening == 0 &&
                                    $liftings == 0 &&
                                    $sales_returns &&
                                    $receives &&
                                    $lifting_returns &&
                                    $sales &&
                                    $transfers &&
                                    $online_sales)
                                @continue
                            @endif
                            <tr>
                                <td class="text-center px-3">{{ $loop->iteration }}</td>
                                <td class="px-3">{{ $row->name }} ({{ $row->code }}) - {{ $row->attribute_name }}
                                </td>
                                <td class="text-center px-3">{{ number_format($opening, 2, '.', ',') }}</td>
                                <td class="text-center px-3">
                                    {{ number_format($liftings, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-3">
                                    {{ number_format($lifting_returns, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-3">
                                    {{ number_format($sales, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-3">
                                    {{ number_format($sales_returns, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-3">
                                    {{ number_format($transfers, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-3">
                                    {{ number_format($receives, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-3">
                                    {{ number_format($online_sales, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-3">{{ number_format($balance, 2, '.', ',') }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            @else
                <thead class="text-nowrap">
                    <tr>
                        <th class="px-3 text-center" width="40px">SL#</th>
                        <th class="px-3">Product Name</th>
                        <th class="px-3">Variant</th>
                        <th class="px-3 text-center">Opening</th>
                        <th class="px-3 text-center">Lifting</th>
                        <th class="px-3 text-center">Lifting Return</th>
                        <th class="px-3 text-center">Sales</th>
                        <th class="px-3 text-center">Sales Return</th>
                        <th class="px-3 text-center">Transfer</th>
                        <th class="px-3 text-center">Received</th>
                        <th class="px-3 text-center">Online Sales</th>
                        <th class="px-3 text-center">Stock Balance</th>
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

                            @if (
                                $opening == 0 &&
                                    $liftings == 0 &&
                                    $sales_returns &&
                                    $receives &&
                                    $lifting_returns &&
                                    $sales &&
                                    $transfers &&
                                    $online_sales)
                                @continue
                            @endif
                            <tr>
                                <td class="text-center px-3">{{ $loop->iteration }}</td>
                                <td class="px-3">{{ $row->name }}</td>
                                <td class="px-3">{{ $row->sku }}</td>
                                <td class="text-center px-3">{{ number_format($opening, 2, '.', ',') }}</td>
                                <td class="text-center px-3">
                                    {{ number_format($liftings, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-3">
                                    {{ number_format($lifting_returns, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-3">
                                    {{ number_format($sales, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-3">
                                    {{ number_format($sales_returns, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-3">
                                    {{ number_format($transfers, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-3">
                                    {{ number_format($receives, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-3">
                                    {{ number_format($online_sales, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-3">{{ number_format($balance, 2, '.', ',') }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            @endif
        </table>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "order": false,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    {
                        'text': '<i class="fal fa-file-pdf"></i> Print',
                        'className': 'getPdf',
                    },
                ]
            });

            $(document).on('change', '#category_id,#product_type', function() {
                let category_id = $('#category_id').val();
                let product_type = $('#product_type').val();
                let url = "{{ Route('investor.product-status.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        category_id: category_id,
                        product_type: product_type,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#product_id option').remove();
                            $('#product_id').append('<option value=""></option>');
                            $.each(response.products, function(key, value) {
                                var html =
                                    `<option value="${value.id}">${value.name} (${value.code})</option>`;
                                $('#product_id').append(html);
                            });
                            $('.select').select2();
                        }
                    }
                });
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                $('input[name="print"]').val('true');
                $('.filter_form')[0].setAttribute("target", "_blank");
                $('.filter_form').submit();
            });

            $(document).on('click', '#filter_btn', function(e) {
                e.preventDefault();
                $('input[name="print"]').val('');
                $('.filter_form')[0].setAttribute("target", "_self");
                $('.filter_form').submit();
            });
        });
    </script>
@endpush
