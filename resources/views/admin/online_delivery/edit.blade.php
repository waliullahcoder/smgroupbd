@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="serial_no" class="form-label"><b>Gate Pass No <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" name="serial_no" id="serial_no" value="{{ $data->serial_no }}" readonly
                placeholder="Gate Pass No." required>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="date" class="form-label"><b>Prepare Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="date" name="date"
                value="{{ date('d-m-Y', strtotime(old('date'))) }}" placeholder="Prepare Date" required>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="vehicle_id" class="form-label"><b>Vehicle Number <span class="text-danger">*</span></b></label>
            <select name="vehicle_id" id="vehicle_id" class="select form-select" data-placeholder="Select Vehicle" required>
                <option value=""></option>
                @foreach ($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ $data->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                        {{ $vehicle->registration_no }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="driver_id" class="form-label"><b>Driver <span class="text-danger">*</span></b></label>
            <select name="driver_id" id="driver_id" class="select form-select" data-placeholder="Select Driver" required>
                <option value=""></option>
                @foreach ($drivers as $driver)
                    <option value="{{ $driver->id }}" {{ $data->driver_id == $driver->id ? 'selected' : '' }}>
                        {{ $driver->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="delivery_man_id" class="form-label"><b>Delivery Man <span class="text-danger">*</span></b></label>
            <select name="delivery_man_id" id="delivery_man_id" class="select form-select"
                data-placeholder="Select Delivery Man" required>
                <option value=""></option>
                @foreach ($delivery_mans as $delivery_man)
                    <option value="{{ $delivery_man->id }}"
                        {{ $data->delivery_man_id == $delivery_man->id ? 'selected' : '' }}>
                        {{ $delivery_man->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Store</b></label>
            <select name="store_id" id="store_id" class="select form-select" data-placeholder="Select Store">
                <option value=""></option>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}">
                        {{ $store->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <table class="table table-bordered align-middle target-table mb-0">
                <thead class="bg-primary text-white align-middle">
                    <th class="px-3">Order ID</th>
                    <th class="px-3">Customer Name</th>
                    <th class="px-3">Customer Phone</th>
                    <th class="px-3">Amount</th>
                    <th class="px-3">Discount</th>
                    <th width="60">
                        <div class="custom-control custom-checkbox w-fit mx-auto">
                            <input type="checkbox" class="custom-control-input multi_checkbox" name="selectAll" checked
                                id="checkAll">
                            <label for="checkAll" class="custom-control-label"></label>
                        </div>
                    </th>
                </thead>
                <tbody id="tbody">
                    @foreach ($data->list as $item)
                        <tr>
                            <td class="px-3">{{ $item->order->order_code }}</td>
                            <td class="px-3">{{ $item->order->user_name }}</td>
                            <td class="px-3">{{ $item->order->user_phone }}</td>
                            <td class="px-3">{{ $item->order->total }}</td>
                            <td class="px-3">{{ $item->order->discount }}</td>
                            <td class="px-3">
                                <div class="custom-control custom-checkbox w-fit mx-auto">
                                    <input type="checkbox" class="custom-control-input multi_checkbox" name="order_id[]"
                                        value="{{ $item->order_id }}" id="{{ $item->order_id }}" checked>
                                    <label for="{{ $item->order_id }}" class="custom-control-label"></label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
            }).datepicker('setDate', 'today');

            $(document).on('change', '#store_id', function(e) {
                $('#tbody tr').remove();
                $('#checkAll').prop('checked', false);
                let store_id = $('#store_id').val();
                let url = "{{ Route('admin.online-order-delivery.edit', $data->id) }}";
                if (store_id != '') {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _method: 'GET',
                            store_id: store_id,
                            get_orders: true,
                        },
                        success: (response) => {
                            if (response.status == 'success') {
                                if (response.orders.length > 0) {
                                    response.orders.forEach(function(item, index) {
                                        var tr =
                                            `<tr>
                                                <td class="px-3">${item.order_code}</td>
                                                <td class="px-3">${item.user_name}</td>
                                                <td class="px-3">${item.user_phone}</td>
                                                <td class="px-3">${item.total}</td>
                                                <td class="px-3">${item.discount}</td>
                                                <td class="px-3">
                                                    <div class="custom-control custom-checkbox w-fit mx-auto">
                                                        <input type="checkbox" class="custom-control-input multi_checkbox" name="order_id[]" value="${item.id}" id="${item.id}">
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
        });
    </script>
@endpush
