 <!-- Design Component CSS -->
        <style>
            .nav-container-center {
                flex-grow: 1;
                margin: 13px 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
            }
            .quick-link-btn {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 6px 12px;
                text-decoration: none;
                font-size: 13px;
                font-weight: 500;
                border-radius: 6px;
                transition: all 0.2s ease;
            }
            .quick-link-btn:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            }
            .list-dropdown-btn {
               
                font-weight: 600;
                padding: 6px 14px;
                font-size: 13px;
                border-radius: 6px;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                transition: all 0.2s;
            }
          
            .custom-dropdown-menu .dropdown-item {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 8px 16px;
                font-size: 13px;
                font-weight: 500;
                color: #4a5568;
                transition: background 0.15s;
            }
            .custom-dropdown-menu .dropdown-item:hover {
                background-color: #f8fafc;
                color: #1a202c;
            }
            .custom-dropdown-menu .dropdown-item i {
                font-size: 14px;
                width: 20px;
                text-align: center;
            }
            @media (max-width: 1200px) {
                .quick-link-btn span {
                    display: none; /* Screen chhoto hole create links er text auto lukabe icon thakbe */
                }
                .quick-link-btn {
                    padding: 8px;
                }
            }
            @media (max-width: 767px) {
                .create-item-group {
                    display: none !important; /* Mobile e jaiga bachanir jonno full create row hide, sidebar use korun */
                }
            }


            /*Language*/
            .language-switch{
    display:flex;
    align-items:center;
    border-radius:50px;
    backdrop-filter:blur(10px);
}

.lang-btn{
    display:flex;
    align-items:center;
    gap:6px;
    padding:4px 8px;
    border-radius:30px;
    text-decoration:none;
    color:#fff;
    font-size:13px;
    font-weight:600;
    transition:all .3s ease;
}

.lang-btn:hover{
    background:rgba(255,255,255,.15);
    color:#fff;
    transform:translateY(-2px);
}

.lang-btn.active{
    background:#16a34a;
    color:#fff;
    box-shadow:0 6px 18px rgba(22,163,74,.35);
}

.lang-btn span{
    white-space:nowrap;
}

@media(max-width:768px){

    .lang-btn span{
        display:none;
    }

    .lang-btn{
        padding:8px 10px;
    }

}
.lang-btn img{
    width:28px;
    height:24px;
    border-radius:8%;
    object-fit:cover;
}
        </style>

