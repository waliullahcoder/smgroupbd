@extends('layouts.admin.app')

@section('content')
    <div class="row g-3">
        <div class="col-12">
            <form action="{{ Route('admin.role.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header pe-2 py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="h6 mb-0 text-uppercase">Role Information</h6>
                            <div class="d-flex gap-2">
                                <a href="{{ Route('admin.role.index') }}" class="btn btn-primary btn-sm">Go
                                    Back</a>
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="name" class="form-label require"><b>Name <span
                                            class="text-danger">*</span></b></label>
                                <input type="text" placeholder="Name" class="form-control" id="name"
                                    name="name" required value="{{ old('name') }}" minlength="3">
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
