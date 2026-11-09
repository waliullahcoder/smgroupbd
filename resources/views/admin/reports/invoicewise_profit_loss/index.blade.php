@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <input type="hidden" name="print" value="">
        <input type="hidden" name="filter" value="1">
        <div class="col-12">
            <label for="date_range" class="form-label"><b>Date</b></label>
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
            <thead>
                <tr class="text-nowrap">
                    <th class="text-center" width="30">SL#</th>
                    <th>Invoice No</th>
                    <th>Customer Name</th>
                    <th class="text-end">Total Amount</th>
                    <th class="text-end">Discount</th>
                    <th class="text-end">Net Payable Amount</th>
                    <th class="text-end">Total Cost</th>
                    <th class="text-end">Gross Profit</th>
                    <th class="text-end">Profit %</th>
                </tr>
            </thead>
            <tbody class="align-bottom">
                @php
                    $total_sales = 0;
                    $total_discount = 0;
                    $total_payable = 0;
                    $total_cost = 0;
                    $total_profit = 0;
                @endphp
                @foreach ($data as $row)
                    <tr>
                        <td class="align-bottom text-center">{{ $loop->iteration }}</td>
                        <td class="align-bottom">{!! $row['issue_no'] !!}</td>
                        <td class="align-bottom">{{ $row['customer_name'] }}</td>
                        <td class="align-bottom text-end">
                            {!! is_null($row['issue_no'])
                                ? '<div class="sum_data">' . $row['total_amount'] . '</div>'
                                : $row['total_amount'] !!}
                        </td>
                        <td class="align-bottom text-end">
                            {!! is_null($row['issue_no']) ? '<div class="sum_data">' . $row['discount'] . '</div>' : $row['discount'] !!}
                        </td>
                        <td class="align-bottom text-end">
                            {!! is_null($row['issue_no']) ? '<div class="sum_data">' . $row['net_payable'] . '</div>' : $row['net_payable'] !!}
                        </td>
                        <td class="align-bottom text-end">
                            {!! is_null($row['issue_no']) ? '<div class="sum_data">' . $row['total_cost'] . '</div>' : $row['total_cost'] !!}
                        </td>
                        <td class="align-bottom text-end">
                            {!! is_null($row['issue_no'])
                                ? '<div class="sum_data">' . $row['gross_profit'] . '</div>'
                                : $row['gross_profit'] !!}
                        </td>
                        <td class="align-bottom text-end">
                            {!! is_null($row['issue_no']) ? '<div class="sum_data">' . $row['profit'] . '</div>' : $row['profit'] !!}
                        </td>
                    </tr>
                    @php
                        if (is_null($row['issue_no'])) {
                            $total_sales += $row['total_amount'];
                            $total_discount += $row['discount'];
                            $total_payable += $row['net_payable'];
                            $total_cost += $row['total_cost'];
                            $total_profit += $row['gross_profit'];
                        }
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                @php
                    if (count($data) > 0) {
                        $percentage = number_format(($total_profit / $total_payable) * 100, 2, '.', '');
                    } else {
                        $percentage = 0;
                    }
                @endphp
                <tr>
                    <th class="text-end" colspan="3">Grand Total</th>
                    <th class="text-end">{{ $total_sales }}</th>
                    <th class="text-end">{{ $total_discount }}</th>
                    <th class="text-end">{{ $total_payable }}</th>
                    <th class="text-end">{{ $total_cost }}</th>
                    <th class="text-end">{{ $total_profit }}</th>
                    <th class="text-end">{{ $percentage }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                order: false,
                paging: false,
                dom: 'Bfrtip',
                responsive: true,
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
                $('input[name="print"]').val('');
                $('.filter_form')[0].setAttribute("target", "_self");
            });
        });
    </script>
@endpush
