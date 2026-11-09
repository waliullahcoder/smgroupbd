@extends('layouts.admin.app')

@section('content')
<div class="row g-3">
    <div class="col-12">
        <form action="{{ Route('admin.lead-source.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header pe-2 py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="h6 mb-0 text-uppercase">Lead Source Action</h6>
                        @can('admin.lead-source.create')
                        <div class="flex-shrink-0">
                            <a href="{{ Route('admin.lead-source.index') }}" class="btn btn-primary btn-sm">Go Back</a>
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="code" class="form-label require"><b>Code</b></label>
                            <input type="text" class="form-control" id="code" name="code" required value="{{ old('code') }}" placeholder="Code" autofocus>
                        </div>
                        <div class="col-12">
                            <label for="name" class="form-label require"><b>Name</b></label>
                            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}" placeholder="Name" autofocus>
                        </div>
                        <div class="col-12">
                            <label for="route" class="form-label require"><b>Description</b></label>
                            <textarea type="text" class="form-control" id="description" name="description" required value="{{ old('description') }}" placeholder="Description"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="Status" class="form-label"><b>Status</b></label>
                            <div class="custom-select">
                                <select class="form-control select2 custom-select__element" name="status" id="status">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
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
