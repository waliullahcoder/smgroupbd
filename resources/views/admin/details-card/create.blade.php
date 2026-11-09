
@extends('layouts.admin.app')

@section('content')
<div class="row g-3">
    <div class="col-12">
        <form action="{{ Route('admin.details-card.store') }}" method="POST" enctype="multipart/form-data" id="details-card-form">
            @csrf
            <div class="card">
                <div class="card-header pe-2 py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="h6 mb-0 text-uppercase">Add Details Card</h6>
                        <a href="{{ Route('admin.details-card.index') }}" class="btn btn-primary btn-sm">
                            Go Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="title" class="form-label require"><b>Details Card Title</b></label>
                            <input type="text" placeholder="Title" class="form-control" id="title"
                                name="title">
                        </div>
                        <div class="col-12">
                            <label for="serial" class="form-label require"><b>Special Food Item serial</b></label>
                            <input type="number" value="1" class="form-control input-number" id="serial" name="serial">
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label"><b>Details Card Description</b></label>
                            <textarea name="description" id="description" required class="short_description" cols="30"
                                rows="10" placeholder="Write here your Descriptions"></textarea>
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
