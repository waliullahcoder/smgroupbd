
@extends('layouts.admin.create_app')

@section('content')

<div class="row g-3">

    {{-- Company --}}
    <div class="col-lg-4 col-sm-6">
        <label for="company_id" class="form-label">
            <b>Company <span class="text-danger">*</span></b>
        </label>

        <select name="company_id" id="company_id" class="select form-select"
            data-placeholder="Select Company" required>
            <option value=""></option>
            @foreach ($companies as $company)
                <option value="{{ $company->id }}"
                    {{ old('company_id') == $company->id ? 'selected' : '' }}>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Project --}}
    <div class="col-lg-4 col-sm-6">
        <label for="project_id" class="form-label">
            <b>Project <span class="text-danger">*</span></b>
        </label>

        <select name="project_id" id="project_id" class="select form-select"
            data-placeholder="Select Project" required disabled>
            <option value=""></option>
        </select>
    </div>

    <input type="hidden" name="sales_by" value="manual">
    <input type="hidden" name="sales_type" id="sales_type" value="credit">
    <input type="hidden" id="store_id" name="store_id" value="1">
    <input type="hidden" id="stock" value="0">

    {{-- Invoice --}}
    <div class="col-lg-4 col-md-4 col-sm-6" id="invoice_area">
        <label for="invoice" class="form-label">
            <b>Invoice No. <span class="text-danger">*</span></b>
        </label>
        <input type="text" class="form-control" id="invoice" name="invoice"
            value="{{ $invoice }}" readonly required>
    </div>

    {{-- Date --}}
    <div class="col-lg-4 col-md-4 col-sm-6" id="date_area">
        <label for="date" class="form-label">
            <b>Invoice Date <span class="text-danger">*</span></b>
        </label>
        <input type="text" class="form-control date_picker" id="date" name="date"
            value="{{ old('date') ? date('d-m-Y', strtotime(old('date'))) : date('d-m-Y') }}"
            placeholder="Invoice Date" required>
    </div>

    {{-- Client --}}
    <div class="col-lg-4 col-md-4 col-sm-6">
        <label for="client_id" class="form-label">
            <b>Client Name <span class="text-danger">*</span>
                <a href="{{ url('/admin/client/create') }}">Add new</a>
            </b>
        </label>

        <select name="client_id" id="client_id" class="select form-select"
            data-placeholder="Select Client" required>
            <option value=""></option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}"
                    {{ old('client_id') == $client->id ? 'selected' : '' }}>
                    {{ $client->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Sales By --}}
    <div class="col-lg-4 col-md-4 col-sm-6">
        <label for="created_by" class="form-label">
            <b>Sales By <span class="text-danger">*</span></b>
        </label>
        <input type="text" class="form-control" id="created_by"
            value="{{ Auth::user()->name }}" readonly required>
    </div>

    {{-- Product --}}
    <div class="col-md-4 col-sm-6">
        <label for="product_id" class="form-label">
            <b>Products <span class="text-danger">*</span></b>
            <a href="{{ url('/admin/product/create') }}">Add new</a>
        </label>

        <select id="product_id" class="select form-select"
            data-placeholder="Select Product">
            <option value="">Select Product</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">
                    {{ $product->name }} - {{ $product->code }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Quantity / Barcode --}}
    <div class="col-md-2 col-sm-6">
        <div id="barcode_qty" style="display:none;">
            <label for="code" class="form-label"><b>Barcode</b></label>
            <input type="text" class="form-control" id="code"
                name="code" placeholder="Barcode">
        </div>

        <div id="manual_qty">
            <label for="quantity" class="form-label"><b>Quantity</b></label>
            <input type="number" class="form-control" id="quantity"
                step="any" value="1" min="0" placeholder="Quantity">
        </div>
    </div>

    {{-- Credit Limit --}}
    <div class="col-md-2 col-sm-6">
        <label for="credit_limit" class="form-label"><b>Credit Limit</b></label>
        <input type="number" class="form-control" id="credit_limit"
            name="credit_limit" readonly value="0">
    </div>

    {{-- Add Product --}}
    <div class="col-md-4 col-sm-6">
        <label class="form-label text-white d-sm-block d-none">
            <b>Add</b>
        </label>
        <button type="button" class="btn btn-xs btn-primary w-100 px-2 py-2"
            id="add_item">
            Add Product
        </button>
    </div>

    {{-- Product Table --}}
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
                        <th class="text-center" width="50">
                            <i class="far fa-trash-alt"></i>
                        </th>
                    </tr>
                </thead>

                <tbody id="tbody"></tbody>

                <tfoot class="bg-primary text-white align-top border-primary">
                    <tr>
                        <td class="px-3" colspan="4">

                            <div class="d-flex gap-2 flex-wrap">

                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                        name="discount_type" id="fixed"
                                        checked value="fixed">
                                    <label class="form-check-label" for="fixed">
                                        <b>Fix Discount</b>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                        name="discount_type" id="percentage"
                                        value="percentage">
                                    <label class="form-check-label" for="percentage">
                                        <b>Discount (%)</b>
                                    </label>
                                </div>

                            </div>

                            <input type="number" max="100" min="0"
                                id="percentage_input" class="form-control mt-2"
                                placeholder="Discount Percentage"
                                style="display:none; max-width:250px;">

                        </td>

                        <td colspan="3">

                            {{-- Total --}}
                            <div class="input-group flex-nowrap align-items-center mb-1">
                                <b class="text-end me-2" style="width:80px;">Total</b>

                                <input type="number" id="total_amount"
                                    name="total_amount" readonly
                                    class="form-control" placeholder="Total Amount"
                                    style="min-width:100px;" value="0">

                                <span class="text-end" style="width:25px;">TK.</span>
                            </div>

                            {{-- Discount --}}
                            <div class="input-group flex-nowrap align-items-center mb-1">
                                <b class="text-end me-2" style="width:80px;">Discount</b>

                                <input type="number" id="discount"
                                    name="discount" class="form-control"
                                    placeholder="Discount"
                                    style="min-width:100px;" value="0"
                                    min="0" step="any">

                                <span class="text-end" style="width:25px;">TK.</span>
                            </div>

                            {{-- Tax: Discount এর নিচে --}}
                            
                            {{-- Tax Percentage --}}
                            <div class="input-group flex-nowrap align-items-center mb-1">
                                <b class="text-end me-2" style="width:80px;">Tax (%)</b>

                                <input type="number"
                                    id="tax"
                                    name="tax"
                                    class="form-control"
                                    placeholder="Tax Percentage"
                                    style="min-width:100px;"
                                    value="{{ old('tax', 0) }}"
                                    min="0"
                                    max="100"
                                    step="any">

                                <span class="text-end" style="width:25px;">%</span>
                            </div>

                            {{-- Tax Amount Display --}}
                            <div class="input-group flex-nowrap align-items-center mb-1">
                                <b class="text-end me-2" style="width:80px;">Tax Amount</b>

                                <input type="number"
                                    id="tax_amount"
                                    name="tax_amount"
                                    class="form-control"
                                    readonly
                                    value="0"
                                    style="min-width:100px;">

                                <span class="text-end" style="width:25px;">TK.</span>
                            </div>


                            {{-- Net Payable --}}
                            <div class="input-group flex-nowrap align-items-center">
                                <b class="text-end me-2" style="width:80px;">
                                    Net Payable
                                </b>

                                <input type="number" id="net_amount"
                                    name="net_amount" readonly
                                    class="form-control"
                                    placeholder="Net Payable"
                                    style="min-width:100px;" value="0">

                                <span class="text-end" style="width:25px;">TK.</span>
                            </div>

                        </td>
                    </tr>
                </tfoot>

            </table>
        </div>

        <div class="text-end text-danger">
            <p id="limit_crosed" class="mb-0 mt-2"
                style="display:none; font-size:16px;">
                This bill has exceeded its due limit
            </p>
        </div>
    </div>

