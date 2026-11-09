@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-sm-8 col-9">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select id="product_id" class="select form-select" data-placeholder="Select Product">
                <option value=""></option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->vendor->name }} - {{ $product->name }}
                        ({{ $product->code }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4 col-3">
            <label for="quantity" class="form-label"><b>Quantity</b></label>
            <input type="number" class="form-control" id="quantity" placeholder="Quantity">
        </div>
        <div class="col-12 text-end">
            <button type="button" class="btn btn-xs btn-primary mnw-auto px-2" id="add_item">Add Product</button>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped target-table align-middle mb-0">
                    <thead class="bg-primary border-primary text-white">
                        <tr>
                            <th class="px-2 py-5px text-center" width="40">SL#</th>
                            <th class="px-2 py-5px">Product</th>
                            <th class="px-2 py-5px">Qty</th>
                            <th class="px-2 py-5px text-center" width="50"><i class="far fa-trash-alt"></i></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                    <tfoot class="bg-primary text-white border-primary">
                        <tr>
                            <td class="text-end" colspan="2">
                                <b>Total Qty</b>
                            </td>
                            <td colspan="2">
                                <input type="number" readonly id="total_qty" name="total_qty" class="form-control"
                                    value="0">
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@php
    $currentRouteName = \Request::route()->getName();
    $link = Route($currentRouteName);
@endphp

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
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
                    $.ajax({
                        url: "{{ $link }}",
                        type: "POST",
                        data: {
                            _method: 'GET',
                            product_id: product_id,
                        },
                        success: (response) => {
                            if (response.status == 'success') {
                                var tr =
                                    `<tr id="product_${ response.product.id }">
                                    <td class="px-2 py-5px text-center" width="40"><b>${ (existing_key + 1)}</b></td>
                                    <td class="px-2 py-5px" style="min-width: 100px;">
                                        <input type="hidden" name="product_id[${ existing_key }]" value="${ response.product.id }">
                                        ${ response.product.name } (${ response.product.code })
                                    </td>
                                    <td class="px-2 py-5px"><input type="number" name="quantity[${existing_key }]" class="form-control quantity" value="${qty }" required></td>
                                    <td class="px-2 py-5px text-center"><button type="button" class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2"><i class="far fa-trash-alt"></i></button></td>
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

            $(document).on('wheel keyup change', '.quantity', function(e) {
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
