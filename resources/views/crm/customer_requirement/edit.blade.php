@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-lg-12">

        <form action="{{ Route('admin.customer-requirement.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">

                        <h6 class="mb-0 text-uppercase">
                            Edit Customer Requirements
                        </h6>

                        <div>
                            <a href="{{ Route('admin.customer-requirement.index') }}" class="btn btn-primary btn-sm">
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
                         {{-- Date --}}
                        <div class="col-md-6">

                            <label class="form-label require"><b> Date</b></label>

                            <input type="date"
                                   name="req_date"
                                   class="form-control"
                                   value="{{ old('req_date', $data->req_date) }}"
                                   required>

                        </div>

                        {{-- Record Time --}}
                        <div class="col-md-6">

                            <label class="form-label require"><b>Record Time</b></label>

                            <input type="time"
                                   name="record_time"
                                   class="form-control"
                                   value="{{ old('record_time', $data->record_time) }}"
                                   required>

                        </div>

                       

                     
                        {{-- Lead --}}
                        <div class="col-md-6">
                            <label class="form-label require"><b>Customer</b></label>

                            <select name="lead_id" class="form-control select2" required>

                                <option value="">Select Customer</option>

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

                                @foreach(['Production','Software','Raw Materials','Services','Support'] as $module)

                                    <option value="{{ $module }}"
                                        {{ old('related_module', $data->related_module) == $module ? 'selected' : '' }}>
                                        {{ $module }}
                                    </option>

                                @endforeach

                            </select>

                        </div>
                        

                        {{-- Requirement Status --}}
                        <div class="col-md-6">

                            <label class="form-label"><b>Requirement Status</b></label>

                            <select name="requirement_status" class="form-control">

                                <option value="1"
                                    {{ old('requirement_status', $data->requirement_status) == 1 ? 'selected' : '' }}>
                                    Scheduled
                                </option>

                                <option value="2"
                                    {{ old('requirement_status', $data->requirement_status) == 2 ? 'selected' : '' }}>
                                    Confirmed
                                </option>

                                <option value="3"
                                    {{ old('requirement_status', $data->requirement_status) == 3 ? 'selected' : '' }}>
                                    Cancelled
                                </option>

                            </select>

                        </div>

                        {{-- Requirement Details --}}
                        <div class="col-md-12">

                            <label class="form-label"><b>Requirement Details</b></label>

                            <textarea name="requirement_details" id="description" class="description" cols="30"
                                rows="10">{!! $data->requirement_details !!}</textarea>

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