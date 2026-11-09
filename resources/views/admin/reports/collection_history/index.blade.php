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
        <div class="col-md-4 col-sm-6">
            <label for="collection_type" class="form-label"><b>Collection Type</b></label>
            <select name="collection_type" id="collection_type" class="form-select select"
                data-placeholder="Collection Type">
                <option value=""></option>
                <option value="advance" {{ $collection_type == 'advance' ? 'selected' : '' }}>Advance</option>
                <option value="adjust" {{ $collection_type == 'adjust' ? 'selected' : '' }}>Adjustment</option>
                <option value="collection" {{ $collection_type == 'collection' ? 'selected' : '' }}>Collection</option>
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="date_range" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required
                value="{{ date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date)) }}">
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
