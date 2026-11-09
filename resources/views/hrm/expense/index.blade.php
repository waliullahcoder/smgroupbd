@extends('layouts.admin.app')
@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-gift text-success"></i>
         Expense Management
        </h5>

        @can('admin.expense.create')
        <a href="{{ route('admin.expense.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Expense
        </a>
        @endcan

    </div>

    <div class="card-body">

         <table class="table table-bordered table-striped table-hover dataTable w-100">

            <thead>

                <tr>

                    <th width="50">SL</th>
                    <th>Expense Head</th>
                    <th>Expense Month</th>
                    <th>Year</th>
                    <th>Expense Amount</th>
                    <th>Expense Date</th>
                    <th>Status</th>
                    <th>Remarks</th>
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

    ajax: "{{ route('admin.expense.index') }}",

       columns: [
    {
        data: null,
        searchable: false,
        orderable: false,
        render: function(data, type, row, meta){
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    {data:'head_name',name:'c.head_name'},
    {data:'expense_month',name:'exp.expense_month'},
    {data:'expense_year',name:'exp.expense_year'},
    {data:'expense_amount',name:'exp.expense_amount'},
    {data:'expense_date',name:'exp.expense_date'},
    {data:'status',name:'exp.status',searchable:false},
    {data:'remarks',name:'exp.remarks'},
    {data:'actions',orderable:false,searchable:false}
    ]

    });


</script>

@endpush