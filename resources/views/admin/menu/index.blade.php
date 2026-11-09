@extends('layouts.admin.app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-4 order-lg-last">
            <form action="{{ Route('admin.menu.store') }}" method="POST" enctype="multipart/form-data" id="addForm">
                @csrf
                <div class="card">
                    <div class="card-header pe-2 py-2">
                        <h6 class="h6 mb-0">Add New Menu</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="name" class="form-label"><b>Menu Name <span
                                            class="text-danger">*</span></b></label>
                                <input type="text" class="form-control" id="name" name="name" required
                                    value="{{ old('name') }}" placeholder="Menu Name">
                            </div>
                            <div class="col-12">
                                <label for="position" class="form-label"><b>Position <span
                                            class="text-danger">*</span></b></label>
                                <select name="position" id="position" class="form-select" required>
                                    <option value="header"
                                        {{ !is_null(old('position')) && old('position') == 'header' ? 'selected' : '' }}>
                                        Header</option>
                                    <option value="footer"
                                        {{ !is_null(old('position')) && old('position') == 'footer' ? 'selected' : '' }}>
                                        Footer</option>
                                    <option
                                        {{ !is_null(old('position')) && old('position') == 'sidebar' ? 'selected' : '' }}
                                        value="sidebar">Sidebar Category</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="status" class="form-label"><b>Status <span
                                            class="text-danger">*</span></b></label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="1"
                                        {{ !is_null(old('status')) && old('status') == '1' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0"
                                        {{ !is_null(old('status')) && old('status') == '0' ? 'selected' : '' }}>Deactive
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2 text-end">
                        <button type="submit" class="btn btn-sm btn-primary">Add New</button>
                    </div>
                </div>
            </form>

            <form action="" method="POST" id="editForm" enctype="multipart/form-data" style="display: none;">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header pe-2 py-2">
                        <h6 class="h6 mb-0">Edit Menu</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="old_name" class="form-label"><b>Menu Name <span
                                            class="text-danger">*</span></b></label>
                                <input type="text" class="form-control" id="old_name" name="name" required
                                    placeholder="Menu Name">
                            </div>
                            <div class="col-12">
                                <label for="old_position" class="form-label"><b>Position <span
                                            class="text-danger">*</span></b></label>
                                <select name="position" id="old_position" class="form-select" required>
                                    <option value="header">Header</option>
                                    <option value="footer">Footer</option>
                                    <option value="sidebar">Sidebar Category</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="old_status" class="form-label"><b>Status <span
                                            class="text-danger">*</span></b></label>
                                <select name="status" id="old_status" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2 text-end">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-sm btn-warning" id="cancelBtn">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header pe-2 py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="h6 mb-0 text-uppercase">Menu Setup</h6>
                    </div>
                </div>
                <div class="card-body">
                    <table class="dataTable table align-middle" style="width:100%">
                        <thead>
                            <tr class="text-nowrap">
                                <th width="3"></th>
                                <th>Name</th>
                                <th>Position</th>
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
                                        data-url="{{ Route('admin.menu.destroy', '0') }}" id="bulk_delete"
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
                    url: "{{ Route('admin.menu.index') }}",
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'position',
                        name: 'position'
                    },
                    {
                        data: 'status',
                        name: 'status'
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
                            $('#old_position').val(response.data.position);
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
        });
    </script>
@endpush
