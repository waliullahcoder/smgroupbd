@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3 align-items-center">
        <div class="col-lg-3 col-sm-6" id="product_area" style="display: none;">
            <label for="add_product_id" class="form-label"><b>Products</b></label>
            <select id="add_product_id" class="select form-select" data-placeholder="Select Product">
                <option value=""></option>
                @foreach ($products as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->code }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-sm-6" id="barcode_area">
            <label for="barcode" class="form-label"><b>Scan Barcode</b></label>
            <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode">
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="client_phone" class="form-label"><b>Client Phone</b></label>
            <div class="name__wrapper">
                <input type="number" name="client_phone" id="client_phone" class="form-control" placeholder="017XXXXXXXX"
                    value="{{ old('client_phone', @$returnData->client_phone) }}">
                <div class="name__dropdown" id="name__dropdown">
                    <ul class="client_list" id="client_list"></ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="client_name" class="form-label"><b>Client Name</b></label>
            <input type="text" name="client_name" id="client_name" class="form-control" placeholder="Client Name"
                value="{{ old('client_name', @$returnData->client_name) }}">
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="coa_setup_id" class="form-label"><b>Cash Head <span class="text-danger">*</span></b></label>
            <select name="coa_setup_id" id="coa_setup_id" class="form-select select" data-placeholder="Select Cash Head"
                required>
                @foreach ($cash_heads as $item)
                    <option value="{{ $item->id }}" {{ old('coa_setup_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->head_name }} - {{ $item->head_code }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 text-end" id="addButtonArea" style="display: none;">
            <button type="button" class="btn btn-xs btn-primary" id="addButton">Add Table</button>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped target-table align-middle mb-0">
                    <thead class="bg-primary border-primary text-white">
                        <tr>
                            <th class="text-center" width="30">SL#</th>
                            <th>name</th>
                            <th>Rate</th>
                            <th>Discount</th>
                            <th>Qty</th>
                            <th>UOM</th>
                            <th>Available Stock</th>
                            <th width="150">Amount</th>
                            <th class="text-center" width="50"><i class="far fa-trash-alt"></i></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                    <tfoot class="bg-primary text-white align-top border-primary">
                        <tr>
                            <td colspan="4">
                                <div class="d-flex flex-wrap">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="discount_type" id="fixed"
                                            checked value="fixed">
                                        <label class="form-check-label" for="fixed">
                                            <b>Fix Discount</b>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="discount_type" id="percentage"
                                            value="percentage">
                                        <label class="form-check-label" for="percentage">
                                            <b>Discount (%)</b>
                                        </label>
                                    </div>
                                </div>
                                <input type="number" max="100" min="1" id="percentage_input"
                                    class="form-control" placeholder="Discount Percentage"
                                    style="display: none; max-width: 190px;">
                            </td>
                            <td colspan="3">
                                <div class="input-group align-items-center justify-content-end text-end"
                                    style="height: 26px;">
                                    <b style="width: 100px;">Total</b>
                                </div>
                                <div class="input-group align-items-center justify-content-end text-end"
                                    style="height: 26px;">
                                    <b style="width: 100px;">Discount</b>
                                </div>
                                @if ($returnData)
                                    <div class="input-group align-items-center justify-content-end text-end"
                                        style="height: 26px;">
                                        <b style="width: 100px;">Return Amount</b>
                                    </div>
                                @endif
                                <div class="input-group align-items-center justify-content-end text-end"
                                    style="height: 26px;">
                                    <b style="width: 100px;">Net Payable</b>
                                </div>
                                <div class="input-group align-items-center justify-content-end text-end"
                                    style="height: 26px;">
                                    <b style="width: 100px;">Cash Paid</b>
                                </div>
                                <div class="input-group align-items-center justify-content-end text-end"
                                    style="height: 26px;">
                                    <b style="width: 100px;">Change Amount</b>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="input-group align-items-center flex-nowrap">
                                    <input type="number" id="total_amount" name="total_amount"
                                        class="form-control me-1" readonly placeholder="Total Cost" value="0"
                                        style="min-width: 100px;">
                                    <b class="text-center" style="width: 25px;">TK.</b>
                                </div>
                                <div class="input-group align-items-center flex-nowrap">
                                    <input type="number" id="discount" name="discount" class="form-control me-1"
                                        placeholder="Discount" value="0" style="min-width: 100px;">
                                    <b class="text-center" style="width: 25px;">TK.</b>
                                </div>
                                @if ($returnData)
                                    <input type="hidden" name="retail_return_id" value="{{ $returnData->id }}">
                                    <div class="input-group align-items-center flex-nowrap">
                                        <input type="number" id="return_deduction" name="return_deduction"
                                            class="form-control me-1" placeholder="Return Amount"
                                            value="{{ $returnData->amount }}" style="min-width: 100px;" readonly>
                                        <b class="text-center" style="width: 25px;">TK.</b>
                                    </div>
                                @endif
                                <div class="input-group align-items-center flex-nowrap">
                                    <input type="number" id="net_payable" name="net_payable" class="form-control me-1"
                                        readonly placeholder="net Payable" value="0" style="min-width: 100px;">
                                    <b class="text-center" style="width: 25px;">TK.</b>
                                </div>
                                <div class="input-group align-items-center flex-nowrap">
                                    <input type="number" id="receive_amount" name="receive_amount"
                                        class="form-control me-1" placeholder="Cash Paid" value="0"
                                        style="min-width: 100px;">
                                    <b class="text-center" style="width: 25px;">TK.</b>
                                </div>
                                <div class="input-group align-items-center flex-nowrap">
                                    <input type="number" id="change_amount" name="change_amount"
                                        class="form-control me-1" readonly placeholder="Change Amount" value="0"
                                        style="min-width: 100px;">
                                    <b class="text-center" style="width: 25px;">TK.</b>
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
            $(document).on('change', '.sale_type', function(e) {
                var sale_type = $('.sale_type:checked').val();
                if (sale_type == 'manual') {
                    $('#product_area').show();
                    $('#addButtonArea').show();
                    $('#barcode_area').hide();
                } else {
                    $('#product_area').hide();
                    $('#addButtonArea').hide();
                    $('#barcode_area').show();
                }
            });

            $(document).on('click', '#addButton', function(e) {
                var product_id = $("#add_product_id").val();
                if (product_id == '') {
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
                    return false;
                }
                var formData = $('#store_form').serialize();
                formData += '&_method=GET&add_product_id=' + product_id;
                var existing_key = $("#tbody tr").length;
                let url = "{{ Route('admin.running-sales.create') }}";
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
                            $('#qty_' + response.product_id).val(response.total_qty);
                            $('#available_stock_' + response.product_id).val(response
                                .stock - response.total_qty);
                            $('#amount_' + response.product_id).val(response.amount);
                            calculate();
                        }
                        if (response.status == 'success') {
                            var tr =
                                `<tr>
                                    <td class="text-center" width="30">
                                        <b class="serial">${(existing_key+1)}</b>
                                        <input type="hidden" class="product_id" name="product_id[]" value="${response.product.id}">
                                    </td>
                                    <td class="text-nowrap">${response.product.name}</td>
                                    <td><input type="number" class="form-control rate" placeholder="Rate" id="rate_${response.product.id}" name="rate[${response.product.id}]" value="${response.product.price.online_price}" readonly></td>
                                    <td><input type="number" class="form-control discount" placeholder="Discount" id="discount_${response.product.id}" name="product_discount[${response.product.id}]" value="${response.product.price.discount_tk}" readonly></td>
                                    <td><input type="number" class="form-control qty" placeholder="Quantity" data-id="${response.product.id}" id="qty_${response.product.id}" name="qty[${response.product.id}]" value="1" step="any" max="${response.stock}"></td>
                                    <td><input type="text" class="form-control" value="${response.product.attribute.name}" readonly></td>
                                    <td><input type="number" class="form-control available_stock" placeholder="Available Stock" id="available_stock_${response.product.id}" value="${response.stock - 1}" step="any" readonly></td>
                                    <td><input type="number" class="form-control amount" placeholder="Amount" id="amount_${response.product.id}" name="amount[${response.product.id }]" readonly value="${response.price}"></td>
                                    <td class="text-center"><button type="button" class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i class="far fa-trash-alt"></i></button></td>
                                </tr>`;
                            $('#tbody').append(tr);
                            $("#add_product_id").val('');
                            $("#add_product_id").select2({
                                allowClear: true
                            });
                            calculate();
                        }
                    }
                });

            });

            $('#barcode').focus();
            $(document).on('keypress', '#barcode', function(e) {
                if (e.which == 13) {
                    var formData = $('#store_form').serialize();
                    formData += '&_method=GET';
                    var existing_key = $("#tbody tr").length;
                    let url = "{{ Route('admin.running-sales.create') }}";
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
                                $('#qty_' + response.product_id).val(response.total_qty);
                                $('#available_stock_' + response.product_id).val(response
                                    .stock - response.total_qty);
                                $('#amount_' + response.product_id).val(response.amount);
                                calculate();
                            }
                            if (response.status == 'success') {
                                var tr =
                                    `<tr>
                                        <td class="text-center" width="30">
                                            <b class="serial">${(existing_key+1)}</b>
                                            <input type="hidden" class="product_id" name="product_id[]" value="${response.product.id}">
                                        </td>
                                        <td class="text-nowrap">${response.product.name}</td>
                                        <td><input type="number" class="form-control rate" placeholder="Rate" id="rate_${response.product.id}" name="rate[${response.product.id}]" value="${response.product.price.online_price}" readonly></td>
                                        <td><input type="number" class="form-control discount" placeholder="Discount" id="discount_${response.product.id}" name="product_discount[${response.product.id}]" value="${response.product.price.discount_tk}" readonly></td>
                                        <td><input type="number" class="form-control qty" placeholder="Quantity" data-id="${response.product.id}" id="qty_${response.product.id}" name="qty[${response.product.id}]" value="1" step="any" max="${response.stock}"></td>
                                        <td><input type="text" class="form-control" value="${response.product.attribute.name}" readonly></td>
                                        <td><input type="number" class="form-control available_stock" placeholder="Available Stock" id="available_stock_${response.product.id}" value="${response.stock - 1}" step="any" readonly></td>
                                        <td><input type="number" class="form-control amount" placeholder="Amount" id="amount_${response.product.id}" name="amount[${response.product.id }]" readonly value="${response.price}"></td>
                                        <td class="text-center"><button type="button" class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i class="far fa-trash-alt"></i></button></td>
                                    </tr>`;
                                $('#tbody').append(tr);
                                calculate();
                            }
                            $('#barcode').val('');
                        }
                    });
                    e.preventDefault();
                }
            });

            $(document).on('keyup', '#client_phone', function(e) {
                var string = $(this).val();
                if (string == '') {
                    $('#name__dropdown').hide();
                    return false;
                }
                let url = "{{ Route('admin.running-sales.create') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        string: string,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            var list = '';
                            $.each(response.phones, function(key, value) {
                                list +=
                                    `<li class="client_list__item">${value}</li>`;
                            });
                            $('#client_list li').remove();
                            $('#client_list').append(list);
                            if (response.phones.length > 0) {
                                $('#name__dropdown').show();
                            } else {
                                $('#name__dropdown').hide();
                            }
                        }
                    }
                });
            });

            $(document).on('click', '.client_list__item', function(e) {
                var phone = $(this).text();
                $('#client_list li').remove();
                $('#name__dropdown').hide();
                $('#client_phone').val(phone);
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

            $(document).on('wheel keyup change', '#receive_amount', function(event) {
                var receive_amount = +$(this).val();
                var net_payable = +$('#net_payable').val();
                $('#change_amount').val(Math.round(receive_amount - net_payable));
            });

            $(document).on('wheel keyup change', '#percentage_input', function(event) {
                var discount = +$(this).val();
                if (discount > 100) {
                    $(this).val(100);
                    var discount = 100;
                }

                var total = +$("#total_amount").val();
                var fix_discount = total * (discount / 100);
                $("#discount").val(Math.floor(fix_discount));
                var return_deduction = 0;
                if ($('#return_deduction').length) {
                    return_deduction = +$('#return_deduction').val();
                }
                $("#net_payable").val(total - Math.floor(fix_discount) - return_deduction);
            });

            $(document).on('wheel keyup change', '#discount', function(e) {
                var total_amount = +$('#total_amount').val();
                var discount = +$(this).val();
                var return_deduction = 0;
                if ($('#return_deduction').length) {
                    return_deduction = +$('#return_deduction').val();
                }

                $('#net_payable').val(total_amount - discount - return_deduction);
            });

            $(document).on('wheel keyup change', '.qty', function(e) {
                var product_id = +$(this).data('id');
                var qty = +$(this).val();
                var max = +$(this).attr('max');
                if (qty > max) {
                    Swal.fire({
                        width: "22rem",
                        toast: true,
                        position: 'top-right',
                        text: 'Qty exceeded stock!',
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
                    qty = max;
                    $(this).val(max);
                }
                var rate = +$('#rate_' + product_id).val();
                var discount = +$('#discount_' + product_id).val();
                $('#amount_' + product_id).val((rate - discount) * qty);
                $('#available_stock_' + product_id).val(max - qty);
                calculate();
            });

            function calculate() {
                var total_amount = 0;
                $('.product_id').each(function(index, value) {
                    total_amount += +$('#amount_' + $(this).val()).val();
                });
                $('#total_amount').val(total_amount);

                var return_deduction = 0;
                if ($('#return_deduction').length) {
                    return_deduction = +$('#return_deduction').val();
                }

                let discount_type = $('input[name="discount_type"]:checked').val();
                if (discount_type == 'percentage') {
                    var discount = +$('#percentage_input').val();
                    var fix_discount = total_amount * (discount / 100);
                    $("#discount").val(Math.floor(fix_discount));
                    var net_payable = Math.round(total_amount - Math.floor(fix_discount) - return_deduction);
                    $("#net_payable").val(net_payable);
                } else {
                    var discount = +$('#discount').val();
                    var net_payable = Math.round(total_amount - discount - return_deduction);
                    $('#total_amount').val(total_amount);
                    $('#net_payable').val(net_payable);
                }
            }

            $(document).on('submit', '#store_form', function(e) {
                e.preventDefault();
                var net_payable = +$('#net_payable').val();
                var receive_amount = +$('#receive_amount').val();
                var change_amount = +$('#change_amount').val();
                if (receive_amount < net_payable) {
                    Swal.fire({
                        width: "26rem",
                        toast: true,
                        position: 'top-right',
                        text: 'Receive amount must be equal of net payable!',
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
                if (change_amount < 0) {
                    Swal.fire({
                        width: "22rem",
                        toast: true,
                        position: 'top-right',
                        text: 'Paid must be greater than or equal net payable!',
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
                $('.submit_btn').attr('disabled', true);
                $('#store_form')[0].submit();
                @if (@$target_blank)
                    window.location.href = window.location.pathname;
                @endif
            });
        });
    </script>
@endpush
