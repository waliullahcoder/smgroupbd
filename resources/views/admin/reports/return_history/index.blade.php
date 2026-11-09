@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="report_type" class="form-label"><b>Report Type</b></label>
            <select name="report_type" id="report_type" class="form-select select" data-placeholder="Report Type">
                <option value="history" {{ $report_type == 'history' ? 'selected' : '' }}>History</option>
                <option value="product_summary" {{ $report_type == 'product_summary' ? 'selected' : '' }}>Product Summary</option>
                <option value="client_summary" {{ $report_type == 'client_summary' ? 'selected' : '' }}>Client Summary</option>
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="date_range" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required
                value="{{ !is_null($start_date) && !is_null($end_date) ? $start_date . ' to ' . $end_date : date('d-m-Y') . ' to ' . date('d-m-Y') }}">
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="category_id" class="form-label"><b>Category</b></label>
            <select name="category_id[]" id="category_id" class="form-select select" data-placeholder="Select Category"
                multiple>
                <option value=""></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ is_array($category_id) && in_array($category->id, $category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="region_id" class="form-label"><b>Region</b></label>
            <select name="region_id" id="region_id" class="form-select select" data-placeholder="Select Region">
                <option value=""></option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" {{ $region->id == $region_id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="area_id" class="form-label"><b>Area</b></label>
            <select name="area_id" id="area_id" class="form-select select" data-placeholder="Select Area">
                <option value=""></option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ $area->id == $area_id ? 'selected' : '' }}>
                        {{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="territory_id" class="form-label"><b>Territory</b></label>
            <select name="territory_id" id="territory_id" class="form-select select" data-placeholder="Select Territory">
                <option value=""></option>
                @foreach ($territories as $territory)
                    <option value="{{ $territory->id }}" {{ $territory->id == $territory_id ? 'selected' : '' }}>
                        {{ $territory->name }}
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
            <select name="product_id[]" id="product_id" class="form-select select" data-placeholder="Select Product" multiple>
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
    <form action="{{ Route('admin.return-history.index') }}" id="print-form" method="GET" target="_blank">
        <input type="hidden" name="print" value="true">
        <input type="hidden" name="report_type" class="report_type">
        <input type="hidden" name="date_range" class="date_range">
        <input type="hidden" name="category_id" class="category_id">
        <input type="hidden" name="region_id" class="region_id">
        <input type="hidden" name="area_id" class="area_id">
        <input type="hidden" name="territory_id" class="territory_id">
        <input type="hidden" name="client_id" class="client_id">
        <input type="hidden" name="product_id" class="product_id">
    </form>
    {!! $dataTable->table() !!}
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
                            $('#territory_id option').remove();
                            $('#area_id option').remove();
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

            $(document).on('change', '#category_id', function() {
                let category_id = $(this).val();
                let url = "{{ Route('admin.return-history.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_products: true,
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
                        }
                    }
                });
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                var report_type = $('#report_type').val();
                var date_range = $('#date_range').val();
                var category_id = $('#category_id').val();
                var client_id = $('#client_id').val();
                var product_id = $('#product_id').val();
                var region_id = $('#region_id').val();
                var area_id = $('#area_id').val();
                var territory_id = $('#territory_id').val();
                $('.report_type').val(report_type);
                $('.date_range').val(date_range);
                $('.category_id').val(category_id);
                $('.client_id').val(client_id);
                $('.product_id').val(product_id);
                $('.region_id').val(region_id);
                $('.area_id').val(area_id);
                $('.territory_id').val(territory_id);

                if (date_range == '') {
                    $("#date_range").trigger("select");
                } else {
                    $('#print-form').submit();
                }
            });
        });
    </script>
@endpush
