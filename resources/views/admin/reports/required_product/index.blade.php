@extends('layouts.admin.app')

@section('content')
    <div class="card">
        <div class="card-header pe-2 py-2">
            <form action="{{ @$filter_link }}" method="GET" class="filter_form">
                <input type="hidden" name="print" value="">
                <input type="hidden" name="filter" value="1">
                <div class="d-flex align-items-center justify-content-between gap-2">
                    <h6 class="h6 mb-0 text-uppercase py-1">{{ @$title }}</h6>
                    <div class="flex-shrink-0" style="min-width: 150px;">
                        <select name="store_id" id="store_id" class="form-select select" data-placeholder="Select Store">
                            <option value=""></option>
                            @foreach ($stores as $item)
                                <option value="{{ $item->id }}"
                                    {{ request('store_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-sm">
                    <thead class="text-nowrap">
                        <tr>
                            <th class="px-3 text-center" width="40px">SL#</th>
                            <th class="px-3">Product Code</th>
                            <th class="px-3 text-center" width="100">Demand Qty</th>
                            <th class="px-3 text-center" width="100">Stock Qty</th>
                            <th class="px-3 text-center" width="100">Balance Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data) > 0)
                            @foreach ($data as $row)
                                <tr>
                                    <td class="px-3 text-center">{{ $loop->iteration }}</td>
                                    <td class="px-3">{{ $row['product']->name }}</td>
                                    <td class="px-3 text-center">{{ number_format($row['demand_qty'], 2) }}</td>
                                    <td class="px-3 text-center">{{ number_format($row['stock_qty'], 2) }}</td>
                                    <td class="px-3 text-center">{{ $row['stock_qty'] > $row['demand_qty'] ? number_format($row['stock_qty'] - $row['demand_qty']) : '('.number_format($row['demand_qty'] - $row['stock_qty']).')' }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
                $('input[name="print"]').val('true');
                $('.filter_form')[0].setAttribute("target", "_blank");
                $('.filter_form').submit();
            });

            $(document).on('change', '#store_id', function(e) {
                e.preventDefault();
                $('input[name="print"]').val('');
                $('.filter_form')[0].setAttribute("target", "_self");
                $('.filter_form').submit();
            });
        });
    </script>
@endpush
