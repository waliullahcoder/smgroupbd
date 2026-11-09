@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Store</b></label>
            <select name="store_id" id="store_id" class="select form-select" data-placeholder="Select Store">
                <option value=""></option>
                @foreach ($stores as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="delivery_man_id" class="form-label"><b>Delivery Man</b></label>
            <select name="delivery_man_id" id="delivery_man_id" class="select form-select"
                data-placeholder="Select Delivery Man">
                <option value=""></option>
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="collected_at" class="form-label"><b>Date <span class="text-danger">*</span></b></label>
            <input type="text" id="collected_at" name="collected_at" class="form-control date_picker"
                value="{{ date('d-m-Y') }}">
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="total_qty" class="form-label"><b>Total Orders <span class="text-danger">*</span></b></label>
            <input type="text" id="total_qty" class="form-control" value="0" readonly>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="total_amount" class="form-label"><b>Total Amount <span class="text-danger">*</span></b></label>
            <input type="text" id="total_amount" class="form-control" value="0" readonly>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped target-table align-middle mb-0">
                    <thead class="bg-primary border-primary text-white align-middle text-nowrap">
                        <tr>
                            <th class="py-1 text-center" width="30">SL.</th>
                            <th class="py-1">Date</th>
                            <th class="py-1">Invoice No</th>
                            <th class="py-1">Customer Name</th>
                            <th class="py-1">Phone</th>
                            <th class="py-1">Area</th>
                            <th class="py-1">Address</th>
                            <th class="py-1 text-center">Amount</th>
                            <th class="py-1" width="60">
                                <div class="custom-control custom-checkbox w-fit mx-auto">
                                    <input type="checkbox" class="custom-control-input" name="selectAll" id="checkAll">
                                    <label for="checkAll" class="custom-control-label"></label>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($orders as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->formattedDate }}</td>
                                <td>{{ $item->invoice }}</td>
                                <td>{{ $item->user_name }}</td>
                                <td>{{ $item->user_phone }}</td>
                                <td>{{ @$item->area->name }}</td>
                                <td>{{ $item->shipping_address }}</td>
                                <td class="text-center">{{ $item->due }}</td>
                                <td>
                                    <input type="hidden" id="due_{{ $item->id }}" name="due[{{ $item->id }}]"
                                        value="{{ $item->due }}">
                                    <div class="custom-control custom-checkbox w-fit mx-auto">
                                        <input type="checkbox" class="custom-control-input order_id" name="order_id[]"
                                            value="{{ $item->id }}" id="order_id{{ $item->id }}">
                                        <label for="order_id{{ $item->id }}" class="custom-control-label"></label>
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
            $(document).on('change', '#store_id', function(e) {
                var store_id = $(this).val();
                $('#tbody').html('');
                $('#delivery_man_id option').remove();

                $.ajax({
                    url: "{{ Route(request()->route()->getName()) }}",
                    type: "POST",
                    data: {
                        _method: 'GET',
                        store_id: store_id,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            var key = 1;
                            $.each(response.orders, function(key, item) {
                                var tr =
                                    `<tr>
                                        <td class="text-center">${++key}</td>
                                        <td>${item.formattedDate}</td>
                                        <td>${item.invoice}</td>
                                        <td>${item.user_name}</td>
                                        <td>${item.user_phone}</td>
                                        <td>${item.area.name}</td>
                                        <td>${item.shipping_address}</td>
                                        <td class="text-center">${item.due}</td>
                                        <td>
                                            <input type="hidden" id="due_${item.id}" name="due[${item.id}]"
                                                value="${item.due}">
                                            <div class="custom-control custom-checkbox w-fit mx-auto">
                                                <input type="checkbox" class="custom-control-input order_id" name="order_id[]"
                                                    value="${item.id}" id="order_id${item.id}">
                                                <label for="order_id${item.id}" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                    </tr>`;
                                $('#tbody').append(tr);
                            });

                            $('#delivery_man_id').append('<option value=""></option>');
                            $.each(response.delivery_men, function(key, item) {
                                $('#delivery_man_id').append(
                                    `<option value="${item.id}">${item.name}</option>`
                                );
                            });
                        }
                    }
                });
                calc();
            });

            $(document).on('change', '#delivery_man_id', function(e) {
                var delivery_man_id = $(this).val();
                var store_id = $('#store_id').val();
                $('#tbody').html('');

                $.ajax({
                    url: "{{ Route(request()->route()->getName()) }}",
                    type: "POST",
                    data: {
                        _method: 'GET',
                        store_id: store_id,
                        delivery_man_id: delivery_man_id,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            var key = 1;
                            $.each(response.orders, function(key, item) {
                                var tr =
                                    `<tr>
                                        <td class="text-center">${++key}</td>
                                        <td>${item.formattedDate}</td>
                                        <td>${item.invoice}</td>
                                        <td>${item.user_name}</td>
                                        <td>${item.user_phone}</td>
                                        <td>${item.area.name}</td>
                                        <td>${item.shipping_address}</td>
                                        <td class="text-center">${item.due}</td>
                                        <td>
                                            <input type="hidden" id="due_${item.id}" name="due[${item.id}]"
                                                value="${item.due}">
                                            <div class="custom-control custom-checkbox w-fit mx-auto">
                                                <input type="checkbox" class="custom-control-input order_id" name="order_id[]"
                                                    value="${item.id}" id="order_id${item.id}">
                                                <label for="order_id${item.id}" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                    </tr>`;
                                $('#tbody').append(tr);
                            });
                        }
                    }
                });
                calc();
            });

            $(document).on('change', '#checkAll', function(e) {
                if ($(this).is(':checked')) {
                    $('.order_id').prop('checked', true);
                } else {
                    $('.order_id').prop('checked', false);
                }
                calc();
            });

            $(document).on('change', '.order_id', function(e) {
                if ($('.order_id:checked').length == $('.order_id').length) {
                    $('#checkAll').prop('checked', true);
                } else {
                    $('#checkAll').prop('checked', false);
                }
                calc();
            });

            function calc() {
                var total_amount = 0;
                $('.order_id:checked').each(function(index, value) {
                    var order_id = $(this).val();
                    total_amount += +$('#due_' + order_id).val();
                });
                $('#total_amount').val(total_amount.toFixed(2));
                $('#total_qty').val($('.order_id:checked').length);
            }

            $(document).on('submit', '#store_form', function(e) {
                if ($('.order_id:checked').length == 0) {
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
