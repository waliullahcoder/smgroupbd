@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="client_id" class="form-label"><b>Client <span class="text-danger">*</span></b></label>
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
            <label for="date" class="form-label"><b>Return Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="date" name="date" placeholder="Return Date"
                value="{{ date('d-m-Y', strtotime(old('date'))) }}" required>
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
                    <option value="{{ $store->id }}"
                        {{ old('store_id') && old('store_id') == $store->id ? 'selected' : '' }}>{{ $store->name }}
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
            <label for="remarks" class="form-label"><b>Return Reason</b></label>
            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Return Reason">
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped target-table align-middle mb-0">
                    <thead class="bg-primary border-primary text-white align-middle">
                        <tr>
                            {{-- <th class="py-1">Client</th> --}}
                            <th class="py-1">Product Name</th>
                            <th class="py-1">Code</th>
                            <th class="py-1">Invoice</th>
                            <th class="py-1 text-center" width="120">Sales Qty</th>
                            <th class="py-1 text-center" width="120">Returned Qty</th>
                            <th class="py-1 text-center" width="120">Current Return</th>
                            <th class="py-1 text-center" width="120">Rate</th>
                            <th class="py-1 text-center" width="120">Amount</th>
                            <th class="py-1" width="60">
                                <div class="custom-control custom-checkbox w-fit mx-auto">
                                    <input type="checkbox" class="custom-control-input multi_checkbox" name="selectAll"
                                        id="checkAll">
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
            }).datepicker('setDate', 'today');

            $(document).on('change', '#client_id, #product_id', function(e) {
                $('#tbody').html('');
                let client_id = $('#client_id').val();
                let product_id = $('#product_id').val();
                let collection_type = $('#collection_type').val();
                let url = "{{ Route('admin.sales-return.create') }}";
                if (client_id != '') {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _method: 'GET',
                            client_id: client_id,
                            product_id: product_id,
                        },
                        success: (response) => {
                            if (response.status == 'success') {
                                $('#balance').val(response.balance);
                                var i = 1;
                                if (response.data.length > 0) {
                                    response.data.forEach(function(item, index) {
                                        var option = `
                                            <tr>
                                                <td>${item.product.name}</td>
                                                <td>${item.product.code}</td>
                                                <td>${item.sales.invoice}</td>
                                                <td>
                                                    <input type="number" style="width: 120px;" class="form-control text-center" name="sales_qty[${item.id}]" value="${item.qty}" step="any" readonly required>
                                                </td>
                                                <td>
                                                    <input type="number" style="width: 120px;" class="form-control text-center" name="returned_qty[${item.id}]" value="${item.returned_qty}" step="any" readonly required>
                                                </td>
                                                <td>
                                                    <input type="number" style="width: 120px;" class="form-control text-center" name="return_qty[${item.id}]" value="0" max="${item.qty - item.returned_qty}" step="any" required>
                                                </td>
                                                <td class="text-center" width="120">${item.rate}</td>
                                                <td class="text-center" width="120">${item.amount}</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox w-fit mx-auto">
                                                        <input type="checkbox" class="custom-control-input multi_checkbox" name="sales_list_id[]"
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
            });
        });
    </script>
@endpush
