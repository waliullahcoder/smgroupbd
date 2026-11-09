
@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-uppercase">
                    <i class="fas fa-chart-line text-primary me-2"></i>
                    CRM Reports
                </h5>
            </div>

            <!-- Filter Section -->
            <div class="card-body border-bottom">

                <div class="row g-3 align-items-end">

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

                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-bold">
                            <i class="fas fa-bullhorn text-success me-1"></i>
                            Lead Source
                        </label>

                        <select id="lead_source_id" class="form-select">
                            <option value="">All Lead Sources</option>
                            @foreach($lead_sources as $row)
                            <option value="{{ $row->id }}">
                                {{ $row->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-bold">
                            <i class="fas fa-flag text-warning me-1"></i>
                            Lead Status
                        </label>

                        <select id="lead_status_id" class="form-select">
                            <option value="">All Status</option>
                            @foreach($lead_statuses as $row)
                            <option value="{{ $row->id }}">
                                {{ $row->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-12">

                        <div class="d-grid gap-2">

                            <button type="button" id="btnFilter" class="btn btn-primary">
                                <i class="fas fa-search me-1"></i>
                                Filter
                            </button>

                            <button type="button" id="btnReset" class="btn btn-outline-secondary">
                                <i class="fas fa-sync-alt me-1"></i>
                                Reset
                            </button>

                        </div>

                    </div>

                </div>

            </div>
            <!-- End Filter -->

            <div class="card-body">

                <div class="table-responsive">

                     <table class="table dataTable align-middle" style="width:100%">

                        <thead class="table-dark text-nowrap">

                            <tr>
                                <th>SL</th>
                                <th>Lead No</th>
                                <th>Lead Date</th>
                                <th>Company</th>
                                <th>Mobile</th>
                                <th>Lead Source</th>
                                <th>Lead Status</th>
                                <th>Proposal(Tk.)</th>
                                <th>Expected(Tk.)</th>
                                <th style="width:20%">Remarks</th>
                                <th>Remark(Updated)</th>
                            </tr>
                        </thead>

                        <tbody style="width:100%"></tbody>
                    <tfoot>
                        <tr class="table-primary fw-bold" style="width:100%">
                            <th colspan="7" class="text-end">Total :</th>
                            <th id="total_proposal_value">0.00</th>
                            <th id="total_expected_value">0.00</th>
                            <th colspan="2" class="text-end"></th>
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
$(function() {

    var table = $('.dataTable').DataTable({

        processing: true,
        serverSide: true,
        scrollX: true,
        responsive: true,
	
	    
        dom: 'Bfrtip',

        buttons: [

            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> Excel',
                className: 'btn btn-success btn-sm',
                title: 'CRM Lead Report',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9,10]
                }
            }

        ],

        ajax: {

            url: "{{ route('admin.crm-report.index') }}",

            data: function(d) {

                d.from_date = $('#from_date').val();
                d.to_date = $('#to_date').val();
                d.lead_source_id = $('#lead_source_id').val();
                d.lead_status_id = $('#lead_status_id').val();

            }

        },

        columns: [

           {data:'id', name:'l.id'},
           {data:'lead_no', name:'l.lead_no'},
           {data:'follow_up_date', name:'l.follow_up_date'},
           {data:'company_name', name:'l.company_name'},
           {data:'mobile', name:'l.mobile'},
           {data:'lead_source', name:'ls.name'},
           {data:'lead_status', name:'st.name'},
           {data:'proposal_value', name:'l.proposal_value'},
           {data:'expected_value', name:'l.expected_value'},
           {data:'remarks', name:'l.remarks'},
           {data:'updated_at', name:'l.updated_at'},
          

        ],
         footerCallback: function (row, data, start, end, display) {

            var api = this.api();

            function parseValue(value) {
                if (typeof value === 'string') {
                    return parseFloat(value.replace(/[^0-9.-]+/g, '')) || 0;
                }
                return parseFloat(value) || 0;
            }

            // Proposal Value (Column 8)
            var proposalTotal = api
                .column(7, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return parseValue(a) + parseValue(b);
                }, 0);

            // Expected Value (Column 9)
            var expectedTotal = api
                .column(8, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return parseValue(a) + parseValue(b);
                }, 0);

           $('#total_proposal_value').html(proposalTotal.toLocaleString() + ' Tk.');
		   $('#total_expected_value').html(expectedTotal.toLocaleString() + ' Tk.');

        },

    });

    // Filter
    $('#btnFilter').click(function() {

        table.ajax.reload();

    });

    // Auto Reload
    $('#from_date,#to_date,#lead_source_id,#lead_status_id').change(function() {

        table.ajax.reload();

    });

    // Reset
    $('#btnReset').click(function() {

        $('#from_date').val('');
        $('#to_date').val('');
        $('#lead_source_id').val('');
        $('#lead_status_id').val('');

        table.ajax.reload();

    });

    

});

</script>

@endpush
