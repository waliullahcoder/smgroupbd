@extends('layouts.admin.app')

@section('content')
    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header pe-2 py-2">
                    <div class="d-flex align-items-center justify-content-between gap-2">
                        <h6 class="h6 mb-0 text-uppercase py-1">
                            {{ isset($title) ? $title : 'Please Set Title' }}
                        </h6>
                        @if (isset($filter_form))
                            {!! $filter_form !!}
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="px-3 text-center" width="40px">Sl#</th>
                                <th class="px-3">Investor Name</th>
                                <th class="px-3">Invest Date</th>
                                <th class="px-3 text-end">Total Invest</th>
                                <th class="px-3 text-end">Total Profit</th>
                                <th class="px-3 text-end">Total Withdraw</th>
                                <th class="px-3 text-end">Due</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_invest = 0;
                                $total_profit = 0;
                                $total_widthdraw = 0;
                                $total_due = 0;
                            @endphp
                            @foreach ($data as $row)
                                <tr>
                                    <td class="text-center px-3">{{ $loop->iteration }}</td>
                                    <td class="px-3">{{ $row['investor_name'] }}</td>
                                    <td class="px-3">{{ $row['dates'] }}</td>
                                    <td class="px-3 text-end">{{ number_format($row['total_invest'], 2) }}</td>
                                    <td class="px-3 text-end">{{ number_format($row['total_profit'], 2) }}</td>
                                    <td class="px-3 text-end">
                                        {{ number_format($row['withdraw_invest'] + $row['withdraw_profit'], 2) }}</td>
                                    <td class="px-3 text-end">{{ number_format($row['due'], 2) }}</td>
                                </tr>
                                @php
                                    $total_invest += $row['total_invest'];
                                    $total_profit += $row['total_profit'];
                                    $total_widthdraw += $row['withdraw_invest'] + $row['withdraw_profit'];
                                    $total_due += $row['due'];
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total</th>
                                <th class="text-end">{{ number_format($total_invest, 2) }}</th>
                                <th class="text-end">{{ number_format($total_profit, 2) }}</th>
                                <th class="text-end">{{ number_format($total_widthdraw, 2) }}</th>
                                <th class="text-end">{{ number_format($total_due, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ $filter_link }}" id="filter_form" target="_blank">
        <input type="hidden" name="print" value="true">
    </form>
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
                $('#filter_form')[0].submit();
            });
        });
    </script>
@endpush
