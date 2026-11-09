@extends('layouts.admin.app')
@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-gift text-success"></i>
            Employee Loan Management
        </h5>

        @can('admin.employee-loan.create')
        <a href="{{ route('admin.employee-loan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Loan
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
                    <th>Loan Type</th>
                    <th>Payroll Month</th>
                    <th>Year</th>
                    <th>Loan Amount</th>
                    <th>Installment Amount</th>
                    <th>Total Installment</th>
                    <th>Loan Date</th>
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
                title: 'Loan List',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9]
                }
            }
        ],

    ajax: "{{ route('admin.employee-loan.index') }}",

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
    {data:'loan_type',name:'el.loan_type'},
    {data:'payroll_month',name:'el.payroll_month'},
    {data:'payroll_year',name:'el.payroll_year'},
    {data:'loan_amount',name:'el.loan_amount'},
    {data:'installment_amount',name:'el.installment_amount'},
    {data:'total_installments',name:'el.total_installments'},
    {data:'loan_date',name:'el.loan_date'},
    {data:'status',name:'el.status',searchable:false},
    {data:'actions',orderable:false,searchable:false}
    ]

    });


</script>

@endpush