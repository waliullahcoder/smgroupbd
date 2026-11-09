@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="client_id" class="form-label"><b>Client <span class="text-danger">*</span></b></label>
            <select name="client_id" id="client_id" class="select form-select" data-placeholder="Select Client" required>
                <option value=""></option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $data->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
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
            <label for="remarks" class="form-label"><b>Return Reason</b></label>
            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Return Reason"
                value="{{ $data->remarks }}">
        </div>
        <div class="col-12">
            <table class="table table-bordered table-striped target-table align-middle mb-0">
                <thead class="bg-primary border-primary text-white align-middle">
                    <tr>
                        {{-- <th>Client</th> --}}
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
                                <input type="checkbox" class="custom-control-input multi_checkbox" name="selectAll" checked
                                    id="checkAll">
                                <label for="checkAll" class="custom-control-label"></label>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @include('admin.sales_return.partial.table_rows');
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

            $(document).on('change', '#client_id, #product_id', function(e) {
                $('#tbody').html('');
                let client_id = $('#client_id').val();
                let product_id = $('#product_id').val();
                let collection_type = $('#collection_type').val();
                let url = "{{ Route('admin.sales-return.edit', $data->id) }}";
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
                            $('#tbody').html(response);
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
