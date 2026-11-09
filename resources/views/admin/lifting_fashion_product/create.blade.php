@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="payment_type" class="form-label"><b>Payment Type</b></label>
            <select name="payment_type" id="payment_type" class="select form-select" data-placeholder="Payment Type" required>
                <option value="credit">Credit</option>
                <option value="cash">Cash</option>
                <option value="import">Import</option>
            </select>
        </div>
        <div class="col-md-4 col-sm-6" id="accounts_area" style="display: none;">
            <label for="coa_setup_id" class="form-label"><b>Cash Account</b></label>
            <select name="coa_setup_id" id="coa_setup_id" class="select form-select" data-placeholder="Select Cash Account">
                <option value="">Select Cash Account</option>
                @foreach ($cash_heads as $cash_head)
                    <option value="{{ $cash_head->id }}">{{ $cash_head->head_name . ' - ' . $cash_head->head_code }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6" id="document_area" style="display: none;">
            <label for="document" class="form-label"><b>Documents</b></label>
            <input type="file" name="document[]" id="document" class="form-control" multiple>
        </div>
        <div class="col-md-4 col-sm-6" id="lifting_no_area">
            <label for="lifting_no" class="form-label"><b>Purchase No.</b></label>
            <input type="text" class="form-control" id="lifting_no" name="lifting_no"
                value="{{ $lifting_no }}" readonly required placeholder="Purchase No.">
        </div>
        <div class="col-md-4 col-sm-6" id="lifting_date_area">
            <label for="lifting_date" class="form-label"><b>Purchase Date</b></label>
            <input type="text" class="form-control date_picker" id="lifting_date" name="lifting_date"
                required value="{{ date('d-m-Y', strtotime(old('lifting_date'))) }}" placeholder="Purchase Date">
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="vendor_id" class="form-label"><b>Vendor</b></label>
            <select name="vendor_id" id="vendor_id" class="select form-select" data-placeholder="Select Vendor" required>
                <option value=""></option>
                @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}"
                        {{ old('vendor_id') && old('vendor_id') == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="voucher_no" class="form-label"><b>Voucher No.</b></label>
            <input type="text" class="form-control" id="voucher_no" name="voucher_no" required
                value="{{ old('voucher_no') }}" placeholder="Voucher No.">
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="created_by" class="form-label"><b>Purchase By</b></label>
            <input type="text" class="form-control" placeholder="Purchase By" value="{{ Auth::user()->name }}" readonly>
        </div>
        <div class="col-md-2 col-sm-6">
            <label for="store_id" class="form-label"><b>Receive Store</b></label>
            <select name="store_id" id="store_id" class="select form-select" data-placeholder="Select Store" required>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}"
                        {{ old('store_id') && old('store_id') == $store->id ? 'selected' : '' }}>{{ $store->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select name="product_id" id="product_id" class="select form-select" data-placeholder="Select Product">
                <option value=""></option>
                @foreach ($products as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="variant_id" class="form-label"><b>Variant</b></label>
            <select name="variant_id" id="variant_id" class="select form-select" data-placeholder="Select Variant">
                <option value=""></option>
            </select>
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
            <table class="table table-bordered table-striped target-table align-middle mb-0">
                <thead class="bg-primary border-primary text-white">
                    <tr>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Variant</th>
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
                            <input type="number" max="100" min="1" id="percentage_input" step="any"
                                class="form-control mt-2" placeholder="Discount Percentage"
                                style="display: none; max-width: 250px;">
                        </td>
                        <td colspan="2"></td>
                        <td colspan="3">
                            <div class="input-group align-items-center mb-2">
                                <span style="width: 100px;">Total</span>
                                <input type="number" id="total_cost" name="total_cost" readonly class="form-control"
                                    placeholder="Total Cost" value="0">
                                <span class="text-center" style="width: 40px;">TK.</span>
                            </div>
                            <div class="input-group align-items-center mb-2">
                                <span style="width: 100px;">Discount</span>
                                <input type="number" id="discount" name="discount" class="form-control"
                                    placeholder="Discount" value="0">
                                <span class="text-center" style="width: 40px;">TK.</span>
                            </div>
                            <div class="input-group align-items-center">
                                <span style="width: 100px;">Net Payable</span>
                                <input type="number" id="net_payable" name="net_payable" readonly class="form-control"
                                    placeholder="net Payable" value="0">
                                <span class="text-center" style="width: 40px;">TK.</span>
                            </div>
                        </td>
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
            }).datepicker('setDate', 'today');

            $(document).on('click', '#add_item', function(e) {
                var variant_id = $("#variant_id").val();
                var quantity = $("#quantity").val();
                var existing_key = $("#tbody tr").length;
                if ($('.variant_id' + variant_id).length) {
                    Swal.fire({
                        width: "22rem",
                        toast: true,
                        position: 'top-right',
                        text: "Variant already added!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }

                if (variant_id == '' || quantity == '') {
                    Swal.fire({
                        width: "22rem",
                        toast: true,
                        position: 'top-right',
                        text: "Please select a Variant",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    let qty = $('#quantity').val();
                    let url = "{{ Route('admin.lifting-fashion-product.create') }}";
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _method: 'GET',
                            get_variant: 'true',
                            variant_id: variant_id,
                        },
                        success: (response) => {
                            if (response.status == 'success') {
                                var tr =
                                    `<tr>
                                        <td width="150" class="px-3">${response.variant.product.category.name}</td>
                                        <td class="px-3">
                                            <input type="hidden" class="variant_id${variant_id}" name="variant_id[${existing_key}]" value="${variant_id}">
                                            <span>${response.variant.product.name}</span>
                                        </td>
                                        <td class="px-3">${response.variant.sku}</td>
                                        <td><input style="width: 150px;" class="text-center rate" type="number" name="lifting_price[${existing_key}]" step="any" value="${response.variant.lifting_price}" required></td>
                                        <td><input style="width: 150px;" class="text-center qty" type="number" name="quantity[${existing_key}]" step="any" value="${qty}" required></td>
                                        <td><input style="width: 150px;" class="text-center amount" type="number" name="amount[${existing_key}]" step="any" value="${qty * response.variant.lifting_price}" required></td>
                                        <td class="text-center"><button type="button" class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i class="far fa-trash-alt"></i></button></td>
                                    </tr>`;
                                $('#tbody').append(tr);

                                var total_amount = 0;
                                $('.rate').each(function(index, value) {
                                    var rate = parseFloat($(value).val());
                                    var qty = parseFloat($($('.qty')[index]).val());
                                    var total = rate * qty;
                                    $($('.amount')[index]).val(total);
                                    total_amount += total;
                                });
                                var discount = parseFloat($('#discount').val());
                                var net_payable = total_amount - discount;
                                $('#total_cost').val(total_amount);
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
                    var rate = parseFloat($(value).val());
                    var qty = parseFloat($($('.qty')[index]).val());
                    var total = rate * qty;
                    $($('.amount')[index]).val(total);
                    total_amount += total;
                });
                var discount = parseFloat($('#discount').val());
                var net_payable = total_amount - discount;
                $('#total_cost').val(total_amount);
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

                var total = $("#total_cost").val();
                var fix_discount = Math.ceil(total * (discount / 100));
                $("#discount").val(fix_discount);
                $("#net_payable").val(total - fix_discount);
            });

            $(document).on('wheel keyup change', '#discount', function(e) {
                var total_amount = parseFloat($('#total_cost').val());
                var discount = parseFloat($(this).val());
                $('#net_payable').val(total_amount - discount);
            });

            $(document).on('wheel keyup change', '.rate, .qty', function(
                e) {
                var total_amount = 0;
                $('.rate').each(function(index, value) {
                    var rate = parseFloat($(value).val());
                    var qty = parseFloat($($('.qty')[index]).val());
                    var total = rate * qty;
                    $($('.amount')[index]).val(total);
                    total_amount += total;
                });
                var discount = parseFloat($('#discount').val());
                var net_payable = total_amount - discount;
                $('#total_cost').val(total_amount);
                $('#net_payable').val(net_payable);
            });

            $(document).on('wheel keyup change', '.amount', function(
                e) {
                var total_amount = 0;
                $('.amount').each(function(index, value) {
                    var amount = parseFloat($(value).val());
                    var qty = parseFloat($($('.qty')[index]).val());
                    total_amount += amount;
                    var rate = amount / qty;
                    $($('.rate')[index]).val(rate);
                });
                var discount = parseFloat($('#discount').val());
                var net_payable = total_amount - discount;
                $('#total_cost').val(total_amount);
                $('#net_payable').val(net_payable);
            });

            $(document).on('change', '#payment_type', function(e) {
                if ($(this).val() == 'import') {
                    $('#lifting_no_area').addClass('col-md-2').removeClass('col-md-4');
                    $('#lifting_date_area').addClass('col-md-2').removeClass('col-md-4');
                    $('#document_area').show();
                    $('#accounts_area').hide();
                    $('#coa_setup_id').attr('required', false);
                } else if ($(this).val() == 'cash') {
                    @if (@$admin_setting->accounting == 1)
                        $('#lifting_no_area').addClass('col-md-2').removeClass('col-md-4');
                        $('#lifting_date_area').addClass('col-md-2').removeClass('col-md-4');
                        $('#document_area').hide();
                        $('#accounts_area').show();
                        $('#coa_setup_id').attr('required', true);
                    @endif
                } else {
                    $('#document_area').hide();
                    $('#accounts_area').hide();
                    $('#lifting_no_area').addClass('col-md-4').removeClass('col-md-2');
                    $('#lifting_date_area').addClass('col-md-4').removeClass('col-md-2');
                    $('#coa_setup_id').attr('required', false);
                }
            });

            $(document).on('change', '#product_id', function(e) {
                let product_id = $(this).val();
                let url = "{{ Route('admin.lifting-fashion-product.create') }}";
                $('#variant_id option').remove();

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        product_id: product_id,
                        get_variants: true
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#variant_id').append('<option value=""></option>');
                            $.each(response.product.sku, function(key, value) {
                                var option =
                                    `<option value="${value.id}">${value.sku}</option>`;
                                $('#variant_id').append(option);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
