@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-sm-6">
            <label for="product_id" class="form-label"><b>Product <span class="text-danger">*</span></b></label>
            <select name="product_id" id="product_id" class="select form-select" data-placeholder="Select Product" required>
                <option value=""></option>
                @foreach ($products as $item)
                    <option value="{{ $item->id }}" {{ old('product_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="image" class="form-label"><b>Banner <span class="text-danger">*</span></b></label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
    </div>
@endsection