<div class="navbar-header shadow-sm">
    <div class="px-sm-3 px-10px d-flex gap-2 align-items-center justify-content-between">
        
        <!-- Left: Brand Toggle -->
        <div class="d-flex align-items-center gap-3">
            <button class="brand-toggle btn btn-sm px-0 d-flex <?php if(Session::has('sidebar-collapse')): ?> active <?php endif; ?>" style="border: none; background: transparent;" style="color:red">
                <span class="svg-icon svg-icon-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                            <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#e8e7f8" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"></path>
                            <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#f8f7ff" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"></path>
                        </g>
                    </svg>
                </span>
            </button>
        </div>

       
        <!-- Middle Section: Create Bar & List Dropdown -->
        <div class="nav-container-center">
            
            <!-- CREATE LINKS (Horizontally Visible) -->
            <div class="create-item-group d-flex align-items-center gap-2">
           <!-- <div class="language-switch">
                <a href="<?php echo e(route('admin.language','en')); ?>"
                class="lang-btn <?php echo e(app()->getLocale() == 'en' ? 'active' : ''); ?>"
                title="English">
                    <img src="<?php echo e(asset('backend/images/en.webp')); ?>" alt="English">
                </a>

                <a href="<?php echo e(route('admin.language','bn')); ?>"
                class="lang-btn <?php echo e(app()->getLocale() == 'bn' ? 'active' : ''); ?>"
                title="বাংলা">
                   <img src="<?php echo e(asset('backend/images/bn.webp')); ?>" alt="বাংলা">
                </a>
            </div> -->
                 
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.product.create')): ?>
                <a href="<?php echo e(url('/admin/product/create')); ?>" class="quick-link-btn" title="Create Product">
                    <i class="fad fa-plus text-primary"></i><span><?php echo e(__('messages.product')); ?></span>
                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.client.create')): ?>
                <a href="<?php echo e(url('/admin/client/create')); ?>" class="quick-link-btn" title="Create Client">
                    <i class="fad fa-plus text-success"></i><span><?php echo e(__('messages.customer')); ?></span>
                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.running-sales.create')): ?>
                <a href="<?php echo e(url('/admin/running-sales/create')); ?>" class="quick-link-btn" title="Create POS">
                    <i class="fad fa-plus text-warning"></i><span><?php echo e(__('messages.pos')); ?></span>
                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.sales.create')): ?>
                <a href="<?php echo e(url('/admin/sales/create')); ?>" class="quick-link-btn" title="Create Invoice">
                    <i class="fad fa-plus text-info"></i><span><?php echo e(__('messages.invoice')); ?></span>
                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.collection.create')): ?>
                <a href="<?php echo e(url('/admin/collection/create')); ?>" class="quick-link-btn" title="Create Collection">
                    <i class="fad fa-plus text-danger"></i><span><?php echo e(__('messages.collection')); ?></span>
                </a>
                <?php endif; ?>
               
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.lifting.create')): ?>
                <a href="<?php echo e(url('/admin/lifting/create')); ?>" class="quick-link-btn" title="Create Purchase">
                    <i class="fad fa-plus text-secondary"></i><span><?php echo e(__('messages.purchase')); ?></span>
                </a>
                <?php endif; ?>
            </div>

            <!-- Vertical Separator Line (Only visible on desktop) -->
            <!-- <div class="d-none d-md-block" style="width: 1px; height: 22px; background-color: #e2e8f0; margin: 0 4px;"></div> -->

            <!-- DROPDOWN FOR LISTS (Protects Space, Always Visible) -->
            <div class="dropdown">
                <button class="btn list-dropdown-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fad fa-list text-primary"></i> <span><?php echo e(__('messages.view_list')); ?></span>
                </button>
                <div class="dropdown-menu custom-dropdown-menu shadow-lg border-0 rounded-3 mt-2">
                    <h6 class="dropdown-header fs-11 text-uppercase fw-bold text-muted px-3 pt-2 mb-1"><?php echo e(__('messages.data_record')); ?></h6>
                
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.product.create')): ?>
                    <a class="dropdown-item" href="<?php echo e(url('/admin/product')); ?>">
                        <i class="fad fa-box-open text-primary"></i> <span><?php echo e(__('messages.product_list')); ?></span>
                    </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.client.create')): ?>
                    <a class="dropdown-item" href="<?php echo e(url('/admin/client')); ?>">
                        <i class="fad fa-users text-success"></i> <span><?php echo e(__('messages.customer_list')); ?></span>
                    </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.running-sales.index')): ?>
                    <a class="dropdown-item" href="<?php echo e(url('/admin/running-sales')); ?>">
                        <i class="fad fa-cash-register text-warning"></i> <span><?php echo e(__('messages.pos_sales')); ?></span>
                    </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.sales.index')): ?>
                    <a class="dropdown-item" href="<?php echo e(url('/admin/sales')); ?>">
                        <i class="fad fa-file-invoice-dollar text-info"></i> <span><?php echo e(__('messages.invoice_list')); ?></span>
                    </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.collection.index')): ?>
                    <a class="dropdown-item" href="<?php echo e(url('/admin/collection')); ?>">
                        <i class="fad fa-money-bill-wave text-danger"></i> <span><?php echo e(__('messages.collection_list')); ?></span>
                    </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.lifting.index')): ?>
                    <a class="dropdown-item" href="<?php echo e(url('/admin/lifting')); ?>">
                        <i class="fad fa-cart-plus text-secondary"></i> <span><?php echo e(__('messages.purchase_list')); ?></span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Right: User Avatar Dropdown -->
        <div class="d-flex align-items-center flex-shrink-0">
            <div class="dropdown ms-sm-3 topbar-user">
                <button type="button" class="btn btn-light rounded-3 border-0 d-flex align-items-center p-1 pe-md-3" data-bs-toggle="dropdown">
                    <span class="d-flex align-items-center gap-2">
                        <img class="rounded-circle lazyload border"
                            data-src="<?php echo e(file_exists(Auth::user()->image) ? asset(Auth::user()->image) : asset('backend/images/avatar/default/user.jpg')); ?>"
                            width="36" height="36" alt="Avatar" style="object-fit: cover;">
                        <span class="text-start d-md-block d-none">
                            <span class="fs-13 fw-bold d-block text-dark lh-sm"><?php echo e(Auth::user()->name); ?></span>
                        </span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-2" style="min-width: 200px; overflow: hidden;">
                    <div class="px-3 py-2.5">
                        <h6 class="fw-bold text-dark fs-13 mb-0"><?php echo e(Auth::user()->name); ?></h6>
                        <small class="text-muted fs-11"><?php echo e(Auth::user()->email); ?></small>
                    </div>
                    <a class="dropdown-item d-flex align-items-center gap-2 fs-13 py-2 px-3 text-secondary"
                        href="<?php echo e(Auth::user()->role == 1 ? Route('admin.profile.index') : Route('client.profile.index')); ?>">
                        <i class="fad fa-user text-primary"></i> <span><?php echo e(__('messages.profile')); ?></span>
                    </a>
                    <div class="dropdown-divider my-0"></div>
                    <a class="dropdown-item d-flex align-items-center gap-2 fs-13 py-2 px-3 text-danger"
                        href="<?php echo e(Auth::user()->role == 1 ? Route('admin.logout') : Route('client.logout')); ?>">
                        <i class="fad fa-sign-out text-danger"></i> <span><?php echo e(__('messages.logout')); ?></span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div><?php /**PATH E:\laragon\www\smgroupbd\resources\views/layouts/admin/partial/header.blade.php ENDPATH**/ ?>