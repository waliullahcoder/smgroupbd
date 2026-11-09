@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <input type="hidden" name="filter" value="1">
        <div class="col-sm-6">
            <label for="vendor_id" class="form-label"><b>Vendor <span class="text-danger">*</span></b></label>
            <select name="vendor_id" id="vendor_id" class="form-select select" data-placeholder="Select Vendor" required>
                <option value=""></option>
                @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}" {{ $vendor_id == $vendor->id ? 'selected' : '' }}>
                        {{ $vendor->name }}</option>
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
    <form action="{{ Route('admin.vendor-statement.index') }}" id="print-form" method="GET" target="_blank">
        <input type="hidden" name="print" value="true">
        <input type="hidden" name="vendor_id" class="vendor_id">
        <input type="hidden" name="date_range" class="date_range">
    </form>
    <div class="table-responsive">
        <table id="dataTable" name="paymentRecordTable" class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th colspan="6" style="text-align: right; font-weight: bold;">Previous Balance</th>
                    <th style="text-align: right;">{{ isset($data['previousBalance']) ? $data['previousBalance'] : 0 }}</th>
                </tr>
                <tr>
                    <th class="text-center" width="20px">Sl#</th>
                    <th class="text-end" width="100px">Date</th>
                    <th>Particular</th>
                    <th class="text-end" width="100px">Purchase</th>
                    <th class="text-end" width="100px">Payment</th>
                    <th class="text-end" width="100px">Returns</th>
                    <th class="text-end" width="100px">Balance</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $totalLifting = 0;
                    $totalPayment = 0;
                    $totalReturn = 0;
                    $balance = 0;
                @endphp
                @if (count($data) > 0)
                    @foreach ($data['statements'] as $statement)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-end">{{ $statement['date'] }}</td>
                            <td>{{ $statement['remarks'] }}</td>
                            <td class="text-end">{{ number_format($statement['lifting'], 2) }}</td>
                            <td class="text-end">{{ number_format($statement['payment'], 2) }}</td>
                            <td class="text-end">{{ number_format($statement['return'], 2) }}</td>
                            <td class="text-end">{{ number_format($statement['balance'], 2) }}</td>
                        </tr>
                        @php
                            $totalLifting += $statement['lifting'];
                            $totalPayment += $statement['payment'];
                            $totalReturn += $statement['return'];
                            $balance = $statement['balance'];
                        @endphp
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center text-white" colspan="3">Total</td>
                    <td class="text-end text-white">{{ number_format($totalLifting, 2) }}</td>
                    <td class="text-end text-white">{{ number_format($totalPayment, 2) }}</td>
                    <td class="text-end text-white">{{ number_format($totalReturn, 2) }}</td>
                    <td class="text-end text-white">{{ number_format($balance, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "order": false,
                dom: "<'row g-2'<'col-sm-4'l><'col-sm-8 text-end'<'d-lg-flex justify-content-end'<'mb-2 mb-lg-0 me-1'f>B>>>t<'d-lg-flex align-items-center mt-2'<'me-auto mb-lg-0 mb-2'i><'mb-0'p>>",
                lengthMenu: [10, 20, 30, 40, 50],
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
                var vendor_id = $('#vendor_id').val();
                var date_range = $('#date_range').val();
                $('.vendor_id').val(vendor_id);
                $('.date_range').val(date_range);
                if (vendor_id == '') {
                    Swal.fire({
                        width: "22rem",
                        title: "Failed!",
                        text: "Please select a Vendor!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }
                $('#print-form').submit();
            });
        });
    </script>
@endpush
