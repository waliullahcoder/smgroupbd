@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="vendor_id" class="form-label"><b>Client <span class="text-danger">*</span></b></label>
            <select name="vendor_id" id="vendor_id" class="select form-select" data-placeholder="Select Client" required>
                <option value=""></option>
                @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}" {{ $data->vendor_id == $vendor->id ? 'selected' : '' }}>
                        {{ $vendor->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="date" class="form-label"><b>Return Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="date" name="date" placeholder="Return Date"
                value="{{ date('d-m-Y', strtotime($data->date)) }}" required>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="return_no" class="form-label"><b>Return No <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="return_no" name="return_no" placeholder="Return No"
                value="{{ $data->return_no }}" readonly required>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Store <span class="text-danger">*</span></b></label>
            <select name="store_id" id="store_id" class="select form-select" data-placeholder="Select Store" required>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}" {{ $data->store_id == $store->id ? 'selected' : '' }}>
                        {{ $store->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select name="product_id" id="product_id" class="select form-select" data-placeholder="Select Proudcts"
                multiple>
                <option value=""></option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }} ({{ $product->code }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="remarks" class="form-label"><b>Return Reason <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Return Reason"
                value="{{ $data->remarks }}" required>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped target-table align-middle mb-0">
                    <thead class="bg-primary border-primary text-white align-middle text-nowrap">
                        <tr>
                            <th class="py-1">Vendor</th>
                            <th class="py-1">Product Name</th>
                            <th class="py-1" id="changeable_text">Code</th>
                            <th class="py-1">Lifting No</th>
                            <th class="py-1 text-center">Lifting Qty</th>
                            <th class="py-1 text-center">Returned Qty</th>
                            <th class="py-1 text-center">Current Return</th>
                            <th class="py-1 text-center">Rate</th>
                            <th class="py-1 text-center">Amount</th>
                            <th class="py-1 text-center" width="60">
                                <div class="custom-control custom-checkbox w-fit d-inline">
                                    <input type="checkbox" class="custom-control-input" name="selectAll" id="checkAll"
                                        checked>
                                    <label for="checkAll" class="custom-control-label"></label>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($data->list as $key => $item)
                            <tr>
                                <td>{{ $item->vendor->name }}</td>
                                <td>{{ @$item->lifting_product->product->name }}</td>
                                <td>{{ @$item->lifting_product->product->code }}</td>
                                <td>{{ $item->lifting_product->lifting->lifting_no }}</td>
                                <td>
                                    <input type="number" style="width: 120px;" class="form-control mx-auto text-center"
                                        step="any" name="lifting_qty[{{ $item->lifting_product->id }}]"
                                        value="{{ $item->lifting_product->qty }}" readonly>
                                </td>
                                <td>
                                    <input type="number" style="width: 120px;" class="form-control mx-auto text-center"
                                        step="any" name="returned_qty[{{ $item->lifting_product->id }}]"
                                        value="{{ $item->lifting_product->return_qty - $item->qty }}" readonly>
                                </td>
                                <td>
                                    <input type="number" style="width: 120px;" class="form-control mx-auto text-center"
                                        step="any" name="return_qty[{{ $item->lifting_product->id }}]"
                                        value="{{ $item->qty }}"
                                        max="{{ $item->lifting_product->qty + $item->qty - $item->lifting_product->return_qty }}"
                                        required>
                                </td>
                                <td class="text-center" width="120">{{ $item->lifting_price }}</td>
                                <td class="text-center" width="120">
                                    {{ round($item->lifting_product->total_amount - $item->lifting_product->discount, 2) }}
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox w-fit mx-auto">
                                        <input type="checkbox" class="custom-control-input multi_checkbox"
                                            name="lifting_product_id[]" value="{{ $item->lifting_product->id }}"
                                            id="{{ $item->lifting_product->id }}" checked>
                                        <label for="{{ $item->lifting_product->id }}"
                                            class="custom-control-label"></label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
            });

            $(document).on('change', '#vendor_id', function(e) {
                $('#tbody').html('');
                $('#product_id option').remove();
                $('#checkAll').prop('checked', false);
                let vendor_id = $('#vendor_id').val();
                let url = "{{ Route('admin.lifting-return.edit', $data->id) }}";

                if (vendor_id != '') {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _method: 'GET',
                            vendor_id: vendor_id,
                            get_products: true,
                        },
                        success: (response) => {
                            if (response.status == 'success') {
                                $('#product_id').append(`<option value=""></option>`);
                                if (response.products.length > 0) {
                                    response.products.forEach(function(item, index) {
                                        $('#product_id').append(
                                            `<option value="${item.id}">${item.name}</option>`
                                        );
                                    });
                                }
                            }
                        }
                    });
                }
            });

            $(document).on('change', '#product_id', function(e) {
                $('#tbody').html('');
                $('#checkAll').prop('checked', false);
                let vendor_id = $('#vendor_id').val();
                let product_id = $('#product_id').val();
                let url = "{{ Route('admin.lifting-return.edit', $data->id) }}";

                if (vendor_id != '' && product_id != '') {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _method: 'GET',
                            vendor_id: vendor_id,
                            product_id: product_id,
                        },
                        success: (response) => {
                            if (response.status == 'success') {
                                if (response.data.length > 0) {
                                    response.data.forEach(function(item, index) {
                                        var tr = `
                                            <tr>
                                                <td>${item.vendor.name}</td>
                                                <td>${item.product.name}</td>
                                                <td>${item.product.code}</td>
                                                <td>${item.lifting.lifting_no}</td>
                                                <td>
                                                    <input type="number" style="width: 120px;" class="form-control text-center mx-auto" name="lifting_qty[${item.id}]" step="any" value="${item.qty}" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" style="width: 120px;" class="form-control text-center mx-auto" name="returned_qty[${item.id}]" step="any" value="${item.return_qty}" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" style="width: 120px;" class="form-control text-center mx-auto" name="return_qty[${item.id}]" step="any" max="${parseFloat(item.remaining_qty)}"
                                                        value="${parseFloat(item.current_return_qty ?? 0)}" required>
                                                </td>
                                                <td class="text-center" width="120">${item.lifting_price}</td>
                                                <td class="text-center" width="120">${(parseFloat(item.total_amount) - parseFloat(item.discount)).toFixed(2)}</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox w-fit mx-auto">
                                                        <input type="checkbox" class="custom-control-input multi_checkbox" name="lifting_product_id[]"
                                                            value="${item.id}" id="${item.id}">
                                                        <label for="${item.id}" class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                            </tr>`;
                                        $('#tbody').append(tr);
                                    });
                                }
                            }
                        }
                    });
                }
            });

            $(document).on('change', '#checkAll', function(e) {
                if ($(this).is(':checked')) {
                    $('.multi_checkbox').prop('checked', true);
                } else {
                    $('.multi_checkbox').prop('checked', false);
                }
            });

            $(document).on('submit', '#update_form', function(e) {
                if ($('.multi_checkbox:checked').length == 0) {
                    e.preventDefault();
                    Swal.fire({
                        width: "22rem",
                        title: "Error!",
                        text: "Please select a Item",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });
    </script>
@endpush
