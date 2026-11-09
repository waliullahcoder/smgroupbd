@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="report_type" class="form-label"><b>Report Type</b></label>
            <select name="report_type" id="report_type" class="form-select select" data-placeholder="Report Type">
                <option value="history" {{ $report_type == 'history' ? 'selected' : '' }}>History</option>
                <option value="summary" {{ $report_type == 'summary' ? 'selected' : '' }}>Summary</option>
            </select>
        </div>
        {{-- <div class="col-md-3 col-sm-6">
            <label for="product_type" class="form-label"><b>Product Type</b></label>
            <select name="product_type" id="product_type" class="form-select select" data-placeholder="Product Type">
                <option value="Consumer" {{ request('product_type') == 'Consumer' ? 'selected' : '' }}>Consumer</option>
                <option value="Fashion" {{ request('product_type') == 'Fashion' ? 'selected' : '' }}>Fashion</option>
            </select>
        </div> --}}
        <div class="col-md-4 col-sm-6">
            <label for="vendor_id" class="form-label"><b>Vendor</b></label>
            <select name="vendor_id[]" id="vendor_id" class="form-select select" data-placeholder="Select Vendor" multiple>
                <option value=""></option>
                @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}"
                        {{ !is_null($vendor_ids) && in_array($vendor->id, $vendor_ids) ? 'selected' : '' }}>
                        {{ $vendor->name }}</option>
                @endforeach
            </select>
        </div>
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
                value="{{ date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date)) }}">
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="category_id" class="form-label"><b>Category</b></label>
            <select name="category_id[]" id="category_id" class="form-select select" data-placeholder="Select Category"
                multiple>
                <option value=""></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ !is_null($category_ids) && in_array($category->id, $category_ids) ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select name="product_id[]" id="product_id" class="form-select select" data-placeholder="Select Product"
                multiple>
                <option value=""></option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}"
                        {{ !is_null($product_ids) && in_array($product->id, $product_ids) ? 'selected' : '' }}>
                        {{ $product->name }} ({{ $product->code }})</option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

@section('content')
    {!! $dataTable->table(['class' => 'dataTable table align-middle table-bordered']) !!}
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#category_id, #vendor_id, #product_type', function(e) {
                let category_id = $('#category_id').val();
                var vendor_id = $('#vendor_id').val();
                var product_type = $('#product_type').val();
                let url = "{{ Route('admin.lifting-return-history.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        getProducts: true,
                        category_id: category_id,
                        vendor_id: vendor_id,
                        product_type: product_type,
                    },
                    success: (response) => {
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
