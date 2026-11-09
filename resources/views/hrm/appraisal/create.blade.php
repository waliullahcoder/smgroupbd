@extends('layouts.admin.app')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-gift text-success"></i>
            Add Appraisal
        </h5>

        <a href="{{ route('admin.appraisal.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

    </div>

    <form action="{{ route('admin.appraisal.store') }}" method="POST">

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
                    <label class="form-label">Overall Rating (100 points) <span class="text-danger">*</span></label>

                    <input type="number"
                           name="overall_rating"
                           max="100"
                           class="form-control"
                           required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Appraisal Period (months) <span class="text-danger">*</span></label>

                    <input type="number"
                           name="appraisal_period"
                           max="100"
                           class="form-control"
                           required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Appraisal Date <span class="text-danger">*</span></label>
                    <input type="date"
                           name="appraisal_date"
                           class="form-control"
                           value="{{ date('Y-m-d') }}"
                           required>
                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Appraisal Summary</label>
                    <textarea name="summary"
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
