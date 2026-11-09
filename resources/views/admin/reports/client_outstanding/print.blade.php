@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead class="text-nowrap">
            <tr>
                <th class="text-center" width="40px">SL#</th>
                <th>Client Name</th>
                <th>Contact No.</th>
                <th class="text-right">Opening</th>
                <th class="text-right">Sales</th>
                <th class="text-right">Collection</th>
                <th class="text-right">Return</th>
                <th class="text-right">Outstanding</th>
                <th class="text-center">Sales By</th>
                <th class="text-center">Due Ratio</th>
            </tr>
        </thead>
        @php
            $total_opening = 0;
            $total_sales = 0;
            $total_collection = 0;
            $total_return = 0;
            $total_outstanding = 0;
        @endphp
        <tbody>
            @if (count($data) > 0)
                @foreach ($data['clients'] as $row)
                    @php
                        $opening = $data['opening_sales']->where('client_id', $row->client_id)->sum('amount') - $data['opening_returns']->where('client_id', $row->client_id)->sum('amount') - $data['opening_collections']->where('client_id', $row->client_id)->sum('amount');
                        $outStanding = $opening + $data['sales']->where('client_id', $row->client_id)->sum('amount') - $data['returns']->where('client_id', $row->client_id)->sum('amount') - $data['collections']->where('client_id', $row->client_id)->sum('amount');
                        $total_sales = $data['opening_sales']->where('client_id', $row->client_id)->sum('amount') + $data['sales']->where('client_id', $row->client_id)->sum('amount');
                        $total_returns = $data['opening_returns']->where('client_id', $row->client_id)->sum('amount') + $data['returns']->where('client_id', $row->client_id)->sum('amount');
                        $total_collections = $data['opening_collections']->where('client_id', $row->client_id)->sum('amount') + $data['collections']->where('client_id', $row->client_id)->sum('amount');

                        if ($total_collections != 0 && $total_sales != 0) {
                            $percent = ($total_collections / ($total_sales - $total_returns)) * 100;
                            $percentage = 100 - $percent;
                            $averagePercent = number_format($percentage, 2, '.', '');
                        } elseif ($total_collections == 0) {
                            $averagePercent = 100;
                        } else {
                            $averagePercent = 0;
                        }
                    @endphp
                        @if ($outStanding <= 0)
                        @continue
                    @endif
                    <tr>
                        <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                        <td>{{ $row->client_name }}</td>
                        <td>{{ $row->client_phone }}</td>
                        <td class="text-right">{{ number_format($opening, 2, '.', ',') }}</td>
                        <td class="text-right">
                            {{ number_format($data['sales']->where('client_id', $row->client_id)->sum('amount'), 2, '.', ',') }}
                        </td>
                        <td class="text-right">
                            {{ number_format($data['collections']->where('client_id', $row->client_id)->sum('amount'), 2, '.', ',') }}
                        </td>
                        <td class="text-right">
                            {{ number_format($data['returns']->where('client_id', $row->client_id)->sum('amount'), 2, '.', ',') }}
                        </td>
                        <td class="text-right">
                            {{ number_format($outStanding, 2, '.', ',') }}
                        </td>
                        <td class="text-center">{{ @$row->staff_name }}</td>
                        <td class="text-center">{{ number_format($averagePercent, 2, '.', ',') }}%</td>
                    </tr>
                    @php
                        $total_opening += $opening;
                        $total_sales += $data['sales']->where('client_id', $row->client_id)->sum('amount');
                        $total_collection += $data['collections']->where('client_id', $row->client_id)->sum('amount');
                        $total_return += $data['returns']->where('client_id', $row->client_id)->sum('amount');
                        $total_outstanding += $outStanding;
                    @endphp
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right" colspan="3">Total Summary</th>
                <th class="text-right">{{ number_format($total_opening, 2, '.', ',') }}</th>
                <th class="text-right">{{ number_format($total_sales, 2, '.', ',') }}</th>
                <th class="text-right">{{ number_format($total_collection, 2, '.', ',') }}</th>
                <th class="text-right">{{ number_format($total_return, 2, '.', ',') }}</th>
                <th class="text-right">{{ number_format($total_outstanding, 2, '.', ',') }}</th>
                <th colspan="2"></th>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
