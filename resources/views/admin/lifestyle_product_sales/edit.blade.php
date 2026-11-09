@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3 align-items-center">
        <div class="col-md-2 col-sm-6">
            <label for="sales_type" class="form-label"><b>Sales Type</b></label>
            <select name="sales_type" id="sales_type" class="select form-select" data-placeholder="Sales Type">
                <option value="credit" {{ $data->sales_type == 'credit' ? 'selected' : '' }}>Credit</option>
                <option value="cash" {{ $data->sales_type == 'cash' ? 'selected' : '' }}>Cash</option>
            </select>
        </div>
        <div class="col-md-3 col-sm-6" id="accounts_area"
            style="display: {{ $data->sales_type == 'cash' ? 'block' : 'none' }};">
            <label for="coa_setup_id" class="form-label"><b>Cash Account</b></label>
            <select name="coa_setup_id" id="coa_setup_id" class="select form-select" data-placeholder="Select Cash Account"
                {{ $data->sales_type == 'cash' ? 'required' : '' }}>
                <option value="">Select Cash Account</option>
                @foreach ($cash_heads as $cash_head)
                    <option value="{{ $cash_head->id }}">{{ $cash_head->head_name . ' - ' . $cash_head->head_code }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6" id="invoice_area">
            <label for="invoice" class="form-label"><b>Invoice No.</b></label>
            <input type="text" class="form-control" id="invoice" name="invoice" value="{{ $data->invoice }}" readonly
                required placeholder="Invoice No.">
        </div>
        <div class="col-md-3 col-sm-6" id="date_area">
            <label for="date" class="form-label"><b>Invoice Date</b></label>
            <input type="text" class="form-control date_picker" id="date" name="date" required
                value="{{ date('d-m-Y', strtotime($data->date)) }}" placeholder="Invoice Date">
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="store_id" class="form-label"><b>Store</b></label>
            <select name="store_id" id="store_id" class="select form-select" data-placeholder="Select Store" required>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}" {{ $data->store_id == $store->id ? 'selected' : '' }}>
                        {{ $store->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="client_id" class="form-label"><b>Client Name</b></label>
            <select name="client_id" id="client_id" class="select form-select" data-placeholder="Select Client" required>
                <option value=""></option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $data->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-6">
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
        <div class="col-md-3 col-sm-6">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select id="product_id" class="select form-select" data-placeholder="Select Product">
                <option value="">Select Product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="variant_id" class="form-label"><b>Variants</b></label>
            <select id="variant_id" class="select form-select" data-placeholder="Select Variant">
                <option value=""></option>
            </select>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="quantity" class="form-label"><b>Quantity</b></label>
            <input type="number" class="form-control" id="quantity" name="quantity" step="any" placeholder="Quantity">
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="stock" class="form-label"><b>Stock</b></label>
            <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" step="any"
                readonly value="0">
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="credit_limit" class="form-label"><b>Credit Limit</b></label>
            <input type="number" class="form-control" id="credit_limit" name="credit_limit" placeholder="Credit Limit"
                readonly value="{{ $balance }}">
        </div>
        <div class="col-md-3 col-sm-6">
            <label class="form-label text-white"><b>Add</b></label>
            <button type="button" class="btn btn-xs btn-primary w-100 px-2 py-2" id="add_item">Add Product</button>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped target-table align-middle mb-0">
                    <thead class="bg-primary border-primary text-white">
                        <tr>
                            <th class="text-center" width="30">SL#</th>
                            <th class="text-nowrap">Product Name</th>
                            <th>Variant</th>
                            <th>Rate</th>
                            <th>Stock</th>
                            <th>Qty</th>
                            <th width="200">Amount</th>
                            <th class="text-center" width="50"><i class="far fa-trash-alt"></i></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($data->list as $item)
                            <tr id="variant_{{ $item->variant_id }}">
                                <td class="text-center" width="30">
                                    <b class="serial">{{ $loop->iteration }}</b>
                                    <input type="hidden" name="variant_id[]" value="{{ $item->variant_id }}">
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->variant->sku }}</td>
                                <td><input type="number" style="min-width: 100px;" class="form-control rate"
                                        placeholder="Rate" name="rate[]" readonly value="{{ $item->rate }}"></td>

                                @php
                                    $stock = App\Http\Controllers\Admin\LifestyleProductSalesController::stock(
                                        $item->variant_id,
                                        $data->store_id,
                                    );
                                @endphp
                                <td><input type="number" style="min-width: 100px;" class="form-control stock" readonly
                                        placeholder="Stock" name="stock[]" value="{{ $stock + $item->qty }}"></td>
                                <td><input type="number" style="min-width: 100px;" class="form-control qty"
                                        placeholder="Quantity" name="qty[]" max="{{ $stock + $item->qty }}"
                                        value="{{ $item->qty }}"></td>
                                <td><input type="number" style="min-width: 100px;" class="form-control amount"
                                        placeholder="Amount" name="amount[]" readonly value="{{ $item->amount }}"></td>
                                <td class="text-center"><button type="button"
                                        class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i
                                            class="far fa-trash-alt"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-primary text-white align-top border-primary">
                        <tr>
                            <td class="px-3" colspan="4">
                                <div class="form-check mb-2 pt-2">
                                    <input class="form-check-input" type="radio" name="discount_type" id="fixed"
                                        checked value="fixed">
                                    <label class="form-check-label" for="fixed">
                                        <b>Fix Discount</b>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="discount_type" id="percentage"
                                        value="percentage">
                                    <label class="form-check-label" for="percentage">
                                        <b>Discount (%)</b>
                                    </label>
                                </div>
                                <input type="number" max="100" min="1" id="percentage_input"
                                    class="form-control mt-2" placeholder="Discount Percentage"
                                    style="display: none; max-width: 250px;">
                            </td>
                            <td colspan="2">
                                <div class="input-group align-items-center justify-content-end text-end mb-2"
                                    style="height: 32px;">
                                    <b style="width: 100px;">Total</b>
                                </div>
                                <div class="input-group align-items-center justify-content-end text-end mb-2"
                                    style="height: 32px;">
                                    <b style="width: 100px;">Discount</b>
                                </div>
                                <div class="input-group align-items-center justify-content-end text-end"
                                    style="height: 32px;">
                                    <b style="width: 100px;">Net Payable</b>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="input-group align-items-center mb-2">
                                    <input type="number" id="total_amount" name="total_amount" class="form-control"
                                        readonly placeholder="Total Cost" value="{{ $data->total_amount }}">
                                    <b class="text-center" style="width: 40px;">TK.</b>
                                </div>
                                <div class="input-group align-items-center mb-2">
                                    <input type="number" id="discount" name="discount" class="form-control"
                                        placeholder="Discount" value="{{ $data->discount }}">
                                    <b class="text-center" style="width: 40px;">TK.</b>
                                </div>
                                <div class="input-group align-items-center">
                                    <input type="number" id="net_payable" name="net_payable" class="form-control"
                                        readonly placeholder="net Payable"
                                        value="{{ $data->total_amount - $data->discount }}">
                                    <b class="text-center" style="width: 40px;">TK.</b>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="text-end text-primary">
                <span id="limit_crosed" class="mt-4" style="display: none; font-size: 16px;">This bill has exceeded its
                    due limit</span>
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
                var balance = $('#credit_limit').val();
                var payable = $('#net_payable').val();
                var sales_type = $('#sales_type').val();
                if (sales_type == 'credit' && parseFloat(payable) > parseFloat(balance)) {
                    $('#limit_crosed').show();
                    $(":submit").attr('disabled', true);
                } else {
                    $(":submit").attr('disabled', false);
                    $('#limit_crosed').hide();
                }
                if (sales_type == 'cash') {
                    $('#accounts_area').show();
                    $('#coa_setup_id').attr('required', true);
                    $('#invoice_area').addClass('col-md-2').removeClass('col-md-4');
                    $('#date_area').addClass('col-md-2').removeClass('col-md-3');
                } else {
                    $('#accounts_area').hide();
                    $('#coa_setup_id').attr('required', false)
                    $('#invoice_area').addClass('col-md-4').removeClass('col-md-2');
                    $('#date_area').addClass('col-md-3').removeClass('col-md-2');
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
                let product_id = $(this).val();
                let url = "{{ Route('admin.sales-lifestyle-product.edit', $data->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_variants: true,
                        product_id: product_id,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#variant_id option').remove();
                            $('#variant_id').append(
                                '<option value=""></option>');
                            $.each(response.variants, function(key, value) {
                                var option =
                                    `<option value="${value.id}">${value.sku}</option>`;
                                $('#variant_id').append(option);
                            });
                        }
                    }
                });
            });

            $(document).on('change', '#variant_id', function(e) {
                var store_id = $("#store_id").val();
                var variant_id = $(this).val();

                if (store_id == '') {
                    Swal.fire({
                        width: "22rem",
                        title: "Error!",
                        text: "Please select a Store",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#stock').val(0);
                    $('#variant_id').val('');
                    $('.select').select2({
                        allowClear: true,
                    });
                    return false;
                }

                let url = "{{ Route('admin.sales-lifestyle-product.edit', $data->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        store_id: store_id,
                        variant_id: variant_id,
                        get_stock: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#stock').val(response.stock);
                        }
                    }
                });
            });

            $(document).on('change', '#client_id', function(e) {
                var client_id = $(this).val();

                let url = "{{ Route('admin.sales-lifestyle-product.edit', $data->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        client_id: client_id,
                        get_client_balance: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#credit_limit').val(response.balance);

                            if (response.client.discount > 0) {
                                $('#percentage_input').val(response.client.discount);
                                $('#fixed').prop('checked', false);
                                $('#percentage').prop('checked', true);
                                $('#percentage_input').show();
                                var discount = parseFloat(response.client.discount);
                                var total = +$("#total_amount").val();
                                var fix_discount = total * (discount / 100);
                                $("#discount").val(Math.floor(fix_discount));
                                $("#net_payable").val(total - Math.floor(fix_discount));
                            }

                            calculate();
                        }
                    }
                });
            });

            $(document).on('click', '#add_item', function(e) {
                var variant_id = $("#variant_id").val();
                var store_id = $("#store_id").val();
                var quantity = $("#quantity").val();
                var client_id = $("#client_id").val();
                var existing_key = $("#tbody tr").length + 1;

                if ($('#variant_' + variant_id).length) {
                    Swal.fire({
                        width: "22rem",
                        position: 'top-right',
                        toast: true,
                        text: "Variant Already Added!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }
                if (quantity == '' || quantity == '0') {
                    Swal.fire({
                        width: "22rem",
                        position: 'top-right',
                        toast: true,
                        text: "Please take Quantity",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }
                if (store_id == '') {
                    Swal.fire({
                        width: "22rem",
                        position: 'top-right',
                        toast: true,
                        text: "Please select a Store",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }
                if (client_id == '') {
                    Swal.fire({
                        width: "22rem",
                        position: 'top-right',
                        toast: true,
                        text: "Please select a Client",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }

                let qty = $('#quantity').val();
                let url = "{{ Route('admin.sales-lifestyle-product.edit', $data->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        variant_id: variant_id,
                        store_id: store_id,
                        quantity: quantity,
                        client_id: client_id,
                        add_product: true,
                    },
                    success: (response) => {
                        if (response.status == 'error') {
                            Swal.fire({
                                width: "22rem",
                                title: "Error!",
                                text: response.data,
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                        if (response.status == 'success') {
                            var tr =
                                `<tr id="variant_${response.variant.id}">
                                    <td class="text-center" width="30">
                                        <b class="serial">${existing_key}</b>
                                        <input type="hidden" name="variant_id[]" value="${ response.variant.id }">
                                    </td>
                                    <td>${ response.variant.product.name }</td>
                                    <td>${ response.variant.sku }</td>
                                    <td><input type="number" style="min-width: 100px;" class="form-control rate" placeholder="Rate" name="rate[]" readonly value="${ response.price }"></td>
                                    <td><input type="number" style="min-width: 100px;" class="form-control stock" readonly placeholder="Stock" name="stock[]" value="${response.stock}"></td>
                                    <td><input type="number" style="min-width: 100px;" class="form-control qty" placeholder="Quantity" name="qty[]" max="${response.stock}" value="${ response.quantity }"></td>
                                    <td><input type="number" style="min-width: 100px;" class="form-control amount" placeholder="Amount" name="amount[]" readonly value="${ response.amount }"></td>
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
                $('.serial').each(function(index, value) {
                    $(value).text(index + 1);
                    var amount = $('input[name="amount[]"]')[index];
                    var amount_val = $(amount).val();
                    total_amount += parseFloat(amount_val);
                });
                var discount = +$('#discount').val();
                var net_payable = total_amount - discount;
                $('#total_amount').val(total_amount);
                $('#net_payable').val(net_payable);
                var balance = $('#credit_limit').val();
                var payable = $('#net_payable').val();
                var sales_type = $('#sales_type').val();
                if (sales_type == 'credit' && parseFloat(payable) > parseFloat(balance)) {
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
                var discount = $(this).val();
                if (discount > 100) {
                    $(this).val(100);
                    var discount = 100;
                }

                var total = $("#total_amount").val();
                var fix_discount = parseFloat(total) * (parseFloat(discount) / 100);
                $("#discount").val(Math.floor(fix_discount));
                $("#net_payable").val(total - Math.floor(fix_discount));

                var balance = $('#credit_limit').val();
                var payable = $('#net_payable').val();
                var sales_type = $('#sales_type').val();
                if (sales_type == 'credit' && parseFloat(payable) > parseFloat(balance)) {
                    $('#limit_crosed').show();
                    $(":submit").attr('disabled', true);
                } else {
                    $(":submit").attr('disabled', false);
                    $('#limit_crosed').hide();
                }
            });

            $(document).on('wheel keyup change', '#discount', function(e) {
                var total_amount = parseFloat($('#total_amount').val());
                var discount = parseFloat($(this).val());
                $('#net_payable').val(total_amount - discount);

                var balance = $('#credit_limit').val();
                var payable = $('#net_payable').val();
                var sales_type = $('#sales_type').val();
                if (sales_type == 'credit' && parseFloat(payable) > parseFloat(balance)) {
                    $('#limit_crosed').show();
                    $(":submit").attr('disabled', true);
                } else {
                    $(":submit").attr('disabled', false);
                    $('#limit_crosed').hide();
                }
            });

            $(document).on('submit', '#store_form', function(e) {
                e.preventDefault();
                $('.btn-spiner').show();
                $('.submit_btn').attr('disabled', true);
                var payable = $('#net_payable').val();
                if (payable == 0) {
                    Swal.fire({
                        width: "22rem",
                        title: "Error!",
                        text: "Invoice amount must be greater than 0!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }
                $('#store_form')[0].submit();
            });
        });
    </script>
@endpush
