@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h5 class="mb-0 text-uppercase">
                    <i class="fas fa-user-check text-success me-2"></i>
                    Employee Attendance
                </h5>

                <a href="{{ route('admin.employee-attendance.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    Add Attendance
                </a>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover dataTable w-100">

                        <thead class="table-dark">

                            <tr>

                                <th>SL</th>
                                <th>Date</th>
                                <th>Employee</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Worked Hours</th>
                                <th>Late</th>
                                <th>OT</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th width="100">Action</th>

                            </tr>

                        </thead>

                    </table>

                </div>

            </div>

        </div>

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
                title: 'Lead List',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9]
                }
            }
        ],

    ajax: "{{ route('admin.employee-attendance.index') }}",

    columns: [

        {
            data: 'id'
        },
        {
            data: 'attendance_date'
        },
        {
            data: 'employee'
        },
        {
            data: 'check_in'
        },
        {
            data: 'check_out'
        },
        {
            data: 'worked_hours'
        },
        {
            data: 'late_minutes'
        },
        {
            data: 'overtime_minutes'
        },
        {
            data: 'attendance_status'
        },
        {
            data: 'remarks'
        },
        {
            data: 'actions',
            name: 'actions',
            orderable: false,
            searchable: false
        },

    ]

});
</script>

@endpush