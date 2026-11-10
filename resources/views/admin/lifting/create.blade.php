@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">

        <input type="hidden" name="lifting_type" value="manual">
        <input type="hidden" name="payment_type" value="credit">
        <input type="hidden" name="store_id" value="1">

        <div class="col-lg-4 col-sm-6">
            <label for="company_id" class="form-label"><b>Company <span class="text-danger">*</span></b></label>
            <select name="company_id" id="company_id" class="select form-select"
                data-placeholder="Select Company" required>
                <option value=""></option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-4 col-sm-6">
            <label for="project_id" class="form-label"><b>Project <span class="text-danger">*</span></b></label>
            <select name="project_id" id="project_id" class="select form-select"
                data-placeholder="Select Project" required disabled>
                <option value=""></option>
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

        <div class="col-md-4 col-sm-6" id="voucher_no_area">
            <label for="voucher_no" class="form-label"><b>Voucher No.</b></label>
            <input type="text" class="form-control" id="voucher_no" name="voucher_no"
                value="{{ old('voucher_no') }}" placeholder="Voucher No.">
        </div>

        <div class="col-md-4 col-sm-6">
            <label for="product_id" class="form-label"><b>Products <a href="{{ url('/admin/product/create') }}">Add new</a></b></label>
            <select id="product_id" class="select form-select" data-placeholder="Select Product">
                <option value=""></option>
                @foreach ($products as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->code }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 col-sm-6" id="remarks_area">
            <label for="remarks" class="form-label"><b>Remarks</b></label>
            <input type="text" class="form-control" id="remarks" name="remarks"
                value="{{ old('remarks') }}" placeholder="Remarks Note" required>
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
                                        <label class="form-check-label" for="fixed">Fix Discount</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="discount_type"
                                            id="percentage" value="percentage">
                                        <label class="form-check-label" for="percentage">Discount (%)</label>
                                    </div>
                                </div>
                                <input type="number" max="100" min="0" id="percentage_input" step="any"
                                    class="form-control" placeholder="Discount Percentage"
                                    style="display: none; max-width: 250px;">
                            </td>
                            <td colspan="2"></td>
                            <td colspan="3">
                                <div class="input-group flex-nowrap align-items-center mb-1">
                                    <b class="text-end me-2" style="width: 90px;">Total</b>
                                    <input type="number" id="total_cost" name="total_cost" readonly
                                        class="form-control" placeholder="Total Cost" style="min-width: 100px;"
                                        value="0">
                                    <span class="text-end" style="width: 25px;">TK.</span>
                                </div>
                                <div class="input-group flex-nowrap align-items-center mb-1">
                                    <b class="text-end me-2" style="width: 90px;">Discount</b>
                                    <input type="number" id="discount" name="discount" class="form-control"
                                        placeholder="Discount" style="min-width: 100px;" value="0" min="0"
                                        step="any">
                                    <span class="text-end" style="width: 25px;">TK.</span>
                                </div>
                                <div class="input-group flex-nowrap align-items-center mb-1">
                                    <b class="text-end me-2" style="width: 90px;">Tax (%)</b>
                                    <input type="number" id="tax" name="tax" class="form-control"
                                        placeholder="Tax %" style="min-width: 100px;" value="0" min="0"
                                        max="100" step="any">
                                    <span class="text-end" style="width: 25px;">%</span>
                                </div>
                                <div class="input-group flex-nowrap align-items-center mb-1">
                                    <b class="text-end me-2" style="width: 90px;">Tax Amt</b>
                                    <input type="number" id="tax_amount" name="tax_amount" readonly
                                        class="form-control" placeholder="Tax Amount" style="min-width: 100px;"
                                        value="0">
                                    <span class="text-end" style="width: 25px;">TK.</span>
                                </div>
                                <div class="input-group flex-nowrap align-items-center">
                                    <b class="text-end me-2" style="width: 90px;">Net Payable</b>
                                    <input type="number" id="net_payable" name="net_payable" readonly
                                        class="form-control" placeholder="Net Payable" style="min-width: 100px;"
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

            // ---------- Helpers ----------
            function showToast(text) {
                Swal.fire({
                    width: "22rem",
                    toast: true,
                    position: 'top-right',
                    text: text,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500,
                    showClass: {
                        popup: `animate__animated animate__bounceInRight animate__faster`
                    },
                    hideClass: {
                        popup: `animate__animated animate__bounceOutRight animate__faster`
                    }
                });
            }

            function buildRow(id, categoryName, name, code, price, qty) {
                return `<tr id="product${id}">
                    <td class="text-nowrap" width="150">${categoryName}</td>
                    <td>
                        <input type="hidden" class="product_id" name="product_id[]" value="${id}">
                        <span>${name}</span>
                    </td>
                    <td>${code}</td>
                    <td><input style="width: 150px;" class="text-center rate" data-id="${id}" type="number" id="lifting_price_${id}" name="lifting_price[${id}]" step="any" value="${price}" required></td>
                    <td><input style="width: 150px;" class="text-center qty" data-id="${id}" type="number" id="quantity_${id}" name="quantity[${id}]" step="any" value="${qty}" required></td>
                    <td><input style="width: 150px;" class="text-center amount" data-id="${id}" type="number" id="amount_${id}" name="amount[${id}]" step="any" value="${qty * price}" required></td>
                    <td class="text-center"><button type="button" class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i class="far fa-trash-alt"></i></button></td>
                </tr>`;
            }

            // ---------- Main calculation ----------
            // Total -> Discount -> Tax (% of Total - Discount) -> Net Payable
            function calculate() {
                var total_amount = 0;
                $('.product_id').each(function() {
                    var product_id = $(this).val();
                    total_amount += +$('#amount_' + product_id).val() || 0;
                });

                // Discount
                var discount = 0;
                if ($('input[name="discount_type"]:checked').val() == 'percentage') {
                    var dPercent = +$('#percentage_input').val() || 0;
                    if (dPercent > 100) {
                        dPercent = 100;
                        $('#percentage_input').val(100);
                    }
                    discount = Math.ceil(total_amount * dPercent / 100);
                } else {
                    discount = +$('#discount').val() || 0;
                }
                if (discount > total_amount) {
                    discount = total_amount;
                }
                if (discount < 0) {
                    discount = 0;
                }
                $('#discount').val(discount);

                // Tax (percent)
                var taxPercent = +$('#tax').val() || 0;
                if (taxPercent > 100) {
                    taxPercent = 100;
                    $('#tax').val(100);
                }
                if (taxPercent < 0) {
                    taxPercent = 0;
                    $('#tax').val(0);
                }

                var taxable = total_amount - discount;
                // var taxable = total_amount;
                var tax_amount = +(taxable * taxPercent / 100).toFixed(2);
                var net_payable = +(taxable + tax_amount).toFixed(2);

                $('#total_cost').val(total_amount);
                $('#tax_amount').val(tax_amount);
                $('#net_payable').val(net_payable);
            }

            // ---------- Add product ----------
            $(document).on('click', '#add_item', function(e) {
                var product_id = $("#product_id").val();
                var quantity = $("#quantity").val();

                if ($('#product' + product_id).length) {
                    showToast("Product already added!");
                    return false;
                }

                if (product_id == '' || quantity == '') {
                    showToast("Please select a product");
                    return false;
                }

                $.ajax({
                    url: "{{ Route('admin.lifting.create') }}",
                    type: "POST",
                    data: {
                        _method: 'GET',
                        get_product: true,
                        product_id: product_id,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            var p = response.product;
                            $('#tbody').append(buildRow(product_id, p.category.name, p.name, p.code,
                                p.price.lifting_price, quantity));
                            calculate();
                        }
                    }
                });
            });

            $(document).on('click', '.remove_item', function(e) {
                $(this).closest('tr').remove();
                calculate();
            });

            // ---------- Discount / Tax events ----------
            $(document).on('change', 'input[name="discount_type"]', function(e) {
                if ($(this).val() == 'percentage') {
                    $('#percentage_input').show();
                    $('#discount').prop('readonly', true);
                } else {
                    $('#percentage_input').hide().val('');
                    $('#discount').prop('readonly', false);
                }
                calculate();
            });

            $(document).on('wheel keyup change', '#percentage_input, #discount, #tax', function(e) {
                calculate();
            });

            // ---------- Row events ----------
            $(document).on('wheel keyup change', '.amount', function(e) {
                var product_id = $(this).data('id');
                var qty = +$('#quantity_' + product_id).val();
                var amount = +$('#amount_' + product_id).val();
                if (qty > 0) {
                    $('#lifting_price_' + product_id).val(amount / qty);
                }
                calculate();
            });

            $(document).on('wheel keyup change', '.rate, .qty', function(e) {
                var product_id = $(this).data('id');
                var rate = +$('#lifting_price_' + product_id).val();
                var qty = +$('#quantity_' + product_id).val();
                $('#amount_' + product_id).val(rate * qty);
                calculate();
            });

            // ---------- Payment / lifting type toggles ----------
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

            // ---------- Barcode scan ----------
            $(document).on('keypress', '#code', function(e) {
                if (e.which == 13) {
                    var formData = $('#store_form').serialize();
                    formData += '&_method=GET';
                    $.ajax({
                        url: "{{ Route('admin.lifting.create') }}",
                        type: "POST",
                        data: formData,
                        success: (response) => {
                            if (response.status == 'error') {
                                showToast(response.data);
                            }
                            if (response.status == 'increment') {
                                $('#quantity_' + response.product_id).val(response.total_qty);
                                $('#amount_' + response.product_id).val(response.amount);
                                calculate();
                            }
                            if (response.status == 'success') {
                                var p = response.product;
                                $('#tbody').append(buildRow(p.id, p.category.name, p.name, p.code,
                                    response.price, 1));
                                calculate();
                            }
                            $('#code').val('');
                        }
                    });
                    e.preventDefault();
                }
            });

            // ---------- Company -> Project (AJAX) ----------
            $('#company_id').on('change', function() {
                var companyId = $(this).val();
                var $project = $('#project_id');

                $project.empty().append('<option value=""></option>').prop('disabled', true);

                if (!companyId) {
                    $project.trigger('change');
                    return;
                }

                var url = "{{ route('admin.store.projects', ':id') }}".replace(':id', companyId);

                $.get(url, function(projects) {
                    $.each(projects, function(i, p) {
                        $project.append('<option value="' + p.id + '">' + $('<div>').text(p
                            .name).html() + '</option>');
                    });
                    $project.prop('disabled', false).trigger('change');
                }).fail(function() {
                    alert('Project load kora jayni');
                });
            });

            // Validation fail hoye back korle old company thakle project reload
            @if (old('company_id'))
                $('#company_id').trigger('change');
            @endif
        });
    </script>
@endpush