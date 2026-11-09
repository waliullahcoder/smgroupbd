@extends('layouts.admin.create_app')

@section('content')
    @php
        $max_sl = \App\Models\HomeSection::max('order');
        $order = $max_sl ? $max_sl + 1 : 1;
    @endphp
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="category_id" class="form-label"><b>Category <span class="text-danger">*</span></b></label>
            <select name="category_id" id="category_id" class="select form-select" required
                data-placeholder="Select Category..">
                <option value="">Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="sub_categories" class="form-label"><b>Sub Category</b></label>
            <select name="sub_categories[]" id="sub_categories" class="form-select" data-placeholder="Select Sub Category.."
                multiple>
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="banner" class="form-label"><b>Banner</b></label>
            <input type="file" class="form-control" id="banner" name="banner" accept="image/*">
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="banner_link" class="form-label"><b>Banner Link</b></label>
            <input type="text" name="banner_link" id="banner_link" class="form-control" placeholder="Banner Link">
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="order" class="form-label"><b>Order</b></label>
            <input type="number" class="form-control" id="order" name="order" value="{{ $order }}"
                placeholder="Section Serial">
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="status" class="form-label"><b>Status</b></label>
            <select name="status" id="status" class="select form-select" data-placeholder="Select Status..">
                <option value="1">Active</option>
                <option value="0">Deactive</option>
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
                let url = "{{ Route('admin.sections.create') }}";
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
