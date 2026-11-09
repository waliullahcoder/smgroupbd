@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-lg-12">

        <form action="{{ Route('admin.meeting-schedule.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">

                        <h6 class="mb-0 text-uppercase">
                            Edit Meeting Schedule
                        </h6>

                        <div>
                            <a href="{{ Route('admin.meeting-schedule.index') }}" class="btn btn-primary btn-sm">
                                Back
                            </a>

                            <button type="submit" class="btn btn-primary btn-sm">
                                Update
                            </button>
                        </div>

                    </div>
                </div>

                <div class="card-body">

                    <div class="row g-3">

                        {{-- Meeting Title --}}
                        <div class="col-md-6">
                            <label class="form-label require"><b>Meeting Title</b></label>

                            <input type="text"
                                   name="meeting_title"
                                   class="form-control"
                                   value="{{ old('meeting_title', $data->meeting_title) }}"
                                   required>
                        </div>

                        {{-- Lead --}}
                        <div class="col-md-6">
                            <label class="form-label require"><b>Lead</b></label>

                            <select name="lead_id" class="form-control select2" required>

                                <option value="">Select Lead</option>

                                @foreach($leads as $lead)

                                    <option value="{{ $lead->id }}"
                                        {{ old('lead_id', $data->lead_id) == $lead->id ? 'selected' : '' }}>
                                        {{ $lead->company_name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- Meeting Type --}}
                        <div class="col-md-6">

                            <label class="form-label"><b>Meeting Type</b></label>

                            <select name="meeting_type" class="form-control">

                                <option value="Physical"
                                    {{ old('meeting_type', $data->meeting_type) == 'Physical' ? 'selected' : '' }}>
                                    Physical
                                </option>

                                <option value="Online"
                                    {{ old('meeting_type', $data->meeting_type) == 'Online' ? 'selected' : '' }}>
                                    Online
                                </option>

                                <option value="Phone Call"
                                    {{ old('meeting_type', $data->meeting_type) == 'Phone Call' ? 'selected' : '' }}>
                                    Phone Call
                                </option>

                            </select>

                        </div>

                        {{-- Related Module --}}
                        <div class="col-md-6">

                            <label class="form-label"><b>Related Module</b></label>

                            <select name="related_module" class="form-control">

                                @foreach(['Lead','Customer','Contact','Opportunity'] as $module)

                                    <option value="{{ $module }}"
                                        {{ old('related_module', $data->related_module) == $module ? 'selected' : '' }}>
                                        {{ $module }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- Meeting Details --}}
                        <div class="col-md-12">

                            <label class="form-label"><b>Meeting Details</b></label>

                            <textarea name="meeting_details"
                                      rows="4"
                                      class="form-control">{{ old('meeting_details', $data->meeting_details) }}</textarea>

                        </div>

                        {{-- Meeting Date --}}
                        <div class="col-md-4">

                            <label class="form-label require"><b>Meeting Date</b></label>

                            <input type="date"
                                   name="meeting_date"
                                   class="form-control"
                                   value="{{ old('meeting_date', $data->meeting_date) }}"
                                   required>

                        </div>

                        {{-- Start Time --}}
                        <div class="col-md-4">

                            <label class="form-label require"><b>Start Time</b></label>

                            <input type="time"
                                   name="start_time"
                                   class="form-control"
                                   value="{{ old('start_time', $data->start_time) }}"
                                   required>

                        </div>

                        {{-- End Time --}}
                        <div class="col-md-4">

                            <label class="form-label require"><b>End Time</b></label>

                            <input type="time"
                                   name="end_time"
                                   class="form-control"
                                   value="{{ old('end_time', $data->end_time) }}"
                                   required>

                        </div>

                        {{-- Meeting Status --}}
                        <div class="col-md-6">

                            <label class="form-label"><b>Meeting Status</b></label>

                            <select name="meeting_status" class="form-control">

                                <option value="1"
                                    {{ old('meeting_status', $data->meeting_status) == 1 ? 'selected' : '' }}>
                                    Scheduled
                                </option>

                                <option value="2"
                                    {{ old('meeting_status', $data->meeting_status) == 2 ? 'selected' : '' }}>
                                    Completed
                                </option>

                                <option value="3"
                                    {{ old('meeting_status', $data->meeting_status) == 3 ? 'selected' : '' }}>
                                    Cancelled
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                <div class="card-footer text-end">

                    <button type="submit" class="btn btn-primary btn-sm">
                        Update
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>

@endsection