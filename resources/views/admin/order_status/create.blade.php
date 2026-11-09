@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="delivery_man_id" class="form-label"><b>Delivery Man <span class="text-danger">*</span></b></label>
            <select name="delivery_man_id" id="delivery_man_id" class="select form-select"
                data-placeholder="Select Delivery Man" required>
                <option value=""></option>
                @foreach ($delivery_men as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="total_delivered_qty" class="form-label"><b>Total Delivered<span class="text-danger">*</span></b></label>
            <input type="text" id="total_delivered_qty" class="form-control" value="0" readonly>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="total_delivered_amount" class="form-label"><b>Total Delivered Amount <span class="text-danger">*</span></b></label>
            <input type="text" id="total_delivered_amount" class="form-control" value="0" readonly>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="total_qty" class="form-label"><b>Total Orders</b></label>
            <input type="text" id="total_qty" class="form-control" value="0" readonly>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="total_shipping" class="form-label"><b>Total Shipping Charge</b></label>
            <input type="text" id="total_shipping" class="form-control" value="0" readonly>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="total_amount" class="form-label"><b>Total Amount</b></label>
            <input type="text" id="total_amount" class="form-control" value="0" readonly>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="total_receivable" class="form-label"><b>Total Receivable</b></label>
            <input type="text" id="total_receivable" class="form-control" value="0" readonly>
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
                            <th class="py-1 text-center">Amount</th>
                            <th class="py-1 text-center">Delivery Charge</th>
                            <th class="py-1 text-center">Receivable</th>
                            <th class="py-1 text-center" width="120">Receive</th>
                            <th class="py-1 text-center" width="120">Status</th>
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
            $(document).on('change', '#delivery_man_id', function(e) {
                var delivery_man_id = $(this).val();
                $('#tbody').html('');

                $.ajax({
                    url: "{{ Route(request()->route()->getName()) }}",
                    type: "POST",
                    data: {
                        _method: 'GET',
                        delivery_man_id: delivery_man_id,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            var key = 1;
                            $.each(response.orders, function(key, item) {
                                var tr =
                                    `<tr data-id="${item.id}">
                                        <td class="text-center">${++key}</td>
                                        <td class="text-nowrap">${item.formattedDate}</td>
                                        <td>${item.invoice}</td>
                                        <td>${item.user_name}</td>
                                        <td>${item.user_phone}</td>
                                        <td>${item.area.name}</td>
                                        <td class="text-center">${item.sub_total}</td>
                                        <td class="text-center">${item.shipping_charge}</td>
                                        <td class="text-center">${item.due}</td>
                                        <td class="text-center">
                                            <input type="number" class="form-control text-center" style="min-height: auto; width: 110px;" step="any" id="receive_${item.id}" name="receive[${item.id}]" max="" value="0">
                                        </td>
                                        <td>
                                            <input type="hidden" id="due_${item.id}" value="${item.due}">
                                            <input type="hidden" name="order_id[]" value="${item.id}">
                                            <select class="form-select status" id="status_${item.id}" name="status[${item.id}]" style="min-width: 110px;font-size: 13px;min-height: auto; padding: 5px 10px;">
                                                <option value="On Route">On Route</option>
                                                <option value="Delivered">Delivered</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>
                                        </td>
                                    </tr>`;
                                $('#tbody').append(tr);
                            });
                            $('#total_qty').val(response.orders.length);
                            $('#total_shipping').val(response.total_shipping);
                            $('#total_amount').val(response.total_amount);
                            $('#total_receivable').val(response.total_receivable);
                        }
                    }
                });
            });

            $(document).on('change', '.status', function() {
                calc();
            });

            function calc() {
                var total_delivered_amount = 0;
                var total_delivered = 0;
                $('#tbody tr').each(function(index, value) {
                    var order_id = $(this).data('id');
                    status = $('#status_' + order_id).val();
                    $('#receive_' + order_id).val(0);
                    if (status == 'Delivered') {
                        total_delivered++
                        var amount = +$('#due_' + order_id).val();
                        total_delivered_amount += amount;
                        $('#receive_' + order_id).val(amount);
                        $('#receive_' + order_id).attr('max', amount);
                    }
                });
                $('#total_delivered_amount').val(total_delivered_amount);
                $('#total_delivered_qty').val(total_delivered);
            }

        });
    </script>
@endpush
