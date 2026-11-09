@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        @if (Auth::user()->hasRole('Software Admin'))
            <div class="col-lg-4 col-sm-6">
                <label for="company_id" class="form-label"><b>Company Name <span class="text-danger">*</span></b></label>
                <select name="company_id" id="company_id" class="select form-select" data-placeholder="Select Company" required>
                    <option value=""></option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $data->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-lg-4 col-sm-6">
            <label for="parent_id" class="form-label"><b>Parent Category</b></label>
            <select name="parent_id" id="parent_id" class="select form-select" data-placeholder="Select Parent..">
                <option value=""></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $data->parent_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @foreach ($category->children as $child)
                        <option value="{{ $child->id }}" {{ $data->parent_id == $child->id ? 'selected' : '' }}>
                            {{ $child->name }}
                        </option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="name" class="form-label"><b>Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="name" name="name" required placeholder="Category Name"
                value="{{ $data->name }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="image" class="form-label"><b>Image <span class="text-danger">(500x500)</span></b></label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
            @if (file_exists($data->image))
                <div class="pt-2">
                    <img src="{{ asset($data->image) }}" height="40" alt="">
                </div>
            @endif
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="vendor_id" class="form-label"><b>Vendor Names</b></label>
            <select name="vendor_id[]" id="vendor_id" class="select form-select" multiple
                data-placeholder="Select Vendors..">
                @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}" {{ in_array($vendor->id, $selected_vendors) ? 'selected' : '' }}>
                        {{ $vendor->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="meta_title" class="form-label"><b>Meta Title</b></label>
            <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title"
                value="{{ $data->meta_title }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="meta_keyword" class="form-label"><b>Meta Keyword</b></label>
            <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Meta Keyword"
                value="{{ $data->meta_keyword }}">
        </div>
        {{-- <div class="col-lg-4 col-sm-6">
            <label class="form-label text-white"><b></b></label>
            <div class="d-flex gap-3 align-items-center flex-wrap pt-2 mt-1">
                <div class="flex-shrink-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="status" id="status"
                            {{ $data->status == 1 ? 'checked' : '' }}>
                        <label class="custom-control-label" for="status"><span class="ms-1">Show</span></label>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="show_frontend" id="show_frontend"
                            {{ $data->show_frontend == 1 ? 'checked' : '' }}>
                        <label class="custom-control-label" for="show_frontend"><span class="ms-1">Show in
                                Homepage</span></label>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-12">
            <label for="meta_description" class="form-label"><b>Meta Description</b></label>
            <textarea name="meta_description" id="meta_description" cols="30" rows="4" class="form-control"
                placeholder="Meta Description">{{ $data->meta_description }}</textarea>
        </div>
    </div>
@endsection
