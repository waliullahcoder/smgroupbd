@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <input type="hidden" name="filter" value="1">
    <div class="row g-3">
        <div class="col-md-3 col-sm-6">
            <label for="date_range" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y" data-separator=" to "
                autocomplete="off" required
                value="{{ date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date)) }}">
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="category_id" class="form-label"><b>Category</b></label>
            <select name="category_id[]" id="category_id" class="select form-select" data-placeholder="Select Category"
                multiple>
                <option value=""></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ is_array($category_id) && in_array($category->id, $category_id) ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select name="product_id[]" id="product_id" class="select form-select" data-placeholder="Select Product"
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
            <thead class="text-nowrap">
                <tr>
                    <th class="text-center" width="20">SL#</th>
                    <th>Category Name</th>
                    <th>Product Name</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Sales Amount</th>
                    <th class="text-end">Lifting Amount</th>
                    <th class="text-end">Profit Amount</th>
                    <th class="text-center">Profit</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_sales_qty = 0;
                    $total_sales_amount = 0;
                    $total_lifting_amount = 0;
                    $total_profit = 0;
                @endphp
                @if (isset($data['rows']))
                    @foreach ($data['rows'] as $i => $row)
                        @php
                            $total_sales_qty += $row['qty'];
                            $total_sales_amount += $row['sales_amount'];
                            $total_lifting_amount += $row['lifting'];
                            $total_profit += $row['profit'];
                        @endphp
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $row['product']->category->name }}</td>
                            <td>{{ $row['product']->name }}</td>
                            <td class="text-center">{{ number_format($row['qty'], 2) }}</td>
                            <td class="text-end">{{ number_format($row['sales_amount'], 2) }}</td>
                            <td class="text-end">{{ number_format($row['lifting'], 2) }}</td>
                            <td class="text-end">{{ number_format($row['profit'], 2) }}</td>
                            <td class="text-center">{{ number_format($row['percentage'], 2) }}%</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                @php
                    // Profit percentage
                    if ($total_sales_amount > 0) {
                        $overall_profit = $total_profit;
                        $overall_percentage = ($overall_profit / $total_sales_amount) * 100;
                    } else {
                        $overall_percentage = 0;
                    }
                @endphp
                <tr class="bg-primary">
                    <th class="text-white text-end" colspan="3">Total Summary</th>

                    <th class="text-white text-center">
                        {{ number_format($total_sales_qty, 2) }}
                    </th>

                    <th class="text-white text-end">
                        {{ number_format($total_sales_amount, 2) }}
                    </th>

                    <th class="text-white text-end">
                        {{ number_format($total_lifting_amount, 2) }}
                    </th>

                    <th class="text-white text-end">
                        {{ number_format($total_profit, 2) }}
                    </th>

                    <th class="text-center text-white">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success"
                                style="width:{{ round($overall_percentage) }}%; height:5px;">
                            </div>
                        </div>
                        <span class="progress-parcent text-white">
                            {{ number_format($overall_percentage, 2) }}%
                        </span>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                order: false,
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
                let url = "{{ Route('admin.product-wise-profit.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        category_id: category_id,
                        get_products: true,
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
