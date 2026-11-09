@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <div class="row g-3">
        {{-- <div class="col-md-3 col-sm-6">
            <label for="product_type" class="form-label"><b>Product Type</b></label>
            <select name="product_type" id="product_type" class="select form-select" data-placeholder="Select Product Type"
                required>
                <option value="Consumer">Consumer</option>
                <option value="Fashion">Fashion</option>
            </select>
        </div> --}}
        <div class="col-md-4 col-sm-6">
            <label for="host_id" class="form-label"><b>Host Store</b></label>
            <select name="host_id" id="host_id" class="select form-select" data-placeholder="Select Host Store">
                <option value=""></option>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="destination_id" class="form-label"><b>Destination Store</b></label>
            <select name="destination_id" id="destination_id" class="select form-select"
                data-placeholder="Select Destination Store">
                <option value=""></option>
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="date_range" class="form-label"><b>Select Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required value="{{ date('d-m-Y') . ' to ' . date('d-m-Y') }}">
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ Route('admin.transfer-log.index') }}" id="print-form" method="GET" target="_blank">
        <input type="hidden" name="print" value="true">
        <input type="hidden" name="product_type" class="product_type">
        <input type="hidden" name="host_id" class="host_id">
        <input type="hidden" name="destination_id" class="destination_id">
        <input type="hidden" name="date_range" class="date_range">
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
                data.product_type = $('#product_type').val();
                data.host_id = $('#host_id').val();
                data.destination_id = $('#destination_id').val();
                data.date_range = $('#date_range').val();
            });

            $(document).on('change', '#host_id', function(e) {
                let host_id = $(this).val();
                let url = "{{ Route('admin.transfer-log.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        host_id: host_id,
                        get_destination_store: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#destination_id option').remove();
                            $('#destination_id').append('<option value=""></option>');
                            if (response.destination_stores.length > 0) {
                                response.destination_stores.forEach(function(item, index) {
                                    var option =
                                        `<option value="${item.id}">${item.name}</option>`;
                                    $('#destination_id').append(option);
                                });
                            }
                        }
                    }
                });
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                var product_type = $('#product_type').val();
                var host_id = $('#host_id').val();
                var destination_id = $('#destination_id').val();
                var date_range = $('#date_range').val();
                $('.product_type').val(product_type);
                $('.host_id').val(host_id);
                $('.destination_id').val(destination_id);
                $('.date_range').val(date_range);
                $('#print-form')[0].submit();
            });
        });
    </script>
@endpush
