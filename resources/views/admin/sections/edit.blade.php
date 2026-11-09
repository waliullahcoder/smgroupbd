@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="category_id" class="form-label"><b>Category <span class="text-danger">*</span></b></label>
            <select name="category_id" id="category_id" class="select form-select" required
                data-placeholder="Select Category..">
                <option value="">Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $data->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="sub_categories" class="form-label"><b>Sub Category</b></label>
            <select name="sub_categories[]" id="sub_categories" class="form-select" data-placeholder="Select Sub Category.."
                multiple>
                @php
                    $selected_ids = $data->sub_categories->pluck('category_id')->toArray();
                @endphp
                @foreach ($data->category->children as $item)
                    <option value="{{ $item->id }}" {{ in_array($item->id, $selected_ids) ? 'selected' : '' }}>
                        {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="banner" class="form-label"><b>Banner</b></label>
            <input type="file" class="form-control" id="banner" name="banner" accept="image/*">
            @if (file_exists($data->banner))
                <img class="mt-2" src="{{ asset($data->banner) }}" height="40" alt="">
            @endif
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="banner_link" class="form-label"><b>Banner Link</b></label>
            <input type="text" name="banner_link" id="banner_link" class="form-control" placeholder="Banner Link"
                value="{{ $data->banner_link }}">
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="order" class="form-label"><b>Order</b></label>
            <input type="number" class="form-control" id="order" name="order" value="{{ $data->order }}"
                placeholder="Section Serial">
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="status" class="form-label"><b>Status</b></label>
            <select name="status" id="status" class="select form-select" data-placeholder="Select Status..">
                <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Deactive</option>
            </select>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sub_categories').select2({
                maximumSelectionLength: 3
            });

            $(document).on('change', '#category_id', function(e) {
                var category_id = $(this).val();
                $('#sub_categories').empty();
                let url = "{{ Route('admin.sections.edit', $data->id) }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        category_id: category_id
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#sub_categories').append('<option value=""></option>');
                            $.each(response.categories, function(key, value) {
                                $('#sub_categories').append(
                                    `<option value="${value.id}">${value.name}</option>`
                                );
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
