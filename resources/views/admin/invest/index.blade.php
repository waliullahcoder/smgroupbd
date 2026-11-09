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
                    <th>Invest No</th>
                    <th>Investor Name</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th width="210" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot class="bg-primary text-white">
                <tr>
                    <th colspan="4" class="text-end"></th>
                    <th class="text-white" id="total-value"></th>
                    <th colspan="2"></th>
                </tr>
            </tfoot>
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
                    },
                    "dataSrc": function(json) {
                        $('#total-value').html(json.sumValue);
                        return json.data;
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        width: '3'
                    },
                    {
                        data: 'date',
                        name: 'date',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'invest_no',
                        name: 'invest_no',
                    },
                    {
                        data: 'investor.name',
                        name: 'investor.name',
                        defaultContend: '',
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                        className: "text-end",
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: "text-end",
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
