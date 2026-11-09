@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="region_id" class="form-label"><b>Region</b></label>
            <select name="region_id" id="region_id" class="form-select select" data-placeholder="Select Region">
                <option value=""></option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="area_id" class="form-label"><b>Area</b></label>
            <select name="area_id" id="area_id" class="form-select select" data-placeholder="Select Area">
                <option value=""></option>
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="territory_id" class="form-label"><b>Territory</b></label>
            <select name="territory_id" id="territory_id" class="form-select select" data-placeholder="Select Territory">
                <option value=""></option>
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="category_id" class="form-label"><b>Client Category</b></label>
            <select name="category_id" id="category_id" class="form-select select"
                data-placeholder="Select Client Category">
                <option value=""></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="staff_id" class="form-label"><b>Reference</b></label>
            <select name="staff_id" id="staff_id" class="form-select select" data-placeholder="Select Reference">
                <option value=""></option>
                @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="client_type" class="form-label"><b>Client Type</b></label>
            <select name="client_type" id="client_type" class="form-select select" data-placeholder="Select Client Type">
                <option value=""></option>
                <option value="new">New Client</option>
                <option value="inactive">Inactive Client</option>
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="start_date" class="form-label"><b>Date From</b></label>
            <input type="text" class="date_picker form-control" name="start_date" id="start_date"
                placeholder="Select From Date">
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ Route('admin.client-list.index') }}" id="print-form" method="GET" target="_blank">
        <input type="hidden" name="print" value="true">
        <input type="hidden" name="region_id" class="region_id">
        <input type="hidden" name="area_id" class="area_id">
        <input type="hidden" name="territory_id" class="territory_id">
        <input type="hidden" name="category_id" class="category_id">
        <input type="hidden" name="staff_id" class="staff_id">
        <input type="hidden" name="client_type" class="client_type">
        <input type="hidden" name="start_date" class="start_date">
    </form>
    {!! $dataTable->table() !!}
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}

    <script type="text/javascript">
        $(document).ready(function() {
            $(".date_picker").datepicker({
                format: 'dd-mm-yyyy',
                changeMonth: true,
                changeYear: true,
            });

            const table = $('#dataTable');
            table.on('preXhr.dt', function(e, settings, data) {
                data.region_id = $('#region_id').val();
                data.area_id = $('#area_id').val();
                data.territory_id = $('#territory_id').val();
                data.category_id = $('#category_id').val();
                data.staff_id = $('#staff_id').val();
                data.client_type = $('#client_type').val();
                data.start_date = $('#start_date').val();
            });

            $(document).on('change', '#region_id', function() {
                let region_id = $(this).val();
                let url = "{{ Route('admin.client-list.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        getArea: 'true',
                        region_id: region_id,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
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
                let url = "{{ Route('admin.client-list.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        getTerrigory: 'true',
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
                        }
                    }
                });
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                var region_id = $('#region_id').val();
                var area_id = $('#area_id').val();
                var territory_id = $('#territory_id').val();
                var category_id = $('#category_id').val();
                var staff_id = $('#staff_id').val();
                var client_type = $('#client_type').val();
                var start_date = $('#start_date').val();

                $('.region_id').val(region_id);
                $('.area_id').val(area_id);
                $('.territory_id').val(territory_id);
                $('.category_id').val(category_id);
                $('.staff_id').val(staff_id);
                $('.client_type').val(client_type);
                $('.start_date').val(start_date);
                $('#print-form').submit();
            });
        });
    </script>
@endpush
