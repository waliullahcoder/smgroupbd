@extends('layouts.admin.app')

@section('content')
    <div class="row g-3">
        <div class="col-12">
            <form action="{{ Route('admin.slider.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header pe-2 py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="h6 mb-0 text-uppercase">Slider Edit</h6>
                            <a href="{{ Route('admin.slider.index') }}" class="btn btn-primary btn-sm">
                                Go Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="heading" class="form-label"><b>Slider Heading</b></label>
                                <input type="text" placeholder="Heading" class="form-control" id="heading"
                                    name="heading" value="{{ $data->heading }}" />
                            </div>
                            <div class="col-md-6">
                                <label for="title" class="form-label"><b>Slider Title</b></label>
                                <input type="text" placeholder="Title" class="form-control" id="title"
                                    name="title" value="{{ $data->title }}" />
                            </div>
                            <div class="col-md-6">
                                <label for="show_btn" class="form-label"><b>Show Buttons</b></label>
                                <select name="show_btn" id="show_btn" class="form-select select">
                                    <option value="1" {{ $data->show_btn == 1 ? 'selected' : '' }}>Show</option>
                                    <option value="0" {{ $data->show_btn == 0 ? 'selected' : '' }}>Hide</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="image" class="form-label"><b>Select Image (1900x910)</b></label>
                                <input type="file" class="form-control" id="image" name="image" />
                                @if (file_exists($data->image))
                                    <div class="pt-2">
                                        <img src="{{ asset($data->image) }}" height="100" alt="{{ $data->title }}">
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-end px-3 py-2">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
