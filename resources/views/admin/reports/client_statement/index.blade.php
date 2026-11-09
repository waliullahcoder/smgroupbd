@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <input type="hidden" name="filter" value="1">
        <div class="col-sm-6">
            <label for="client_id" class="form-label"><b>Client <span class="text-danger">*</span></b></label>
            <select name="client_id" id="client_id" class="form-select select" data-placeholder="Select Client" required>
                <option value=""></option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}</option>
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
    <form action="{{ Route('admin.client-statement.index') }}" id="print-form" method="GET" target="_blank">
        <input type="hidden" name="print" value="true">
        <input type="hidden" name="client_id" class="client_id">
        <input type="hidden" name="date_range" class="date_range">
    </form>
    <div class="table-responsive">
        <table id="dataTable" name="paymentRecordTable" class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th colspan="7" class="text-end px-3">Previous Balance</th>
                    <th class="text-end px-3">
                        {{ isset($data['previousBalance']) ? number_format($data['previousBalance'], 2, '.', ',') : 0.0 }}
                    </th>
                </tr>
                <tr>
                    <th class="text-center" width="20px">Sl#</th>
                    <th width="100px">Date</th>
                    <th width="100px">Voucher</th>
                    <th width="100px">Particulars</th>
                    <th class="text-end" width="100px">Sales</th>
                    <th class="text-end" width="100px">Collection</th>
                    <th class="text-end" width="100px">Return</th>
                    <th class="text-end" width="100px">Balance</th>
                </tr>
            </thead>
            @php
                $balance = isset($data['previousBalance']) ? $data['previousBalance'] : 0;
                $total_sales = 0;
                $total_collections = 0;
                $total_return = 0;
            @endphp
            @if (count($data) > 0)
                <tbody>
                    @foreach ($data['statements'] as $statement)
                        <tr>
                            <td class="text-center px-3">{{ $loop->iteration }}</td>
                            <td>{{ $statement['date'] }}</td>
                            <td>{{ $statement['invoice'] }}</td>
                            <td>{{ $statement['particulars'] }}</td>
                            <td class="text-end px-3">{{ number_format($statement['sales'], 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($statement['collection'], 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($statement['return'], 2, '.', ',') }}</td>
                            <td class="text-end px-3">{{ number_format($statement['balance'], 2, '.', ',') }}</td>
                        </tr>
                        @php
                            $balance = $statement['balance'];
                            $total_sales += $statement['sales'];
                            $total_collections += $statement['collection'];
                            $total_return += $statement['return'];
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-primary">
                        <th colspan="4" class="text-end text-white px-3">Total Summary</th>
                        <th colspan="1" class="text-end text-white px-3">{{ number_format($total_sales, 2, '.', ',') }}
                        </th>
                        <th colspan="1" class="text-end text-white px-3">
                            {{ number_format($total_collections, 2, '.', ',') }}</th>
                        <th colspan="1" class="text-end text-white px-3">{{ number_format($total_return, 2, '.', ',') }}
                        </th>
                        <th class="text-end text-white px-3">{{ number_format($balance, 2, '.', ',') }}</th>
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

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                var client_id = $('#client_id').val();
                var date_range = $('#date_range').val();
                $('.client_id').val(client_id);
                $('.date_range').val(date_range);
                if (client_id == '') {
                    Swal.fire({
                        width: "22rem",
                        title: "Failed!",
                        text: "Please select a client!",
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
