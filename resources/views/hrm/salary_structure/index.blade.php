@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h5 class="mb-0 text-uppercase">
                    <i class="fas fa-user-check text-success me-2"></i>
                    Salary Structure
                </h5>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover dataTable w-100">

                        <thead class="table-dark">

                            <tr>

                                <th>ID</th>
                                <th>Code</th>
                                <th>Employee</th>
                                <th>Basic (Tk.)</th>
                                <th>House Rent (Tk.)</th>
                                <th>Medical Allowance (Tk.)</th>
                                <th>Others (Tk.)</th>
                                <th>Net Salary (Tk.)</th>
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

    ajax: "{{ route('admin.salary.structure') }}",

    columns: [

        {
            data: 'id'
        },
        {
            data: 'code'
        },
        {
            data: 'name'
        },
        {
            data: 'basic_salary'
        },
        {
            data: 'house_rent'
        },
        {
            data: 'medical_allowance'
        },
        {
            data: 'others'
        },
        {
            data: 'total_salary'
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