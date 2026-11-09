@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-4 col-sm-6">
            <label for="prefix" class="form-label"><b>Prefix <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="prefix" name="prefix" required
                value="{{ old('prefix') }}" placeholder="Prefix">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="name" class="form-label"><b>Branch Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="name" name="name" required
                value="{{ old('name') }}" placeholder="Branch Name">
        </div>
        @if (Auth::user()->hasRole('Software Admin'))
            <div class="col-lg-4 col-sm-6">
                <label for="company_id" class="form-label"><b>Company Name <span class="text-danger">*</span></b></label>
                <select name="company_id" id="company_id" class="select form-select" data-placeholder="Select Company"
                    required>
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
            <label for="contact_person" class="form-label"><b>Contact Person <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="contact_person" name="contact_person" required
                value="{{ old('contact_person') }}" placeholder="Contact Person">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="email" class="form-label"><b>Email <span class="text-danger">*</span></b></label>
            <input type="email" class="form-control" id="email" name="email" required
                value="{{ old('email') }}" placeholder="Email">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="phone" class="form-label"><b>Phone No. <span class="text-danger">*</span></b></label>
            <input type="number" class="form-control" id="phone" name="phone" required
                value="{{ old('phone') }}" placeholder="Phone">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="fax" class="form-label"><b>Fax No.</b></label>
            <input type="number" class="form-control" id="fax" name="fax"
                value="{{ old('fax') }}" placeholder="Fax No.">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="website" class="form-label"><b>Website</b></label>
            <input type="text" class="form-control" id="website" name="website"
                value="{{ old('website') }}" placeholder="Website">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="trade_license" class="form-label"><b>Trade License <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="trade_license" name="trade_license" required
                value="{{ old('trade_license') }}" placeholder="Trade License">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="vat" class="form-label"><b>VAT</b></label>
            <input type="text" class="form-control" id="vat" name="vat"
                value="{{ old('vat') }}" placeholder="VAT">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="tin" class="form-label"><b>TIN</b></label>
            <input type="text" class="form-control" id="tin" name="tin"
                value="{{ old('tin') }}" placeholder="TIN">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="address" class="form-label"><b>Address</b></label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Address"
                value="{{ old('address') }}">
        </div>
    </div>
@endsection
