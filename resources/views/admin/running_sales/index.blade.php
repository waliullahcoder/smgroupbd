@extends('layouts.admin.index_app')

@section('content')
    @php
        $currentRouteName = \Request::route()->getName();
        $link = Route($currentRouteName);
        $delete_link = str_replace('index', 'destroy', $currentRouteName);
    @endphp
    <div class="card-body">
        <table class="dataTable table align-middle" style="width:100%">
            <thead>
                <tr class="text-nowrap">
                    <th width="3"></th>
                    @if (Auth::user()->hasRole('Software Admin'))
                        <th>Company</th>
                    @endif
                    <th>Invoice</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Client Code</th>
                    <th>Store</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Sales By</th>
                    <th width="110" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            @if (Auth::user()->can($delete_link))
                <tfoot>
                    <tr>
                        <th class="text-center" colspan="1">
                            <div class="custom-control custom-checkbox">
                                <div id="regular_all_select">
                                    <input type="checkbox" class="custom-control-input" id="selectAll">
                                    <label class="custom-control-label" for="selectAll"></label>
                                </div>
                                <div id="trash_all_select" style="display: none;">
                                    <input type="checkbox" class="custom-control-input" id="trash_selectAll">
                                    <label class="custom-control-label" for="trash_selectAll"></label>
                                </div>
                            </div>
                        </th>
                        <th class="text-end" colspan="{{ Auth::user()->hasRole('Software Admin') ? '10' : '9' }}">
                            <button type="button" name="bulk_delete" data-url="{{ Route($delete_link, '0') }}"
                                id="bulk_delete" class="btn btn btn-xs btn-danger">Delete</button>
                            <button type="button" name="bulk_delete" data-url="{{ Route($delete_link, '0') }}"
                                style="display: none;" id="trash_bulk_delete"
                                class="btn btn btn-xs btn-danger">Delete</button>
                        </th>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.dataTable').dataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ $link }}",
                    type: "GET",
                    data: function(data) {
                        data.type = $('#filter').val();
                        data.sales_date = $('#sales_date').val();
                        data.invoice = $('#invoice').val();
                    }
                },
                columns: [{
                        data: "checkbox",
                        name: "checkbox",
                        orderable: false,
                        searchable: false,
                        width: '3'
                    },
                    @if (Auth::user()->hasRole('Software Admin'))
                        {
                            data: 'company.name',
                            name: 'company.name',
                        },
                    @endif {
                        data: 'invoice',
                        name: 'invoice'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'client.name',
                        name: 'client.name',
                    },
                    {
                        data: 'client.code',
                        name: 'client.code',
                    },
                    {
                        data: 'store.name',
                        name: 'store.name'
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount',
                    },
                    {
                        data: 'sales_type',
                        name: 'sales_type',
                    },
                    {
                        data: 'staff.name',
                        name: 'staff.name'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        className: "text-end",
                    },
                ],
                "fnDrawCallback": function(oSettings) {
                    const tooltips = document.querySelectorAll('.tt');
                    tooltips.forEach(t => {
                        new bootstrap.Tooltip(t);
                    });
                }
            });

            $(document).on('change', '#sales_date', function(e) {
                $('.dataTable').DataTable().ajax.reload();
            });

            $(document).on('keyup', '#invoice', function(e) {
                $('.dataTable').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
