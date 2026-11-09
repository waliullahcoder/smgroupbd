@extends('layouts.admin.app')

@section('content')
    <div class="card">
        <div class="card-header pe-2 py-2">
            <div class="d-flex flex-wrap justify-content-between gap-2 align-items-center">
                <h6 class="h6 mb-0 text-uppercase text-nowrap flex-grow-1">{{ @$title ?? 'Please Set Title' }}</h6>
                <a href="{{ Route('admin.profit-distribute.index') }}" class="btn btn-primary btn-sm">Go
                    Back</a>
            </div>
        </div>
        <div class="card-body px-3">
            <table class="table table-borderless table-striped table-responsive-sm">
                <tbody>
                    <tr>
                        <th width="200">Date</th>
                        <th width="10">:</th>
                        <td>{{ date('d-m-Y', strtotime(@$data->date)) }}</td>
                    </tr>
                    <tr>
                        <th width="200">Month</th>
                        <th width="10">:</th>
                        <td>{{ @$data->month }}</td>
                    </tr>
                    <tr>
                        <th width="200">Year</th>
                        <th width="10">:</th>
                        <td>{{ @$data->year }}</td>
                    </tr>
                    <tr>
                        <th width="200">Serial No.</th>
                        <th width="10">:</th>
                        <td>{{ @$data->serial_no }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th class="text-center" width="50">SL#</th>
                            <th>Investor Name</th>
                            <th class="text-center">Individual Share</th>
                            <th class="text-center">Investor Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $profit = 0;
                            $share_qty = 0;
                        @endphp
                        @foreach ($data->list as $row)
                            <tr>
                                <th class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ @$row->investor->name }}</td>
                                <td class="text-center">{{ @$row->share_qty }}</td>
                                <td class="text-center">{{ @$row->amount }}</td>
                            </tr>
                            @php
                                $profit += @$row->amount;
                                $share_qty += @$row->share_qty;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-primary text-white">
                            <th colspan="2">Total</th>
                            <th class="text-center">{{ $share_qty }}</th>
                            <th class="text-center">{{ $profit }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
