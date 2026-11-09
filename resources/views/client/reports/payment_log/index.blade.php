@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <div class="col-sm-6">
            <label for="date_range" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required value="{{ date('d-m-Y') . ' to ' . date('d-m-Y') }}">
        </div>
        <div class="col-sm-6">
            <label for="collection_type" class="form-label"><b>Collection Type</b></label>
            <select name="collection_type" id="collection_type" class="form-select select"
                data-placeholder="Collection Type">
                <option value=""></option>
                <option value="advance">Advance</option>
                <option value="adjust">Adjustment</option>
                <option value="collection">Collection</option>
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
        <input type="hidden" name="collection_type" class="collection_type">
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
                data.collection_type = $('#collection_type').val();
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                var date_range = $('#date_range').val();
                var collection_type = $('#collection_type').val();
                $('.date_range').val(date_range);
                $('.collection_type').val(collection_type);
                $('#print-form').submit();
            });
        });
    </script>
@endpush
