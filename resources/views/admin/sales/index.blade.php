
@extends('layouts.admin.index_app')

@section('content')

    @php
        $currentRouteName = \Request::route()->getName();
        $link = Route($currentRouteName);
        $delete_link = str_replace('index', 'destroy', $currentRouteName);
        $isSoftwareAdmin = Auth::user()->hasRole('Software Admin');
    @endphp

    <div class="card-body">

        <div class="table-responsive">
            <table class="dataTable table align-middle" style="width:100%">

                <thead>
                    <tr class="text-nowrap">

                        <th width="1"></th>

                        @if ($isSoftwareAdmin)
                            <th>Company</th>
                        @endif

                        <th>Invoice</th>
                        <th>Date</th>
                        <th>Client</th>
                        <th>Client Code</th>
                        <th class="text-end">Total</th>
                        <th class="text-end">Discount</th>
                        <th class="text-end">Tax (%)</th>
                        <th class="text-end">Tax Amount</th>
                        <th class="text-end">Net Payable</th>
                        <th>Sales By</th>
                        <th width="110" class="text-end">Actions</th>

                    </tr>
                </thead>

                <tbody></tbody>

                @if (Auth::user()->can($delete_link))
                    <tfoot>
                        <tr>
                            <!-- <th class="text-center" colspan="1">

                                <div class="custom-control custom-checkbox">

                                    <div id="regular_all_select">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="selectAll">

                                        <label class="custom-control-label"
                                            for="selectAll"></label>
                                    </div>

                                    <div id="trash_all_select" style="display: none;">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="trash_selectAll">

                                        <label class="custom-control-label"
                                            for="trash_selectAll"></label>
                                    </div>

                                </div>

                            </th> -->

                            <th class="text-end"
                                colspan="{{ $isSoftwareAdmin ? 12 : 11 }}">

                                <!-- <button type="button"
                                    name="bulk_delete"
                                    data-url="{{ Route($delete_link, '0') }}"
                                    id="bulk_delete"
                                    class="btn btn-xs btn-danger">
                                    Delete
                                </button> -->

                                <!-- <button type="button"
                                    name="bulk_delete"
                                    data-url="{{ Route($delete_link, '0') }}"
                                    style="display: none;"
                                    id="trash_bulk_delete"
                                    class="btn btn-xs btn-danger">
                                    Delete
                                </button> -->

                            </th>
                        </tr>
                    </tfoot>
                @endif

            </table>
        </div>

    </div>

@endsection


@push('js')

<script type="text/javascript">

    $(document).ready(function() {

        var table = $('.dataTable').DataTable({

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

            columns: [

                // Checkbox
                {
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false,
                    width: '1'
                },

                @if ($isSoftwareAdmin)
                {
                    data: 'company.name',
                    name: 'company.name',
                    defaultContent: '-'
                },
                @endif

                // Invoice
                {
                    data: 'invoice',
                    name: 'invoice',
                    defaultContent: '-'
                },

                // Date
                {
                    data: 'date',
                    name: 'date',
                    defaultContent: '-'
                },

                // Client
                {
                    data: 'client.name',
                    name: 'client.name',
                    defaultContent: '-'
                },

                // Client Code
                {
                    data: 'client.code',
                    name: 'client.code',
                    defaultContent: '-'
                },

                // Total
                {
                    data: 'total_amount',
                    name: 'total_amount',
                    className: 'text-end',
                    defaultContent: '0.00'
                },

                // Discount
                {
                    data: 'discount',
                    name: 'discount',
                    className: 'text-end',
                    defaultContent: '0.00'
                },

                // Tax Percentage
                {
                    data: 'tax',
                    name: 'tax',
                    className: 'text-end',
                    defaultContent: '0.00%'
                },

                // Tax Amount
                {
                    data: 'tax_amount',
                    name: 'tax_amount',
                    className: 'text-end',
                    defaultContent: '0.00'
                },

                // Net Payable
                {
                    data: 'net_amount',
                    name: 'net_amount',
                    className: 'text-end fw-bold',
                    defaultContent: '0.00'
                },

                // Sales By
                {
                    data: 'staff_name',
                    name: 'staff_name',
                    defaultContent: '-',
                    orderable: false,
                    searchable: false
                },

                // Actions
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    className: 'text-end'
                }

            ],

            fnDrawCallback: function(oSettings) {

                document.querySelectorAll('.tt').forEach(function(t) {

                    if (!bootstrap.Tooltip.getInstance(t)) {
                        new bootstrap.Tooltip(t);
                    }

                });

            }

        });


        // Date Filter
        $(document).on('change', '#sales_date', function() {
            table.ajax.reload();
        });


        // Invoice Search
        $(document).on('keyup', '#invoice', function() {
            table.ajax.reload();
        });


        // Filter Change
        $(document).on('change', '#filter', function() {
            table.ajax.reload();
        });

    });

</script>

@endpush
