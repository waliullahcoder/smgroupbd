@extends('layouts.admin.app')
@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-gift text-success"></i>
            Documents Management
        </h5>

        @can('admin.documents.create')
        <a href="{{ route('admin.documents.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Document
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
                    <th>Document Type</th>
                    <th>Document Name</th>
                    <th>Document Link</th>
                    <th>Submit Date</th>
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

    ajax: "{{ route('admin.documents.index') }}",

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
    {data:'document_type',name:'dc.document_type'},
    {data:'document_name',name:'dc.document_name'},
    {data:'document_link',name:'dc.document_link'},
    {data:'submit_date',name:'dc.submit_date'},
    {data:'status',name:'dc.status',searchable:false},
    {data:'remarks',name:'dc.remarks'},
    {data:'actions',orderable:false,searchable:false}
    ]

    });


</script>

@endpush