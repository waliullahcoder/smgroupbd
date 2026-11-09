@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="vendor_id" class="form-label"><b>Vendor <span class="text-danger">*</span></b></label>
            <select name="vendor_id" id="vendor_id" class="select form-select" data-placeholder="Select Vendor" required>
                <option value=""></option>
                @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}"
                        {{ old('vendor_id') && old('vendor_id') == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="payment_date" class="form-label"><b>Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="payment_date" name="payment_date"
                value="{{ date('d-m-Y', strtotime(old('payment_date', date('Y-m-d')))) }}" placeholder="Payment Date"
                required>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="payment_no" class="form-label"><b>Payment No <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" readonly name="payment_no" id="payment_no" placeholder="Payment No"
                value="{{ $payment_no }}" required>
        </div>
        @php
            $adminSettings = \App\Models\AdminSetting::first();
        @endphp
        <div class="col-md-4 col-sm-6">
            <label for="payment_type" class="form-label"><b>Payment Type <span class="text-danger">*</span></b></label>
            <select name="payment_type" id="payment_type" class="select form-select" required>
                <option value="Cash" {{ old('payment_type') && old('payment_type') == 'Cash' ? 'selected' : '' }}>Cash
                </option>
                <option value="Bank" {{ old('payment_type') && old('payment_type') == 'Bank' ? 'selected' : '' }}>Bank
                </option>
            </select>
        </div>
        @if ($adminSettings->accounting == 1)
            <div class="col-md-4 col-sm-6">
                <label for="coa_setup_id" class="form-label"><b>Account Heads <span
                            class="text-danger custom_required">*</span></b></label>
                <select name="coa_setup_id" id="coa_setup_id" class="select form-select"
                    data-placeholder="Select Account Head" required>
                    <option value="">Select Account Head</option>
                    @foreach ($cash_heads as $cash_head)
                        <option value="{{ $cash_head->id }}">{{ $cash_head->head_name . ' - ' . $cash_head->head_code }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-md-4 col-sm-6">
            <label for="type" class="form-label"><b>Type <span class="text-danger">*</span></b></label>
            <select name="type" id="type" class="select form-select" required>
                <option value="advance" {{ old('type') && old('type') == 'advance' ? 'selected' : '' }}>Advance</option>
                <option value="payment" {{ old('type') && old('type') == 'payment' ? 'selected' : '' }}>Invoice</option>
                <option value="adjust" {{ old('type') && old('type') == 'adjust' ? 'selected' : '' }}>Adjust</option>
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="remarks" class="form-label"><b>Remarks</b></label>
            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks">
        </div>
        <div class="col-md-2 col-6">
            <label for="due" class="form-label"><b>Due</b></label>
            <input type="text" class="form-control" id="due" name="due" placeholder="Due" readonly
                value="0">
        </div>
        <div class="col-md-2 col-6">
            <label for="advance" class="form-label"><b>Advance</b></label>
            <input type="text" class="form-control" id="advance" name="advance" placeholder="Advance" readonly
                value="0">
        </div>
        {{-- <div class="col-md-4 col-sm-6">
            <label for="balance" class="form-label"><b>Balance</b></label>
            <input type="text" class="form-control" id="balance" name="balance" placeholder="Balance" readonly
                value="{{ old('balance') ? old('balance') : 0 }}">
        </div> --}}
        <div class="col-md-4 col-sm-6">
            <label for="total_paid" class="form-label"><b>Total Payment</b></label>
            <input type="text" class="form-control" id="total_paid" name="total_paid" value="0"
                placeholder="Total Payment">
        </div>
        <div class="col-12">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="bg-primary text-white">
                    <tr>
                        <th width="30" class="text-center py-1">SL#</th>
                        <th class="py-1">Lifting No</th>
                        <th class="py-1">Lifting Amount</th>
                        <th class="py-1">Previous Payment</th>
                        <th class="py-1">Due Amount</th>
                        <th class="py-1">Current Payment</th>
                        <th width="60" class="text-center py-1">
                            <div class="custom-control custom-checkbox w-fit mx-auto ps-3">
                                <input type="checkbox" class="custom-control-input" name="selectAll" id="checkAll">
                                <label for="checkAll" class="custom-control-label"></label>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#payment_type', function(e) {
                let type = $(this).val();
                $('#coa_setup_id option').remove();
                $.ajax({
                    url: '{{ request()->fullUrl() }}',
                    type: "POST",
                    data: {
                        _method: 'GET',
                        type: type,
                        get_heads: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#coa_setup_id').append(
                                '<option value="">Select Account Head</option>');
                            if (response.cash_heads.length > 0) {
                                response.cash_heads.forEach(function(item, index) {
                                    var option =
                                        `<option value="${item.id}">${item.head_name} - ${item.head_code}</option>`;
                                    $('#coa_setup_id').append(option);
                                });
                            }
                        }
                    }
                });
            });

            $(document).on('change', '#vendor_id', function() {
                $('#due').val(0);
                $('#advance').val(0);
                $('#tbody tr').remove();
                let type = $('#type').val();
                if (type == 'payment' || type == 'adjust') {
                    vendorPurchases();
                    validation();
                    distribute();
                }
            });

            $(document).on('change', '#type', function(e) {
                let type = $(this).val();
                $('#coa_setup_id').prop('required', true);
                $('.custom_required').text('*');
                if (type == 'adjust') {
                    $('.custom_required').text('');
                    $('#coa_setup_id').prop('required', false);
                }
                if (type == 'payment' || type == 'adjust') {
                    vendorPurchases();
                    validation();
                    distribute();
                } else {
                    $('#tbody tr').remove();
                }
            });

            function vendorPurchases() {
                var vendor_id = $('#vendor_id').val();
                var type = $('#type').val();
                $('#tbody tr').remove();
                $.ajax({
                    url: '{{ request()->fullUrl() }}',
                    type: 'POST',
                    data: {
                        _method: 'GET',
                        vendor_id: vendor_id,
                        type: type,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#tbody').html(response.data);
                            $('#due').val(response.due);
                            $('#advance').val(response.advance);
                            validation();
                            calculate();
                        }
                    }
                });
            }

            $(document).on('click', '#checkAll', function(e) {
                if ($(this).prop('checked')) {
                    var due = +$('#due').val();
                    var advance = +$('#advance').val();
                    var type = $('#type').val();
                    if (type == 'adjust') {
                        $('.lifting_id').each(function(key, value) {
                            if (advance <= 0) {
                                $(this).prop('checked', false);
                                return true;
                            }
                            var lifting_id = $(this).val();
                            var payable = $(this).data('payable');
                            if (advance > payable) {
                                $('#amount_' + lifting_id).val(payable);
                                $('#due_' + lifting_id).val(0);
                                advance -= payable;
                            } else {
                                $('#amount_' + lifting_id).val(advance);
                                $('#due_' + lifting_id).val(payable - advance);
                                advance = 0;
                            }
                            $(this).prop('checked', true);
                        });
                    } else {
                        $('.lifting_id').each(function(key, value) {
                            var lifting_id = $(this).val();
                            var payable = $(this).data('payable');
                            $('#amount_' + lifting_id).val(payable);
                            $('#due_' + lifting_id).val(0);
                            $(this).prop('checked', true);
                        });
                    }
                } else {
                    $('.lifting_id').prop('checked', false);
                    $('.lifting_id').each(function(key, value) {
                        var lifting_id = $(this).val();
                        var payable = $(this).data('payable');
                        $('#amount_' + lifting_id).val(0);
                        $('#due_' + lifting_id).val(payable);
                    });
                }
                calculate();
            });

            $(document).on('wheel keyup change keypress', '#total_paid', function(e) {
                var keycode = (e.keyCode ? e.keyCode : e.which);
                if (keycode == '13') {
                    e.preventDefault();
                }
                validation();
                distribute();
            });

            function validation() {
                var total_paid = +$('#total_paid').val();
                var due = +$('#due').val();
                var advance = +$('#advance').val();
                var type = $('#type').val();
                if (type == 'payment' && total_paid > due) {
                    $('#total_paid').val(due);
                }

                if (type == 'adjust' && total_paid > due && total_paid < advance) {
                    $('#total_paid').val(due);
                } else if (type == 'adjust' && total_paid > advance) {
                    $('#total_paid').val(advance);
                }
            }

            function distribute() {
                var total_paid = +$('#total_paid').val();
                $('.lifting_id').each(function() {
                    var lifting_id = $(this).val();
                    var payable = $(this).data('payable');
                    if (total_paid > 0) {
                        if (payable > total_paid) {
                            $('#amount_' + lifting_id).val(total_paid);
                            $('#due_' + lifting_id).val((payable - total_paid).toFixed(2));
                            total_paid = 0;
                        } else {
                            $('#amount_' + lifting_id).val(payable);
                            $('#due_' + lifting_id).val(0);
                            total_paid -= payable;
                        }
                        $(this).prop('checked', true);
                    } else {
                        $('#amount_' + lifting_id).val(0);
                        $('#due_' + lifting_id).val(payable);
                        $(this).prop('checked', false);
                    }
                });

                if ($('.lifting_id').length > 0 && $('.lifting_id').length == $('.lifting_id:checked')
                    .length) {
                    $('#checkAll').prop('checked', true);
                } else {
                    $('#checkAll').prop('checked', false);
                }
            }

            $(document).on('wheel keyup change', '.amount', function(e) {
                var amount = +$(this).val();
                var max = +$(this).attr('max');
                if (amount > max) {
                    $(this).val(max);
                    amount = max;
                }
                var type = $('#type').val();
                var lifting_id = $(this).data('id');
                if (type == 'adjust') {
                    var total_amount = 0;
                    $('.lifting_id:not("#' + lifting_id + '"):checked').each(function(index, value) {
                        var id = $(this).val();
                        total_amount += +$('#amount_' + id).val();
                    });
                    var balance = +$('#advance').val() - total_amount;
                    if (balance <= 0) {
                        $('#amount_' + lifting_id).val(0);
                        $('#due_' + lifting_id).val(max);
                        $('#' + lifting_id).prop('checked', false);
                        return false;
                    }
                    if (balance > amount) {
                        $('#amount_' + lifting_id).val(amount);
                        $('#due_' + lifting_id).val(max - amount);
                    } else {
                        $('#amount_' + lifting_id).val(balance);
                        $('#due_' + lifting_id).val(max - balance);
                    }
                    $('#' + lifting_id).prop('checked', true);
                } else {
                    $('#due_' + lifting_id).val(max - amount);
                    $('#' + lifting_id).prop('checked', true);
                }
                calculate();
            });

            $(document).on('click', '.lifting_id', function(e) {
                var balance = +$('#advance').val() - +$('#total_paid').val();
                var type = $('#type').val();

                var lifting_id = $(this).val();
                var payable = $(this).data('payable');
                if ($(this).prop('checked')) {
                    if (type == 'adjust') {
                        if (balance <= 0) {
                            $(this).prop('checked', false);
                            return false;
                        }
                        if (balance > payable) {
                            $('#amount_' + lifting_id).val(payable);
                            $('#due_' + lifting_id).val(0);
                        } else {
                            $('#amount_' + lifting_id).val(balance);
                            $('#due_' + lifting_id).val(payable - balance);
                        }
                    } else {
                        $('#amount_' + lifting_id).val(payable);
                        $('#due_' + lifting_id).val(0);
                    }
                } else {
                    $('#amount_' + lifting_id).val(0);
                    $('#due_' + lifting_id).val(payable);
                }
                calculate();
            });

            function calculate() {
                var total_amount = 0;
                $('.lifting_id:checked').each(function(index, value) {
                    var lifting_id = $(this).val();
                    total_amount += +$('#amount_' + lifting_id).val();
                });
                $('#total_paid').val(total_amount);
                if ($('.lifting_id').length > 0 && $('.lifting_id').length == $('.lifting_id:checked').length) {
                    $('#checkAll').prop('checked', true);
                } else {
                    $('#checkAll').prop('checked', false);
                }
            }
        });
    </script>
@endpush
