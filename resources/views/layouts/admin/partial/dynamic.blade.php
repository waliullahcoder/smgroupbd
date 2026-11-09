 
 <!-- Darkness -->
 
 @if($admin_setting->template_status=='template1')

<style>
    :root {
        --primary: #21AFBC;
        --primary-dark: #1599a6;
        --primary-light: #12383d;

        --body-bg: #0f1720;
        --white: #17212b;

        --text: #e2e8f0;
        --text-light: #94a3b8;

        --border: #263642;
        --hover: #132f35;
        --shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
    }

    /* =========================
       BODY
    ========================== */
    body {
        background: var(--body-bg) !important;
        color: var(--text) !important;
    }
    .bg-light{
         background: var(--body-bg) !important;
    }
    .metric-title{
        color: var(--text) !important;
    }
    .ms-sm-3{
        margin-left: 0px !important;
    }
    .text-primary{
        color: var(--text) !important;
    }
    

    /* =========================
       TOP NAVBAR
    ========================== */
    .navbar-header {
        background: var(--white) !important;
        border-bottom: 1px solid var(--border) !important;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.20);
    }

    .brand {
        background: var(--white) !important;
        border-bottom: 1px solid var(--border) !important;
    }

    /* =========================
       SIDEBAR
    ========================== */
    .aside-fixed.aside {
        background: var(--white) !important;
        border-right: 1px solid var(--border);
    }

    .aside-menu-wrapper {
        border-right: 1px solid var(--border) !important;
    }

    .aside-menu .menu-nav .menu-link {
        color: var(--text-light) !important;
        border-radius: 8px;
        margin: 3px 10px;
        transition: all 0.2s ease;
    }

    .aside-menu .menu-nav .menu-submenu .menu-link {
        color: var(--text-light) !important;
    }

    .aside-menu .menu-nav > .menu-item > .menu-heading .menu-text,
    .aside-menu .menu-nav > .menu-item > .menu-link .menu-text {
        color: var(--text) !important;
    }
    .fa, .fab, .fad, .fal, .far, .fas{
        color: #64748b !important;
    }
    /* Sidebar Icon */
    .menu-icon {
        color: #64748b !important;
        transition: 0.2s;
    }

    /* Sidebar Hover */
    .menu-item > .menu-link:hover {
        background: var(--hover) !important;
        color: var(--primary) !important;
    }

    .menu-item > .menu-link:hover .menu-text,
    .menu-item > .menu-link:hover .menu-icon {
        color: var(--primary) !important;
    }

    /* Active Menu */
    .menu-item.menu-item-active > .menu-link,
    .menu-item > .menu-link.active {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
        font-weight: 600;
        box-shadow: inset 3px 0 0 var(--primary);
    }

    .menu-item.menu-item-active > .menu-link > .menu-text,
    .menu-item > .menu-link.active > .menu-text {
        color: var(--primary) !important;
    }

    .aside-menu .menu-nav .menu-item > .menu-link.active > .menu-icon i,
    .aside-menu .menu-nav .menu-item.menu-item-active .menu-icon i,
    .aside-menu .menu-nav .menu-item:hover .menu-icon i {
        color: var(--primary) !important;
    }

    /* =========================
       CARDS
    ========================== */
    .card {
        background: var(--white) !important;
        border: 1px solid var(--border) !important;
        border-radius: 12px !important;
        box-shadow: var(--shadow);
    }

    .custom-info-card {
        background: var(--white) !important;
        border: 1px solid var(--border) !important;
        border-radius: 12px !important;
        box-shadow: var(--shadow);
        transition: all 0.25s ease;
    }

    .custom-info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.30);
    }

    .dashboard-chart-card {
        background: var(--white) !important;
        color: var(--text) !important;
        border: 1px solid var(--border) !important;
        border-radius: 12px !important;
        box-shadow: var(--shadow);
    }

    /* =========================
       METRICS
    ========================== */
    .metric-value {
        color: var(--primary) !important;
        font-weight: 700;
    }

    .card-icon-box {
        color: var(--primary) !important;
        background: var(--primary-light);
        border-radius: 10px;
    }

    /* =========================
       TABLE
    ========================== */
    .dataTables_wrapper {
        background: var(--white);
    }

    .dataTables_wrapper th {
        background: #1d2a35 !important;
        color: #cbd5e1 !important;
        border-bottom: 1px solid var(--border) !important;
        font-weight: 600;
    }

    .dataTables_wrapper td {
        color: #cbd5e1 !important;
        border-bottom: 1px solid #263642 !important;
    }

    .dataTables_wrapper tbody tr:hover {
        background: #1a3037 !important;
    }

    /* =========================
       BUTTONS
    ========================== */
    .btn {
        border-radius: 7px !important;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: var(--primary) !important;
        border-color: var(--primary) !important;
        color: #ffffff !important;
        box-shadow: 0 3px 10px rgba(33, 175, 188, 0.20);
    }

    .btn-primary:hover {
        background: var(--primary-dark) !important;
        border-color: var(--primary-dark) !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    .bg-primary {
        background-color: var(--primary) !important;
    }

    .border-primary {
        border-color: var(--primary) !important;
    }

    /* =========================
       DROPDOWN
    ========================== */
    .dropdown-menu {
        background: #17212b !important;
        border: 1px solid var(--border) !important;
        border-radius: 10px !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
    }

    .dropdown-menu .dropdown-item {
        color: var(--text) !important;
    }

    .dropdown-menu .dropdown-item:hover {
        background: var(--hover) !important;
        color: var(--primary) !important;
    }

    .list-dropdown-btn {
        background: #14232d !important;
        border: 1px solid var(--border) !important;
        color: var(--primary) !important;
        border-radius: 7px !important;
    }

    .list-dropdown-btn:hover,
    .list-dropdown-btn:focus {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
        border-color: #245a61 !important;
    }

    /* =========================
       LANGUAGE
    ========================== */
    .language-switch {
        background: #14202a !important;
        border: 1px solid var(--border);
        border-radius: 8px;
    }

    .lang-btn.active {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
        border-radius: 6px;
    }

    /* =========================
       FORM ELEMENTS
    ========================== */
    .form-control,
    .form-select {
        background-color: #17212b !important;
        border: 1px solid #334452 !important;
        color: #e2e8f0 !important;
        border-radius: 7px !important;
    }

    .form-control::placeholder {
        color: #64748b !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 3px rgba(33, 175, 188, 0.12) !important;
        background-color: #192631 !important;
        color: #ffffff !important;
    }

    .form-select option {
        background: #17212b !important;
        color: #e2e8f0 !important;
    }

    /* =========================
       SWITCH
    ========================== */
    .form-switch .form-check-input {
        background-color: #334452 !important;
        border-color: #475569 !important;
    }

    .form-switch .form-check-input:checked {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
    }

    /* =========================
       TEXT
    ========================== */
    .text-secondary {
        color: var(--text-light) !important;
    }

    .text-secondary:hover {
        color: var(--primary) !important;
    }

    /* =========================
       QUICK LINKS
    ========================== */
    .quick-link-btn {
        background: var(--white) !important;
        color: var(--text) !important;
        border: 1px solid var(--border) !important;
        border-radius: 9px !important;
        transition: all 0.2s ease;
        gap:0px !important;
    }

    .quick-link-btn:hover {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
        border-color: #245a61 !important;
        transform: translateY(-1px);
    }

    /* =========================
       PAGINATION
    ========================== */
    .pagination .page-item .page-link {
        color: var(--text-light) !important;
        border-color: var(--border) !important;
        background: #17212b !important;
        border-radius: 6px !important;
        margin: 0 2px;
    }

    .pagination .page-item .page-link:hover,
    .pagination .page-item.active .page-link {
        background: var(--primary) !important;
        border-color: var(--primary) !important;
        color: #ffffff !important;
    }

    /* =========================
       FOOTER
    ========================== */
    .footer {
        background: var(--white) !important;
        border-top: 1px solid var(--border) !important;
        color: var(--text-light) !important;
    }

    .footer a {
        color: var(--primary) !important;
    }

    /* =========================
       BADGE
    ========================== */
    .badge-primary {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
    }

    /* =========================
       LINKS
    ========================== */
    a {
        color: var(--primary);
    }

    a:hover {
        color: var(--primary-dark);
    }

    /* =========================
       HR
    ========================== */
    hr {
        border-color: var(--border) !important;
    }

    /* =========================
       SCROLLBAR
    ========================== */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #111b24;
    }

    ::-webkit-scrollbar-thumb {
        background: #38505d;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary);
    }
