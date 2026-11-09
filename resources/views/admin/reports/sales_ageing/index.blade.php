@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="filter" value="1">
    <input type="hidden" name="print" value="">
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
                    <option value="{{ $area->id }}" {{ $area->id == $area_id ? 'selected' : '' }}>{{ $area->name }}
                    </option>
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
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-sm">
            <thead class="text-nowrap">
                <tr>
                    <th class="px-3 text-center" width="40px">SL#</th>
                    <th class="px-3">Client Name</th>
                    <th class="px-3 text-end">Total Due</th>
                    <th class="px-3 text-end">30 Day</th>
                    <th class="px-3 text-end">60 Day</th>
                    <th class="px-3 text-end">90 Day</th>
                    <th class="px-3 text-end">Over 90 Day</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_due = 0;
                    $total_thirty_days_due = 0;
                    $total_sixty_days_due = 0;
                    $total_ninety_days_due = 0;
                    $total_over_ninety_days_due = 0;
                @endphp
                @if (count($data) > 0)
                    @foreach ($data['clients'] as $row)
                        @php
                            $due =
                                $data['client_sales']->where('client_id', $row->client_id)->sum('amount') -
                                $data['client_sales']->where('client_id', $row->client_id)->sum('total_paid');
                            if ($due < 0) {
                                continue;
                            }
                            $total_due += $due;

                            $one_month_due =
                                $data['client_sales']
                                    ->where('client_id', $row->client_id)
                                    ->where('date', '<=', $data['one_start_date'])
                                    ->where('date', '>=', $data['one_end_date'])
                                    ->sum('amount') -
                                $data['client_sales']
                                    ->where('client_id', $row->client_id)
                                    ->where('date', '<=', $data['one_start_date'])
                                    ->where('date', '>=', $data['one_end_date'])
                                    ->sum('total_paid');

                            $total_thirty_days_due += $one_month_due;

                            $two_month_due =
                                $data['client_sales']
                                    ->where('client_id', $row->client_id)
                                    ->where('date', '<=', $data['two_start_date'])
                                    ->where('date', '>=', $data['two_end_date'])
                                    ->sum('amount') -
                                $data['client_sales']
                                    ->where('client_id', $row->client_id)
                                    ->where('date', '<=', $data['two_start_date'])
                                    ->where('date', '>=', $data['two_end_date'])
                                    ->sum('total_paid');
                            $total_sixty_days_due += $two_month_due;

                            $three_month_due =
                                $data['client_sales']
                                    ->where('client_id', $row->client_id)
                                    ->where('date', '<=', $data['three_start_date'])
                                    ->where('date', '>=', $data['three_end_date'])
                                    ->sum('amount') -
                                $data['client_sales']
                                    ->where('client_id', $row->client_id)
                                    ->where('date', '<=', $data['three_start_date'])
                                    ->where('date', '>=', $data['three_end_date'])
                                    ->sum('total_paid');

                            $total_ninety_days_due += $three_month_due;

                            $over_three_month_due =
                                $data['client_sales']
                                    ->where('client_id', $row->client_id)
                                    ->where('date', '<=', $data['over_three_start_date'])
                                    ->sum('amount') -
                                $data['client_sales']
                                    ->where('client_id', $row->client_id)
                                    ->where('date', '<=', $data['over_three_start_date'])
                                    ->sum('total_paid');
                            $total_thirty_days_due += $over_three_month_due;

                        @endphp
                        <tr>
                            <td class="text-center px-3">{{ $loop->iteration }}</td>
                            <td class="px-3">{{ $row->client_name }}</td>
                            <td class="text-end px-3">{{ number_format($due, 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($one_month_due, 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($two_month_due, 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($three_month_due, 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($over_three_month_due, 2, '.', ',') }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            @if (count($data) > 0)
                <tfoot>
                    <tr>
                        <th class="text-end bg-primary text-white px-3" colspan="2">Total Summary</th>
                        <th class="text-end bg-primary text-white px-3">
                            {{ number_format($total_due, 2, '.', ',') }}</th>
                        <th class="text-end bg-primary text-white px-3">
                            {{ number_format($total_thirty_days_due, 2, '.', ',') }}
                        <th class="text-end bg-primary text-white px-3">
                            {{ number_format($total_sixty_days_due, 2, '.', ',') }}
                        <th class="text-end bg-primary text-white px-3">
                            {{ number_format($total_ninety_days_due, 2, '.', ',') }}
                        <th class="text-end bg-primary text-white px-3">
                            {{ number_format($total_over_ninety_days_due, 2, '.', ',') }}
                        </th>
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
                let region_id = $(this).val();
                let url = "{{ Route('admin.sales-ageing.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_area: true,
                        region_id: region_id,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#area_id option').remove();
                            $('#territory_id option').remove();
                            $('#area_id').append('<option value=""></option>');
                            $('#territory_id').append('<option value=""></option>');
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
                let url = "{{ Route('admin.sales-ageing.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_territory: true,
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
