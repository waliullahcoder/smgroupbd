@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="client_id" class="form-label"><b>Client</b></label>
            <select name="client_id" id="client_id" class="select form-select" data-placeholder="Select Client" required>
                <option value=""></option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}"
                        {{ old('client_id') && old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="date" class="form-label"><b>Return Date</b></label>
            <input type="text" class="form-control date_picker" id="date" name="date" required
                placeholder="Return Date" value="{{ date('d-m-Y', strtotime(old('date'))) }}">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="return_no" class="form-label"><b>Return No</b></label>
            <input type="text" class="form-control" id="return_no" name="return_no" required placeholder="Return No"
                value="{{ $return_no }}" readonly>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Store</b></label>
            <select name="store_id" id="store_id" class="select form-select" data-placeholder="Select Store" required>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}"
                        {{ old('store_id') && old('store_id') == $store->id ? 'selected' : '' }}>{{ $store->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="remarks" class="form-label"><b>Return Reason</b></label>
            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Return Reason">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select name="product_id" id="product_id" class="select form-select" data-placeholder="Select Proudcts">
                <option value=""></option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="sales_list_id" class="form-label"><b>Variant</b></label>
            <select name="sales_list_id" id="sales_list_id" class="select form-select" data-placeholder="Select Variant">
                <option value=""></option>
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label class="form-label text-white"><b>Add</b></label>
            <button type="button" class="btn btn-xs btn-primary w-100 px-2 py-2" id="add_item">Add Product</button>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped target-table align-middle mb-0">
                    <thead class="bg-primary border-primary text-white align-middle">
                        <tr>
                            <th class="py-1 text-center" width="40">SL#</th>
                            <th class="py-1">Product Name</th>
                            <th class="py-1">Variant</th>
                            <th class="py-1">Invoice</th>
                            <th class="py-1 text-center" width="120">Sales Qty</th>
                            <th class="py-1 text-center" width="120">Returned Qty</th>
                            <th class="py-1 text-center" width="120">Current Return</th>
                            <th class="py-1 text-center" width="120">Rate</th>
                            <th class="py-1 text-center" width="120">Amount</th>
                            <th class="py-1 text-center" width="60">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
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
            }).datepicker('setDate', 'today');

            $(document).on('change', '#client_id', function(e) {
                $('#tbody').html('');
            });

            $(document).on('change', '#product_id', function(e) {
                $('#sales_list_id option').remove();
                let client_id = $('#client_id').val();
                let product_id = $('#product_id').val();
                let url = "{{ Route('admin.lifestyle-product-return.create') }}";
                if (client_id == '') {
                    Swal.fire({
                        width: "22rem",
                        title: "Error!",
                        text: "Please select a client!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#product_id').val('');
                    $('.select').select2({
                        allowClear: true,
                    });
                    return;
                }
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        client_id: client_id,
                        product_id: product_id,
                        get_variant: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#sales_list_id').append('<option value=""></option>');
                            if (response.variants.length > 0) {
                                response.variants.forEach(function(item, index) {
                                    var option =
                                        `<option value="${item.id}">Invoice-${item.sales.invoice}, variant - ${item.variant.sku} qty - ${item.qty - item.returned_qty} </option>`;
                                    $('#sales_list_id').append(option);
                                });
                            }
                        }
                    }
                });
            });

            $(document).on('click', '#add_item', function(e) {
                var sales_list_id = $('#sales_list_id').val();
                let url = "{{ Route('admin.lifestyle-product-return.create') }}";
                if (sales_list_id == '') {
                    Swal.fire({
                        width: "22rem",
                        title: "Error!",
                        text: "Please select a variant!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }

                if ($('#row_' + sales_list_id).length) {
                    Swal.fire({
                        width: "22rem",
                        title: "Error!",
                        text: "Item Already Exists!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        sales_list_id: sales_list_id,
                        add_item: true,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            var sl = $('#tbody tr').length + 1;
                            var option = `
                                <tr id="row_${response.data.id}">
                                    <td class="text-center"><b>${sl}</b></td>
                                    <td>${response.data.product.name}</td>
                                    <td>${response.data.variant.sku}</td>
                                    <td>${response.data.sales.invoice}</td>
                                    <td>
                                        <input type="number" style="width: 120px;" class="form-control text-center" name="sales_qty[${response.data.id}]" value="${response.data.qty}" step="1" readonly required>
                                    </td>
                                    <td>
                                        <input type="number" style="width: 120px;" class="form-control text-center" name="returned_qty[${response.data.id}]" value="${response.data.returned_qty}" step="1" readonly required>
                                    </td>
                                    <td>
                                        <input type="number" style="width: 120px;" class="form-control text-center" name="return_qty[${response.data.id}]" min="1" value="0" max="${response.data.qty - response.data.returned_qty}" step="1" required>
                                    </td>
                                    <td class="text-center" width="120">${response.data.rate}</td>
                                    <td class="text-center" width="120">${response.data.amount}</td>
                                    <td class="text-center">
                                        <input type="hidden" name="sales_list_id[]" value="${response.data.id}">
                                        <button type="button" class="btn btn-xs remove_item" data-id="${response.data.id}"><i class="fal fa-times"></i></button>
                                    </td>
                                </tr>`;
                            $('#tbody').append(option);
                        }
                    }
                });
            });

            $(document).on('click', '.remove_item', function(e) {
                $(this).closest('tr').remove();
                $('#tbody tr').each(function(index, value) {
                    $(this).find('td:first-child b').text(index + 1);
                });
            });
        });
    </script>
@endpush
