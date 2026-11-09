@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <div class="col-12">
            <label for="category_id" class="form-label"><b>Product Category</b></label>
            <select name="category_id" id="category_id" class="form-select select" data-placeholder="Select Category">
                <option value=""></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ Route('admin.product-list.index') }}" id="print-form" method="GET" target="_blank">
        <input type="hidden" name="print" value="true">
        <input type="hidden" name="vendor_id" class="vendor_id">
        <input type="hidden" name="category_id" class="category_id">
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
                data.category_id = $('#category_id').val();
                data.vendor_id = $('#vendor_id').val();
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                var vendor_id = $('#vendor_id').val();
                var category_id = $('#category_id').val();

                $('.vendor_id').val(vendor_id);
                $('.category_id').val(category_id);
                $('#print-form').submit();
            });
        });
    </script>
@endpush
