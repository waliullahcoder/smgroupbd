@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-4 col-sm-6">
            <label for="code" class="form-label"><b>Prefix <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="code" name="code" required
                value="{{ old('code') }}" placeholder="Prefix">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="name" class="form-label"><b>Store Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="name" name="name" required
                value="{{ old('name') }}" placeholder="Store Name">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="area_id" class="form-label"><b>Area <span class="text-danger">*</span></b></label>
            <select name="area_id[]" id="area_id" class="select form-select" data-placeholder="Select Area" multiple
                required>
                <option value=""></option>
                @foreach ($areas as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="address" class="form-label"><b>Address <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="address" name="address" required
                value="{{ old('address') }}" placeholder="Address">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="remarks" class="form-label"><b>Remarks <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="remarks" name="remarks" required
                value="{{ old('remarks') }}" placeholder="Remarks">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="type" class="form-label"><b>Store Types</b></label>
            <div class="d-flex flex-wrap gap-2">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="type1" name="type[]" value="Product Stock">
                    <label class="form-check-label" for="type1">Product Stock</label>
                </div>
                {{-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="type2" name="type[]"
                        value="Production Floor (Raw/Finish)">
                    <label class="form-check-label" for="type2">Production Floor (Raw/Finish)</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="type3" name="type[]"
                        value="Finish Stock">
                    <label class="form-check-label" for="type3">Finish Stock</label>
                </div> --}}
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="type4" name="type[]" value="Damage Stock">
                    <label class="form-check-label" for="type4">Damage Stock</label>
                </div>
            </div>
        </div>
    </div>
@endsection
