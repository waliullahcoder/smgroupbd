@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h4 class="mb-1 fw-bold">
                        <i class="fas fa-user-tie text-primary"></i>
                        Lead Details
                    </h4>

                    <small class="text-muted">
                        View complete lead information
                    </small>
                </div>

                <a href="{{ route('admin.lead.index') }}"
                   class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>

            </div>

        </div>
    </div>

    <div class="row">

        <!-- Left Side -->

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center"
                         style="width:90px;height:90px;font-size:35px;">

                        {{ strtoupper(substr($data->company_name,0,1)) }}

                    </div>

                    <h4 class="mt-3 mb-1">
                        {{ $data->company_name }}
                    </h4>

                    <h6 class="text-muted">
                        {{ $data->contact_person }}
                    </h6>

                    <hr>

                    <div class="row text-start">

                        <div class="col-12 mb-3">

                            <small class="text-muted">Lead Number</small>

                            <h6>{{ $data->lead_no }}</h6>

                        </div>

                        <div class="col-12 mb-3">

                            <small class="text-muted">Mobile</small>

                            <h6>{{ $data->mobile }}</h6>

                        </div>

                        <div class="col-12 mb-3">

                            <small class="text-muted">Email</small>

                            <h6>{{ $data->email ?? '-' }}</h6>

                        </div>

                        <div class="col-12">

                            <small class="text-muted">Website</small>

                            <h6>{{ $data->website ?? '-' }}</h6>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Right Side -->

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Lead Information
                    </h5>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-4">
                            <label class="text-muted">Lead Source</label>

                            <h6>{{ $data->lead_source }}</h6>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="text-muted">Lead Status</label>

                            <span class="badge px-3 py-2"
                                  style="background:{{ $data->lead_status_color }};">
                                {{ $data->lead_status }}
                            </span>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="text-muted">
                                Priority
                            </label>

                            <h6>{{ $data->priority }}</h6>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="text-muted">
                                Assigned To
                            </label>

                            <h6>{{ $data->assigned_to }}</h6>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="text-muted">
                                Proposal Value
                            </label>

                            <h6>
                                {{ number_format($data->proposal_value,2) }}
                            </h6>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="text-muted">
                                Expected Value
                            </label>

                            <h6>
                                {{ number_format($data->expected_value,2) }}
                            </h6>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="text-muted">
                                Lead Date
                            </label>

                            <h6>
                                {{ date('d M Y',strtotime($data->follow_up_date)) }}
                            </h6>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="text-muted">
                                Next Follow Up
                            </label>

                            <h6>
                                {{ date('d M Y',strtotime($data->next_follow_up)) }}
                            </h6>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="text-muted">
                                Created By
                            </label>

                            <h6>{{ $data->created_by_name }}</h6>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="text-muted">
                                Created At
                            </label>

                            <h6>
                                {{ date('d M Y h:i A',strtotime($data->created_at)) }}
                            </h6>

                        </div>

                        <div class="col-12 mb-4">

                            <label class="text-muted">
                                Address
                            </label>

                            <div class="border rounded p-3">

                                {{ $data->address ?: 'N/A' }}

                            </div>

                        </div>

                        <div class="col-12">

                            <label class="text-muted">
                                Remarks
                            </label>

                            <div class="border rounded p-3">

                                {{ $data->remarks ?: 'N/A' }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection