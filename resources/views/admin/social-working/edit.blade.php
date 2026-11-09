@extends('layouts.admin.app')

@section('content')
<div class="row g-3">
    <div class="col-12">
        <form action="{{ Route('admin.social-working.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header pe-2 py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="h6 mb-0 text-uppercase">Social Working Edit</h6>
                        <a href="{{ Route('admin.social-working.index') }}" class="btn btn-primary btn-sm">
                            Go Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-8 col-sm-6">
                            <label for="title" class="form-label require"><b>Social Working Title</b></label>
                            <input type="text" placeholder="Title" class="form-control" id="title"
                                name="title" value="{{ $data->title }}">
                        </div>
                        <div class="row g-3">
                            <label for="serial" class="form-label require"><b>Priority Serial</b></label>
                            <input type="number" value="{{ $data->serial }}" class="form-control input-number" id="serial" name="serial">
                        </div>
                        <div class="col-12">
                            <label for="name" class="form-label require"><b>Social Working Image</b></label>
                            <input type="file" class="form-control" id="image" name="image">
                            <img src="{{ asset($data->image) }}" height="100" alt="{{ $data->title }}">
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
