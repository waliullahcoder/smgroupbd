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
                    <th></th>
                    <th>Date</th>
                    <th>Invoice</th>
                    <th>Client</th>
                    <th>Client Code</th>
                    <th>Store</th>
                    <th>Amount</th>
                    <th>Sales By</th>
                    <th>Actions</th>
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
                        <th class="text-end" colspan="8">
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
                        data.date = $('#date').val();
                    }
                },
                columns: [{
                        data: "checkbox",
                        name: "checkbox",
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        width: '20'
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
                        data: 'client_name',
                        name: 'client_name',
                    },
                    {
                        data: 'client_phone',
                        name: 'client_phone',
                    },
                    {
                        data: 'store.name',
                        name: 'store.name',
                        defaultContent: '',
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount',
                    },
                    {
                        data: 'staff.name',
                        name: 'staff.name',
                        defaultContent: '',
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        className: "text-end",
                        width: '90',
                    },
                ],
                "fnDrawCallback": function(oSettings) {
                    const tooltips = document.querySelectorAll('.tt');
                    tooltips.forEach(t => {
                        new bootstrap.Tooltip(t);
                    });
                }
            });

            $(document).on('change', '#date', function(e) {
                $('.dataTable').DataTable().ajax.reload();
            });

            $(document).on('click', '.brintToPos', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var id = $(this).data('id');
                $('#printBtn'+id).addClass('loading');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _method: 'GET',
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire({
                                toast: true,
                                width: "20rem",
                                position: 'top-right',
                                text: "Printed Successfully",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500,
                                showClass: {
                                    popup: `
                                    animate__animated
                                    animate__bounceInRight
                                    animate__faster
                                    `
                                },
                                hideClass: {
                                    popup: `
                                    animate__animated
                                    animate__bounceOutRight
                                    animate__faster
                                    `
                                }
                            });
                        }
                        $('#printBtn'+id).removeClass('loading');
                    }
                });
            });
        });
    </script>
@endpush
