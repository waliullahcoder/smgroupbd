@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <input type="hidden" name="print" value="">
        <input type="hidden" name="filter" value="1">
        {{-- <div class="col-md-3 col-sm-6">
            <label for="product_type" class="form-label"><b>Product Type</b></label>
            <select name="product_type" id="product_type" class="form-select select" data-placeholder="Select Product Type"
                required>
                <option value="Consumer" {{ request('product_type') == 'Consumer' ? 'selected' : '' }}>Consumer</option>
                <option value="Fashion" {{ request('product_type') == 'Fashion' ? 'selected' : '' }}>Fashion</option>
            </select>
        </div> --}}
        <div class="col-md-3 col-sm-6">
            <label for="store_id" class="form-label"><b>Store</b></label>
            <select name="store_id[]" id="store_id" class="form-select select" data-placeholder="Select Store" multiple>
                <option value=""></option>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}"
                        {{ is_array($store_id) && in_array($store->id, $store_id) ? 'selected' : '' }}>
                        {{ $store->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="category_id" class="form-label"><b>Category</b></label>
            <select name="category_id[]" id="category_id" class="form-select select" data-placeholder="Select Category"
                multiple>
                <option value=""></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ is_array($category_id) && in_array($category->id, $category_id) ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        {{-- <div class="col-md-3 col-sm-6">
            <label for="date_range" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y" data-separator=" to "
                autocomplete="off" required
                value="{{ !is_null($start_date) && !is_null($end_date) ? date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date)) : date('d-m-Y') . ' to ' . date('d-m-Y') }}">
        </div> --}}
        <div class="col-sm-6">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select name="product_id[]" id="product_id" class="form-select select" data-placeholder="Select Products"
                multiple>
                <option value=""></option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}"
                        {{ is_array($product_id) && in_array($product->id, $product_id) ? 'selected' : '' }}>
                        {{ $product->name }} ({{ $product->code }})</option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-sm">
            <thead class="text-nowrap">
                <tr>
                    <th class="px-3 text-center" width="20">SL#</th>
                    <th class="px-3">Product Name</th>
                    <th class="px-3">Product Code</th>
                    <th class="px-3">UOM</th>
                    {{-- <th class="px-3 text-center" width="90">Opening</th> --}}
                    {{-- <th class="px-3 text-center" width="90">Lifting</th>
                    <th class="px-3 text-center" width="90">Lifting Return</th>
                    <th class="px-3 text-center">Sales</th>
                    <th class="px-3 text-center">Sales Return</th>
                    <th class="px-3 text-center" width="90">Transfer</th>
                    <th class="px-3 text-center" width="90">Received</th>
                    <th class="px-3 text-center" width="90">Retail Sales</th>
                    <th class="px-3 text-center" width="90">Retail Returns</th>
                    <th class="px-3 text-center" width="90">Online Delivery</th> --}}
                    <th class="px-3 text-center" width="90">Stock Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $key = 1;
                    use Carbon\Carbon;
                @endphp
                @if (isset($data['stocks']) && count($data['stocks']) > 0)
                    @foreach ($data['stocks'] as $row)
                        {{-- @php
                            $start = Carbon::parse($data['start_date']);
                            $end = Carbon::parse($data['end_date']);
                            $store_ids = (array) $data['store_id'];
                            $pid = $row->product_id;

                            $opening_liftings = $data['liftings']
                                ->where('product_id', $pid)
                                ->filter(fn($item) => Carbon::parse($item->date)->lt($start))
                                ->sum('qty');

                            $opening_lifting_returns = $data['lifting_returns']
                                ->where('product_id', $pid)
                                ->filter(fn($item) => Carbon::parse($item->date)->lt($start))
                                ->sum('qty');

                            $opening_sales = $data['sales']
                                ->where('product_id', $pid)
                                ->filter(fn($item) => Carbon::parse($item->date)->lt($start))
                                ->sum('qty');

                            $opening_sales_returns = $data['sales_returns']
                                ->where('product_id', $pid)
                                ->filter(fn($item) => Carbon::parse($item->date)->lt($start))
                                ->sum('qty');

                            $opening_online_sales = $data['online_sales']
                                ->where('product_id', $pid)
                                ->filter(fn($item) => Carbon::parse($item->date)->lt($start))
                                ->sum('qty');

                            $opening_transfers = $data['transfer_or_receives']
                                ->where('product_id', $pid)
                                ->filter(
                                    fn($item) => isset($item->host_id, $item->date) &&
                                        in_array($item->host_id, $store_ids) &&
                                        Carbon::parse($item->date)->lt($start),
                                )
                                ->sum('qty');

                            $opening_receives = $data['transfer_or_receives']
                                ->where('product_id', $pid)
                                ->filter(
                                    fn($item) => isset($item->destination_id, $item->date) &&
                                        in_array($item->destination_id, $store_ids) &&
                                        Carbon::parse($item->date)->lt($start),
                                )
                                ->sum('qty');

                            $opening_retail_sales = $data['retail_sales']
                                ->where('product_id', $pid)
                                ->filter(fn($item) => Carbon::parse($item->date)->lt($start))
                                ->sum('qty');

                            $opening_retail_returns = $data['retail_returns']
                                ->where('product_id', $pid)
                                ->filter(fn($item) => Carbon::parse($item->date)->lt($start))
                                ->sum('qty');

                            $opening =
                                $opening_liftings +
                                $opening_sales_returns +
                                $opening_receives -
                                $opening_lifting_returns -
                                $opening_sales -
                                $opening_retail_sales -
                                $opening_transfers -
                                $opening_online_sales +
                                $opening_retail_returns;

                            // Period values
                            $liftings = $data['liftings']
                                ->where('product_id', $pid)
                                ->filter(fn($item) => Carbon::parse($item->date)->between($start, $end))
                                ->sum('qty');

                            $lifting_returns = $data['lifting_returns']
                                ->where('product_id', $pid)
                                ->filter(fn($item) => Carbon::parse($item->date)->between($start, $end))
                                ->sum('qty');

                            $sales = $data['sales']
                                ->where('product_id', $pid)
                                ->filter(fn($item) => Carbon::parse($item->date)->between($start, $end))
                                ->sum('qty');

                            $sales_returns = $data['sales_returns']
                                ->where('product_id', $pid)
                                ->filter(fn($item) => Carbon::parse($item->date)->between($start, $end))
                                ->sum('qty');

                            $online_sales = $data['online_sales']
                                ->where('product_id', $pid)
                                ->filter(fn($item) => Carbon::parse($item->date)->between($start, $end))
                                ->sum('qty');

                            $retail_sales = $data['retail_sales']
                                ->where('product_id', $pid)
                                ->filter(fn($item) => Carbon::parse($item->date)->between($start, $end))
                                ->sum('qty');

                            $retail_returns = $data['retail_returns']
                                ->where('product_id', $pid)
                                ->filter(fn($item) => Carbon::parse($item->date)->between($start, $end))
                                ->sum('qty');

                            $transfers = $data['transfer_or_receives']
                                ->where('product_id', $pid)
                                ->filter(
                                    fn($item) => isset($item->host_id, $item->date) &&
                                        in_array($item->host_id, $store_ids) &&
                                        Carbon::parse($item->date)->between($start, $end),
                                )
                                ->sum('qty');

                            $receives = $data['transfer_or_receives']
                                ->where('product_id', $pid)
                                ->filter(
                                    fn($item) => isset($item->destination_id, $item->date) &&
                                        in_array($item->destination_id, $store_ids) &&
                                        Carbon::parse($item->date)->between($start, $end),
                                )
                                ->sum('qty');

                            $balance =
                                $opening +
                                $liftings +
                                $sales_returns +
                                $receives -
                                $lifting_returns -
                                $sales -
                                $retail_sales -
                                $transfers -
                                $online_sales +
                                $retail_returns;
                        @endphp

                        @if ($opening == 0 && $liftings == 0 && $sales_returns == 0 && $receives == 0 && $lifting_returns == 0 && $sales == 0 && $retail_sales == 0 && $transfers == 0 && $online_sales == 0 && $retail_returns == 0)
                            @continue
                        @endif --}}
                        <tr>
                            <td class="text-center px-3">{{ $key++ }}</td>
                            <td class="px-3">{{ $row->product->name ?? '' }}</td>
                            <td class="px-3">{{ $row->product->code ?? '' }}</td>
                            <td class="px-3">{{ $row->product->attribute->name ?? '' }}</td>
                            {{-- <td class="text-center px-3">{{ number_format($opening, 2) }}</td>
                            <td class="text-center px-3">
                                {{ number_format($liftings, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($lifting_returns, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($sales, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($sales_returns, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($transfers, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($receives, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($retail_sales, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($retail_returns, 2) }}
                            </td>
                            <td class="text-center px-3">
                                {{ number_format($online_sales, 2) }}
                            </td> --}}
                            <td class="text-center px-3">{{ number_format($row->stock_qty, 2) }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "order": false,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    {
                        'text': '<i class="fal fa-file-pdf"></i> Print',
                        'className': 'getPdf',
                    },
                ]
            });

            $(document).on('change', '#category_id,#product_type', function() {
                let category_id = $('#category_id').val();
                let product_type = $('#product_type').val();
                let url = "{{ Route('admin.stock-status.index') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        category_id: category_id,
                        product_type: product_type,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#product_id option').remove();
                            $('#product_id').append('<option value=""></option>');
                            $.each(response.products, function(key, value) {
                                var html =
                                    `<option value="${value.id}">${value.name} (${value.code})</option>`;
                                $('#product_id').append(html);
                            });
                            $('.select').select2();
                        }
                    }
                });
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                $('input[name="print"]').val('true');
                $('.filter_form')[0].setAttribute("target", "_blank");
                $('.filter_form').submit();
            });

            $(document).on('click', '#filter_btn', function(e) {
                e.preventDefault();
                $('input[name="print"]').val('');
                $('.filter_form')[0].setAttribute("target", "_self");
                $('.filter_form').submit();
            });
        });
    </script>
@endpush
