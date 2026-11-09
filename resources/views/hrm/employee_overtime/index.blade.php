@extends('layouts.admin.app')
@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-gift text-success"></i>
            Employee Overtime Management
        </h5>

        @can('admin.employee-overtime.create')
        <a href="{{ route('admin.employee-overtime.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add overtime
        </a>
        @endcan

    </div>

    <div class="card-body">

         <table class="table table-bordered table-striped table-hover dataTable w-100">

            <thead>

                <tr>

                    <th width="50">SL</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Overtime Type</th>
                    <th>Payroll Month</th>
                    <th>Year</th>
                    <th>Overtime Hour</th>
                    <th>Overtime Rate</th>
                    <th>Overtime Amount</th>
                    <th>Overtime Date</th>
                    <th>Status</th>
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
                title: 'overtime List',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9]
                }
            }
        ],

    ajax: "{{ route('admin.employee-overtime.index') }}",

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
    {data:'overtime_type',name:'eot.overtime_type'},
    {data:'payroll_month',name:'eot.payroll_month'},
    {data:'payroll_year',name:'eot.payroll_year'},
    {data:'overtime_hour',name:'eot.overtime_hour'},
    {data:'overtime_rate',name:'eot.overtime_rate'},
    {data:'overtime_amount',name:'eot.overtime_amount'},
    {data:'overtime_date',name:'eot.overtime_date'},
    {data:'status',name:'el.status',searchable:false},
    {data:'actions',orderable:false,searchable:false}
    ]

    });


</script>

@endpush