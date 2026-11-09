<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

    <title><?php echo e($admin_setting ? $admin_setting->title : ''); ?></title>
    <link rel="shortcut icon"
        href="<?php echo e($admin_setting && file_exists($admin_setting->favicon) ? asset($admin_setting->favicon) : asset('backend/images/logo/favicon.png')); ?>"
        type="image/x-icon">
    <?php echo $__env->make('layouts.admin.partial.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.admin.partial.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        :root {
            --bs-primary: <?php echo e($admin_setting && $admin_setting->primary_color ? $admin_setting->primary_color : '#3753e9'); ?>;
            --bs-secondary: <?php echo e($admin_setting && $admin_setting->secondary_color ? $admin_setting->secondary_color : '#415FFF'); ?>;
        }
    </style>
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
<style>
body,*{
    font-family: 'SolaimanLipi', sans-serif;
}
</style>
<?php echo $__env->make('layouts.admin.partial.dynamic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body class="bg-light">
    <div class="overflow-hidden site-wrapper <?php if(Session::has('sidebar-collapse')): ?> session-sidebar <?php endif; ?>">
        <?php echo $__env->make('layouts.admin.partial.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="content-wrapper">
            <?php echo $__env->make('layouts.admin.partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content">
                <div class="p-sm-4 p-3">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header pe-2 py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="h6 mb-0 text-uppercase py-5px">
                                            <?php echo e(isset($title) ? $title : 'Please Set Title'); ?></h6>
                                        <?php
                                            $currentRouteName = \Request::route()->getName();
                                            $create_link = str_replace('index', 'create', $currentRouteName);
                                        ?>
                                        <div class="d-flex flex-wrap gap-2">
                                            <?php if(isset($params)): ?>
                                                <?php echo $params; ?>

                                            <?php endif; ?>
                                            <?php if(Auth::user()->hasRole('Software Admin') && !isset($disable_filter)): ?>
                                                <select name="filter" id="filter"
                                                    class="form-select custom-select input-sm flex-shrink-0"
                                                    style="width: 70px;">
                                                    <option value="all">All</option>
                                                    <option value="trash">Trash</option>
                                                </select>
                                            <?php endif; ?>
                                            <?php if(!isset($inactive_create)): ?>
                                                <?php if(Auth::user()->can($create_link)): ?>
                                                    <a href="<?php echo e(Route($create_link)); ?>"
                                                        class="btn btn-primary btn-sm">Add
                                                        New</a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php echo $__env->yieldContent('content'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $__env->make('layouts.admin.partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <!-- End Site Wrapper -->

    <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.admin.partial.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $(".date_picker").datepicker({
                format: 'dd-mm-yyyy',
                changeMonth: true,
                changeYear: true,
            }).datepicker('setDate', 'today');

            $(document).on('change', '.change-status', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                $.ajax({
                    url: url,
                    data: {
                        _method: 'GET',
                        status: 'true',
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            Swal.fire({
                                width: "22rem",
                                title: "Changed!",
                                text: 'Status Changed Successfully!',
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            })
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
                            $('.dataTable').DataTable().ajax.reload();
                        }
                    }
                });
            });

            $(document).on('click', '.link-delete', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    $('#editForm').hide();
                                    $('#addForm').show();
                                    Swal.fire({
                                        width: "22rem",
                                        title: "Deleted!",
                                        text: response.status,
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
                            }
                        });
                    } else(
                        result.dismiss === Swal.DismissReason.cancel
                    )
                });
            });

            $("#selectAll").on("click", function(e) {
                if ($(this).is(":checked")) {
                    $(".multi_checkbox").prop("checked", true);
                } else {
                    $(".multi_checkbox").prop("checked", false);
                }
            });

            $(document).on('click', '.trash_delete', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                parmanent: 'true',
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    Swal.fire({
                                        width: "22rem",
                                        title: "Deleted!",
                                        text: response.status,
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    $('.dataTable').DataTable().ajax.reload();
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
                    }
                });
            });

            // multi delete row table
            function multiDelCheckbox(url, selectClass, parmanent) {
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
                    if (result.isConfirmed) {
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
                                    parmanent: parmanent
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
                            });
                        }
                    }
                });
            }

            $("#trash_bulk_delete").on("click", function() {
                let url = $(this).data("url");
                let selectClass = "trash_multi_checkbox";
                multiDelCheckbox(url, selectClass, 'true');
            });

            $("#trash_selectAll").on("click", function(e) {
                if ($(this).is(":checked")) {
                    $(".trash_multi_checkbox").prop("checked", true);
                } else {
                    $(".trash_multi_checkbox").prop("checked", false);
                }
            });

            $("#bulk_delete").on("click", function() {
                let url = $(this).data("url");
                let selectClass = "multi_checkbox";
                multiDelCheckbox(url, selectClass, 'false');
            });

            $(document).on('click', '.link-recovery', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                recovery: 'true',
                            },
                            success: (response) => {
                                if (response.status == 'success') {
                                    Swal.fire({
                                        width: "22rem",
                                        title: "Recovered!",
                                        text: 'Recovered Successfully!',
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    $('.dataTable').DataTable().ajax.reload();
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
                                    $('.dataTable').DataTable().ajax.reload();
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    width: "22rem",
                                    title: "Failed!",
                                    text: xhr.responseJSON?.message || '',
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        });
                    } else(
                        result.dismiss === Swal.DismissReason.cancel
                    )
                });
            });

            $(document).on('change', '#filter', function(e) {
                e.preventDefault();
                if ($(this).val() == 'trash') {
                    $('#regular_all_select').hide();
                    $('#trash_all_select').show();
                    $('#bulk_delete').hide();
                    $('#trash_bulk_delete').show();
                } else {
                    $('#regular_all_select').show();
                    $('#trash_all_select').hide();
                    $('#bulk_delete').show();
                    $('#trash_bulk_delete').hide();
                }
                $('.dataTable').DataTable().ajax.reload();
            });

            $(document).on('click', '.link-print', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _method: 'GET',
                    }
                });
            });
        });
    </script>
    <?php echo $__env->yieldPushContent('js'); ?>
</body>

</html>
<?php /**PATH E:\laragon\www\smgroupbd\resources\views/layouts/admin/index_app.blade.php ENDPATH**/ ?>