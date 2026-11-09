@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="name" class="form-label"><b>Product Name <span class="text-danger">*</span></b></label>
                    <input type="text" id="name" class="form-control" name="name" required
                        placeholder="Product Name." value="{{ old('name') }}">
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="code"><b>Barcode <span class="text-danger">*</span></b></label>
                    <input type="text" name="code" id="code" class="form-control"
                        placeholder="Click to scan barcode" value="{{ old('code') }}" required>
                </div>
                <div class="col-sm-6">
                    <label for="thumbnail" class="form-label"><b>Product thumbnail <span
                                class="text-danger">(600x600)</span></b></label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*">
                    <div id="showThamb-wrapper" style="display: none;">
                        <img class="mt-2" src="" alt="" id="showThamb" height="60">
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="more_images" class="form-label"><b>Other Images <span
                                class="text-danger">(600x600)</span></b></label>
                    <input type="file" name="more_images[]" id="more_images" class="form-control" multiple
                        accept="image/*">
                    <div id="preview_image" class="pt-2" style="display: none;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label class="form-label" for="parent_category"><b>Parent Category <span
                                class="text-danger">*</span></b></label>
                    <select name="category_id" id="parent_category" class="select form-select" required
                        data-placeholder="Select Category..">
                        <option value=""></option>
                        @foreach ($categories as $key => $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') && old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="child_category"><b>Child Category</b></label>
                    <select name="category_id" id="child_category" class="select form-select"
                        data-placeholder="Choose.."></select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="alert_quantity"><b>Reorder Level</b></label>
                    <input type="number" name="alert_quantity" id="alert_quantity" class="form-control"
                        placeholder="Reorder Level" value="{{ old('alert_quantity') }}">
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="attribute_id"><b>UOM <span class="text-danger">*</span></b></label>
                    <select name="attribute_id" id="attribute_id" class="form-control select" data-placeholder="Choose UOM"
                        required>
                        <option value=""></option>
                        @foreach ($attributes as $key => $attribute)
                            <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div id="price_area">
                <table class="table table-bordered align-middle mb-0" id="price_table">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Purchase Price</th>
                            <th>Client Price</th>
                            <th>Retail Price</th>
                            <th>Discount Percentage</th>
                            <th>Discount Amount</th>
                        </tr>
                    </thead>
                    <tbody id="prices">
                        <tr>
                            <td>
                                <input type="number" class="form-control" name="lifting_price" min="0"
                                    value="0" step="any" required>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="sale_price" min="0"
                                    value="0" step="any" required>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="online_price" min="0"
                                    value="0" step="any" required>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="discount" min="0"
                                    value="0" step="any" required>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="discount_tk" min="0"
                                    value="0" step="any" required>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12">
            <label for="short_description" class="form-label"><b>Short Description</b></label>
            <textarea name="short_description" id="short_description" class="short_description" cols="30" rows="10">{!! old('short_description') !!}</textarea>
        </div>
        <div class="col-12">
            <label for="description" class="form-label"><b>Long Description</b></label>
            <textarea name="description" id="description" class="description" cols="30" rows="10">{!! old('description') !!}</textarea>
        </div>
        <div class="col-12">
            <label for="additional_info" class="form-label"><b>Additional Information</b></label>
            <textarea name="additional_info" id="additional_info" class="description" cols="30" rows="10">{!! old('additional_info') !!}</textarea>
        </div>
        <div class="col-12">
            <label for="meta_title" class="form-label"><b>SEO Title</b></label>
            <input type="text" id="meta_title" name="meta_title" class="form-control" placeholder="SEO Title"
                value="{{ old('meta_title') }}">
        </div>
        <div class="col-12">
            <label for="meta_keyword" class="form-label"><b>SEO Keyword</b></label>
            <textarea name="meta_keyword" id="meta_keyword" cols="30" rows="4" class="form-control"
                placeholder="SEO Keyword">{{ old('meta_keyword') }}</textarea>
        </div>
        <div class="col-12">
            <label for="meta_description" class="form-label"><b>SEO Description</b></label>
            <textarea name="meta_description" id="meta_description" cols="30" rows="4" class="form-control"
                placeholder="SEO Description">{{ old('meta_description') }}</textarea>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // Thumbail Image Preview
            function readFile(input) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#showThamb').attr('src', e.target.result);
                    $('#showThamb-wrapper').show();
                }
                reader.readAsDataURL(input.files[0]);
            }
            $(document).on('change', '#thumbnail', function(event) {
                readFile(this);
            });

            // More Images Preview
            $(document).on('change', '#more_images', function() {
                $('#preview_image').html('');
                if (window.File && window.FileReader && window.FileList && window.Blob) {
                    var data = $(this)[0].files;
                    $.each(data, function(index, file) {
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                            var fRead = new FileReader();
                            fRead.onload = (function(file) {
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                        e.target.result).height(50);
                                    $('#preview_image').append(img);
                                };
                            })(file);
                            fRead.readAsDataURL(file);
                        }
                    });
                    $('#preview_image').show();
                } else {
                    alert("Your browser doesn't support File API!");
                }
            });

            // Append Child Categories Ajax
            $(document).on('change', '#parent_category', function(event) {
                let id = $(this).val();
                let url = "{{ Route('admin.product.create') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        id: id
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#subchild_category').empty();
                            $('#child_category').empty();
                            $('#child_category').append(
                                '<option value="" selected disabled> Choose.. </option>'
                            );
                            $.each(response.child_categories, function(key, value) {
                                $('#child_category').append(
                                    `<option value="${value.id}">${value.name}</option>`
                                );
                            });
                        }
                    }
                });
            });

            $(document).on('keyup', '#code', function() {
                var code = $(this).val();
                $.ajax({
                    url: "{{ request()->fullUrl() }}",
                    type: "POST",
                    data: {
                        _method: 'GET',
                        code: code
                    },
                    success: (response) => {
                        if (response.status == 'exist') {
                            $('#code').addClass('is-invalid');
                        } else {
                            $('#code').removeClass('is-invalid');
                        }
                    }
                });
            });

            $(document).on('submit', '#store_form', function(event) {
                if ($(this).find('.is-invalid').length) {
                    event.preventDefault();
                    event.stopPropagation();
                    $(this).find('.is-invalid').focus();
                }
            });

            function calculateFromPercentage() {
                const onlinePrice = parseFloat($('input[name="online_price"]').val()) || 0;
                const discountPercent = parseFloat($('input[name="discount"]').val()) || 0;
                const discountTk = (onlinePrice * discountPercent) / 100;
                $('input[name="discount_tk"]').val(discountTk.toFixed(2));
            }

            function calculateFromAmount() {
                const onlinePrice = parseFloat($('input[name="online_price"]').val()) || 0;
                const discountTk = parseFloat($('input[name="discount_tk"]').val()) || 0;
                const discountPercent = onlinePrice ? (discountTk / onlinePrice) * 100 : 0;
                $('input[name="discount"]').val(discountPercent.toFixed(2));
            }

            $('input[name="discount"]').on('input', calculateFromPercentage);
            $('input[name="discount_tk"]').on('input', calculateFromAmount);
            $('input[name="online_price"]').on('input', function() {
                calculateFromPercentage();
                calculateFromAmount();
            });
        });
    </script>
@endpush
