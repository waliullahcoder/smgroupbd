@extends('layouts.admin.app')

@section('content')

<div class="row g-3">

    <div class="col-12">

        <div class="card">

            <div class="card-header">

                <div class="d-flex justify-content-between">

                    <h6 class="mb-0 text-uppercase">
                        Customer Requirements
                    </h6>

                    <a href="{{ Route('admin.customer-requirement.create') }}"
                        class="btn btn-primary btn-sm">
                        Add New
                    </a>

                </div>

            </div>

            <div class="card-body">

                 <table class="table dataTable align-middle" style="width:100%">

                    <thead>

                    <tr>

                        <th>ID</th>
                        <th>Lead</th>
                        <th>Meeting Type</th>
                        <th>Related Module</th>
                        <th>Date</th>
                        <th>Record Time</th>
                        <th>Status</th>
                        <th>Action</th>

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
scrollX:true,

ajax:"{{ Route('admin.customer-requirement.index') }}",

columns:[

{
data:'id',
name:'id'
},
{
data:'company_name',
name:'l.company_name'
},

{
data:'meeting_type',
name:'ms.meeting_type'
},

{
data:'related_module',
name:'ms.related_module'
},

{
data:'req_date',
name:'ms.req_date'
},

{
data:'record_time',
name:'ms.record_time'
},


{
data:'requirement_status',
name:'ms.requirement_status',
orderable:false,
searchable:false
},

{
data:'actions',
name:'actions',
orderable:false,
searchable:false
}

],

drawCallback:function(){

$('.tt').tooltip();

}

});

</script>

@endpush