</style>




















<!-- Light Theme -->
@elseif($admin_setting->template_status=='template2')
<style>
    :root {
        --primary: #21AFBC;
        --primary-dark: #1599a6;
        --primary-light: #e9f9fb;

        --body-bg: #f6fafb;
        --white: #ffffff;

        --text: #334155;
        --text-light: #64748b;

        --border: #e5eef0;
        --hover: #f0fafb;
        --shadow: 0 4px 20px rgba(33, 175, 188, 0.06);
    }
    .metric-title{
        color: var(--text) !important;
    }
    .ms-sm-3{
        margin-left: 0px !important;
    }
    .text-primary{
        color: var(--text) !important;
    }
    /* =========================
       BODY
    ========================== */
    body {
        background: var(--body-bg) !important;
        color: var(--text) !important;
    }
    .nav-container-center{
        gap:none;
    }
    .gap-2{
        gap: .2rem!important
    }
    .bg-light{
         background: var(--body-bg) !important;
    }
    /* =========================
       TOP NAVBAR
    ========================== */
    .navbar-header {
        background: var(--white) !important;
        border-bottom: 1px solid var(--border) !important;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.03);
    }

    .brand {
        background: var(--white) !important;
        border-bottom: 1px solid var(--border) !important;
    }

    /* =========================
       SIDEBAR
    ========================== */
    .aside-fixed.aside {
        background: var(--white) !important;
        border-right: 1px solid var(--border);
    }

    .aside-menu-wrapper {
        border-right: 1px solid var(--border) !important;
    }

    .aside-menu .menu-nav .menu-link {
        color: var(--text-light) !important;
        border-radius: 8px;
        margin: 3px 10px;
        transition: all 0.2s ease;
    }

    .aside-menu .menu-nav .menu-submenu .menu-link {
        color: var(--text-light) !important;
    }

    .aside-menu .menu-nav > .menu-item > .menu-heading .menu-text,
    .aside-menu .menu-nav > .menu-item > .menu-link .menu-text {
        color: var(--text) !important;
    }

    .fa, .fab, .fad, .fal, .far, .fas{
        color: #64748b !important;
    }

    /* Sidebar Icon */
    .menu-icon {
        color: #7b8b95 !important;
        transition: 0.2s;
    }

    /* Sidebar Hover */
    .menu-item > .menu-link:hover {
        background: var(--hover) !important;
        color: var(--primary) !important;
    }

    .menu-item > .menu-link:hover .menu-text,
    .menu-item > .menu-link:hover .menu-icon {
        color: var(--primary) !important;
    }

    /* Active Menu */
    .menu-item.menu-item-active > .menu-link,
    .menu-item > .menu-link.active {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
        font-weight: 600;
        box-shadow: inset 3px 0 0 var(--primary);
    }

    .menu-item.menu-item-active > .menu-link > .menu-text,
    .menu-item > .menu-link.active > .menu-text {
        color: var(--primary) !important;
    }

    .aside-menu .menu-nav .menu-item > .menu-link.active > .menu-icon i,
    .aside-menu .menu-nav .menu-item.menu-item-active .menu-icon i,
    .aside-menu .menu-nav .menu-item:hover .menu-icon i {
        color: var(--primary) !important;
    }

    /* =========================
       CARDS
    ========================== */
    .card {
        background: var(--white) !important;
        border: 1px solid var(--border) !important;
        border-radius: 12px !important;
        box-shadow: var(--shadow);
    }

    .custom-info-card {
        background: var(--white) !important;
        border: 1px solid var(--border) !important;
        border-radius: 12px !important;
        box-shadow: var(--shadow);
        transition: all 0.25s ease;
    }

    .custom-info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(33, 175, 188, 0.10);
    }

    .dashboard-chart-card {
        background: var(--white) !important;
        color: var(--text) !important;
        border: 1px solid var(--border) !important;
        border-radius: 12px !important;
        box-shadow: var(--shadow);
    }

    /* =========================
       METRICS
    ========================== */
    .metric-value {
        color: var(--primary) !important;
        font-weight: 700;
    }

    .card-icon-box {
        color: var(--primary) !important;
        background: var(--primary-light);
        border-radius: 10px;
    }

    /* =========================
       TABLE
    ========================== */
    .dataTables_wrapper {
        background: var(--white);
    }

    .dataTables_wrapper th {
        background: #f8fbfc !important;
        color: #475569 !important;
        border-bottom: 1px solid var(--border) !important;
        font-weight: 600;
    }

    .dataTables_wrapper td {
        color: #475569 !important;
        border-bottom: 1px solid #edf2f4 !important;
    }

    .dataTables_wrapper tbody tr:hover {
        background: #f8fcfd !important;
    }

    /* =========================
       BUTTONS
    ========================== */
    .btn {
        border-radius: 7px !important;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: var(--primary) !important;
        border-color: var(--primary) !important;
        color: #ffffff !important;
        box-shadow: 0 3px 10px rgba(33, 175, 188, 0.18);
    }

    .btn-primary:hover {
        background: var(--primary-dark) !important;
        border-color: var(--primary-dark) !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    .bg-primary {
        background-color: var(--primary) !important;
    }

    .border-primary {
        border-color: var(--primary) !important;
    }

    /* =========================
       DROPDOWN
    ========================== */
    .dropdown-menu {
        background: var(--white) !important;
        border: 1px solid var(--border) !important;
        border-radius: 10px !important;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    }

    .list-dropdown-btn {
        background: #f5fafb !important;
        border: 1px solid var(--border) !important;
        color: var(--primary) !important;
        border-radius: 7px !important;
    }

    .list-dropdown-btn:hover,
    .list-dropdown-btn:focus {
        background: var(--primary-light) !important;
        color: var(--primary-dark) !important;
        border-color: #c8edf0 !important;
    }

    /* =========================
       LANGUAGE
    ========================== */
    .language-switch {
        background: #f8fafb !important;
        border: 1px solid var(--border);
        border-radius: 8px;
    }

    .lang-btn.active {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
        border-radius: 6px;
    }

    /* =========================
       FORM ELEMENTS
    ========================== */
    .form-control,
    .form-select {
        background-color: #ffffff !important;
        border: 1px solid #dce7ea !important;
        color: #334155 !important;
        border-radius: 7px !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 3px rgba(33, 175, 188, 0.10) !important;
    }

    /* =========================
       SWITCH
    ========================== */
    .form-switch .form-check-input:checked {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
    }

    /* =========================
       TEXT
    ========================== */
    .text-secondary {
        color: var(--text-light) !important;
    }

    .text-secondary:hover {
        color: var(--primary) !important;
    }

    /* =========================
       QUICK LINKS
    ========================== */
    .quick-link-btn {
        background: var(--white) !important;
        color: var(--text) !important;
        border: 1px solid var(--border) !important;
        border-radius: 9px !important;
        transition: all 0.2s ease;
    }

    .quick-link-btn:hover {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
        border-color: #c8edf0 !important;
        transform: translateY(-1px);
    }

    /* =========================
       PAGINATION
    ========================== */
    .pagination .page-item .page-link {
        color: var(--text-light) !important;
        border-color: var(--border) !important;
        background: #ffffff !important;
        border-radius: 6px !important;
        margin: 0 2px;
    }

    .pagination .page-item .page-link:hover,
    .pagination .page-item.active .page-link {
        background: var(--primary) !important;
        border-color: var(--primary) !important;
        color: #ffffff !important;
    }

    /* =========================
       FOOTER
    ========================== */
    .footer {
        background: var(--white) !important;
        border-top: 1px solid var(--border) !important;
        color: var(--text-light) !important;
    }

    .footer a {
        color: var(--primary) !important;
    }

    /* =========================
       BADGE
    ========================== */
    .badge-primary {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
    }

    /* =========================
       LINKS
    ========================== */
    a {
        color: var(--primary);
    }

    a:hover {
        color: var(--primary-dark);
    }

    /* =========================
       HR
    ========================== */
    hr {
        border-color: var(--border) !important;
    }

    /* =========================
       SCROLLBAR
    ========================== */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #f5f9fa;
    }

    ::-webkit-scrollbar-thumb {
        background: #c9e7ea;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary);
    }
