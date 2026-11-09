@extends('layouts.admin.app')

@section('content')
    <div class="row g-3">
        <div class="col-12">
            <form action="{{ Route('admin.deal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header py-2 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="h6 mb-0 text-uppercase">Add New Flash Deal</h6>
                            <a href="{{ Route('admin.deal.index') }}" class="btn btn-primary btn-sm">Go
                                Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4 col-sm-6">
                                <label for="title" class="form-label"><b>Title</b></label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Title"
                                    required>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="banner" class="form-label"><b>Banner</b></label>
                                <input type="file" name="banner" id="banner" class="form-control" accept="image/*"
                                    required>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="date_range" class="form-label"><b>Date</b></label>
                                <input type="text" class="form-control date-range" name="date_range"
                                    placeholder="Select Date" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss"
                                    data-separator=" to " autocomplete="off" required="">
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="featured" class="form-label"><b>Featured</b></label>
                                <select name="featured" id="featured" class="form-select"
                                    data-placeholder="Select Featured..">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="status" class="form-label"><b>Status</b></label>
                                <select name="status" id="status" class="form-select"
                                    data-placeholder="Select Status..">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="category_ids" class="form-label"><b>Category</b></label>
                                <select name="category_ids" id="category_ids" class="form-select select" multiple
                                    data-placeholder="Select Cateogry..">
                                    <option value=""></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="product_id" class="form-label"><b>Products</b></label>
                                <select name="product_id" id="product_id" class="form-select select"
                                    data-placeholder="Select Product..">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div id="product_wrapper" style="display: none;">
                            <table class="table table-bordered table align-middle mt-4" id="product_table">
                                <thead>
                                    <tr class="footable-header">
                                        <th width="100">Thumbnail</th>
                                        <th>Product Name</th>
                                        <th>Base Price</th>
                                        <th>Discount</th>
                                        <th>Discount Type</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-end p-3">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".date-range").each(function() {
                var $this = $(this);
                var today = moment().startOf("day");
                var value = $this.val();
                var startDate = false;
                var minDate = false;
                var maxDate = false;
                var advncdRange = false;
                var ranges = {
                    Today: [moment(), moment()],
                    Yesterday: [
                        moment().subtract(1, "days"),
                        moment().subtract(1, "days"),
                    ],
                    "Last 7 Days": [moment().subtract(6, "days"), moment()],
                    "Last 30 Days": [moment().subtract(29, "days"), moment()],
                    "This Month": [
                        moment().startOf("month"),
                        moment().endOf("month"),
                    ],
                    "Last Month": [
                        moment().subtract(1, "month").startOf("month"),
                        moment().subtract(1, "month").endOf("month"),
                    ],
                };

                var single = $this.data("single");
                var monthYearDrop = $this.data("show-dropdown");
                var format = $this.data("format");
                var separator = $this.data("separator");
                var pastDisable = $this.data("past-disable");
                var futureDisable = $this.data("future-disable");
                var timePicker = $this.data("time-picker");
                var timePickerIncrement = $this.data("time-gap");
                var advncdRange = $this.data("advanced-range");

                single = !single ? false : single;
                monthYearDrop = !monthYearDrop ? false : monthYearDrop;
                format = !format ? "YYYY-MM-DD" : format;
                separator = !separator ? " / " : separator;
                minDate = !pastDisable ? minDate : today;
                maxDate = !futureDisable ? maxDate : today;
                timePicker = !timePicker ? false : timePicker;
                timePickerIncrement = !timePickerIncrement ? 1 : timePickerIncrement;
                ranges = !advncdRange ? "" : ranges;

                $this.daterangepicker({
                    singleDatePicker: single,
                    showDropdowns: monthYearDrop,
                    minDate: minDate,
                    maxDate: maxDate,
                    timePickerIncrement: timePickerIncrement,
                    autoUpdateInput: false,
                    ranges: ranges,
                    locale: {
                        format: format,
                        separator: separator,
                        applyLabel: "Select",
                        cancelLabel: "Clear",
                    },
                });
                if (single) {
                    $this.on("apply.daterangepicker", function(ev, picker) {
                        $this.val(picker.startDate.format(format));
                    });
                } else {
                    $this.on("apply.daterangepicker", function(ev, picker) {
                        $this.val(
                            picker.startDate.format(format) +
                            separator +
                            picker.endDate.format(format)
                        );
                    });
                }

                $this.on("cancel.daterangepicker", function(ev, picker) {
                    $this.val("");
                });
            });

            $(document).on('change', '#category_ids', function(e) {
                var category_ids = $(this).val();
                var product_ids = [];
                $('input[name="product_ids[]"]').each(function(i) {
                    product_ids[i] = $(this).val();
                });
                var url = "{{ Route('admin.deal.create') }}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _method: 'GET',
                        category_ids: category_ids,
                        product_ids: product_ids,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#product_id option').remove();
                            $('#product_id').append('<option value=""></option>');
                            $(response.products).each(function(index, value) {
                                $('#product_id').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                            var placeholder = $(this).data('placeholder');
                            placeholder = !placeholder ? "choose" : placeholder;
                            $('.select').select2({
                                placeholder: placeholder,
                            });
                        }
                    }
                });
            });

            $(document).on('change', '#product_id', function(e) {
                var product_id = $(this).val();
                var url = "{{ Route('admin.deal.create') }}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _method: 'GET',
                        product_id: product_id,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            var tr = '<tr>' +
                                '<td width="100">' +
                                '<input type="hidden" name="product_ids[]" value="' +
                                response.product.id + '">' +
                                '<img src="' + window.location.origin + '/' +
                                response.product
                                .thumbnail +
                                '" class="img-fit" height="50" alt="' + response.product
                                .name +
                                '">' +
                                '</td>' +
                                '<td>' +
                                '<span>' + response.product.name + '</span>' +
                                '</td>' +
                                '<td>' +
                                '<span>' + response.product.price.sale_price + '</span>' +
                                '</td>' +
                                '<td>' +
                                '<input type="number" name="discount[]" value="0" min="0"' +
                                'step="1" class="form-control" required>' +
                                '</td>' +
                                '<td>' +
                                '<select class="form-select" name="discount_type[]">' +
                                '<option value="amount">Flat</option>' +
                                '<option value="percent">Percent</option>' +
                                '</select>' +
                                '</td>' +
                                '<td class="text-end"><button type="button" data-name="' +
                                response.product.name + '" data-id="' + response.product.id +
                                '" class="btn btn-danger btn-remove"><i class="far fa-times"></i></button></td>'
                            '</tr>';
                            $('#product_table tbody').prepend(tr);
                            $('#product_wrapper').show();
                            $('#product_id option[value=' + response.product.id + ']').remove();
                        }
                    }
                });


            });

            $(document).on('click', '.btn-remove', function(e) {
                let product_id = $(this).data('id');
                let product_name = $(this).data('name');
                $('#product_id').append('<option value="' + product_id +
                    '">' + product_name + '</option>');
                var placeholder = $(this).data('placeholder');
                placeholder = !placeholder ? "choose" : placeholder;
                $('.select').select2({
                    placeholder: placeholder,
                });
                $(this).closest('tr').remove();
            });
        });
    </script>
@endpush
