@extends('layouts.admin.app')

@section('content')

<div class="row">

    <div class="col-lg-12">

        <form action="{{ Route('admin.customer-requirement.store') }}" method="POST">

            @csrf

            <div class="card">

                <div class="card-header">

                    <div class="d-flex justify-content-between">

                        <h6 class="mb-0">
                            Add Customer Requirements
                        </h6>

                        <div>

                            <a href="{{ Route('admin.customer-requirement.index') }}" class="btn btn-primary btn-sm">
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

                            <label>
                                Date
                            </label>

                            <input type="req_date" name="req_date" class="form-control" value="{{ date('Y-m-d') }}"
                                required>

                        </div>
                        <div class="col-md-6">

                        <label>
                            Record Time
                        </label>

                        <input type="time" name="record_time" class="form-control" required>

                         </div>

                        <div class="col-md-6">

                            <label>
                                Customer
                            </label>

                            <select name="lead_id" class="form-control select2">
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

                            <select name="meeting_type" class="form-control">
                                <option>Online</option>
                                <option>Physical</option>
                                <option>Phone Call</option>

                            </select>

                        </div>

                        <div class="col-md-6">

                            <label>
                                Related Module
                            </label>

                            <select name="related_module" class="form-control">
                                <option>Production</option>
                                <option>Software</option>
                                <option>Raw Materials</option>
                                <option>Services</option>
                                <option>Support</option>
                            </select>

                        </div>
                        <div class="col-md-6">

                            <label>
                                Requirement Status
                            </label>

                            <select name="requirement_status" class="form-control">

                                <option value="1">
                                    Scheduled
                                </option>

                                <option value="2">
                                    Confirmed
                                </option>

                                <option value="3">
                                    Cancelled
                                </option>

                            </select>

                        </div>
                        <div class="col-md-12">

                            <label>
                                Requirement Details
                            </label>

                            <textarea name="requirement_details" id="description" class="description" cols="30"
                                rows="10">{!! old('requirement_details') !!}</textarea>
                        </div>

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