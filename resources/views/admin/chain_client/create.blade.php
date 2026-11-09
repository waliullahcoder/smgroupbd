@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        @if (Auth::user()->hasRole('Software Admin'))
            <div class="col-lg-4 col-sm-6">
                <label for="company_id" class="form-label"><b>Company Name <span class="text-danger">*</span></b></label>
                <select name="company_id" id="company_id" class="select form-select" data-placeholder="Select Company" required>
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
            <label for="name" class="form-label"><b>Client Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="name" name="name" required
                value="{{ old('name') }}" placeholder="Client Name">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="contact_person" class="form-label"><b>Contact Person</b></label>
            <input type="text" class="form-control" id="contact_person" name="contact_person"
                value="{{ old('contact_person') }}" placeholder="Contact Person">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="email" class="form-label"><b>Contact Email</b></label>
            <input type="email" class="form-control" id="email" name="email"
                value="{{ old('email') }}" placeholder="Contact Email">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="phone" class="form-label"><b>Contact Number</b></label>
            <input type="number" class="form-control" id="phone" name="phone"
                value="{{ old('phone') }}" placeholder="Contact Number">
        </div>
        <div class="{{ Auth::user()->hasRole('Software Admin') ? 'col-lg-4' : 'col-lg-8' }} col-sm-6">
            <label for="address" class="form-label"><b>Contact Address</b></label>
            <input type="text" class="form-control" id="address" name="address"
                value="{{ old('address') }}" placeholder="Contact Address">
        </div>
    </div>
@endsection
