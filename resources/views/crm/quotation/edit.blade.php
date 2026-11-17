@extends('layouts.admin.app')

@section('content')
<div class="row">

    <div class="col-lg-12">

        <form action="{{ route('admin.quotation.update', $quotation->id) }}" method="POST">

            @csrf
            @method('PUT')

            <input type="hidden" id="store_id" name="store_id" value="{{ $quotation->store_id }}">
            <input type="hidden" id="client_id" name="client_id" value="{{ $quotation->client_id }}">

            <div class="card">

                <div class="card-header">

                    <div class="d-flex justify-content-between">

                        <h6 class="mb-0">
                            Edit Quotation
                        </h6>

                        <div>

                            <a href="{{ Route('admin.quotation.index') }}" class="btn btn-primary btn-sm">
                                Back
                            </a>

                            <button class="btn btn-primary btn-sm">
                                Update
                            </button>

                        </div>

                    </div>

                </div>

                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-lg-4 col-sm-6">
                            <label for="company_id" class="form-label"><b>Company <span class="text-danger">*</span></b></label>
                            <select name="company_id" id="company_id" class="select form-select"
                                    data-placeholder="Select Company" required>
                                <option value=""></option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                        {{ old('company_id', $quotation->company_id) == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <label for="project_id" class="form-label"><b>Project <span class="text-danger">*</span></b></label>
                            <select name="project_id" id="project_id" class="select form-select"
                                    data-placeholder="Select Project" required>
                                <option value=""></option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}"
                                        {{ old('project_id', $quotation->branch_id) == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 col-sm-6" id="quotation_area">
                            <label for="quotation" class="form-label"><b>Quotation No. <span
                                        class="text-danger">*</span></b></label>
                            <input type="text" class="form-control" id="quotation" name="quotation"
                                value="{{ $quotation->quotation }}" readonly placeholder="Quotation No." required>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6" id="date_area">
                            <label for="date" class="form-label"><b>Quotation Date <span
                                        class="text-danger">*</span></b></label>
                            <input type="text" class="form-control date_picker" id="date" name="date"
                                value="{{ old('date', date('d-m-Y', strtotime($quotation->date))) }}"
                                placeholder="Quotation Date" required>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <label for="name" class="form-label"><b>Quote/Party Name <span
                                        class="text-danger">*</span></b></label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ old('name', $quotation->name) }}" placeholder="Quote/Party Name" required>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <label for="staff_id" class="form-label"><b>Staff <span
                                        class="text-danger">*</span></b></label>
                            <select name="staff_id" id="staff_id" class="select form-select"
                                data-placeholder="Select Staff" required>
                                @foreach ($staffs as $staff)
                                    <option value="{{ $staff->id }}"
                                        {{ old('staff_id', $quotation->staff_id) == $staff->id ? 'selected' : '' }}>
                                        {{ $staff->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <label for="created_by" class="form-label"><b>Quotation By <span
                                        class="text-danger">*</span></b></label>
                            <input type="text" class="form-control" placeholder="Quotation By"
                                value="{{ Auth::user()->name }}" readonly required>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <label for="product_id" class="form-label"><b>Products</b></label>
                            <select id="product_id" class="select form-select" data-placeholder="Select Product">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->code }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 col-sm-2">
                            <div id="manual_qty">
                                <label for="quantity" class="form-label"><b>Quantity</b></label>
                                <input type="number" class="form-control" id="quantity" step="any" value="1"
                                    placeholder="Quantity">
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-2">
                            <label class="form-label text-white d-sm-block d-none"><b>Add</b></label>
                            <button type="button" class="btn btn-xs btn-primary w-100 px-2 py-2" id="add_item">Add
                                Product</button>
                        </div>

                        <div class="col-12">
                            <label for="note" class="form-label"><b>Quotation Note</b></label>
                            <textarea class="form-control" id="note" name="note"
                                placeholder="Write note here..">{{ old('note', $quotation->note) }}</textarea>
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
                                        @foreach ($quotation_details as $key => $item)
                                            <tr id="product{{ $item->product_id }}">
                                                <td class="text-center sl" width="30">
                                                    <span class="sl_no">{{ $key + 1 }}</span>
                                                    <input type="hidden" class="product_id"
                                                        id="product_id{{ $item->product_id }}" name="product_id[]"
                                                        value="{{ $item->product_id }}">
                                                </td>
                                                <td>{{ $item->code }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <input type="number" style="min-width: 100px;" step="any"
                                                        class="form-control rate" placeholder="Rate"
                                                        data-id="{{ $item->product_id }}"
                                                        id="rate{{ $item->product_id }}"
                                                        name="rate[{{ $item->product_id }}]"
                                                        value="{{ $item->rate }}">
                                                </td>
                                                <td>
                                                    <input type="number" style="min-width: 100px;" step="any"
                                                        class="form-control qty" placeholder="Quantity"
                                                        data-id="{{ $item->product_id }}"
                                                        id="qty{{ $item->product_id }}"
                                                        name="qty[{{ $item->product_id }}]"
                                                        value="{{ $item->qty }}">
                                                </td>
                                                <td>
                                                    <input type="number" style="min-width: 100px;" step="any"
                                                        class="form-control amount" placeholder="Amount"
                                                        data-id="{{ $item->product_id }}"
                                                        id="amount{{ $item->product_id }}"
                                                        name="amount[{{ $item->product_id }}]"
                                                        value="{{ $item->amount }}">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button"
                                                        class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot class="bg-primary text-white align-top border-primary">
                                        <tr>
                                            <td class="px-3" colspan="4">
                                                <div class="d-flex gap-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="discount_type" id="fixed" checked value="fixed">
                                                        <label class="form-check-label" for="fixed">
                                                            <b>Fix Discount</b>
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="discount_type" id="percentage" value="percentage">
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
                                                {{-- Total --}}
                                                <div class="input-group flex-nowrap align-items-center">
                                                    <b class="text-end me-2" style="width: 80px;">Total</b>
                                                    <input type="number" id="total_amount" name="total_amount" readonly
                                                        class="form-control" placeholder="Total Amount"
                                                        style="min-width: 100px;" value="{{ $quotation->total_amount }}">
                                                    <span class="text-end" style="width: 25px;">TK.</span>
                                                </div>

                                                {{-- Discount --}}
                                                <div class="input-group flex-nowrap align-items-center mt-1">
                                                    <b class="text-end me-2" style="width: 80px;">Discount</b>
                                                    <input type="number" id="discount" name="discount"
                                                        class="form-control" placeholder="Discount" step="any"
                                                        style="min-width: 100px;" value="{{ $quotation->discount }}">
                                                    <span class="text-end" style="width: 25px;">TK.</span>
                                                </div>

                                                {{-- Tax Percentage --}}
                                                <div class="input-group flex-nowrap align-items-center mt-1">
                                                    <b class="text-end me-2" style="width: 80px;">VAT & Tax (%)</b>
                                                    <input type="number" id="tax_percentage" name="tax_percentage"
                                                        class="form-control" placeholder="Tax %" min="0" max="100"
                                                        step="any" style="min-width: 100px;"
                                                        value="{{ $quotation->tax_percentage ?? 0 }}">
                                                    <span class="text-end" style="width: 25px;">%</span>
                                                </div>

                                                {{-- Tax Amount --}}
                                                <div class="input-group flex-nowrap align-items-center mt-1">
                                                    <b class="text-end me-2" style="width: 80px;">VAT & Tax Amount</b>
                                                    <input type="number" id="tax_amount" name="tax_amount"
                                                        class="form-control" placeholder="Tax Amount" min="0"
                                                        step="any" style="min-width: 100px;"
                                                        value="{{ $quotation->tax_amount ?? 0 }}">
                                                    <span class="text-end" style="width: 25px;">TK.</span>
                                                </div>

                                                {{-- Net Payable --}}
                                                <div class="input-group flex-nowrap align-items-center mt-1">
                                                    <b class="text-end me-2" style="width: 80px;">Net Payable</b>
                                                    <input type="number" id="net_amount" name="net_amount" readonly
                                                        class="form-control" placeholder="Net Payable"
                                                        style="min-width: 100px;" value="{{ $quotation->net_amount }}">
                                                    <span class="text-end" style="width: 25px;">TK.</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </form>

    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
$(document).ready(function() {

    // Tax amount manually edit hoyeche kina
    window.taxManual = false;

    function showError(message) {
        Swal.fire({
            toast: true,
            icon: "error",
            width: "22rem",
            position: 'top-right',
            text: message,
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

    function renumber() {
        $('#tbody tr').each(function(i) {
            $(this).find('.sl_no').text(i + 1);
        });
    }

    $(document).on('click', '#add_item', function(e) {
        var product_id = $("#product_id").val();
        var store_id = $("#store_id").val();
        var quantity = +$("#quantity").val();
        var client_id = $("#client_id").val();

        if (product_id == '') {
            showError("Please select a Product");
            return false;
        }
        if ($('#product' + product_id).length) {
            showError("Product Already Added!");
            return false;
        }
        if (store_id == '') {
            showError("Please select a Store");
            return false;
        }
        if (client_id == '') {
            showError("Please select a Client");
            return false;
        }

        $.ajax({
            url: "{{ Route('admin.quotation.create') }}",
            type: "POST",
            data: {
                _method: 'GET',
                product_id: product_id,
                store_id: store_id,
                quantity: quantity
            },
            success: (response) => {
                if (response.status == 'error') {
                    showError(response.data);
                }
                if (response.status == 'success') {
                    var tr =
                        `<tr id="product${product_id}">
                            <td class="text-center" width="30">
                                <span class="sl_no"></span>
                                <input type="hidden" class="product_id" id="product_id${product_id}" name="product_id[]" value="${product_id}">
                            </td>
                            <td>${response.product.code}</td>
                            <td>${response.product.name}</td>
                            <td><input type="number" style="min-width: 100px;" step="any" class="form-control rate" placeholder="Rate" data-id="${product_id}" id="rate${product_id}" name="rate[${product_id}]" value="${response.price}"></td>
                            <td><input type="number" style="min-width: 100px;" step="any" class="form-control qty" placeholder="Quantity" data-id="${product_id}" id="qty${product_id}" name="qty[${product_id}]" value="${quantity}"></td>
                            <td><input type="number" style="min-width: 100px;" step="any" class="form-control amount" placeholder="Amount" data-id="${product_id}" id="amount${product_id}" name="amount[${product_id}]" value="${response.amount}"></td>
                            <td class="text-center"><button type="button" class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i class="far fa-trash-alt"></i></button></td>
                        </tr>`;
                    $('#tbody').append(tr);
                    renumber();
                    calculate();
                }
            }
        });
    });

    $(document).on('click', '.remove_item', function(e) {
        $(this).closest('tr').remove();
        renumber();
        calculate();
    });

    // Main calculation: Total -> Discount -> Tax -> Net Payable
    function calculate() {
        var total_amount = 0;
        $('.product_id').each(function() {
            var product_id = $(this).val();
            total_amount += +$('#amount' + product_id).val();
        });
        $('#total_amount').val(total_amount);

        var discount = +$('#discount').val();
        if (discount > total_amount) {
            discount = total_amount;
            $('#discount').val(discount);
        }

        // Tax discount er por er amount er upor calculate hoy
        var taxable = total_amount - discount;

        var tax_percentage = +$('#tax_percentage').val();
        var tax_amount = +$('#tax_amount').val();

        if (!window.taxManual) {
            tax_amount = taxable * (tax_percentage / 100);
            $('#tax_amount').val(tax_amount.toFixed(2));
        }

        var net_amount = taxable + tax_amount;
        $('#net_amount').val(net_amount.toFixed(2));
    }

    $(document).on('change', 'input[name="discount_type"]', function(e) {
        if ($(this).val() == 'percentage') {
            $('#percentage_input').show();
        } else {
            $('#percentage_input').hide();
        }
    });

    // Discount (%) -> fixed discount
    $(document).on('wheel keyup change', '#percentage_input', function(event) {
        var discount = +$(this).val();
        if (discount > 100) {
            $(this).val(100);
            discount = 100;
        }
        var total = +$("#total_amount").val();
        var fixed_discount = total * (discount / 100);
        $("#discount").val(Math.floor(fixed_discount));
        calculate();
    });

    // Fixed discount
    $(document).on('wheel keyup change', '#discount', function(e) {
        var total_amount = +$('#total_amount').val();
        var discount = +$(this).val();
        if (discount > total_amount) {
            $(this).val(total_amount);
        }
        calculate();
    });

    // Tax % change -> tax amount auto calculate
    $(document).on('wheel keyup change', '#tax_percentage', function(e) {
        var pct = +$(this).val();
        if (pct > 100) { $(this).val(100); }
        if (pct < 0) { $(this).val(0); }
        window.taxManual = false;
        calculate();
    });

    // Tax amount manually change -> % reverse calculate
    $(document).on('keyup change', '#tax_amount', function(e) {
        var total_amount = +$('#total_amount').val();
        var discount = +$('#discount').val();
        var taxable = total_amount - discount;
        var tax_amount = +$(this).val();

        if (tax_amount < 0) {
            tax_amount = 0;
            $(this).val(0);
        }

        var pct = taxable > 0 ? (tax_amount / taxable) * 100 : 0;
        $('#tax_percentage').val(pct.toFixed(2));

        window.taxManual = true;
        calculate();
        window.taxManual = false;
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
        $('#rate' + product_id).val(qty > 0 ? amount / qty : 0);
        calculate();
    });
});
</script>
@endpush


@push('js')
<script>
    $(document).ready(function () {
        // Company change -> project list reload
        // (page load e trigger hoy na, tai saved project selected thakbe)
        $('#company_id').on('change', function () {
            var companyId = $(this).val();
            var $project = $('#project_id');

            $project.empty().append('<option value=""></option>').prop('disabled', true);

            if (!companyId) {
                $project.trigger('change');
                return;
            }

            var url = "{{ route('admin.store.projects', ':id') }}".replace(':id', companyId);

            $.get(url, function (projects) {
                $.each(projects, function (i, p) {
                    $project.append('<option value="' + p.id + '">' + $('<div>').text(p.name).html() + '</option>');
                });
                $project.prop('disabled', false).trigger('change');
            }).fail(function () {
                alert('Project load kora jayni');
            });
        });
    });
</script>
@endpush