@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <div class="col-6">
            <label for="inside_charge" class="form-label"><b>Inside City Charge <span class="text-danger">*</span></b></label>
            <input type="number" step="1" placeholder="Inside City Charge" class="form-control" id="inside_charge"
                name="inside_charge" value="{{ $data ? $data->inside_charge : '' }}" required>
        </div>
        <div class="col-6">
            <label for="outside_charge" class="form-label"><b>Outside City Charge <span
                        class="text-danger">*</span></b></label>
            <input type="number" step="1" placeholder="Inside City Charge" class="form-control" id="outside_charge"
                name="outside_charge" value="{{ $data ? $data->outside_charge : '' }}" required>
        </div>
    </div>
@endsection
