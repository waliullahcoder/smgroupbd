@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-4 col-sm-6">
            <label for="client_id" class="form-label"><b>Client <span class="text-danger">*</span></b></label>
            <select name="client_id" id="client_id" class="select form-select" data-placeholder="Selct Client" required>
                <option value=""></option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}"
                        {{ old('client_id') && old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="payment_no" class="form-label"><b>Payment No <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" readonly name="payment_no" id="payment_no" placeholder="Payment No"
                value="{{ $payment_no }}" required>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="payment_date" class="form-label"><b>Payment Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="payment_date" name="payment_date"
                value="{{ date('d-m-Y', strtotime(old('payment_date'))) }}" placeholder="Payment Date" required>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="payment_type" class="form-label"><b>Payment Type <span class="text-danger">*</span></b></label>
            <select name="payment_type" id="payment_type" class="select form-select" required>
                <option value="Cash" {{ old('payment_type') && old('payment_type') == 'Cash' ? 'selected' : '' }}>Cash
                </option>
                <option value="Bank" {{ old('payment_type') && old('payment_type') == 'Bank' ? 'selected' : '' }}>Bank
                </option>
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="coa_setup_id" class="form-label"><b>Account Heads <span class="text-danger">*</span></b></label>
            <select name="coa_setup_id" id="coa_setup_id" class="select form-select" data-placeholder="Select Account Head"
                required>
                <option value="">Select Account Head</option>
                @foreach ($cash_heads as $cash_head)
                    <option value="{{ $cash_head->id }}">{{ $cash_head->head_name . ' - ' . $cash_head->head_code }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="collection_type" class="form-label"><b>Collection Type <span
                        class="text-danger">*</span></b></label>
            <select name="collection_type" id="collection_type" class="select form-select" required>
                <option value="advance"
                    {{ old('collection_type') && old('collection_type') == 'advance' ? 'selected' : '' }}>Advance</option>
                <option value="adjust"
                    {{ old('collection_type') && old('collection_type') == 'adjust' ? 'selected' : '' }}>
                    Adjust</option>
                <option value="collection"
                    {{ old('collection_type') && old('collection_type') == 'collection' ? 'selected' : '' }}>Collection
                </option>
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="balance" class="form-label"><b>Balance</b></label>
            <input type="text" class="form-control" id="balance" name="balance" placeholder="Balance" readonly
                value="{{ old('balance') ? old('balance') : 0 }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="staff_id" class="form-label"><b>Staff <span class="text-danger">*</span></b></label>
            <select name="staff_id" id="staff_id" class="select form-select" data-placeholder="Select Staff" required>
                <option value=""></option>
                @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ Auth::user()->staff_id == $staff->id ? 'selected' : '' }}>
                        {{ $staff->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="remarks" class="form-label"><b>Remarks</b></label>
            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="total_collection" class="form-label"><b>Total Collection</b></label>
            <input type="text" class="form-control" id="total_collection" name="total_collection" value="0"
                placeholder="Total Collection">
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle mb-0">
                    <thead class="bg-primary text-white align-middle text-nowrap">
                        <tr>
                            <th class="text-center">SL#</th>
                            <th>Invoice No</th>
                            <th class="text-center">Sale Amount</th>
                            <th class="text-center">Previous Collection</th>
                            <th class="text-center">Current Collection</th>
                            <th class="text-center">Due Amount</th>
                            <th>
                                <div class="custom-control custom-checkbox w-fit mx-auto">
                                    <input type="checkbox" class="custom-control-input" name="selectAll" id="checkAll">
                                    <label for="checkAll" class="custom-control-label"></label>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody" style="display: none;">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".date_picker").datepicker({
                format: 'dd-mm-yyyy',
                changeMonth: true,
                changeYear: true,
            }).datepicker('setDate', 'today');

            $(document).on('change', '#payment_type', function(e) {
                let type = $(this).val();
                $('#coa_setup_id option').remove();
                let url = "{{ Route('admin.collection.create') }}";
                $.ajax({
                    url: url,
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

            $(document).on('change', '#client_id', function(e) {
                $('#tbody').html('');
                $('#total_collection').val(0);
                $('#checkAll').prop('checked', false);
                let client_id = $('#client_id').val();
                let collection_type = $('#collection_type').val();
                let url = "{{ Route('admin.collection.create') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        client_id: client_id
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#balance').val(response.balance);
                            var i = 1;
                            if (response.sales.length > 0) {
                                response.sales.forEach(function(item, index) {
                                    var tr = `
                                        <tr>
                                            <td class="text-center"><b>${i++}</b></td>
                                            <td>${item.invoice}</td>
                                            <td class="text-center">
                                                ${+item.total_amount - +item.discount}
                                                <input type="hidden" class="amount" id="amount_${item.id}" name="amount[${item.id}]" value="${+item.total_amount - +item.discount}">
                                            </td>
                                            <td class="text-center">
                                                ${+item.total_paid + +item.returned_amount}
                                                <input type="hidden" class="prev_collection" id="prev_collection_${item.id}" name="prev_collection[${item.id}]" value="${+item.total_paid + +item.returned_amount}">
                                            </td>
                                            <td class="text-center">
                                                <input type="number" step=".01" value="0" id="collection_${item.id}" name="collection[${item.id}]" max="${item.collectionable_amount}" class="curr_collection text-center mx-auto" style="width: 200px;">
                                            </td>
                                            <td class="text-center">
                                                <span class="due" id="due_span_${item.id}">${item.collectionable_amount}</span>
                                                <input type="hidden" class="due_amount" id="due_amount_${item.id}" name="due[${item.id}]" value="${item.collectionable_amount}">
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox w-fit mx-auto">
                                                    <input type="checkbox" class="custom-control-input multi_checkbox" name="sales_id[]"
                                                        value="${item.id}" id="${item.id}">
                                                    <label for="${item.id}" class="custom-control-label"></label>
                                                </div>
                                            </td>
                                        </tr>`;
                                    $('#tbody').append(tr);
                                });
                            }
                            if (collection_type == 'collection' || collection_type ==
                                'adjust') {
                                $('#tbody').show();
                            } else {
                                $('#tbody').hide();
                            }
                        }
                    }
                });
            });

            $(document).on('change', '#collection_type', function(e) {
                let collection_type = $(this).val();
                if (collection_type == 'collection' || collection_type == 'adjust') {
                    $('#tbody').show();
                } else {
                    $('#tbody').hide();
                    $('#checkAll').prop('checked', false);
                }
            });

            $(document).on('wheel keyup change', '.curr_collection', function(e) {
                var collection = $(this).val();
                var amount = $(this).closest('tr').find('.amount').val();
                var due = $(this).closest('tr').find('.due_amount').val();
                var exact_due = due - collection;
                $(this).closest('tr').find('.due').text(exact_due);

                collecton_amount = 0;
                $('.curr_collection').each(function(index, value) {
                    collecton_amount += parseFloat($(value).val());
                });
                $('#total_collection').val(collecton_amount);
            });

            $(document).on('change', '#checkAll', function(e) {
                if ($(this).is(':checked')) {
                    collecton_amount = 0;
                    $('.multi_checkbox').each(function(index, value) {
                        var id = $(this).val();
                        var due = +$('#due_amount_' + id).val();
                        $('#collection_' + id).val(due);
                        $('#due_span_' + id).text(0);
                        collecton_amount += due;
                    });
                    $('[name="sales_id[]"]').prop('checked', true);
                    $('#total_collection').val(collecton_amount);
                } else {
                    $('.multi_checkbox').each(function(index, value) {
                        var id = $(this).val();
                        var due = +$('#due_amount_' + id).val();
                        $('#due_span_' + id).text(due);
                        $('#collection_' + id).val(0);
                    });
                    $('[name="sales_id[]"]').prop('checked', false);
                    $('#total_collection').val(0);
                }
            });

            $(document).on('change', '.multi_checkbox', function(e) {
                var id = $(this).val();
                var due = +$('#due_amount_' + id).val();
                if ($(this).is(':checked')) {
                    $('#collection_' + id).val(due);
                    $('#due_span_' + id).text(0);
                } else {
                    $('#collection_' + id).val(0);
                    $('#due_span_' + id).text(due);
                }
                calcAmount();
            });

            function calcAmount() {
                var collecton_amount = 0;
                $('.multi_checkbox:checked').each(function(index, value) {
                    var id = $(this).val();
                    collecton_amount += +$('#collection_' + id).val();
                });
                $('#total_collection').val(collecton_amount);

                if ($('.multi_checkbox:checked').length == $('.multi_checkbox').length) {
                    $('#checkAll').prop('checked', true);
                } else {
                    $('#checkAll').prop('checked', false);
                }
            }

            $('#total_collection').keypress(function(e) {
                var keycode = (e.keyCode ? e.keyCode : e.which);
                if (keycode == '13') {
                    e.preventDefault();
                    let totalAmount = +$(e.target).val();
                    let ballance = +$('#balance').val();
                    if ($('#collection_type').val() == 'adjust' && totalAmount > ballance) {
                        swal({
                            title: "<small class='text-danger'>Error!</small>",
                            type: "error",
                            text: 'Collection amount should not be cross Ballance!',
                            timer: 1000,
                            html: true,
                        });
                        return;
                    }

                    if ($('#collection_type').val() == 'collection' && totalAmount > Math.abs(ballance)) {
                        $(e.target).val(Math.abs(ballance));
                    }

                    $('.multi_checkbox').each(function() {
                        if (totalAmount > 0) {
                            var id = $(this).val();
                            var due_amount = +$('#due_amount_' + id).val();

                            if (due_amount > totalAmount) {
                                $('#due_span_' + id).text(due_amount - totalAmount);
                                $('#collection_' + id).val(totalAmount);
                                totalAmount -= totalAmount;
                            } else {
                                $('#due_span_' + id).text(0);
                                $('#collection_' + id).val(due_amount);
                                totalAmount -= due_amount;
                            }
                            $(this).prop('checked', true);
                        }
                    });

                    if ($('.multi_checkbox:checked').length == $('.multi_checkbox').length) {
                        $('#checkAll').prop('checked', true);
                    } else {
                        $('#checkAll').prop('checked', false);
                    }
                }
            });
        });
    </script>
@endpush
