@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-4 col-sm-6">
            <label for="client_id" class="form-label"><b>Client <span class="text-danger">*</span></b></label>
            <select name="client_id" id="client_id" class="select form-select" data-placeholder="Selct Client" required>
                <option value=""></option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $data->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="payment_no" class="form-label"><b>Payment No <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" readonly name="payment_no" id="payment_no" placeholder="Payment No"
                value="{{ $data->payment_no }}" required>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="payment_date" class="form-label"><b>Payment Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="payment_date" name="payment_date"
                value="{{ date('d-m-Y', strtotime($data->payment_date)) }}" placeholder="Payment Date" required>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="payment_type" class="form-label"><b>Payment Type <span class="text-danger">*</span></b></label>
            <select name="payment_type" id="payment_type" class="select form-select" required>
                <option value="Cash" {{ $data->payment_type == 'Cash' ? 'selected' : '' }}>Cash</option>
                <option value="Bank" {{ $data->payment_type == 'Bank' ? 'selected' : '' }}>Bank</option>
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="coa_setup_id" class="form-label"><b>Account Heads <span class="text-danger">*</span></b></label>
            <select name="coa_setup_id" id="coa_setup_id" class="select form-select" data-placeholder="Select Account Head"
                required>
                <option value="">Select Account Head</option>
                @foreach ($cash_heads as $cash_head)
                    <option value="{{ $cash_head->id }}"
                        {{ $selected_head->coa_setup_id == $cash_head->id ? 'selected' : '' }}>
                        {{ $cash_head->head_name . ' - ' . $cash_head->head_code }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="collection_type" class="form-label"><b>Collection Type <span
                        class="text-danger">*</span></b></label>
            <select name="collection_type" id="collection_type" class="select form-select" required>
                <option value="advance" {{ $data->collection_type == 'advance' ? 'selected' : '' }}>Advance</option>
                <option value="adjust" {{ $data->collection_type == 'adjust' ? 'selected' : '' }}>Adjust</option>
                <option value="collection" {{ $data->collection_type == 'collection' ? 'selected' : '' }}>Collection
                </option>
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="balance" class="form-label"><b>Balance</b></label>
            <input type="text" class="form-control" id="balance" name="balance" placeholder="Balance" readonly
                value="{{ $balance }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="staff_id" class="form-label"><b>Staff <span class="text-danger">*</span></b></label>
            <select name="staff_id" id="staff_id" class="select form-select" data-placeholder="Select Staff" required>
                <option value=""></option>
                @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ $data->staff_id == $staff->id ? 'selected' : '' }}>
                        {{ $staff->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="remarks" class="form-label"><b>Remarks</b></label>
            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks"
                value="{{ $data->remarks }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="total_collection" class="form-label"><b>Total Collection</b></label>
            <input type="text" class="form-control" id="total_collection" name="total_collection"
                value="{{ $data->amount }}" placeholder="Total Collection">
        </div>
        <div class="col-12">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="bg-primary text-white align-middle">
                    <tr>
                        <th class="text-center">SL#</th>
                        <th>Invoice No</th>
                        <th class="text-center">Sale Amount</th>
                        <th class="text-center">Previous Collection</th>
                        <th class="text-center">Current Collection</th>
                        <th class="text-center">Due Amount</th>
                        <th>
                            <div class="custom-control custom-checkbox w-fit mx-auto">
                                <input type="checkbox" class="custom-control-input" name="selectAll" id="checkAll"
                                    checked>
                                <label for="checkAll" class="custom-control-label"></label>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody" style="display: {{ $data->collection_type == 'advance' ?? 'none' }};">
                    @include('admin.collection.partial.table_rows');
                </tbody>
            </table>
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
            });

            $(document).on('change', '#payment_type', function(e) {
                let type = $(this).val();
                $('#coa_setup_id option').remove();
                let url = "{{ Route('admin.collection.edit', $data->id) }}";
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
                let url = "{{ Route('admin.collection.edit', $data->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        client_id: client_id
                    },
                    success: (response) => {
                        $('#tbody').html(response);
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
