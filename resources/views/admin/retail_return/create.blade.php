@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="retail_sale_id" class="form-label"><b>Retail Invoice <span class="text-danger">*</span></b></label>
            <select name="retail_sale_id" id="retail_sale_id" class="form-select" data-placeholder="Select Invoice" required>
                <option value=""></option>
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="date" class="form-label"><b>Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="date" name="date" placeholder="Return Date"
                value="{{ date('d-m-Y', strtotime(old('date', date('Y-m-d')))) }}" required>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="return_no" class="form-label"><b>Return No <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="return_no" name="return_no" placeholder="Return No"
                value="{{ $return_no }}" readonly required>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Store <span class="text-danger">*</span></b></label>
            <select name="store_id" id="store_id" class="select form-select" data-placeholder="Select Store" required>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                        {{ $store->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-8">
            <label for="remarks" class="form-label"><b>Return Reason</b></label>
            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Return Reason"
                value="{{ old('remarks') }}">
        </div>
        <div class="col-sm-4">
            <label for="return_amount" class="form-label"><b>Return Amount</b></label>
            <input type="number" class="form-control" id="return_amount" name="return_amount" placeholder="Return Amount"
                value="0" readonly required>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped target-table align-middle mb-0">
                    <thead class="bg-primary border-primary text-white align-middle">
                        <tr>
                            <th class="py-1">Product Name</th>
                            <th class="py-1">Invoice</th>
                            <th class="py-1 text-center" width="120">Sales Qty</th>
                            <th class="py-1 text-center" width="120">Returned Qty</th>
                            <th class="py-1 text-center" width="120">Current Return</th>
                            <th class="py-1 text-center" width="120">Rate</th>
                            <th class="py-1 text-center" width="120">Amount</th>
                            <th class="py-1 text-center" width="40">
                                <div class="custom-control custom-checkbox w-fit mx-auto d-inline">
                                    <input type="checkbox" class="custom-control-input" name="selectAll" id="checkAll">
                                    <label for="checkAll" class="custom-control-label"></label>
                                </div>
                            </th>
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
            });

            $('#retail_sale_id').select2({
                placeholder: 'Search items...',
                minimumInputLength: 2,
                ajax: {
                    url: '{{ request()->fullUrl() }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(item => ({
                                id: item.id,
                                text: item.client_name + ' - ' + item.invoice
                            }))
                        };
                    },
                    cache: true
                }
            });

            $(document).on('change', '#retail_sale_id', function(e) {
                $('#tbody').html('');
                let retail_sale_id = $('#retail_sale_id').val();
                if (retail_sale_id != '') {
                    $.ajax({
                        url: '{{ request()->fullUrl() }}',
                        type: "POST",
                        data: {
                            _method: 'GET',
                            retail_sale_id: retail_sale_id
                        },
                        success: (response) => {
                            if (response.status == 'success') {
                                var i = 1;
                                if (response.data.length > 0) {
                                    response.data.forEach(function(item, index) {
                                        var option = `
                                            <tr>
                                                <td>${item.product.name}</td>
                                                <td>${item.sales.invoice}</td>
                                                <td>
                                                    <input type="number" style="width: 120px;" class="form-control text-center" id="sales_qty${item.id}" name="sales_qty[${item.id}]" value="${item.qty}" step="any" readonly required>
                                                </td>
                                                <td>
                                                    <input type="number" style="width: 120px;" class="form-control text-center" id="returned_qty${item.id}" name="returned_qty[${item.id}]" value="${item.returned_qty}" step="any" readonly required>
                                                </td>
                                                <td>
                                                    <input type="number" style="width: 120px;" class="form-control text-center return_qty" id="return_qty${item.id}" name="return_qty[${item.id}]" value="0" max="${item.qty - item.returned_qty}" step="any" required>
                                                </td>
                                                <td class="text-center" width="120">
                                                    <input type="number" style="width: 120px;" class="form-control text-center" id="rate${item.id}" name="rate[${item.id}]" value="${item.rate - item.product_discount - item.discount}" step="any" readonly>
                                                </td>
                                                <td class="text-center" width="120">${item.amount}</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox w-fit mx-auto d-inline">
                                                        <input type="checkbox" class="custom-control-input multi_checkbox" name="retail_sale_list_id[]"
                                                            value="${item.id}" id="${item.id}">
                                                        <label for="${item.id}" class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                            </tr>`;
                                        $('#tbody').append(option);
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

                $('.multi_checkbox').each(function(index, value) {
                    var sale_id = $(this).val();
                    if ($(this).is(':checked')) {
                        var returnable_qty = +$('#return_qty' + sale_id).attr('max');
                        var return_qty = +$('#return_qty' + sale_id).val();
                        if (return_qty == 0) {
                            $('#return_qty' + sale_id).val(returnable_qty);
                        }
                    } else {
                        $('#return_qty' + sale_id).val(0);
                    }
                });
                calculate();
            });

            $(document).on('keyup', '.return_qty', function(e) {
                var qty = +$(this).val();
                if (qty > 0) {
                    $(this).closest('tr').find('.multi_checkbox').prop('checked', true);
                } else {
                    $(this).closest('tr').find('.multi_checkbox').prop('checked', false);
                }
                calculate();
            });

            $(document).on('change', '.multi_checkbox', function(e) {
                var sale_id = $(this).val();
                if ($(this).is(':checked')) {
                    var returnable_qty = +$('#return_qty' + sale_id).attr('max');
                    var return_qty = +$('#return_qty' + sale_id).val();
                    if (return_qty == 0) {
                        $('#return_qty' + sale_id).val(returnable_qty);
                    }
                } else {
                    $('#return_qty' + sale_id).val(0);
                }
                if ($('.multi_checkbox:checked').length == $('.multi_checkbox').length) {
                    $('#checkAll').prop('checked', true);
                } else {
                    $('#checkAll').prop('checked', false);
                }
                calculate();
            });

            function calculate() {
                var return_amount = 0;
                $('.multi_checkbox:checked').each(function(index, value) {
                    var sale_id = $(this).val();
                    return_amount += +$('#return_qty' + sale_id).val() * +$('#rate' + sale_id).val();

                });
                $('#return_amount').val(return_amount);
            }
        });
    </script>
@endpush
