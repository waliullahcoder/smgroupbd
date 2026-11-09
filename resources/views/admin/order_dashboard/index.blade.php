@extends('layouts.admin.app')
@section('content')
    @php
        $currentRouteName = \Request::route()->getName();
        $link = Route($currentRouteName);
    @endphp
    @if (Auth::user()->hasRole('Moderator'))
        <div class="row g-3">
            <div class="col-md-4">
                <div class="info-box bg-info">
                    <div class="info-area">
                        <span class="box-amount">{{ number_format($total_orders) }}</span>
                        <span class="box-text mt-4 pt-md-5 pt-4">Total Orders</span>
                    </div>
                    <div class="icon-area"><i class="fal fa-cubes"></i></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box bg-success">
                    <div class="info-area">
                        <span class="box-amount">{{ number_format($success_orders) }}</span>
                        <span class="box-text mt-4 pt-md-5 pt-4">Success Orders</span>
                    </div>
                    <div class="icon-area"><i class="fal fa-box-check"></i></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box bg-danger">
                    <div class="info-area">
                        @php
                            if ($success_orders == 0) {
                                $ratio = 0;
                            } else {
                                $ratio = ($success_orders / $total_orders) * 100;
                            }
                        @endphp
                        <span class="box-amount">{{ number_format($ratio, 2, '.', '') }} %</span>
                        <span class="box-text mt-4 pt-md-5 pt-4">Success Ratio</span>
                    </div>
                    <div class="icon-area"><i class="fal fa-badge-percent"></i></div>
                </div>
            </div>
            <div class="col-12">
                <div class="card" style="min-height: 610px;">
                    <div class="card-body p-2">
                        <table class="dataTable table align-middle" style="width:100%">
                            <thead>
                                <tr class="text-nowrap">
                                    <th width="3">SL#</th>
                                    <th>Order Date</th>
                                    <th>Target Delivery</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th width="150">Address</th>
                                    <th>Amount</th>
                                    <th width="110" class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card" style="min-height: 235px;">
                    <div class="card-header">
                        <h5 class="h6 mb-0 text-uppercase">Popular Items</h5>
                    </div>
                    <div class="card-body p-2">
                        <table class="table align-middle mb-0">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-center text-white">SL#</th>
                                    <th class="text-white">Product Name</th>
                                    <th class="text-white text-end">QTY (KG)</th>
                                    <th class="text-white text-end">Amount (TK.)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ranked_products as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ Route('admin.product-statement.index') }}?print=&filter=1&store_id=&date_range={{ date('01-m-Y') }}+to+{{ date('t-m-Y') }}&product_id={{ $item->product_id }}"
                                                target="_blank">{{ $item->product_name }}</a>
                                        </td>
                                        <td class="text-end">{{ $item->total_qty }}</td>
                                        </td>
                                        <td class="text-end">{{ number_format($item->total_amount) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row g-3">
            <div class="col-lg-8">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="info-box bg-info">
                            <div class="info-area">
                                <span class="box-amount">{{ number_format($total_orders) }}</span>
                                <span class="box-text mt-4 pt-md-5 pt-4">Total Orders</span>
                            </div>
                            <div class="icon-area"><i class="fal fa-cubes"></i></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box bg-success">
                            <div class="info-area">
                                <span class="box-amount">{{ number_format($success_orders) }}</span>
                                <span class="box-text mt-4 pt-md-5 pt-4">Success Orders</span>
                            </div>
                            <div class="icon-area"><i class="fal fa-box-check"></i></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box bg-danger">
                            <div class="info-area">
                                @php
                                    if ($success_orders == 0) {
                                        $ratio = 0;
                                    } else {
                                        $ratio = ($success_orders / $total_orders) * 100;
                                    }
                                @endphp
                                <span class="box-amount">{{ number_format($ratio, 2, '.', '') }} %</span>
                                <span class="box-text mt-4 pt-md-5 pt-4">Success Ratio</span>
                            </div>
                            <div class="icon-area"><i class="fal fa-badge-percent"></i></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card" style="min-height: 570px;">
                            <div class="card-body p-2">
                                <table class="dataTable table align-middle" style="width:100%">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th width="3">SL#</th>
                                            <th>Order Date</th>
                                            <th>Target Delivery</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th width="150">Address</th>
                                            <th>Amount</th>
                                            <th width="110" class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card"
                            style="min-height: {{ !Auth::user()->hasRole('Store Keeper') ? '235px' : '787px' }};">
                            <div class="card-header">
                                <h5 class="h6 mb-0 text-uppercase">Popular Items</h5>
                            </div>
                            <div class="card-body p-2">
                                <table class="table align-middle mb-0">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center text-white">SL#</th>
                                            <th class="text-white">Product Name</th>
                                            <th class="text-white text-end">QTY (KG)</th>
                                            <th class="text-white text-end">Amount (TK.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ranked_products as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ Route('admin.product-statement.index') }}?print=&filter=1&store_id=&date_range={{ date('01-m-Y') }}+to+{{ date('t-m-Y') }}&product_id={{ $item->product_id }}"
                                                        target="_blank">{{ $item->product_name }}</a>
                                                </td>
                                                <td class="text-end">{{ $item->total_qty }}</td>
                                                </td>
                                                <td class="text-end">{{ number_format($item->total_amount) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if (!Auth::user()->hasRole('Store Keeper'))
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center gap-3">
                                        <div class="flex-grow-1">
                                            <h5 class="h6 mb-0 text-uppercase">Sales Summary</h5>
                                        </div>
                                        <div class="flex-shrink-0" style="width: 200px;">
                                            <form action="" method="GET" id="changed_form" class="d-flex gap-2 align-items-center justify-content-sm-end justify-content-center flex-wrap">
                                                <select name="year" id="year" class="form-select"
                                                    data-placeholder="Select Year" style="font-size: 12px; padding: 4px 5px; min-height: auto; max-width: 90px;">
                                                    <option value="2024" {{ is_null(request('year')) && date('Y') == '2024' || request('year') == '2024' ? 'selected' : '' }}>2024</option>
                                                    <option value="2025" {{ is_null(request('year')) && date('Y') == '2025' || request('year') == '2025' ? 'selected' : '' }}>2025</option>
                                                    <option value="2026" {{ is_null(request('year')) && date('Y') == '2026' || request('year') == '2026' ? 'selected' : '' }}>2026</option>
                                                    <option value="2027" {{ is_null(request('year')) && date('Y') == '2027' || request('year') == '2027' ? 'selected' : '' }}>2027</option>
                                                    <option value="2028" {{ is_null(request('year')) && date('Y') == '2028' || request('year') == '2028' ? 'selected' : '' }}>2028</option>
                                                    <option value="2029" {{ is_null(request('year')) && date('Y') == '2029' || request('year') == '2029' ? 'selected' : '' }}>2029</option>
                                                    <option value="2030" {{ is_null(request('year')) && date('Y') == '2030' || request('year') == '2030' ? 'selected' : '' }}>2030</option>
                                                </select>
                                                <select name="month" id="month" class="form-select"
                                                    data-placeholder="Select Month" style="font-size: 12px; padding: 4px 5px; min-height: auto; max-width: 90px;">
                                                    @for ($m = 1; $m <= 12; $m++)
                                                        <option value="{{ date('F', mktime(0, 0, 0, $m, 1, date('Y'))) }}"
                                                            {{ (is_null(request('month')) && date('F') == date('F', mktime(0, 0, 0, $m, 1, date('Y')))) || request('month') == date('F', mktime(0, 0, 0, $m, 1, date('Y'))) ? 'selected' : '' }}>
                                                            {{ date('F', mktime(0, 0, 0, $m, 1, date('Y'))) }}</option>
                                                    @endfor
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <table class="table table-bordered mb-0 table-sm">
                                        <thead>
                                            <tr class="text-white bg-primary">
                                                <th>Name</th>
                                                <td></td>
                                                <th class="text-end">AMOUNT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-light">
                                                <th>Total Sales</th>
                                                <td class="text-center" width="30">=&gt;</td>
                                                <td class="text-end">{{ number_format($total_sales) }}</td>
                                            </tr>
                                            <tr class="bg-light">
                                                <th>Total Purchase</th>
                                                <td class="text-center" width="30">=&gt;</td>
                                                <td class="text-end">{{ number_format($total_purchases) }}</td>
                                            </tr>
                                            @php
                                                $total_expense = 0;
                                            @endphp
                                            @foreach ($expense_heads as $item)
                                                <tr class="bg-light">
                                                    <th>{{ @$item->head_name }}</th>
                                                    <td class="text-center" width="30">=&gt;</td>
                                                    <td class="text-end">
                                                        @php
                                                            $start_date = request('month') && request('year') ? date('Y-m-01', strtotime(request('year').'-'.request('month'))) : date('Y-m-01');
                                                            $end_date = request('month') && request('year') ? date('Y-m-t', strtotime(request('year').'-'.request('month'))) : date('Y-m-t');

                                                            $amount = \App\Models\AccountTransaction::where(
                                                                'voucher_date',
                                                                '>=',
                                                                $start_date,
                                                            )
                                                                ->where('voucher_date', '<=', $end_date)
                                                                ->where('coa_setup_id', $item->id)
                                                                ->sum('debit_amount');
                                                            $total_expense += $amount;
                                                        @endphp
                                                        {{ number_format($amount) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="bg-primary text-white">
                                            <tr>
                                                <th>Monthly Net Profit</th>
                                                <td class="text-center" width="30">=&gt;</td>
                                                <td class="text-end">
                                                    @php
                                                        $net_profit = $total_sales - $total_purchases - $total_expense;
                                                    @endphp
                                                    {{ $net_profit >= 0 ? number_format($net_profit) : '(' . number_format(abs($net_profit)) . ')' }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.dataTable').dataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ $link }}",
                    type: "GET",
                    data: function(data) {
                        data.type = $('#filter').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                        width: '40',
                    },
                    {
                        data: 'order_date',
                        name: 'order_date',
                        orderable: false,
                        searchable: false,
                        className: 'text-nowrap'
                    },
                    {
                        data: 'potential_delivery_date',
                        name: 'potential_delivery_date',
                        orderable: false,
                        searchable: false,
                        className: 'text-nowrap'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'user_phone',
                        name: 'user_phone'
                    },
                    {
                        data: 'shipping_address',
                        name: 'shipping_address',
                        width: '150',
                    },
                    {
                        data: 'total',
                        name: 'total',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: "text-end",
                    },
                ],
                "fnDrawCallback": function(oSettings) {
                    const tooltips = document.querySelectorAll('.tt');
                    tooltips.forEach(t => {
                        new bootstrap.Tooltip(t);
                    });
                }
            });

            $(document).on('change', '#month,#year', function(e) {
                $('#changed_form')[0].submit();
            });
        });
    </script>
@endpush
