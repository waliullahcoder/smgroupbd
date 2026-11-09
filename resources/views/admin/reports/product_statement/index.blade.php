@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <div class="row g-3">
        <input type="hidden" name="filter" value="1">
        <div class="col-md-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Store</b></label>
            <select name="store_id" id="store_id" class="form-select select" data-placeholder="Select Store">
                <option value=""></option>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}" {{ $store->id == $store_id ? 'selected' : '' }}>
                        {{ $store->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="date_range" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required
                value="{{ !is_null($start_date) && !is_null($end_date) ? date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date)) : date('d-m-Y') . ' to ' . date('d-m-Y') }}">
        </div>
        <div class="col-md-4 col-sm-6" id="product_area">
            <label for="product_id" class="form-label"><b>Product <span class="text-danger">*</span></b></label>
            <select name="product_id" id="product_id" class="form-select select" data-placeholder="Select Product" required>
                <option value=""></option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $product->id == $product_id ? 'selected' : '' }}>
                        {{ $product->name }} - {{ $product->code }}
                    </option>
                @endforeach
            </select>
        </div>
        @if (request('product_type') == 'Fashion')
            <div class="col-md-3 col-sm-6" id="variant_area">
                <label for="variant_id" class="form-label"><b>Variant</b></label>
                <select name="variant_id" id="variant_id" class="select form-select" data-placeholder="Select Variant"
                    required>
                    <option value=""></option>
                    @php
                        $variants = App\Models\ProductSku::where('product_id', $product_id)->get();
                    @endphp
                    @foreach ($variants as $item)
                        <option value="{{ $item->id }}" {{ request('variant_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->sku }}</option>
                    @endforeach
                </select>
            </div>
        @endif
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th class="px-3" colspan="3">
                        @if (@$data['variant']->sku)
                            {{ @$data['variant']->product->name . (@$data['variant']->sku ? ' - ( ' . @$data['variant']->sku . ' )' : '') }}
                        @else
                            {{ @$data['product']->name . (@$data['product']->code ? ' - ( ' . @$data['product']->code . ' )' : '') }}
                        @endif
                    </th>
                    <th class="px-3 text-end" colspan="2">Previous Balance</th>
                    <th class="px-3 text-end">{{ number_format($data['opening'], 2, '.', ',') }}</th>
                </tr>
                <tr>
                    <th class="px-3 text-center" width="40px">Sl#</th>
                    <th class="px-3">Date</th>
                    <th class="px-3">Description</th>
                    <th class="px-3 text-end">Stock In</th>
                    <th class="px-3 text-end">Stock Out</th>
                    <th class="px-3 text-end">Balance</th>
                </tr>
            </thead>
            @php
                $ballance = $data['opening'];
                $total_stock_in = 0;
                $total_stock_out = 0;
            @endphp
            @if (count($data['statements']) > 0)
                <tbody>
                    @foreach ($data['statements'] as $row)
                        <tr>
                            <td class="text-center px-3">{{ $loop->iteration }}</td>
                            <td class="px-3">{{ $row['date'] }}</td>
                            <td class="px-3">{{ $row['particulars'] }}</td>
                            <td class="px-3 text-end">{{ number_format($row['stock_in'], 2, '.', ',') }}</td>
                            <td class="px-3 text-end">{{ number_format($row['stock_out'], 2, '.', ',') }}</td>
                            <td class="px-3 text-end">{{ number_format($row['balance'], 2, '.', ',') }}</td>
                        </tr>
                        @php
                            $ballance = $row['balance'];
                            $total_stock_in += $row['stock_in'];
                            $total_stock_out += $row['stock_out'];
                        @endphp
                    @endforeach
                </tbody>
            @endif
            <tfoot>
                <tr class="bg-primary text-white">
                    <th colspan="3" class="text-end px-3 text-white">Total Summary</th>
                    <th class="text-end px-3 text-white">{{ number_format($total_stock_in, 2, '.', ',') }}</th>
                    <th class="text-end px-3 text-white">{{ number_format($total_stock_out, 2, '.', ',') }}</th>
                    <th class="text-end px-3 text-white">{{ number_format($ballance, 2, '.', ',') }}</th>
                </tr>
            </tfoot>
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

            $(document).on('change', '#product_type', function(e) {
                var product_type = $('#product_type').val();
                let url = "{{ Route('admin.product-statement.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        product_type: product_type,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#product_id option').remove();
                            $('#product_id').append('<option value=""></option>');
                            $.each(response.products, function(key, value) {
                                var html =
                                    `<option value="${value.id}">${value.name}(${value.code})</option>`;
                                $('#product_id').append(html);
                            });
                        }
                    }
                });

                if (product_type == 'Fashion') {
                    $('#product_area').after(`<div class="col-md-3 col-sm-6" id="variant_area">
                            <label for="variant_id" class="form-label"><b>Variant</b></label>
                            <select name="variant_id" id="variant_id" class="select form-select" data-placeholder="Select Variant" required>
                                <option value=""></option>
                            </select>
                        </div>`);
                } else {
                    $('#variant_area').remove();
                }

                $('.select').select2({
                    allowClear: true,
                });
            });

            $(document).on('change', '#product_id', function(e) {
                var product_id = $('#product_id').val();
                var product_type = $('#product_type').val();
                if (product_type == 'Fashion') {
                    let url = "{{ Route('admin.product-statement.index') }}";
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _method: 'GET',
                            product_id: product_id,
                            get_variants: true,
                        },
                        success: (response) => {
                            if (response.status == 'success') {
                                $('#variant_id option').remove();
                                $('#variant_id').append('<option value=""></option>');
                                $.each(response.variants, function(key, value) {
                                    var html =
                                        `<option value="${value.id}">${value.sku}</option>`;
                                    $('#variant_id').append(html);
                                });
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.getPdf', function(e) {
                var product_id = $('#product_id').val();
                if (product_id == '') {
                    Swal.fire({
                        width: "22rem",
                        toast: true,
                        position: 'top-right',
                        text: "Please select a product",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }
                $('input[name="print"]').val('true');
                $('.filter_form')[0].setAttribute("target", "_blank");
                $('.filter_form').submit();
            });

            $(document).on('click', '#filter_btn', function(e) {
                $('input[name="print"]').val('');
                $('.filter_form')[0].setAttribute("target", "_self");
            });
        });
    </script>
@endpush
