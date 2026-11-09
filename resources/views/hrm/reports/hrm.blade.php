@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card shadow-sm">

            {{-- Header --}}
            <div class="card-header d-flex justify-content-between align-items-center">

                <h5 class="mb-0 text-uppercase">
                    <i class="fas fa-chart-line text-primary me-2"></i>
                    HRM Payroll Report
                </h5>

            </div>


            {{-- Filter Section --}}
            <div class="card-body border-bottom">

                <div class="row g-3 align-items-end">

                    {{-- From Date --}}
                    <div class="col-lg-2 col-md-6">

                        <label class="form-label fw-bold">
                            <i class="fas fa-calendar-alt text-primary me-1"></i>
                            From Date
                        </label>

                        <input type="date"
                               id="from_date"
                               class="form-control"
                               value="{{ date('Y-m-01') }}">

                    </div>


                    {{-- To Date --}}
                    <div class="col-lg-2 col-md-6">

                        <label class="form-label fw-bold">
                            <i class="fas fa-calendar-alt text-primary me-1"></i>
                            To Date
                        </label>

                        <input type="date"
                               id="to_date"
                               class="form-control"
                               value="{{ date('Y-m-t') }}">

                    </div>


                    {{-- Employee --}}
                    <div class="col-lg-3 col-md-6">

                        <label class="form-label fw-bold">
                            <i class="fas fa-user text-success me-1"></i>
                            Employee
                        </label>

                        <select id="employee_id"
                                class="form-select">

                            <option value="">
                                All Employee
                            </option>

                            @foreach($employees as $employee)

                                <option value="{{ $employee->id }}">
                                    {{ $employee->code }} - {{ $employee->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>
                    {{-- Payment Status --}}
                        <div class="col-lg-2 col-md-6">

                            <label class="form-label fw-bold">
                                <i class="fas fa-money-check-alt text-warning me-1"></i>
                                Payment Status
                            </label>

                            <select id="payment_status" class="form-select">

                                <option value="">All Status</option>

                                <option value="Paid">Paid</option>

                                <option value="Pending">Pending</option>

                                <option value="Cancelled">Cancelled</option>

                            </select>

                        </div>


                    {{-- Buttons --}}
                    <div class="col-lg-3 col-md-6">

                        <div class="d-flex gap-2">

                            <button type="button"
                                    id="btnFilter"
                                    class="btn btn-primary">

                                <i class="fas fa-search me-1"></i>
                                Filter

                            </button>


                            <button type="button"
                                    id="btnReset"
                                    class="btn btn-outline-secondary">

                                <i class="fas fa-sync-alt me-1"></i>
                                Reset

                            </button>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Table --}}
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover dataTable align-middle"
                           style="width:100%">

                        <thead class="table-dark text-nowrap">

                            <tr>

                                <th>SL</th>

                                <th>Employee Code</th>

                                <th>Employee Name</th>

                                <th>Payroll Month</th>

                                <th>Year</th>

                                <th class="text-end">Gross Salary</th>

                                <th class="text-end">Deduction</th>

                                <th class="text-end">Net Salary</th>

                                <th>Payment Date</th>

                                <th>Payment Status</th>

                                <th style="min-width:200px;">
                                    Remarks
                                </th>

                            </tr>

                        </thead>


                        <tbody></tbody>


                        {{-- Footer --}}
                        <tfoot>

                            <tr class="table-primary fw-bold">

                                <th colspan="5" class="text-end">
                                    Page Total :
                                </th>

                                <th class="text-end" id="total_gross_salary">
                                    0.00Tk. 
                                </th>

                                <th class="text-end" id="total_deduction">
                                    0.00Tk.
                                </th>

                                <th class="text-end" id="total_net_salary">
                                    0.00Tk.
                                </th>

                                <th colspan="3"></th>

                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection


@push('js')

<script>

$(function () {

    var table = $('.dataTable').DataTable({

        processing: true,

        serverSide: true,

        scrollX: true,

        responsive: true,

        pageLength: 25,

        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],

        dom: 'Bfrtip',

        buttons: [

            {
                extend: 'excelHtml5',

                text: '<i class="fas fa-file-excel"></i> Excel',

                className: 'btn btn-success btn-sm',

                title: 'HRM Payroll Report',

                exportOptions: {
                    columns: [
                        0,
                        1,
                        2,
                        3,
                        4,
                        5,
                        6,
                        7,
                        8,
                        9,
                        10
                    ]
                }
            }

        ],


        ajax: {

            url: "{{ route('admin.hrm.report') }}",

            data: function (d) {

                d.from_date = $('#from_date').val();

                d.to_date = $('#to_date').val();

                d.employee_id = $('#employee_id').val();
                d.payment_status = $('#payment_status').val();

            }

        },


        columns: [

            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },

            {
                data: 'employee_code',
                name: 's.code'
            },

            {
                data: 'employee_name',
                name: 's.name'
            },

            {
                data: 'payroll_month',
                name: 'p.payroll_month'
            },

            {
                data: 'payroll_year',
                name: 'p.payroll_year'
            },

            {
                data: 'gross_salary',
                name: 'p.gross_salary'
            },

            {
                data: 'total_deduction',
                name: 'p.total_deduction',
                className: 'text-end'
            },

            {
                data: 'net_salary',
                name: 'p.net_salary',
                className: 'text-end'
            },

            {
                data: 'payment_date',
                name: 'p.payment_date'
            },

            {
                data: 'payment_status',
                name: 'p.payment_status',
                orderable: true,
                searchable: true
            },

            {
                data: 'remarks',
                name: 'p.remarks',

                render: function (data) {

                    return data ? data : '-';

                }
            }

        ],


        footerCallback: function (row, data, start, end, display) {

            var api = this.api();


            function parseValue(value) {

                if (typeof value === 'string') {

                    return parseFloat(
                        value.replace(/[^0-9.-]+/g, '')
                    ) || 0;

                }

                return parseFloat(value) || 0;

            }


            // Gross Salary
            var grossTotal = api
                .column(5, {
                    page: 'current'
                })
                .data()
                .reduce(function (a, b) {

                    return parseValue(a) + parseValue(b);

                }, 0);


            // Deduction
            var deductionTotal = api
                .column(6, {
                    page: 'current'
                })
                .data()
                .reduce(function (a, b) {

                    return parseValue(a) + parseValue(b);

                }, 0);


            // Net Salary
            var netTotal = api
                .column(7, {
                    page: 'current'
                })
                .data()
                .reduce(function (a, b) {

                    return parseValue(a) + parseValue(b);

                }, 0);


            $('#total_gross_salary').html(
                grossTotal.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + 'Tk.'
            );


            $('#total_deduction').html(
                deductionTotal.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + 'Tk.'
            );


            $('#total_net_salary').html(
                netTotal.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + 'Tk.'
            );

        }

    });


    // Filter Button
    $('#btnFilter').click(function () {

        table.ajax.reload();

    });


    // Auto Reload
    $('#from_date, #to_date, #employee_id, #payment_status').change(function () {

        table.ajax.reload();

    });


    // Reset
    $('#btnReset').click(function () {

        $('#from_date').val('');
        $('#to_date').val('');
        $('#employee_id').val('');
        $('#payment_status').val('');

        table.ajax.reload();

    });

});

</script>

@endpush