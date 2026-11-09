@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="date_range" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required value="{{ date('d-m-Y') . ' to ' . date('d-m-Y') }}">
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="category_id" class="form-label"><b>Category</b></label>
            <select name="category_id" id="category_id" class="form-select select" data-placeholder="Select Category"
                multiple>
                <option value=""></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="product_id" class="form-label"><b>Product</b></label>
            <select name="product_id" id="product_id" class="form-select select" data-placeholder="Select Product" multiple>
                <option value=""></option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }} ({{ $product->code }})
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

@section('content')
    @php
        $currentRouteName = \Request::route()->getName();
        $link = Route($currentRouteName);
    @endphp
    <form action="{{ $link }}" id="print-form" method="GET" target="_blank">
        <input type="hidden" name="print" value="true">
        <input type="hidden" name="date_range" class="date_range">
        <input type="hidden" name="category_id" class="category_id">
        <input type="hidden" name="product_id" class="product_id">
    </form>
    {!! $dataTable->table() !!}
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}

    <script type="text/javascript">
        $(document).ready(function() {
            const table = $('#dataTable');
            table.on('preXhr.dt', function(e, settings, data) {
                data.date_range = $('#date_range').val();
                data.category_id = $('#category_id').val();
                data.product_id = $('#product_id').val();
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                var date_range = $('#date_range').val();
                var category_id = $('#category_id').val();
                var product_id = $('#product_id').val();
                $('.date_range').val(date_range);
                $('.category_id').val(category_id);
                $('.product_id').val(product_id);
                $('#print-form').submit();
            });

            $(document).on('change', '#category_id', function(e) {
                let category_id = $('#category_id').val();
                $.ajax({
                    url: "{{ $link }}",
                    type: "POST",
                    data: {
                        _method: 'GET',
                        category_id: category_id,
                        get_products: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#product_id option').remove();
                            $('#product_id').append('<option value=""></option>');
                            $.each(response.products, function(key, value) {
                                var html =
                                    `<option value="${value.id}">${value.name}${value.code}</option>`;
                                $('#product_id').append(html);
                            });
                            $('#product_id').select2();
                        }
                    }
                });
            });
        });
    </script>
@endpush
