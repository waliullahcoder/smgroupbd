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
            <label for="type" class="form-label"><b>Type <span class="text-danger">*</span></b></label>
            <div class="custom-select">
                <select class="form-control custom-select__element" name="type" id="type" required>
                    <option value="Frozen Pickup" {{ $data->type == 'Frozen Pickup' ? 'selected' : '' }}>
                        Frozen Pickup</option>
                    <option value="Non Frozen Pickup" {{ $data->type == 'Non Frozen Pickup' ? 'selected' : '' }}>Non Frozen
                        Pickup</option>
                    <option value="Cavard Van" {{ $data->type == 'Cavard Van' ? 'selected' : '' }}>Cavard Van
                    </option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <label for="registration_no" class="form-label"><b>Registration No. <span
                        class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="registration_no" name="registration_no" required
                value="{{ $data->registration_no }}" placeholder="Registration No.">
        </div>
    </div>
@endsection
