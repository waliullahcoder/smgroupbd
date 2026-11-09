@extends('layouts.admin.app')

@section('content')

<div class="row g-3">
    <div class="col-12">

        <form action="{{ route('admin.lead.update',$data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card">

                <div class="card-header py-2">
                    <div class="d-flex justify-content-between align-items-center">

                        <h6 class="mb-0 text-uppercase">
                            Edit Lead
                        </h6>

                        <div>

                            <a href="{{ route('admin.lead.index') }}"
                                class="btn btn-primary btn-sm">
                                Go Back
                            </a>

                            <button type="submit" class="btn btn-success btn-sm">
                                Update
                            </button>

                        </div>

                    </div>
                </div>

                <div class="card-body">

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label"><b>Lead No</b></label>
                            <input type="text"
                                name="lead_no"
                                class="form-control"
                                value="{{ old('lead_no',$data->lead_no) }}"
                                readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><b>Company</b></label>
                            <input type="text"
                                name="company_name"
                                class="form-control"
                                value="{{ old('company_name',$data->company_name) }}"
                                required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><b>Contact Person</b></label>
                            <input type="text"
                                name="contact_person"
                                class="form-control"
                                value="{{ old('contact_person',$data->contact_person) }}"
                                required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><b>Mobile</b></label>
                            <input type="text"
                                name="mobile"
                                class="form-control"
                                value="{{ old('mobile',$data->mobile) }}"
                                required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><b>Email</b></label>
                            <input type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email',$data->email) }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><b>Website</b></label>
                            <input type="text"
                                name="website"
                                class="form-control"
                                value="{{ old('website',$data->website) }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><b>Lead Source</b></label>

                            <select name="lead_source_id"
                                class="select form-select"
                                required>

                                @foreach($lead_sources as $row)

                                <option value="{{ $row->id }}"
                                    {{ old('lead_source_id',$data->lead_source_id)==$row->id ? 'selected' : '' }}>
                                    {{ $row->name }}
                                </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4">

                            <label class="form-label"><b>Lead Status</b></label>

                            <select name="lead_status_id"
                                class="select form-select"
                                required>

                                @foreach($lead_statuses as $row)

                                <option value="{{ $row->id }}"
                                    {{ old('lead_status_id',$data->lead_status_id)==$row->id ? 'selected' : '' }}>
                                    {{ $row->name }}
                                </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-4">

                            <label class="form-label"><b>Priority</b></label>

                            <select name="priority"
                                class="select form-select"
                                required>

                                <option value="Low"
                                    {{ old('priority',$data->priority)=='Low'?'selected':'' }}>
                                    Low
                                </option>

                                <option value="Medium"
                                    {{ old('priority',$data->priority)=='Medium'?'selected':'' }}>
                                    Medium
                                </option>

                                <option value="High"
                                    {{ old('priority',$data->priority)=='High'?'selected':'' }}>
                                    High
                                </option>

                                <option value="Urgent"
                                    {{ old('priority',$data->priority)=='Urgent'?'selected':'' }}>
                                    Urgent
                                </option>

                            </select>

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                <b>Proposal Value</b>
                            </label>

                            <input type="number"
                                class="form-control"
                                name="proposal_value"
                                value="{{ old('proposal_value',$data->proposal_value) }}">

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                <b>Expected Value</b>
                            </label>

                            <input type="number"
                                class="form-control"
                                name="expected_value"
                                value="{{ old('expected_value',$data->expected_value) }}">

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                <b>Lead Date</b>
                            </label>

                            <input type="date"
                                class="form-control"
                                name="follow_up_date"
                                value="{{ old('follow_up_date',$data->follow_up_date) }}">

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                <b>Next Follow-up</b>
                            </label>

                            <input type="date"
                                class="form-control"
                                name="next_follow_up"
                                value="{{ old('next_follow_up',$data->next_follow_up) }}">

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                <b>Assigned To</b>
                            </label>

                            <select name="assigned_to"
                                class="select form-select"
                                required>

                                @foreach($users as $user)

                                <option value="{{ $user->id }}"
                                    {{ old('assigned_to',$data->assigned_to)==$user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                <b>Status</b>
                            </label>

                            <select name="status"
                                class="form-control">

                                <option value="1"
                                    {{ old('status',$data->status)==1 ? 'selected':'' }}>
                                    Active
                                </option>

                                <option value="0"
                                    {{ old('status',$data->status)==0 ? 'selected':'' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                <b>Address</b>
                            </label>

                            <textarea class="form-control"
                                rows="4"
                                name="address">{{ old('address',$data->address) }}</textarea>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                <b>Remarks</b>
                            </label>

                            <textarea class="form-control"
                                rows="4"
                                name="remarks">{{ old('remarks',$data->remarks) }}</textarea>

                        </div>

                    </div>

                </div>

                <div class="card-footer text-end">

                    <button type="submit"
                        class="btn btn-success">
                        Update Lead
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>

@endsection