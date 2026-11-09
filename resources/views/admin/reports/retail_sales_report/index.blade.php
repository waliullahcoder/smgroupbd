@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <div class="row g-3">
        <div class="col-lg-3 col-sm-6">
            <label for="report_type" class="form-label"><b>Report Type</b></label>
            <select name="report_type" id="report_type" class="form-select select" data-placeholder="Report Type">
                <option value="invoice_wise" {{ request('report_type') == 'invoice_wise' ? 'selected' : '' }}>Invoice Wise
                </option>
                <option value="product_wise" {{ request('report_type') == 'product_wise' ? 'selected' : '' }}>Product Wise
                </option>
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="start_date" class="form-label"><b>Start Date</b></label>
            <input type="text" name="start_date" id="start_date" class="form-control date_picker"
                placeholder="Start Date" value="{{ date('d-m-Y', strtotime(request('start_date', date('d-m-Y')))) }}">
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="end_date" class="form-label"><b>End Date</b></label>
            <input type="text" name="end_date" id="end_date" class="form-control date_picker" placeholder="End Date"
                value="{{ date('d-m-Y', strtotime(request('end_date', date('d-m-Y')))) }}">
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="staff_id" class="form-label"><b>Staff</b></label>
            <select name="staff_id" id="staff_id" class="form-select select" data-placeholder="Select Staff">
                <option value=""></option>
                @foreach ($staffs as $item)
                    <option value="{{ $item->id }}" {{ request('staff_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}</option>
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
                        {{ is_array(request('category_id')) && in_array($category->id, request('category_id')) ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-8 col-sm-6">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select name="product_id[]" id="product_id" class="form-select select" data-placeholder="Select Products"
                multiple>
                <option value=""></option>
                @foreach ($products as $item)
                    <option value="{{ $item->id }}"
                        {{ is_array(request('product_id')) && in_array($item->id, request('product_id')) ? 'selected' : '' }}>
                        {{ $item->name }} - {{ $item->code }}</option>
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
            $(document).on('change', '#category_id', function(e) {
                let category_id = $('#category_id').val();
                let url = "{{ request()->fullUrl() }}";
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
                        }
                    }
                });
            });

            $(document).on('click', '.getPdf', function(e) {
                $('input[name="print"]').val('true');
                $('.filter_form').attr('target', '_blank');
                $('.filter_form')[0].submit();
            });

            $(document).on('click', '#filter_btn', function(e) {
                $('input[name="print"]').val('');
                $('.filter_form').attr('target', '_self');
            });
        });
    </script>
@endpush
