@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <input type="hidden" name="print" value="true">
        <input type="hidden" name="filter" value="1">
        <div class="col-sm-6">
            <label for="investor_id" class="form-label"><b>Investor <span class="text-danger">*</span></b></label>
            <select name="investor_id" id="investor_id" class="form-select select" data-placeholder="Select Investor"
                required>
                <option value=""></option>
                @foreach ($investors as $investor)
                    <option value="{{ $investor->id }}" {{ request('investor_id') == $investor->id ? 'selected' : '' }}>
                        {{ $investor->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="date_range" class="form-label"><b>Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off"
                value="{{ date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date)) }}" required>
        </div>
    </div>
@endsection

@section('content')
    <table id="dataTable" class="table table-bordered table-sm">
        <thead>
            <tr>
                <th class="px-3 text-end" colspan="5">Previous Balance</th>
                <th class="px-3 text-end">{{ number_format($previous_balance, 2) }}</th>
            </tr>
            <tr>
                <th class="px-3 text-center" width="40px">Sl#</th>
                <th class="px-3">Date</th>
                <th class="px-3">Description</th>
                <th class="px-3 text-end">Amount In</th>
                <th class="px-3 text-end">Amount Out</th>
                <th class="px-3 text-end">Balance</th>
            </tr>
        </thead>
        <tbody>
            @php
                $balance = $previous_balance;
                $amount_in = 0;
                $amount_out = 0;
            @endphp
            @foreach ($data as $row)
                <tr>
                    @php
                        $balance += $row->amount_in - $row->amount_out;
                        $amount_in += $row->amount_in;
                        $amount_out += $row->amount_out;
                    @endphp
                    <td class="text-center px-3">{{ $loop->iteration }}</td>
                    <td class="px-3">{{ date('d-m-Y', strtotime($row->date)) }}</td>
                    <td class="px-3">{{ $row->type }}</td>
                    <td class="px-3 text-end">{{ number_format($row->amount_in, 2) }}</td>
                    <td class="px-3 text-end">{{ number_format($row->amount_out, 2) }}</td>
                    <td class="px-3 text-end">{{ number_format($balance, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total</th>
                <th class="text-end">{{ number_format($amount_in, 2) }}</th>
                <th class="text-end">{{ number_format($amount_out, 2) }}</th>
                <th class="text-end">{{ number_format($balance, 2) }}</th>
            </tr>
        </tfoot>
    </table>
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

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                $('input[name="print"]').val('true');
                $('.filter_form')[0].setAttribute("target", "_blank");
                $('.filter_form')[0].submit();
            });

            $(document).on('click', '#filter_btn', function(e) {
                $('input[name="print"]').val('');
                $('.filter_form')[0].setAttribute("target", "_self");
            });
        });
    </script>
@endpush
