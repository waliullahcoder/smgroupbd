@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        @if (Auth::user()->hasRole('Software Admin'))
            <div class="col-lg-4 col-sm-6">
                <label for="company_id" class="form-label"><b>Company Name <span class="text-danger">*</span></b></label>
                <select name="company_id" id="company_id" class="select form-select" data-placeholder="Select Company" required>
                    <option value=""></option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}"
                            {{ old('company_id') && old('company_id') == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-lg-4 col-sm-6">
            <label for="code" class="form-label"><b>Prefix <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="code" name="code" required
                value="{{ old('code') }}" placeholder="Prefix">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="name" class="form-label"><b>Region Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="name" name="name" required
                value="{{ old('name') }}" placeholder="Region Name">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="incharge_name" class="form-label"><b>Incharge Name</b></label>
            <input type="text" class="form-control" id="incharge_name" name="incharge_name"
                value="{{ old('incharge_name') }}" placeholder="Incharge Name">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="email" class="form-label"><b>Email</b></label>
            <input type="email" class="form-control" id="email" name="email"
                value="{{ old('email') }}" placeholder="Email">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="phone" class="form-label"><b>Phone No.</b></label>
            <input type="number" class="form-control" id="phone" name="phone"
                value="{{ old('phone') }}" placeholder="Phone">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="address" class="form-label"><b>Address</b></label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Address"
                value="{{ old('address') }}">
        </div>
    </div>
@endsection