</style>


















<!-- Color Theme -->
@elseif($admin_setting->template_status=='template3')

<style>
    :root {
        /* =========================
           MAIN COLOR PALETTE
        ========================== */
        --primary: #21AFBC;
        --primary-dark: #168A96;
        --primary-light: #E8FAFC;

        --secondary: #6366F1;
        --success: #10B981;
        --warning: #F59E0B;
        --danger: #EF4444;
        --info: #3B82F6;
        --purple: #8B5CF6;
        --pink: #EC4899;
        --orange: #F97316;

        --body-bg: #fb30fd;
        --white: #FFFFFF;
        --black: #000000;

        --text: #243447;
        --text-light: #64748B;
        --text-muted: #94A3B8;

        --border: #E2E8F0;
        --hover: #F0FAFC;

        --shadow: 0 4px 20px rgba(15, 23, 42, 0.06);
    }


    /* =========================
       BODY
    ========================== */
    body {
        background: var(--body-bg) !important;
        color: var(--text) !important;
    }

    .bg-light {
        background: var(--body-bg) !important;
    }

    .metric-title {
        color: var(--text) !important;
    }

    .text-primary {
        color: var(--primary) !important;
    }


    /* =========================
       TOP NAVBAR
    ========================== */
    .navbar-header {
        background: var(--pink) !important;
        border-bottom: 1px solid var(--border) !important;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.05);
    }

    .brand {
        background: #033b41 !important;
        border-bottom: 1px solid var(--border) !important;
    }


    /* =========================
       SIDEBAR
    ========================== */
    .aside-fixed.aside {
        background: var(--pink) !important;
        border-right: 1px solid var(--border);
    }

    .aside-menu-wrapper {
        border-right: 1px solid var(--border) !important;
    }

    .aside-menu .menu-nav .menu-link {
        color: #fcfdff !important;
        border-radius: 8px;
        margin: 3px 10px;
        transition: all 0.2s ease;
    }

    .aside-menu .menu-nav .menu-submenu .menu-link {
        color: #ffffff !important;
    }

    .aside-menu .menu-nav > .menu-item > .menu-heading .menu-text,
    .aside-menu .menu-nav > .menu-item > .menu-link .menu-text {
        color: #000000 !important;
    }

    .fa,
    .fab,
    .fad,
    .fal,
    .far,
    .fas {
        color: var(--black) !important;
    }

    .menu-icon {
        color:  var(--black) !important;
        transition: 0.2s;
    }


    /* =========================
       SIDEBAR HOVER
    ========================== */
    .menu-item > .menu-link:hover {
        background: var(--warning) !important;
        color: var(--white) !important;
    }

    .menu-item > .menu-link:hover .menu-text,
    .menu-item > .menu-link:hover .menu-icon {
        color: var(--white) !important;
    }


    /* =========================
       ACTIVE MENU
    ========================== */
    .menu-item.menu-item-active > .menu-link,
    .menu-item > .menu-link.active {
        background: var(--warning) !important;
        color: var(--white) !important;
        font-weight: 600;
        box-shadow: inset 3px 0 0 var(--white);
    }

    .menu-item.menu-item-active > .menu-link > .menu-text,
    .menu-item > .menu-link.active > .menu-text {
        color: var(--white) !important;
    }

    .aside-menu .menu-nav .menu-item > .menu-link.active > .menu-icon i,
    .aside-menu .menu-nav .menu-item.menu-item-active .menu-icon i,
    .aside-menu .menu-nav .menu-item:hover .menu-icon i {
        color: var(--white) !important;
    }


    /* =========================
       CARDS
    ========================== */
    .card {
        background:  var(--white) !important;
        border: 1px solid var(--border) !important;
        border-radius: 12px !important;
        box-shadow: var(--shadow);
    }

    .custom-info-card {
        border: 1px solid var(--border) !important;
        border-radius: 12px !important;
        box-shadow: var(--shadow);
        transition: all 0.25s ease;
    }
    

    .card-customer{
         background: var(--orange) !important;
    }
    .card-sales{
         background: var(--primary) !important;
    }
    .card-cash{
         background: var(--success) !important;
    }
    .card-due{
         background: var(--danger) !important;
    }
    .card-products{
         background: var(--purple) !important;
    }
    .card-stock{
         background: var(--warning) !important;
    }
    

    .custom-info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(15, 23, 42, 0.09);
    }

    .dashboard-chart-card {
        background: #FFFFFF !important;
        color: var(--text) !important;
        border: 1px solid var(--border) !important;
        border-radius: 12px !important;
        box-shadow: var(--shadow);
    }


    /* =========================
       METRICS
    ========================== */
    .metric-value {
        color: var(--white) !important;
        font-weight: 700;
    }

    .card-icon-box {
        color: var(--orange) !important;
        background: var(--white);
        border-radius: 10px;
    }


    /* =========================
       COLORFUL ICON SUPPORT
    ========================== */
    .card-icon-box.success {
        color: var(--success) !important;
        background: #21AFBC !important;
    }

    .card-icon-box.warning {
        color: var(--warning) !important;
        background: #21AFBC !important;
    }

    .card-icon-box.danger {
        color: var(--danger) !important;
        background: #21AFBC !important;
    }

    .card-icon-box.info {
        color: var(--info) !important;
        background: #21AFBC !important;
    }

    .card-icon-box.purple {
        color: var(--purple) !important;
        background: #21AFBC !important;
    }

    .card-icon-box.orange {
        color: var(--orange) !important;
        background: #21AFBC !important;
    }


    /* =========================
       TABLE
    ========================== */
    .dataTables_wrapper {
        background: var(--white);
    }

    .dataTables_wrapper th {
        background: var(--success) !important;
        color: var(--white) !important;
        border-bottom: 1px solid var(--border) !important;
        font-weight: 600;
    }

    .dataTables_wrapper td {
        color: #475569 !important;
        border-bottom: 1px solid #EDF2F7 !important;
    }

    .dataTables_wrapper tbody tr:hover {
        background: var(--white) !important;
    }


    /* =========================
       BUTTONS
    ========================== */
    .btn {
        border-radius: 7px !important;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: var(--primary) !important;
        border-color: var(--primary) !important;
        color: #FFFFFF !important;
        box-shadow: 0 3px 10px rgba(33, 175, 188, 0.18);
    }

    .btn-primary:hover {
        background: var(--primary-dark) !important;
        border-color: var(--primary-dark) !important;
        color: #FFFFFF !important;
        transform: translateY(-1px);
    }

    .bg-primary {
        background-color: var(--primary) !important;
    }

    .border-primary {
        border-color: var(--primary) !important;
    }


    /* =========================
       OTHER BUTTON COLORS
    ========================== */
    .btn-success {
        background: #10B981 !important;
        border-color: #10B981 !important;
        color: #FFFFFF !important;
    }

    .btn-warning {
        background: #F59E0B !important;
        border-color: #F59E0B !important;
        color: #FFFFFF !important;
    }

    .btn-danger {
        background: #EF4444 !important;
        border-color: #EF4444 !important;
        color: #FFFFFF !important;
    }

    .btn-info {
        background: #3B82F6 !important;
        border-color: #3B82F6 !important;
        color: #FFFFFF !important;
    }


    /* =========================
       DROPDOWN
    ========================== */
    .dropdown-menu {
        background: #FFFFFF !important;
        border: 1px solid var(--border) !important;
        border-radius: 10px !important;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.10);
    }

    .dropdown-menu .dropdown-item {
        color: #334155 !important;
    }

    .dropdown-menu .dropdown-item:hover {
        background: #E8FAFC !important;
        color: var(--primary) !important;
    }

    .list-dropdown-btn {
        background: #F7FCFD !important;
        border: 1px solid var(--border) !important;
        color: var(--primary) !important;
        border-radius: 7px !important;
    }

    .list-dropdown-btn:hover,
    .list-dropdown-btn:focus {
        background: #E8FAFC !important;
        color: var(--primary-dark) !important;
        border-color: #B9E8ED !important;
    }


    /* =========================
       LANGUAGE
    ========================== */
    .language-switch {
        background: #F8FAFC !important;
        border: 1px solid var(--border);
        border-radius: 8px;
    }

    .lang-btn.active {
        background: #E8FAFC !important;
        color: var(--primary) !important;
        border-radius: 6px;
    }


    /* =========================
       FORM ELEMENTS
    ========================== */
    .form-control,
    .form-select {
        background-color: #FFFFFF !important;
        border: 1px solid #D8E2EA !important;
        color: #334155 !important;
        border-radius: 7px !important;
    }

    .form-control::placeholder {
        color: #94A3B8 !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 3px rgba(33, 175, 188, 0.10) !important;
        background-color: #FFFFFF !important;
        color: #334155 !important;
    }

    .form-select option {
        background: #FFFFFF !important;
        color: #334155 !important;
    }


    /* =========================
       SWITCH
    ========================== */
    .form-switch .form-check-input {
        background-color: #CBD5E1 !important;
        border-color: #CBD5E1 !important;
    }

    .form-switch .form-check-input:checked {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
    }


    /* =========================
       TEXT
    ========================== */
    .text-secondary {
        color: var(--text-light) !important;
    }

    .text-secondary:hover {
        color: var(--primary) !important;
    }


    /* =========================
       QUICK LINKS
    ========================== */
    .quick-link-btn {
        background: #FFFFFF !important;
        color: #334155 !important;
        border: 1px solid var(--border) !important;
        border-radius: 9px !important;
        transition: all 0.2s ease;
        gap: 0px !important;
    }

    .quick-link-btn:hover {
        background: #E8FAFC !important;
        color: var(--primary) !important;
        border-color: #B9E8ED !important;
        transform: translateY(-1px);
    }


    /* =========================
       PAGINATION
    ========================== */
    .pagination .page-item .page-link {
        color: #64748B !important;
        border-color: var(--border) !important;
        background: #FFFFFF !important;
        border-radius: 6px !important;
        margin: 0 2px;
    }

    .pagination .page-item .page-link:hover,
    .pagination .page-item.active .page-link {
        background: var(--primary) !important;
        border-color: var(--primary) !important;
        color: #FFFFFF !important;
    }


    /* =========================
       FOOTER
    ========================== */
    .footer {
        background: var(--pink) !important;
        border-top: 1px solid var(--border) !important;
        color: var(--text-light) !important;
    }

    .footer a {
        color: var(--white) !important;
    }


    /* =========================
       BADGES
    ========================== */
    .badge-primary {
        background: #E8FAFC !important;
        color: var(--primary) !important;
    }

    .badge-success {
        background: #DCFCE7 !important;
        color: #15803D !important;
    }

    .badge-warning {
        background: #FEF3C7 !important;
        color: #B45309 !important;
    }

    .badge-danger {
        background: #FEE2E2 !important;
        color: #B91C1C !important;
    }

    .badge-info {
        background: #DBEAFE !important;
        color: #1D4ED8 !important;
    }

    .badge-purple {
        background: #EDE9FE !important;
        color: #6D28D9 !important;
    }


    /* =========================
       LINKS
    ========================== */
    a {
        color: var(--primary);
    }

    a:hover {
        color: var(--primary-dark);
    }


    /* =========================
       HR
    ========================== */
    hr {
        border-color: var(--border) !important;
    }


    /* =========================
       SCROLLBAR
    ========================== */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #F1F5F9;
    }

    ::-webkit-scrollbar-thumb {
        background: #B8DDE1;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary);
    }
