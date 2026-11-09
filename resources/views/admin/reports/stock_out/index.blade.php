@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <input type="hidden" name="print" value="">
        <input type="hidden" name="filter" value="1">
        <div class="col-md-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Store</b></label>
            <select name="store_id[]" id="store_id" class="form-select select" data-placeholder="Select Store" multiple>
                <option value=""></option>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}"
                        {{ is_array($store_id) && in_array($store->id, $store_id) ? 'selected' : '' }}>
                        {{ $store->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="category_id" class="form-label"><b>Category</b></label>
            <select name="category_id[]" id="category_id" class="form-select select" data-placeholder="Select Category"
                multiple>
                <option value=""></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ is_array($category_id) && in_array($category->id, $category_id) ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select name="product_id[]" id="product_id" class="form-select select" data-placeholder="Select Products"
                multiple>
                <option value=""></option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}"
                        {{ is_array($product_id) && in_array($product->id, $product_id) ? 'selected' : '' }}>
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
                        <th class="px-3 text-center" width="20">SL#</th>
                        <th class="px-3">Product</th>
                        <th class="px-3">Category</th>
                        <th class="px-3">UOM</th>
                        <th class="px-3 text-center" width="90">Stock</th>
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
                                $sales_returns = $data['sales_returns']
                                    ->where('product_id', $row->product_id)
                                    ->sum('qty');
                                $online_sales = $data['online_sales']
                                    ->where('product_id', $row->product_id)
                                    ->sum('qty');
                                $retail_sales = $data['retail_sales']
                                    ->where('product_id', $row->product_id)
                                    ->sum('qty');
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

                            @if ($balance > ($row->alert_quantity ?? 1))
                                @continue
                            @endif
                            <tr>
                                <td class="text-center px-3">{{ $key++ }}</td>
                                <td class="px-3">{{ $row->name }} ({{ $row->code }})</td>
                                <td class="px-3">{{ $row->category_name }}</td>
                                <td class="px-3">{{ $row->attribute_name }}</td>
                                <td class="text-center px-3">{{ number_format($balance) }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            @else
                <thead class="text-nowrap">
                    <tr>
                        <th class="px-3 text-center" width="20">SL#</th>
                        <th class="px-3">Product Name</th>
                        <th class="px-3">Category</th>
                        <th class="px-3">UOM</th>
                        <th class="px-3 text-center">Stock</th>
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
                                <td class="text-center px-3">{{ $key++ }}</td>
                                <td class="px-3">{{ $row->name }} ({{ $row->code }})</td>
                                <td class="px-3">{{ $row->category_name }}</td>
                                <td class="px-3">{{ $row->attribute_name }}</td>
                                <td class="text-center px-3">{{ number_format($balance) }}</td>
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

            $(document).on('change', '#category_id', function() {
                let category_id = $('#category_id').val();
                let url = "{{ Route('admin.stock-out.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        category_id: category_id
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
