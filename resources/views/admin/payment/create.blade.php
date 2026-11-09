@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3 align-items-end">
        <div class="col-sm-6">
            <label for="investor_id" class="form-label"><b>Investor <span class="text-danger">*</span></b></label>
            <select name="investor_id" id="investor_id" class="form-select select" data-placeholder="Select Investor" required>
                <option value=""></option>
                @foreach ($investors as $investor)
                    <option value="{{ $investor->id }}">{{ $investor->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="payment_no" class="form-label"><b>Payment No <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="payment_no" name="payment_no" placeholder="Payment No"
                value="{{ $payment_no }}" readonly required>
        </div>
        <div class="col-sm-6">
            <label for="date" class="form-label"><b>Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="date" name="date"
                value="{{ old('date') ? date('d-m-Y', strtotime(old('date'))) : date('d-m-Y') }}"
                placeholder="Select Payment Date" readonly required>
        </div>
        <div class="col-sm-6">
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
            <select class="select form-select" id="deposit_type" name="deposit_type" data-placeholder="Select Deposit Type"
                required>
                @foreach ($allDepositTypes as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="total_invest" class="form-label"><b>Total Investment</b></label>
            <input type="text" class="form-control" id="total_invest" name="total_invest" placeholder="Total Invest"
                readonly>
        </div>
        <div class="col-sm-6">
            <label for="total_payable" class="form-label"><b>Total Payable</b></label>
            <input type="text" class="form-control" id="total_payable" name="total_payable" placeholder="Total Payable"
                readonly>
        </div>
        <div class="col-sm-6">
            <label for="payment_no" class="form-label"><b>Cash Head <span class="text-danger">*</span></b></label>
            <select name="coa_setup_id" id="coa_setup_id" class="form-select select" data-placeholder="Select Cash Head"
                required>
                <option value=""></option>
                @foreach ($cash_heads as $item)
                    <option value="{{ $item->id }}">{{ $item->head_name }} - {{ $item->head_code }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="amount" class="form-label"><b>Request Amount <span class="text-danger">*</span></b></label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="Request Amount"
                max="0" required>
        </div>
    </div>
@endsection

@php
    $currentRouteName = \Request::route()->getName();
@endphp

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".date_picker").datepicker({
                format: 'dd-mm-yyyy',
                changeMonth: true,
                changeYear: true,
            });

            $(document).on('change', '#investor_id', function(event) {
                $('#total_invest').val(0);
                $('#total_payable').val(0);
                let investor_id = $(this).val();
                let url = "{{ Route($currentRouteName) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        investor_id: investor_id
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#total_invest').val(response.total_investment);
                            $('#total_payable').val(response.balance);
                            $('#amount').attr('max', response.max);
                        }
                    }
                });
            });
        });
    </script>
@endpush