</style>















































<!-- Custom Theme -->
@elseif($admin_setting->template_status=='custom')

   <style>

        :root {
            /* =========================
            MAIN COLOR PALETTE
            ========================== */
            --body_bg: {{$admin_setting->body_bg}};
            --primary_bg: {{$admin_setting->primary_bg}};
            --primary_color: {{$admin_setting->primary_color}};

            --secondary_bg: {{$admin_setting->secondary_bg}};
            --secondary_color: {{$admin_setting->secondary_color}};

            --card_bg: {{$admin_setting->card_bg}};
            --title_bg: {{$admin_setting->title_bg}};

            --text1_color: {{$admin_setting->text1_color}};
            --text2_color: {{$admin_setting->text2_color}};
        }


        /* =========================
        BODY
        ========================== */
        body {
            background: var(--primary_bg) !important;
            color: var(--text1_color) !important;
        }

        .bg-light {
            background: var(--body_bg) !important;
        }

        .metric-title {
            color: var(--text1_color) !important;
        }

        .text-primary {
            color: var(--primary_color) !important;
        }


        /* =========================
        TOP NAVBAR
        ========================== */
        .navbar-header {
            background: var(--primary_bg) !important;
            border-bottom: 1px solid var(--secondary_bg) !important;
        }

        .brand {
            background: var(--primary_bg) !important;
            border-bottom: 1px solid var(--secondary_bg) !important;
        }


        /* =========================
        SIDEBAR
        ========================== */
        .aside-fixed.aside {
            background: var(--secondary_bg) !important;
            border-right: 1px solid var(--secondary_bg) !important;
        }

        .aside-menu-wrapper {
            border-right: 1px solid var(--secondary_bg) !important;
        }

        .aside-menu .menu-nav .menu-link {
            color: var(--text1_color) !important;
            border-radius: 8px;
            margin: 3px 10px;
            transition: all 0.2s ease;
        }

        .aside-menu .menu-nav .menu-submenu .menu-link {
            color: var(--text1_color) !important;
        }

        .aside-menu .menu-nav > .menu-item > .menu-heading .menu-text,
        .aside-menu .menu-nav > .menu-item > .menu-link .menu-text {
            color: var(--text1_color) !important;
        }

        .fa,
        .fab,
        .fad,
        .fal,
        .far,
        .fas {
            color: var(--text1_color) !important;
        }

        .menu-icon {
            color: var(--text1_color) !important;
            transition: 0.2s;
        }


        /* =========================
        SIDEBAR HOVER
        ========================== */
        .menu-item > .menu-link:hover {
            background: var(--primary_bg) !important;
            color: var(--primary_color) !important;
        }

        .menu-item > .menu-link:hover .menu-text,
        .menu-item > .menu-link:hover .menu-icon {
            color: var(--primary_color) !important;
        }


        /* =========================
        ACTIVE MENU
        ========================== */
        .menu-item.menu-item-active > .menu-link,
        .menu-item > .menu-link.active {
            background: var(--primary_bg) !important;
            color: var(--primary_color) !important;
            font-weight: 600;
            box-shadow: inset 3px 0 0 var(--card_bg);
        }

        .menu-item.menu-item-active > .menu-link > .menu-text,
        .menu-item > .menu-link.active > .menu-text {
            color: var(--primary_color) !important;
        }

        .aside-menu .menu-nav .menu-item > .menu-link.active > .menu-icon i,
        .aside-menu .menu-nav .menu-item.menu-item-active .menu-icon i,
        .aside-menu .menu-nav .menu-item:hover .menu-icon i {
            color: var(--primary_color) !important;
        }


        /* =========================
        CARDS
        ========================== */
        .card {
            background: var(--card_bg) !important;
            border: 1px solid var(--secondary_bg) !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .custom-info-card {
            background: var(--card_bg) !important;
            border: 1px solid var(--secondary_bg) !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.25s ease;
        }

        .custom-info-card:hover {
            transform: translateY(-2px);
        }

        .dashboard-chart-card {
            background: var(--card_bg) !important;
            color: var(--text1_color) !important;
            border: 1px solid var(--secondary_bg) !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }


        /* =========================
        DASHBOARD CARDS
        ========================== */
        .card-customer,
        .card-sales,
        .card-cash,
        .card-due,
        .card-products,
        .card-stock {
            background: var(--primary_bg) !important;
            border: 1px solid var(--secondary_bg) !important;
        }


        /* =========================
        METRICS
        ========================== */
        .metric-value {
            color: var(--primary_color) !important;
            font-weight: 700;
        }

        .card-icon-box {
            color: var(--primary_color) !important;
            background: var(--secondary_bg) !important;
            border-radius: 10px;
        }


        /* =========================
        COLORFUL ICON SUPPORT
        ========================== */
        .card-icon-box.success,
        .card-icon-box.warning,
        .card-icon-box.danger,
        .card-icon-box.info,
        .card-icon-box.purple,
        .card-icon-box.orange {
            color: var(--primary_color) !important;
            background: var(--secondary_bg) !important;
        }
      

        /* =========================
        TABLE
        ========================== */
        .dataTables_wrapper {
            background: var(--card_bg) !important;
        }

        .dataTables_wrapper th {
            background: var(--title_bg) !important;
            color: var(--text1_color) !important;
            border-bottom: 1px solid var(--secondary_bg) !important;
            font-weight: 600;
        }

        .dataTables_wrapper td {
            background: var(--card_bg) !important;
            color: var(--text1_color) !important;
            border-bottom: 1px solid var(--secondary_bg) !important;
        }

        .dataTables_wrapper tbody tr:hover {
            background: var(--secondary_bg) !important;
        }


        /* =========================
        BUTTONS
        ========================== */
        .btn {
            border-radius: 7px !important;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--primary_bg) !important;
            border-color: var(--primary_color) !important;
            color: var(--primary_color) !important;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
        }

        .btn-primary:hover {
            background: var(--secondary_bg) !important;
            border-color: var(--secondary_color) !important;
            color: var(--card_bg) !important;
            transform: translateY(-1px);
        }

        .bg-primary {
            background-color: var(--primary_bg) !important;
        }

        .border-primary {
            border-color: var(--primary_color) !important;
        }


        /* =========================
        OTHER BUTTON COLORS
        ========================== */
        .btn-success {
            background: var(--secondary_bg) !important;
            border-color: var(--secondary_color) !important;
            color: var(--card_bg) !important;
        }

        .btn-warning {
            background: var(--primary_bg) !important;
            border-color: var(--primary_color) !important;
            color: var(--card_bg) !important;
        }

        .btn-danger {
            background: var(--secondary_bg) !important;
            border-color: var(--secondary_color) !important;
            color: var(--secondary_color) !important;
        }

        .btn-info {
            background: var(--primary_bg) !important;
            border-color: var(--primary_color) !important;
            color: var(--card_bg) !important;
        }


        /* =========================
        DROPDOWN
        ========================== */
        .dropdown-menu {
            background: var(--card_bg) !important;
            border: 1px solid var(--secondary_bg) !important;
            border-radius: 10px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.10);
        }

        .dropdown-menu .dropdown-item {
            color: var(--text1_color) !important;
        }

        .dropdown-menu .dropdown-item:hover {
            background: var(--secondary_bg) !important;
            color: var(--primary_color) !important;
        }

        .list-dropdown-btn {
            background: var(--card_bg) !important;
            border: 1px solid var(--secondary_bg) !important;
            color: var(--primary_color) !important;
            border-radius: 7px !important;
        }

        .list-dropdown-btn:hover,
        .list-dropdown-btn:focus {
            background: var(--secondary_bg) !important;
            color: var(--primary_color) !important;
            border-color: var(--primary_color) !important;
        }


        /* =========================
        LANGUAGE
        ========================== */
        .language-switch {
            background: var(--secondary_bg) !important;
            border: 1px solid var(--secondary_color);
            border-radius: 8px;
        }

        .lang-btn.active {
            background: var(--primary_bg) !important;
            color: var(--card_bg) !important;
            border-radius: 6px;
        }


        /* =========================
        FORM ELEMENTS
        ========================== */
        .form-control,
        .form-select {
            background-color: var(--card_bg) !important;
            border: 1px solid var(--secondary_bg) !important;
            color: var(--text1_color) !important;
            border-radius: 7px !important;
        }

        .form-control::placeholder {
            color: var(--text2_color) !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary_color) !important;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.08) !important;
            background-color: var(--card_bg) !important;
            color: var(--text1_color) !important;
        }

        .form-select option {
            background: var(--card_bg) !important;
            color: var(--text1_color) !important;
        }


        /* =========================
        SWITCH
        ========================== */
        .form-switch .form-check-input {
            background-color: var(--secondary_bg) !important;
            border-color: var(--secondary_color) !important;
        }

        .form-switch .form-check-input:checked {
            background-color: var(--secondary_bg) !important;
            border-color: var(--secondary_color) !important;
        }


        /* =========================
        TEXT
        ========================== */
        .text-secondary {
            color: var(--text2_color) !important;
        }

        .text-secondary:hover {
            color: var(--primary_color) !important;
        }


        /* =========================
        QUICK LINKS
        ========================== */
        .quick-link-btn {
            background: var(--secondary_bg) !important;
            color: var(--text1_color) !important;
            border: 1px solid var(--secondary_color) !important;
            border-radius: 9px !important;
            transition: all 0.2s ease;
            gap: 0px !important;
        }

        .quick-link-btn:hover {
            background: var(--secondary_bg) !important;
            color: var(--text1_color) !important;
            border-color: var(--secondary_color) !important;
            transform: translateY(-1px);
        }


        /* =========================
        PAGINATION
        ========================== */
        .pagination .page-item .page-link {
            color: var(--text1_color) !important;
            border-color: var(--secondary_bg) !important;
            background: var(--card_bg) !important;
            border-radius: 6px !important;
            margin: 0 2px;
        }

        .pagination .page-item .page-link:hover,
        .pagination .page-item.active .page-link {
            background: var(--primary_bg) !important;
            border-color: var(--primary_color) !important;
            color: var(--card_bg) !important;
        }


        /* =========================
        FOOTER
        ========================== */
        .footer {
            background: var(--secondary_bg) !important;
            border-top: 1px solid var(--secondary_color) !important;
            color: var(--text2_color) !important;
        }

        .footer a {
            color: var(--primary_color) !important;
        }


        /* =========================
        BADGES
        ========================== */
        .badge-primary {
            background: var(--primary_bg) !important;
            color: var(--card_bg) !important;
        }

        .badge-success {
            background: var(--secondary_bg) !important;
            color: var(--card_bg) !important;
        }

        .badge-warning {
            background: var(--primary_bg) !important;
            color: var(--card_bg) !important;
        }

        .badge-danger {
            background: var(--secondary_bg) !important;
            color: var(--card_bg) !important;
        }

        .badge-info {
            background: var(--primary_bg) !important;
            color: var(--card_bg) !important;
        }

        .badge-purple {
            background: var(--secondary_bg) !important;
            color: var(--card_bg) !important;
        }


        /* =========================
        LINKS
        ========================== */
        a {
            color: var(--primary_color);
        }

        a:hover {
            color: var(--secondary_color);
        }
        .text-white{
            color: var(--secondary_color) !important;
        }

        /* =========================
        HR
        ========================== */
        hr {
            border-color: var(--secondary_color) !important;
        }
        .form-control, .form-select{
            background-color:var(--primary_bg) !important;
            border:1px solid var(--secondary_color) !important;
            color:var(--primary_color) !important;
        }

        /* =========================
        SCROLLBAR
        ========================== */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--body_bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--secondary_bg);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary_colo);
        }
</style>
@endif