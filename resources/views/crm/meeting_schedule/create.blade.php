@extends('layouts.admin.app')

@section('content')

<div class="row">

<div class="col-lg-12">

<form action="{{ Route('admin.meeting-schedule.store') }}" method="POST">

@csrf

<div class="card">

<div class="card-header">

<div class="d-flex justify-content-between">

<h6 class="mb-0">
Meeting Schedule
</h6>

<div>

<a href="{{ Route('admin.meeting-schedule.index') }}"
class="btn btn-primary btn-sm">
Back
</a>

<button class="btn btn-primary btn-sm">
Save
</button>

</div>

</div>

</div>

<div class="card-body">

<div class="row g-3">

<div class="col-md-6">

<label class="form-label">
Meeting Title
</label>

<input
type="text"
name="meeting_title"
class="form-control"
required>

</div>

<div class="col-md-6">

<label>
Lead
</label>

<select
name="lead_id"
class="form-control select2">

<option value="">
Select Lead
</option>

@foreach($leads as $lead)

<option value="{{$lead->id}}">
{{$lead->company_name}}
</option>

@endforeach

</select>

</div>

<div class="col-md-6">

<label>
Meeting Type
</label>

<select
name="meeting_type"
class="form-control">

<option>Physical</option>

<option>Online</option>

<option>Phone Call</option>

</select>

</div>

<div class="col-md-6">

<label>
Related Module
</label>

<select
name="related_module"
class="form-control">

<option>Lead</option>

<option>Customer</option>

<option>Contact</option>

<option>Opportunity</option>

</select>

</div>

<div class="col-md-12">

<label>
Meeting Details
</label>

<textarea
name="meeting_details"
class="form-control"
rows="4"></textarea>

</div>

<div class="col-md-4">

<label>
Meeting Date
</label>

<input
type="date"
name="meeting_date"
class="form-control"
required>

</div>

<div class="col-md-4">

<label>
Start Time
</label>

<input
type="time"
name="start_time"
class="form-control"
required>

</div>

<div class="col-md-4">

<label>
End Time
</label>

<input
type="time"
name="end_time"
class="form-control"
required>

</div>

<div class="col-md-6">

<label>
Meeting Status
</label>

<select
name="meeting_status"
class="form-control">

<option value="1">
Scheduled
</option>

<option value="2">
Completed
</option>

<option value="3">
Cancelled
</option>

</select>

</div>

</div>

</div>

<div class="card-footer text-end">

<button
class="btn btn-primary btn-sm">
Save
</button>

</div>

</div>

</form>

</div>

</div>

@endsection