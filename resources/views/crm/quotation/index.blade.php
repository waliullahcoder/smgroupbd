@extends('layouts.admin.app')

@section('content')
    @php
        $currentRouteName = \Request::route()->getName();
        $link = Route($currentRouteName);
        $delete_link = str_replace('index', 'destroy', $currentRouteName);
    @endphp

<div class="row g-3">

    <div class="col-12">

        <div class="card">
    <div class="card-header">

                <div class="d-flex justify-content-between">

                    <h6 class="mb-0 text-uppercase">
                       Quotation
                    </h6>

                    <a href="{{ Route('admin.quotation.create') }}"
                        class="btn btn-primary btn-sm">
                        Add New
                    </a>

                </div>

            </div>

            <div class="card-body">

                 <table class="table dataTable align-middle" style="width:100%">
            <thead>
                <tr class="text-nowrap">
                    <th>Quotation</th>
                    <th>Date</th>
                    <th>Company</th>
                    <th>Client</th>
                    <th>Amount</th>
                    <th>Quotation By</th>
                    <th>Actions</th>
                </tr>
            </thead>
           
        </table>
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
                scrollX: true,
                ajax: {
                    url: "{{ $link }}",
                    type: "GET",
                    data: function(data) {
                        data.type = $('#filter').val();
                        data.quotation_date = $('#quotation_date').val();
                        data.quotation = $('#quotation').val();
                    }
                },
                columns: [{
                        data: 'quotation',
                        name: 'q.quotation'
                    },
                    {
                        data: 'date',
                        name: 'q.date'
                    },
                    {
                        data: 'company_name',
                        name: 'c.name',
                    },
                    {
                        data: 'client_name',
                        name: 'cl.company_name',
                    },
                    {
                        data: 'total_amount',
                        name: 'q.total_amount',
                    },
                    {
                        data: 'staff_name',
                        name: 'st.name'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        className: "text-end",
                    },
                ],
               
            });

            $(document).on('change', '#quotation_date', function(e) {
                $('.dataTable').DataTable().ajax.reload();
            });

            $(document).on('keyup', '#quotation', function(e) {
                $('.dataTable').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
