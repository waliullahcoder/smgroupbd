@extends('layouts.investor.app')

@section('content')
    @php
        $currentRouteName = \Request::route()->getName();
        $store_link = str_replace('index', 'store', $currentRouteName);
    @endphp
    <form action="{{ Route($store_link) }}" method="POST" enctype="multipart/form-data" id="store_form">
        @csrf
        <div class="card">
            <div class="card-header pe-2 py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="h6 mb-0 text-uppercase">{{ @$title ?? 'Please Set Title' }}</h6>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-sm">Request</button>
                    </div>
                </div>
            </div>
            <div class="card-body pb-5">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="flex-shrink-0">
                        <h5 class="h5">
                            <b>Total Investment : </b>
                            {{ number_format($total_investment, 2) }}
                        </h5>
                    </div>
                    <div class="flex-shrink-0">
                        <h5 class="h5">
                            <b>Balance : </b>
                            {{ number_format($balance, 2) }}
                        </h5>
                    </div>
                </div>
                <div class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="payment_no" class="form-label"><b>Payment No <span
                                            class="text-danger">*</span></b></label>
                                <input type="text" class="form-control" id="payment_no" name="payment_no"
                                    placeholder="Payment No" value="{{ $payment_no }}" readonly required>
                            </div>
                            <div class="col-12">
                                <label for="date" class="form-label"><b>Date <span
                                            class="text-danger">*</span></b></label>
                                <input type="text" class="form-control date_picker" id="date" name="date"
                                    required
                                    value="{{ old('date') ? date('d-m-Y', strtotime(old('date'))) : date('d-m-Y') }}"
                                    placeholder="Select Payment Date" readonly>
                            </div>
                            <div class="col-12">
                                <label for="deposit_type" class="form-label"><b>Payment Type <span
                                            class="text-danger">*</span></b></label>
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
                            <div class="col-12">
                                <label for="amount" class="form-label"><b>Request Amount <span
                                            class="text-danger">*</span></b></label>
                                <input type="number" class="form-control" id="amount" name="amount"
                                    placeholder="Request Amount" max="{{ $balance }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end px-3 py-2">
                <div class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-sm">Request</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
