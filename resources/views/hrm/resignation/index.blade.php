@extends('layouts.admin.app')
@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-gift text-success"></i>
            Resignation Management
        </h5>

        @can('admin.resignation.create')
        <a href="{{ route('admin.resignation.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Resignation
        </a>
        @endcan

    </div>

    <div class="card-body">

         <table class="table table-bordered table-striped table-hover dataTable w-100">

            <thead>

                <tr>

                    <th width="50">SL</th>
                    <th>Employee ID</th>
                    <th>Employee</th>
                    <th>Notice Period (Months)</th>
                    <th>Resignation Date</th>
                    <th>Last Working Date</th>
                    <th>Status</th>
                    <th>Reason</th>
                    <th width="120">Action</th>

                </tr>

            </thead>

        </table>

    </div>

</div>

@endsection


@push('js')


<script>
$('.dataTable').DataTable({

    processing: true,
    serverSide: true,
    // Excel button
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> Excel',
                className: 'btn btn-success btn-sm',
                title: 'Loan List',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9]
                }
            }
        ],

    ajax: "{{ route('admin.resignation.index') }}",

       columns: [
    {
        data: null,
        searchable: false,
        orderable: false,
        render: function(data, type, row, meta){
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    {data:'employee_code',name:'e.code'},
    {data:'name',name:'e.name'},
    {data:'notice_period',name:'rsg.notice_period'},
    {data:'resignation_date',name:'rsg.resignation_date'},
    {data:'last_working_date',name:'rsg.last_working_date'},
    {data:'status',name:'rsg.status',searchable:false},
    {data:'reason',name:'rsg.reason'},
    {data:'actions',orderable:false,searchable:false}
    ]

    });


</script>

@endpush