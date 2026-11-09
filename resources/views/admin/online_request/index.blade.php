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
                    <th>SL#</th>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Product Code</th>
                    <th>Name</th>
                    <th>Contact No.</th>
                    <th>E-mail</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="max-w-xl w-full bg-slate-200 p-8 rounded-md relative">
                        <div class="text-end">
                            <button class="btn btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div id="modal-data">
                            <div class="d-flex flex-wrap gap-3 mb-2">
                                <div class="flex-shrink-0" style="width: 100px; font-weight: 600;">Name: </div>
                                <div id="name"></div>
                            </div>
                            <div class="d-flex flex-wrap gap-3 mb-2">
                                <div class="flex-shrink-0" style="width: 100px; font-weight: 600;">Phone Number: </div>
                                <div id="phone"></div>
                            </div>
                            <div class="d-flex flex-wrap gap-3 mb-2">
                                <div class="flex-shrink-0" style="width: 100px; font-weight: 600;">E-mail: </div>
                                <div id="email"></div>
                            </div>
                            <div class="d-flex flex-wrap gap-3 mb-2">
                                <div class="flex-shrink-0" style="width: 100px; font-weight: 600;">Address: </div>
                                <div id="address"></div>
                            </div>
                            <hr class="my-2">
                            <div>
                                <div class="mb-2" style="font-weight: 600;">Messages: </div>
                                <div id="message">
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex gap-3">
                                <div>Message's Date: </div>
                                <div id="date"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.dataTable').dataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                scrollX: true,
                ajax: {
                    url: "{{ $link }}",
                    type: "GET",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                        width: '60',
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'product.name',
                        name: 'product.name'
                    },
                    {
                        data: 'product.code',
                        name: 'product.code'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'email',
                        name: 'email'
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

            $(document).on('click', '.view-message', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                let date = $(this).data('date');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _method: 'GET',
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#name').text(response.data.name);
                            $('#phone').text(response.data.phone);
                            $('#email').text(response.data.email);
                            $('#address').text(response.data.address);
                            $('#message').text(response.data.message);
                            $('#date').text(date);
                            $('#messageModal').modal('show');
                        }
                    }
                });
            });
        });
    </script>
@endpush
