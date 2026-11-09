@extends('layouts.admin.app')

@section('content')

<div class="row g-3">
    <div class="col-12">

        <form action="{{ Route('admin.lead.store') }}" method="POST">
            @csrf

            <div class="card">

                <div class="card-header py-2">
                    <div class="d-flex justify-content-between align-items-center">

                        <h6 class="mb-0 text-uppercase">
                            Lead Management
                        </h6>

                        <div>

                            <a href="{{ Route('admin.lead.index') }}"
                                class="btn btn-primary btn-sm">
                                Go Back
                            </a>

                            <button class="btn btn-primary btn-sm">
                                Save
                            </button>

                        </div>

                    </div>
                </div>

                <div class="card-body">

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label"><b>Lead No</b></label>
                            <input type="text" name="lead_no" class="form-control" value="{{ $leadno }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><b>Company</b></label>
                            <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}" placeholder="Name of Company" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><b>Contact Person</b></label>
                            <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person') }}" placeholder="Name of Contact Person" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label required"><b>Mobile</b></label>
                            <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><b>Email</b></label>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><b>Website</b></label>
                            <input type="text" name="website" class="form-control" value="{{ old('website') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><b>Lead Source</b></label>
                            <select name="lead_source_id" id="lead_source_id" class="select form-select" data-placeholder="Select Lead Source" required>
                                @foreach($lead_sources as $row)
                                    <option value="{{ $row->id }}">
                                        {{ $row->name }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><b>Lead Status</b></label>
                        <select name="lead_status_id" id="lead_status_id" class="select form-select" data-placeholder="Select Lead Status" required>
                                @foreach($lead_statuses as $row)

                                    <option value="{{ $row->id }}">
                                        {{ $row->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4">

                            <label class="form-label"><b>Priority</b></label>
                            <select name="priority" id="priority" class="select form-select" data-placeholder="Select Priority" required>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                                <option value="Urgent">Urgent</option>

                            </select>

                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><b>Proposal Value (Amount)</b></label>

                            <input type="number"
                                   class="form-control"
                                   name="proposal_value">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><b>Expected Value (Amount)</b></label>

                            <input type="number"
                                   class="form-control"
                                   name="expected_value">
                        </div>

                      
                        <div class="col-md-4">
                            <label class="form-label">
                                <b> Lead Date</b>
                            </label>
                            <input type="date"
                            class="form-control"
                            name="follow_up_date"
                            value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                <b>Next Follow-up</b>
                            </label>
                            <input type="date"
                            class="form-control"
                            name="next_follow_up"
                            value="{{ date('Y-m-d') }}">
                        </div>
                          <div class="col-md-4">
                            <label class="form-label"><b>Assigned To</b></label>
                             <select name="assigned_to" id="assigned_to" class="select form-select" data-placeholder="Select User" required>
                                <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                @foreach($users as $user)

                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>

                                @endforeach
                            </select>
                        </div>
                         <div class="col-4">
                            <label for="status" class="form-label">
                                <b>Status</b>
                            </label>
                            <div class="custom-select">
                                <select class="form-control select2 custom-select__element"
                                    name="status"
                                    id="status">

                                    <option value="1" selected>
                                        Active
                                    </option>

                                    <option value="0">
                                        Inactive
                                    </option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="address" class="form-label">
                                <b>Address</b>
                            </label>
                            <textarea
                                class="form-control"
                                id="address"
                                name="address"
                                rows="4"
                                placeholder="Address">{{ old('Address') }}</textarea>
                        </div>
                        <div class="col-6">
                            <label for="remarks" class="form-label">
                                <b>Remarks</b>
                            </label>
                            <textarea
                                class="form-control"
                                id="remarks"
                                name="remarks"
                                rows="4"
                                placeholder="Remarks">{{ old('remarks') }}</textarea>
                        </div>

                    </div>

                </div>

                <div class="card-footer text-end">

                    <button class="btn btn-primary btn-sm">
                        Save
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>

@endsection