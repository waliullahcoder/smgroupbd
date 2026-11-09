@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="sales_by" class="form-label"><b>Sales By <span class="text-danger">*</span></b></label>
            <select name="sales_by" id="sales_by" class="select form-select" required>
                <option value="manual">By Manual</option>
                <option value="barcode">By Barcode</option>
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6" id="sales_type_area">
            <label for="sales_type" class="form-label"><b>Sales Type <span class="text-danger">*</span></b></label>
            <select name="sales_type" id="sales_type" class="select form-select" data-placeholder="Sales Type" required>
                <option value="credit" {{ $data->sales_type == 'credit' ? 'selected' : '' }}>Credit</option>
                <option value="cash" {{ $data->sales_type == 'cash' ? 'selected' : '' }}>Cash</option>
            </select>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6" id="accounts_area"
            style="display: {{ $data->sales_type == 'cash' ? 'block' : 'none' }};">
            <label for="coa_setup_id" class="form-label"><b>Cash Account <span class="text-danger">*</span></b></label>
            <select name="coa_setup_id" id="coa_setup_id" class="select form-select" data-placeholder="Select Cash Account"
                {{ $data->sales_type == 'cash' ? 'required' : '' }}>
                <option value="">Select Cash Account</option>
                @foreach ($cash_heads as $cash_head)
                    <option value="{{ $cash_head->id }}" {{ $data->coa_setup_id == $cash_head->id ? 'selected' : '' }}>
                        {{ $cash_head->head_name . ' - ' . $cash_head->head_code }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="{{ $data->sales_type == 'cash' ? 'col-lg-2' : 'col-lg-3' }} col-md-4 col-sm-6" id="invoice_area">
            <label for="invoice" class="form-label"><b>Invoice No. <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="invoice" name="invoice" value="{{ $data->invoice }}" readonly
                placeholder="Invoice No." required>
        </div>
        <div class="{{ $data->sales_type == 'cash' ? 'col-lg-2' : 'col-lg-3' }} col-md-4 col-sm-6" id="date_area">
            <label for="date" class="form-label"><b>Invoice Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="date" name="date"
                value="{{ old('date') ? date('d-m-Y', strtotime(old('date'))) : date('d-m-Y', strtotime($data->date)) }}"
                placeholder="Invoice Date" required>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="client_id" class="form-label"><b>Client Name <span class="text-danger">*</span></b></label>
            <select name="client_id" id="client_id" class="select form-select" data-placeholder="Select Client" required>
                <option value=""></option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $data->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Store <span class="text-danger">*</span></b></label>
            <select name="store_id" id="store_id" class="select form-select" data-placeholder="Select Store" required>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}" {{ $data->store_id == $store->id ? 'selected' : '' }}>
                        {{ $store->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
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
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="created_by" class="form-label"><b>Sales By <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" placeholder="Purchase By" value="{{ Auth::user()->name }}" readonly
                required>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select id="product_id" class="select form-select" data-placeholder="Select Product">
                <option value="">Select Product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->code }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-sm-6">
            <div id="barcode_qty" style="display: none;">
                <label for="code" class="form-label"><b>Barcode</b></label>
                <input type="text" class="form-control" id="code" name="code" placeholder="Barcode">
            </div>
            <div id="manual_qty">
                <label for="quantity" class="form-label"><b>Quantity</b></label>
                <input type="number" class="form-control" id="quantity" step="any" value="1"
                    placeholder="Quantity">
            </div>
        </div>
        <div class="col-md-2 col-sm-6">
            <label for="stock" class="form-label"><b>Stock</b></label>
            <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock"
                step="any" readonly value="0">
        </div>
        <div class="col-md-2 col-sm-6">
            <label for="credit_limit" class="form-label"><b>Credit Limit</b></label>
            <input type="number" class="form-control" id="credit_limit" name="credit_limit" placeholder="Credit Limit"
                readonly value="{{ $balance }}">
        </div>
        <div class="col-md-2 col-sm-6">
            <label class="form-label text-white d-sm-block d-none"><b>Add</b></label>
            <button type="button" class="btn btn-xs btn-primary w-100 px-2 py-2" id="add_item">Add Product</button>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped target-table align-middle mb-0">
                    <thead class="bg-primary border-primary text-white text-nowrap">
                        <tr>
                            <th class="text-center" width="30">SL#</th>
                            <th>Code</th>
                            <th>Product name</th>
                            <th width="140">Rate</th>
                            <th width="140">Qty</th>
                            <th width="140">Amount</th>
                            <th class="text-center" width="50"><i class="far fa-trash-alt"></i></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($data->list as $item)
                            <tr>
                                <td class="text-center" width="30"><b class="serial">{{ $loop->iteration }}</b>
                                    <input type="hidden" class="product_id" id="product_id{{ $item->product_id }}"
                                        name="product_id[]" value="{{ $item->product_id }}">
                                </td>
                                <td>{{ @$item->product->code }}</td>
                                <td>{{ @$item->product->name }}</td>

                                <td><input type="number" style="min-width: 100px;" class="form-control rate"
                                        placeholder="Rate" data-id="{{ $item->product_id }}"
                                        id="rate{{ $item->product_id }}" name="rate[{{ $item->product_id }}]"
                                        value="{{ $item->rate }}"></td>
                                <td><input type="number" style="min-width: 100px;" class="form-control qty"
                                        placeholder="Quantity" step="any" data-id="{{ $item->product_id }}"
                                        id="qty{{ $item->product_id }}" name="qty[{{ $item->product_id }}]"
                                        value="{{ $item->qty }}"></td>
                                <td><input type="number" style="min-width: 100px;" class="form-control amount"
                                        placeholder="Amount" data-id="{{ $item->product_id }}"
                                        id="amount{{ $item->product_id }}" name="amount[{{ $item->product_id }}]"
                                        value="{{ $item->amount }}"></td>
                                <td class="text-center"><button type="button"
                                        class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i
                                            class="far fa-trash-alt"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-primary text-white align-top border-primary">
                        <tr>
                            <td class="px-3" colspan="4">
                                <div class="d-flex gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="discount_type"
                                            id="fixed" checked value="fixed">
                                        <label class="form-check-label" for="fixed">
                                            <b>Fix Discount</b>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="discount_type"
                                            id="percentage" value="percentage">
                                        <label class="form-check-label" for="percentage">
                                            <b>Discount (%)</b>
                                        </label>
                                    </div>
                                </div>
                                <input type="number" max="100" min="1" id="percentage_input"
                                    class="form-control" placeholder="Discount Percentage"
                                    style="display: none; max-width: 250px;">
                            </td>
                            <td colspan="3">
                                <div class="input-group flex-nowrap align-items-center">
                                    <b class="text-end me-2" style="width: 80px;">Total</b>
                                    <input type="number" id="total_amount" name="total_amount" readonly
                                        class="form-control" placeholder="Total Amount" style="min-width: 100px;"
                                        value="{{ $data->total_amount }}">
                                    <span class="text-end" style="width: 25px;">TK.</span>
                                </div>
                                <div class="input-group flex-nowrap align-items-center">
                                    <b class="text-end me-2" style="width: 80px;">Discount</b>
                                    <input type="number" id="discount" name="discount" class="form-control"
                                        placeholder="Discount" style="min-width: 100px;" value="{{ $data->discount }}">
                                    <span class="text-end" style="width: 25px;">TK.</span>
                                </div>
                                <div class="input-group flex-nowrap align-items-center">
                                    <b class="text-end me-2" style="width: 80px;">Net Payable</b>
                                    <input type="number" id="net_amount" name="net_amount" readonly
                                        class="form-control" placeholder="net Payable" style="min-width: 100px;"
                                        value="{{ $data->total_amount - $data->discount }}">
                                    <span class="text-end" style="width: 25px;">TK.</span>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="text-end text-danger">
                <p id="limit_crosed" class="mb-0 mt-2" style="display: none; font-size: 16px;">This bill has exceeded its
                    due limit</p>
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
            });

            $(document).on('change', '#sales_type', function(e) {
                var balance = +$('#credit_limit').val();
                var payable = +$('#net_amount').val();
                var sales_type = $('#sales_type').val();
                if (sales_type == 'credit' && payable > balance) {
                    $('#limit_crosed').show();
                    $(":submit").attr('disabled', true);
                } else {
                    $(":submit").attr('disabled', false);
                    $('#limit_crosed').hide();
                }
                if (sales_type == 'cash') {
                    $('#accounts_area').show();
                    $('#coa_setup_id').attr('required', true);
                    $('#invoice_area').addClass('col-lg-2').removeClass('col-lg-3');
                    $('#date_area').addClass('col-lg-2').removeClass('col-lg-3');
                } else {
                    $('#accounts_area').hide();
                    $('#coa_setup_id').attr('required', false);
                    $('#invoice_area').removeClass('col-lg-2').addClass('col-lg-3');
                    $('#date_area').removeClass('col-lg-2').addClass('col-lg-3');
                }
                $('.select').select2({
                    allowClear: true,
                });
            });

            $(document).on('change', '#store_id', function(e) {
                $('#tbody tr').remove();
                calculate();
            });

            $(document).on('change', '#product_id', function(e) {
                var store_id = $("#store_id").val();
                var product_id = $(this).val();
                $('#stock').val(0);

                if (store_id == null) {
                    Swal.fire({
                        width: "22rem",
                        toast: true,
                        position: 'top-right',
                        text: "Please select a Store",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500,
                        showClass: {
                            popup: `
                            animate__animated
                            animate__bounceInRight
                            animate__faster
                            `
                        },
                        hideClass: {
                            popup: `
                            animate__animated
                            animate__bounceOutRight
                            animate__faster
                            `
                        }
                    });
                    $('#product_id').val('');
                    $('.select').select2({
                        allowClear: true,
                    });
                    return false;
                }

                let url = "{{ Route('admin.sales.edit', $data->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_stock: true,
                        store_id: store_id,
                        product_id: product_id,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#stock').val((response.stock).toFixed(2));
                        }
                    }
                });
            });

            $(document).on('change', '#client_id', function(e) {
                var client_id = $(this).val();
                let url = "{{ Route('admin.sales.edit', $data->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_balance: true,
                        client_id: client_id,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#credit_limit').val(response.balance);
                            var balance = +response.balance;
                            var payable = +$('#net_amount').val();
                            var sales_type = $('#sales_type').val();
                            if (sales_type == 'credit' && payable > balance) {
                                $('#limit_crosed').show();
                                $(":submit").attr('disabled', true);
                            } else {
                                $(":submit").attr('disabled', false);
                                $('#limit_crosed').hide();
                            }
                        }
                    }
                });
            });

            $(document).on('click', '#add_item', function(e) {
                var product_id = $("#product_id").val();
                var store_id = $("#store_id").val();
                var quantity = +$("#quantity").val();
                var stock = +$("#stock").val();
                var client_id = $("#client_id").val();
                var existing_key = $("#tbody tr").length;

                if ($('#product' + product_id).length) {
                    Swal.fire({
                        toast: true,
                        icon: "error",
                        width: "22rem",
                        position: 'top-right',
                        text: "Product Already Added!",
                        showConfirmButton: false,
                        timer: 1500,
                        showClass: {
                            popup: `
                            animate__animated
                            animate__bounceInRight
                            animate__faster
                            `
                        },
                        hideClass: {
                            popup: `
                            animate__animated
                            animate__bounceOutRight
                            animate__faster
                            `
                        }
                    });
                    return false;
                }
                if (product_id == '') {
                    Swal.fire({
                        toast: true,
                        icon: "error",
                        width: "22rem",
                        position: 'top-right',
                        text: "Please select a Product",
                        showConfirmButton: false,
                        timer: 1500,
                        showClass: {
                            popup: `
                            animate__animated
                            animate__bounceInRight
                            animate__faster
                            `
                        },
                        hideClass: {
                            popup: `
                            animate__animated
                            animate__bounceOutRight
                            animate__faster
                            `
                        }
                    });
                    return false;
                }
                if (quantity > stock) {
                    Swal.fire({
                        toast: true,
                        icon: "error",
                        width: "22rem",
                        position: 'top-right',
                        text: "Stock Insuficient!",
                        showConfirmButton: false,
                        timer: 1500,
                        showClass: {
                            popup: `
                            animate__animated
                            animate__bounceInRight
                            animate__faster
                            `
                        },
                        hideClass: {
                            popup: `
                            animate__animated
                            animate__bounceOutRight
                            animate__faster
                            `
                        }
                    });
                    return false;
                }
                if (quantity == 0) {
                    Swal.fire({
                        toast: true,
                        icon: "error",
                        width: "22rem",
                        position: 'top-right',
                        text: "Please take Quantity",
                        showConfirmButton: false,
                        timer: 1500,
                        showClass: {
                            popup: `
                            animate__animated
                            animate__bounceInRight
                            animate__faster
                            `
                        },
                        hideClass: {
                            popup: `
                            animate__animated
                            animate__bounceOutRight
                            animate__faster
                            `
                        }
                    });
                    return false;
                }
                if (store_id == '') {
                    Swal.fire({
                        toast: true,
                        icon: "error",
                        width: "22rem",
                        position: 'top-right',
                        text: "Please select a Store",
                        showConfirmButton: false,
                        timer: 1500,
                        showClass: {
                            popup: `
                            animate__animated
                            animate__bounceInRight
                            animate__faster
                            `
                        },
                        hideClass: {
                            popup: `
                            animate__animated
                            animate__bounceOutRight
                            animate__faster
                            `
                        }
                    });
                    return false;
                }
                if (client_id == '') {
                    Swal.fire({
                        toast: true,
                        icon: "error",
                        width: "22rem",
                        position: 'top-right',
                        text: "Please select a Client",
                        showConfirmButton: false,
                        timer: 1500,
                        showClass: {
                            popup: `
                            animate__animated
                            animate__bounceInRight
                            animate__faster
                            `
                        },
                        hideClass: {
                            popup: `
                            animate__animated
                            animate__bounceOutRight
                            animate__faster
                            `
                        }
                    });
                    return false;
                }

                $.ajax({
                    url: "{{ Route('admin.sales.edit', $data->id) }}",
                    type: "POST",
                    data: {
                        _method: 'GET',
                        product_id: product_id,
                        store_id: store_id,
                        quantity: quantity
                    },
                    success: (response) => {
                        if (response.status == 'error') {
                            Swal.fire({
                                toast: true,
                                icon: "error",
                                width: "22rem",
                                position: 'top-right',
                                text: response.data,
                                showConfirmButton: false,
                                timer: 1500,
                                showClass: {
                                    popup: `
                                    animate__animated
                                    animate__bounceInRight
                                    animate__faster
                                    `
                                },
                                hideClass: {
                                    popup: `
                                    animate__animated
                                    animate__bounceOutRight
                                    animate__faster
                                    `
                                }
                            });
                        }

                        if (response.status == 'success') {
                            var tr =
                                `<tr id="product${product_id}">
                                    <td class="text-center" width="30">
                                        ${(existing_key+1)}
                                        <input type="hidden" class="product_id" id="product_id${product_id}" name="product_id[]" value="${product_id}">
                                    </td>
                                    <td>${response.product.code}</td>
                                    <td>${response.product.name}</td>
                                    <td><input type="number" style="min-width: 100px;" class="form-control rate" placeholder="Rate" data-id="${product_id}" id="rate${product_id}" name="rate[${product_id}]" value="${response.price}"></td>
                                    <td><input type="number" style="min-width: 100px;" class="form-control qty" placeholder="Quantity" step="any" data-id="${product_id}" id="qty${product_id}" name="qty[${product_id}]" value="${quantity}"></td>
                                    <td><input type="number" style="min-width: 100px;" class="form-control amount" placeholder="Amount" data-id="${product_id}" id="amount${product_id}" name="amount[${product_id}]" value="${response.amount}"></td>
                                    <td class="text-center"><button type="button" class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i class="far fa-trash-alt"></i></button></td>
                                </tr>`;
                            $('#tbody').append(tr);
                            calculate();
                        }
                    }
                });
            });

            $(document).on('click', '.remove_item', function(e) {
                $(this).closest('tr').remove();
                calculate();
            });

            function calculate() {
                var total_amount = 0;
                $('.product_id').each(function(index, value) {
                    var product_id = $(this).val();
                    var amount = +$('#amount' + product_id).val();
                    total_amount += amount;
                });
                $('#total_amount').val(total_amount);
                var discount = +$('#discount').val();
                var net_amount = total_amount - discount;
                $('#net_amount').val(net_amount);
                var balance = +$('#credit_limit').val();
                var payable = +$('#net_amount').val();
                var sales_type = $('#sales_type').val();
                if (sales_type == 'credit' && payable > balance) {
                    $('#limit_crosed').show();
                    $(":submit").attr('disabled', true);
                } else {
                    $(":submit").attr('disabled', false);
                    $('#limit_crosed').hide();
                }
            }

            $(document).on('change', 'input[name="discount_type"]', function(e) {
                if ($(this).val() == 'percentage') {
                    $('#percentage_input').show();
                } else {
                    $('#percentage_input').hide();
                }
            });

            $(document).on('wheel keyup change', '#percentage_input', function(event) {
                var discount = +$(this).val();
                if (discount > 100) {
                    $(this).val(100);
                    var discount = 100;
                }

                var total = +$("#total_amount").val();
                var fixed_discount = total * (discount / 100);
                $("#discount").val(Math.floor(fixed_discount));
                $("#net_amount").val(total - Math.floor(fixed_discount));
                calculate();
            });

            $(document).on('wheel keyup change', '#discount', function(e) {
                var total_amount = +$('#total_amount').val();
                var discount = +$(this).val();
                if (discount > total_amount) {
                    var discount = total_amount;
                }
                $('#net_amount').val(total_amount - discount);
                calculate();
            });

            $(document).on('wheel keyup change', '.rate,.qty', function(e) {
                var product_id = $(this).data('id');
                var rate = +$('#rate' + product_id).val();
                var qty = +$('#qty' + product_id).val();
                $('#amount' + product_id).val(rate * qty);
                calculate();
            });

            $(document).on('wheel keyup change', '.amount', function(e) {
                var product_id = $(this).data('id');
                var amount = +$('#amount' + product_id).val();
                var qty = +$('#qty' + product_id).val();
                $('#rate' + product_id).val(amount / qty);
                calculate();
            });

            $(document).on('change', '#sales_by', function(e) {
                if ($(this).val() == 'barcode') {
                    $('#barcode_qty').show();
                    $('#manual_qty').hide();
                } else {
                    $('#barcode_qty').hide();
                    $('#manual_qty').show();
                }
            });

            $(document).on('keypress', '#code', function(e) {
                if (e.which == 13) {
                    var client_id = $("#client_id").val();
                    if (client_id == '') {
                        Swal.fire({
                            toast: true,
                            icon: "error",
                            width: "22rem",
                            position: 'top-right',
                            text: "Please select a Client",
                            showConfirmButton: false,
                            timer: 1500,
                            showClass: {
                                popup: `
                                animate__animated
                                animate__bounceInRight
                                animate__faster
                                `
                            },
                            hideClass: {
                                popup: `
                                animate__animated
                                animate__bounceOutRight
                                animate__faster
                                `
                            }
                        });
                        return false;
                    }

                    var existing_key = $("#tbody tr").length;
                    var formData = $('#update_form').serialize();
                    formData += '&barcode=true&_method=GET';
                    $.ajax({
                        url: "{{ Route('admin.sales.edit', $data->id) }}",
                        type: "POST",
                        data: formData,
                        success: (response) => {
                            if (response.status == 'error') {
                                Swal.fire({
                                    toast: true,
                                    icon: "error",
                                    width: "22rem",
                                    position: 'top-right',
                                    text: response.data,
                                    showConfirmButton: false,
                                    timer: 1500,
                                    showClass: {
                                        popup: `
                                        animate__animated
                                        animate__bounceInRight
                                        animate__faster
                                        `
                                    },
                                    hideClass: {
                                        popup: `
                                        animate__animated
                                        animate__bounceOutRight
                                        animate__faster
                                        `
                                    }
                                });
                            }

                            if (response.status == 'increment') {
                                $('#qty' + response.product_id).val(response.total_qty);
                                $('#amount' + response.product_id).val(response.amount);
                                calculate();
                            }

                            if (response.status == 'success') {
                                var tr =
                                    `<tr id="product${response.product.id}">
                                    <td class="text-center" width="30">
                                        ${(existing_key+1)}
                                        <input type="hidden" class="product_id" id="product_id${response.product.id}" name="product_id[]" value="${response.product.id}">
                                    </td>
                                    <td>${response.product.code}</td>
                                    <td>${response.product.name}</td>
                                    <td><input type="number" style="min-width: 100px;" class="form-control rate" placeholder="Rate" data-id="${response.product.id}" id="rate${response.product.id}" name="rate[${response.product.id}]" value="${response.price}"></td>
                                    <td><input type="number" style="min-width: 100px;" class="form-control qty" placeholder="Quantity" step="any" data-id="${response.product.id}" id="qty${response.product.id}" name="qty[${response.product.id}]" max="${stock}" value="1"></td>
                                    <td><input type="number" style="min-width: 100px;" class="form-control amount" placeholder="Amount" data-id="${response.product.id}" id="amount${response.product.id}" name="amount[${response.product.id}]" value="${response.price}"></td>
                                    <td class="text-center"><button type="button" class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i class="far fa-trash-alt"></i></button></td>
                                </tr>`;
                                $('#tbody').append(tr);
                                calculate();
                            }
                        }
                    });
                    e.preventDefault();
                }
            });

            $(document).on('submit', '#update_form', function(e) {
                e.preventDefault();
                $('.btn-spiner').show();
                $('.submit_btn').attr('disabled', true);
                $('#update_form')[0].submit();
            });
        });
    </script>
@endpush
