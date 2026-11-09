@extends('layouts.investor.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <div class="row g-3">
        <input type="hidden" name="filter" value="1">
        <div class="col-md-3 col-sm-6">
            <label for="date_range" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required
                value="{{ !is_null(request('start_date')) && !is_null(request('end_date')) ? date('d-m-Y', strtotime(request('start_date'))) . ' to ' . date('d-m-Y', strtotime(request('end_date'))) : date('d-m-Y') . ' to ' . date('d-m-Y') }}">
        </div>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
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
                @endphp
                @foreach ($data as $row)
                    <tr>
                        @php
                            $balance += $row->amount_in - $row->amount_out;
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

            $(document).on('click', '.getPdf', function(e) {
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
