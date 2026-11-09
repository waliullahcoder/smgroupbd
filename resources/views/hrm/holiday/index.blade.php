@extends('layouts.admin.app')

@section('content')

<div class="row g-3">

    <div class="col-12">

        <div class="card">

            <div class="card-header py-2">

                <div class="d-flex justify-content-between align-items-center">

                    <h6 class="mb-0 text-uppercase">
                        Holiday Management
                    </h6>

                    <a href="{{ route('admin.holiday.create') }}"
                       class="btn btn-primary btn-sm">

                        <i class="fas fa-plus"></i>
                        Add Holiday

                    </a>

                </div>

            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover dataTable w-100">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Holiday Name</th>
                            <th>Holiday Type</th>
                            <th>Branch</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Total Days</th>
                            <th>Repeat Yearly</th>
                            <th>Status</th>
                            <th width="130" class="text-end">Action</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection


@push('js')

<script>

$(function(){

    $('.dataTable').DataTable({

        processing:true,
        serverSide:true,
        responsive:true,
        scrollX:true,

        dom:'Bfrtip',

        buttons:[

            {

                extend:'excelHtml5',

                text:'<i class="fas fa-file-excel"></i> Excel',

                className:'btn btn-success btn-sm',

                title:'Holiday List'

            }

        ],

        ajax:{

            url:"{{ route('admin.holiday.index') }}",

            type:"GET"

        },

        columns:[

            {data:'id',name:'h.id'},

            {data:'holiday_name',name:'h.holiday_name'},

            {data:'holiday_type',name:'h.holiday_type'},

            {data:'branch_name',name:'b.name'},

            {data:'from_date',name:'h.from_date'},

            {data:'to_date',name:'h.to_date'},

            {data:'total_days',name:'h.total_days'},

            {data:'repeat_yearly',name:'h.repeat_yearly'},

            {data:'status',name:'h.status'},

            {

                data:'actions',

                name:'actions',

                searchable:false,

                orderable:false,

                className:'text-end'

            }

        ]

    });

});

</script>

@endpush