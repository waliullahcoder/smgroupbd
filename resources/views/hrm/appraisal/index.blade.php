@extends('layouts.admin.app')
@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-gift text-success"></i>
            Performance Appraisal Management
        </h5>

        @can('admin.appraisal.create')
        <a href="{{ route('admin.appraisal.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Appraisal
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
                    <th>Appraisal Date</th>
                    <th>Appraisal Period (Months)</th>
                    <th>Rating(Out of 100)</th>
                    <th>Summary</th>
                    <th>Status</th>
                    <th>Action</th>

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

    ajax: "{{ route('admin.appraisal.index') }}",

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
    {data:'appraisal_date',name:'ap.appraisal_date'},
    {data:'appraisal_period',name:'ap.appraisal_period'},
    {data:'overall_rating',name:'ap.overall_rating'},
    {data:'summary',name:'ap.summary'},
    {data:'status',name:'ap.status',searchable:false},
    {data:'actions',orderable:false,searchable:false}
    ]

    });


</script>

@endpush