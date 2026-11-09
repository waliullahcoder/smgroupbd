@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-4 col-sm-6">
            <label for="name" class="form-label"><b>Investor Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ $data->name }}"
                placeholder="Investor Name">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="email" class="form-label"><b>Email</b></label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}"
                placeholder="Email">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="phone" class="form-label"><b>Phone No. <span class="text-danger">*</span></b></label>
            <input type="number" class="form-control" id="phone" name="phone" required value="{{ $data->phone }}"
                placeholder="Phone">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="nid" class="form-label"><b>NID No.</b></label>
            <input type="number" class="form-control" id="nid" name="nid" value="{{ $data->nid }}"
                placeholder="NID No.">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="address" class="form-label"><b>Address</b></label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Address"
                value="{{ $data->address }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="document" class="form-label"><b>Document</b>
                @if (file_exists($data->document))
                    <a class="ms-2 d-inline-block text-danger" href="{{ asset($data->document) }}"
                        target="_blank"><b>Download
                            Document</b></a>
                @endif
            </label>
            <input type="file" name="document" id="document" class="form-control">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="bkash" class="form-label"><b>Bkash Account</b></label>
            <input type="number" name="bkash" id="bkash" class="form-control" placeholder="Bkash Account"
                value="{{ $data->bkash }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="rocket" class="form-label"><b>Rocket Account</b></label>
            <input type="number" name="rocket" id="rocket" class="form-control" placeholder="Rocket Account"
                value="{{ $data->rocket }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="nagad" class="form-label"><b>Nagad Account</b></label>
            <input type="number" name="nagad" id="nagad" class="form-control" placeholder="Nagad Account"
                value="{{ $data->nagad }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="bank" class="form-label"><b>Bank Name</b></label>
            <input type="text" name="bank" id="bank" class="form-control" placeholder="Bank Name"
                value="{{ $data->bank }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="branch" class="form-label"><b>Branch Name</b></label>
            <input type="text" name="branch" id="branch" class="form-control" placeholder="Branch Name"
                value="{{ $data->branch }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="account_name" class="form-label"><b>Account Name</b></label>
            <input type="text" name="account_name" id="account_name" class="form-control" placeholder="Account Name"
                value="{{ $data->account_name }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="account_no" class="form-label"><b>Account Number</b></label>
            <input type="number" name="account_no" id="account_no" class="form-control" placeholder="Account Number"
                value="{{ $data->account_no }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="image" class="form-label"><b>Image</b></label>
            <input type="file" class="form-control" name="image" id="image" accept="image/*">
            @if (file_exists($data->image))
                <img src="{{ asset($data->image) }}" alt="Image" height="50" class="mt-2">
            @endif
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="coa_setup_id" class="form-label"><b>Cash Account <span class="text-danger">*</span></b></label>
            <select name="coa_setup_id" id="coa_setup_id" class="select form-select"
                data-placeholder="Select Cash Account" required>
                <option value=""></option>
                @foreach ($additionalData['coas'] as $coa)
                    <option value="{{ $coa->id }}" {{ $data->coa_setup_id == $coa->id ? 'selected' : '' }}>
                        {{ $coa->head_name . ' - ' . $coa->head_code }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endsection
