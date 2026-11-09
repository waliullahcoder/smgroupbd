@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3 align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="client_phone" class="form-label"><b>Client Phone</b></label>
            <input type="number" name="client_phone" id="client_phone" class="form-control" placeholder="Client Phone"
                value="{{ @$data->client->phone }}" required>
            <input type="hidden" name="client_id" id="client_id" value="{{ $data->client_id }}">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="client_name" class="form-label"><b>Client Name</b></label>
            <input type="text" name="client_name" id="client_name" class="form-control" placeholder="Client Name"
                value="{{ @$data->client->name }}" required>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="invoice" class="form-label"><b>Invoice No.</b></label>
            <input type="text" class="form-control" id="invoice" name="invoice" value="{{ $data->invoice }}" readonly
                required placeholder="Invoice No.">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="date" class="form-label"><b>Invoice Date</b></label>
            <input type="text" class="form-control date_picker" id="date" name="date" required
                value="{{ date('d-m-Y', strtotime($data->date)) }}" placeholder="Invoice Date">
        </div>
        <div class="col-md-6 col-sm-6" id="post_product">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select id="product_id" class="select form-select" data-placeholder="Select Product">
                <option value="">Select Product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->code }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-sm-6">
            <label for="quantity" class="form-label"><b>Quantity</b></label>
            <input type="number" class="form-control" id="quantity" name="quantity" step="any" placeholder="Quantity"
                value="1">
        </div>
        <div class="col-md-2 col-sm-6">
            <label for="stock" class="form-label"><b>Stock</b></label>
            <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" step="any"
                readonly value="0">
        </div>
        <div class="col-md-2 col-sm-6">
            <label class="form-label text-white"><b>Add</b></label>
            <button type="button" class="btn btn-xs btn-primary w-100 px-2 py-2" id="add_item">Add Product</button>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped target-table align-middle mb-0">
                    <thead class="bg-primary border-primary text-white">
                        <tr>
                            <th class="text-center" width="30">SL#</th>
                            <th class="text-nowrap">Vendor Name</th>
                            <th class="text-nowrap">Product Code</th>
                            <th class="text-nowrap">Product name</th>
                            <th width="100">Rate</th>
                            <th width="100" class="text-nowrap">Order Qty</th>
                            <th width="100">Unit</th>
                            <th width="200">Amount</th>
                            <th class="text-center" width="50"><i class="far fa-trash-alt"></i></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($data->list as $key => $item)
                            <tr>
                                <td class="text-center" width="30">
                                    <b class="serial">{{ $key + 1 }}</b>
                                    <input type="hidden" name="product_id[]" class="product_id{{ $item->product_id }}"
                                        value="{{ $item->product_id }}">
                                </td>
                                <td>{{ @$item->product->vendor->name }}</td>
                                <td>{{ @$item->product->code }}</td>
                                <td>{{ @$item->product->name }}</td>
                                <td>
                                    <input type="number" style="width: 100px;" class="form-control rate"
                                        placeholder="Rate" name="rate[]" readonly value="{{ $item->rate }}">
                                </td>
                                <td>
                                    <input type="number" style="width: 100px;" class="form-control qty"
                                        placeholder="Quantity" name="qty[]" readonly value="{{ $item->qty }}">
                                </td>
                                <td>
                                    <input type="text" style="width: 100px;" class="form-control unit"
                                        placeholder="Unit" readonly value="{{ $item->product->attribute->name }}">
                                </td>
                                <td>
                                    <input type="number" style="width: 200px;" class="form-control amount"
                                        placeholder="Amount" name="amount[]" readonly value="{{ $item->amount }}">
                                </td>
                                <td class="text-center"><button type="button"
                                        class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i
                                            class="far fa-trash-alt"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-primary text-white align-top border-primary">
                        <tr>
                            <td class="px-3" colspan="3">
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
                            </td>
                            <td colspan="2">
                                <input type="hidden" name="total_price" id="total_price" value="0">
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
                                <input type="hidden" name="total_price" id="total_price" value="0">
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

            $(document).on('change', '#store_id', function(e) {
                $('#tbody tr').remove();
                calculate();
            });

            $(document).on('keyup', '#client_phone', function(e) {
                let url = "{{ Route('admin.running-sales.edit', $data->id) }}";
                let phone = $(this).val();
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        check_client: true,
                        phone: phone,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#client_name').val(response.client_name);
                            $('#client_id').val(response.client_id);
                        }
                    }
                });
            });

            $(document).on('change', '#product_id', function(e) {
                var product_id = $(this).val();
                if (product_id == '') {
                    $('#stock').val(0);
                    return;
                }

                let url = "{{ Route('admin.running-sales.edit', $data->id) }}";
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
                            $('#stock').val(response.stock);
                        }
                    }
                });
            });

            $(document).on('click', '#add_item', function(e) {
                var product_id = $("#product_id").val();
                var store_id = $("#store_id").val();
                var quantity = $("#quantity").val();
                var existing_key = $("#tbody tr").length;

                if ($('.product_id' + product_id).length) {
                    Swal.fire({
                        width: "22rem",
                        position: 'top-right',
                        toast: true,
                        text: "Product Already Added!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }
                if (product_id == '') {
                    Swal.fire({
                        width: "22rem",
                        position: 'top-right',
                        toast: true,
                        text: "Please select a Product",
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

                let qty = $('#quantity').val();
                let url = "{{ Route('admin.running-sales.edit', $data->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_stock: true,
                        product_id: product_id,
                        quantity: quantity,
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
                                `<tr>
                                    <td class="text-center" width="30">
                                        <b class="serial">${ ( existing_key + 1 )}</b>
                                        <input type="hidden" class="product_id${ response.product.id }" name="product_id[]" value="${ response.product.id }">
                                        <input type="hidden" name="order_product_id[]" value="${ (response.order_product_id ? response.order_product_id : '') }">
                                    </td>
                                    <td>${ response.vendor }</td>
                                    <td>${ response.product.code }</td>
                                    <td>${ response.product.name }</td>
                                    <td><input type="number" style="width: 100px;" class="form-control rate" placeholder="Rate" name="rate[]" readonly value="${ response.price }"></td>
                                    <td><input type="number" style="width: 100px;" class="form-control qty" placeholder="Quantity" name="qty[]" readonly  value="${ response.quantity }"></td>
                                    <td><input type="text" style="width: 100px;" class="form-control unit" placeholder="Unit" readonly value="${ response.unit }"></td>
                                    <td><input type="number" style="width: 200px;" class="form-control amount" placeholder="Amount" name="amount[]" readonly value="${ response.amount }"></td>
                                    <td class="text-center"><button type="button" class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i class="far fa-trash-alt"></i></button></td>
                                </tr>`;
                            $('#tbody').append(tr);
                            $('#product_id option[value=' + product_id + ']').remove();
                            $('#product_id').val('');
                            calculate();
                        }
                    }
                });
            });

            $(document).on('click', '.remove_item', function(e) {
                $(this).closest('tr').remove();
                calculate();
                let vendor_id = $('#vendor_id').val();
                var selected_product_ids = [];
                $('input[name="product_id[]"]').each(function(index, value) {
                    selected_product_ids.push($(value).val());
                });
                let url = "{{ Route('admin.running-sales.edit', $data->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_products: true,
                        vendor_id: vendor_id,
                        selected_product_ids: selected_product_ids,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#product_id option').remove();
                            $('#product_id').append('<option value=""></option>');
                            $.each(response.products, function(key, value) {
                                var option =
                                    `<option value="${value.id}">${value.name}(${value.code})</option>`;
                                $('#product_id').append(option);
                            });
                        }
                    }
                });
            });

            function calculate() {
                var total_amount = 0;
                $('.serial').each(function(index, value) {
                    $(value).text(index + 1);
                    var amount = $('input[name="amount[]"]')[index];
                    var amount_val = $(amount).val();
                    total_amount += parseFloat(amount_val);
                });
                $('#total_amount').val(total_amount);
                var discount = $('#discount').val();
                var net_payable = total_amount - parseFloat(discount);
                $('#total_amount').val(total_amount);
                $('#net_payable').val(net_payable);
                var payable = $('#net_payable').val();
            }

            $(document).on('change', 'input[name="discount_type"]', function(e) {
                if ($(this).val() == 'percentage') {
                    $('#percentage_input').show();
                } else {
                    $('#percentage_input').hide();
                }
                var payable = $('#net_payable').val();
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
            });

            $(document).on('wheel keyup change', '#discount', function(e) {
                var total_amount = parseFloat($('#total_amount').val());
                var discount = parseFloat($(this).val());
                $('#net_payable').val(total_amount - discount);
            });

            $(document).on('click', '.submit_btn', function(e) {
                $('.btn-spiner').show();
                $('.submit_btn').attr('disabled', true);
            });
        });
    </script>
@endpush