</div>

@endsection


@push('js')

<script type="text/javascript">

$(document).ready(function () {

    // Date Picker
    $(".date_picker").datepicker({
        format: 'dd-mm-yyyy',
        changeMonth: true,
        changeYear: true
    });


    // Common notification
    function showError(message) {
        Swal.fire({
            toast: true,
            icon: "error",
            width: "22rem",
            position: 'top-right',
            text: message,
            showConfirmButton: false,
            timer: 1500
        });
    }


    // Credit Limit Validation
    function checkCreditLimit() {

        var balance = parseFloat($('#credit_limit').val()) || 0;
        var payable = parseFloat($('#net_amount').val()) || 0;
        var sales_type = $('#sales_type').val();

        if (sales_type == 'credit' && payable > balance) {

            $('#limit_crosed').show();
            $(":submit").attr('disabled', true);

        } else {

            $('#limit_crosed').hide();
            $(":submit").attr('disabled', false);
        }
    }


    // Sales Type
    $(document).on('change', '#sales_type', function () {

        checkCreditLimit();

        if ($(this).val() == 'cash') {

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
            allowClear: true
        });
    });


    // Store Change
    $(document).on('change', '#store_id', function () {
        $('#tbody tr').remove();
        calculate();
    });


    // Product Stock Check
    $(document).on('change', '#product_id', function () {

        var store_id = $("#store_id").val();
        var product_id = $(this).val();

        $('#stock').val(0);

        if (!store_id) {
            showError("Please select a Store");
            $('#product_id').val('').trigger('change');
            return false;
        }

        if (!product_id) {
            return false;
        }

        $.ajax({
            url: "{{ route('admin.sales.create') }}",
            type: "POST",
            data: {
                _method: 'GET',
                get_stock: true,
                store_id: store_id,
                product_id: product_id
            },
            success: function (response) {

                if (response.status == 'success') {
                    $('#stock').val(parseFloat(response.stock) || 0);
                }
            }
        });
    });


    // Client Balance
    $(document).on('change', '#client_id', function () {

        var client_id = $(this).val();

        if (!client_id) {
            $('#credit_limit').val(0);
            checkCreditLimit();
            return;
        }

        $.ajax({
            url: "{{ route('admin.sales.create') }}",
            type: "POST",
            data: {
                _method: 'GET',
                get_balance: true,
                client_id: client_id
            },
            success: function (response) {

                if (response.status == 'success') {

                    $('#credit_limit').val(response.balance);
                    checkCreditLimit();
                }
            }
        });
    });


    // Add Product Manually
    $(document).on('click', '#add_item', function () {

        var product_id = $("#product_id").val();
        var store_id = $("#store_id").val();
        var quantity = parseFloat($("#quantity").val()) || 0;
        var client_id = $("#client_id").val();

        var existing_key = $("#tbody tr").length;

        if (!product_id) {
            showError("Please select a Product");
            return false;
        }

        if ($('#product' + product_id).length) {
            showError("Product Already Added!");
            return false;
        }

        if (!client_id) {
            showError("Please select a Client");
            return false;
        }

        if (!quantity || quantity <= 0) {
            showError("Please take Quantity");
            return false;
        }

        $.ajax({

            url: "{{ route('admin.sales.create') }}",
            type: "POST",

            data: {
                _method: 'GET',
                product_id: product_id,
                store_id: store_id,
                quantity: quantity
            },

            success: function (response) {

                if (response.status == 'error') {
                    showError(response.data);
                    return;
                }

                if (response.status == 'success') {

                    var product = response.product;

                    var tr = `
                        <tr id="product${product_id}">

                            <td class="text-center" width="30">
                                ${existing_key + 1}
                                <input type="hidden"
                                    class="product_id"
                                    id="product_id${product_id}"
                                    name="product_id[]"
                                    value="${product_id}">
                            </td>

                            <td>${product.code}</td>
                            <td>${product.name}</td>

                            <td>
                                <input type="number"
                                    style="min-width:100px;"
                                    class="form-control rate"
                                    placeholder="Rate"
                                    data-id="${product_id}"
                                    id="rate${product_id}"
                                    name="rate[${product_id}]"
                                    value="${response.price}">
                            </td>

                            <td>
                                <input type="number"
                                    style="min-width:100px;"
                                    class="form-control qty"
                                    placeholder="Quantity"
                                    step="any"
                                    data-id="${product_id}"
                                    id="qty${product_id}"
                                    name="qty[${product_id}]"
                                    value="${quantity}">
                            </td>

                            <td>
                                <input type="number"
                                    style="min-width:100px;"
                                    class="form-control amount"
                                    placeholder="Amount"
                                    data-id="${product_id}"
                                    id="amount${product_id}"
                                    name="amount[${product_id}]"
                                    value="${response.amount}">
                            </td>

                            <td class="text-center">
                                <button type="button"
                                    class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>

                        </tr>
                    `;

                    $('#tbody').append(tr);

                    calculate();

                    $('#product_id').val('').trigger('change');
                    $('#quantity').val(1);
                }
            },

            error: function () {
                showError("Something went wrong!");
            }
        });
    });


    // Remove Product
    $(document).on('click', '.remove_item', function () {

        $(this).closest('tr').remove();

        // Update serial numbers
        $('#tbody tr').each(function (index) {
            $(this).find('td:first').contents().first()[0].textContent = (index + 1);
        });

        calculate();
    });


    // Main Calculation
    
function calculate() {

    var total_amount = 0;

    $('.product_id').each(function () {

        var product_id = $(this).val();
        var amount = parseFloat($('#amount' + product_id).val()) || 0;

        total_amount += amount;
    });

    var discount = parseFloat($('#discount').val()) || 0;
    var tax_percent = parseFloat($('#tax').val()) || 0;

    // Validation
    discount = Math.max(0, Math.min(discount, total_amount));
    tax_percent = Math.max(0, Math.min(tax_percent, 100));

    $('#discount').val(discount);
    $('#tax').val(tax_percent);

    // Amount after discount
    var after_discount = total_amount - discount;

    // Tax calculation
    var tax_amount = after_discount * (tax_percent / 100);

    // Net Payable
    var net_amount = after_discount + tax_amount;

    $('#total_amount').val(total_amount.toFixed(2));
    $('#tax_amount').val(tax_amount.toFixed(2));
    $('#net_amount').val(net_amount.toFixed(2));

    checkCreditLimit();
}


// Tax Percentage Change
$(document).on('input change', '#tax', function () {
    calculate();
});


// Discount Change
$(document).on('input change', '#discount', function () {

    var total = parseFloat($('#total_amount').val()) || 0;
    var discount = parseFloat($(this).val()) || 0;

    if (discount < 0) discount = 0;
    if (discount > total) discount = total;

    $(this).val(discount);

    calculate();
});



    // Discount Type Change
    $(document).on('change', 'input[name="discount_type"]', function () {

        if ($(this).val() == 'percentage') {

            $('#percentage_input').show();

        } else {

            $('#percentage_input').hide();
            $('#percentage_input').val('');
        }

        calculate();
    });


    // Percentage Discount
    $(document).on('input change', '#percentage_input', function () {

        var percentage = parseFloat($(this).val()) || 0;

        if (percentage > 100) {
            percentage = 100;
            $(this).val(100);
        }

        if (percentage < 0) {
            percentage = 0;
            $(this).val(0);
        }

        var total = parseFloat($('#total_amount').val()) || 0;

        var discount = total * (percentage / 100);

        $('#discount').val(discount.toFixed(2));

        calculate();
    });


    // Fixed Discount
    $(document).on('input change', '#discount', function () {

        var total = parseFloat($('#total_amount').val()) || 0;
        var discount = parseFloat($(this).val()) || 0;

        if (discount < 0) {
            discount = 0;
        }

        if (discount > total) {
            discount = total;
        }

        $(this).val(discount);

        calculate();
    });


    // Tax Change
    $(document).on('input change', '#tax', function () {

        var tax = parseFloat($(this).val()) || 0;

        if (tax < 0) {
            tax = 0;
            $(this).val(0);
        }

        calculate();
    });


    // Rate / Quantity Change
    $(document).on('input change', '.rate, .qty', function () {

        var product_id = $(this).data('id');

        var rate = parseFloat($('#rate' + product_id).val()) || 0;
        var qty = parseFloat($('#qty' + product_id).val()) || 0;

        $('#amount' + product_id).val((rate * qty).toFixed(2));

        calculate();
    });


    // Amount Change
    $(document).on('input change', '.amount', function () {

        var product_id = $(this).data('id');

        var amount = parseFloat($('#amount' + product_id).val()) || 0;
        var qty = parseFloat($('#qty' + product_id).val()) || 0;

        if (qty > 0) {
            $('#rate' + product_id).val((amount / qty).toFixed(2));
        }

        calculate();
    });


    // Sales By Change
    $(document).on('change', '#sales_by', function () {

        if ($(this).val() == 'barcode') {

            $('#barcode_qty').show();
            $('#manual_qty').hide();

        } else {

            $('#barcode_qty').hide();
            $('#manual_qty').show();
        }
    });


    // Barcode Scan
    $(document).on('keypress', '#code', function (e) {

        if (e.which != 13) {
            return;
        }

        e.preventDefault();

        var client_id = $("#client_id").val();

        if (!client_id) {
            showError("Please select a Client");
            return false;
        }

        var existing_key = $("#tbody tr").length;

        var formData = $('#store_form').serialize();

        formData += '&barcode=true&_method=GET';

        $.ajax({

            url: "{{ route('admin.sales.create') }}",
            type: "POST",
            data: formData,

            success: function (response) {

                if (response.status == 'error') {
                    showError(response.data);
                    return;
                }

                // Existing product quantity increment
                if (response.status == 'increment') {

                    $('#qty' + response.product_id).val(response.total_qty);

                    $('#amount' + response.product_id).val(response.amount);

                    calculate();

                    $('#code').val('').focus();

                    return;
                }

                // New product
                if (response.status == 'success') {

                    var product = response.product;

                    var tr = `
                        <tr id="product${product.id}">

                            <td class="text-center" width="30">
                                ${existing_key + 1}

                                <input type="hidden"
                                    class="product_id"
                                    id="product_id${product.id}"
                                    name="product_id[]"
                                    value="${product.id}">
                            </td>

                            <td>${product.code}</td>
                            <td>${product.name}</td>

                            <td>
                                <input type="number"
                                    style="min-width:100px;"
                                    class="form-control rate"
                                    placeholder="Rate"
                                    data-id="${product.id}"
                                    id="rate${product.id}"
                                    name="rate[${product.id}]"
                                    value="${response.price}">
                            </td>

                            <td>
                                <input type="number"
                                    style="min-width:100px;"
                                    class="form-control qty"
                                    placeholder="Quantity"
                                    step="any"
                                    data-id="${product.id}"
                                    id="qty${product.id}"
                                    name="qty[${product.id}]"
                                    value="1">
                            </td>

                            <td>
                                <input type="number"
                                    style="min-width:100px;"
                                    class="form-control amount"
                                    placeholder="Amount"
                                    data-id="${product.id}"
                                    id="amount${product.id}"
                                    name="amount[${product.id}]"
                                    value="${response.price}">
                            </td>

                            <td class="text-center">
                                <button type="button"
                                    class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>

                        </tr>
                    `;

                    $('#tbody').append(tr);

                    calculate();

                    $('#code').val('').focus();
                }
            },

            error: function () {
                showError("Barcode request failed!");
            }
        });

    });


    // Form Submit
    $(document).on('submit', '#store_form', function (e) {

        // Final calculation before submit
        calculate();

        $('.btn-spiner').show();

        $('.submit_btn').attr('disabled', true);

        // Allow normal form submission
    });


    // Company Project Load
    $('#company_id').on('change', function () {

        var companyId = $(this).val();

        var $project = $('#project_id');

        $project.empty()
            .append('<option value=""></option>')
            .prop('disabled', true);

        if (!companyId) {
            $project.trigger('change');
            return;
        }

        var url = "{{ route('admin.store.projects', ':id') }}"
            .replace(':id', companyId);

        $.get(url, function (projects) {

            $.each(projects, function (i, project) {

                var option = new Option(
                    project.name,
                    project.id,
                    false,
                    false
                );

                $project.append(option);
            });

            $project.prop('disabled', false).trigger('change');

        }).fail(function () {

            alert('Project load kora jayni');

        });

    });


    // Initial calculation
    calculate();

});

</script>

@endpush
