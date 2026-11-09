<div class="navbar-header bg-white shadow-sm">
    <div class="px-sm-3 px-10px d-flex gap-2 align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <button class="brand-toggle btn btn-sm px-0 d-lg-none d-inline-flex align-items-center">
                <span class="hamburger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
        </div>

        <div class="d-flex align-items-center">
            <div class="dropdown ms-sm-3 header-item topbar-user">
                <button type="button" class="btn btn-light rounded-0 border-0" data-bs-toggle="dropdown">
                    <span class="d-flex align-items-center">
                        <img class="rounded-circle img-fit lazyload" data-src="{{ file_exists(Auth::user()->image) ? asset(Auth::user()->image) : asset('backend/images/avatar/default/user.jpg') }}" width="50" height="50"
                            alt="Header Avatar">
                        <span class="ms-2 text-start d-md-block d-none">
                            <span class="fs-15 d-block lh-1 ms-1">{{ Auth::user()->name }}</span>
                            <span class="ms-1 fs-12 text-muted">{{ Auth::user()->email }}</span>
                        </span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end w-100 rounded-0" style="min-width: 200px;">
                    <!-- item-->
                    <h6 class="fw-500 text-muted fs-12 px-3 mb-0 py-10px">Welcome {{ Auth::user()->name }}!</h6>
                    <a class="d-block fs-13 px-3 py-2 hov-bg-light" href="{{ Route('admin.profile.index', Auth::user()->id) }}"><i class="fad fa-user me-1 fs-15"></i> <span>Profile</span></a>
                    <a class="d-block fs-13 px-3 py-2 hov-bg-light" href="{{ Route('admin.logout') }}"> <i class="fad fa-sign-out me-1 fs-15"></i><span>Logout</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
