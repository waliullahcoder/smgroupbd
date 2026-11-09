@extends('layouts.admin.app')

@section('content')
<div class="row g-3">
    <div class="col-12">
        <div class="card">

            <div class="card-header pe-2 py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="h6 mb-0 text-uppercase">
                        Lead Management
                    </h6>

                    <a href="{{ Route('admin.lead.create') }}"
                        class="btn btn-primary btn-sm">
                        Add New
                    </a>
                </div>
            </div>

            <div class="card-body">

                <table class="table dataTable align-middle" style="width:100%">
                    <thead>
                        <tr class="text-nowrap">
                            <th>SL</th>
                            <th>Lead No</th>
                            <th>Company</th>
                            <th>Contact Person</th>
                            <th>Mobile</th>
                            <th>Lead Source</th>
                            <th>Lead Status</th>
                            <th>Priority</th>
                            <th>Expected Value</th>
                            <!-- <th>Assigned To</th> -->
                            <th>Next Follow-up</th>
                            <th width="140" class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody></tbody>

                </table>

            </div>

        </div>
    </div>
</div>

<!-- Modlal -->
<div class="modal fade" id="statusModal">
    <div class="modal-dialog">
        <form id="statusForm" method="POST">
            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Update Lead Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Lead Status</label>

                        <select name="lead_status_id" id="lead_status_id" class="form-select">

                            @foreach($lead_statuses as $status)
                                <option value="{{ $status->id }}">
                                    {{ $status->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Remarks</label>

                        <textarea class="form-control"
                            name="remarks"
                            id="remarks"></textarea>
                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-primary">
                        Update
                    </button>

                </div>

            </div>
        </form>
    </div>
</div>
<!-- Modlal -->
<div class="modal fade" id="statusModal">
    <div class="modal-dialog">
        <form id="statusForm" method="POST">
            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Update Lead Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Lead Status</label>

                        <select name="lead_status_id"
                                class="select form-select"
                                required>

                                @foreach($lead_statuses as $row)

                                <option value="{{ $row->id }}">
                                    {{ $row->name }}
                                </option>

                                @endforeach

                            </select>
                    </div>

                    <div class="mb-3">
                        <label>Remarks</label>

                        <textarea class="form-control"
                            name="remarks"
                            id="remarks"></textarea>
                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-primary">
                        Update
                    </button>

                </div>

            </div>
        </form>
    </div>
</div>
<!-- Modlal -->
@endsection

@push('js')

<script>

        $(function(){
            $(document).on('click','.btn-status',function(){

            let id=$(this).data('id');

            $('#lead_status_id').val($(this).data('statusid'));

            $('#remarks').val($(this).data('remarks'));

            $('#statusForm').attr('action','/admin/lead/'+id+'/status');

            $('#statusModal').modal('show');

        });

    $('.dataTable').DataTable({

        processing:true,
        serverSide:true,
        scrollX:true,
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
        
        ajax:{
            url:"{{ Route('admin.lead.index') }}",
            type:"GET"
        },

        columns: [
        {data:'id', name:'l.id'},
        {data:'lead_no', name:'l.lead_no'},
        {data:'company_name', name:'l.company_name'},
        {data:'contact_person', name:'l.contact_person'},
        {data:'mobile', name:'l.mobile'},
        {data:'lead_source', name:'ls.name'},
        {data:'lead_status', name:'st.name'},
        {data:'priority', name:'l.priority'},
        {data:'expected_value', name:'l.expected_value'},
        // {data:'assigned_to', name:'u.name'},
        {data:'next_follow_up', name:'l.next_follow_up'},
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