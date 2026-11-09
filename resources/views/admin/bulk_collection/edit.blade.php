@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-3 col-sm-6">
            <label for="date" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date_picker" id="date" name="date"
                value="{{ date('d-m-Y', strtotime($data->date)) }}" placeholder="Date">
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="payment_type" class="form-label"><b>Payment Type</b></label>
            <select name="payment_type" id="payment_type" class="select form-select">
                <option value="Cash" {{ $data->payment_type == 'Cash' ? 'selected' : '' }}>Cash</option>
                <option value="Bank" {{ $data->payment_type == 'Bank' ? 'selected' : '' }}>Bank</option>
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="coa_setup_id" class="form-label"><b>Account Heads</b></label>
            <select name="coa_setup_id" id="coa_setup_id" class="select form-select" data-placeholder="Select Account Head"
                required>
                <option value="">Select Account Head</option>
                @foreach ($cash_heads as $cash_head)
                    <option value="{{ $cash_head->id }}" {{ $data->coa_setup_id == $cash_head->id ? 'selected' : '' }}>
                        {{ $cash_head->head_name . ' - ' . $cash_head->head_code }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="delivery_id" class="form-label"><b>Gatepass</b></label>
            <select name="delivery_id" id="delivery_id" class="form-select select" data-placeholder="Select Gatepass">
                <option value=""></option>
                @foreach ($gate_passes as $gate_pass)
                    <option value="{{ $gate_pass->id }}">{{ $gate_pass->serial_no }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="client_id" class="form-label"><b>Clients</b></label>
            <select name="client_id" id="client_id" class="select form-select" data-placeholder="Select Client">
                <option value=""></option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="sales_id" class="form-label"><b>Invoice</b></label>
            <select name="sales_id" id="sales_id" class="select form-select" data-placeholder="Select Invoice">
                <option value=""></option>
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="staff_id" class="form-label"><b>Staff</b></label>
            <select name="staff_id" id="staff_id" class="select form-select" data-placeholder="Select Staff" required>
                <option value=""></option>
                @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ $data->staff_id == $staff->id ? 'selected' : '' }}>
                        {{ $staff->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label class="form-label text-white d-block"><b>Add Invoice</b></label>
            <button type="button" class="btn btn-xs btn-primary w-100 py-2 text-uppercase" id="add_btn">Add
                Invoice</button>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-striped target-table align-middle mb-0">
                <thead class="bg-primary border-primary text-white">
                    <tr>
                        <th class="py-5px text-center">SL#</th>
                        <th class="py-5px">Client</th>
                        <th class="py-5px">Invoice No</th>
                        <th class="py-5px">Date</th>
                        <th class="py-5px">Money Receipt</th>
                        <th class="py-5px text-center">Invoice Amount</th>
                        <th class="py-5px text-center">Returned Amount</th>
                        <th class="py-5px text-center">Previous Payment</th>
                        <th class="py-5px text-center">Payment Amount</th>
                        <th class="py-5px text-center" width="40">
                            <div class="custom-control custom-checkbox mx-auto">
                                <input type="checkbox" class="custom-control-input" name="selectAll" id="checkAll"
                                    {{ count($sales) == 0 ? 'checked' : '' }}>
                                <label for="checkAll" class="custom-control-label"></label>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @foreach ($data->list as $item)
                        @php
                            $view_sales = \DB::table('view_collectionable_sales')
                                ->where('id', $item->sales_id)
                                ->first();
                        @endphp
                        <tr id="tr_{{ $item->sales_id }}">
                            <th class="text-center">{{ $loop->iteration }}</th>
                            <td>{{ @$view_sales->invoice }}</td>
                            <td>{{ @$view_sales->date }}</td>
                            <td>{{ @$view_sales->client_name }}</td>
                            <td><input type="text" name="money_receipt[{{ $item->sales_id }}]"
                                    value="{{ $item->money_receipt }}" placeholder="Money Receipt">
                            </td>
                            <td class="text-center">
                                <input type="hidden" name="client_id[{{ $item->sales_id }}]"
                                    value="{{ $item->client_id }}">
                                <input type="hidden" class="discount" name="discount[{{ $item->sales_id }}]"
                                    value="{{ @$view_sales->discount }}">
                                <input type="hidden" class="collectionable_amount"
                                    name="collectionable_amount[{{ $item->sales_id }}]"
                                    value="{{ @$view_sales->collectionable_amount + $item->paid_amount }}">
                                <input type="number" step="any" class="text-center invoice_amount" readonly
                                    name="invoice_amount[{{ $item->sales_id }}]"
                                    value="{{ @$view_sales->total_amount - @$view_sales->discount }}">
                            </td>

                            <td class="text-center">
                                {{ @$view_sales->returned_amount }}
                                <input type="hidden" class="returned_amount" id="returned_amount_{{ $item->sales_id }}"
                                    name="returned_amount[{{ $item->sales_id }}]"
                                    value="{{ @$view_sales->returned_amount }}">
                            </td>
                            <td class="text-center">
                                <input type="number" step="any" class="text-center previous_paid" readonly
                                    name="previous_paid[{{ $item->sales_id }}]"
                                    value="{{ @$view_sales->total_paid - $item->paid_amount }}">
                            </td>
                            <td class="text-center"><input type="number" step="any"
                                    name="paid_amount[{{ $item->sales_id }}]" class="text-center paid_amount"
                                    max="{{ @$view_sales->collectionable_amount + $item->paid_amount }}"
                                    placeholder="Payment Amount" value="{{ $item->paid_amount }}"></td>
                            <td>
                                <div class="custom-control custom-checkbox mx-auto">
                                    <input type="checkbox" class="custom-control-input multi_checkbox sales_id"
                                        name="sales_id[]" value="{{ $item->sales_id }}" id="{{ $item->sales_id }}"
                                        checked>
                                    <label for="{{ $item->sales_id }}" class="custom-control-label"></label>
                                </div>
                            </td>
                        </tr>
                        @php
                            $last_key = $loop->iteration;
                        @endphp
                    @endforeach
                    @foreach ($sales as $item)
                        <tr id="tr_{{ $item->id }}">
                            <th class="text-center">{{ $loop->iteration + $last_key }}</th>
                            <td>{{ $item->client_name }}</td>
                            <td>{{ $item->invoice }}</td>
                            <td>{{ $item->date }}</td>
                            <td><input type="text" name="money_receipt[{{ $item->id }}]"
                                    placeholder="Money Receipt"></td>
                            <td class="text-center">
                                <input type="hidden" name="client_id[{{ $item->id }}]"
                                    value="{{ $item->client_id }}">
                                <input type="hidden" class="discount" name="discount[{{ $item->id }}]"
                                    value="{{ $item->discount }}">
                                <input type="hidden" class="collectionable_amount"
                                    name="collectionable_amount[{{ $item->id }}]"
                                    value="{{ $item->collectionable_amount }}">
                                <input type="number" step="any" class="text-center invoice_amount" readonly
                                    name="invoice_amount[{{ $item->id }}]"
                                    value="{{ $item->total_amount - $item->discount }}">
                            </td>
                            <td class="text-center">
                                {{ $item->returned_amount }}
                                <input type="hidden" class="returned_amount" id="returned_amount_{{ $item->id }}"
                                    name="returned_amount[{{ $item->id }}]" value="{{ $item->returned_amount }}">
                            </td>
                            <td class="text-center">
                                <input type="number" step="any" class="text-center previous_paid" readonly
                                    name="previous_paid[{{ $item->id }}]" value="{{ $item->total_paid }}">
                            </td>
                            <td class="text-center"><input type="number" step="any"
                                    name="paid_amount[{{ $item->id }}]" class="text-center paid_amount"
                                    max="{{ $item->collectionable_amount }}" placeholder="Payment Amount"></td>
                            <td>
                                <div class="custom-control custom-checkbox mx-auto">
                                    <input type="checkbox" class="custom-control-input multi_checkbox sales_id"
                                        name="sales_id[]" value="{{ $item->id }}" id="{{ $item->id }}">
                                    <label for="{{ $item->id }}" class="custom-control-label"></label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-primary">
                        <th class="py-5px text-white border-primary text-end" colspan="5">Total Summary</th>
                        <th class="py-5px text-white border-primary text-center"><span
                                id="total_amount">{{ number_format($data->list->sum('invoice_amount') + $sales->sum('total_amount') - $sales->sum('discount'), 2) }}</span>
                        </th>
                        <th class="py-5px text-white border-primary text-center"></th>
                        <th class="py-5px text-white border-primary text-center"></th>
                        <th class="py-5px text-white border-primary text-center"><span
                                id="total_collection">{{ number_format($data->list->sum('paid_amount'), 2) }}</span></th>
                        <th class="py-5px text-white border-primary text-center"></th>
                    </tr>
                </tfoot>
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
                let url = "{{ Route('admin.bulk-collection.edit', $data->id) }}";
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
                e.preventDefault();
                let url = "{{ Route('admin.bulk-collection.edit', $data->id) }}";
                let client_id = $('#client_id').val();
                $('#sales_id option').remove();

                let sales_id = [];
                $(".sales_id").each(function() {
                    sales_id.push($(this).val());
                });

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        client_id: client_id,
                        sales_id: sales_id,
                        get_additional_sales: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            if (response.sales.length > 0) {
                                $('#sales_id').append('<option value=""></option>');
                                response.sales.forEach(function(item, index) {
                                    var opton =
                                        `<option value="${item.id}">${item.invoice}</option>`;
                                    $('#sales_id').append(opton);
                                });
                            }
                        }
                    }
                });
            });

            $(document).on('click', '#add_btn', function(e) {
                e.preventDefault();
                let url = "{{ Route('admin.bulk-collection.edit', $data->id) }}";
                let sales_id = $('#sales_id').val();
                if (sales_id == '') {
                    Swal.fire({
                        width: "22rem",
                        text: "Please select an Invoice!",
                        icon: "error",
                        toast: true,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }

                if ($('#tr_' + sales_id).length > 0) {
                    Swal.fire({
                        width: "22rem",
                        text: "Invoice already Exists!",
                        icon: "error",
                        toast: true,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        sales_id: sales_id,
                        get_sales: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            var length = $('#tbody tr').length;
                            var tr =
                                `<tr id="tr_${response.sales.id}">
                                    <th class="text-center">${(length+1)}</th>
                                    <td>${response.sales.client_name}</td>
                                    <td>${response.sales.invoice}</td>
                                    <td>${response.sales.date}</td>
                                    <td><input type="text" name="money_receipt[${response.sales.id}]" placeholder="Money Receipt"></td>
                                    <td class="text-center">
                                        <input type="hidden" name="client_id[${response.sales.id}]" value="${response.sales.client_id}">
                                        <input type="hidden" class="discount" name="discount[${response.sales.id}]" value="${response.sales.discount}">
                                        <input type="hidden" class="collectionable_amount" name="collectionable_amount[${response.sales.id}]" value="${response.sales.collectionable_amount}">
                                        <input type="number" step="any" class="text-center invoice_amount" readonly name="invoice_amount[${response.sales.id}]" value="${response.sales.total_amount-response.sales.discount}">
                                    </td>
                                    <td class="text-center">
                                        ${response.sales.returned_amount}
                                        <input type="hidden" class="returned_amount" id="returned_amount_${response.sales.id}" name="returned_amount[${response.sales.id}]" value="${response.sales.returned_amount}">
                                    </td>
                                    <td class="text-center">
                                        <input type="number" step="any" class="text-center previous_paid" readonly name="previous_paid[${response.sales.id}]" value="${response.sales.total_paid}">
                                    </td>
                                    <td class="text-center"><input type="number" step="any" name="paid_amount[${response.sales.id}]" class="text-center paid_amount" max="${response.sales.collectionable_amount}" placeholder="Payment Amount"></td>
                                    <td>
                                        <div class="custom-control custom-checkbox mx-auto">
                                            <input type="checkbox" class="custom-control-input multi_checkbox sales_id" name="sales_id[]" value="${response.sales.id}" id="${response.sales.id}">
                                            <label for="${response.sales.id}" class="custom-control-label"></label>
                                        </div>
                                    </td>
                                </tr>`;
                            $('#tbody').append(tr);
                            var total_amount = parseFloat(+$('#total_amount').text() + response
                                .sales
                                .total_amount - response.sales.discount).toFixed(2);
                            $('#sales_id option[value=' + sales_id + ']').remove();
                            $('#total_amount').text(total_amount);
                        }
                    }
                });
            });

            $(document).on('change', '#date', function(e) {
                e.preventDefault();
                let url = "{{ Route('admin.bulk-collection.edit', $data->id) }}";
                let date = $('#date').val();
                $('#delivery_id option').remove();

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        date: date,
                        get_datewise_gatepass: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            if (response.deliveries.length > 0) {
                                $('#delivery_id').append('<option value=""></option>');
                                response.deliveries.forEach(function(item, index) {
                                    var opton =
                                        `<option value="${item.id}">${item.serial_no}</option>`;
                                    $('#delivery_id').append(opton);
                                });
                            }
                        }
                    }
                });
            });

            function calcAmount() {
                var collecton_amount = 0;
                $('.multi_checkbox:checked').each(function(index, value) {
                    var paid = $(this).closest('tr').find('.paid_amount').val();
                    collecton_amount += parseFloat(paid);
                });
                $('#total_collection').text(parseFloat(collecton_amount).toFixed(2));
            }

            $(document).on('change', '.multi_checkbox', function(e) {
                if ($(this).is(':checked')) {
                    var collectionable_amount = $(this).closest('tr').find('.collectionable_amount').val();
                    $(this).closest('tr').find('.paid_amount').val(collectionable_amount);
                } else {
                    $(this).closest('tr').find('.paid_amount').val(0);
                }
                if ($('.multi_checkbox:checked').length == $('.multi_checkbox').length) {
                    $('#checkAll').prop('checked', true);
                } else {
                    $('#checkAll').prop('checked', false);
                }
                calcAmount();
            });

            $(document).on('change', '#checkAll', function(e) {
                if ($(this).is(':checked')) {
                    $('.multi_checkbox').each(function(index, value) {
                        var collectionable_amount = $(this).closest('tr').find(
                            '.collectionable_amount').val();
                        $(this).closest('tr').find('.paid_amount').val(collectionable_amount);
                    });
                    $('.multi_checkbox').prop('checked', true);
                } else {
                    $('.multi_checkbox').prop('checked', false);
                    $('.paid_amount').val(0);
                }
                calcAmount();
            });

            $(document).on('change', '#delivery_id', function(e) {
                e.preventDefault();
                let url = "{{ Route('admin.bulk-collection.edit', $data->id) }}";
                let delivery_id = $(this).val();

                $('.multi_checkbox:not(:checked)').closest('tr').remove();
                var checked_ids = [];
                $('.multi_checkbox:checked').each(function(i) {
                    checked_ids.push($(this).val());
                });

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        delivery_id: delivery_id,
                        checked_ids: checked_ids,
                        get_gatepasswise_sales: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            var total_amount = 0;
                            var length = $('#tbody tr').length + 1;
                            if (response.sales.length > 0) {
                                response.sales.forEach(function(item, index) {
                                    var tr =
                                        `<tr id="tr_${item.id}">
                                            <th class="text-center">${(length++)}</th>
                                            <td>${item.client_name}</td>
                                            <td>${item.invoice}</td>
                                            <td>${item.date}</td>
                                            <td><input type="text" name="money_receipt[${item.id}]" placeholder="Money Receipt"></td>
                                            <td class="text-center">
                                                <input type="hidden" name="client_id[${item.id}]" value="${item.client_id}">
                                                <input type="hidden" class="discount" name="discount[${item.id}]" value="${item.discount}">
                                                <input type="hidden" class="collectionable_amount" name="collectionable_amount[${item.id}]" value="${item.collectionable_amount}">
                                                <input type="number" step="any" class="text-center invoice_amount" readonly name="invoice_amount[${item.id}]" value="${item.total_amount-item.discount}">
                                            </td>
                                            <td class="text-center">
                                                ${item.returned_amount}
                                                <input type="hidden" class="returned_amount" id="returned_amount_${item.id}" name="returned_amount[${item.id}]" value="${item.returned_amount}">
                                            </td>
                                            <td class="text-center">
                                                <input type="number" step="any" class="text-center previous_paid" readonly name="previous_paid[${item.id}]" value="${item.total_paid}">
                                            </td>
                                            <td class="text-center"><input type="number" step="any" name="paid_amount[${item.id}]" class="text-center paid_amount" max="${item.collectionable_amount}" placeholder="Payment Amount"></td>
                                            <td>
                                                <div class="custom-control custom-checkbox mx-auto">
                                                    <input type="checkbox" class="custom-control-input multi_checkbox sales_id" name="sales_id[]" value="${item.id}" id="${item.id}">
                                                    <label for="${item.id}" class="custom-control-label"></label>
                                                </div>
                                            </td>
                                        </tr>`;
                                    $('#tbody').append(tr);
                                    total_amount += parseFloat(item.total_amount - item
                                        .discount);
                                });
                            }
                            $('#total_amount').text(parseFloat(total_amount).toFixed(2));
                            $('#total_collection').text(0);
                        }
                    }
                });
            });
        });
    </script>
@endpush
