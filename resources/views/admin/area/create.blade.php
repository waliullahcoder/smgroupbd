@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-4 col-sm-6">
            <label for="region_id" class="form-label"><b>Region Name <span class="text-danger">*</span></b></label>
            <select name="region_id" id="region_id" class="select form-select" data-placeholder="Select Region" required>
                <option value=""></option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}"
                        {{ old('region_id') && old('region_id') == $region->id ? 'selected' : '' }}>{{ $region->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="code" class="form-label"><b>Prefix <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="code" name="code" required value="{{ old('code') }}"
                placeholder="Prefix">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="name" class="form-label"><b>Area Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}"
                placeholder="Area Name">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="incharge_name" class="form-label"><b>Incharge Name</b></label>
            <input type="text" class="form-control" id="incharge_name" name="incharge_name"
                value="{{ old('incharge_name') }}" placeholder="Incharge Name">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="email" class="form-label"><b>Email</b></label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                placeholder="Email">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="phone" class="form-label"><b>Phone No.</b></label>
            <input type="number" class="form-control" id="phone" name="phone" value="{{ old('phone') }}"
                placeholder="Phone">
        </div>
        <div class="col-sm-6">
            <label for="shipping_charge" class="form-label"><b>Shipping Charge</b></label>
            <input type="number" class="form-control" id="shipping_charge" name="shipping_charge"
                value="{{ old('shipping_charge') }}" placeholder="Shipping Charge">
        </div>
        <div class="col-sm-6">
            <label for="address" class="form-label"><b>Address</b></label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Address"
                value="{{ old('address') }}">
        </div>
    </div>
@endsection
