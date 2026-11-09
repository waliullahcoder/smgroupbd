@extends('layouts.admin.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/css/jquery.minicolors.css') }}">
@endpush

@section('content')
    <form action="{{ Route('admin.site-item.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pe-2 py-2">
                        <h6 class="h6 mb-0 py-5px">{{ $data ? 'Update Site Items' : 'Create Site Items' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4 col-6">
                                <label for="title" class="form-label"><b>Banner Title</b></label>
                                <input type="text" required placeholder="Banner Title" class="form-control"
                                    id="title" name="title" value="{{ $data ? $data->title : '' }}" minlength="6"
                                    maxlength="254" />
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="short_description" class="form-label">
                                    <b>Banner Short Description</b>
                                </label>
                                <input type="text" required placeholder="Banner Short Description"
                                    class="form-control" id="short_description" name="short_description"
                                    value="{{ $data ? $data->short_description : '' }}" minlength="6" maxlength="254" />
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="shop_button_link" class="form-label"><b>Shop Button Link</b></label>
                                <input type="text" required placeholder="Shop Button Link"
                                    class="form-control" id="shop_button_link" name="shop_button_link"
                                    value="{{ $data ? $data->shop_button_link : '' }}" minlength="6" maxlength="254"
                                    placeholder="http://www." />
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="contact_button_link" class="form-label"><b>Contact Button
                                        Link</b></label>
                                <input type="text" required placeholder="Contact Button Link"
                                    class="form-control" id="contact_button_link" name="contact_button_link"
                                    value="{{ $data ? $data->contact_button_link : '' }}" minlength="6" maxlength="254"
                                    placeholder="http://www." />
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="banner_title" class="form-label"><b>Banner Title</b></label>
                                <input type="text" required placeholder="Banner Title" class="form-control"
                                    id="banner_title" name="banner_title" value="{{ $data ? $data->banner_title : '' }}"
                                    minlength="6" maxlength="254" />
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="testimonial_title" class="form-label"><b>Testimonial Title</b></label>
                                <input type="text" required placeholder="Testimonial Title"
                                    class="form-control" id="testimonial_title" name="testimonial_title"
                                    value="{{ $data ? $data->testimonial_title : '' }}" minlength="6" maxlength="254" />
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="products_title" class="form-label"><b>Product's Title</b></label>
                                <input type="text" required placeholder="Product's Title"
                                    class="form-control" id="products_title" name="products_title"
                                    value="{{ $data ? $data->products_title : '' }}" minlength="6" maxlength="254" />
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="details_video_url" class="form-label">
                                    <b>Details Video Youtube Embed Url</b>
                                </label>
                                <input type="text" placeholder="http://www." class="form-control"
                                    id="details_video_url" name="details_video_url"
                                    value="{{ $data ? $data->details_video_url : '' }}" minlength="6" maxlength="254" />
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="header_bg_image" class="form-label"><b>Header Background Image</b></label>
                                <input type="file" id="header_bg_image" name="header_bg_image" class="form-control"
                                    accept="image/*" {{ $data && file_exists($data->header_bg_image) ? '' : 'required' }}>
                                @if ($data && file_exists($data->header_bg_image))
                                    <div class="pt-2">
                                        <img src="{{ asset($data->header_bg_image) }}" height="50" alt="Logo" />
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="banner_image" class="form-label"><b>Banner Image</b></label>
                                <input type="file" id="banner_image" name="banner_image" class="form-control"
                                    accept="image/*" {{ $data && file_exists($data->banner_image) ? '' : 'required' }} />
                                @if ($data && file_exists($data->banner_image))
                                    <div class="pt-2">
                                        <img src="{{ asset($data->banner_image) }}" height="50" alt="Logo" />
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="welcome_image" class="form-label"><b>Welcome Image</b></label>
                                <input type="file" id="welcome_image" name="welcome_image" class="form-control"
                                    accept="image/*" {{ $data && file_exists($data->welcome_image) ? '' : 'required' }} />
                                @if ($data && file_exists($data->welcome_image))
                                    <div class="pt-2">
                                        <img src="{{ asset($data->welcome_image) }}" height="50" alt="Logo" />
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="x_separator_image" class="form-label"><b>Horizontal Separator
                                        Image</b></label>
                                <input type="file" id="x_separator_image" name="x_separator_image"
                                    class="form-control" accept="image/*"
                                    {{ $data && file_exists($data->x_separator_image) ? '' : 'required' }} />
                                @if ($data && file_exists($data->x_separator_image))
                                    <div class="pt-2">
                                        <img src="{{ asset($data->x_separator_image) }}" height="50"
                                            style="max-width: 200px;" alt="Logo" />
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="y_separator_image" class="form-label"><b>Vertical Separator Image</b></label>
                                <input type="file" id="y_separator_image" name="y_separator_image"
                                    class="form-control" accept="image/*"
                                    {{ $data && file_exists($data->y_separator_image) ? '' : 'required' }} />
                                @if ($data && file_exists($data->y_separator_image))
                                    <div class="pt-2">
                                        <img src="{{ asset($data->y_separator_image) }}" height="50"
                                            alt="Logo" />
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="testimonial_image" class="form-label"><b>Testimonial Image</b></label>
                                <input type="file" id="testimonial_image" name="testimonial_image"
                                    class="form-control" accept="image/*"
                                    {{ $data && file_exists($data->testimonial_image) ? '' : 'required' }} />
                                @if ($data && file_exists($data->testimonial_image))
                                    <div class="pt-2">
                                        <img src="{{ asset($data->testimonial_image) }}" height="50"
                                            alt="Logo" />
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2 text-end">
                        <div class="py-1">
                            <button type="submit"
                                class="btn btn-sm btn-primary">{{ $data ? 'Update Now' : 'Create Now' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('backend/js/jquery.minicolors.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            if ($('.color').length) {
                $(".color").each(function() {
                    $(this).minicolors();
                });
            }
        });
    </script>
@endpush
