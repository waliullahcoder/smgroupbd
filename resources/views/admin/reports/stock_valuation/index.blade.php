@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <input type="hidden" name="filter" value="1">
    <div class="row g-3">
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
            <thead>
                <tr>
                    <th class="text-center" width="40px" rowspan="2">SL#</th>
                    <th rowspan="2">Product Name</th>
                    <th rowspan="2">Code</th>
                    <th rowspan="2">UOM</th>
                    <th class="text-center" rowspan="2">Stock Qty</th>
                    <th class="text-center" colspan="2">Purchase value</th>
                    <th class="text-center" colspan="2">Whole Sales value</th>
                    <th class="text-center" colspan="2">Retail value</th>
                </tr>
                <tr>
                    <th class="text-center">Cost</th>
                    <th class="text-center">Value</th>
                    <th class="text-center">Rate</th>
                    <th class="text-center">Value</th>
                    <th class="text-center">Rate</th>
                    <th class="text-center">Value</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $key = 1;
                    $total_qty = 0;
                    $total_cost_value = 0;
                    $total_sale_value = 0;
                    $total_online_value = 0;
                @endphp
                @if (isset($data['stocks']) && count($data['stocks']) > 0)
                    @foreach ($data['stocks'] as $row)
                        @php
                            $cost_value = ($row->stock_qty ?? 0) * ($row->product->price->lifting_price ?? 0);
                            $sale_value = ($row->stock_qty ?? 0) * ($row->product->price->sale_price ?? 0);
                            $online_value = ($row->stock_qty ?? 0) * ($row->product->price->online_price ?? 0);

                            $total_qty += $row->stock_qty ?? 0;
                            $total_cost_value += $cost_value;
                            $total_sale_value += $sale_value;
                            $total_online_value += $online_value;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $key++ }}</td>
                            <td class="">{{ $row->product->name ?? '' }}</td>
                            <td class="">{{ $row->product->code ?? '' }}</td>
                            <td class="">{{ $row->product->attribute->name ?? '' }}</td>
                            <td class="text-center">{{ number_format($row->stock_qty, 2) }}</td>
                            <td class="text-center">{{ number_format($row->product->price->lifting_price ?? 0, 2, '.', ',') }}</td>
                            <td class="text-center">
                                {{ number_format($cost_value, 2, '.', ',') }}
                            </td>
                            <td class="text-center">{{ number_format($row->product->price->sale_price ?? 0, 2, '.', ',') }}</td>
                            <td class="text-center">
                                {{ number_format($sale_value, 2, '.', ',') }}
                            </td>
                            <td class="text-center">{{ number_format($row->product->price->online_price ?? 0, 2, '.', ',') }}
                            </td>
                            <td class="text-center">
                                {{ number_format($online_value, 2, '.', ',') }}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            @if (isset($data['stocks']) && count($data['stocks']) > 0)
                <tfoot>
                    <tr class="bg-primary">
                        <th colspan="4" class="text-white text-end">Total</th>
                        <th class="text-white text-center">{{ number_format($total_qty, 2, '.', ',') }}</th>
                        <th colspan="1" class="text-white text-center"></th>
                        <th class="text-white text-center">{{ number_format($total_cost_value, 2, '.', ',') }}</th>
                        <th colspan="1" class="text-white text-center"></th>
                        <th class="text-white text-center">{{ number_format($total_sale_value, 2, '.', ',') }}</th>
                        <th colspan="1" class="text-white text-center"></th>
                        <th class="text-white text-center">{{ number_format($total_online_value, 2, '.', ',') }}</th>
                    </tr>
                </tfoot>
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
                let category_id = $(this).val();
                let url = "{{ Route('admin.stock-status.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        category_id: category_id,
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
