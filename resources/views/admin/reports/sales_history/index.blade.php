@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <div class="row g-3">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="report_type" class="form-label"><b>Report Type</b></label>
            <select name="report_type" id="report_type" class="form-select select" data-placeholder="Report Type">
                <option value="history" {{ $report_type == 'history' ? 'selected' : '' }}>History</option>
                <option value="product_summary" {{ $report_type == 'product_summary' ? 'selected' : '' }}>Product Summary
                </option>
                <option value="client_summary" {{ $report_type == 'client_summary' ? 'selected' : '' }}>Client Summary
                </option>
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="sales_type" class="form-label"><b>Sales Type</b></label>
            <select name="sales_type" id="sales_type" class="form-select select" data-placeholder="Sales Type">
                <option value="credit" {{ request('sales_type') == 'credit' ? 'selected' : '' }}>Regular</option>
                <option value="sample" {{ request('sales_type') == 'sample' ? 'selected' : '' }}>Sample</option>
                <option value="POS" {{ request('sales_type') == 'POS' ? 'selected' : '' }}>POS</option>
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="date_range" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y" data-separator=" to "
                autocomplete="off" required
                value="{{ date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date)) }}">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="category_id" class="form-label"><b>Category</b></label>
            <select name="category_id[]" id="category_id" class="form-select select" data-placeholder="Select Category"
                multiple>
                <option value=""></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ !is_null($category_id) && in_array($category->id, $category_id) ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
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
        <div class="col-sm-6">
            <label for="staff_id" class="form-label"><b>Staff</b></label>
            <select name="staff_id[]" id="staff_id" class="form-select select" data-placeholder="Select Staff" multiple>
                <option value=""></option>
                @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}"
                        {{ is_array($staff_id) && in_array($staff->id, $staff_id) ? 'selected' : '' }}>
                        {{ $staff->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="client_id" class="form-label"><b>Client</b></label>
            <select name="client_id[]" id="client_id" class="form-select select" data-placeholder="Select Client" multiple>
                <option value=""></option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}"
                        {{ is_array($client_id) && in_array($client->id, $client_id) ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="product_id" class="form-label"><b>Product</b></label>
            <select name="product_id[]" id="product_id" class="form-select select" data-placeholder="Select Product"
                multiple>
                <option value=""></option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}"
                        {{ is_array($product_id) && in_array($product->id, $product_id) ? 'selected' : '' }}>
                        {{ $product->name }} ({{ $product->code }})
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

@section('content')
    {!! $dataTable->table(['class' => 'dataTable table align-middle table-bordered'], true) !!}
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#region_id', function() {
                let region_id = $(this).val();
                let url = "{{ Route('admin.return-history.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_area: true,
                        region_id: region_id,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#area_id option').remove();
                            $('#territory_id option').remove();
                            $('#area_id').append('<option value=""></option>');
                            $.each(response.areas, function(key, value) {
                                var html =
                                    `<option value="${value.id}">${value.name}</option>`;
                                $('#area_id').append(html);
                            });
                        }
                    }
                });
            });

            $(document).on('change', '#area_id', function() {
                let area_id = $(this).val();
                let url = "{{ Route('admin.return-history.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_territory: true,
                        area_id: area_id,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#territory_id option').remove();
                            $('#territory_id').append('<option value=""></option>');
                            $.each(response.territories, function(key, value) {
                                var html =
                                    `<option value="${value.id}">${value.name}</option>`;
                                $('#territory_id').append(html);
                            });
                            $('#client_id option').remove();
                            $('#client_id').append('<option value=""></option>');
                            $.each(response.clients, function(key, value) {
                                var html =
                                    `<option value="${value.id}">${value.name}</option>`;
                                $('#client_id').append(html);
                            });
                        }
                    }
                });
            });

            $(document).on('change', '#territory_id', function() {
                let territory_id = $(this).val();
                let url = "{{ Route('admin.return-history.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_clients: true,
                        territory_id: territory_id,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#client_id option').remove();
                            $('#client_id').append('<option value=""></option>');
                            $.each(response.clients, function(key, value) {
                                var html =
                                    `<option value="${value.id}">${value.name}</option>`;
                                $('#client_id').append(html);
                            });
                        }
                    }
                });
            });

            $(document).on('change', '#category_id', function(e) {
                let category_id = $('#category_id').val();
                let url = "{{ Route('admin.sales-history.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_products: 'true',
                        category_id: category_id,
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
                            $('#product_id').select2();
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
