<?php $__env->startSection('content'); ?>
    <?php
        $currentRouteName = \Request::route()->getName();
        $link = Route($currentRouteName);
        $delete_link = str_replace('index', 'destroy', $currentRouteName);
    ?>
    <div class="card-body">
        <table class="dataTable table align-middle" style="width:100%">
            <thead>
                <tr class="text-nowrap">
                    <th width="3"></th>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Auth Username</th>
                    <th>Website</th>
                    <th width="110" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <?php if(Auth::user()->can($delete_link)): ?>
                <tfoot>
                    <tr>
                        <th class="text-center" colspan="1">
                            <div class="custom-control custom-checkbox">
                                <div id="regular_all_select">
                                    <input type="checkbox" class="custom-control-input" id="selectAll">
                                    <label class="custom-control-label" for="selectAll"></label>
                                </div>
                                <div id="trash_all_select" style="display: none;">
                                    <input type="checkbox" class="custom-control-input" id="trash_selectAll">
                                    <label class="custom-control-label" for="trash_selectAll"></label>
                                </div>
                            </div>
                        </th>
                        <th class="text-end" colspan="6">
                            <button type="button" name="bulk_delete" data-url="<?php echo e(Route($delete_link, '0')); ?>"
                                id="bulk_delete" class="btn btn btn-xs btn-danger">Delete</button>
                            <button type="button" name="bulk_delete" data-url="<?php echo e(Route($delete_link, '0')); ?>"
                                style="display: none;" id="trash_bulk_delete"
                                class="btn btn btn-xs btn-danger">Delete</button>
                        </th>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.dataTable').dataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "<?php echo e($link); ?>",
                    type: "GET",
                    data: function(data) {
                        data.type = $('#filter').val();
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
                        name: 'name',
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'website',
                        name: 'website'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        className: "text-end",
                    },
                ],
                "fnDrawCallback": function(oSettings) {
                    const tooltips = document.querySelectorAll('.tt');
                    tooltips.forEach(t => {
                        new bootstrap.Tooltip(t);
                    });
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.index_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\smgroupbd\resources\views/admin/company/index.blade.php ENDPATH**/ ?>