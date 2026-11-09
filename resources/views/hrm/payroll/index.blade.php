@extends('layouts.admin.app')

@section('content')

<div class="row g-3">

    <div class="col-12">

        <div class="card">

            <div class="card-header py-2">

                <div class="d-flex justify-content-between align-items-center">

                    <h6 class="mb-0 text-uppercase">
                        Payroll Management
                    </h6>

                    <a href="{{ route('admin.payroll.create') }}"
                       class="btn btn-primary btn-sm">

                        <i class="fas fa-plus"></i>
                        Generate Payroll

                    </a>

                </div>

            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover dataTable w-100">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Employee ID</th>
                            <th>Employee</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Gross Salary</th>
                            <th>Deduction</th>
                            <th>Net Salary</th>
                            <th>Payment Date</th>
                            <th>Status</th>
                            <th width="130" class="text-end">Action</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </div>

</div>
<!-- Pay Salary modal-->
 <div class="modal fade" id="payrollModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="payrollForm">
            @csrf

            <input type="hidden" id="payroll_id">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Pay Sallary </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            <b>Payment Status</b>
                        </label>

                        <select class="form-select"
                                id="payment_status">

                            <option value="Pending">Pending</option>
                            <option value="Paid">Paid</option>
                            <option value="Cancelled">Cancelled</option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            <b>Note</b>
                        </label>

                        <textarea class="form-control"
                                  id="note"
                                  rows="4"></textarea>

                    </div>
                    <div class="mb-3">
                         <b>Gross Salary</b> : <span id="gross-salary"></span> Tk.<br>
                         <b>Deduction</b> : <span id="deduction"></span> Tk.<br>
                         <hr>
                         <b>Net Salary</b> : <span id="net-salary"></span> Tk.
                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-primary"
                            id="savePayroll"
                            type="submit">
                        Pay Confirm
                    </button>

                </div>

            </div>

        </form>
    </div>
</div>
<!-- Pay Salary modal end-->

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

                title:'Payroll List'

            }

        ],

        ajax:{
            url:"{{ route('admin.payroll.index') }}",
            type:"GET"
        },

        columns:[

            {data:'id',name:'p.id'},

            {data:'employee_code',name:'s.code'},

            {data:'employee_name',name:'s.name'},

            {data:'payroll_month',name:'p.payroll_month'},

            {data:'payroll_year',name:'p.payroll_year'},

            {data:'gross_salary',name:'p.gross_salary'},

            {data:'total_deduction',name:'p.total_deduction'},

            {data:'net_salary',name:'p.net_salary'},

            {data:'payment_date',name:'p.payment_date'},

            {data:'payment_status',name:'p.payment_status'},

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


//Pay salary modal
$(document).on('click','.btn-payroll',function(){

    $('#payroll_id').val($(this).data('id'));
    $('#payment_status').val($(this).data('status'));
    $('#note').val($(this).data('note'));
    $('#gross-salary').html($(this).data('gross-salary'));
    $('#deduction').html($(this).data('deduction'));
    $('#net-salary').html($(this).data('net-salary'));

    $('#payrollModal').modal('show');

});

$('#payrollForm').submit(function(e){

    e.preventDefault();

    $.ajax({

        url:"{{ url('admin/payroll/update-status') }}/"+$('#payroll_id').val(),

        type:"POST",

        data:{
            _token:"{{ csrf_token() }}",
            payment_status:$('#payment_status').val(),
            note:$('#note').val()
        },

        success:function(res){

            $('#payrollModal').modal('hide');

            $('.dataTable').DataTable().ajax.reload(null,false);

            Swal.fire(
                'Success',
                'Payroll updated successfully.',
                'success'
            );

        }

    });

});
</script>

@endpush