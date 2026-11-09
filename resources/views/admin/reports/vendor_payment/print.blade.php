@extends('layouts.admin.print_app')

@section('content')
    @if ($report_type == 'summary')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead>
                <tr>
                    <th class="text-center">SL#</th>
                    <th>Vendor Name</th>
                    <th class="text-right">Total Paid</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ @$row->vendor->name }}</td>
                        <td class="text-right">{{ number_format($row->total_amount, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="2"><b>Total Summary</b></td>
                    <td class="text-right" colspan="1"><b>{{ number_format($data->sum('total_amount'), 2, '.', ',') }}</b>
                    </td>
                </tr>
            </tfoot>
        </table>
    @elseif ($report_type == 'history')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead>
                <tr>
                    <th class="text-center">SL#</th>
                    <th>Date</th>
                    <th>Payment No</th>
                    <th>Vendor Name</th>
                    <th>Pay Mode</th>
                    <th>Remarks</th>
                    <th class="text-right">Payment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center"><b>{{ $loop->iteration }}</b></td>
                        <td>{{ date('d-m-Y', strtotime($row->payment_date)) }}</td>
                        <td>{{ $row->payment_no }}</td>
                        <td>{{ @$row->vendor->name }}</td>
                        <td>{{ $row->type }}</td>
                        <td>{{ $row->remarks }}</td>
                        <td class="text-right">{{ number_format($row->amount, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="6"><b>Total Summary</b></td>
                    <td class="text-right" colspan="1"><b>{{ number_format($data->sum('amount'), 2, '.', ',') }}</b>
                    </td>
                </tr>
            </tfoot>
        </table>
    @endif
    <div style="padding-top: 30px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
