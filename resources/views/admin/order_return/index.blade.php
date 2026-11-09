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
                    <th>Date</th>
                    <th>Order No.</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Area</th>
                    <th>Products</th>
                    @if (Auth::user()->hasRole('System Admin') || Auth::user()->hasRole('Software Admin'))
                        <th>Creator</th>
                    @endif
                    <th width="110" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
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
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                    },
                    {
                        data: 'date',
                        name: 'date',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'invoice',
                        name: 'invoice'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name',
                    },
                    {
                        data: 'user_phone',
                        name: 'user_phone'
                    },
                    {
                        data: 'area.name',
                        name: 'area.name',
                        defaultContent: ''
                    },
                    {
                        data: 'items',
                        name: 'items',
                        orderable: false,
                        searchable: false,
                        defaultContent: ''
                    },
                    @if (Auth::user()->hasRole('System Admin') || Auth::user()->hasRole('Software Admin'))
                        {
                            data: 'staff.name',
                            name: 'staff.name',
                            defaultContent: ''
                        },
                    @endif {
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
