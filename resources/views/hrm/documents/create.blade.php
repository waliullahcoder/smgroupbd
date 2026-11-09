@extends('layouts.admin.app')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-gift text-success"></i>
            Add Document
        </h5>

        <a href="{{ route('admin.documents.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

    </div>

    <form action="{{ route('admin.documents.store') }}" method="POST">

        @csrf

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Employee <span class="text-danger">*</span></label>
                    <select name="employee_id" class="form-select select" required>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->id }} - {{ $employee->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Document Type <span class="text-danger">*</span></label>
                    <select name="document_type" class="form-select" required>
                        <option value="ALL">ALL</option>
                        <option value="NID">NID</option>
                        <option value="Passport">Passport</option>
                        <option value="Birth Certificate">Birth Certificate</option>
                        <option value="Driving License">Driving License</option>
                        <option value="Educational Certificate">Educational Certificate</option>
                        <option value="Experience Certificate">Experience Certificate</option>
                        <option value="Joining Letter">Joining Letter</option>
                        <option value="Appointment Letter">Appointment Letter</option>
                        <option value="TIN Certificate">TIN Certificate</option>
                        <option value="Bank Account Document">Bank Account Document</option>
                        <option value="Photo">Photo</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                

                <div class="col-md-6 mb-3">
                    <label class="form-label">Document Name <span class="text-danger">*</span></label>

                    <input type="text"
                           name="document_name"
                           class="form-control"
                           required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Document Link <span class="text-danger">*</span></label>

                    <input type="text"
                           name="document_link"
                           class="form-control"
                           required>
                </div>
                

                <div class="col-md-3 mb-3">
                    <label class="form-label">Submit Date <span class="text-danger">*</span></label>

                    <input type="date"
                           name="submit_date"
                           class="form-control"
                           value="{{ date('Y-m-d') }}"
                           required>
                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="Pending">Pending</option>
                        <option value="Submitted">Submitted</option>
                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Remarks</label>

                    <textarea name="remarks"
                              rows="1"
                              class="form-control"></textarea>

                </div>

            </div>

        </div>

        <div class="card-footer text-end">

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Save
            </button>

        </div>

    </form>

</div>

@endsection
