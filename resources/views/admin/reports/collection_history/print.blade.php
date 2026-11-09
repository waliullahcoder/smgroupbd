@extends('layouts.admin.print_app')

@section('content')
    @if ($report_type == 'summary')
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
                        <td>{{ $row->client_name }}</td>
                        <td>{{ $row->area_name }}</td>
                        <td>{{ $row->territory_name }}</td>
                        <td>{{ $row->client_category_name }}</td>
                        <td class="text-right">{{ number_format($row->total_amount, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="5"><b>Total Summary</b></td>
                    <td class="text-right" colspan="1"><b>{{ number_format($data->sum('total_amount'), 2, '.', ',') }}</b>
                    </td>
                </tr>
            </tfoot>
        </table>
    @elseif ($report_type == 'history')
        <table class="table table-bordered table-condensed table-striped align-middle mb-3">
            <thead>
                <tr>
                    <th class="text-center" width="40px">SL#</th>
                    <th>Date</th>
                    <th>Client Name</th>
                    <th>Employee Name</th>
                    <th>Payment No</th>
                    <th>Pay Mode</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                        <td>{{ date('d-m-Y', strtotime($row->date)) }}</td>
                        <td>{{ $row->client_name }}</td>
                        <td>{{ $row->staff_name }}</td>
                        <td>{{ $row->payment_no }}</td>
                        <td>{{ $row->payment_type }}</td>
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
