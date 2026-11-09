@extends('layouts.admin.report_app')

@section('content')
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-sm">
            <thead class="text-nowrap">
                <tr>
                    <th class="text-center" width="20">SL#</th>
                    <th>Month</th>
                    <th class="text-end">Total Sales</th>
                    <th class="text-end">Total Purchases</th>
                    @foreach ($expense_heads as $key => $item)
                        <th class="text-end">{{ $item->head_name }}</th>
                        @php
                            ${'total_' . $key} = 0;
                        @endphp
                    @endforeach
                    <th class="text-end">Net Profit</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_sales = 0;
                    $total_purchase = 0;
                    $total_profit = 0;
                @endphp
                @foreach ($data as $row)
                    @php
                        $total_sales += $row['sales'];
                        $total_purchase += $row['purchases'];
                        $total_profit += $row['net_profit'];
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $row['date'] }}</td>
                        <td class="text-end">{{ number_format($row['sales']) }}</td>
                        <td class="text-end">{{ number_format($row['purchases']) }}</td>
                        @foreach ($expense_heads as $key => $item)
                            <td class="text-end">{{ number_format($row[$item->head_name]) }}</td>
                            @php
                                ${'total_' . $key} += $row[$item->head_name];
                            @endphp
                        @endforeach
                        <td class="text-end">
                            {{ $row['net_profit'] >= 0 ? number_format($row['net_profit']) : '(' . number_format(abs($row['net_profit'])) . ')' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-end" colspan="2">Total Summary</th>
                    <th class="text-end">{{ number_format($total_sales) }}</th>
                    <th class="text-end">{{ number_format($total_purchase) }}</th>
                    @foreach ($expense_heads as $key => $item)
                        <th class="text-end">{{ number_format(${'total_' . $key}) }}</th>
                    @endforeach
                    <th class="text-end">
                        {{ $total_profit >= 0 ? number_format($total_profit) : '(' . number_format(abs($total_profit)) . ')' }}
                    </th>
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
                'responsive': true,
                buttons: [
                    'excelHtml5',
                    {
                        'text': '<i class="fal fa-file-pdf"></i> Print',
                        'className': 'getPdf',
                    },
                ]
            });

            $(document).on('click', '.getPdf', function(e) {
                $('.filter_form')[0].submit();
            });
        });
    </script>
@endpush
