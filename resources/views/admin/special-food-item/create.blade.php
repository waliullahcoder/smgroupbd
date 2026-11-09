@extends('layouts.admin.app')

@section('content')
<div class="row g-3">
    <div class="col-12">
        <form action="{{ Route('admin.special-food-item.store') }}" method="POST" enctype="multipart/form-data" id="special-food-item-form">
            @csrf
            <div class="card">
                <div class="card-header pe-2 py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="h6 mb-0 text-uppercase">Add Special Food Item</h6>
                        <a href="{{ Route('admin.special-food-item.index') }}" class="btn btn-primary btn-sm">
                            Go Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6 col-12">
                            <label for="name" class="form-label require"><b>Work Name</b></label>
                            <input type="text" placeholder="name" class="form-control" id="name" name="name">
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="serial" class="form-label require"><b>Special Food Item serial</b></label>
                            <input type="number" value="1" class="form-control input-number" id="serial" name="serial">
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="link" class="form-label"><b>Link</b></label>
                            <input type="text" class="form-control" id="link" name="link" placeholder="Link" value="{{ old('link') }}">
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="image" class="form-label require"><b>Special Food Item Image</b></label>
                            <input type="file" class="form-control" id="image" name="image" required>
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
