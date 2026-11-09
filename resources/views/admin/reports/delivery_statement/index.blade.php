@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <div class="col-sm-6">
            <label for="client_id" class="form-label"><b>Client</b></label>
            <select name="client_id" id="client_id" class="form-select select" data-placeholder="Select Client">
                <option value=""></option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="date_range" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required value="{{ date('d-m-Y') . ' to ' . date('d-m-Y') }}">
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ Route('admin.delivery-statement.index') }}" id="print-form" method="GET" target="_blank">
        <input type="hidden" name="print" value="true">
        <input type="hidden" name="client_id" class="client_id">
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
                data.client_id = $('#client_id').val();
                data.date_range = $('#date_range').val();
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                var client_id = $('#client_id').val();
                var date_range = $('#date_range').val();

                $('.client_id').val(client_id);
                $('.date_range').val(date_range);
                if (client_id == '') {
                    Swal.fire({
                        width: "22rem",
                        title: "Failed!",
                        text: "Please Select a Client",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    $('#print-form').submit();
                }
            });
        });
    </script>
@endpush
