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
                    <th>Company</th>
                    <th>Project</th>
                    <th>Name</th>
                    <th>Store Name</th>
                    <th>Item Name</th>
                    <th>Assign Name</th>
                    <th>Delivery Qty</th>
                    <th>Delivery Date</th>
                    <th>Received Qty</th>
                    <th>Received Date</th>
                    <th>Status</th>
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
                        <th class="text-end" colspan="12">
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
                    }
                },
                columns: [{
                        data: "checkbox",
                        name: "checkbox",
                        orderable: false,
                        searchable: false,
                        width: '3'
                    },
                    {
                        data: 'company.name',
                        name: 'company.name',
                        className: "text-nowrap",
                        defaultContent: ''
                    },
                    {
                        data: 'branch.name',
                        name: 'branch.name',
                        className: "text-nowrap",
                        defaultContent: ''
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: "text-nowrap",
                    },
                    {
                        data: 'store_name',
                        name: 'store_name',
                        className: "text-nowrap",
                        defaultContent: ''
                    },
                    {
                        data: 'item_name',
                        name: 'item_name',
                        className: "text-nowrap",
                        defaultContent: ''
                    },
                    {
                        data: 'assign_name',
                        name: 'assign_name',
                        className: "text-nowrap",
                        defaultContent: ''
                    },
                    {
                        data: 'delivery_qnty',
                        name: 'delivery_qnty',
                        defaultContent: ''
                    },
                    {
                        data: 'delivery_date',
                        name: 'delivery_date',
                        className: "text-nowrap",
                        defaultContent: ''
                    },
                    {
                        data: 'received_qnty',
                        name: 'received_qnty',
                        defaultContent: ''
                    },
                    {
                        data: 'received_date',
                        name: 'received_date',
                        className: "text-nowrap",
                        defaultContent: ''
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
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
        });
    </script>
@endpush