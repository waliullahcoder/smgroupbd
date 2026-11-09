@extends('layouts.admin.app')

@section('content')
<div class="row g-3">
    <div class="col-12">

        <form action="{{ Route('admin.lead-status.store') }}" method="POST">
            @csrf

            <div class="card">

                <div class="card-header pe-2 py-2">
                    <div class="d-flex justify-content-between align-items-center">

                        <h6 class="h6 mb-0 text-uppercase">
                            Lead Status Action
                        </h6>

                        @can('admin.lead-status.create')
                        <div class="flex-shrink-0">
                            <a href="{{ Route('admin.lead-status.index') }}" class="btn btn-primary btn-sm">
                                Go Back
                            </a>

                            <button type="submit" class="btn btn-primary btn-sm">
                                Save
                            </button>
                        </div>
                        @endcan

                    </div>
                </div>

                <div class="card-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="code" class="form-label require">
                                <b>Status Code</b>
                            </label>

                            <input type="text"
                                class="form-control"
                                id="code"
                                name="code"
                                value="{{ old('code') }}"
                                placeholder="Status Code"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label require">
                                <b>Status Name</b>
                            </label>

                            <input type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Status Name"
                                required>
                        </div>

                       

                        <div class="col-md-6">
                            <label for="sort_order" class="form-label">
                                <b>Sort Order</b>
                            </label>

                            <input type="number"
                                class="form-control"
                                id="sort_order"
                                name="sort_order"
                                value="{{ old('sort_order',1) }}"
                                placeholder="Sort Order">
                        </div>
                        <div class="col-6">
                            <label for="status" class="form-label">
                                <b>Status</b>
                            </label>
                            <div class="custom-select">
                                <select class="form-control select2 custom-select__element"
                                    name="status"
                                    id="status">

                                    <option value="1" selected>
                                        Active
                                    </option>

                                    <option value="0">
                                        Inactive
                                    </option>

                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">
                                <b>Description</b>
                            </label>
                            <textarea
                                class="form-control"
                                id="description"
                                name="description"
                                rows="4"
                                placeholder="Description">{{ old('description') }}</textarea>
                        </div>
                         <div class="col-md-6">
                            <label for="color" class="form-label">
                                <b>Color</b>
                            </label>

                            <input type="color"
                                class="form-control form-control-color"
                                id="color"
                                name="color"
                                value="{{ old('color','#0d6efd') }}">
                        </div>

                        

                    </div>

                </div>

                <div class="card-footer text-end px-3 py-2">

                    <button type="submit" class="btn btn-primary btn-sm">
                        Save
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>
@endsection