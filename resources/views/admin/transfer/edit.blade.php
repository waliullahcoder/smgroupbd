@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        {{-- <div class="col-md-4 col-sm-6">
            <label for="product_type" class="form-label"><b>Product Type <span class="text-danger">*</span></b></label>
            <select name="product_type" id="product_type" class="select form-select" data-placeholder="Select Product Type"
                required>
                <option value="Consumer" {{ $data->product_type == 'Consumer' ? 'selected' : '' }}>
                    Consumer
                </option>
                <option value="Fashion" {{ $data->product_type == 'Fashion' ? 'selected' : '' }}>
                    Fashion
                </option>
            </select>
        </div> --}}
        <div class="col-md-3 col-sm-6">
            <label for="transfer_no" class="form-label"><b>Transfer No <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="transfer_no" name="transfer_no" placeholder="Transfer No"
                value="{{ $data->transfer_no }}" readonly required>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="date" class="form-label"><b>Transfer Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="date" name="date" placeholder="Transfer Date"
                value="{{ date('d-m-Y', strtotime($data->date)) }}" required>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="host_id" class="form-label"><b>Source Store <span class="text-danger">*</span></b></label>
            <select name="host_id" id="host_id" class="select form-select" data-placeholder="Select Host Store" required>
                <option value=""></option>
                @foreach ($host_stores as $host_store)
                    <option value="{{ $host_store->id }}" {{ $data->host_id == $host_store->id ? 'selected' : '' }}>
                        {{ $host_store->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="destination_id" class="form-label"><b>Destination Store <span
                        class="text-danger">*</span></b></label>
            <select name="destination_id" id="destination_id" class="select form-select"
                data-placeholder="Select Destination Store" required>
                <option value=""></option>
                @foreach ($destination_stores as $destination_store)
                    <option value="{{ $destination_store->id }}"
                        {{ $data->destination_id == $destination_store->id ? 'selected' : '' }}>
                        {{ $destination_store->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="{{ $data->product_type == 'Fashion' ? 'col-md-3' : 'col-md-3' }} col-sm-6" id="product_area">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select name="product_id" id="product_id" class="select form-select" data-placeholder="Select Proudct">
                <option value=""></option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        @if ($data->product_type == 'Fashion')
            <div class="col-md-3 col-sm-6" id="variant_area">
                <label for="variant_id" class="form-label"><b>Variant</b></label>
                <select name="variant_id" id="variant_id" class="select form-select" data-placeholder="Select Variant">
                    <option value=""></option>
                </select>
            </div>
        @endif
        <div class="col-md-3">
            <label for="remarks" class="form-label"><b>Remarks</b></label>
            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks"
                value="{{ $data->remarks }}">
        </div>
        <div class="col-md-2 col-sm-6">
            <label for="stock" class="form-label"><b>Stock</b></label>
            <input type="number" step="any" class="form-control" id="stock" placeholder="Stock" readonly
                value="0">
        </div>
        <div class="col-md-2 col-sm-6">
            <label for="qty" class="form-label"><b>Quantity</b></label>
            <input type="number" step="any" class="form-control" id="qty" placeholder="Quantity">
        </div>
        <div class="col-md-2 col-sm-6">
            <label for="add" class="form-label text-white d-sm-block d-none"><b>Add</b></label>
            <div class="d-grid">
                <button type="button" class="btn btn-primary btn-sm" id="add_item" style="min-height: 39px">ADD
                    ITEM</button>
            </div>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-striped target-table align-middle mb-0">
                <thead class="bg-primary border-primary text-white align-middle">
                    <tr>
                        <th>Product Name</th>
                        <th width="220" id="changeable_text">
                            {{ $data->product_type == 'Fashion' ? 'Variant' : 'Code' }}</th>
                        <th width="150" class="text-center">Stock Qty</th>
                        <th width="150" class="text-center">Transfer</th>
                        <th width="60" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @if ($data->product_type == 'Consumer')
                        @foreach ($data->list as $item)
                            <tr id="product_{{ $item->product_id }}">
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->product->code }}</td>
                                @php
                                    $stock = App\Http\Controllers\Admin\TransferController::stock(
                                        $item->product_id,
                                        $data->host_id,
                                    );
                                @endphp
                                <td>
                                    <input type="number" style="width: 150px;" class="form-control text-center"
                                        name="stock_qty[{{ $item->product_id }}]" value="{{ $stock + $item->qty }}"
                                        step="any" readonly required>
                                </td>
                                <td>
                                    <input type="number" style="width: 150px;" class="form-control text-center"
                                        name="transfer_qty[{{ $item->product_id }}]" value="{{ $item->qty }}"
                                        step="any" max="{{ $stock + $item->qty }}" required>
                                </td>
                                <td class="text-center">
                                    <input type="hidden" name="product_id[]" value="{{ $item->product_id }}">
                                    <button type="button" class="btn btn-xs remove_btn"
                                        data-id="{{ $item->product_id }}"><i class="fal fa-times"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($data->list as $item)
                            <tr id="variant_{{ $item->variant_id }}">
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->variant->sku }}</td>
                                @php
                                    $stock = App\Http\Controllers\Admin\TransferController::stock(
                                        $item->variant_id,
                                        $data->host_id,
                                        'Fashion',
                                    );
                                @endphp
                                <td>
                                    <input type="number" style="width: 150px;" class="form-control text-center mx-auto"
                                        name="stock_qty[{{ $item->variant_id }}]" value="{{ $stock + $item->qty }}"
                                        step="1" readonly required>
                                </td>
                                <td>
                                    <input type="number" style="width: 150px;" class="form-control text-center mx-auto"
                                        name="transfer_qty[{{ $item->variant_id }}]" value="{{ $item->qty }}"
                                        max="{{ $stock + $item->qty }}" step="1" required>
                                </td>
                                <td class="text-center">
                                    <input type="hidden" name="sku_id[]" value="{{ $item->variant_id }}">
                                    <button type="button" class="btn btn-xs remove_btn"
                                        data-id="{{ $item->variant_id }}"><i class="fal fa-times"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
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

            $(document).on('change', '#host_id', function(e) {
                $('#tbody').html('');
                $('#product_id').val('');
                $('#product_id').select2();
                let host_id = $(this).val();
                let url = "{{ Route('admin.transfer.edit', $data->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        host_id: host_id,
                        get_destination_store: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#destination_id option').remove();
                            $('#destination_id').append('<option value=""></option>');
                            if (response.destination_stores.length > 0) {
                                response.destination_stores.forEach(function(item, index) {
                                    var option =
                                        `<option value="${item.id}">${item.name}</option>`;
                                    $('#destination_id').append(option);
                                });
                            }
                        }
                    }
                });
            });

            $(document).on('change', '#product_type', function(e) {
                $('#tbody').html('');
                $('#product_id option').remove();
                $('#stock').val(0);

                var product_type = $('#product_type').val();
                let url = "{{ Route('admin.transfer.edit', $data->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        product_type: product_type,
                        get_products: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#product_id').append('<option value=""></option>');
                            if (response.products.length > 0) {
                                response.products.forEach(function(item, index) {
                                    var option =
                                        `<option value="${item.id}">${item.name}</option>`;
                                    $('#product_id').append(option);
                                });
                            }
                        }
                    }
                });

                if (product_type == 'Fashion') {
                    $('#product_area').removeClass('col-md-6').addClass('col-md-3');
                    $('#product_area').after(`<div class="col-md-3 col-sm-6" id="variant_area">
                        <label for="variant_id" class="form-label"><b>Variant</b></label>
                        <select name="variant_id" id="variant_id" class="select form-select" data-placeholder="Select Variant">
                            <option value=""></option>
                        </select>
                    </div>`);
                    $('#changeable_text').text('Variant');
                } else {
                    $('#product_area').removeClass('col-md-3').addClass('col-md-6');
                    $('#variant_area').remove();
                    $('#changeable_text').text('Code');
                }

                $('.select').select2({
                    allowClear: true,
                });
            });

            $(document).on('change', '#product_id', function(e) {
                if ($('#variant_id').length) {
                    $('#variant_id option').remove();
                }
                var product_id = $('#product_id').val();
                var host_id = $('#host_id').val();
                var product_type = $('#product_type').val();
                let url = "{{ Route('admin.transfer.edit', $data->id) }}";
                if (host_id == '') {
                    Swal.fire({
                        width: "22rem",
                        title: "Failed!",
                        text: "Please Select a Host Store",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#product_id').val('');
                    $('.select').select2({
                        allowClear: true,
                    });
                    return false;
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        host_id: host_id,
                        product_id: product_id,
                        product_type: product_type,
                        get_stock: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            if (product_type == 'Consumer' || product_type == undefined) {
                                if (response.data.stock > 0) {
                                    $('#stock').val(response.data.stock);
                                } else {
                                    $('#stock').val(0);
                                }
                            } else {
                                $('#variant_id').append('<option value=""></option>');
                                if (response.variants.length > 0) {
                                    response.variants.forEach(function(item, index) {
                                        var option =
                                            `<option value="${item.id}">${item.sku}</option>`;
                                        $('#variant_id').append(option);
                                    });
                                }
                            }
                        }
                    }
                });
            });

            $(document).on('change', '#variant_id', function(e) {
                var variant_id = $('#variant_id').val();
                var host_id = $('#host_id').val();
                let url = "{{ Route('admin.transfer.edit', $data->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        host_id: host_id,
                        variant_id: variant_id,
                        get_variant_stock: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            if (response.data.stock > 0) {
                                $('#stock').val(response.data.stock);
                            } else {
                                $('#stock').val(0);
                            }
                        }
                    }
                });
            });

            $(document).on('click', '#add_item', function(e) {
                let product_id = $('#product_id').val();
                let variant_id = $('#variant_id').val();
                let product_type = $('#product_type').val();
                let host_id = $('#host_id').val();
                let url = "{{ Route('admin.transfer.edit', $data->id) }}";
                let stock = parseFloat($('#stock').val());
                let qty = isNaN(parseFloat($('#qty').val())) ? 0 : parseFloat($('#qty').val());
                if (stock < qty) {
                    Swal.fire({
                        width: "22rem",
                        title: "Failed!",
                        text: "Quantity must be less than or equal Stock Quantity!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }
                if (qty == 0) {
                    Swal.fire({
                        width: "22rem",
                        title: "Failed!",
                        text: "Please define quantity!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }
                if ($('#product_' + product_id).length) {
                    Swal.fire({
                        width: "22rem",
                        title: "Failed!",
                        text: "Already Added this product!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }
                if ($('#variant_' + variant_id).length) {
                    Swal.fire({
                        width: "22rem",
                        title: "Failed!",
                        text: "Already Added this variant!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }
                if (host_id == '') {
                    Swal.fire({
                        width: "22rem",
                        title: "Failed!",
                        text: "Please Select a Host Store",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }

                if (product_type == 'Consumer' || product_type == undefined) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _method: 'GET',
                            host_id: host_id,
                            product_id: product_id,
                            get_stock: true,
                        },
                        success: (response) => {
                            if (response.status == 'success') {
                                var row = `
                                    <tr id="product_${response.data.product.id}">
                                        <td>${response.data.product.name}</td>
                                        <td>${response.data.product.code}</td>
                                        <td>
                                            <input type="number" style="width: 150px;" class="form-control text-center" name="stock_qty[${response.data.product.id}]" value="${stock}" step="any" readonly required>
                                        </td>
                                        <td>
                                            <input type="number" style="width: 150px;" class="form-control text-center" name="transfer_qty[${response.data.product.id}]" value="${qty}" max="${stock}" step="any" required>
                                        </td>
                                        <td class="text-center">
                                            <input type="hidden" name="product_id[]" value="${response.data.product.id}">
                                            <button type="button" class="btn btn-xs remove_btn" data-id="${response.data.product.id}"><i class="fal fa-times"></i></button>
                                        </td>
                                    </tr>`;
                                $('#tbody').append(row);
                            }
                        }
                    });
                } else {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _method: 'GET',
                            host_id: host_id,
                            variant_id: variant_id,
                            get_variant_stock: true,
                        },
                        success: (response) => {
                            if (response.status == 'success') {
                                var row = `
                                <tr id="variant_${response.data.variant.id}">
                                    <td>${response.data.variant.product.name}</td>
                                    <td>${response.data.variant.sku}</td>
                                    <td>
                                        <input type="number" style="width: 150px;" class="form-control text-center mx-auto" name="stock_qty[${response.data.variant.id}]" value="${stock}" step="1" readonly required>
                                    </td>
                                    <td>
                                        <input type="number" style="width: 150px;" class="form-control text-center mx-auto" name="transfer_qty[${response.data.variant.id}]" value="${qty}" max="${stock}" step="1" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="hidden" name="sku_id[]" value="${response.data.variant.id}">
                                        <button type="button" class="btn btn-xs remove_btn" data-id="${response.data.variant.id}"><i class="fal fa-times"></i></button>
                                    </td>
                                </tr>`;
                                $('#tbody').append(row);
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.remove_btn', function(e) {
                e.preventDefault();
                var rowId = $(this).data('id');
                $('#product_' + rowId).remove();
            });
        });
    </script>
@endpush
