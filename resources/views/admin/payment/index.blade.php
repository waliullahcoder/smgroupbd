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
                    <th>Investor</th>
                    <th>Payment No</th>
                    <th>Date</th>
                    <th>Deposit Type</th>
                    <th>Deposit To</th>
                    <th>Amount</th>
                    <th width="110" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot class="bg-primary text-white">
                <tr>
                    <th colspan="6"></th>
                    <th class="text-white" id="total-value"></th>
                    <th></th>
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
                        className: 'text-center',
                    },
                    {
                        data: 'investor.name',
                        name: 'investor.name'
                    },
                    {
                        data: 'payment_no',
                        name: 'payment_no'
                    },
                    {
                        data: 'date',
                        name: 'date',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'deposit_type',
                        name: 'deposit_type'
                    },
                    {
                        data: 'deposit_to',
                        name: 'deposit_to',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'amount',
                        name: 'amount'
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
