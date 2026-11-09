@extends('layouts.admin.app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-4 order-lg-last">
            <form action="{{ Route('admin.brand.store') }}" method="POST" enctype="multipart/form-data" id="addForm">
                @csrf
                <div class="card">
                    <div class="card-header pe-2 py-2">
                        <h6 class="h6 mb-0 py-5px">Add New Brand</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="name" class="form-label"><b>Brand Name</b></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Brand Name" required>
                            </div>
                            <div class="col-12">
                                <label for="image" class="form-label"><b>Brand Logo</b></label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                    required>
                            </div>
                            <div class="col-12">
                                <label for="status" class="form-label"><b>Status</b></label>
                                <select name="status" id="status" class="form-select">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-sm btn-primary">Add New</button>
                    </div>
                </div>
            </form>

            <form action="" method="POST" id="editForm" enctype="multipart/form-data" style="display: none;">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header pe-2 py-2">
                        <h6 class="h6 mb-0 py-5px">Edit Brand</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="old_name" class="form-label"><b>Brand Name</b></label>
                                <input type="text" class="form-control" id="old_name" name="name"
                                    placeholder="Brand Name" required>
                            </div>
                            <div class="col-12">
                                <label for="new_image" class="form-label"><b>Brand Logo</b></label>
                                <input type="file" class="form-control" id="new_image" name="image" accept="image/*">
                                <img src="" id="old_image" height="40" alt="">
                            </div>
                            <div class="col-12">
                                <label for="old_status" class="form-label"><b>Status</b></label>
                                <select name="status" id="old_status" class="form-select">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-sm btn-warning" id="cancelBtn">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Update Brand</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header pe-2 py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="h6 mb-0 text-uppercase">Brand Setup</h6>
                    </div>
                </div>
                <div class="card-body">
                    <table class="dataTable table align-middle" style="width:100%">
                        <thead>
                            <tr class="text-nowrap">
                                <th width="3"></th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th width="110" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center" colspan="1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="selectAll">
                                        <label class="custom-control-label" for="selectAll"></label>
                                    </div>
                                </th>
                                <th colspan="4">
                                    <button type="button" name="bulk_delete"
                                        data-url="{{ Route('admin.brand.destroy', '0') }}" id="bulk_delete"
                                        class="btn btn btn-xs btn-danger">Delete</button>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.dataTable').dataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ Route('admin.brand.index') }}",
                    type: "GET",
                },
                columns: [{
                        data: "checkbox",
                        name: "checkbox",
                        orderable: false,
                        searchable: false,
                        width: '3'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        className: "text-end",
                    },
                ]
            });

            $(document).on('click', '.link-edit', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                $.ajax({
                    url: url,
                    data: {
                        _method: 'GET',
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#editForm').attr('action', response.form_link);
                            $('#old_name').val(response.data.name);
                            $('#old_image').attr('src', window.location.origin + '/' + response
                                .data.image);
                            $('#old_status').val(response.data.status);
                            $('#editForm').show();
                            $('#addForm').hide();
                        }
                        if (response.status == 'error') {
                            Swal.fire({
                                width: "22rem",
                                title: "Failed!",
                                text: "You don't have any Authority to do this action",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }
                });
            });

            $(document).on('click', '#cancelBtn', function(e) {
                e.preventDefault();
                $('#editForm').hide();
                $('#addForm').show();
            });
        });
    </script>
@endpush
