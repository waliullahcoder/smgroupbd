@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <input type="hidden" name="filter" value="1">
    <div class="row g-3">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="staff_id" class="form-label"><b>Employee</b></label>
            <select name="staff_id" id="staff_id" class="form-select select" data-placeholder="Select Employee">
                <option value=""></option>
                @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ $staff->id == $staff_id ? 'selected' : '' }}>{{ $staff->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="distribution" class="form-label"><b>Distribution</b></label>
            <select name="distribution" id="distribution" class="form-select select" data-placeholder="Select Distribution">
                <option value="">Select Distribution</option>
                @foreach ($distributions as $key => $value)
                    <option value="{{ $key }}" {{ $key == $distribution ? 'selected' : '' }}>
                        {{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="location_id" class="form-label"><b>Region/Area/Territory</b></label>
            <select name="location_id" id="location_id" class="form-select select" data-placeholder="Select Location">
                <option value=""></option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}" {{ $location->id == $location_id ? 'selected' : '' }}>
                        {{ $location->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="date_range" class="form-label"><b>Date Range</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required
                value="{{ date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date)) }}">
        </div>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-sm">
            <thead class="text-nowrap">
                <tr>
                    <th class="px-3" width="40px">SL#</th>
                    <th class="px-3">Client Name</th>
                    <th class="px-3">Contact No.</th>
                    <th class="px-3 text-end">Opening</th>
                    <th class="px-3 text-end">Sales</th>
                    <th class="px-3 text-end">Collection</th>
                    <th class="px-3 text-end">Return</th>
                    <th class="px-3 text-end">Outstanding</th>
                    <th class="px-3 text-center">Sales By</th>
                    <th class="px-3 text-center">Due Ratio</th>
                </tr>
            </thead>
            @php
                $total_opening = 0;
                $total_sales = 0;
                $total_collection = 0;
                $total_return = 0;
                $total_outstanding = 0;
            @endphp
            @if (count($data) > 0)
                <tbody>
                    @foreach ($data['clients'] as $row)
                        @php
                            $opening = $data['opening_sales']->where('client_id', $row->client_id)->sum('amount') - $data['opening_returns']->where('client_id', $row->client_id)->sum('amount') - $data['opening_collections']->where('client_id', $row->client_id)->sum('amount');
                            $outStanding = $opening + $data['sales']->where('client_id', $row->client_id)->sum('amount') - $data['returns']->where('client_id', $row->client_id)->sum('amount') - $data['collections']->where('client_id', $row->client_id)->sum('amount');
                            $total_sales = $data['opening_sales']->where('client_id', $row->client_id)->sum('amount') + $data['sales']->where('client_id', $row->client_id)->sum('amount');
                            $total_returns = $data['opening_returns']->where('client_id', $row->client_id)->sum('amount') + $data['returns']->where('client_id', $row->client_id)->sum('amount');
                            $total_collections = $data['opening_collections']->where('client_id', $row->client_id)->sum('amount') + $data['collections']->where('client_id', $row->client_id)->sum('amount');

                            if ($total_collections != 0 && $total_sales != 0) {
                                $percent = ($total_collections / ($total_sales - $total_returns)) * 100;
                                $percentage = 100 - $percent;
                                $averagePercent = number_format($percentage, 2, '.', '');
                            } elseif ($total_collections == 0) {
                                $averagePercent = 100;
                            } else {
                                $averagePercent = 0;
                            }
                        @endphp
                        @if ($outStanding <= 0)
                            @continue
                        @endif
                        <tr>
                            <td class="px-3 text-center" width="40px">{{ $loop->iteration }}</td>
                            <td class="px-3">{{ $row->client_name }}</td>
                            <td class="px-3">{{ $row->client_phone }}</td>
                            <td class="text-end px-3">{{ number_format($opening, 2, '.', ',') }}</td>
                            <td class="text-end px-3">
                                {{ number_format($data['sales']->where('client_id', $row->client_id)->sum('amount'), 2, '.', ',') }}
                            </td>
                            <td class="text-end px-3">
                                {{ number_format($data['collections']->where('client_id', $row->client_id)->sum('amount'), 2, '.', ',') }}
                            </td>
                            <td class="text-end px-3">
                                {{ number_format($data['returns']->where('client_id', $row->client_id)->sum('amount'), 2, '.', ',') }}
                            </td>
                            <td class="text-end px-3">
                                {{ number_format($outStanding, 2, '.', ',') }}
                            </td>
                            <td class="text-center px-3">{{ @$row->staff_name }}</td>
                            <td class="text-center px-3">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                        style="width:{{ round($averagePercent) }}%; height:5px;"
                                        aria-valuenow="{{ round($averagePercent) }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <span class="progress-parcent">{{ number_format($averagePercent, 2, '.', ',') }}%</span>
                            </td>
                        </tr>
                        @php
                            $total_opening += $opening;
                            $total_sales += $data['sales']->where('client_id', $row->client_id)->sum('amount');
                            $total_collection += $data['collections']->where('client_id', $row->client_id)->sum('amount');
                            $total_return += $data['returns']->where('client_id', $row->client_id)->sum('amount');
                            $total_outstanding += $outStanding;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-end" colspan="3">Total Summary</th>
                        <th class="text-end">{{ number_format($total_opening, 2, '.', ',') }}</th>
                        <th class="text-end">{{ number_format($total_sales, 2, '.', ',') }}</th>
                        <th class="text-end">{{ number_format($total_collection, 2, '.', ',') }}</th>
                        <th class="text-end">{{ number_format($total_return, 2, '.', ',') }}</th>
                        <th class="text-end">{{ number_format($total_outstanding, 2, '.', ',') }}</th>
                        <th colspan="2"></th>
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

            $(document).on('change', '#distribution', function() {
                let distribution = $(this).val();
                let url = "{{ Route('admin.client-outstanding.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        distribution: distribution,
                        get_location: true,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#location_id option').remove();
                            $('#location_id').append('<option value=""></option>');
                            $.each(response.locations, function(key, value) {
                                var html =
                                    `<option value="${value.id}">${value.name}</option>`;
                                $('#location_id').append(html);
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
