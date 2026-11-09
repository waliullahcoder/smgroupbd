@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-3 col-sm-6">
            <label for="order_no" class="form-label"><b>Order No. <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="order_no" name="order_no" value="{{ $order_no }}" readonly
                placeholder="Order No." required>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="date" class="form-label"><b>Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="date" name="date"
                value="{{ old('date') ? date('d-m-Y', strtotime(old('date'))) : date('d-m-Y') }}" placeholder="Date"
                required>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="potential_delivery_date" class="form-label"><b>Delivery Date <span
                        class="text-danger">*</span></b></label>
            @php
                $delivery_date = new DateTime();
                $delivery_date->modify('+72 hours');
            @endphp
            <input type="text" class="form-control date_picker" id="potential_delivery_date"
                name="potential_delivery_date"
                value="{{ old('potential_delivery_date') ? date('d-m-Y', strtotime(old('potential_delivery_date'))) : $delivery_date->format('d-m-Y') }}"
                placeholder="Potential Delivery Date" required>
        </div>
        @if (Auth::user()->hasRole('System Admin') || Auth::user()->hasRole('Software Admin'))
            <div class="col-lg-3 col-sm-6">
                <label for="created_by" class="form-label"><b>Staff <span class="text-danger">*</span></b></label>
                <select name="created_by" id="created_by" class="select form-select" data-placeholder="Select Staff"
                    required>
                    @php
                        $users = \App\Models\User::where('role', 1)
                            ->whereHas('roles', function ($q) {
                                $q->where('name', 'Moderator');
                            })
                            ->orderBy('name', 'asc')
                            ->get();
                    @endphp
                    <option value=""></option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ old('created_by') && old('created_by') == $user->id ? 'selected' : '' }}>{{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @else
            <div class="col-lg-3 col-sm-6">
                <label for="created_by" class="form-label"><b>Staff</b></label>
                <input type="text" class="form-control" id="created_by" value="{{ Auth::user()->name }}"
                    placeholder="Staff" readonly>
            </div>
        @endif
        <div class="col-md-3 col-sm-6">
            <label for="user_phone" class="form-label"><b>Customer Phone <span class="text-danger">*</span></b></label>
            <input type="number" class="form-control" id="user_phone" name="user_phone" placeholder="Customer Phone"
                required>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="user_name" class="form-label"><b>Customer Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Customer Name" required>
        </div>
        <div class="col-md-6 col-sm-6">
            <label for="shipping_address" class="form-label"><b>Shipping Address <span
                        class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="shipping_address" name="shipping_address"
                value="{{ old('shipping_address') }}" placeholder="Shipping Address" required>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="area_id" class="form-label"><b>Area <span class="text-danger">*</span></b></label>
            <select name="area_id" id="area_id" class="select form-select" data-placeholder="Select Area" required>
                <option value=""></option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" data-shipping="{{ $area->shipping_charge }}"
                        {{ old('area_id') && old('area_id') == $area->id ? 'selected' : '' }}>{{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-9 col-sm-6">
            <label for="order_note" class="form-label"><b>Remarks</b></label>
            <input type="text" class="form-control" id="order_note" name="order_note" value="{{ old('order_note') }}"
                placeholder="Remarks">
        </div>
        <div class="col-sm-6">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select id="product_id" class="select form-select" data-placeholder="Select Product">
                <option value=""></option>
                @foreach ($products as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-sm-6">
            <label for="stock" class="form-label"><b>Stock</b></label>
            <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock"
                step="any" readonly value="0">
        </div>
        <div class="col-md-2 col-6">
            <label for="quantity" class="form-label"><b>Quantity</b></label>
            <input type="number" class="form-control" id="quantity" step="any" value="1"
                placeholder="Quantity">
        </div>
        <div class="col-md-2 col-6">
            <label class="form-label"><b>Add Item</b></label>
            <button type="button" class="btn btn-xs btn-primary w-100 py-2" id="add_item">Add Product</button>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped target-table align-middle mb-0">
                    <thead class="bg-primary border-primary text-white">
                        <tr>
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
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="discount_type" id="fixed"
                                        checked value="fixed">
                                    <label class="form-check-label" for="fixed">
                                        Fix Discount
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="discount_type" id="percentage"
                                        value="percentage">
                                    <label class="form-check-label" for="percentage">
                                        Discount (%)
                                    </label>
                                </div>
                                <input type="number" max="100" min="1" id="percentage_input"
                                    step="any" class="form-control mt-2" placeholder="Discount Percentage"
                                    style="display: none; max-width: 250px;">
                            </td>
                            <td colspan="4">
                                <div class="input-group align-items-center mb-2">
                                    <span style="width: 150px;">Total</span>
                                    <input type="number" id="total_amount" name="total_amount" readonly
                                        class="form-control" placeholder="Total Cost" value="0">
                                    <span class="text-center" style="width: 40px;">TK.</span>
                                </div>
                                <div class="input-group align-items-center mb-2">
                                    <span style="width: 150px;">Shipping Charge</span>
                                    <input type="number" id="shipping_charge" name="shipping_charge"
                                        class="form-control" value="">
                                    <span class="text-center" style="width: 40px;">TK.</span>
                                </div>
                                <div class="input-group align-items-center mb-2">
                                    <span style="width: 150px;">Discount</span>
                                    <input type="number" id="discount" name="discount" class="form-control"
                                        placeholder="Discount" value="0">
                                    <span class="text-center" style="width: 40px;">TK.</span>
                                </div>
                                <div class="input-group align-items-center">
                                    <span style="width: 150px;">Net Payable</span>
                                    <input type="number" id="net_payable" name="net_payable" readonly
                                        class="form-control" placeholder="net Payable" value="0">
                                    <span class="text-center" style="width: 40px;">TK.</span>
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

            $(document).on('change', '#area_id', function(e) {
                let shipping_charge = $('#area_id option:selected').data('shipping');
                $('#shipping_charge').val(shipping_charge);

                var total_amount = 0;
                $('.rate').each(function(index, value) {
                    var rate = +$(value).val();
                    var qty = +$($('.qty')[index]).val();
                    var total = rate * qty;
                    $($('.amount')[index]).val(total);
                    total_amount += total;
                });
                var discount = +$('#discount').val();
                var net_payable = total_amount - discount + shipping_charge;
                $('#total_amount').val(total_amount);
                $('#net_payable').val(net_payable);
            });

            $(document).on('keyup', '#user_phone', function(e) {
                let user_phone = $(this).val();
                $('#user_name').val('');
                $('#shipping_address').val('');
                let url = "{{ Route('admin.order.create') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        user_phone: user_phone,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#user_name').val(response.user_name);
                            $('#shipping_address').val(response.shipping_address);
                        }
                    }
                });
            });

            $(document).on('change', '#product_id', function(e) {
                var store_id = $("#store_id").val();
                var product_id = $(this).val();
                if (product_id == '') {
                    $('#stock').val(0);
                    return;
                }

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
                    $('#product_id').val('');
                    return;
                }

                let url = "{{ Route('admin.order.create') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_product: true,
                        store_id: store_id,
                        product_id: product_id,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#quantity').val(0);
                            $('#stock').val(response.stock);
                        }
                    }
                });
            });

            $(document).on('click', '#add_item', function(e) {
                var product_id = $("#product_id").val();
                var quantity = $("#quantity").val();
                var store_id = $("#store_id").val();
                var existing_key = $("#tbody tr").length;

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
                    $('#product_id').val('');
                    return;
                }

                if ($('.product_id' + product_id).length) {
                    Swal.fire({
                        width: "22rem",
                        toast: true,
                        position: 'top-right',
                        text: "Product already added!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }

                if (product_id == '' || quantity == '' || quantity == '0') {
                    Swal.fire({
                        width: "22rem",
                        toast: true,
                        position: 'top-right',
                        text: "Please select a product",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    let url = "{{ Route('admin.order.create') }}";
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _method: 'GET',
                            get_stock: true,
                            store_id: store_id,
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
                                        <td class="px-3">
                                            <input type="hidden" class="product_id${product_id}" name="product_id[${existing_key}]" value="${product_id}">
                                            <span>${response.product.name}</span>
                                        </td>
                                        <td class="px-3">${response.product.code}</td>
                                        <td><input style="width: 150px;" class="text-center rate" type="number" name="price[${existing_key}]" step="any" value="${response.price}" required></td>
                                        <td><input style="width: 150px;" class="text-center qty" type="number" name="quantity[${existing_key}]" step="any" value="${response.quantity}" required></td>
                                        <td><input style="width: 150px;" class="text-center amount" type="number" name="amount[${existing_key}]" step="any" value="${response.amount}" required></td>
                                        <td class="text-center"><button type="button" class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i class="far fa-trash-alt"></i></button></td>
                                    </tr>`;
                                $('#tbody').append(tr);

                                var total_amount = 0;
                                $('.rate').each(function(index, value) {
                                    var rate = +$(value).val();
                                    var qty = +$($('.qty')[index]).val();
                                    var total = rate * qty;
                                    $($('.amount')[index]).val(total);
                                    total_amount += total;
                                });
                                var discount = +$('#discount').val();
                                var shipping_charge = +$('#shipping_charge').val();
                                var net_payable = total_amount - discount + shipping_charge;
                                $('#total_amount').val(total_amount);
                                $('#net_payable').val(net_payable);
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.remove_item', function(e) {
                $(this).closest('tr').remove();
                var total_amount = 0;
                $('.rate').each(function(index, value) {
                    var rate = +$(value).val();
                    var qty = +$($('.qty')[index]).val();
                    var total = rate * qty;
                    $($('.amount')[index]).val(total);
                    total_amount += total;
                });
                var discount = +$('#discount').val();
                var shipping_charge = +$('#shipping_charge').val();
                var net_payable = total_amount - discount + shipping_charge;
                $('#total_amount').val(total_amount);
                $('#net_payable').val(net_payable);
            });

            $(document).on('change', 'input[name="discount_type"]', function(e) {
                if ($(this).val() == 'percentage') {
                    $('#percentage_input').show();
                } else {
                    $('#percentage_input').hide();
                }
            });

            $('#percentage_input').on('wheel keyup change', function(event) {
                var discount = $(this).val();
                if (discount > 100) {
                    $(this).val(100);
                    var discount = 100;
                }

                var total = $("#total_amount").val();
                var fix_discount = Math.ceil(total * (discount / 100));
                $("#discount").val(fix_discount);
                $("#net_payable").val(total - fix_discount);
            });

            $(document).on('wheel keyup change', '#discount, #shipping_charge', function(e) {
                var total_amount = +$('#total_amount').val();
                var discount = +$('#discount').val();
                var shipping_charge = +$('#shipping_charge').val();
                $('#net_payable').val(total_amount - discount + shipping_charge);
            });

            $(document).on('wheel keyup change', '.rate, .qty', function(
                e) {
                var total_amount = 0;
                $('.rate').each(function(index, value) {
                    var rate = +$(value).val();
                    var qty = +$($('.qty')[index]).val();
                    var total = rate * qty;
                    $($('.amount')[index]).val(total);
                    total_amount += total;
                });
                var discount = +$('#discount').val();
                var shipping_charge = +$('#shipping_charge').val();
                var net_payable = total_amount - discount + shipping_charge;
                $('#total_amount').val(total_amount);
                $('#net_payable').val(net_payable);
            });

            $(document).on('wheel keyup change', '.amount', function(
                e) {
                var total_amount = 0;
                $('.amount').each(function(index, value) {
                    var amount = +$(value).val();
                    var qty = +$($('.qty')[index]).val();
                    total_amount += amount;
                    var rate = amount / qty;
                    $($('.rate')[index]).val(rate);
                });
                var discount = +$('#discount').val();
                var shipping_charge = +$('#shipping_charge').val();
                var net_payable = total_amount - discount + shipping_charge;
                $('#total_amount').val(total_amount);
                $('#net_payable').val(net_payable);
            });
        });
    </script>
@endpush
