@extends('layouts.admin.app')

@section('content')
<div class="row g-3">
    <div class="col-12">
        <form action="{{ Route('admin.lead-source.update',$data->id) }}" method="POST">
            @csrf
             @method('PUT')
            <div class="card">
                <div class="card-header pe-2 py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="h6 mb-0 text-uppercase">Lead Source Edit Action</h6>
                        <div class="flex-shrink-0">
                            <a href="{{ Route('admin.lead-source.index') }}" class="btn btn-primary btn-sm">Go Back</a>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="code" class="form-label require"><b>Code</b></label>
                            <input type="text" class="form-control" id="code" name="code" required value="{{ $data->code }}" placeholder="Code" autofocus>
                        </div>
                        <div class="col-12">
                            <label for="name" class="form-label require"><b>Name</b></label>
                            <input type="text" class="form-control" id="name" name="name" required value="{{ $data->name  }}" placeholder="Name" autofocus>
                        </div>
                        <div class="col-12">
                            <label for="route" class="form-label require"><b>Description</b></label>
                            <textarea type="text" class="form-control" id="description" name="description" required value="{{ $data->description }}" placeholder="Description">{{ $data->description }}</textarea>
                        </div>
                        <div class="col-12">
                            <label for="Status" class="form-label"><b>Status</b></label>
                            <div class="custom-select">
                               <select class="form-control select2 custom-select__element" name="status" id="status">
                                <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            </div>
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
