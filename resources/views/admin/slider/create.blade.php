@extends('layouts.admin.app')

@section('content')
    <div class="row g-3">
        <div class="col-12">
            <form action="{{ Route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header pe-2 py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="h6 mb-0 text-uppercase">Add Slider Image</h6>
                            <a href="{{ Route('admin.slider.index') }}" class="btn btn-primary btn-sm">
                                Go Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label"><b>Slider Heading</b></label>
                                <input type="text" placeholder="Heading" class="form-control" id="heading"
                                    name="heading" value="{{ old('heading') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="title" class="form-label"><b>Slider Title</b></label>
                                <input type="text" placeholder="Title" class="form-control" id="title"
                                    name="title" value="{{ old('title') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="show_btn" class="form-label"><b>Show Buttons</b></label>
                                <select name="show_btn" id="show_btn" class="form-select select">
                                    <option value="1" {{ old('title') && old('title') == 1 ? 'selected' : '' }}>Show
                                    </option>
                                    <option value="0" {{ old('title') && old('title') == 0 ? 'selected' : '' }}>Hide
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="image" class="form-label"><b>Select Image (1900x910) <span
                                            class="text-danger">*</span></b></label>
                                <input type="file" class="form-control" id="image" name="image"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end px-3 py-2">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
