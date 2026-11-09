@extends('layouts.admin.print_app')

@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle mb-3">
        <thead>
            <tr>
                <th colspan="3">
                    @if (@$data['variant']->sku)
                        {{ @$data['variant']->product->name . ' - ( ' . @$data['variant']->sku . ' )' }}
                    @else
                        {{ @$data['product']->name . ' - ( ' . @$data['product']->code . ' )' }}
                    @endif
                </th>
                <th class="text-right" colspan="2">Previous Balance</th>
                <th class="text-right">{{ number_format($data['opening'], 2, '.', '') }}</th>
            </tr>
            <tr>
                <th class="text-center" width="40px">Sl#</th>
                <th>Date</th>
                <th>Description</th>
                <th class="text-right">Stock In</th>
                <th class="text-right">Stock Out</th>
                <th class="text-right">Balance</th>
            </tr>
        </thead>
        @php
            $ballance = $data['opening'];
            $total_stock_in = 0;
            $total_stock_out = 0;
        @endphp
        @if (count($data['statements']) > 0)
            <tbody>
                @foreach ($data['statements'] as $row)
                    <tr>
                        <td class="text-center px-3">{{ $loop->iteration }}</td>
                        <td>{{ $row['date'] }}</td>
                        <td>{{ $row['particulars'] }}</td>
                        <td class="text-right">{{ number_format($row['stock_in'], 2, '.', ',') }}</td>
                        <td class="text-right">{{ number_format($row['stock_out'], 2, '.', ',') }}</td>
                        <td class="text-right">{{ number_format($row['balance'], 2, '.', ',') }}</td>
                    </tr>
                    @php
                        $ballance = $row['balance'];
                        $total_stock_in += $row['stock_in'];
                        $total_stock_out += $row['stock_out'];
                    @endphp
                @endforeach
            </tbody>
        @endif
        <tfoot>
            <tr class="text-white">
                <th colspan="3" class="text-right text-white">Total Summary</th>
                <th class="text-right text-white">{{ number_format($total_stock_in, 2, '.', '') }}</th>
                <th class="text-right text-white">{{ number_format($total_stock_out, 2, '.', '') }}</th>
                <th class="text-right text-white">{{ number_format($ballance, 2, '.', '') }}</th>
            </tr>
        </tfoot>
    </table>
    <div style="padding-top: 30px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
