@extends('layouts.admin.app')

@section('content')
    <div class="row g-3 remove-paginate-field">
        <div class="col-xl-4">
            <form action="{{ Route('admin.location.store') }}" method="POST" id="addForm">
                @csrf
                <div class="card">
                    <div class="card-header pe-2 py-2">
                        <h6 class="h6 mb-0">Add New Division</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="name" class="form-label"><b>Division Name</b></label>
                                <input type="text" class="form-control" id="name" name="name" required
                                    placeholder="Division Name">
                            </div>
                            <div class="col-12">
                                <label for="delivery_charge" class="form-label"><b>Delivery Charge</b></label>
                                <input type="number" class="form-control" id="delivery_charge" name="delivery_charge"
                                    required value="0" placeholder="Delivery Charge">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-sm btn-primary">Add Division</button>
                    </div>
                </div>
            </form>
            <form action="" method="POST" id="editForm" style="display: none;">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header pe-2 py-2">
                        <h6 class="h6 mb-0">Edit Division</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="name_old" class="form-label"><b>Division Name</b></label>
                                <input type="text" class="form-control" id="name_old" name="name" required
                                    placeholder="Division Name">
                            </div>
                            <div class="col-12">
                                <label for="delivery_charge_old" class="form-label"><b>Delivery Charge</b></label>
                                <input type="number" class="form-control" id="delivery_charge_old" name="delivery_charge"
                                    required placeholder="Delivery Charge">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-sm btn-warning cancelBtn" id="cancelBtn">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Update Division</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card mt-4">
                <div class="card-header pe-2 py-2">
                    <h6 class="h6 mb-0">All Divisions</h6>
                </div>
                <div class="card-body">
                    <table class="dataTable table align-middle" style="width:100%">
                        <thead>
                            <tr class="text-nowrap">
                                <th width="3"></th>
                                <th>Location</th>
                                <th>Delivery Charge</th>
                                <th width="110">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center" colspan="1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="selectAll">
                                        <label class="custom-control-label" for="selectAll"></label>
                                    </div>
                                </th>
                                <th colspan="3">
                                    <button type="button" name="bulk_delete"
                                        data-url="{{ Route('admin.location.destroy', '0') }}" id="bulk_delete_division"
                                        class="btn btn btn-xs btn-danger">Delete</button>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <form action="{{ Route('admin.location.store') }}" method="POST" id="addFormTwo">
                @csrf
                <input type="hidden" name="district" value="1">
                <div class="card">
                    <div class="card-header">
                        <h6 class="h6 mb-0">Add New District</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="district_name" class="form-label"><b>District Name</b></label>
                                <input type="text" class="form-control" id="district_name" name="name" required
                                    placeholder="District Name">
                            </div>
                            <div class="col-md-6">
                                <label for="district_parent_id" class="form-label"><b>Parent Division</b></label>
                                <select id="district_parent_id" name="parent_id" class="form-select select"
                                    data-placeholder="Select Parent Division" required>
                                    <option value=""></option>
                                    @foreach ($divisions as $key => $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="disctrict_delivery_charge" class="form-label"><b>Delivery Charge</b></label>
                                <input type="number" class="form-control" id="disctrict_delivery_charge"
                                    name="delivery_charge" required value="0" placeholder="Delivery Charge">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-sm btn-primary">Add District</button>
                    </div>
                </div>
            </form>
            <form action="" method="POST" id="editFormTwo" style="display: none;">
                @csrf
                @method('PUT')
                <input type="hidden" name="district" value="1">
                <div class="card">
                    <div class="card-header">
                        <h6 class="h6 mb-0">Edit District</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="district_name_old" class="form-label"><b>District Name</b></label>
                                <input type="text" class="form-control" id="district_name_old" name="name"
                                    required placeholder="District Name">
                            </div>
                            <div class="col-md-6">
                                <label for="district_parent_id_old" class="form-label"><b>Parent Division</b></label>
                                <select id="district_parent_id_old" name="parent_id" class="form-select select"
                                    data-placeholder="Select Parent Division" required>
                                    <option value=""></option>
                                    @foreach ($divisions as $key => $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="district_delivery_charge_old" class="form-label"><b>Delivery
                                        Charge</b></label>
                                <input type="number" class="form-control" id="district_delivery_charge_old"
                                    name="delivery_charge" required placeholder="Delivery Charge">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-sm btn-warning cancelBtn"
                                id="cancelBtnTwo">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Update District</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="h6 mb-0">All Disctrict</h6>
                </div>
                <div class="card-body">
                    <table class="dataTableTwo table align-middle" style="width:100%">
                        <thead>
                            <tr class="text-nowrap">
                                <th width="3"></th>
                                <th>Location</th>
                                <th>Parent Division</th>
                                <th>Delivery Charge</th>
                                <th width="110">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center" colspan="1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="selectAllTwo">
                                        <label class="custom-control-label" for="selectAllTwo"></label>
                                    </div>
                                </th>
                                <th colspan="4">
                                    <button type="button" name="bulk_delete"
                                        data-url="{{ Route('admin.location.destroy', '0') }}" id="bulk_delete_district"
                                        class="btn btn btn-xs btn-danger">Delete</button>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <form action="{{ Route('admin.location.store') }}" method="POST" id="addFormThree">
                @csrf
                <input type="hidden" name="thana" value="1">
                <div class="card">
                    <div class="card-header">
                        <h6 class="h6 mb-0">Add New Upozila</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="thana_name" class="form-label"><b>Upozila Name</b></label>
                                <input type="text" class="form-control" id="thana_name" name="name" required
                                    placeholder="Upozila Name">
                            </div>
                            <div class="col-md-6">
                                <label for="thana_parent_id" class="form-label"><b>Parent District</b></label>
                                <select id="thana_parent_id" name="parent_id" class="form-select select"
                                    data-placeholder="Select Parent District" required>
                                    <option value=""></option>
                                    @foreach ($districts as $key => $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="thana_delivery_charge" class="form-label"><b>Delivery Charge</b></label>
                                <input type="number" class="form-control" id="thana_delivery_charge"
                                    name="delivery_charge" required value="0" placeholder="Delivery Charge">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-sm btn-primary">Add Upozila</button>
                    </div>
                </div>
            </form>
            <form action="" method="POST" id="editFormThree" style="display: none;">
                @csrf
                @method('PUT')
                <input type="hidden" name="thana" value="1">
                <div class="card">
                    <div class="card-header">
                        <h6 class="h6 mb-0">Edit Upozila</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="thana_name_old" class="form-label"><b>District Name</b></label>
                                <input type="text" class="form-control" id="thana_name_old" name="name" required
                                    placeholder="District Name">
                            </div>
                            <div class="col-md-6">
                                <label for="thana_parent_id_old" class="form-label"><b>Parent District</b></label>
                                <select id="thana_parent_id_old" name="parent_id" class="form-select select"
                                    data-placeholder="Select Parent District" required>
                                    <option value=""></option>
                                    @foreach ($districts as $key => $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="thana_delivery_charge_old" class="form-label"><b>Delivery Charge</b></label>
                                <input type="number" class="form-control" id="thana_delivery_charge_old"
                                    name="delivery_charge" required placeholder="Delivery Charge">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-sm btn-warning cancelBtn"
                                id="cancelBtnThree">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Update District</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="h6 mb-0">All Upozila</h6>
                </div>
                <div class="card-body">
                    <table class="dataTableThree table align-middle" style="width:100%">
                        <thead>
                            <tr class="text-nowrap">
                                <th width="3"></th>
                                <th>Location</th>
                                <th>Parent District</th>
                                <th>Delivery Charge</th>
                                <th width="110">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center" colspan="1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="selectAllThree">
                                        <label class="custom-control-label" for="selectAllThree"></label>
                                    </div>
                                </th>
                                <th colspan="4">
                                    <button type="button" name="bulk_delete"
                                        data-url="{{ Route('admin.location.destroy', '0') }}" id="bulk_delete_thana"
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
                    url: "{{ Route('admin.location.index') }}",
                    type: "GET",
                    data: function(data) {
                        data.division = 'true';
                    }
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
                        data: 'delivery_charge',
                        name: 'delivery_charge'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        width: '100',
                        className: "text-end",
                    },
                ]
            });

            var table = $('.dataTableTwo').dataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ Route('admin.location.index') }}",
                    type: "GET",
                    data: function(data) {
                        data.district = 'true';
                    }
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
                        data: 'parent.name',
                        name: 'parent.name'
                    },
                    {
                        data: 'delivery_charge',
                        name: 'delivery_charge'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        width: '100',
                        className: "text-end",
                    },
                ]
            });

            var table = $('.dataTableThree').dataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ Route('admin.location.index') }}",
                    type: "GET",
                    data: function(data) {
                        data.thana = 'true';
                    }
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
                        data: 'parent.name',
                        name: 'parent.name'
                    },
                    {
                        data: 'delivery_charge',
                        name: 'delivery_charge'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        width: '100',
                        className: "text-end",
                    },
                ]
            });

            $(document).on('click', '.division-edit', function(e) {
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
                            $('#name_old').val(response.data.name);
                            $('#delivery_charge_old').val(response.data.delivery_charge);
                            $('#editForm').show();
                            $('#addForm').hide();
                        }
                    }
                });
            });

            $(document).on('click', '.district-edit', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                $.ajax({
                    url: url,
                    data: {
                        _method: 'GET',
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#editFormTwo').attr('action', response.form_link);
                            $('#district_name_old').val(response.data.name);
                            $('#district_delivery_charge_old').val(response.data
                                .delivery_charge);
                            $('#district_parent_id_old').val(response.data.parent_id);
                            $('.select').select2();
                            $('#editFormTwo').show();
                            $('#addFormTwo').hide();
                        }
                    }
                });
            });

            $(document).on('click', '.thana-edit', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                $.ajax({
                    url: url,
                    data: {
                        _method: 'GET',
                    },
                    success: (response) => {
                        $('#editFormThree').attr('action', response.form_link);
                        $('#thana_name_old').val(response.data.name);
                        $('#thana_delivery_charge_old').val(response.data.delivery_charge);
                        $('#thana_parent_id_old').val(response.data.parent_id);
                        $('.select').select2();
                        $('#editFormThree').show();
                        $('#addFormThree').hide();
                    }
                });
            });

            $(document).on('click', '.cancelBtn', function(e) {
                e.preventDefault();
                $('#editForm').hide();
                $('#addForm').show();
                $('#editFormTwo').hide();
                $('#addFormTwo').show();
                $('#editFormThree').hide();
                $('#addFormThree').show();
            });

            $("#selectAll").on("click", function(e) {
                if ($(this).is(":checked")) {
                    $(".multi_checkbox").prop("checked", true);
                } else {
                    $(".multi_checkbox").prop("checked", false);
                }
            });

            $("#selectAllTwo").on("click", function(e) {
                if ($(this).is(":checked")) {
                    $(".multi_checkbox_district").prop("checked", true);
                } else {
                    $(".multi_checkbox_district").prop("checked", false);
                }
            });

            $("#selectAllThree").on("click", function(e) {
                if ($(this).is(":checked")) {
                    $(".multi_checkbox_thana").prop("checked", true);
                } else {
                    $(".multi_checkbox_thana").prop("checked", false);
                }
            });

            $("#bulk_delete_division").on("click", function() {
                let url = $(this).data("url");
                let selectClass = "multi_checkbox";
                multiDelCheckbox(url, selectClass);
            });

            $("#bulk_delete_district").on("click", function() {
                let url = $(this).data("url");
                let selectClass = "multi_checkbox_district";
                multiDelCheckbox(url, selectClass);
            });

            $("#bulk_delete_thana").on("click", function() {
                let url = $(this).data("url");
                let selectClass = "multi_checkbox_thana";
                multiDelCheckbox(url, selectClass);
            });

            // multi delete row table
            function multiDelCheckbox(url, selectClass) {
                Swal.fire({
                    width: "25rem",
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.value) {
                        let id = [];
                        $("." + selectClass + ":checked").each(function() {
                            id.push($(this).val());
                        });
                        if (id.length > 0) {
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    _method: 'DELETE',
                                    id: id,
                                },
                                success: function(response) {
                                    if (response.status == 'success') {
                                        $('#editForm').hide();
                                        $('#addForm').show();
                                        Swal.fire({
                                            width: "22rem",
                                            title: "Deleted!",
                                            text: response.val,
                                            icon: "success",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        $('.dataTable').DataTable().ajax.reload();
                                    }
                                    if (response.status == 'error') {
                                        $('#editForm').hide();
                                        $('#addForm').show();
                                        Swal.fire({
                                            width: "22rem",
                                            title: "Failed!",
                                            text: "You don't have any Authority to do this action",
                                            icon: "error",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    }
                                    $("#selectAll").prop("checked", false);
                                    $("input[type=checkbox]").prop("checked", false);
                                    $('.dataTable').DataTable().ajax.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                width: "22rem",
                                title: "Error!",
                                text: "Please select atleast one checkbox",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                })
            }

        });
    </script>
@endpush
