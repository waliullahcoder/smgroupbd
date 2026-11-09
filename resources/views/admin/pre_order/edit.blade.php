@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <div class="col-sm-6">
            <label for="product_id" class="form-label"><b>Product <span class="text-danger">*</span></b></label>
            <select name="product_id" id="product_id" class="select form-select" data-placeholder="Select Product" required>
                <option value=""></option>
                @foreach ($products as $item)
                    <option value="{{ $item->id }}" {{ $data->product_id == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="image" class="form-label"><b>Banner
                    @if (!file_exists($data->image))
                        <span class="text-danger">*</span>
                    @endif
                </b>
            </label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*"
                {{ !file_exists($data->image) ? 'required' : '' }}>
            @if (file_exists($data->image))
                <img src="{{ asset($data->image) }}" alt="Banner" class="mt-2" height="50">
            @endif
        </div>
    </div>
@endsection
