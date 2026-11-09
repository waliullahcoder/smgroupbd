@extends('layouts.admin.app')

@section('content')
    <div class="row g-3">
        <div class="col-12">
            <form action="{{ Route('admin.product.attributes.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header pe-2 py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="h6 mb-0 py-5px text-uppercase">{{ __('Update Attributes') }}</h6>
                            <div class="d-flex gap-2">
                                <a href="{{ Route('admin.product.index') }}" class="btn btn-primary btn-sm">Go
                                    Back</a>
                                <button type="submit" class="btn btn-primary btn-sm submit_btn">Update</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <table class="table table-striped table-bordered text-center mb-0">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Status</th>
                                    <th>Trending</th>
                                    <th>Featured</th>
                                    <th>Top Rated</th>
                                    <th>Best Selling</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check form-switch w-fit mx-auto">
                                            <input class="form-check-input c-pointer" type="checkbox"
                                                name="status" {{ $product->status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch w-fit mx-auto">
                                            <input class="form-check-input c-pointer" type="checkbox"
                                                name="trending" {{ $product->trending == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch w-fit mx-auto">
                                            <input class="form-check-input c-pointer" type="checkbox"
                                                name="featured" {{ $product->featured == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch w-fit mx-auto">
                                            <input class="form-check-input c-pointer" type="checkbox"
                                                name="top_rated" {{ $product->top_rated == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch w-fit mx-auto">
                                            <input class="form-check-input c-pointer" type="checkbox"
                                                name="best_selling" {{ $product->best_selling == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {});
    </script>
@endpush
