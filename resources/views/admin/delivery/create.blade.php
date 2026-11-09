@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="serial_no" class="form-label"><b>Gate Pass No <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" name="serial_no" id="serial_no" value="{{ $serial_no }}" readonly
                placeholder="Gate Pass No." required>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="date" class="form-label"><b>Prepare Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="date" name="date"
                value="{{ date('d-m-Y', strtotime(old('date'))) }}" placeholder="Prepare Date" required>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="vehicle_id" class="form-label"><b>Vehicle Number <span class="text-danger">*</span></b></label>
            <select name="vehicle_id" id="vehicle_id" class="select form-select" data-placeholder="Select Vehicle" required>
                <option value=""></option>
                @foreach ($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}"
                        {{ old('vehicle_id') && old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                        {{ $vehicle->registration_no }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="driver_id" class="form-label"><b>Driver <span class="text-danger">*</span></b></label>
            <select name="driver_id" id="driver_id" class="select form-select" data-placeholder="Select Driver" required>
                <option value=""></option>
                @foreach ($drivers as $driver)
                    <option value="{{ $driver->id }}"
                        {{ old('driver_id') && old('driver_id') == $driver->id ? 'selected' : '' }}>{{ $driver->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="delivery_man_id" class="form-label"><b>Delivery Man <span class="text-danger">*</span></b></label>
            <select name="delivery_man_id" id="delivery_man_id" class="select form-select"
                data-placeholder="Select Delivery Man" required>
                <option value=""></option>
                @foreach ($delivery_mans as $delivery_man)
                    <option value="{{ $delivery_man->id }}"
                        {{ old('delivery_man_id') && old('delivery_man_id') == $delivery_man->id ? 'selected' : '' }}>
                        {{ $delivery_man->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Store <span class="text-danger">*</span></b></label>
            <select name="store_id" id="store_id" class="select form-select" data-placeholder="Select Store" required>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}"
                        {{ old('store_id') && old('store_id') == $store->id ? 'selected' : '' }}>{{ $store->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-6">
            <label for="area_id" class="form-label"><b>Area</b></label>
            <select name="area_id" id="area_id" class="select form-select" data-placeholder="Select Area" multiple>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-6">
            <div class="table-responsive">
                <table class="table table-bordered align-middle target-table mb-0 table-sm">
                    <thead class="bg-primary text-white align-middle text-nowrap">
                        <tr>
                            <th class="p-0" width="40">
                                <button type="button" class="all_btn btn custom-add-btn" data-type="add-all"
                                    style="margin-bottom: -1px; margin-right: -1px;">
                                    <i class="fad fa-share-all"></i></button>
                            </th>
                            <th class="px-3">Invoice</th>
                            <th class="px-3">Client Name</th>
                            <th class="px-3">Product Name</th>
                            <th class="px-3">Code / Variant</th>
                            <th class="px-3 text-center" width="80">Qty</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($sales_list as $item)
                            <tr class="remove_tr" id="add_row_{{ $item->id }}" data-id="{{ $item->id }}"
                                data-type="add">
                                <td class="p-0"><button type="button" class="btn move_btn custom-add-btn"
                                        data-id="{{ $item->id }}" data-type="add"><i
                                            class="fas fa-caret-right"></i></button></td>
                                <td class="px-3">
                                    {{ @$item->sales->invoice }}
                                    <input type="hidden" class="invoice_{{ $item->id }}"
                                        value="{{ @$item->sales->invoice }}">
                                </td>
                                <td class="px-3">
                                    {{ @$item->client->name }}
                                    <input type="hidden" class="client_name_{{ $item->id }}"
                                        value="{{ @$item->client->name }}">
                                </td>
                                <td class="px-3">
                                    {{ @$item->product->name }}
                                    <input type="hidden" class="product_name_{{ $item->id }}"
                                        value="{{ @$item->product->name }}">
                                </td>
                                <td class="px-3 text-nowrap">
                                    {{ @$item->variant->sku ?? @$item->product->code }}
                                    <input type="hidden" class="product_code_{{ $item->id }}"
                                        value="{{ @$item->variant->sku ?? @$item->product->code }}">
                                </td>
                                <td class="px-3 text-center">
                                    {{ $item->qty }}
                                    <input type="hidden" class="qty_{{ $item->id }}" value="{{ $item->qty }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center p-0">
                                <button type="button" class="all_btn btn custom-add-btn" data-type="add-all">
                                    <i class="fad fa-share-all"></i></button>
                            </th>
                            <th colspan="4"></th>
                            <th class="text-center"><span id="total1">{{ $sales_list->sum('qty') }}</span></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="table-responsive">
                <table class="table table-bordered align-middle target-table mb-0 table-sm">
                    <thead class="bg-primary text-white align-middle text-nowrap">
                        <tr>
                            <th class="p-0" width="40">
                                <button type="button" class="all_btn btn custom-add-btn" data-type="remove-all"
                                    style="margin-bottom: -1px; margin-left: -1px;">
                                    <i class="fad fa-reply-all"></i></button>
                            </th>
                            <th class="px-3">Invoice</th>
                            <th class="px-3">Client Name</th>
                            <th class="px-3">Product Name</th>
                            <th class="px-3">Code / Variant</th>
                            <th class="px-3 text-center" width="80">Qty</th>
                        </tr>
                    </thead>
                    <tbody id="selected">
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center p-0">
                                <button type="button" class="all_btn btn custom-add-btn" data-type="remove-all">
                                    <i class="fad fa-reply-all"></i></button>
                            </th>
                            <th colspan="4"></th>
                            <th class="text-center"><span id="total2"></span></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="page-loader" id="loader" style="display: none;">
        <div class="loader-inner">
            <div class="lds-spinner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
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

            $(document).on('change', '#store_id', function(e) {
                $('tbody tr').remove();
                $('#total2').text(0.00);
                getSales();
            });

            $(document).on('change', '#area_id', function(e) {
                getSales();
            });

            function getSales() {
                $('.remove_tr').closest('tr').remove();
                var checked_list = [];
                $('.added_id').each(function(i) {
                    checked_list.push($(this).val());
                });

                let area_id = $('#area_id').val();
                let store_id = $('#store_id').val();
                let url = "{{ Route('admin.delivery.create') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        checked_list: checked_list,
                        area_id: area_id,
                        store_id: store_id,
                        get_sales: true,
                    },
                    beforeSend: function() {
                        $("#loader").fadeIn('slow');
                    },
                    complete: function() {
                        $("#loader").fadeOut('slow');
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            if (response.sales_list.length > 0) {
                                response.sales_list.forEach(function(item, index) {
                                    var tr =
                                        `<tr class="remove_tr" id="add_row_${item.id}" data-id="${item.id}"
                                            data-type="add">
                                            <td class="p-0"><button type="button" class="btn move_btn custom-add-btn"
                                                    data-id="${item.id}" data-type="add"><i
                                                        class="fas fa-caret-right"></i></button></td>
                                            <td class="px-3">
                                                ${item.invoice}
                                                <input type="hidden" class="invoice_${item.id}"
                                                    value="${item.invoice}">
                                            </td>
                                            <td class="px-3">
                                                ${item.client_name}
                                                <input type="hidden" class="client_name_${item.id}"
                                                    value="${item.client_name}">
                                            </td>
                                            <td class="px-3">
                                                ${ item.product_name }
                                                <input type="hidden" class="product_name_${item.id}"
                                                    value="${item.product_name}">
                                            </td>
                                            <td class="px-3 text-nowrap">
                                                ${ (item.sku ?? item.product_code) }
                                                <input type="hidden" class="product_code_${item.id}"
                                                    value="${(item.sku ?? item.product_code)}">
                                            </td>
                                            <td class="px-3 text-center">
                                                ${item.qty}
                                                <input type="hidden" class="qty_${item.id}" value="${item.qty}">
                                            </td>
                                        </tr>`;
                                    $('#tbody').append(tr);
                                });
                            }
                            $('#total1').text(response.total);
                        }
                    }
                });
            }

            function move(id, type) {
                let total1 = isNaN(parseFloat($('#total1').text())) ? 0 : parseFloat($('#total1').text());
                let total2 = isNaN(parseFloat($('#total2').text())) ? 0 : parseFloat($('#total2').text());
                let qty = parseFloat($('.qty_' + id).val());
                let invoice = $('.invoice_' + id).val();
                let client_name = $('.client_name_' + id).val();
                let product_code = $('.product_code_' + id).val();
                let product_name = $('.product_name_' + id).val();

                let html = `<tr class="${type}_tr" id="${type == 'add' ? 'remove' : 'add' }_row_${id}" data-type="${type == 'add' ? 'remove' : 'add' }" data-id="${id}">
                                <td class="p-0"><button type="button" class="btn move_btn custom-add-btn" id="btn_${id}"
                                        data-id="${id}" data-type="${type == 'add' ? 'remove' : 'add' }"><i
                                            class="fas fa-caret-${type == 'add' ? 'left' : 'right' }"></i></button></td>
                                <td class="px-3">
                                    ${invoice}
                                    <input type="hidden" class="invoice_${id}"
                                        value="${invoice}">
                                </td>
                                <td class="px-3">
                                    ${client_name}
                                    <input type="hidden" class="client_name_${id}"
                                        value="${client_name}">
                                </td>
                                <td class="px-3">
                                    ${product_name}
                                    <input type="hidden" class="product_name_${id}"
                                        value="${product_name}">
                                </td>
                                <td class="px-3 text-nowrap">
                                    ${product_code}
                                    <input type="hidden" class="product_code_${id}"
                                        value="${product_code}">
                                </td>
                                <td class="px-3 text-center">
                                    ${qty}
                                    <input type="hidden" class="qty_${id}"
                                        value="${qty}">
                                    <input type="hidden" name="${type == 'add' ? 'sales_list_id[]' : '' }" class="${type == 'add' ? 'added_id' : '' }"
                                        value="${id}">
                                </td>
                            </tr>`;

                if (type == 'add') {
                    $('#selected').prepend(html);
                    $('#total1').text(parseFloat(total1 - qty).toFixed(2));
                    $('#total2').text(parseFloat(total2 + qty).toFixed(2));
                } else {
                    $('#tbody').prepend(html);
                    $('#total1').text(parseFloat(total1 + qty).toFixed(2));
                    $('#total2').text(parseFloat(total2 - qty).toFixed(2));
                }
                $('#' + type + '_row_' + id).remove();
            }

            $(document).on('click', '.move_btn', function(e) {
                let id = $(this).data('id');
                let type = $(this).data('type');
                move(id, type);
            });

            $(document).on('click', '.all_btn', function(e) {
                let all_type = $(this).data('type');
                $("#loader").fadeIn();
                if (all_type == 'remove-all') {
                    $('.add_tr').each(function(index, value) {
                        let id = $(this).data('id');
                        let type = $(this).data('type');
                        move(id, type);
                    });
                } else {
                    $('.remove_tr').each(function(index, value) {
                        let id = $(this).data('id');
                        let type = $(this).data('type');
                        move(id, type);
                    });
                }
                $("#loader").fadeOut();
            });
        });
    </script>
@endpush
