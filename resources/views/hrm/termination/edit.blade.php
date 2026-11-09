@extends('layouts.admin.app')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-edit text-warning"></i>
            Edit Termination
        </h5>

        <a href="{{ route('admin.termination.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

    </div>

    <form action="{{ route('admin.termination.update',$termination->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Employee <span class="text-danger">*</span>
                    </label>

                    <select name="employee_id" class="form-select select" required>
                        @foreach($employees as $employee)

                            <option value="{{ $employee->id }}"
                                {{ $termination->employee_id == $employee->id ? 'selected' : '' }}>

                                {{ $employee->id }} - {{ $employee->name }}

                            </option>

                        @endforeach

                    </select>

                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Termination Date <span class="text-danger">*</span></label>
                    <input type="date"
                           name="termination_date"
                           class="form-control"
                           value="{{ $termination->termination_date }}"
                           required>
                </div>
                 <div class="col-md-3 mb-3">
                    <label class="form-label">Last Working Date <span class="text-danger">*</span></label>
                    <input type="date"
                           name="last_working_date"
                           class="form-control"
                           value="{{ $termination->last_working_date }}"
                           required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Notice Period (Months) <span class="text-danger">*</span></label>
                    <input type="number"
                           name="notice_period"
                           class="form-control"
                           value="{{ $termination->notice_period }}"
                           required>
                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Status</label>

                    <select name="status" class="form-select">

                        <option value="Pending"
                            {{ $termination->status=='Pending'?'selected':'' }}>
                            Pending
                        </option>

                        <option value="Approved"
                            {{ $termination->status=='Approved'?'selected':'' }}>
                            Approved
                        </option>

                    </select>

                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">termination Reason</label>
                    <textarea name="reason"
                              rows="1"
                              class="form-control">{{ $termination->reason }}</textarea>
                </div>

            </div>

        </div>

        <div class="card-footer text-end">

            <button type="submit" class="btn btn-warning">

                <i class="fas fa-save"></i> Update

            </button>

        </div>

    </form>

</div>

@endsection