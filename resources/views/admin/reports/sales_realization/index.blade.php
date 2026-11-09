@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <input type="hidden" name="filter" value="1">
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="region_id" class="form-label"><b>Region</b></label>
            <select name="region_id" id="region_id" class="form-select select" data-placeholder="Select Region">
                <option value=""></option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" {{ $region->id == $region_id ? 'selected' : '' }}>
                        {{ $region->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="area_id" class="form-label"><b>Area</b></label>
            <select name="area_id" id="area_id" class="form-select select" data-placeholder="Select Area">
                <option value=""></option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ $area->id == $area_id ? 'selected' : '' }}>
                        {{ $area->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="territory_id" class="form-label"><b>Territory</b></label>
            <select name="territory_id" id="territory_id" class="form-select select" data-placeholder="Select Territory">
                <option value=""></option>
                @foreach ($territories as $territory)
                    <option value="{{ $territory->id }}" {{ $territory->id == $territory_id ? 'selected' : '' }}>
                        {{ $territory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <label for="client_type" class="form-label"><b>Client Type</b></label>
            <select name="client_type" id="client_type" class="form-select select" data-placeholder="Select Client Type">
                <option value=""></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $client_category_id ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-6">
            <label for="client_id" class="form-label"><b>Client</b></label>
            <select name="client_id[]" id="client_id" class="form-select select" data-placeholder="Select Client" multiple>
                <option value=""></option>
                @foreach ($all_clients as $client)
                    <option value="{{ $client->id }}"
                        {{ is_array($client_id) && in_array($client->id, $client_id) ? 'selected' : '' }}>
                        {{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <label for="month" class="form-label"><b>Month</b></label>
            @php
                $months = ['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'];
            @endphp
            <select name="month" id="month" class="form-select select" data-placeholder="Select Month">
                @foreach ($months as $key => $m)
                    <option value="{{ $key }}" {{ $key == $month ? 'selected' : '' }}>
                        {{ $m }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <label for="year" class="form-label"><b>Year</b></label>
            <select name="year" id="year" class="form-select select" data-placeholder="Select Year">
                @for ($i = date('Y'); $i >= 2022; $i--)
                    <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-sm">
            <thead class="text-nowrap">
                <tr>
                    <th rowspan="2" class="px-3 text-center align-middle" width="40px">Sl#</th>
                    <th rowspan="2" class="px-3 align-middle">Client Name</th>
                    <th rowspan="2" class="px-3 align-middle text-end">Previous Year</th>
                    <th colspan="4" class="text-center">For The Year of {{ $year }}</th>
                    <th colspan="4" class="text-center">For The Month of {{ date('F', mktime(0, 0, 0, $month, 10)) }}</th>
                    <th rowspan="2" class="px-3 align-middle text-end">Outstanding</th>
                </tr>
                <tr>
                    <th class="px-3 text-end">Sales</th>
                    <th class="px-3 text-end">Collections</th>
                    <th class="px-3 text-end">Return</th>
                    <th class="px-3 text-end">Due</th>
                    <th class="px-3 text-end">Sales</th>
                    <th class="px-3 text-end">Collections</th>
                    <th class="px-3 text-end">Return</th>
                    <th class="px-3 text-end">Due</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPreviousrealization = 0;
                    $totalyearlySales = 0;
                    $totalYearlyCollection = 0;
                    $yearlyReturn = 0;
                    $totalYearlyRealization = 0;
                    $totalMonthlySales = 0;
                    $totalMonthlyCollection = 0;
                    $monthlyReturn = 0;
                    $totalMonthlyRealization = 0;
                    $totalCurrentRealization = 0;
                @endphp
                @if (count($data) > 0)
                    @foreach ($data['clients'] as $row)
                        @php
                            $previous_sales = $data['client_sales']
                                ->where('client_id', $row->client_id)
                                ->where('date', '<', $data['first_of_year'])
                                ->sum('amount');
                            $previous_returns = $data['client_returns']
                                ->where('client_id', $row->client_id)
                                ->where('date', '<', $data['first_of_year'])
                                ->sum('amount');
                            $previous_collections = $data['client_collections']
                                ->where('client_id', $row->client_id)
                                ->where('payment_date', '<', $data['first_of_year'])
                                ->sum('amount');
                            $previous_balance = $previous_sales - $previous_returns - $previous_collections;

                            $month_sales = $data['client_sales']
                                ->where('client_id', $row->client_id)
                                ->where('date', '>=', $data['first_of_month'])
                                ->where('date', '<=', $data['last_of_month'])
                                ->sum('amount');
                            $month_returns = $data['client_returns']
                                ->where('client_id', $row->client_id)
                                ->where('date', '>=', $data['first_of_month'])
                                ->where('date', '<=', $data['last_of_month'])
                                ->sum('amount');
                            $month_collections = $data['client_collections']
                                ->where('client_id', $row->client_id)
                                ->where('payment_date', '>=', $data['first_of_month'])
                                ->where('payment_date', '<=', $data['last_of_month'])
                                ->sum('amount');
                            $month_balance = $month_sales - $month_returns - $month_collections;

                            $year_sales = $data['client_sales']
                                ->where('client_id', $row->client_id)
                                ->where('date', '>=', $data['first_of_year'])
                                ->where('date', '<=', $data['last_of_year'])
                                ->sum('amount');
                            $year_returns = $data['client_returns']
                                ->where('client_id', $row->client_id)
                                ->where('date', '>=', $data['first_of_year'])
                                ->where('date', '<=', $data['last_of_year'])
                                ->sum('amount');
                            $year_collections = $data['client_collections']
                                ->where('client_id', $row->client_id)
                                ->where('payment_date', '>=', $data['first_of_year'])
                                ->where('payment_date', '<=', $data['last_of_year'])
                                ->sum('amount');
                            $year_balance = $year_sales - $year_returns - $year_collections;

                            $totalDue = $previous_balance + $year_balance;
                            // if ($totalDue == 0) {
                            //     $totalDue = 1;
                            // }
                            // $collection = $row['month_collection'] + $row['month_return']; // ex: 2500
                            // $dueMinusCollection = $totalDue - $collection; //ex: 7500
                            // $credit_p = ($dueMinusCollection / $totalDue) * 100; //ex: 75%;
                        @endphp
                        <tr>
                            <td class="text-center px-3">{{ $loop->iteration }}</td>
                            <td class="px-3">{{ $row->client_name }}</td>
                            <td class="text-end px-3">{{ number_format($previous_balance, 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($year_sales, 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($year_collections, 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($year_returns, 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($year_balance, 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($month_sales, 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($month_collections, 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($month_returns, 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($month_balance, 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($totalDue, 2, '.', ',') }}</td>
                        </tr>
                        @php
                            $totalPreviousrealization += $previous_balance;
                            $totalyearlySales += $year_sales;
                            $totalYearlyCollection += $year_collections;
                            $yearlyReturn += $year_returns;
                            $totalYearlyRealization += $year_balance;
                            $totalMonthlySales += $month_sales;
                            $totalMonthlyCollection += $month_collections;
                            $monthlyReturn += $month_returns;
                            $totalMonthlyRealization += $month_balance;
                            $totalCurrentRealization += $totalDue;
                        @endphp
                    @endforeach
                @endif
            </tbody>
            @if (count($data) > 0)
                <tfoot>
                    @php
                        $totalDue = $totalPreviousrealization + $totalYearlyRealization + $totalMonthlySales; //ex: 10000
                        if ($totalDue == 0) {
                            $totalDue = 1;
                        }
                        $collection = $totalMonthlyCollection + $monthlyReturn; // ex: 2500
                        $dueMinusCollection = $totalDue - $collection; //ex: 7500
                        $creditP = ($dueMinusCollection / $totalDue) * 100; //ex: 75%;
                    @endphp
                    <tr>
                        <th class="text-end bg-primary text-white px-3" colspan="2">Total Summary</th>
                        <th class="text-end bg-primary text-white px-3">
                            {{ number_format($totalPreviousrealization, 2, '.', ',') }}</th>
                        <th class="text-end bg-primary text-white px-3">
                            {{ number_format($totalyearlySales, 2, '.', ',') }}</th>
                        <th class="text-end bg-primary text-white px-3">
                            {{ number_format($totalYearlyCollection, 2, '.', ',') }}</th>
                        <th class="text-end bg-primary text-white px-3">{{ number_format($yearlyReturn, 2, '.', ',') }}
                        </th>
                        <th class="text-end bg-primary text-white px-3">
                            {{ number_format($totalYearlyRealization, 2, '.', ',') }}</th>
                        <th class="text-end bg-primary text-white px-3">
                            {{ number_format($totalMonthlySales, 2, '.', ',') }}</th>
                        <th class="text-end bg-primary text-white px-3">
                            {{ number_format($totalMonthlyCollection, 2, '.', ',') }}</th>
                        <th class="text-end bg-primary text-white px-3">{{ number_format($monthlyReturn, 2, '.', ',') }}
                        </th>
                        <th class="text-end bg-primary text-white px-3">
                            {{ number_format($totalMonthlyRealization, 2, '.', ',') }}</th>
                        <th class="text-end bg-primary text-white px-3">
                            {{ number_format($totalCurrentRealization, 2, '.', ',') }}</th>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "order": false,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    {
                        'text': '<i class="fal fa-file-pdf"></i> Print',
                        'className': 'getPdf',
                    },
                ]
            });

            $(document).on('change', '#region_id', function() {
                let region_id = $('#region_id').val();
                let client_type = $('#client_type').val();
                let url = "{{ Route('admin.sales-realization.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_area: true,
                        region_id: region_id,
                        client_type: client_type,
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
                            $('#client_id option').remove();
                            $('#client_id').append('<option value=""></option>');
                            $.each(response.clients, function(key, value) {
                                var html =
                                    `<option value="${value.id}">${value.name}</option>`;
                                $('#client_id').append(html);
                            });
                        }
                    }
                });
            });

            $(document).on('change', '#area_id', function() {
                let area_id = $('#area_id').val();
                let client_type = $('#client_type').val();
                let url = "{{ Route('admin.sales-realization.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_territory: true,
                        area_id: area_id,
                        client_type: client_type,
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
                            $('#client_id option').remove();
                            $('#client_id').append('<option value=""></option>');
                            $.each(response.clients, function(key, value) {
                                var html =
                                    `<option value="${value.id}">${value.name}</option>`;
                                $('#client_id').append(html);
                            });
                        }
                    }
                });
            });

            $(document).on('change', '#client_type, #territory_id', function() {
                let client_type = $('#client_type').val();
                let region_id = $('#region_id').val();
                let area_id = $('#area_id').val();
                let territory_id = $('#territory_id').val();
                let url = "{{ Route('admin.sales-realization.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_clients: true,
                        client_type: client_type,
                        region_id: region_id,
                        area_id: area_id,
                        territory_id: territory_id,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#client_id option').remove();
                            $('#client_id').append('<option value=""></option>');
                            $.each(response.clients, function(key, value) {
                                var html =
                                    `<option value="${value.id}">${value.name}</option>`;
                                $('#client_id').append(html);
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
                var client_type = $('#client_type').val();
                var client_id = $('#client_id').val();
                var month = $('#month').val();
                var year = $('#year').val();
                $('.region_id').val(region_id);
                $('.area_id').val(area_id);
                $('.territory_id').val(territory_id);
                $('.client_type').val(client_type);
                $('.client_id').val(client_id);
                $('.month').val(month);
                $('.year').val(year);
                $('#print-form').submit();
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                $('input[name="print"]').val('true');
                $('.filter_form').submit();
            });

            $(document).on('click', '#filter_btn', function(e) {
                e.preventDefault();
                $('input[name="print"]').val('');
                $('.filter_form').submit();
            });
        });
    </script>
@endpush
