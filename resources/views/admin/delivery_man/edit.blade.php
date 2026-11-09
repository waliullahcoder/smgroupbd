@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Store <span class="text-danger">*</span></b></label>
            <select name="store_id" id="store_id" class="select form-select" data-placeholder="Select Store" required>
                <option value=""></option>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}" {{ $data->store_id == $store->id ? 'selected' : '' }}>
                        {{ $store->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="code" class="form-label"><b>Code <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="code" name="code" readonly required
                value="{{ $data->code }}" placeholder="code">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="name" class="form-label"><b>Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ $data->name }}"
                placeholder="Delivery Man Name">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="email" class="form-label"><b>Email</b></label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}"
                placeholder="Email">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="phone" class="form-label"><b>Phone No.</b></label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone }}"
                placeholder="Phone">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="national_id" class="form-label"><b>National ID</b></label>
            <input type="number" class="form-control" id="national_id" name="national_id" value="{{ $data->national_id }}"
                placeholder="National ID">
        </div>
        <div class="col-12">
            <label for="address" class="form-label"><b>Address</b></label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Address"
                value="{{ $data->address }}">
        </div>
    </div>
@endsection
