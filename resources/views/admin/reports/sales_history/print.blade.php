@extends('layouts.admin.print_app')

@section('content')
    @if ($report_type == 'product_summary')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead>
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Code</th>
                    <th>UOM</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Qtys</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_ctn = 0;
                @endphp
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center" width="40px"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ @$row->category_name }}</td>
                        <td>{{ @$row->product_name }}</td>
                        <td>{{ @$row->product_code }}</td>
                        <td>{{ @$row->attribute_name }}</td>
                        <td class="text-right">{{ $row->total_qty }}</td>
                        @php
                            $qty = 0;
                            if ($row->ctn_size > 0) {
                                $ctn = floor($row->total_qty / $row->ctn_size);
                                $total_ctn += $ctn;
                                $ctn_sizes = $ctn * $row->ctn_size;
                                $extra = $row->total_qty - $ctn_sizes;
                                $qty = $ctn . ' CTN ' . ($extra > 0 ? $extra . ' ' . $row->attribute_name : '');
                            }
                        @endphp
                        <td class="text-right">{{ $qty }}</td>
                        <td class="text-right">{{ number_format($row->total_amount, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="6"><b>Total Summary</b></td>
                    <td class="text-right" colspan="1"><b>{{ number_format($total_ctn, 2, '.', ',') }} CTN</b></td>
                    <td class="text-right" colspan="1">
                        <b>{{ number_format($data->sum('total_amount'), 2, '.', ',') }}</b>
                    </td>
                </tr>
            </tfoot>
        </table>
    @elseif ($report_type == 'client_summary')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead>
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Area</th>
                    <th>Territory</th>
                    <th>Client Type</th>
                    <th>Client Name</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center" width="40px"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ $row->area_name }}</td>
                        <td>{{ $row->territory_name }}</td>
                        <td>{{ $row->client_category_name }}</td>
                        <td>{{ $row->client_name }}</td>
                        <td class="text-right">{{ number_format($row->total_amount, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="5"><b>Total Summary</b></td>
                    <td class="text-right" colspan="1">
                        <b>{{ number_format($data->sum('total_amount'), 2, '.', ',') }}</b>
                    </td>
                </tr>
            </tfoot>
        </table>
    @elseif ($report_type == 'history')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead>
                <tr class="text-nowrap">
                    <th class="text-center" width="40px">SL#</th>
                    <th>Date</th>
                    <th>Invoice</th>
                    <th>Client Name</th>
                    <th>Product Name</th>
                    <th>Code</th>
                    <th>UOM</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th class="text-right">Amount</th>
                    <th>Sales Type</th>
                    <th>Staff</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center" width="40px"><b>{{ $loop->iteration }}</b></td>
                        <td class="text-nowrap">{{ date('d-m-Y', strtotime($row->date)) }}</td>
                        <td>{{ $row->invoice }}</td>
                        <td>{{ $row->client_name }}</td>
                        <td>{{ $row->product_name }}</td>
                        <td>{{ $row->product_code }}</td>
                        <td>{{ $row->attribute_name }}</td>
                        <td>{{ $row->qty }}</td>
                        <td>{{ $row->rate }}</td>
                        <td class="text-right">{{ number_format($row->amount, 2, '.', ',') }}</td>
                        <td>{{ $row->sales_type }}</td>
                        <td>{{ $row->staff_name }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="7"><b>Total Summary</b></td>
                    <td class="text-right" colspan="1"></td>
                    <td class="text-right" colspan="1"></td>
                    <td class="text-right" colspan="1">
                        <b>{{ number_format($data->sum('amount'), 2, '.', ',') }}</b>
                    </td>
                    <td class="text-right" colspan="1"></td>
                    <td class="text-right" colspan="1"></td>
                </tr>
            </tfoot>
        </table>
    @endif
    <div style="padding-top: 30px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
