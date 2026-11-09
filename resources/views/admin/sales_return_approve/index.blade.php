@extends('layouts.admin.index_app')

@section('content')
    @php
        $currentRouteName = \Request::route()->getName();
        $link = Route($currentRouteName);
    @endphp
    <div class="card-body">
        <table class="dataTable table align-middle" style="width:100%">
            <thead>
                <tr class="text-nowrap">
                    <th width="3"></th>
                    @if (Auth::user()->hasRole('Software Admin'))
                        <th>Company</th>
                    @endif
                    <th>Product Type</th>
                    <th>Client</th>
                    <th>Store</th>
                    <th>Return Date</th>
                    <th>Amount</th>
                    <th>Staff</th>
                    <th>Remarks</th>
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
                        data: 'product_type',
                        name: 'product_type'
                    },
                    {
                        data: 'client.name',
                        name: 'client.name'
                    },
                    {
                        data: 'store.name',
                        name: 'store.name'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'staff.name',
                        name: 'staff.name'
                    },
                    {
                        data: 'remarks',
                        name: 'remarks'
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

            $(document).on('click', '.store_approve', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, approve it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _method: 'GET',
                                store_approve: true,
                            },
                            success: (response) => {
                                if (response.status == 'success') {
                                    Swal.fire({
                                        width: "22rem",
                                        title: "Approved!",
                                        text: 'Approved Successfully!',
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    $('.dataTable').DataTable().ajax.reload();
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.accounts_approve', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, approve it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _method: 'GET',
                                accounts_approve: true,
                            },
                            success: (response) => {
                                if (response.status == 'success') {
                                    Swal.fire({
                                        width: "22rem",
                                        title: "Approved!",
                                        text: 'Approved Successfully!',
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    $('.dataTable').DataTable().ajax.reload();
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.reject-btn', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, approve it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                            },
                            success: (response) => {
                                if (response.status == 'success') {
                                    Swal.fire({
                                        width: "22rem",
                                        title: "Rejected!",
                                        text: 'Rejected Successfully!',
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    $('.dataTable').DataTable().ajax.reload();
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
