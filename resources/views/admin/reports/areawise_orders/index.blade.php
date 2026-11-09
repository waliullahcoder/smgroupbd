@extends('layouts.admin.app')

@section('content')
    <div class="card">
        <div class="card-header pe-2 py-2">
            <form action="{{ @$filter_link }}" method="GET" class="filter_form">
                <input type="hidden" name="print" value="">
                <input type="hidden" name="filter" value="1">
                <div class="d-flex align-items-center justify-content-between gap-2">
                    <h6 class="h6 mb-0 text-uppercase py-1">{{ @$title }}</h6>
                    <div class="flex-shrink-0">
                        <select name="store_id" id="store_id" class="form-select select" data-placeholder="Select Store">
                            <option value=""></option>
                            @foreach ($stores as $item)
                                <option value="{{ $item->id }}"
                                    {{ request('store_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
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
                            <th class="px-3">Area Name</th>
                            <th class="px-3 text-center" width="100">Total Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_orders = 0;
                        @endphp
                        @foreach ($data as $row)
                            <tr>
                                <td class="px-3 text-center">{{ $loop->iteration }}</td>
                                <td class="px-3"><a
                                        href="{{ Route('admin.areawise-order.index') }}?area_id={{ $row->id }}">{{ @$row->name }}</a>
                                </td>
                                <td class="px-3 text-center">
                                    <a
                                        href="{{ Route('admin.areawise-order.index') }}?area_id={{ $row->id }}">{{ number_format(count($row->orders->whereIn('status', ['Pending', 'Forward', 'Processing']))) }}</a>
                                </td>
                            </tr>
                            @php
                                $total_orders += count(
                                    $row->orders->whereIn('status', ['Pending', 'Forward', 'Processing']),
                                );
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-end">Total Summary</th>
                            <th class="text-center">
                                {{ number_format($total_orders) }}
                            </th>
                        </tr>
                    </tfoot>
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
