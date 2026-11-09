@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="lifting_type" class="form-label"><b>Lifting Type <span class="text-danger">*</span></b></label>
            <select name="lifting_type" id="lifting_type" class="select form-select" required>
                <option value="manual">By Manual</option>
                <option value="barcode">By Barcode</option>
            </select>
        </div>
        <div class="col-md-4 col-sm-6" id="payment_type_area">
            <label for="payment_type" class="form-label"><b>Payment Type <span class="text-danger">*</span></b></label>
            <select name="payment_type" id="payment_type" class="select form-select" data-placeholder="Payment Type"
                required>
                <option value="credit">Credit</option>
                <option value="cash">Cash</option>
            </select>
        </div>
        <div class="col-md-3 col-sm-6" id="accounts_area" style="display: none;">
            <label for="coa_setup_id" class="form-label"><b>Cash Account <span class="text-danger">*</span></b></label>
            <select name="coa_setup_id" id="coa_setup_id" class="select form-select" data-placeholder="Select Cash Account">
                <option value="">Select Cash Account</option>
                @foreach ($cash_heads as $cash_head)
                    <option value="{{ $cash_head->id }}">{{ $cash_head->head_name . ' - ' . $cash_head->head_code }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6" id="lifting_no_area">
            <label for="lifting_no" class="form-label"><b>Purchase No. <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="lifting_no" name="lifting_no" value="{{ $lifting_no }}"
                readonly placeholder="Purchase No." required>
        </div>
        <div class="col-md-4 col-sm-6" id="lifting_date_area">
            <label for="lifting_date" class="form-label"><b>Purchase Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="lifting_date" name="lifting_date"
                value="{{ old('lifting_date') ? date('d-m-Y', strtotime(old('lifting_date'))) : date('d-m-Y') }}"
                placeholder="Purchase Date" required>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="vendor_id" class="form-label"><b>Vendor <span class="text-danger">*</span></b></label>
            <select name="vendor_id" id="vendor_id" class="select form-select" data-placeholder="Select Vendor" required>
                <option value=""></option>
                @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                        {{ $vendor->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="voucher_no" class="form-label"><b>Voucher No.</b></label>
            <input type="text" class="form-control" id="voucher_no" name="voucher_no" value="{{ old('voucher_no') }}"
                placeholder="Voucher No.">
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Receive Store <span class="text-danger">*</span></b></label>
            <select name="store_id" id="store_id" class="select form-select" data-placeholder="Select Store" required>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                        {{ $store->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select id="product_id" class="select form-select" data-placeholder="Select Product">
                <option value=""></option>
                @foreach ($products as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->code }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-sm-6" id="lifting_type_trigger">
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
        <div class="col-md-2 col-sm-6" id="add_btn_area">
            <label class="form-label d-sm-block d-none"><b>Add Item</b></label>
            <button type="button" class="btn btn-xs btn-primary w-100 py-2" id="add_item">Add Product</button>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead class="bg-primary border-primary text-white text-nowrap">
                        <tr>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>Code</th>
                            <th width="150" class="text-center">Rate</th>
                            <th width="150" class="text-center">Quantity</th>
                            <th width="150" class="text-center">Amount</th>
                            <th class="text-center" width="50"><i class="far fa-trash-alt"></i></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                    <tfoot class="bg-primary text-white align-top border-primary">
                        <tr>
                            <td colspan="2">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="discount_type"
                                            id="fixed" checked value="fixed">
                                        <label class="form-check-label" for="fixed">
                                            Fix Discount
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="discount_type"
                                            id="percentage" value="percentage">
                                        <label class="form-check-label" for="percentage">
                                            Discount (%)
                                        </label>
                                    </div>
                                </div>
                                <input type="number" max="100" min="1" id="percentage_input"
                                    step="any" class="form-control" placeholder="Discount Percentage"
                                    style="display: none; max-width: 250px;">
                            </td>
                            <td colspan="2"></td>
                            <td colspan="3">
                                <div class="input-group flex-nowrap align-items-center">
                                    <b class="text-end me-2" style="width: 80px;">Total</b>
                                    <input type="number" id="total_cost" name="total_cost" readonly
                                        class="form-control" placeholder="Total Cost" style="min-width: 100px;"
                                        value="0">
                                    <span class="text-end" style="width: 25px;">TK.</span>
                                </div>
                                <div class="input-group flex-nowrap align-items-center">
                                    <b class="text-end me-2" style="width: 80px;">Discount</b>
                                    <input type="number" id="discount" name="discount" class="form-control"
                                        placeholder="Discount" style="min-width: 100px;" value="0">
                                    <span class="text-end" style="width: 25px;">TK.</span>
                                </div>
                                <div class="input-group flex-nowrap align-items-center">
                                    <b class="text-end me-2" style="width: 80px;">Net Payable</b>
                                    <input type="number" id="net_payable" name="net_payable" readonly
                                        class="form-control" placeholder="net Payable" style="min-width: 100px;"
                                        value="0">
                                    <span class="text-end" style="width: 25px;">TK.</span>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
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
            });

            $(document).on('click', '#add_item', function(e) {
                var product_id = $("#product_id").val();
                var quantity = $("#quantity").val();
                if ($('#product' + product_id).length) {
                    Swal.fire({
                        width: "22rem",
                        toast: true,
                        position: 'top-right',
                        text: "Product already added!",
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
                    return false;
                }

                if (product_id == '' || quantity == '') {
                    Swal.fire({
                        width: "22rem",
                        toast: true,
                        position: 'top-right',
                        text: "Please select a product",
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
                } else {
                    let qty = $('#quantity').val();
                    let url = "{{ Route('admin.lifting.create') }}";
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _method: 'GET',
                            get_product: true,
                            product_id: product_id,
                        },
                        success: (response) => {
                            if (response.status == 'success') {
                                var tr =
                                    `<tr id="product${product_id}">
                                        <td class="text-nowrap" width="150">${response.product.category.name}</td>
                                        <td>
                                            <input type="hidden" class="product_id" name="product_id[]" value="${product_id}">
                                            <span>${response.product.name}</span>
                                        </td>
                                        <td>${response.product.code}</td>
                                        <td><input style="width: 150px;" class="text-center rate" data-id="${product_id}" type="number" id="lifting_price_${product_id}" name="lifting_price[${product_id}]" step="any" value="${response.product.price.lifting_price}" required></td>
                                        <td><input style="width: 150px;" class="text-center qty" data-id="${product_id}" type="number" id="quantity_${product_id}" name="quantity[${product_id}]" step="any" value="${qty}" required></td>
                                        <td><input style="width: 150px;" class="text-center amount" data-id="${product_id}" type="number" id="amount_${product_id}" name="amount[${product_id}]" step="any" value="${qty * response.product.price.lifting_price}" required></td>
                                        <td class="text-center"><button type="button" class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i class="far fa-trash-alt"></i></button></td>
                                    </tr>`;
                                $('#tbody').append(tr);
                                calculate();
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.remove_item', function(e) {
                $(this).closest('tr').remove();
                calculate();
            });

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

                var total = +$("#total_cost").val();
                var fix_discount = Math.ceil(total * (discount / 100));
                $("#discount").val(fix_discount);
                $("#net_payable").val(total - fix_discount);
            });

            $(document).on('wheel keyup change', '#discount', function(e) {
                var total_amount = +$('#total_cost').val();
                var discount = +$(this).val();
                if (discount > total_amount) {
                    var discount = total_amount;
                    $(this).val(total_amount);
                }
                $('#net_payable').val(total_amount - discount);
            });

            $(document).on('wheel keyup change', '.amount', function(e) {
                var product_id = $(this).data('id');
                var qty = +$('#quantity_' + product_id).val();
                var amount = +$('#amount_' + product_id).val();
                $('#lifting_price_' + product_id).val(amount / qty);
                calculate();
            });

            $(document).on('wheel keyup change', '.rate, .qty', function(e) {
                var product_id = $(this).data('id');
                var rate = +$('#lifting_price_' + product_id).val();
                var qty = +$('#quantity_' + product_id).val();
                $('#amount_' + product_id).val(rate * qty);
                calculate();
            });


            $(document).on('change', '#payment_type', function(e) {
                if ($(this).val() == 'cash') {
                    @if (@$admin_setting->accounting == 1)
                        $('#payment_type_area').addClass('col-md-2').removeClass('col-md-4');
                        $('#lifting_no_area').addClass('col-md-3').removeClass('col-md-4');
                        $('#accounts_area').show();
                        $('#coa_setup_id').attr('required', true);
                    @endif
                } else {
                    $('#payment_type_area').addClass('col-md-4').removeClass('col-md-2');
                    $('#lifting_no_area').addClass('col-md-4').removeClass('col-md-3');
                    $('#accounts_area').hide();
                    $('#coa_setup_id').attr('required', false);
                }
            });

            $(document).on('change', '#lifting_type', function(e) {
                if ($(this).val() == 'barcode') {
                    $('#barcode_qty').show();
                    $('#manual_qty').hide();
                    $('#lifting_type_trigger').removeClass('col-md-2').addClass('col-md-4');
                    $('#add_btn_area').hide();
                } else {
                    $('#barcode_qty').hide();
                    $('#manual_qty').show();
                    $('#lifting_type_trigger').removeClass('col-md-4').addClass('col-md-2');
                    $('#add_btn_area').show();
                }
            });

            $(document).on('keypress', '#code', function(e) {
                if (e.which == 13) {
                    var formData = $('#store_form').serialize();
                    formData += '&_method=GET';
                    let url = "{{ Route('admin.lifting.create') }}";
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: formData,
                        success: (response) => {
                            if (response.status == 'error') {
                                Swal.fire({
                                    width: "22rem",
                                    toast: true,
                                    position: 'top-right',
                                    text: response.data,
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
                            }
                            if (response.status == 'increment') {
                                $('#quantity_' + response.product_id).val(response.total_qty);
                                $('#amount_' + response.product_id).val(response.amount);
                                calculate();
                            }
                            if (response.status == 'success') {
                                var tr =
                                    `<tr>
                                        <td class="text-nowrap" width="150">${response.product.category.name}</td>
                                        <td>
                                            <input type="hidden" class="product_id" name="product_id[]" value="${response.product.id}">
                                            <span>${response.product.name}</span>
                                        </td>
                                        <td>${response.product.code}</td>
                                        <td><input style="width: 150px;" class="text-center rate" data-id="${response.product.id}" type="number" id="lifting_price_${response.product.id}" name="lifting_price[${response.product.id}]" step="any" value="${response.price}" required></td>
                                        <td><input style="width: 150px;" class="text-center qty" data-id="${response.product.id}" type="number" id="quantity_${response.product.id}" name="quantity[${response.product.id}]" step="any" value="1" required></td>
                                        <td><input style="width: 150px;" class="text-center amount" data-id="${response.product.id}" type="number" id="amount_${response.product.id}" name="amount[${response.product.id}]" step="any" value="${response.price}" required></td>
                                        <td class="text-center"><button type="button" class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i class="far fa-trash-alt"></i></button></td>
                                    </tr>`;
                                $('#tbody').append(tr);
                                calculate();
                            }
                            $('#code').val('');
                        }
                    });
                    e.preventDefault();
                }
            });

            function calculate() {
                var total_amount = 0;
                $('.product_id').each(function(index, value) {
                    var product_id = $(this).val();
                    var amount = +$('#amount_' + product_id).val();
                    total_amount += amount;
                });
                var discount = +$('#discount').val();
                var net_payable = total_amount - discount;
                $('#total_cost').val(total_amount);
                $('#net_payable').val(net_payable);
            }
        });
    </script>
@endpush
