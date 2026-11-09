@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        @if (Auth::user()->hasRole('Software Admin'))
            <div class="col-sm-6">
                <label for="company_id" class="form-label"><b>Company Name <span class="text-danger">*</span></b></label>
                <select name="company_id" id="company_id" class="select form-select" data-placeholder="Select Company" required>
                    <option value=""></option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $data->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-sm-6">
            <label for="name" class="form-label"><b>Category Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="name" name="name" required
                value="{{ $data->name }}" placeholder="Category Name">
        </div>
        <div class="col-sm-6">
            <label for="status" class="form-label"><b>Status <span class="text-danger">*</span></b></label>
            <select name="status" id="status" class="form-select" required>
                <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Deactive</option>
            </select>
        </div>
    </div>
@endsection
