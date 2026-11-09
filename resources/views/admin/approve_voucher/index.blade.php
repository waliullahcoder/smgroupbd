@extends('layouts.admin.index_app')

@section('content')
    @php
        $currentRouteName = \Request::route()->getName();
        $link = Route($currentRouteName);
        $editLink = str_replace('index', 'edit', $currentRouteName);
    @endphp
    <div class="card-body">
        <table class="dataTable table align-middle" style="width:100%">
            <thead>
                <tr class="text-nowrap">
                    <th></th>
                    <th>Date</th>
                    <th>Voucher Type</th>
                    <th>Voucher No</th>
                    <th>Debit Head</th>
                    <th>Credit Head</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center" colspan="1">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="selectAll">
                            <label class="custom-control-label" for="selectAll"></label>
                        </div>
                    </th>
                    <th colspan="7">
                        <div class="text-end">
                            <button type="button" name="bulkApprove" data-url="{{ Route($editLink, '0') }}"
                                id="bulkApprove" class="btn btn btn-xs btn-danger">Approve</button>
                        </div>
                    </th>
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
                    type: "GET"
                },
                columns: [{
                        data: "checkbox",
                        name: "checkbox",
                        className: "text-center",
                        orderable: false,
                        searchable: false,
                        width: '40'
                    },
                    {
                        data: 'voucher_date',
                        name: 'voucher_date',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'voucher_type',
                        name: 'voucher_type',
                    },
                    {
                        data: 'voucher_no',
                        name: 'voucher_no',
                    },
                    {
                        data: 'debit_head',
                        name: 'debit_head',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'credit_head',
                        name: 'credit_head',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                        width: '110'
                    },
                ],
                "fnDrawCallback": function(oSettings) {
                    const tooltips = document.querySelectorAll('.tt');
                    tooltips.forEach(t => {
                        new bootstrap.Tooltip(t);
                    });
                }
            });

            $(document).on('click', '.approve-btn', function(e) {
                e.preventDefault();
                Swal.fire({
                    width: "25rem",
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, approve it!",
                }).then((result) => {
                    if (result.value) {
                        let url = $(this).data('url');
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _method: 'GET'
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    Swal.fire({
                                        width: "22rem",
                                        title: "Approved!",
                                        text: 'Approve Successfully',
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    $('.dataTable').DataTable().ajax.reload();
                                }
                                if (response.status == 'error') {
                                    Swal.fire({
                                        width: "22rem",
                                        title: "Failed!",
                                        text: "You don't have any Authority to do this action",
                                        icon: "error",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            }
                        });
                    }
                });
            });

            $("#bulkApprove").on("click", function() {
                let url = $(this).data("url");
                let selectClass = "multi_checkbox";
                multiApproveCheckbox(url, selectClass);
            });

            function multiApproveCheckbox(url, selectClass) {
                Swal.fire({
                    width: "25rem",
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Approve All!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = [];
                        $("." + selectClass + ":checked").each(function() {
                            id.push($(this).val());
                        });
                        if (id.length > 0) {
                            $.ajax({
                                url: url,
                                type: 'GET',
                                data: {
                                    id: id
                                },
                                success: function(response) {
                                    if (response.status == 'success') {
                                        Swal.fire({
                                            width: "22rem",
                                            title: "Approved!",
                                            text: 'Approve Successfully',
                                            icon: "success",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    }
                                    if (response.status == 'error') {
                                        Swal.fire({
                                            width: "22rem",
                                            title: "Failed!",
                                            text: "You don't have any Authority to do this action",
                                            icon: "error",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    }
                                    $("#selectAll").prop("checked", false);
                                    $("input[type=checkbox]").prop("checked", false);
                                    $('.dataTable').DataTable().ajax.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                width: "22rem",
                                title: "Error!",
                                text: "Please select atleast one checkbox",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }
                });
            }
        });
    </script>
@endpush
