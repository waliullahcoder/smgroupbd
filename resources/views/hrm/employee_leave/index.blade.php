@extends('layouts.admin.app')

@section('content')

<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-header">

                <div class="d-flex justify-content-between">

                    <h5 class="mb-0">
                        Employee Leave Management
                    </h5>

                    <a href="{{ route('admin.employee-leave.create') }}"
                        class="btn btn-primary">

                        <i class="fas fa-plus"></i>
                        Add Leave

                    </a>

                </div>

            </div>

            <div class="card-body">

                  <table class="table table-bordered table-striped table-hover dataTable w-100">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Employee ID</th>
                            <th>Employee</th>
                            <th>Leave Type</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Total Days</th>
                            <th>Day Type</th>
                            <th>Status</th>
                            <th width="120">Action</th>

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

$('.dataTable').DataTable({

    processing:true,
    serverSide:true,
    responsive:true,
    scrollX:true,

    ajax:{
        url:"{{ route('admin.employee-leave.index') }}",
        type:"GET"
    },

    columns:[

        {
            data:'id',
            name:'el.id'
        },

        {
            data:'employee_code',
            name:'s.employee_id'
        },

        {
            data:'employee_name',
            name:'s.name'
        },

        {
            data:'leave_type',
            name:'el.leave_type'
        },

        {
            data:'from_date',
            name:'el.from_date'
        },

        {
            data:'to_date',
            name:'el.to_date'
        },

        {
            data:'total_days',
            name:'el.total_days'
        },

        {
            data:'day_type',
            name:'el.day_type'
        },

        {
            data:'status',
            name:'el.status'
        },

        {
            data:'actions',
            name:'actions',
            searchable:false,
            orderable:false
        }

    ]

});

</script>

@endpush