@extends('layouts.admin.app')

@section('content')
    <div class="card">
        <div class="card-header pe-2 py-2">
            <div class="d-flex flex-wrap justify-content-between gap-2 align-items-center">
                <h6 class="h6 mb-0 text-uppercase text-nowrap flex-grow-1">
                    {{ @$title ?? 'Please Set Title' }}</h6>
                <a href="{{ Route('admin.approve-invest.index') }}" class="btn btn-primary btn-sm">Go Back</a>
            </div>
        </div>
        <div class="card-body px-3">
            <div class="table-responsive-sm">
                <table class="table table-borderless table-striped mb-0">
                    <tbody>
                        <tr>
                            <th width="200">Investor Name</th>
                            <th width="10">:</th>
                            <td>{{ @$data->investor->name }}</td>
                        </tr>
                        <tr>
                            <th width="200">Invest No.</th>
                            <th width="10">:</th>
                            <td>{{ @$data->invest_no }}</td>
                        </tr>
                        <tr>
                            <th width="200">Date</th>
                            <th width="10">:</th>
                            <td>{{ date('d-m-Y', strtotime(@$data->date)) }}</td>
                        </tr>
                        <tr>
                            <th width="200">Qty</th>
                            <th width="10">:</th>
                            <td>{{ @$data->qty }}</td>
                        </tr>
                        <tr>
                            <th width="200">Amount</th>
                            <th width="10">:</th>
                            <td>{{ @$data->amount }}</td>
                        </tr>
                        <tr>
                            <th width="200">Cash Head</th>
                            <th width="10">:</th>
                            <td>{{ @$data->coa->head_name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
