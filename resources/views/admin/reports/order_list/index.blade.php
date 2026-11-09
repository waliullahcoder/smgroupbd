@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <input type="hidden" name="chalan" value="">
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="report_type" class="form-label"><b>Report Type <span class="text-danger">*</span></b></label>
            <select name="report_type" id="report_type" class="select form-select" data-placeholder="Select Report Type"
                required>
                <option value="history" {{ request('report_type') == 'history' ? 'selected' : '' }}>History</option>
                <option value="summary" {{ request('report_type') == 'summary' ? 'selected' : '' }}>Summary</option>
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="date_range" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required
                value="{{ date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date)) }}">
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Store</b></label>
            <select name="store_id" id="store_id" class="form-select select" data-placeholder="Select Store">
                <option value=""></option>
                @foreach ($stores as $item)
                    <option value="{{ $item->id }}" {{ $item->id == request('store_id') ? 'selected' : '' }}>
                        {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="area_id" class="form-label"><b>Area</b></label>
            <select name="area_id" id="area_id" class="select form-select" data-placeholder="Select Staff">
                <option value=""></option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                        {{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="created_by" class="form-label"><b>Created By</b></label>
            <select name="created_by" id="created_by" class="select form-select" data-placeholder="Select Staff">
                <option value=""></option>
                @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ request('created_by') == $staff->id ? 'selected' : '' }}>
                        {{ $staff->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="status" class="form-label"><b>Status</b></label>
            <select name="status" id="status" class="select form-select" data-placeholder="Select Status">
                <option value=""></option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Forward" {{ request('status') == 'Forward' ? 'selected' : '' }}>Forward</option>
                <option value="On Route" {{ request('status') == 'On Route' ? 'selected' : '' }}>On Route</option>
                <option value="Delivered" {{ request('status') == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="Collected" {{ request('status') == 'Collected' ? 'selected' : '' }}>Collected</option>
                <option value="Returned" {{ request('status') == 'Returned' ? 'selected' : '' }}>Returned</option>
                <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
    </div>
@endsection

@section('content')
    <div class="card-body">
        {!! $dataTable->table(['class' => 'dataTable table align-middle table-bordered'], true) !!}
    </div>
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

            $(document).on('click', '.getPdf', function(e) {
                $('input[name="print"]').val('true');
                $('input[name="chalan"]').val('');
                $('.filter_form').attr('target', '_blank');
                $('.filter_form')[0].submit();
            });

            $(document).on('click', '.getChalanPdf', function(e) {
                $('input[name="print"]').val('true');
                $('input[name="chalan"]').val('true');
                $('.filter_form').attr('target', '_blank');
                $('.filter_form')[0].submit();
            });

            $(document).on('click', '#filter_btn', function(e) {
                $('input[name="chalan"]').val('');
                $('input[name="print"]').val('');
                $('.filter_form').attr('target', '_self');
            });
        });
    </script>
@endpush
