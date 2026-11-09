@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="report_type" class="form-label"><b>Report Type</b></label>
            <select name="report_type" id="report_type" class="form-select select" data-placeholder="Report Type">
                <option value="history" {{ $report_type == 'history' ? 'selected' : '' }}>History</option>
                <option value="summary" {{ $report_type == 'summary' ? 'selected' : '' }}>Summary</option>
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="vendor_id" class="form-label"><b>Vendor</b></label>
            <select name="vendor_id[]" id="vendor_id" class="form-select select" data-placeholder="Select Vendor" multiple>
                <option value=""></option>
                @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}"
                        {{ is_array($vendor_id) && in_array($vendor->id, $vendor_id) ? 'selected' : '' }}>
                        {{ $vendor->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="date_range" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required
                value="{{ date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date)) }}">
        </div>
    </div>
    <button type="submit" id="print_btn" class="d-none" name="print" value="print">print</button>
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
                $('#print_btn').trigger('click');
            });
        });
    </script>
@endpush
