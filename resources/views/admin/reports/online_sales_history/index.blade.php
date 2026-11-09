@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="report_type" class="form-label"><b>Report Type</b></label>
            <select name="report_type" id="report_type" class="form-select select" data-placeholder="Report Type">
                <option value="history" {{ $report_type == 'history' ? 'selected' : '' }}>History</option>
                <option value="product_summary" {{ $report_type == 'product_summary' ? 'selected' : '' }}>Product Summary
                </option>
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
            <select name="area_id[]" id="area_id" class="form-select select" data-placeholder="Select Area" multiple>
                <option value=""></option>
                @foreach ($areas as $item)
                    <option value="{{ $item->id }}"
                        {{ is_array(request('area_id')) && in_array($item->id, request('area_id')) ? 'selected' : '' }}>
                        {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="product_id" class="form-label"><b>Product</b></label>
            <select name="product_id[]" id="product_id" class="form-select select" data-placeholder="Select Product"
                multiple>
                <option value=""></option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}"
                        {{ is_array($product_id) && in_array($product->id, $product_id) ? 'selected' : '' }}>
                        {{ $product->name }} ({{ $product->code }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="status" class="form-label"><b>Status</b></label>
                    <select name="status[]" id="status" class="form-select select" data-placeholder="Select Status"
                        multiple>
                        <option value=""></option>
                        <option value="Pending"
                            {{ is_array(request('status')) && in_array('Pending', request('status')) ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="Forward"
                            {{ is_array(request('status')) && in_array('Forward', request('status')) ? 'selected' : '' }}>
                            Forward
                        </option>
                        <option value="On Route"
                            {{ is_array(request('status')) && in_array('On Route', request('status')) ? 'selected' : '' }}>
                            On Route
                        </option>
                        <option value="Delivered"
                            {{ is_array(request('status')) && in_array('Delivered', request('status')) ? 'selected' : '' }}>
                            Delivered</option>
                        <option value="Collected"
                            {{ is_array(request('status')) && in_array('Collected', request('status')) ? 'selected' : '' }}>
                            Collected</option>
                        <option value="Returned"
                            {{ is_array(request('status')) && in_array('Returned', request('status')) ? 'selected' : '' }}>
                            Returned
                        </option>
                        <option value="Cancelled"
                            {{ is_array(request('status')) && in_array('Cancelled', request('status')) ? 'selected' : '' }}>
                            Cancelled</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="created_by" class="form-label"><b>Sales By</b></label>
                    <select name="created_by[]" id="created_by" class="form-select select"
                        data-placeholder="Select Sales By" multiple>
                        <option value=""></option>
                        @php
                            $staffs = [];
                            if (Auth::user()->hasRole('Moderator')) {
                                $staffs = \App\Models\User::where('role', 1)
                                    ->where('id', Auth::user()->id)
                                    ->whereHas('roles', function ($q) {
                                        $q->where('name', 'Moderator');
                                    })
                                    ->orderBy('name', 'asc')
                                    ->get();
                            } else {
                                $staffs = \App\Models\User::where('role', 1)
                                    ->whereHas('roles', function ($q) {
                                        $q->where('name', 'Moderator');
                                    })
                                    ->orderBy('name', 'asc')
                                    ->get();
                            }
                        @endphp
                        @foreach ($staffs as $item)
                            <option value="{{ $item->id }}"
                                {{ is_array(request('created_by')) && in_array($item->id, request('created_by')) ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
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
                $('.filter_form').attr('target', '_blank');
                $('input[name="print"]').val('true');
                $('.filter_form')[0].submit();
            });

            $(document).on('click', '#filter_btn', function(e) {
                e.preventDefault();
                $('.filter_form').attr('target', '_self');
                $('input[name="print"]').val('');
                $('.filter_form')[0].submit();
            });
        });
    </script>
@endpush
