@extends('layouts.admin.app')
@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-gift text-success"></i>
            Termination Management
        </h5>

        @can('admin.termination.create')
        <a href="{{ route('admin.termination.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add termination
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
                    <th>Termination Date</th>
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

    ajax: "{{ route('admin.termination.index') }}",

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
    {data:'notice_period',name:'dsg.notice_period'},
    {data:'termination_date',name:'dsg.termination_date'},
    {data:'last_working_date',name:'dsg.last_working_date'},
    {data:'status',name:'dsg.status',searchable:false},
    {data:'reason',name:'dsg.reason'},
    {data:'actions',orderable:false,searchable:false}
    ]

    });


</script>

@endpush