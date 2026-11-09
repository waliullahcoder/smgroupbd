@extends('layouts.admin.app')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-edit text-warning"></i>
            Edit Appraisal
        </h5>

        <a href="{{ route('admin.appraisal.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

    </div>

    <form action="{{ route('admin.appraisal.update',$appraisal->id) }}" method="POST">

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
                                {{ $appraisal->employee_id == $employee->id ? 'selected' : '' }}>

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
                           value="{{ $appraisal->overall_rating }}"
                           required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Appraisal Period (months-max 100) <span class="text-danger">*</span></label>

                    <input type="number"
                           name="appraisal_period"
                           max="100"
                           class="form-control"
                        value="{{ $appraisal->appraisal_period }}"
                           required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Appraisal Date <span class="text-danger">*</span></label>
                    <input type="date"
                           name="appraisal_date"
                           class="form-control"
                           value="{{ $appraisal->appraisal_date }}"
                           required>
                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                         <option value="Pending"
                            {{ $appraisal->status=='Pending'?'selected':'' }}>
                            Pending
                        </option>

                        <option value="Approved"
                            {{ $appraisal->status=='Approved'?'selected':'' }}>
                            Approved
                        </option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Appraisal Summary</label>
                    <textarea name="summary"
                              rows="1"
                              class="form-control">{{ $appraisal->summary }}</textarea>
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