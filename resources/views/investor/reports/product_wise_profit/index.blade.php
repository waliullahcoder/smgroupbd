@extends('layouts.investor.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <input type="hidden" name="filter" value="1">
    <div class="row g-3">
        <div class="col-lg-3 col-sm-4">
            <label for="date_range" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required
                value="{{ date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date)) }}">
        </div>
        <div class="col-lg-9 col-sm-8">
            <label for="product_id" class="form-label"><b>Products</b></label>
            <select name="product_id[]" id="product_id" class="select form-select" data-placeholder="Select Product"
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
                    <th class="px-3 text-center" width="40px">SL#</th>
                    <th class="px-3">Product</th>
                    <th class="px-3 text-center">Sales Qty</th>
                    <th class="px-3 text-center">Sales Amount</th>
                    <th class="px-3 text-center">Purchase Amount</th>
                    <th class="px-3 text-center">Product Profit</th>
                    <th class="px-3 text-center">Invest %</th>
                    <th class="px-3 text-center">Investor Profit</th>
                    <th class="px-3 text-center">Total Share</th>
                    <th class="px-3 text-center">Your Share</th>
                    <th class="px-3 text-center">Your Profit</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_lifting_amount = 0;
                    $total_sales_amount = 0;
                    $total_profit_amount = 0;
                    $total_investors_profit = 0;
                    $total_self_profit = 0;
                @endphp
                @if (count($data) > 0)
                    @foreach ($data['searched_products'] as $row)
                        @php
                            $sales_qty =
                                $data['online_sales']
                                    ->where('product_id', $row->product_id)
                                    ->where('date', '>=', $data['start_date'])
                                    ->where('date', '<=', $data['end_date'])
                                    ->sum('qty') +
                                $data['sales']
                                    ->where('product_id', $row->product_id)
                                    ->where('date', '>=', $data['start_date'])
                                    ->where('date', '<=', $data['end_date'])
                                    ->sum('qty') -
                                $data['sales_returns']
                                    ->where('product_id', $row->product_id)
                                    ->where('date', '>=', $data['start_date'])
                                    ->where('date', '<=', $data['end_date'])
                                    ->sum('qty');
                            if ($sales_qty == 0) {
                                continue;
                            }
                            $sales_amount =
                                $data['online_sales']
                                    ->where('product_id', $row->product_id)
                                    ->where('date', '>=', $data['start_date'])
                                    ->where('date', '<=', $data['end_date'])
                                    ->sum('amount') +
                                $data['sales']
                                    ->where('product_id', $row->product_id)
                                    ->where('date', '>=', $data['start_date'])
                                    ->where('date', '<=', $data['end_date'])
                                    ->sum('amount') -
                                $data['sales_returns']
                                    ->where('product_id', $row->product_id)
                                    ->where('date', '>=', $data['start_date'])
                                    ->where('date', '<=', $data['end_date'])
                                    ->sum('amount');
                            $lifting_amount =
                                $data['liftings']
                                    ->where('product_id', $row->product_id)
                                    ->where('date', '>=', $data['start_date'])
                                    ->where('date', '<=', $data['end_date'])
                                    ->sum('amount') -
                                $data['lifting_returns']
                                    ->where('product_id', $row->product_id)
                                    ->where('date', '>=', $data['start_date'])
                                    ->where('date', '<=', $data['end_date'])
                                    ->sum('amount');
                            $total_profit = $sales_amount - $lifting_amount > 0 ? $sales_amount - $lifting_amount : 0;

                            $all_investors = \App\Models\Invest::with('investor')
                                ->where('product_id', $row->product_id)
                                ->where('sattled', 0)
                                ->count();
                            $investors_profit = round((($total_profit / 100) * $row->shared_profit) / $all_investors);

                            $self_invests = \App\Models\Invest::with('investor')
                                ->where('product_id', $row->product_id)
                                ->where('investor_id', Auth::user()->investor->id)
                                ->where('sattled', 0)
                                ->count();

                            $self_profit = $self_invests * $investors_profit;

                            if ($lifting_amount < $sales_amount && $lifting_amount != 0 && $sales_amount != 0) {
                                $percentage = ($total_profit / $sales_amount) * 100;
                            } elseif ($lifting_amount == 0 && $sales_amount != 0) {
                                $percentage = 100;
                            } else {
                                $percentage = 0;
                            }
                            $total_lifting_amount += $lifting_amount;
                            $total_sales_amount += $sales_amount;
                            $total_profit_amount += $total_profit;
                            $total_investors_profit += $investors_profit;
                            $total_self_profit += $self_profit;
                        @endphp
                        <tr>
                            <td class="px-3 text-center" width="40px">{{ $loop->iteration }}</td>
                            <td class="px-3">{{ $row->name }} ({{ $row->code }})</td>
                            <td class="px-3 text-center">{{ number_format($sales_qty, 2, '.', ',') }}</td>
                            <td class="px-3 text-center">{{ number_format($sales_amount, 2, '.', ',') }}</td>
                            <td class="px-3 text-center">{{ number_format($lifting_amount, 2, '.', ',') }}</td>
                            <td class="px-3 text-center">{{ number_format($total_profit, 2, '.', ',') }}</td>
                            <td class="px-3 text-center">{{ number_format($row->shared_profit, 0, '.', ',') }}%</td>
                            <td class="px-3 text-center">{{ number_format($investors_profit, 2, '.', ',') }}</td>
                            <td class="px-3 text-center">{{ number_format($all_investors, 0, '.', ',') }}</td>
                            <td class="px-3 text-center">{{ number_format($self_invests, 0, '.', ',') }}</td>
                            <td class="px-3 text-center">{{ number_format($self_profit, 2, '.', ',') }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr class="bg-primary">
                    <th class="text-white text-end" colspan="3">Total Summary</th>
                    <th class="text-white text-center">{{ number_format($total_sales_amount, 2, '.', ',') }}</th>
                    <th class="text-white text-center">{{ number_format($total_lifting_amount, 2, '.', ',') }}</th>
                    <th class="text-white text-center">{{ number_format($total_profit_amount, 2, '.', ',') }}</th>
                    <th class="text-white text-center"></th>
                    <th class="text-white text-center">{{ number_format($total_investors_profit, 2, '.', ',') }}</th>
                    <th class="text-white text-center"></th>
                    <th class="text-white text-center"></th>
                    <th class="text-white text-center">{{ number_format($total_self_profit, 2, '.', ',') }}</th>
                </tr>
            </tfoot>
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
