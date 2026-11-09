@extends('layouts.admin.print_app')
@push('css')
    <style>
        @page {
            size: a4;
        }

        .info-table thead {
            background-color: #fff;
            color: #333;
        }

        .info-table thead th {
            border-bottom: 2px solid #000 !important;
            border-right: 2px dotted #888;
        }

        .info-table tfoot td,
        .info-table tbody td {
            border-top: 2px dotted #888;
            border-right: 2px dotted #888;
        }

        .staff {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
        }

        .info-table th,
        .info-table td,
        .header-table td {
            line-height: 1;
            padding: 3px 12px 1px !important;
            font-family: 'PT Serif', serif;
            font-weight: normal;
        }

        .info-table th,
        .info-table td {
            padding: 0px 12px 5px !important;
        }

        .d-inline-block {
            display: inline-block;
        }

        .overflow-hidden {
            overflow: hidden;
        }
    </style>
@endpush
@section('content')
    <table class="table mb-2 header-table" style="border-bottom: 1px solid #ddd;">
        <tr>
            <td>
                <b class="d-inline-block" style="min-width: 100px;">User :</b>
                <span class="d-inline-block" style="min-width: 200px;">{{ $user }}</span>
            </td>
            <td class="text-right">
                <b class="d-inline-block text-left" style="min-width: 100px;">Date Range :</b>
                <span class="d-inline-block" style="min-width: 200px;">
                    {{ date('Y-m-d', strtotime($start_date)) . ' - ' . date('Y-m-d', strtotime($end_date)) }}
                </span>
            </td>
        </tr>
    </table>

    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead>
            <tr>
                <th class="text-center" width="40px">SL#</th>
                <th>Date time</th>
                @if ($user == 'All')
                    <th>User</th>
                @endif
                <th>Page</th>
                <th>Action</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td class="text-center" width="40px">{{ $loop->iteration }}</td>
                    <td class="text-nowrap">{{ date('d-m-Y h:i A', strtotime($row->date_time)) }}</td>
                    @if ($user == 'All')
                        <td class="text-nowrap">{{ $row->user->name }}</td>
                    @endif
                    <td class="text-nowrap">{{ $row->page }}</td>
                    <td class="text-nowrap">{{ $row->action }}</td>
                    <td>{{ $row->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
