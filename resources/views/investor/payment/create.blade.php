@extends('layouts.investor.create_app')

@section('content')
    <div class="row g-3 align-items-end">
        <div class="col-md-3 col-sm-6">
            <label for="deposit_type" class="form-label"><b>Payment Type <span class="text-danger">*</span></b></label>
            @php
                $allDepositTypes = [
                    'Cash Payment' => 'Cash Payment',
                    'Bank Deposit' => 'Bank Deposit',
                    'Bkash' => 'Bkash',
                    'Nagad' => 'Nagad',
                    'Rocket' => 'Rocket',
                ];
            @endphp
            <select class="select form-select" id="deposit_type" name="deposit_type" required
                data-placeholder="Select Deposit Type">
                @foreach ($allDepositTypes as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="payment_no" class="form-label"><b>Payment No <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="payment_no" name="payment_no" placeholder="Payment No"
                value="{{ $payment_no }}" readonly required>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="date" class="form-label"><b>Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="date" name="date" required
                value="{{ old('date') ? date('d-m-Y', strtotime(old('date'))) : date('d-m-Y') }}"
                placeholder="Select Payment Date" readonly>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="total_payable" class="form-label"><b>Total Payable</b></label>
            <input type="text" class="form-control" id="total_payable" name="total_payable"
                value="{{ $data->sum('amount') }}" readonly>
        </div>
        @if (count(@$data) > 0)
            <div class="col-12">
                <table class="table mb-0">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th class="text-center" width="50">SL#</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <th class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ @$row->product->name }} ({{ @$row->product->code }})</td>
                                <td>{{ date('d-m-Y', strtotime(@$row->parent->date)) }}</td>
                                <td>{{ @$row->parent->year }}</td>
                                <td>{{ @$row->parent->month }}</td>
                                <td>
                                    {{ number_format(@$row->amount, 2) }}
                                    <input type="hidden" name="investor_profit_list_id[]" value="{{ @$row->id }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".date_picker").datepicker({
                format: 'dd-mm-yyyy',
                changeMonth: true,
                changeYear: true,
            });
        });
    </script>
@endpush
