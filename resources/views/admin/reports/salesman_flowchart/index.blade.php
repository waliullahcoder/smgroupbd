@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <div class="col-sm-6">
            <label for="staff_id" class="form-label"><b>Staff <span class="text-danger">*</span></b></label>
            <select name="staff_id" id="staff_id" class="form-select select" data-placeholder="Select Staff" required>
                <option value=""></option>
                @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ $staff->id == $staff_id ? 'selected' : '' }}>
                        {{ $staff->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="date_range" class="form-label"><b>Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off"
                value="{{ !is_null($start_date) && !is_null($end_date) ? date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date)) : date('d-m-Y') . ' to ' . date('d-m-Y') }}"
                required>
        </div>
    </div>
@endsection

@section('content')
    <div class="d-flex mb-4">
        <div class="px-3" style="border-right: 1px solid rgba(0,0,0,.1);">
            <span class="text-muted">MONTHLY COLLECTION : </span>
            <span class="h6 m-0 cs_text">৳ {{ round($collections) }}</span>
        </div>
        <div class="px-3">
            <span class="text-muted ">MONTHLY SALES : </span>
            <span class="h6 m-0 cs_text">৳ {{ round($sales) }}</span>
        </div>
    </div>
    @if (count($total_sales_collections) > 0)
        <div id="monthly_flow" style="height: 300px"></div>
    @endif
@endsection

@push('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('backend/js/chart.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            if ($('#monthly_flow').length) {
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(salesCollection);

                function salesCollection() {
                    var data = google.visualization.arrayToDataTable([
                        [
                            'Date',
                            'Sales',
                            'Collection'
                        ],
                        @foreach ($total_sales_collections as $sale_collection)
                            [
                                {{ $sale_collection['date'] }},
                                {{ $sale_collection['total_sales'] }},
                                {{ $sale_collection['total_collection'] }}
                            ],
                        @endforeach
                    ]);
                    var dataList = {
                        title: 'Performance Flow',
                        hAxis: {
                            title: 'Date',
                            titleTextStyle: {
                                color: '#333'
                            }
                        },
                        vAxis: {
                            minValue: 0
                        }
                    };
                    var salesCollection = new google.visualization.LineChart(document.getElementById(
                        'monthly_flow'));
                    salesCollection.draw(data, dataList);
                }
            }
        });
    </script>
@endpush
