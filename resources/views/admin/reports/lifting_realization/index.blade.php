@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <input type="hidden" name="filter" value="1">
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="vendor_id" class="form-label"><b>Vendor</b></label>
            <select name="vendor_id[]" id="vendor_id" class="form-select select" data-placeholder="Select Vendor" multiple>
                @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}"
                        {{ is_array($vendor_id) && in_array($vendor->id, $vendor_id) ? 'selected' : '' }}>
                        {{ $vendor->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="month" class="form-label"><b>Month</b></label>
            @php
                $months = ['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'];
            @endphp
            <select name="month" id="month" class="form-select select" data-placeholder="Select Month">
                @foreach ($months as $key => $item)
                    <option value="{{ $key }}" {{ $key == $month ? 'selected' : '' }}>{{ $item }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
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
    <table id="dataTable" class="table table-bordered table-sm">
        <thead>
            <tr>
                <th class="px-3 text-center" rowspan="2" width="40px">Sl#</th>
                <th class="px-3" rowspan="2">Vendor Name</th>
                <th class="px-3 text-center" rowspan="2">Previous Year</th>
                <th class="px-3 text-center" colspan="4"><b>For The Year Of {{ $year == '' ? '' : $year }}</b></th>
                <th class="px-3 text-center" colspan="4"><b>For The Month Of
                        {{ $month == '' ? '' : date('F', mktime(0, 0, 0, $month, 10)) }}</b></th>
                <th class="px-3 text-center" rowspan="2">Vendor Payable</th>
            </tr>
            <tr>
                <th class="px-3 text-center">Lifting</th>
                <th class="px-3 text-center">Payment</th>
                <th class="px-3 text-center">Return</th>
                <th class="px-3 text-center">Due</th>
                <th class="px-3 text-center">Lifting</th>
                <th class="px-3 text-center">Payment</th>
                <th class="px-3 text-center">Return</th>
                <th class="px-3 text-center">Due</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPrevious = 0;
                $totalYearLiftings = 0;
                $totalYearPayments = 0;
                $totalYearReturn = 0;
                $totalYearBalance = 0;
                $totalMonthLiftings = 0;
                $totalMonthPayments = 0;
                $totalMonthReturn = 0;
                $totalMonthBalance = 0;
                $totalPayable = 0;
            @endphp
            @foreach ($data as $row)
                <tr>
                    <td class="px-3 text-center">{{ $loop->iteration }}</td>
                    <td class="px-3">{{ $row['vendor']->name }}</td>
                    <td class="px-3 text-center">{{ number_format($row['previousBalance'], 2, '.', ',') }}</td>
                    <td class="px-3 text-center">{{ number_format($row['year_liftings'], 2, '.', ',') }}</td>
                    <td class="px-3 text-center">{{ number_format($row['year_payments'], 2, '.', ',') }}</td>
                    <td class="px-3 text-center">{{ number_format($row['year_return'], 2, '.', ',') }}</td>
                    <td class="px-3 text-center">{{ number_format($row['year_balance'], 2, '.', ',') }}</td>
                    <td class="px-3 text-center">{{ number_format($row['month_liftings'], 2, '.', ',') }}</td>
                    <td class="px-3 text-center">{{ number_format($row['month_payments'], 2, '.', ',') }}</td>
                    <td class="px-3 text-center">{{ number_format($row['month_return'], 2, '.', ',') }}</td>
                    <td class="px-3 text-center">{{ number_format($row['month_balance'], 2, '.', ',') }}</td>
                    <td class="px-3 text-center">{{ number_format($row['payable'], 2, '.', ',') }}</td>
                </tr>
                @php
                    $totalPrevious += $row['previousBalance'];
                    $totalYearLiftings += $row['year_liftings'];
                    $totalYearPayments += $row['year_payments'];
                    $totalYearReturn += $row['year_return'];
                    $totalYearBalance += $row['year_balance'];
                    $totalMonthLiftings += $row['month_liftings'];
                    $totalMonthPayments += $row['month_payments'];
                    $totalMonthReturn += $row['month_return'];
                    $totalMonthBalance += $row['month_balance'];
                    $totalPayable += $row['payable'];
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr class="bg-primary">
                <th class="text-end text-white px-3" colspan="2">Total Summary</th>
                <th class="text-center text-white px-3">{{ number_format($totalPrevious, 2, '.', ',') }}</th>
                <th class="text-center text-white px-3">{{ number_format($totalYearLiftings, 2, '.', ',') }}</th>
                <th class="text-center text-white px-3">{{ number_format($totalYearPayments, 2, '.', ',') }}</th>
                <th class="text-center text-white px-3">{{ number_format($totalYearReturn, 2, '.', ',') }}</th>
                <th class="text-center text-white px-3">{{ number_format($totalYearBalance, 2, '.', ',') }}</th>
                <th class="text-center text-white px-3">{{ number_format($totalMonthLiftings, 2, '.', ',') }}</th>
                <th class="text-center text-white px-3">{{ number_format($totalMonthPayments, 2, '.', ',') }}</th>
                <th class="text-center text-white px-3">{{ number_format($totalMonthReturn, 2, '.', ',') }}</th>
                <th class="text-center text-white px-3">{{ number_format($totalMonthBalance, 2, '.', ',') }}</th>
                <th class="text-center text-white px-3">{{ number_format($totalPayable, 2, '.', ',') }}</th>
            </tr>
        </tfoot>
    </table>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                orderable: false,
                searchable: false,
                responsive: true,
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
