@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="invoice" class="form-label"><b>Invoice No. <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="invoice" name="invoice" value="{{ $data->invoice }}"
                readonly placeholder="Invoice No." required>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="date" class="form-label"><b>Order Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="date" name="date"
                value="{{ date('d-m-Y', strtotime($data->date)) }}" placeholder="Order Date" required>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="client_id" class="form-label"><b>Client <span class="text-danger">*</span></b></label>
            <select name="client_id" id="client_id" class="select form-select" data-placeholder="Select Vendor" required>
                <option value=""></option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $data->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="vendor_id" class="form-label"><b>Vendor</b></label>
            <select name="vendor_id" id="vendor_id" class="select form-select" data-placeholder="Select Vendor">
                <option value=""></option>
                @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}">
                        {{ $vendor->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select id="product_id" class="select form-select" data-placeholder="Select Product">
                <option value=""></option>
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="quantity" class="form-label"><b>Quantity</b></label>
            <input type="number" class="form-control" id="quantity" value="{{ $data->quantity }}"
                placeholder="Quantity">
        </div>
        <div class="col-12 text-end">
            <button type="button" class="btn btn-xs btn-primary mnw-auto px-2" id="add_item">Add Product</button>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-striped target-table align-middle">
                <thead class="bg-primary border-primary text-white">
                    <tr>
                        <th class="px-3 text-center">SL#</th>
                        <th class="px-3">Vendor</th>
                        <th class="px-3">Product Code</th>
                        <th class="px-3">Product Name</th>
                        <th class="px-3">Qty</th>
                        <th class="px-3 text-center" width="50"><i class="far fa-trash-alt"></i></th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @foreach ($products as $key => $product)
                        <tr id="product_{{ $product->id }}">
                            <td class="px-3 text-center"><b>{{ $key + 1 }}</b></td>
                            <td class="px-3">{{ $product->product->vendor->name }}</td>
                            <td class="px-3">{{ $product->product->code }}</td>
                            <td class="px-3">
                                <input type="hidden" name="product_id[{{ $key }}]"
                                    value="{{ $product->product_id }}">
                                {{ $product->product->name }}
                            </td>
                            <td><input type="number" name="quantity[{{ $key }}]" class="form-control quantity"
                                    value="{{ $product->quantity }}" required></td>
                            <td class="px-3 text-center"><button type="button"
                                    class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i
                                        class="far fa-trash-alt"></i></button></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-primary text-white border-primary">
                    <tr>
                        <td class="text-end" colspan="4">
                            <b>Total Qty</b>
                        </td>
                        <td colspan="2">
                            @php
                                $total_qty = 0;
                            @endphp
                            @foreach ($products as $product)
                                @php
                                    $total_qty += $product->quantity;
                                @endphp
                            @endforeach
                            <input type="number" readonly id="total_qty" name="total_qty" class="form-control"
                                value="{{ $total_qty }}">
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
            });

            $(document).on('change', '#vendor_id', function(e) {
                let vendor_id = $(this).val();
                let url = "{{ Route('admin.offline-order.edit', $data->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        vendor_id: vendor_id
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#product_id option').remove();
                            $('#product_id').append('<option value=""></option>');
                            $.each(response.products, function(key, value) {
                                var option =
                                    `<option value="${value.id}">${value.name} (${value.code})</option>`;
                                $('#product_id').append(option);
                            });
                        }
                    }
                });
            });

            $(document).on('click', '#add_item', function(e) {
                var product_id = $("#product_id").val();
                var quantity = $("#quantity").val();
                var existing_key = $("#tbody tr").length;
                if ($('#product_' + product_id).length > 0) {
                    Swal.fire({
                        width: "22rem",
                        title: "Error!",
                        text: "Already added this product!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }

                if (product_id == '' || quantity == '') {
                    Swal.fire({
                        width: "22rem",
                        title: "Error!",
                        text: "Please select a Product",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    let qty = $('#quantity').val();
                    let url = "{{ Route('admin.offline-order.edit', $data->id) }}";
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _method: 'GET',
                            get_product: 'true',
                            product_id: product_id,
                        },
                        success: (response) => {
                            if (response.status == 'success') {
                                var tr = `<tr id="product_${response.product.id}">
                                    <td class="px-3 text-center"><b>${(existing_key+1)}</b></td>
                                    <td class="px-3">${response.product.vendor.name}</td>
                                    <td class="px-3">${response.product.code}</td>
                                    <td class="px-3">
                                        <input type="hidden" name="product_id[${existing_key}]" value="${response.product.id}">${response.product.name}</td>
                                    <td class="px-3"><input type="number" name="quantity[${existing_key}]" class="form-control quantity" value="${qty}" required></td>
                                    <td class="px-3 text-center"><button type="button" class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i class="far fa-trash-alt"></i></button></td>
                                </tr>`;
                                $('#tbody').append(tr);
                                var old_qty = $('#total_qty').val();
                                $('#total_qty').val(parseInt(old_qty) + parseInt(qty));
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.remove_item', function(e) {
                $(this).closest('tr').remove();
                var total_qty = 0;
                $('.quantity').each(function(key, value) {
                    var quanity = parseInt($(this).val());
                    total_qty += isNaN(quanity) ? 0 : quanity;
                });
                $('#total_qty').val(total_qty);
            });

            $(document).on('wheel keyup change', '.quantity', function(
                e) {
                var total_qty = 0;
                $('.quantity').each(function(key, value) {
                    var quanity = parseInt($(this).val());
                    total_qty += isNaN(quanity) ? 0 : quanity;
                });
                $('#total_qty').val(total_qty);
            });
        });
    </script>
@endpush
