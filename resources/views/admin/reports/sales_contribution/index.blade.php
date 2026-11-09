@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <input type="hidden" name="print" value="">
        <input type="hidden" name="filter" value="1">
        <div class="col-sm-6">
            <label for="criteria" class="form-label"><b>Criteria</b></label>
            <select name="criteria" id="criteria" class="form-select select" data-placeholder="Select Criteria">
                <option value="client" {{ $criteria == 'client' ? 'selected' : '' }}>Client</option>
                <option value="product" {{ $criteria == 'product' ? 'selected' : '' }}>Product</option>
                <option value="category" {{ $criteria == 'category' ? 'selected' : '' }}>Category</option>
                <option value="employee" {{ $criteria == 'employee' ? 'selected' : '' }}>Employee</option>
                <option value="client_type" {{ $criteria == 'client_type' ? 'selected' : '' }}>Client Type</option>
                <option value="region" {{ $criteria == 'region' ? 'selected' : '' }}>Region</option>
                <option value="area" {{ $criteria == 'area' ? 'selected' : '' }}>Area</option>
                <option value="territory" {{ $criteria == 'territory' ? 'selected' : '' }}>Territory</option>
            </select>
        </div>
        <div class="col-sm-6">
            <label for="date_range" class="form-label"><b>Select Date</b></label>
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
            @php
                $total_sum1 = 0;
                $total_sum2 = 0;
            @endphp
            @if ($criteria == 'client')
                <thead>
                    <tr>
                        <th class="px-3 text-center" width="40px">SL#</th>
                        <th class="px-3">Dealer Name</th>
                        <th class="px-3 text-center">By Value</th>
                        <th class="px-3 text-center">Value (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['client_sales'] as $row)
                        @php
                            $sales = $data['sales']->sum('amount');
                            $online_sales = $data['online_sales']->sum('amount');
                            $sales_returns = $data['sales_returns']->sum('amount');
                            $total_sales_amount = $sales + $online_sales - $sales_returns;
                            $client_sales = $row->amount - @$data['client_returns']->where('client_id', $row->client_id)->first()->amount ?? 0;
                            if ($client_sales > 0) {
                                $percentage = round(($client_sales * 100) / $total_sales_amount, 2);
                            } else {
                                $percentage = 0;
                            }
                        @endphp
                        <tr>
                            <td class="text-center px-3" width="40px">{{ $loop->iteration }}</td>
                            <td class="px-3">{{ $row->client_name }}</td>
                            <td class="text-center px-3">
                                {{ number_format($client_sales, 2, '.', ',') }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($percentage, 2, '.', ',') }}
                            </td>
                        </tr>
                        @php
                            $total_sum2 += $client_sales;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-primary">
                        <th colspan="2" class="text-end text-white px-3">Total</th>
                        <th class="text-center text-white px-3">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                        <th class="text-center text-white px-3"></th>
                    </tr>
                </tfoot>
            @endif
            @if ($criteria == 'product')
                <thead>
                    <tr>
                        <th class="px-3 text-center" width="40px">SL#</th>
                        <th class="px-3">Product - Code</th>
                        <th class="px-3 text-center">By Qty</th>
                        <th class="px-3 text-center">Qty (%)</th>
                        <th class="px-3 text-center">By Value</th>
                        <th class="px-3 text-center">Value (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['sales'] as $row)
                        @php
                            $sales = $data['sales']->sum('qty');
                            $online_sales = $data['online_sales']->sum('qty');
                            $sales_returns = $data['sales_returns']->sum('qty');
                            $total_sales_qty = $sales + $online_sales - $sales_returns;

                            $sales = $data['sales']->sum('amount');
                            $online_sales = $data['online_sales']->sum('amount');
                            $sales_returns = $data['sales_returns']->sum('amount');
                            $total_sales_amount = $sales + $online_sales - $sales_returns;

                            $sales = $data['sales']->where('product_id', $row->product_id)->sum('qty');
                            $online_sales = $data['online_sales']->where('product_id', $row->product_id)->sum('qty');
                            $sales_returns = $data['sales_returns']->where('product_id', $row->product_id)->sum('qty');
                            $sales_qty = $sales + $online_sales - $sales_returns;

                            $sales = $data['sales']->where('product_id', $row->product_id)->sum('amount');
                            $online_sales = $data['online_sales']->where('product_id', $row->product_id)->sum('amount');
                            $sales_returns = $data['sales_returns']->where('product_id', $row->product_id)->sum('amount');
                            $sales_amount = $sales + $online_sales - $sales_returns;
                        @endphp
                        <tr>
                            <td class="text-center px-3" width="40px">{{ $loop->iteration }}</td>
                            <td class="px-3">{{ $row->name }} - {{ $row->code }}</td>
                            <td class="px-3 text-center">
                                {{ number_format($sales_qty, 2, '.', ',') }}
                            </td>
                            <td class="px-3 text-center">
                                {{ number_format(round(($sales_qty * 100) / $total_sales_qty, 2), 2, '.', ',') }}
                            </td>
                            <td class="px-3 text-center">
                                {{ number_format($sales_amount, 2, '.', ',') }}
                            </td>
                            <td class="px-3 text-center">
                                {{ number_format(round(($sales_amount * 100) / $total_sales_amount, 2), 2, '.', ',') }}
                            </td>
                        </tr>
                        @php
                            $total_sum2 += $sales_amount;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-primary">
                        <th colspan="4" class="text-end text-white px-3">Total</th>
                        <th class="text-center text-white px-3">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                        <th class="text-center text-white px-3"></th>
                    </tr>
                </tfoot>
            @endif
            @if ($criteria == 'category')
                <thead>
                    <tr>
                        <th class="px-3 text-center" width="40px">SL#</th>
                        <th class="px-3">Category</th>
                        <th class="px-3 text-center">By Qty</th>
                        <th class="px-3 text-center">Qty (%)</th>
                        <th class="px-3 text-center">By Value</th>
                        <th class="px-3 text-center">Value (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['sales'] as $row)
                        @php
                            $sales = $data['sales']->sum('qty');
                            $online_sales = $data['online_sales']->sum('qty');
                            $sales_returns = $data['sales_returns']->sum('qty');
                            $total_sales_qty = $sales + $online_sales - $sales_returns;

                            $sales = $data['sales']->sum('amount');
                            $online_sales = $data['online_sales']->sum('amount');
                            $sales_returns = $data['sales_returns']->sum('amount');
                            $total_sales_amount = $sales + $online_sales - $sales_returns;

                            $sales = $data['sales']->where('category_id', $row->category_id)->sum('qty');
                            $online_sales = $data['online_sales']->where('category_id', $row->category_id)->sum('qty');
                            $sales_returns = $data['sales_returns']->where('category_id', $row->category_id)->sum('qty');
                            $sales_qty = $sales + $online_sales - $sales_returns;

                            $sales = $data['sales']->where('category_id', $row->category_id)->sum('amount');
                            $online_sales = $data['online_sales']->where('category_id', $row->category_id)->sum('amount');
                            $sales_returns = $data['sales_returns']->where('category_id', $row->category_id)->sum('amount');
                            $sales_amount = $sales + $online_sales - $sales_returns;
                        @endphp
                        <tr>
                            <td class="text-center px-3" width="40px">{{ $loop->iteration }}</td>
                            <td class="px-3">{{ $row->category_name }}</td>
                            <td class="px-3 text-center">
                                {{ number_format($sales_qty, 2, '.', ',') }}
                            </td>
                            <td class="px-3 text-center">
                                {{ number_format(round(($sales_qty * 100) / $total_sales_qty, 2), 2, '.', ',') }}
                            </td>
                            <td class="px-3 text-center">
                                {{ number_format($sales_amount, 2, '.', ',') }}
                            </td>
                            <td class="px-3 text-center">
                                {{ number_format(round(($sales_amount * 100) / $total_sales_amount, 2), 2, '.', ',') }}
                            </td>
                        </tr>
                        @php
                            $total_sum2 += $sales_amount;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-primary">
                        <th colspan="4" class="text-end text-white px-3">Total</th>
                        <th class="text-center text-white px-3">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                        <th class="text-center text-white px-3"></th>
                    </tr>
                </tfoot>
            @endif
            @if ($criteria == 'employee')
                <thead>
                    <tr>
                        <th class="px-3 text-center" width="40px">SL#</th>
                        <th class="px-3">Employee</th>
                        <th class="px-3 text-center">By Value</th>
                        <th class="px-3 text-center">Value (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data['online_sales'] > 0)
                        @php
                            $total_sales_amount = $data['total_sales'];
                            if ($data['online_sales'] > 0) {
                                $percentage = round(($data['online_sales'] * 100) / $total_sales_amount, 2);
                            } else {
                                $percentage = 0;
                            }
                        @endphp
                        <tr>
                            <td class="text-center px-3" width="40px">1</td>
                            <td class="px-3">Online Sales</td>
                            <td class="px-3 text-center">
                                {{ number_format($data['online_sales'], 2, '.', ',') }}
                            </td>
                            <td class="px-3 text-center">
                                {{ number_format($percentage, 2, '.', ',') }}
                            </td>
                        </tr>
                    @endif
                    @foreach ($data['sales'] as $row)
                        @php
                            $total_sales_amount = $data['total_sales'];
                            if ($row->amount > 0) {
                                $percentage = round(($row->amount * 100) / $total_sales_amount, 2);
                            } else {
                                $percentage = 0;
                            }
                        @endphp
                        <tr>
                            <td class="text-center px-3" width="40px">
                                {{ $data['online_sales'] > 0 ? $loop->iteration + 1 : $loop->iteration }}</td>
                            <td class="px-3">{{ $row->staff_name }}</td>
                            <td class="px-3 text-center">
                                {{ number_format($row->amount, 2, '.', ',') }}
                            </td>
                            <td class="px-3 text-center">
                                {{ number_format($percentage, 2, '.', ',') }}
                            </td>
                        </tr>
                        @php
                            $total_sum2 += $row->amount;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-primary">
                        <th colspan="2" class="text-end text-white px-3">Total</th>
                        <th class="text-center text-white px-3">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                        <th class="text-center text-white px-3"></th>
                    </tr>
                </tfoot>
            @endif
            @if ($criteria == 'client_type')
                <thead>
                    <tr>
                        <th class="px-3 text-center" width="40px">SL#</th>
                        <th class="px-3">Client Type</th>
                        <th class="px-3 text-center">By Value</th>
                        <th class="px-3 text-center">Value (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['cateogry_sales'] as $row)
                        @php
                            $sales = $data['sales']->sum('amount');
                            $online_sales = $data['online_sales']->sum('amount');
                            $sales_returns = $data['sales_returns']->sum('amount');
                            $total_sales_amount = $sales + $online_sales - $sales_returns;
                            if ($row->amount > 0) {
                                $percentage = round(($row->amount * 100) / $total_sales_amount, 2);
                            } else {
                                $percentage = 0;
                            }
                        @endphp
                        <tr>
                            <td class="text-center px-3" width="40px">{{ $loop->iteration }}</td>
                            <td class="px-3">{{ $row->client_category_name }}</td>
                            <td class="px-3 text-center">
                                {{ number_format($row->amount, 2, '.', ',') }}
                            </td>
                            <td class="px-3 text-center">
                                {{ number_format($percentage, 2, '.', ',') }}
                            </td>
                        </tr>
                        @php
                            $total_sum2 += $row->amount;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-primary">
                        <th colspan="2" class="text-end text-white px-3">Total</th>
                        <th class="text-center text-white px-3">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                        <th class="text-center text-white px-3"></th>
                    </tr>
                </tfoot>
            @endif
            @if ($criteria == 'region')
                <thead>
                    <tr>
                        <th class="px-3 text-center" width="40px">SL#</th>
                        <th class="px-3">Region</th>
                        <th class="px-3 text-center">By Value</th>
                        <th class="px-3 text-center">Value (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['client_sales'] as $row)
                        @php
                            $sales = $data['sales']->sum('amount');
                            $online_sales = $data['online_sales']->sum('amount');
                            $sales_returns = $data['sales_returns']->sum('amount');
                            $total_sales_amount = $sales + $online_sales - $sales_returns;
                            $client_sales = $row->amount - @$data['client_returns']->where('client_id', $row->client_id)->first()->amount ?? 0;
                            if ($client_sales > 0) {
                                $percentage = round(($client_sales * 100) / $total_sales_amount, 2);
                            } else {
                                $percentage = 0;
                            }
                        @endphp
                        <tr>
                            <td class="text-center px-3" width="40px">{{ $loop->iteration }}</td>
                            <td class="px-3">{{ $row->region_name }}</td>
                            <td class="text-center px-3">
                                {{ number_format($client_sales, 2, '.', ',') }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($percentage, 2, '.', ',') }}
                            </td>
                        </tr>
                        @php
                            $total_sum2 += $client_sales;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-primary">
                        <th colspan="2" class="text-end text-white px-3">Total</th>
                        <th class="text-center text-white px-3">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                        <th class="text-center text-white px-3"></th>
                    </tr>
                </tfoot>
            @endif
            @if ($criteria == 'area')
                <thead>
                    <tr>
                        <th class="px-3 text-center" width="40px">SL#</th>
                        <th class="px-3">Area</th>
                        <th class="px-3 text-center">By Value</th>
                        <th class="px-3 text-center">Value (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['client_sales'] as $row)
                        @php
                            $sales = $data['sales']->sum('amount');
                            $online_sales = $data['online_sales']->sum('amount');
                            $sales_returns = $data['sales_returns']->sum('amount');
                            $total_sales_amount = $sales + $online_sales - $sales_returns;
                            $client_sales = $row->amount - @$data['client_returns']->where('client_id', $row->client_id)->first()->amount ?? 0;
                            if ($client_sales > 0) {
                                $percentage = round(($client_sales * 100) / $total_sales_amount, 2);
                            } else {
                                $percentage = 0;
                            }
                        @endphp
                        <tr>
                            <td class="text-center px-3" width="40px">{{ $loop->iteration }}</td>
                            <td class="px-3">{{ $row->area_name }}</td>
                            <td class="text-center px-3">
                                {{ number_format($client_sales, 2, '.', ',') }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($percentage, 2, '.', ',') }}
                            </td>
                        </tr>
                        @php
                            $total_sum2 += $client_sales;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-primary">
                        <th colspan="2" class="text-end text-white px-3">Total</th>
                        <th class="text-center text-white px-3">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                        <th class="text-center text-white px-3"></th>
                    </tr>
                </tfoot>
            @endif
            @if ($criteria == 'territory')
                <thead>
                    <tr>
                        <th class="px-3 text-center" width="40px">SL#</th>
                        <th class="px-3">Territory</th>
                        <th class="px-3 text-center">By Value</th>
                        <th class="px-3 text-center">Value (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['client_sales'] as $row)
                        @php
                            $sales = $data['sales']->sum('amount');
                            $online_sales = $data['online_sales']->sum('amount');
                            $sales_returns = $data['sales_returns']->sum('amount');
                            $total_sales_amount = $sales + $online_sales - $sales_returns;
                            $client_sales = $row->amount - @$data['client_returns']->where('client_id', $row->client_id)->first()->amount ?? 0;
                            if ($client_sales > 0) {
                                $percentage = round(($client_sales * 100) / $total_sales_amount, 2);
                            } else {
                                $percentage = 0;
                            }
                        @endphp
                        <tr>
                            <td class="text-center px-3" width="40px">{{ $loop->iteration }}</td>
                            <td class="px-3">{{ $row->territory_name }}</td>
                            <td class="text-center px-3">
                                {{ number_format($client_sales, 2, '.', ',') }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($percentage, 2, '.', ',') }}
                            </td>
                        </tr>
                        @php
                            $total_sum2 += $client_sales;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-primary">
                        <th colspan="2" class="text-end text-white px-3">Total</th>
                        <th class="text-center text-white px-3">{{ number_format($total_sum2, 2, '.', ',') }}</th>
                        <th class="text-center text-white px-3"></th>
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
                orderable: false,
                searchable: false,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    {
                        'text': '<i class="fal fa-file-pdf"></i> Print',
                        'className': 'getPdf',
                    },
                ]
            });

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
